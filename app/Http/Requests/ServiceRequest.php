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
            'image' => 'mimes:jpeg,png,jpg,webp|max:5120', // Expecting a image
			'price' => 'int',
			'details' => 'string',
			'schedule' => 'string',
			'material_list' => 'string',
			'is_active' => 'int',
			'considerations' => 'string',
			'aprox_time' => 'string',
			'type_service_id' => 'int',
        ];
    }
}
