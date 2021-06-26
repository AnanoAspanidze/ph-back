<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Storage;

class About extends Model
{
    use Translatable;
    
    public $timestamps = false;
    public $translatedAttributes = ['title', 'text'];
    protected $fillable = [
        'pinned',
        'topic_btn',
        'register_btn',
        'illustration',
        'video',
        'active'
    ];
    private $path = 'public/about';

    public function aboutImgs() {
        return $this->hasMany(AboutImg::class);
    }

    public function getUrlPath() {
        return Storage::url($this->path);
    }
}
