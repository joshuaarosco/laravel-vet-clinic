<?php

namespace App\Http\Requests\Backoffice;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class VetsRequest extends FormRequest
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
        $validate = [
            'fname' => "required",
            'lname' => "required",
            'contact_number' => "required",
        ];
        
        $email = ['email' => "required|unique:users,email"];

        if(Request::has('user_id')){
            $user_id = Request::get('user_id');
            $email = ['email' => "required|unique:users,email,{$user_id}"];
        }
        
        return $validate+$email;
    }
}
