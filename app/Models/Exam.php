<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Semester;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_name',
        'start_date',
        'end_date',
        'semester_id',
        'class_id',
        'course_id',
        'session_id'
    ];

    /**
     * Get the course.
     */
    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Get the semester.
     */
    public function semester() {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
}
