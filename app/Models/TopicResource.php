<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicResource extends Model
{
    protected $fillable = [
        'topic_id',
        'topic_resourceable_id',
        'topic_resourceable_type',
        'layout',
        'show_steps',
        'sort',
        'parent',
        'active'
    ];
    
    public function topicResourceable() {
        return $this->morphTo();
    }
    
    public function topics() {
        return $this->belongsTo('App\Models\Topic', 'topic_id');
    }
}