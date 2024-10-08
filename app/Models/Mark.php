<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Exam;
use App\Models\User;

class Mark extends Model
{
    use HasFactory;

     protected $fillable = [
        'marks',
        'student_id',
        'class_id',
        'section_id',
        'course_id',
        'exam_id',
        'session_id'
    ];


    /**
     * Get the student for attendances.
     */
    public function student()
    {
        return $this->belongsTo(UserProfile::class, 'student_id','user_id');
    }


    /**
     * Get the student for attendances.
     */
    public function rule()
    {
        return $this->hasOne(ExamRule::class, 'exam_id','exam_id');
    }


    /**
     * Get the schoolClass.
     */
    public function schoolClass() {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    /**
     * Get the section.
     */
    public function section() {
        return $this->belongsTo(Section::class, 'section_id');
    }

    /**
     * Get the course.
     */
    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Get the exam.
     */
    public function exam() {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
}
