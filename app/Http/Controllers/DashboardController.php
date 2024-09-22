<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Notice;
use App\Models\Section;
use App\Models\Semester;
use App\Traits\UserProfile;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\SchoolSession;
use App\Http\Controllers\Controller;
use App\Models\UserProfile as Profile;
use App\Repositories\CourseRepository;;
use App\Repositories\PromotionRepository;

class DashboardController extends Controller
{
    use UserProfile;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        switch ($role = auth()->user()->role) {
            case 'admin':
            case 'sa':
            $current_school_session_id = $this->getSchoolCurrentSession();
            $chart = [
                'students' => [],
                'teachers' => [],
            ];
            foreach (Profile::all()->where('role','student')->groupBy(function($c){return Carbon::parse($c['created_at'])->isoFormat('Y'); }) as $key => $value) { $chart['students'][$key] = count($value); }
            foreach (Profile::all()->where('role','teacher')->groupBy(function($c){return Carbon::parse($c['created_at'])->isoFormat('Y'); }) as $key => $value) { $chart['teachers'][$key] = count($value); }
                $data = [
                    'current_school_session_id' => $current_school_session_id,
                        'students' => [
                            'males' => Profile::where('role','student')
                                ->where('gender','Male')
                                ->count(),
                            'females' =>Profile::where('role','student')
                                ->where('gender','Female')
                                ->count(),
                            'total' => Profile::where('role','student')
                                ->count(),
                        ],
                        'teachers' => [
                            'males' => Profile::where('role','teacher')
                                ->where('gender','Male')
                                ->count(),
                            'females' =>Profile::where('role','teacher')
                                ->where('gender','Female')
                                ->count(),
                            'total' => Profile::where('role','teacher')
                                ->count(),
                        ],

                        'classes' => SchoolClass::where('session_id',$current_school_session_id)->get(),
                        'sections' => Section::where('session_id',$current_school_session_id)->get(),

                    'notices' => \App\Models\Notice::all(),
                    'chartData' => [
                        'students' => json_encode($chart['students']),
                        'teachers' => json_encode($chart['teachers']),
                    ]];
                return view('dashboard.admin',$data);
            case 'student':
                $promotionRepository = new PromotionRepository();
                $academicInfo = $promotionRepository->getPromotionInfoById($this->getSchoolCurrentSession(),auth()->user()->id);

                $class_id = $academicInfo['section']['class_id'];
                $session_id = $this->getSchoolCurrentSession();
                $section_id = $academicInfo['section_id'];
                $class_id = $academicInfo['class_id'];
                $semester_id = $this->getSchoolCurrentSemesterId();
                $courseRepository = new CourseRepository();
                $courses = $courseRepository->getBySession($session_id,$class_id,$semester_id);

                $data = [
                    'user' => [
                        'profile' => auth()->user()->profile,
                        'academic_info' => $academicInfo,
                        'role' =>auth()->user()->role,
                        'courses' => $courses,
                        'schoolClass' => SchoolClass::find($academicInfo['section']['class_id']),
                    ]

                ];
                return view('dashboard.student',$data);
            case 'teacher':
                $user = auth()->user();
                return view('dashboard.teacher',compact('user'));
            default:
                auth()->logout();
                return back()->withError("You're not supposed to be here!");
        }
    }
}
