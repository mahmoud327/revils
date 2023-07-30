<?php

namespace App\Http\Requests\Api\Auth\RestPassword;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RestPasswordRequest extends FormRequest
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
            'mobile' => ['required','integer','exists:users,mobile'],
        ];
    }

    public function messages()
    {
        return [
            'mobile.required' => 'يرجي ادخال رقم الجوال ',
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
