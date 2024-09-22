<?php

namespace App\Traits;

use App\Models\User;
use App\Models\Promotion;
use App\Models\Course;
use App\Models\Mark;
use App\Models\UserProfile as Profile;
use App\Models\Section;
use App\Models\Notice;
use App\Models\Semester;
use App\Models\SchoolClass;
use App\Traits\UserScore;
use App\Traits\SchoolSession;
use App\Helpers\Settings;

trait UserProfile {
    use UserScore;
    use SchoolSession;

    /***
     * User profile retriever
     * */
    private function userProfile(User $user)
    {
        // get current user profile
        $userProfile = $user->profile()->first();

        // get current user role
        $userRole = $user->role;

        // get all settings for admins only
        $settings = new Settings();
        $timeZone = $settings->getTimezones();
        $settingsGrouped = $settings->getSettingsByGroup();
        $types = \App\Models\ConfigTypes::orderBy('name')->get();
        $groups = \App\Models\ConfigGroups::all()->toArray();
        $all = \App\Models\Config::orderBy('name')->get();


        if ($userRole == 'student') {
            $academicInfo = container('promotionRepository')->getPromotionInfoById($this->getSchoolCurrentSession(),auth()->user()->id);

            $class_id = $academicInfo['section']['class_id'];
            $session_id = $this->getSchoolCurrentSession();
            $section_id = $academicInfo['section_id'];
            $class_id = $academicInfo['class_id'];
            $semester_id = $this->getSchoolCurrentSemesterId();

            $courses = container('courseRepository')->getBySession($session_id,$class_id,$semester_id);

            $data = [
                'user' => [
                    'profile' => $userProfile->toArray(),
                    'academic_info' => $academicInfo,
                    'role' => $userRole,
                    'courses' => $courses,
                    'schoolClass' => SchoolClass::find($academicInfo['section']['class_id']),
                ]

            ];
            // dd($data);
            return $data;
        }

        if ($userRole == 'admin' or $userRole == 'sa') {
            $userProfile = [
                'user' => [
                    'role' => $userRole,
                    'profile' => $userProfile->toArray(),
                    'sett' => [
                        "settingsGrouped" => $settingsGrouped,
                        "configTypes" => $types,
                        "configGroups" => $groups,
                        "timezones" => $timeZone,
                        "all" =>$all,
                    ]
                ],
            ];

            return $userProfile;
        }

        if ($userRole == 'teacher') {
            $data = [
                'user' => [
                    'profile' => $userProfile,
                    'role' => $userRole,
                ]
            ];
            // dd($data);
            return $data;
        }
    }

}