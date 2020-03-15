<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if($this->method() == 'POST')
            return [
                'user_name'             => 'required|max:191',
                'email'                 => 'required|max:191|unique:users',
                'password'              => 'required|max:191|min:8',
                'activeUserPassword'    => 'required'
            ];
        $parameters = $this->route()->parameters();
        $id = $parameters['user'];
        return [
            'user_name'                 => 'required|max:191',
            'email'                     => 'required|max:191|unique:users,email,'.$id.',user_id',
            'password'                  => 'max:191|min:8',
            'activeUserPassword'        => 'required'
        ];
    }
    public function withValidator($validator)
    {
        //Function to validate that the given password is the same of the active users password
        $validator->after(
            function ($validator){
                $password = $this->get('activeUserPassword');
                if($password=='')
                    return;
                if(!Hash::check($password,Auth::user()->password))
                    $validator->errors()->add('activeUserPassword','The given password does not match with the active user\'s password');
            }
        );
    }
}
