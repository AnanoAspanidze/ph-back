<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use Translatable;
    
    public $translatedAttributes = [
        'answer',
    ];

    protected $fillable = [
        'question_id', 'isRight'
    ];

    public $timestamps = false;

    public function question() {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function surveyResponse() {
        return $this->hasMany(SurveyResponse::class);
    }
}
