<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'sub_title', 'description', 'resource'];
}
