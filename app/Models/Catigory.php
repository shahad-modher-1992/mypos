<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Spatie\Translatable\HasTranslations;
// use Astrotomic\Translatable\Contracts\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

use Astrotomic\Translatable\Contracts\Translatable  as Shahad;
use Astrotomic\Translatable\Translatable;

class catigory extends Model implements Shahad
{
    use Translatable; // 2. To add translation methods

    // 3. To define which attributes needs to be translated
    protected $fillable = ['name'];
    public $translatedAttributes = ['name'];
}
