<?php

namespace App\Http\Requests\Backoffice;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'item_id' => "required",
            'quantity' => "required",
        ];
    }

    public function messages(){
		return [
			'item_id.required' => "The Item field is required.",
		];
	}
}
