<?php

namespace App\Http\Requests\Backoffice;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
        if(auth()->user()->type == 'patient'){
            return [
                'pet_id' => "required",
                'service_id' => "required",
            ];
        }else{
            return [
                'vet_id' => "required",
                'status' => "required",
                'start' => "required",
                'end' => "required",
            ];
        }
        
    }
    
    public function messages(){
		return [
			'patient_id.required' => "The Patient field is required.",
			'pet_id.required' => "The Pet field is required.",
			'vet_id.required' => "The Veterinarian field is required.",
			'service_id.required' => "The Service field is required.",
		];
	}
}
