<?php

namespace App\Http\Requests\Api\Address;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class AddressRequest extends FormRequest
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

        return [
            'country_id' => ['required', 'integer', 'exists:countries,id'],
            'state_id' => ['required', 'integer', 'exists:states,id'],
            'address' => ['required'],
            'address_type' => ['required', 'in:office,home,other'],
            'zipcode' => ['required','digits:5'],
            'note' => ['nullable'],
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'mobile' => ['digits:12'],

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

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->id(),
        ]);
    }
}
