<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use App\Models\SchoolClass;

class Attendance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'class_id',
        'section_id',
        'session_id',
        'course_id',
        'status',
    ];

    /**
     * Get the student for attendances.
     */
    public function student()
    {
        return $this->belongsTo(UserProfile::class, 'student_id','user_id');
    }

    /**
     * Get the schoolClass for attendance.
     */
    public function schoolClass() {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    /**
     * Get the section for attendance.
     */
    public function section() {
        return $this->belongsTo(Section::class, 'section_id');
    }

    /**
     * Get the course for attendance.
     */
    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
