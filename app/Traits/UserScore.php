<?php

namespace App\Traits;
use App\Models\User;
use App\Models\UserProfile as Profile;
use App\Models\Section;


use App\Kernel\Helpers\Settings;
use App\Controllers\ScoreController as Score;


trait UserScore {

    /***
     * Student Score retriever
     * */
    public function studentScore($user)
    {
        // get current user score

        $userScore = $user->score()->first()->toArray();
        $field = $user->profile()->first()->toArray()['field'];
        $subjects = $user->score()->first()->subjects($field);

        $cleanUserScore = [];
        $cleanUserScoreSepareted = [];

        foreach ($userScore as $subject => $value) {
            if (in_array($subject,$subjects)) {
                $cleanUserScore[$subject] = $value;
            }
        }
        $keysForResult = array('from_10','from_15','from_25','from_50','from_100');
        $keysForInstructor = array('name','email');
        $finaResult = [];

        foreach ($cleanUserScore as $subject => $value) {
            $exploded = explode('|',$value);
            $semister_1 = [];
            $semister_2 = [];
            $instructor = [];
           foreach ($exploded as $key => $value) {
               if ($key == 0) {
                   $explodedNew = explode(',',$value);
                   $explodedNew = array_combine($keysForResult,$explodedNew);
                   $semister_1 = $explodedNew;
               }else if ($key == 1) {
                   $explodedNew = explode(',',$value);
                   $explodedNew = array_combine($keysForResult,$explodedNew);
                   $semister_2 = $explodedNew;

               }else if ($key == 2) {
                   $explodedNew = explode(',',$value);
                   $explodedNew = array_combine($keysForInstructor,$explodedNew);
                   $instructor = $explodedNew;
               }else{
                $this->auth->logout();
                $this->flash('fail','Something went wrong while rendering your results');
                return $this->redirect($response,'home');
               }
           }

            $final = [
                'semister_1' => $semister_1,
                'semister_2' => $semister_2,
                'instructor' => $instructor,

            ];
            $finaResult[$subject] = $final;
        }
        return $finaResult;
    }

}