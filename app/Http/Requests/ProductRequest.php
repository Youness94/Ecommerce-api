<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_id'=> 'required|max:191|exists:categories,id',
            'brand_id'=>'required|max:191|exists:brands,id',
            'title'=> 'required|max:191',
            'description'=> 'required|max:400',
            "selling_price"=>'required',
            'original_price'=>'required',
            'image'=> 'required|image|mimes:jpeg,png,jpg|max:2048',  
        ];
    }
}
