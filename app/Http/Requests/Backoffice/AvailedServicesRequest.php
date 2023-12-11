<?php

namespace App\Http\Requests\Backoffice;

use Illuminate\Foundation\Http\FormRequest;

class AvailedServicesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() AND in_array(auth()->user()->type,['super_user', 'admin', 'vet']);
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
            'service_id' => "required",
            'date' => "required",
        ];
    }

    public function messages(){
		return [
			'service_id.required' => "The Service field is required.",
		];
	}
}
