<?php

namespace App\Http\Requests\Backoffice;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //
            'fname' => "required",
            'lname' => "required",
            'email' => "required|unique:users,email",
            'contact_number' => "required",
            'address' => "required",
            'password' => "confirmed|min:8",
            'password_confirmation' => "required",
        ];
    }
}
