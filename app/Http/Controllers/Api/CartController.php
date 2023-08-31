<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\StockAvailabilityException;
use App\Exceptions\UnexpectedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Cart\CartRequest;
use App\Http\Requests\Api\Cart\RemoveCartRequest;
use App\Services\CartService;
use Illuminate\Http\Request;



class CartController extends Controller
{
    public function __construct(protected CartService $cartService){}

    public function getUserCartItems(Request $request)
    {
        $userCartItems = $this->cartService->getUserCartItems($request);
        if (!$userCartItems) {
            $cart = new CartService();
            $cart->setEmptyCart(value: true);
            $data['cart'] = [];
            $data['order_summary']['subtotal'] = 0;
            $data['order_summary']['shipping_handling'] =0;
            $data['order_summary']['total'] = 0;
            return responseSuccess($data);
        }
        return responseSuccess($userCartItems);
    }

    public function addToCart(CartRequest $request)
    {
        try {
            $data = $this->cartService->addToCart($request);
            return responseSuccess($data, 'added successfully');
        } catch (UnexpectedException $ex) {
            return responseError($ex->getMessage(), $ex->getCode());
        }catch (StockAvailabilityException $ex) {
            throw new StockAvailabilityException();
        }
    }

    public function updateCart(CartRequest $request)
    {
        try {
            $shoppingCart = $this->cartService->updateCart($request);
            if (!$shoppingCart) {
                return responseError("cannot decrease", 401);
            }
            return responseSuccess($shoppingCart, 'updated successfully');
        } catch (UnexpectedException $ex) {
            return responseError($ex->getMessage(), $ex->getCode());
        }
    }

    public function removeFromCart(RemoveCartRequest $request)
    {
        return responseSuccess($this->cartService->removeFromCart($request), 'item deleted successfully');
    }
}
