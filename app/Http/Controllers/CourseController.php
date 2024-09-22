<?php 
namespace App\Http\controllers;

use App\Models\Course;
use App\Traits\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\CourseStoreRequest;
use App\Repositories\PromotionRepository;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\SchoolSessionRepositoryInterface;
use App\Repositories\Interfaces\PromotionRepositoryInterface;
use App\Repositories\Interfaces\SemesterRepositoryInterface;
use App\Repositories\Interfaces\MarkRepositoryInterface;




class CourseController extends Controller
{
    use UserProfile;

    protected $schoolCourseRepository;
    protected $schoolSessionRepository;
    protected $semesterRepository;
    protected $markRepository;



    /**
    * Create a new Controller instance
    *
    * @param CourseInterface $schoolCourseRepository
    * @return void
    */
    public function __construct(
        SchoolSessionRepositoryInterface $schoolSessionRepository,
        CourseRepositoryInterface $schoolCourseRepository,
        PromotionRepositoryInterface $promotionRepository,
        SemesterRepositoryInterface $semesterRepository,
        MarkRepositoryInterface $markRepository)
    {
        $this->schoolSessionRepository = $schoolSessionRepository;
        $this->schoolCourseRepository = $schoolCourseRepository;
        $this->promotionRepository = $promotionRepository;
        $this->semesterRepository = $semesterRepository;
        $this->markRepository = $markRepository;



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CourseStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseStoreRequest $request)
    {
        try {
            $this->schoolCourseRepository->create($request->validated());

            return back()->with('status', 'Course creation was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  $course_id
     * @return \Illuminate\Http\Response
     */
    public function edit($course_id)
    {
        $current_school_session_id = $this->getSchoolCurrentSession();

        $course = $this->schoolCourseRepository->findById($course_id);

        $data = [
            'current_school_session_id' => $current_school_session_id,
            'course'                    => $course,
            'course_id'                 => $course_id,
        ];

        return view('courses.edit', $data);
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
            $this->schoolCourseRepository->update($request);

            return back()->with('status', 'Course update was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }


    public function getStudentScores(Request $request)
    {
        $student_id = auth()->user()->id;
        $current_school_session_id = $this->getSchoolCurrentSession();
        $promotionRepository = $this->promotionRepository;
        $class_info = $promotionRepository->getPromotionInfoById($current_school_session_id, $student_id);
        $courses = $this->schoolCourseRepository->getByClassId($class_info->class_id);

        $course_id = $class_info->id;
        $semester_id = $class_info->semester_id;
        $class_id = $class_info->class_id;
        $section_id = $class_info->section_id;

        $current_school_semester = $this->semesterRepository;
        $current_school_semester = $current_school_semester->getLattest($current_school_session_id);
        $marks = $this->markRepository->getAllByStudentIdNoCourse($current_school_session_id, $class_id, $section_id, $student_id);
        $data = [
            'class_info'                      => $class_info->toArray(),
            'courses'                         => $courses,
            'current_school_semester'         =>$current_school_semester,
        ];
        return view('score.index', $data);
    }


/**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStudentCourses($student_id)
    {
        $current_school_session_id = $this->getSchoolCurrentSession();
        $promotionRepository = new PromotionRepository();
        $class_info = $promotionRepository->getPromotionInfoById($current_school_session_id, $student_id);
        $courses = $this->schoolCourseRepository->getByClassId($class_info->class_id);

        $data = [
            'class_info'    => $class_info,
            'courses'       => $courses,
        ];
        return view('courses.student', $data);
    }
}
