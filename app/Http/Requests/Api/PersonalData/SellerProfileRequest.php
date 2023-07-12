<?php

namespace App\Http\Requests\Api\PersonalData;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class SellerProfileRequest extends FormRequest
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
    {;
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => [
                'required', Rule::unique('users')->ignore(auth()->id()),
            ],
            'street' => ['required'],
            'street2' => ['required'],
            'phone' => ['required'],
            'business_type_id' => ['required', 'integer', 'exists:business_types,id'],
            'business_subtype' => ['required', 'integer'],
            'state_id' => ['required', 'integer', 'exists:states,id'],
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'mobile' => ['required'],
            'website' => ['required', 'url'],


        ];
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
