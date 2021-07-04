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
        'views',
        'active'
    ];

    public function topic() {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function parts() {
        return $this->hasMany(Part::class);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function courseDetail() {
        return $this->hasMany(CourseDetail::class);
    }    
}