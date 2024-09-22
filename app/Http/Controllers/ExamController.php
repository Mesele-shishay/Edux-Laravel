<?php 
namespace App\Http\controllers;

use App\Models\Exam;
use App\Models\Semester;
use App\Traits\UserProfile;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\SchoolSession;
use App\Models\AssignedTeacher;
use App\Repositories\ExamRepository;
use App\Http\Requests\ExamStoreRequest;
use App\Repositories\AssignedTeacherRepository;
use App\Repositories\Interfaces\SemesterRepositoryInterface;
use App\Repositories\Interfaces\SchoolClassRepositoryInterface;
use App\Repositories\Interfaces\SchoolSessionRepositoryInterface;

class ExamController extends Controller
{
	use UserProfile;
    use SchoolSession;

    protected $schoolClassRepository;
    protected $semesterRepository;
    protected $schoolSessionRepository;

    public function __construct(
        SchoolSessionRepositoryInterface $schoolSessionRepository,
        SchoolClassRepositoryInterface $schoolClassRepository,
        SemesterRepositoryInterface $semesterRepository)
    {
        $this->schoolSessionRepository = $schoolSessionRepository;
        $this->schoolClassRepository = $schoolClassRepository;
        $this->semesterRepository = $semesterRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $current_school_session_id = $this->getSchoolCurrentSession();

        $semesters = $this->semesterRepository->getAll($current_school_session_id);

        if(auth()->user()->role == "teacher") {
            $teacher_id = auth()->user()->id;
            $assigned_classes = $this->schoolClassRepository->getAllBySessionAndTeacher($current_school_session_id, $teacher_id);

            $school_classes = [];
            $i = 0;

            foreach($assigned_classes as $assigned_class) {
                $school_classes[$i] = $assigned_class->schoolClass;
                $i++;
            }
        } else {
            $school_classes = $this->schoolClassRepository->getAllBySession($current_school_session_id);
        }

        $data = [
            'current_school_session_id' => $current_school_session_id,
            'semesters'                 => $semesters,
            'classes'                   => $school_classes,
        ];

        return view('exams.create', $data);
    }

    public function view(Request $request)
    {
        $class_id = $request->query('class_id', 0);
        $semester_id = $request->query('semester_id', 0);

        $current_school_session_id = $this->getSchoolCurrentSession();

        $semesters = $this->semesterRepository->getAll($current_school_session_id);

        $school_classes = $this->schoolClassRepository->getAllBySession($current_school_session_id);

        $examRepository = new ExamRepository();

        $exams = $examRepository->getAll($current_school_session_id, $semester_id, $class_id);

        $assignedTeacherRepository = new AssignedTeacherRepository();

        $teacher_id = (auth()->user()->role == "teacher")?auth()->user()->id : 0;

        $teacherCourses = $assignedTeacherRepository->getTeacherCourses($current_school_session_id, $teacher_id, $semester_id);

        $data = [
            'current_school_session_id' => $current_school_session_id,
            'semesters'                 => $semesters,
            'classes'                   => $school_classes,
            'exams'                     => $exams,
            'teacher_courses'           => $teacherCourses,
        ];

        return view('exams.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ExamStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamStoreRequest $request)
    {
        try {
            $examRepository = new ExamRepository();
            $examRepository->create($request->validated());

            return back()->with('status', 'Exam creation was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

}
