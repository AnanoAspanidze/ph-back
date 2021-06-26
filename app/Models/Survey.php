<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'game_id',
    ];

    public function game() {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function surveyResponse() {
        return $this->hasMany(SurveyResponse::class);
    }
}
