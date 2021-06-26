<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use Translatable;
    
    public $translatedAttributes = [
        'title',
        'sub_title',
        'instruction',
    ];

    protected $fillable = [
        'type',
        'code',
    ];

    public $timestamps = false;

    public function resource() {
        return $this->morphOne(Resource::class, 'resourceable');
    }
    
    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function surveys() {
        return $this->hasMany(Survey::class);
    }    
}
