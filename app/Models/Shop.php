<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    //Relacion poliformica
    public function image(){
        return $this->morphOne('App\Models\Image', 'imageable');
    }
}
