<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Storage;


class AboutImg extends Model
{
    use Translatable;
    
    public $timestamps = false;
    public $translatedAttributes = ['title', 'file_name'];
    
    protected $fillable = [
        'illustration',
        'about_id',
        'active'
    ];

    private $path = 'public/aboutIllustration';

    public function about() {
        return $this->belongsTo(About::class, 'about_id');
    }

    public function getUrlPath() {
        return Storage::url($this->path);
    }
}