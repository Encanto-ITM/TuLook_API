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
			'name' => 'required|string',
			'lastname' => 'required|string',
			'email' => 'required|string',
            'password'=> 'required|string',
			'contact_number' => 'required|string',
			'contact_public' => 'required|string',
			'is_active' => 'required|string',
			'acounttype_id' => 'required',
			'professions_id' => 'required',
        ];
    }
}
