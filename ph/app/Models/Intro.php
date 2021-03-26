<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Intro extends Model
{
    use Translatable;
    
    public $translatedAttributes = ['sub_title', 'description'];
    protected $fillable = ['hex_code', 'pdf'];

    public function topicResource() {
        return $this->morphOne(TopicResource::class, 'topicResourceable');
    }
}
