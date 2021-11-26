<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
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

        $rules = [];
        foreach(config('translatable.locales') as $locale) 
        {
            $rules += [$locale . '.*' => 'required'];
            $rules += [$locale . 'name' => [Rule::unique('product_translations')]];
        }
        $rules += [
            'image' => 'nullable', 'mimes:png,jpg',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'image' => 'nullable',
            'catigory_id' => 'required',
            'stock' => 'required'
        ];
      
        return $rules;
    }
}
