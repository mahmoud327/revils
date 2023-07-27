<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class SellerRegisterRequest extends FormRequest
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
            'username' => ['required','max:100','unique:users,username'],
            'mobile' => ['required','digits:12'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','string'],
            'account_type' => ['required','integer'],
            'category_id' => ['required','integer'],
            'store_name' => ['required','string'],
            'country_id' => ['required','integer','exists:countries,id'],
            'state_id' => ['required','integer','exists:states,id'],
            'city_id' => ['required','integer','exists:cities,id'],
            'zipcode' => ['required','digits:5'],
            'area' => ['required','string','max:100'],
            'street' => ['required','string','max:100'],
            'agreement' => ['required']
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
