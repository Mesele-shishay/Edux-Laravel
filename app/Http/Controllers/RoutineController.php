<?php 
namespace App\Http\controllers;

use App\Models\Routine;
use App\Traits\UserProfile;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\RoutineRepository;
use App\Http\Requests\RoutineStoreRequest;
use App\Repositories\Interfaces\SchoolClassRepositoryInterface;
use App\Repositories\Interfaces\SchoolSessionRepositoryInterface;

class RoutineController extends Controller
{
	use UserProfile;

    protected $schoolSessionRepository;
    protected $schoolClassRepository;

    public function __construct(
        SchoolSessionRepositoryInterface $schoolSessionRepository,
        SchoolClassRepositoryInterface $schoolClassRepository)
    {
        $this->schoolSessionRepository = $schoolSessionRepository;
        $this->schoolClassRepository = $schoolClassRepository;
    }

    /***
     * Score page Only for Students
     * */
    public function create()
    {
        $current_school_session_id = $this->getSchoolCurrentSession();
        $school_classes = $this->schoolClassRepository->getAllBySession($current_school_session_id);

        $data = [
            'current_school_session_id' => $current_school_session_id,
            'classes'                   => $school_classes,
        ];

        return view('routines.create', $data);
    }

   /**
     * Store a newly created resource in storage.
     *
     * @param  RoutineStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoutineStoreRequest $request)
    {
        try {
            $routineRepository = new RoutineRepository();
            $routineRepository->saveRoutine($request->validated());

            return back()->with('status', 'Routine save was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $routine
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $class_id = $request->query('class_id', 0);
        $section_id = $request->query('section_id', 0);
        $current_school_session_id = $this->getSchoolCurrentSession();
        $routineRepository = new RoutineRepository();
        $routines = $routineRepository->getAll($class_id, $section_id, $current_school_session_id);
        $routines = $routines->sortBy('weekday')->groupBy('weekday');

        $data = [
            'routines' => $routines
        ];

        return view('routines.show', $data);
    }

}
