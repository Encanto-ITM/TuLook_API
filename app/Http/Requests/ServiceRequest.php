<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
			'name' => 'string',
			'owner_id' => 'int',
			'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Expecting a image
			'price' => 'string',
			'details' => 'string',
			'schedule' => 'string',
			'material_list' => 'string',
			'mode' => 'string',
			'is_active' => 'string',
			'considerations' => 'string',
			'aprox_time' => 'string',
			'type_service_id' => 'int',
        ];
    }
}
