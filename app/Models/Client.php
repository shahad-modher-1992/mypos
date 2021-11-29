<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];
    use HasFactory;


    /// return upper case name of clients
    public function getNameAttribute($name) {
      return ucfirst($name);
    }
    
    public function orders() {
        return $this->hasMany(Order::class);
    }
}
