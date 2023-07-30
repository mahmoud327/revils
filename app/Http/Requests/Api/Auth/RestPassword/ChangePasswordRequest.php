<?php

namespace App\Http\Requests\Api\Auth\RestPassword;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChangePasswordRequest extends FormRequest
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
            'password' => ['required','string','confirmed'],
            'code' => ['required','integer']
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'يرجي ادخال الباسورد',
            'code.required'=>'يرجى ادخال الكود '
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
