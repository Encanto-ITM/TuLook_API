<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'id' => 'required|biginteger',
			'name' => 'string',
			'lastname' => 'string',
			'email' => 'string',
            'password' => 'string',
			'contact_number' => 'string',
			'contact_public' => 'string',
			'is_active' => 'string',
            'profilephoto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Expecting a image
            'headerphoto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Expecting a image
			'address' => 'string',
			'description' => 'string',
			'acounttype_id' => 'int',
			'professions_id' => 'int',
        ];
    }
}
