<?php 
namespace App\Http\controllers;

use App\Models\User;
use App\Models\Section;
use App\Models\Promotion;
use App\Traits\UserProfile;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\SchoolSession;
use App\Models\StudentParentInfo;
use App\Models\StudentAcademicInfo;
use App\Controllers\ClassController;
use App\Models\UserProfile as Profile;
use App\Repositories\PromotionRepository;
use App\Http\Requests\TeacherStoreRequest;
use App\Http\Requests\StudentStoreRequest;
use App\Repositories\StudentParentInfoRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\SectionRepositoryInterface;
use App\Repositories\Interfaces\SchoolClassRepositoryInterface;
use App\Repositories\Interfaces\SchoolSessionRepositoryInterface;

class UserController extends Controller
{
    use UserProfile;
    use SchoolSession;

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    public function __construct(
        UserRepositoryInterface $userRepository,
        SchoolSessionRepositoryInterface $schoolSessionRepository,
        SchoolClassRepositoryInterface $schoolClassRepository,
        SectionRepositoryInterface $schoolSectionRepository)
    {
        // $this->middleware(['can:view users']);

        $this->userRepository = $userRepository;
        $this->schoolSessionRepository = $schoolSessionRepository;
        $this->schoolClassRepository = $schoolClassRepository;
        $this->schoolSectionRepository = $schoolSectionRepository;
    }


    public function storeTeacher(TeacherStoreRequest $request)
    {

        $student = $this->userRepository->createTeacher($request);

        // finally redirect to .....
        return back()->with('status',"Teacher successfully registered.");
    }

    public function storeStudent(StudentStoreRequest $request)
    {

        $student = $this->userRepository->createStudent($request);

        // finally redirect to .....
        return back()->with('status',"Student successfully registered.");
    }

    public function createStudent()
    {
        $current_school_session_id = $this->getSchoolCurrentSession();

        $school_classes = $this->schoolClassRepository->getAllBySession($current_school_session_id);

        $data = [
            'current_school_session_id' => $current_school_session_id,
            'school_classes'            => $school_classes,
        ];

        return view('students.add', $data);
    }

    public function createTeacher()
    {

        return view("teachers.add");
    }


    public function assignClassSection($request, $student_id)
    {
        try{
            Promotion::create([
                'student_id'    => $student_id,
                'session_id'    => $request['session_id'],
                'class_id'      => $request['class_id'],
                'section_id'    => $request['section_id'],
                'id_card_number'=> $request['id_card_number'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to add Student. '.$e->getMessage());
        }
    }

    public function getStudentList(Request $request)
    {
        $current_school_session_id = $this->getSchoolCurrentSession();

        $class_id = $request->query('class_id', 0);
        $section_id = $request->query('section_id', 0);

        try{

            $school_classes = $this->schoolClassRepository->getAllBySession($current_school_session_id);

            $studentList = $this->userRepository->getAllStudents($current_school_session_id, $class_id, $section_id);

            $data = [
                'studentList'       => $studentList,
                'school_classes'    => $school_classes,
            ];

            return view('students.list', $data);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }


    public function showStudentProfile($id)
    {
        $student = $this->userRepository->findStudent($id);

        $current_school_session_id = $this->getSchoolCurrentSession();
        $promotionRepository = new PromotionRepository();
        $promotion_info = $promotionRepository->getPromotionInfoById($current_school_session_id, $id);

        $data = [
            'student'           => $student,
            'promotion_info'    => $promotion_info,
        ];

        return view('students.profile', $data);
    }

    public function getTeacherList()
    {
        $teachers = $this->userRepository->getAllTeachers();

        $data = [
            'teachers' => $teachers,
        ];

        return view('teachers.list', $data);
    }

    public function showTeacherProfile($id)
    {
        $teacher = $this->userRepository->findTeacher($id);
        $data = [
            'teacher'   => $teacher,
        ];
        return view('teachers.profile', $data);
    }

    public function editStudent($student_id)
    {
        $student = $this->userRepository->findStudent($student_id);
        $studentParentInfoRepository = new StudentParentInfoRepository();
        $parent_info = $studentParentInfoRepository->getParentInfo($student_id);
        $promotionRepository = new PromotionRepository();
        $current_school_session_id = $this->getSchoolCurrentSession();
        $promotion_info = $promotionRepository->getPromotionInfoById($current_school_session_id, $student_id);

        $data = [
            'student'       => $student,
            'parent_info'   => $parent_info,
            'promotion_info'=> $promotion_info,
        ];
        return view('students.edit', $data);
    }

    public function updateStudent(Request $request)
    {
        try {
            $this->userRepository->updateStudent($request->toArray());

            return back()->with('status', 'Student update was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function editTeacher($teacher_id)
    {
        $teacher = $this->userRepository->findTeacher($teacher_id);

        $data = [
            'teacher'   => $teacher,
        ];

        return view('teachers.edit', $data);
    }

    public function updateTeacher(Request $request)
    {
        try {
            $this->userRepository->updateTeacher($request->toArray());

            return back()->with('status', 'Teacher update was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }


}
