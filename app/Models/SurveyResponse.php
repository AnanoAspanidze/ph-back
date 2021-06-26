<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    protected $fillable = [
        'survey_id',
        'question_id',
        'answer_id',
        'text'
    ];

    public function survey() {
        return $this->belongsTo(Game::class, 'survey_id');
    }

    public function question() {
        return $this->belongsTo(Game::class, 'question_id');
    }

    public function answer() {
        return $this->belongsTo(Game::class, 'answer_id');
    }
}
