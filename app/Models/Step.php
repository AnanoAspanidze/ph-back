<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use Translatable;
    
    public $translatedAttributes = ['title', 'sub_title', 'description'];
    protected $fillable = ['pdf'];
    
    public function topicResource() {
        return $this->morphOne(TopicResource::class, 'topicResourceable');
    }
}
