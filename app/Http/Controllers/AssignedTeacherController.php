<?php 
namespace App\Http\controllers;

use App\Traits\UserProfile;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use Illuminate\Http\Response;
use App\Models\AssignedTeacher;
use App\Http\Requests\TeacherAssignRequest;
use App\Repositories\AssignedTeacherRepository;
use App\Repositories\Interfaces\SemesterRepositoryInterface;
use App\Repositories\Interfaces\SchoolSessionRepositoryInterface;

class AssignedTeacherController extends Controller
{

    use SchoolSession;
    protected $schoolSessionRepository;
    protected $semesterRepository;

    /**
    * Create a new Controller instance
    *
    * @param SchoolSessionInterface $schoolSessionRepository
    * @return void
    */
    public function __construct(
        SchoolSessionRepositoryInterface $schoolSessionRepository,
        SemesterRepositoryInterface $semesterRepository)
    {
        $this->schoolSessionRepository = $schoolSessionRepository;
        $this->semesterRepository = $semesterRepository;
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  TeacherAssignRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherAssignRequest $request)
    {
        try {
            $assignedTeacherRepository = new AssignedTeacherRepository();
            $assignedTeacherRepository->assign($request->validated());
            return back()->with('status', 'Assigning teacher was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

   /**
     * Display a listing of the resource.
     *
     * @param  CourseStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function getTeacherCourses(Request $request)
    {
        $teacher_id = auth()->user()->id;

        $semester_id = $this->getSchoolCurrentSemesterId();

        if($teacher_id == null) {
            abort(404);
        }
        $current_school_session_id = $this->getSchoolCurrentSession();

        $semesters = $this->semesterRepository->getAll($current_school_session_id);

        $assignedTeacherRepository = new AssignedTeacherRepository();

        if($semester_id == null) {
            $courses = [];
        } else {
            $courses = $assignedTeacherRepository->getTeacherCourses($current_school_session_id, $teacher_id, $semester_id);
        }

        $data = [
            'courses'               => $courses,
            'semesters'             => $semesters,
            'selected_semester_id'  => $semester_id,
        ];

        return view('courses.teacher', $data);
    }

}
