<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

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
        if($this->method() == 'POST')
            return [
                'user_name' => 'required|max:191',
                'user_email'=> 'required|max:191|unique:users',
                'user_password' => 'required|min:8|max:191'
            ];
        $parameters = $this->route()->parameters();
        $id = $parameters['user'];
        return [
            'user_name' => 'required|max:191',
            'user_email'=> 'required|max:191|unique:users,user_email,'.$id.',user_id',
            'user_password' => 'min:8|max:191'
        ];
    }
}
