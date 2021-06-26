<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'tags'];
}
