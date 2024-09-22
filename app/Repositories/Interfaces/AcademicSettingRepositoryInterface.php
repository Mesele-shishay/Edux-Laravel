<?php

namespace App\Repositories\Interfaces;

interface AcademicSettingRepositoryInterface
{
    public function getAcademicSetting();

    public function updateAttendanceType($request);

    public function updateFinalMarksSubmissionStatus($request);
}
