<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Models\Course;
use App\Models\Semester;

class CourseRepository implements CourseRepositoryInterface
{
    public function create($request) {
        try {
            Course::create($request);
        } catch (\Exception $e) {
            throw new \Exception('Failed to create School Course. '.$e->getMessage());
        }
    }

    public function getAll($session_id) {
        return Course::where('session_id', $session_id)->get();
    }

    public function getByClassId($class_id) {
        return Course::where('class_id', $class_id)->with('marks')->get();
    }

    public function getBySession($session_id,$class_id,$semester_id) {
        return Course::where('class_id', $class_id)
                    ->where('session_id',$session_id)
                    ->where('semester_id',$semester_id)
                    ->with('teacher')
                    ->get();
    }

    public function findById($course_id) {
        return Course::find($course_id);
    }

    public function update($request) {
        try {
            Course::find($request['course_id'])->update([
                'course_name'  => $request['course_name'],
                'course_type'  => $request['course_type'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to update Course. '.$e->getMessage());
        }
    }
}
