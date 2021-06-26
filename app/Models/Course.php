<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use Translatable;
    
    public $translatedAttributes = ['short_desc'];
    protected $fillable = [
        'topic_id',
        'video',
        'link',
        'sort',
        'active'
    ];

    public function topic() {
        return $this->belongsTo(Topic::class, 'topic_id');
    }
}
