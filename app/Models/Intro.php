<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Intro extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = ['sub_title', 'description', 'illustration_title', 'illustration_desc', 'illustration_source'];
    protected $fillable = ['hex_code', 'illustration'];
    private $path = 'public/pages/intro';

    public function resource() {
        return $this->morphOne(Resource::class, 'resourceable');
    }

    public function getUrlPath()
    {
        return Storage::url($this->path);
    }
}
