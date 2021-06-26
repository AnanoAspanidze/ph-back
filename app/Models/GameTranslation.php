<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'sub_title',
        'instruction',
    ];
}
