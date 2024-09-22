<?php

namespace App\Repositories;

use App\Repositories\Interfaces\StudentAcademicInfoRepositoryInterface;
use App\Models\StudentAcademicInfo;


class StudentAcademicInfoRepository implements StudentAcademicInfoRepositoryInterface
{
    public function store($request, $student_id) {
        try {
            return StudentAcademicInfo::create([
                'student_id'        => $student_id,
                'board_reg_no'      => $request['board_reg_no'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to create Student academic information. '.$e->getMessage());
        }
    }
}
