<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntroTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['sub_title', 'description', 'illustration_title', 'illustration_desc', 'illustration_source'];
}