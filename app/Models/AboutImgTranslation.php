<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutImgTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'file_name'];
}
