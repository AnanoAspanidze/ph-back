<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseDetail extends Model
{
    protected $fillable = [
        'course_id',
        'user_id',
        'status',
        'parts',
    ];

    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
