<?php 
namespace App\Http\controllers;

use App\Models\Section;
use App\Models\Course;
use App\Traits\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\SectionStoreRequest;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\SectionRepositoryInterface;
use App\Repositories\Interfaces\SchoolSessionRepositoryInterface;
use App\Repositories\Interfaces\AssignedTeacherRepositoryInterface;

class SectionController extends Controller
{
    use UserProfile;
    protected $schoolSectionRepository;
    protected $schoolSessionRepository;
    protected $courseRepository;

    /**
    * Create a new Controller instance
    *
    * @param SectionInterface $schoolSectionRepository
    * @return void
    */
    public function __construct(
        SchoolSessionRepositoryInterface $schoolSessionRepository,
        SectionRepositoryInterface $schoolSectionRepository,
        CourseRepositoryInterface $courseRepository,
        AssignedTeacherRepositoryInterface $assignedTeacherRepository)
    {
        $this->schoolSectionRepository = $schoolSectionRepository;
        $this->schoolSessionRepository = $schoolSessionRepository;
        $this->courseRepository = $courseRepository;
        $this->assignedTeacherRepository = $assignedTeacherRepository;

    }

 /**
     * Store a newly created resource in storage.
     *
     * @param  SectionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionStoreRequest $request)
    {
        try {
            $this->schoolSectionRepository->create($request->validated());

            return back()->with('status', 'Section creation was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function getByClassId(Request $request) {
        $allGetVars = $request->all();
        $course_id =  $allGetVars['course_id'] = 0;
        $class_id = $request->query('class_id', 0);
        if (auth()->user()->role == 'teacher') {
            $teacher_id = auth()->user()->id;
            $session_id = $this->getSchoolCurrentSession();
            $semester_id = $this->getSchoolCurrentSemesterId();

            $school_courses = $this->assignedTeacherRepository->getTeacherCoursesByClassId($session_id, $teacher_id, $semester_id,$class_id);

            $sections = $this->schoolSectionRepository->getAllByClassId($request->query('class_id', 0));

            $courses = [];
            $i = 0;

            foreach($school_courses as $course => $value) {
                $courses[$i] = $value->course;
                $i++;
            }
        }else{
            $sections = $this->schoolSectionRepository->getAllByClassId($request->query('class_id', 0));
            $courses = $this->courseRepository->getByClassId($request->query('class_id', 0));
        }

        return response()->json(['sections' => $sections, 'courses' => $courses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $this->schoolSectionRepository->update($request);

            return back()->with('status', 'Section edit was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param $section_id
     * @return \Illuminate\Http\Response
     */
    public function edit($section_id)
    {
        $current_school_session_id = $this->getSchoolCurrentSession();

        $section = $this->schoolSectionRepository->findById($section_id);

        if ($section == null) {
            return back()->withError('Class section not found');
        }

        $data = [
            'current_school_session_id' => $current_school_session_id,
            'section_id'                => $section_id,
            'section'                   => $section,
        ];
        return view('sections.edit', $data);
    }

}
