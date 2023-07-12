<?php

namespace App\Http\Requests\Api\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class ProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [

            'price' => ['required', 'numeric'],
            'old_price' => ['required', 'numeric'],
            'weight' => ['required', 'integer'],
            'quantity' => ['required', 'numeric'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'cash' => ['required', 'numeric'],
            'item_type' => ['required', 'string'],
            'is_batteries_shipping' => ['nullable', 'integer'],
            'is_free_shipping' => ['nullable', 'integer'],
            'is_dangerous_shipping' => ['nullable', 'integer'],
            'is_liquid_shipping' => ['nullable', 'integer'],
            'name_ar' => ['required', 'string'],
            'attribute_ids' => ['required', 'array'],
            'attribute_ids.*.attribute_id' => ['required', 'exists:attributes,id'],

            'name_en' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'description_ar' => ['required', 'string'],
            'name_ar' => ['required', 'string'],
            'name_en' => ['required', 'string'],

            'is_handcrafted' => ['nullable', 'integer'],
            'check_coin' => ['nullable', 'integer'],
            'cash' => ['required', 'numeric'],
            'unit' => ['required', 'string', 'max:100'],
            'reason' => ['required', 'string', 'max:100'],
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation.required'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = array();
        foreach ($validator->errors()->messages() as $key => $message) {
            $errors[$key] = $message[0];
        }
        throw new HttpResponseException(
            response()->json(
                [
                    'status' => false,
                    'message' => $errors,
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
