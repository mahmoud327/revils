<?php

namespace App\Http\Requests\Api\SocialNetwork;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostRequest extends FormRequest
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
        if(request()->is('api/like-unlike') or request()->is('api/unlike-post') or request()->is('api/favorite-unfavorite'))
        {
            return [
                'post_id' => ['required','exists:posts,id'],
            ];
        }
        if(request()->is('api/posts/update/*'))
        {
            return [
                'content' => ['nullable','string','max:300'],
                'tag_ids' => ['nullable','array'],
                'tag_ids.*' => ['exists:users,id'],
                'image' => ['nullable', 'mimes:png,jpg,jpeg','max:10240'],
            ];
        }
        return [
            'content' => ['required','string','max:300'],
            'tag_ids' => ['nullable','array'],
            'tag_ids.*' => ['exists:users,id'],
            'image' => ['required', 'mimes:png,jpg,jpeg','max:10240'],
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
