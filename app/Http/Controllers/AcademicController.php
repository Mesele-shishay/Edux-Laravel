<?php 
namespace App\Http\controllers;

use App\Traits\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\AttendanceTypeUpdateRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\SectionRepositoryInterface;
use App\Repositories\Interfaces\SemesterRepositoryInterface;
use App\Repositories\Interfaces\SchoolClassRepositoryInterface;
use App\Repositories\Interfaces\SchoolSessionRepositoryInterface;
use App\Repositories\Interfaces\AcademicSettingRepositoryInterface;

class AcademicController extends Controller
{
	use UserProfile;

    protected $academicSettingRepository;
    protected $schoolSessionRepository;
    protected $schoolClassRepository;
    protected $schoolSectionRepository;
    protected $userRepository;
    protected $courseRepository;
    protected $semesterRepository;

    public function __construct(
        AcademicSettingRepositoryInterface $academicSettingRepository,
        SchoolClassRepositoryInterface $schoolClassRepository,
        SectionRepositoryInterface $schoolSectionRepository,
        UserRepositoryInterface $userRepository,
        CourseRepositoryInterface $courseRepository,
        SemesterRepositoryInterface $semesterRepository,
        SchoolSessionRepositoryInterface $schoolSessionRepository

    ) {

        $this->academicSettingRepository = $academicSettingRepository;
        $this->schoolSessionRepository = $schoolSessionRepository;
        $this->schoolClassRepository = $schoolClassRepository;
        $this->schoolSectionRepository = $schoolSectionRepository;
        $this->userRepository = $userRepository;
        $this->courseRepository = $courseRepository;
        $this->semesterRepository = $semesterRepository;
    }


    public function index(Request $request, Response $response)
    {
        $current_school_session_id = $this->getSchoolCurrentSession();

        $latest_school_session = $this->schoolSessionRepository->getLatestSession();

        $academic_setting = $this->academicSettingRepository->getAcademicSetting();

        $school_sessions = $this->schoolSessionRepository->getAll();

        $school_classes = $this->schoolClassRepository->getAllBySession($current_school_session_id);

        $school_sections = $this->schoolSectionRepository->getAllBySession($current_school_session_id);

        $teachers = $this->userRepository->getAllTeachers();

        $courses = $this->courseRepository->getAll($current_school_session_id);

        $semesters = $this->semesterRepository->getAll($current_school_session_id);

        $data = [
            'current_school_session_id' => $current_school_session_id,
            'latest_school_session_id'  => $latest_school_session->id,
            'academic_setting'          => $academic_setting,
            'school_sessions'           => $school_sessions,
            'school_classes'            => $school_classes,
            'school_sections'           => $school_sections,
            'teachers'                  => $teachers,
            'courses'                   => $courses,
            'semesters'                 => $semesters,
        ];
        return view('academics.settings',$data);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  AttendanceTypeUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAttendanceType(AttendanceTypeUpdateRequest $request)
    {
        try {
            $this->academicSettingRepository->updateAttendanceType($request->validated());

            return back()->with('status', 'Attendance type update was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function updateFinalMarksSubmissionStatus(Request $request) {
        try {
            $this->academicSettingRepository->updateFinalMarksSubmissionStatus($request);
            return back()->with('status', 'Final marks submission status update was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }


}
