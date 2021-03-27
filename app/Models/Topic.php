<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use Translatable;
    
    public $translatedAttributes = ['title'];
    protected $fillable = ['illustration', 'active'];

    public function topicResources() {
        return $this->hasMany(TopicResource::class);
    }
}
