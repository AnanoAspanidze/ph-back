<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StepTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'sub_title', 'description'];
}
