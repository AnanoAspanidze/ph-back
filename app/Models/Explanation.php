<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Storage;

class Explanation extends Model
{
    use Translatable;
    
    public $translatedAttributes = [
        'title',
        'sub_title',
        'description',
        'illustration_title',
        'illustration_desc',
        'illustration_source'
    ];
    protected $fillable = [
        'resource_id',
        'type',
        'layout',
        'illustration',
        'video',
        'show_steps',
        'active'
    ];
    
    private $path = 'public/pages/explanation';

    public function resource() {
    	return $this->belongsTo(Resource::class, "resource_id");
  	}

    public function getUrlPath()
    {
        return Storage::url($this->path);
    }
}
