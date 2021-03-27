<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $fillable = [
        'topic_id',
        'name',
        'active'
    ];
    
    public function topic() {
        return $this->belongsTo('App\Models\Topic', 'topic_id');
    }
}
