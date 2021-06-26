<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Storage;

class PageAdditional extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = ['title', 'description', 'source'];
    protected $fillable = [
        'resource_id',
        'topic_id',
        'image',
        'video',
        'sub_type',
        'type',
        'link',
        'pdf',
        'direction',
        'pinned',
        'active'
    ];
    private $path = 'public/additional';

    public function resource() {
        return $this->belongsTo(Resource::class, 'resource_id');
    }

    public function topic() {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function getUrlPath() {
        return Storage::url($this->path);
    }
}
