<?php

namespace App\Traits;
use App\Repositories\SchoolSessionRepository;
use App\Repositories\SemesterRepository;



trait SchoolSession {
    /**
     * @param string $request
     * 
     * @return string
    */

    public $schoolSessionRepository2;

    public function getSchoolCurrentSession() {
        $this->schoolSessionRepository2 = new schoolSessionRepository();
        $current_school_session_id = 0;

       if (session()->has('browse_session_id')){
           $current_school_session_id = session('browse_session_id');
       } else {

        // dd($this->schoolSessionRepository);
           $latest_school_session = $this->schoolSessionRepository2->getLatestSession();

           if($latest_school_session){
               $current_school_session_id = $latest_school_session->id;
           }
       }

       return $current_school_session_id;
       }


    public function getSchoolCurrentSemesterId() {
        $semesterRepository = new SemesterRepository();
        $current_school_semester_id =$semesterRepository->getLattest($this->getSchoolCurrentSession())?? 0;
        if ($current_school_semester_id) {
            return $current_school_semester_id->id;
        }
        return $current_school_semester_id;
    }
}