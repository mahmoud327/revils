<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Exceptions\StockAvailabilityException;
use App\Exceptions\UnexpectedException;
use App\Http\Requests\Api\Cart\CartRequest;
use App\Http\Requests\Api\Cart\RemoveCartRequest;
use App\Http\Resources\Cart\CartResource;
use App\Models\Core\Coins;
use App\Models\Product\Product;
use App\Models\UserCart;
use App\Repositories\Core\Coupon\CouponRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DB;

class CartService
{
    protected $subtotal = null;
    protected $shipping_amount = 30;

    protected $coupon = null;

    protected $coins = null;

    protected $total_amount = null;

    public function __construct(protected CouponRepositoryInterface $couponRepository){}

    public function getUserCartItems()
    {
        return  $this->getShopingCartWithSummary();
    }

    public function addToCart(CartRequest $request)
    {
        $authId = Auth::id();
        $product = Product::findOrFail($request->product_id);
        $shoppingCart = UserCart::whereUserId($authId)->whereProductId($request->product_id)->first();
        if ($shoppingCart)
        {
            if (!$this->checkProductStock($shoppingCart, $request->quantity))
            {
                throw new StockAvailabilityException();
            }
            if (!$this->checkProductStock($shoppingCart, ($shoppingCart->quantity+$request->quantity))) {
                throw new StockAvailabilityException();
            }
            $shoppingCart->update([
                'quantity' => ($request->quantity+$shoppingCart->quantity)
            ]);
            return $this->getShopingCartWithSummary();
        } else {
            try {
                if (!$product->quantity) {
                    throw new StockAvailabilityException('Not available in the stock');
                }
                if ($product->quantity < $request->quantity) {
                    throw new StockAvailabilityException('Not available in the stock');
                }
                $attribites = array(['color' => $request->color,'size'=>$request->size]);
                UserCart::create([
                    'user_id' => $authId,
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                    'attributes'  => serialize($attribites),
                ]);
            } catch (\Exception $e) {
                Log::warning($e);
                throw new UnexpectedException($e->getMessage(), Response::HTTP_BAD_REQUEST);
            }
        }
        return $this->getShopingCartWithSummary();
    }

    public function updateCart(CartRequest $request)
    {
        if($request->coupon)
        {
            $this->findCoupon($request->coupon);
        }

        if($request->coins)
        {
            $this->findCoins();
        }
        $shoppingCart = UserCart::whereId($request->cart_id)->whereUserId(Auth::id())->first();
        if($request->increase)
        {
            $shoppingCart->update([
                'quantity' => ($shoppingCart->quantity + 1)
            ]);
        }
        if($request->decrease)
        {
            if($shoppingCart->quantity == 1)
            {
                return false;
            }
            $shoppingCart->update([
                'quantity' => ($shoppingCart->quantity - 1)
            ]);
        }
        return $this->getShopingCartWithSummary();
    }

    public function removeFromCart(RemoveCartRequest $request)
    {
        if($request->coupon)
        {
            $this->findCoupon($request->coupon);
        }

        if($request->coins)
        {
            $this->findCoins();
        }
        $shoppingCart = UserCart::whereUserId(Auth::id())->find($request->cart_id);
        if (!isset($shoppingCart)) {
            throw new NotFoundException();
        }
        $shoppingCart->delete();
        return $this->getShopingCartWithSummary();
    }

    public function checkProductStock(UserCart $userCart, int $productQuantityInCart)
    {
        if ($userCart->product->quantity > $productQuantityInCart) {
            return true;
        }
        return false;
    }

    public function calcSubTotal($data)
    {
        $total = 0;
        foreach ($data as $item) {
            $product = Product::find($item->product->id);
            $total += $product->price * $item->quantity;
        }
        if ($this->coupon)
        {
            $total-= $this->coupon->discount($total);
        }
        if ($this->coins)
        {
            $total-= $this->coins->value;
            if($total<0)
            {
                $total = 0;
            }
        }
        $this->subtotal = $total;
    }

    public function calcTotal()
    {
        $this->total_amount = $this->subtotal+$this->shipping_amount;
    }


    public function findCoupon($coupon)
    {
        $coupon = $this->couponRepository->verifyCoupon($coupon);

        if (!$coupon)
        {
            throw new UnexpectedException(__('lang.coupons.expired'),401);
        }

        if ($coupon->userUsedCoupon)
        {
            throw new UnexpectedException(__('lang.coupons.used'),401);
        }
        $this->coupon = $coupon;
    }

    public function findCoins()
    {
        $coins = Coins::whereUserId(Auth::id())->first();

        if(!$coins)
        {
            throw new UnexpectedException('user has not coins',401);
        }
        if($coins->coins < 100)
        {
            throw new UnexpectedException('user has not enough coins',401);
        }

        $this->coins = $coins;

    }

    public function getShopingCartWithSummary()
    {
        $cartItems =  UserCart::with('product.attributes')->whereUserId(Auth::id())->get();
        if($cartItems->isEmpty())
        {
            return false;
        }
        $this->calcSubTotal($cartItems);
        $this->calcTotal();
        $data['cart'] = CartResource::collection($cartItems);
        $data['coupon'] = $this->coupon;
        $data['coins'] = $this->coins;
        $data['order_summary']['subtotal'] = $this->subtotal;
        $data['order_summary']['shipping_handling'] = $this->shipping_amount;
        $data['order_summary']['total'] = $this->total_amount;
        return $data;
    }

}
