<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Exceptions\StockAvailabilityException;
use App\Exceptions\UnexpectedException;
use App\Http\Requests\Api\Cart\CartRequest;
use App\Http\Requests\Api\Cart\RemoveCartRequest;
use App\Http\Resources\Cart\CartResource;
use App\Models\Core\Coupon;
use App\Models\Product\Product;
use App\Models\UserCart;
use Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use DB;

class CartService
{
    protected $total_amount = null;

    protected $total_after_discount = null;

    protected $is_discount = false;

    protected $coupon = null;



    public function getUserCartItems()
    {
        $cartItems =  $this->getShopingCartWithSummary();
        if(!$cartItems)
        {
            return 0;
        }
        return $cartItems;
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
                UserCart::create([
                    'user_id' => $authId,
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                    'attributes'  => serialize($product->attributes),
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
        $shoppingCart = UserCart::whereId($request->cart_id)->whereUserId(Auth::id())->first();
        if(!$shoppingCart)
        {
            throw new UnexpectedException('invalid cart item or be removed');
        }
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
        if($request->coupon_id)
        {
            $this->findCoupon($request->coupon_id);
        }
        return $this->getShopingCartWithSummary();
    }

    public function removeFromCart(RemoveCartRequest $request)
    {
        $shoppingCart = UserCart::whereUserId(Auth::id())->find($request->cart_id);
        if (!isset($shoppingCart)) {
            throw new NotFoundException();
        }
        $shoppingCart->delete();
        if($request->coupon_id)
        {
            $this->findCoupon($request->coupon_id);
        }
        return $this->getShopingCartWithSummary();
    }

    public function checkProductStock(UserCart $userCart, int $productQuantityInCart)
    {
        if ($userCart->product->quantity > $productQuantityInCart) {
            return true;
        }
        return false;
    }

    public function calcTotalAmount($data)
    {
        $total = 0;
        foreach ($data as $item) {
            $product = Product::find($item->product->id);
            $total += $product->price * $item->quantity; // missing the shipping cost
        }
        $this->total_amount=$total;
    }

    public function calcTotalAmountAfterDiscount()
    {
            if ($this->coupon)
            {
                $total = $this->total_amount;
                $discount_value = $this->coupon->discount($total);
                $this->total_after_discount = $total - $discount_value;
            }

        return  $total < 0 ? 0 : $total;
    }

    public function getTotalAmountAttribute()
    {
        return $this->total_amount;
    }

    public function getTotalAmountAfterDisAttribute()
    {
        return $this->total_after_discount;
    }

    public function getShopingCartWithSummary()
    {
        $cartItems =  UserCart::with('product.attributes')->whereUserId(Auth::id())->get();
        if($cartItems->isEmpty())
        {
            return false;
        }
        $this->calcTotalAmount($cartItems);
        if(is_null($this->coupon))
        {
            $this->total_after_discount = $this->total_amount;
            $data['cart'] = CartResource::collection($cartItems);
            $data['order_summary']['total_amount'] = $this->total_amount;
            return $data;
        }
        $this->is_discount = true;
        $this->calcTotalAmountAfterDiscount();
        $data['cart'] = array(CartResource::collection($cartItems));
        $data['coupon'] = $this->coupon;
        $data['order_summary']['total_amount'] = $this->total_amount;
        $data['order_summary']['total_amount_after_discount'] = $this->total_after_discount;
        return $data;
    }

    public function findCoupon($coupon_id)
    {
        $coupon = Coupon::findOrFail($coupon_id);
        $this->coupon = $coupon;
    }




}
