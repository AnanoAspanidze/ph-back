<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Topic extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = ['title', 'tags'];
    protected $fillable = ['illustration', 'active'];
    private $path = 'public/topic';

    public function course() {
        return $this->belongsTo(Course::class, 'id', 'topic_id');
    }

    public function resources() {
        return $this->hasMany(Resource::class);
    }

    public function getUrlPath()
    {
        return Storage::url($this->path);
    }
}
