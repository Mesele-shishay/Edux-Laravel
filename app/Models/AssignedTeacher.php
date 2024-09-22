<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use App\Models\SchoolClass;
class AssignedTeacher extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'teacher_id',
        'semester_id',
        'class_id',
        'section_id',
        'course_id',
        'session_id',
    ];

    /**
     * Get the teacher.
     */
    public function teacher()
    {
        return $this->belongsTo(UserProfile::class, 'teacher_id','user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'teacher_id');
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
}
