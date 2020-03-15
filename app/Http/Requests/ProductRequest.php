<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        if($this->method() === 'POST')
            return [
                'product_name' => 'required|max:191',
                'product_price'=> 'required|numeric',
                'product_description' => 'required|max:191',
            ];
        return [
            'product_name' => 'required|max:191',
            'product_price'=> 'required|numeric',
            'product_description' => 'required|max:191',
        ];
    }
}
