<?php

namespace App\Http\Requests\Api\Cart;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if(request()->is('api/cart/add'))
        {
            return [
                'product_id' => ['required','integer','exists:products,id'],
                'quantity' => ['required','integer'],
            ];
        }else{
            return [
                'cart_id' => ['required','integer','exists:user_carts,id'],
                'decrease' => ['nullable','integer'],
                'increase' => ['nullable','integer'],
                'coupon_id' => ['nullable','integer','exists,coupons,id'],
            ];
        }
    }

    public function messages()
    {
       return [
            'required' => __('validation.required')
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = array();
        foreach($validator->errors()->messages() as $key => $message)
        {
            $errors[$key] = $message[0];
        }
        throw new HttpResponseException(
            response()->json(
                [
                    'status' => false,
                    'message' =>$errors,
                ],
            )
        );
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'status' => false,
                    'message' => "Error: you are not authorized or do not have the permission",
                ],
            )
        );
    }
}
