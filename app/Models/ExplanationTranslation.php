<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExplanationTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'sub_title',
        'description',
        'illustration_title',
        'illustration_desc',
        'illustration_source'
    ];
}
