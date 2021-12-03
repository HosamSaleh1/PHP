<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name_en'=>['required','max:255','string','min:2'],
            'name_ar'=>'required|max:255|string|min:2',
            'price'=>['required','numeric','min:1','max:99999.99'],
            'quantity'=>['required','integer','max:999','min:1'],
            'desc_en'=>['required','string'],
            'desc_ar'=>['required','string'],
            'status'=>['nullable','integer','min:0','max:1'],
            'brand_id'=>['nullable','integer','exists:brands,id'],
            'subcategory_id'=>['required','integer','exists:subcategories,id'],
            'image'=>['required','max:1024','mimes:jpg,png,jpeg'],
        ];
    }
}
