<?php 
namespace App\Http\controllers;

use App\Models\Semester;
use App\Models\SchoolClass;
use App\Traits\UserProfile;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Models\GradingSystem;
use Illuminate\Http\Response;
use App\Repositories\GradingSystemRepository;
use App\Http\Requests\GradingSystemStoreRequest;
use App\Repositories\Interfaces\SemesterRepositoryInterface;
use App\Repositories\Interfaces\SchoolClassRepositoryInterface;
use App\Repositories\Interfaces\SchoolSessionRepositoryInterface;

class GradingSystemController extends Controller
{
	use UserProfile;
    use SchoolSession;

    protected $schoolClassRepository;
    protected $schoolSessionRepository;
    protected $semesterRepository;

    public function __construct(
        SchoolSessionRepositoryInterface $schoolSessionRepository,
        SchoolClassRepositoryInterface $schoolClassRepository,
        SemesterRepositoryInterface $semesterRepository)
    {
        $this->schoolSessionRepository = $schoolSessionRepository;
        $this->schoolClassRepository = $schoolClassRepository;
        $this->semesterRepository = $semesterRepository;
    }

    /***
     * Feedback page
     * */
    public function create()
    {
        $current_school_session_id = $this->getSchoolCurrentSession();
        $school_classes = $this->schoolClassRepository->getAllBySession($current_school_session_id);
        $semesters = $this->semesterRepository->getAll($current_school_session_id);

        $data = [
            'current_school_session_id' => $current_school_session_id,
            'school_classes'            => $school_classes,
            'semesters'                 => $semesters,
        ];

        return view('exams.grade.create', $data);
    }


   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $gradingSystemRepository = new GradingSystemRepository();
        $current_school_session_id = $this->getSchoolCurrentSession();
        $gradingSystems = $gradingSystemRepository->getAll($current_school_session_id);

        $data = [
            'gradingSystems'            => $gradingSystems,
            'current_school_session_id' => $current_school_session_id,
        ];

        return view('exams.grade.view', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GradingSystemStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradingSystemStoreRequest $request)
    {
        try {
            $gradingSystemRepository = new GradingSystemRepository();
            $gradingSystemRepository->store($request->validated());

            return back()->with('status', 'Creating grading system was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }


}
