<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
			'service_id' => 'int',
			'owner_id' => 'int',
            'applicant' => 'int',
			'date' => 'date',
			'status' => 'string',
			'total' => 'int',
			'location' => 'string',
        ];
    }
}
