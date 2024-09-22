<?php

namespace App\Repositories;

use App\Repositories\Interfaces\AssignedTeacherRepositoryInterface;
use App\Models\Semester;
use App\Models\AssignedTeacher;

class AssignedTeacherRepository implements AssignedTeacherRepositoryInterface
{
     public function assign($request) {
        try {
            AssignedTeacher::create($request);
        } catch (\Exception $e) {
            throw new \Exception('Failed to assign teacher. '.$e->getMessage());
        }
    }

    public function getTeacherCourses($session_id, $teacher_id, $semester_id) {
        if($semester_id == 0) {

            $semester_id = Semester::where('session_id', $session_id)
                                    ->first()->id ?? 0;
        }
        return AssignedTeacher::with(['course', 'schoolClass', 'section'])
                                ->where('session_id', $session_id)
                                ->where('teacher_id', $teacher_id)
                                ->where('semester_id', $semester_id)
                                ->get()
                                ->unique('course_id');
    }


    public function getTeacherCoursesByClassId($session_id, $teacher_id, $semester_id,$class_id) {
        if($semester_id == 0) {
            $semester_id = Semester::where('session_id', $session_id)
                                    ->first()->id;
        }
        return AssignedTeacher::with(['course', 'schoolClass', 'section'])
                                ->where('session_id', $session_id)
                                ->where('teacher_id', $teacher_id)
                                ->where('semester_id', $semester_id)
                                ->where('class_id', $class_id)
                                ->get()
                                ->unique('course_id');
    }

    public function getAssignedTeacher($session_id, $semester_id, $class_id, $section_id, $course_id) {
        if($semester_id == 0) {

            $semester_id = Semester::where('session_id', $session_id)
                                    ->first()->id;
        }
        return AssignedTeacher::where('session_id', $session_id)
                                ->where('semester_id', $semester_id)
                                ->where('class_id', $class_id)
                                ->where('section_id', $section_id)
                                ->where('course_id', $course_id)
                                ->first();
    }
}
