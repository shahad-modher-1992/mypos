<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable  as Shahad;

class Product extends Model implements Shahad
{
    use HasFactory, Translatable;

    protected $fillable = ['image', 'purchase_price', 'sale_price', 'stock', 'catigory_id'];
    public $translatedAttributes = ['name', 'desc'];
    protected $appends = ['profit_percent'];
    public $timestamps = false;


    public function catigory() {
        return $this->belongsTo(catigory::class);
    }

    public function getProfitPercentAttribute() {
        $profit = $this->sale_price - $this->purchase_price;
        $profit_percent = $profit * 100 / $this->purchase_price;
        return number_format($profit_percent, 2);
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'product_order')->withPivot('qty');
    }
}
