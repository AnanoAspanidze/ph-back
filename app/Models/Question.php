<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use Translatable;
    
    public $translatedAttributes = [
        'title',
        'purpose'
    ];

    protected $fillable = [
        'game_id',
        'type',
        'active',
    ];

    public $timestamps = false;

    public function game() {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function surveyResponse() {
        return $this->hasMany(SurveyResponse::class);
    }
}
