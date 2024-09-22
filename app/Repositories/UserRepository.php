<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\UserProfile;
use App\Traits\Base64ToFile;
use App\Interfaces\UserInterface;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Repositories\PromotionRepository;
use App\Repositories\StudentParentInfoRepository;
use App\Repositories\StudentAcademicInfoRepository;

use App\Notifications\WelcomeEmailNotfication;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserRepository implements UserRepositoryInterface {

    /**
     * @param mixed $request
     * @return string
    */
    public function createTeacher($request) {

        $email_suffix = config('app.name');
        $app_domain = config('app.domain');

        // Unique temporary password
        $tmp_pass = uniqid("U");

        try {
            DB::transaction(function () use ($request,$tmp_pass,$email_suffix,$app_domain) {

                $user = User::create([
                    'email'    => uniqid("U"),
                    'password' => bcrypt($tmp_pass),
                ]);

                // Assign role student
                $user->assignRole(['teacher']);

                // get last inserted id
                $user_id = $user->id;

                // updating the email using last inserted id
                $user->update([
                    'email' => $request->fname.$request->lname.$user_id.'@'.$email_suffix.$app_domain,
                ]);

                // splitting current date in to Two chunk arrays and used for generating id number
                $tempId = str_split(date('Y'),2);

                // if user's Field type is Natural add RNS prefix else add RSS
                $idNumber = ($request->field == "Natural") ? 'RNS/'.$user_id.'/'.$tempId[1] : 'RSS/'.$user_id.'/'.$tempId[1];

                // current user profile
                $userProfile = $user->profile();

                // retrieving email of current user
                $userEmail = $user->email;
                // dd($request->validated());
                // Uploading profile picture to the system and returns file name
                $photoPath = time().Str::random(10).'.'.$request->teacher_photo->getClientOriginalExtension();
                $path = Storage::disk('public')->put('profiles',$request->teacher_photo);

                // create profile details for current user
                $userProfile = $userProfile->create([
                    'user_id'=>$user_id,
                    'first_name'=>$request->fname,
                    'last_name'=>$request->lname,
                    'birth_date'=>$request->birthDate,
                    'gender'=>$request->gender,
                    'zone'=>$request->zone,
                    'role'=>$request->role,
                    'field'=>$request->field,
                    'woreda'=>$request->woreda,
                    'phone_number'=>$request->phoneNumber,
                    'id_number'=>$idNumber,
                    'image'=>$path,
                ]);

                $user->givePermissionTo(
                    'create exams',
                    'view exams',
                    'create exams rule',
                    'view exams rule',
                    'edit exams rule',
                    'delete exams rule',
                    'take attendances',
                    'view attendances',
                    'create assignments',
                    'view assignments',
                    'save marks',
                    'view users',
                    'view routines',
                    'view syllabi',
                    'view events',
                    'view notices',
                );

                $creds = ['email'=>$user->email,'password'=>$tmp_pass];
                // dd($creds);
                $user->notify(new WelcomeEmailNotfication($creds));
            });
        } catch (\Exception $e) {
            throw new \Exception('Failed to create Teacher. '.$e->getMessage());
        }
    }

    /**
     * @param mixed $request
     * @return string
    */
    public function createStudent($request) {

        $email_suffix = config('app.name');
        $app_domain = config('app.domain');


        $student_photo = $request->file('student_photo');

        // Unique temporary password
        $tmp_pass = uniqid("U");

        try {
            $user = DB::transaction(function () use ($request,$tmp_pass,$email_suffix,$app_domain) {

                $user = User::create([
                    'email'    => uniqid("U"),
                    'password' => bcrypt($tmp_pass),
                ]);

                // Assign role student
                $user->assignRole(['student']);

                // get last inserted id
                $user_id = $user->id;

                // updating the email using last inserted id
                $user->update([
                    'email' => $request->fname.$request->lname.$user_id.'@'.$email_suffix.$app_domain,
                ]);

                // splitting current date in to Two chunk arrays and used for generating id number
                $tempId = str_split(date('Y'),2);

                // if user's Field type is Natural add RNS prefix else add RSS
                $idNumber = ($request->field == "Natural") ? 'RNS/'.$user_id.'/'.$tempId[1] : 'RSS/'.$user_id.'/'.$tempId[1];

                // current user profile
                $userProfile = $user->profile();

                // retrieving email of current user
                $userEmail = $user->email;

                // Uploading profile picture to the system and returns file name
                $photoPath = time().Str::random(10).'.'.$request->student_photo->getClientOriginalExtension();
                $path = Storage::disk('public')->put('profiles',$request->student_photo);

                // create profile details for current user
                $userProfile = $userProfile->create([
                    'user_id'=>$user_id,
                    'first_name'=>$request->fname,
                    'last_name'=>$request->lname,
                    'birth_date'=>$request->birthDate,
                    'gender'=>$request->gender,
                    'zone'=>$request->zone,
                    'role'=>$request->role,
                    'field'=>$request->field,
                    'woreda'=>$request->woreda,
                    'phone_number'=>$request->phoneNumber,
                    'id_number'=>$idNumber,
                    'image'=>$path,
                ]);



                // Store Parents' information
                $studentParentInfoRepository = new StudentParentInfoRepository();
                $studentParentInfoRepository->store($request, $user->id);

                // Store Academic information
                $studentAcademicInfoRepository = new StudentAcademicInfoRepository();
                $studentAcademicInfoRepository->store($request, $user->id);
                // dd($user->id);
                // Assign student to a Class and a Section
                $promotionRepository = new PromotionRepository();
                $promotionRepository->assignClassSection($request, $user->id);

                $user->givePermissionTo(
                    'view attendances',
                    'view assignments',
                    'submit assignments',
                    'view exams',
                    'view marks',
                    'view users',
                    'view routines',
                    'view syllabi',
                    'view events',
                    'view notices',
                );

                // dd($user);
                $creds = ['email'=>$user->email,'password'=>$tmp_pass];
                // dd($creds);
                $user->notify(new WelcomeEmailNotfication($creds));
            });

        } catch (\Exception $e) {
            throw new \Exception('Failed to create Student. '.$e->getMessage());
        }
    }

    public function updateStudent($request) {
        try {
            UserProfile::where('user_id', $request['student_id'])->update([
                'first_name'    => $request['first_name'],
                'last_name'     => $request['last_name'],
                'gender'        => $request['gender'],
                'phone_number'         => $request['phone_number'],
                'woreda'       => $request['woreda'],
                'birth_date'      => $request['birth_date'],
            ]);

            // Update Parents' information
            $studentParentInfoRepository = new StudentParentInfoRepository();
            $studentParentInfoRepository->update($request, $request['student_id']);

            // Update Student's ID card number
            $promotionRepository = new PromotionRepository();
            $promotionRepository->update($request, $request['student_id']);

        } catch (\Exception $e) {
            throw new \Exception('Failed to update Student. '.$e->getMessage());
        }
    }

    public function updateTeacher($request) {
        try {
            UserProfile::where('user_id', $request['teacher_id'])->update([
                'first_name'    => $request['first_name'],
                'last_name'     => $request['last_name'],
                'gender'        => $request['gender'],
                'phone_number'         => $request['phone_number'],
                'woreda'       => $request['woreda'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to update Teacher. '.$e->getMessage());
        }
    }

    public function getAllStudents($session_id, $class_id, $section_id) {
        if($class_id == 0 || $section_id == 0) {
            $schoolClass = SchoolClass::where('session_id', $session_id)
                                    ->first();
            $section = Section::where('session_id', $session_id)
                                    ->first();
            if($schoolClass == null || $section == null){
                throw new \Exception('There is no class and section');
            } else {
                $class_id = $schoolClass->id;
                $section_id = $section->id;
            }

        }
        try {
            $promotionRepository = new PromotionRepository();
            return $promotionRepository->getAll($session_id, $class_id, $section_id);
        } catch (\Exception $e) {
            throw new \Exception('Failed to get all Students. '.$e->getMessage());
        }
    }

    public function getAllStudentsBySession($session_id) {
        $promotionRepository = new PromotionRepository();
        return $promotionRepository->getAllStudentsBySession($session_id);
    }

    public function getAllStudentsBySessionCount($session_id) {
        $promotionRepository = new PromotionRepository();
        return $promotionRepository->getAllStudentsBySessionCount($session_id);
    }

    public function findStudent($id) {
        try {
            return User::with('parent_info', 'academic_info','profile')->where('id', $id)->first();
        } catch (\Exception $e) {
            throw new \Exception('Failed to get Student. '.$e->getMessage());
        }
    }

    public function findTeacher($id) {
        try {
            return UserProfile::where('user_id', $id)->where('role', 'teacher')->first();
        } catch (\Exception $e) {
            throw new \Exception('Failed to get Teacher. '.$e->getMessage());
        }
    }

    public function getAllTeachers() {
        try {
            return UserProfile::where('role', 'teacher')->get();

        } catch (\Exception $e) {
            throw new \Exception('Failed to get all Teachers. '.$e->getMessage());
        }
    }

    public function changePassword($new_password) {
        try {
            return User::where('id', auth()->user()->id)->update([
                'password'  => password_hash($new_password,PASSWORD_DEFAULT)
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to change password. '.$e->getMessage());
        }
    }

    public function registerAdmin($request){
        $user = User::create([
                    'email' =>$request->admin_email,
                    'password' =>bcrypt($request->admin_password),
                        ]);
        $user->role = 'admin';
        $user->assignRole('admin');
        $user->givePermissionTo(
            'create school sessions',
            'update browse by session',
            'create semesters',
            'edit semesters',
            'assign teachers',
            'create courses',
            'view courses',
            'edit courses',
            'create classes',
            'view classes',
            'edit classes',
            'create sections',
            'view sections',
            'edit sections',
            'create exams',
            'view exams',
            'create exams rule',
            'edit exams rule',
            'delete exams rule',
            'view exams rule',
            'create routines',
            'view routines',
            'edit routines',
            'delete routines',
            'view marks',
            'view academic settings',
            'update marks submission window',
            'create users',
            'edit users',
            'view users',
            'promote students',
            'update attendances type',
            'view attendances',
            'take attendances',//Teacher only
            'create grading systems',
            'view grading systems',
            'edit grading systems',
            'delete grading systems',
            'create grading systems rule',
            'view grading systems rule',
            'edit grading systems rule',
            'delete grading systems rule',
            'create notices',
            'view notices',
            'edit notices',
            'delete notices',
            'create events',
            'view events',
            'edit events',
            'delete events',
            'create syllabi',
            'view syllabi',
            'edit syllabi',
            'delete syllabi',
            'view assignments'
        );

        $user->save();

        $profile = UserProfile::create([
                            'user_id'    => $user->id,
                            'first_name' => $request->admin_first_name,
                            'last_name'  => $request->admin_last_name,
        ]);

        $profile->save();
    }
}
