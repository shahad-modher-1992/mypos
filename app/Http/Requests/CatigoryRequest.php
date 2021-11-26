<?php

namespace App\Http\Requests;

use App\Models\catigory;
use Illuminate\Validation\Rule;
use App\Models\CatigoryTranslation;
use Illuminate\Foundation\Http\FormRequest;

class CatigoryRequest extends FormRequest
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
    public function rules(CatigoryTranslation $catigory, catigory $cat)
    {
        $rules = [];

        foreach(config('translatable.locales') as $locale) {
         $rules += [$locale . '.*' => 'required'];
          $rules += [$locale . '.name' => [Rule::unique('catigory_translations')]];
    }
    
  return $rules;
    }
}

// ->where(function ($query) use ($locale) {
//     return $query->where('locale', $locale);
// });;


    //       'en' => [
    //           'name' => ['required', Rule::unique('catigory_translations', 'name')
    //           ->ignore( 'catigory_id', $cat->id)
    //           ->where(function($query) use ($catigory) {
    //               return $query->where('locale', $catigory->locale);
    //           })
              
    //         ],
    //       ],
    //       'ar' => [
    //         'name' => ['required', Rule::unique('catigory_translations', 'name')
    //         ->ignore('catigory_id', $cat->id)
    //         ->where(function($query)  use($catigory) {
    //             return $query->where('locale', $catigory->locale);
    //         })
    //     ],
    // ]