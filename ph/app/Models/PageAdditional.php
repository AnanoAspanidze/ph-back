<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class PageAdditional extends Model
{
    use Translatable;
    
    public $translatedAttributes = ['title', 'sub_title', 'description', 'resource'];
    protected $fillable = [
        'topic_resource_id',
        'topic_id',
        'image',
        'video',
        'type',
        'pdf',
        'source',
        'pinned',
        'active'
    ];
    
    public function topicResource() {
        return $this->belongsTo('App\Models\TopicResource', 'topic_resource_id');
    }

    public function topic() {
        return $this->belongsTo('App\Models\Topic', 'topic_id');
    }
}
