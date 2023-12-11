<?php

namespace App\Http\Requests\Backoffice;

use Illuminate\Foundation\Http\FormRequest;

class RecordsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'patient_id' => "required",
            'pet_id' => "required",
            'vet_id' => "required",
        ];
    }
    
    public function messages(){
		return [
			'patient_id.required' => "The Patient field is required.",
			'pet_id.required' => "The Pet field is required.",
			'vet_id.required' => "The Veterinarian field is required.",
		];
	}
}
