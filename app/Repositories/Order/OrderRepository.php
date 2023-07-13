<?php


namespace App\Repositories\Order;

use App\Exceptions\CartEmptyException;
use App\Exceptions\OrderNotAllowException;
use App\Exceptions\StockAvailabilityException;
use App\Exceptions\UnexpectedException;
use App\Models\Core\Coupon;
use App\Models\Core\CouponUser;
use App\Models\Order\Order;
use App\Models\Product\Product;
use App\Repositories\Base\BaisRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaisRepository implements OrderRepositoryInterface
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function all(?int $paginatePerPage, bool $paginate = true): Collection | LengthAwarePaginator
    {
        $orders = $this->model->whereUserId(auth()->id())
            ->with(['orderDetails', 'orderDetails.product', 'userAddress', 'payment'])
            ->latest();
        if ($paginate) {
            if ($paginatePerPage) {
                return $orders->paginate($paginatePerPage);
            }
            return $orders->paginate();
        }
        return $orders->get();
    }
    public function create($data): Model
    {
        try {

            DB::beginTransaction();
            $order = $this->model->create([
                'user_address_id' => $data->user_address_id,
                'payment_id' => $data->payment_id,
                'user_id' => auth()->id(),
                'billing_address' => $data->billing_address,
            ]);

            $this->calculateOrderDetails(auth()->user()->cartItems, $order);

            if (isset($data->coupon_code)) {
                $this->calculateCouponDiscount($data->coupon_code, $order);
            }

            auth()->user()->cartItems()->delete();
            DB::commit();
            return $this->model;
        } catch (\Exception $e) {
            DB::rollback();
            throw  new UnexpectedException($e->getMessage());
        }
    }

    public function show($id)
    {
        $order = $this->model->with(['orderDetails', 'userAddress', 'payment'])
            ->findorfail($id);
        if (auth()->id() !== $order->user_id) {
            throw  new OrderNotAllowException('order not allow');
        }
        return $order;
    }
    private function calculateOrderDetails($cartItems, $order)
    {
        $subtotal = 0;
        foreach ($cartItems as $cartItem) {
            $product = Product::findorfail($cartItem->product_id);

            if ($cartItem->quantity > $product->quantity) {
                throw new StockAvailabilityException('Not available in the stock');
            }
            if (isset($product)) {

                $subtotal += $product->price * $cartItem['quantity'];
                if ($product->quantity > 0) {
                    $product->quantity -= $cartItem->quantity;
                    $product->save();
                }
            }
            $order->orderDetails()->create([
                'user_id' => $product->user_id,
                'product_id' => $product->id,
                'price' => $product->price * $cartItem->quantity,
                'quantity' => $cartItem->quantity,
            ]);
        }
        $order->amount = $subtotal;
        $order->save();
    }

    private function calculateCouponDiscount($coupon_code, $order)
    {
        $coupon = Coupon::where('code', $coupon_code)
            ->vaild()
            ->first();
        if ($coupon && !$coupon->userUsedCoupon) {
            $order->amount -= $coupon->discount($order->amount);
            $order->coupon_id = $coupon->id;
            $order->save();

            CouponUser::create([
                'user_id' => auth()->id(),
                'coupon_id' => $coupon->id
            ]);
        }
    }
    public function changeStatus($request, $id)
    {
        $order = $this->model->findorfail($id);
        $order->update(['order_status' => $request->status]);
        return $order;
    }
}
