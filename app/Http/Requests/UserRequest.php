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
                'email'=> 'required|max:191|unique:users',
                'password' => 'required|min:8|max:191'
            ];
        $parameters = $this->route()->parameters();
        $id = $parameters['user'];
        return [
            'user_name' => 'required|max:191',
            'email'=> 'required|max:191|unique:users,email,'.$id.',user_id',
            'password' => 'min:8|max:191'
        ];
    }
}
