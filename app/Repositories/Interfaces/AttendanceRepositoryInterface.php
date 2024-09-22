<?php

namespace App\Repositories\Interfaces;

interface AttendanceRepositoryInterface
{
	public function saveAttendance($request);

    public function getSectionAttendance($class_id, $section_id, $session_id);

    public function getCourseAttendance($class_id, $course_id, $session_id);

    public function getStudentAttendance($session_id, $student_id);
}
