<?php

namespace App\Repositories;

use App\Repositories\Interfaces\AcademicSettingRepositoryInterface;
use App\Models\AcademicSetting;


class AcademicSettingRepository implements AcademicSettingRepositoryInterface
{
    public function getAcademicSetting(){
        return AcademicSetting::find(1);
    }

    public function updateAttendanceType($request) {
        try {
            AcademicSetting::where('id', 1)->update(['attendance_type'=>$request['attendance_type'] ?? "section"]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to update attendance type. '.$e->getMessage());
        }
    }

    public function updateFinalMarksSubmissionStatus($request) {
        $status = "off";
        if(isset($request['marks_submission_status'])) {
            $status = "on";
        }
        try {
            AcademicSetting::where('id', 1)->update(['marks_submission_status' => $status]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to update final marks submission status. '.$e->getMessage());
        }
    }
}
