<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public $fillable = [
        'locale',
        'name',
        'active'
    ];
}
