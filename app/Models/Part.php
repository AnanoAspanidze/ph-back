<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use Translatable;
    
    public $translatedAttributes = [
        'title',
        'short_desc',
        'description',
    ];
    protected $fillable = [
        'video',
        'sort',
        'active'
    ];    

    public function courses() {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
