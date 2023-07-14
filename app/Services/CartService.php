<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Exceptions\StockAvailabilityException;
use App\Exceptions\UnexpectedException;
use App\Http\Requests\Api\Cart\CartRequest;
use App\Models\Product\Product;
use App\Models\UserCart;
use Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use DB;

class CartService
{

    public function getUserCartItems(): Collection
    {
        return UserCart::with('product.attributes')->whereUserId(Auth::id())->get();
    }

    public function addToCart(CartRequest $request)
    {
        $authId = Auth::id();
        $shoppingCart = UserCart::whereUserId($authId)->whereProductId($request->product_id)->first();
        if ($shoppingCart) {
            if (!$this->checkProductStock($shoppingCart, $shoppingCart->quantity)) {
                throw new StockAvailabilityException();
            }
            $shoppingCart->update([
                'quantity' => $shoppingCart->quantity + 1
            ]);
            return $shoppingCart;
        } else {

            try {
                $product = Product::findOrFail($request->product_id);

                if (!$product->quantity) {
                    throw new StockAvailabilityException('Not available in the stock');
                }
                $shoppingCart = UserCart::create([
                    'user_id' => $authId,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'attributes'  => serialize($product->attributes),
                ]);
            } catch (\Exception $e) {
                Log::warning($e);
                throw new UnexpectedException($e->getMessage(), Response::HTTP_BAD_REQUEST);
            }
        }
        return $shoppingCart;
    }

    public function updateCart(CartRequest $request)
    {
        $shoppingCart = UserCart::whereId($request->cart_id)->whereUserId(Auth::id())->first();
        if ($request->increase) {
            $shoppingCart->update([
                'quantity' => $shoppingCart->quantity + 1
            ]);
            return $shoppingCart;
        }
        if ($request->decrease) {
            if ($shoppingCart->quantity == 1) {
                return false;
            }
            $shoppingCart->update([
                'quantity' => $shoppingCart->quantity - 1
            ]);
            return $shoppingCart;
        }
    }

    public function removeFromCart(CartRequest $request)
    {
        $shoppingCart = UserCart::whereUserId(Auth::id())->find($request->cart_id);
        if (!isset($shoppingCart)) {
            throw new NotFoundException();
        }
        $shoppingCart->delete();
        return $shoppingCart;
    }

    public function checkProductStock(UserCart $userCart, int $productQuantityInCart)
    {
        if ($userCart->product->quantity > $productQuantityInCart) {
            return true;
        }
        return false;
    }


}
