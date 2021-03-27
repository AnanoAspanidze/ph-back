<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use Translatable;
    
    public $translatedAttributes = ['name'];
    protected $fillable = ['active'];

    public function users() {
        return $this->hasMany('App\User');
    }
}