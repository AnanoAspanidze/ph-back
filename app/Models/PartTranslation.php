<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'short_desc',
        'description',
    ];
}
