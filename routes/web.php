<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FeedBacksController;
use App\Http\Controllers\Installer\WelcomeController;
use App\Http\Controllers\Installer\EnvironmentController;
use App\Http\Controllers\Installer\RequirementsController;
use App\Http\Controllers\Installer\PermissionsController;
use App\Http\Controllers\Installer\DatabaseController;
use App\Http\Controllers\Installer\FinalController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SystemSettingsController;
use App\Http\Controllers\Auth\UpdatePasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Ajax and CSRF Routes
Route::prefix('ajax')->group(function(){
    Route::post('config-delete',[SystemSettingsController::class,"delete"])
        ->name('config-delete');

    Route::post('config-edit',[SystemSettingsController::class,"edit"])
        ->name('config-edit');

    Route::post('password/change',[UpdatePasswordController::class,"update"])
        ->name('password.change');

});

// Login Routes
Auth::routes();

Route::middleware(['can_start'])->group(function () {

    // Home Route
    Route::get('/',function(){
        return view('home');
    })->name('home');

    Route::post('/contact',[FeedBacksController::class,'store'])->name('contact');

});

// Installation Wizard Routs
Route::middleware('install')->prefix('install')->name('install.')->group(function () {

    // Installation Routes
    Route::get('/',[WelcomeController::class,'welcome'])
        ->name('welcome');

    Route::get('requirements',[RequirementsController::class,'requirements'])
        ->name('requirements');


    Route::get('permissions',[PermissionsController::class,'permissions'])
        ->name('permissions');

    Route::get('environment',[EnvironmentController::class,'environmentMenu'])
        ->name('environment');

    Route::get('environment/wizard',[EnvironmentController::class,'environmentWizard'])
        ->name('environmentWizard');

    Route::post('environment/saveWizard',[EnvironmentController::class,'saveWizard'])
        ->name('environmentSaveWizard');

    Route::get('environment/classic',[EnvironmentController::class,'environmentClassic'])
        ->name('environmentClassic');

    Route::post('environment/saveClassic',[EnvironmentController::class,'saveClassic'])
        ->name('environmentSaveClassic');

    Route::get('database',[DatabaseController::class,'database'])
        ->name('database');

    Route::get('final',[FinalController::class,'finish'])
        ->name('final');
});

// Dashboard Routes
Route::middleware(['auth','can_start'])->prefix('dashboard')->group(function(){

    // Main Page For Admin/Instructor/Alumni/Student
    Route::get('',DashboardController::class)->name('dashboard');

    // Class Route
    Route::post('class/store',[App\Http\Controllers\SchoolClassController::class,'store'])
        ->name('dashboard.class.store');

    Route::post('class/update',[App\Http\Controllers\SchoolClassController::class,'update'])
        ->name('dashboard.class.update');

    Route::get('classes',[App\Http\Controllers\SchoolClassController::class,'index'])
            ->name('dashboard.classes.index');

    Route::get('classes/edit/{id}',[App\Http\Controllers\SchoolClassController::class,'edit'])
            ->name('dashboard.classes.edit');

    // Students Route
    Route::get('students/add',[App\Http\Controllers\UserController::class,'createStudent'])
        ->name('dashboard.student.add');

    Route::post('students/store',[App\Http\Controllers\UserController::class,'storeStudent'])
        ->name('dashboard.student.store');

    Route::get('students/view/list',[App\Http\Controllers\UserController::class,'getStudentList'])
        ->name('dashboard.student.list.show');

    Route::get('students/view/profile/{id}',[App\Http\Controllers\UserController::class,'showStudentProfile'])
        ->name('dashboard.student.profile.show');

    Route::get('students/edit/{id}',[App\Http\Controllers\UserController::class,'editStudent'])
        ->name('dashboard.student.edit.show');

    Route::post('student/update',[App\Http\Controllers\UserController::class,'updateStudent'])
        ->name('dashboard.student.student.update');

    Route::get('students/view/attendance/{id}',[App\Http\Controllers\AttendanceController::class,'showStudentAttendance'])
        ->name('dashboard.student.attendance.show');


    // Teachers Route
    Route::get('teachers/add',[App\Http\Controllers\UserController::class,'createTeacher'])
        ->name('dashboard.teacher.add');

    Route::get('teachers/edit/{id}',[App\Http\Controllers\UserController::class,'editTeacher'])
        ->name('dashboard.teacher.edit.show');

    Route::post('teachers/update',[App\Http\Controllers\UserController::class,'updateTeacher'])
        ->name('dashboard.teacher.update');

    Route::post('teachers/store',[App\Http\Controllers\UserController::class,'storeTeacher'])
        ->name('dashboard.teacher.store');

    Route::post('/teachers/assign',[App\Http\Controllers\AssignedTeacherController::class,'store'])
        ->name('dashboard.teacher.assign');

    Route::get('/teachers/view/list',[App\Http\Controllers\UserController::class,'getTeacherList'])
        ->name('dashboard.teacher.list.show');

    Route::get('teachers/view/profile/{id}',[App\Http\Controllers\UserController::class,'showTeacherProfile'])
        ->name('dashboard.teacher.profile.show');


    // Exam Routes
    Route::prefix('exam')->group(function (){

        Route::get('create',[App\Http\Controllers\ExamController::class,'create'])
            ->name('dashboard.exam.create');

        Route::post('store',[App\Http\Controllers\ExamController::class,'store'])
            ->name('dashboard.exam.store');

        Route::get('view',[App\Http\Controllers\ExamController::class,'view'])
            ->name('dashboard.exam.view');

        Route::get('add-rule',[App\Http\Controllers\ExamRuleController::class,'create'])
            ->name('dashboard.exam.rule.create');

        Route::get('view-rule',[App\Http\Controllers\ExamRuleController::class,'index'])
            ->name('dashboard.exam.rule.show');

        Route::get('edit-rule',[App\Http\Controllers\ExamRuleController::class,'edit'])
            ->name('dashboard.exam.rule.edit');

        Route::post('edit-rule',[App\Http\Controllers\ExamRuleController::class,'update'])
            ->name('dashboard.exam.rule.update');

        Route::post('add-rule',[App\Http\Controllers\ExamRuleController::class,'store'])
            ->name('dashboard.exam.rule.store');

        Route::prefix('grade')->group(function (){

            Route::get('create',[App\Http\Controllers\GradingSystemController::class,'create'])
                ->name('dashboard.exam.grade.create');

            Route::get('add-rule',[App\Http\Controllers\GradeRuleController::class,'create'])
                ->name('dashboard.exam.grade.rule.create');

            Route::post('add-rule',[App\Http\Controllers\GradeRuleController::class,'store'])
                ->name('dashboard.exam.grade.rule.store');

            Route::get('view-rules',[App\Http\Controllers\GradeRuleController::class,'index'])
                ->name('dashboard.exam.grade.rule.show');

            Route::post('delete-rule',[App\Http\Controllers\GradeRuleController::class,'destroy'])
                ->name('dashboard.exam.grade.rule.delete');

            Route::post('create',[App\Http\Controllers\GradingSystemController::class,'store'])
                ->name('dashboard.exam.grade.store');

            Route::get('view',[App\Http\Controllers\GradingSystemController::class,'view'])
                ->name('dashboard.exam.grade.view');
        });
    });

    // Section Route
    Route::post('/session/store',[App\Http\Controllers\SchoolSessionController::class,'store'])
        ->name('dashboard.session.store');

    Route::post('/session/browse',[App\Http\Controllers\SchoolSessionController::class,'browse'])
        ->name('dashboard.session.browse');

    Route::post('/section/store',[App\Http\Controllers\SectionController::class,'store'])
        ->name('dashboard.section.store');

    Route::get('/section/edit/{id}',[App\Http\Controllers\SectionController::class,'edit'])
        ->name('dashboard.section.edit');

    Route::post('/section/update',[App\Http\Controllers\SectionController::class,'update'])
        ->name('dashboard.section.update');

    Route::get('/sections',[App\Http\Controllers\SectionController::class,'getByClassId'])
        ->name('get.sections.courses.by.classId');

    Route::post('/semester/store',[App\Http\Controllers\SemesterController::class,'store'])
        ->name('dashboard.semester.store');


    // Notice Routes
    Route::get('notice',[App\Http\Controllers\NoticeController::class,'create'])
        ->name('dashboard.notice');

    Route::post('notice',[App\Http\Controllers\NoticeController::class,'store'])
        ->name('dashboard.notice.store');


    // Routine Routes
    Route::get('routine/create',[App\Http\Controllers\RoutineController::class,'create'])
        ->name('dashboard.routine');

    Route::get('routine/view',[App\Http\Controllers\RoutineController::class,'show'])
            ->name('dashboard.routine.show');

    Route::post('routine/store',[App\Http\Controllers\RoutineController::class,'store'])
        ->name('dashboard.routine.store');

    Route::get('contact',[App\Http\Controllers\FeedBacksController::class,'index'])
        ->name('dashboard.contact');

    // Attendance Routes
    Route::post('attendance/type/update',[App\Http\Controllers\AcademicController::class,'updateAttendanceType'])
        ->name('dashboard.attendance.type.update');



    // Courses
    Route::get('course/teacher/index',[App\Http\Controllers\AssignedTeacherController::class,'getTeacherCourses'])
        ->name('dashboard.course.teacher.list.show');

    Route::get('course/student/index/{student_id}',[App\Http\Controllers\CourseController::class,'getStudentCourses'])
        ->name('dashboard.course.student.list.show');

    // Update password
    Route::get('password/edit', [App\Http\Controllers\Auth\UpdatePasswordController::class,'edit'])
        ->name('dashboard.password.edit');

    Route::post('password/edit', [App\Http\Controllers\Auth\UpdatePasswordController::class,'update'])
        ->name('dashboard.password.update');


    // Academic page route
    Route::get('academic',[App\Http\Controllers\AcademicController::class,'index'])
        ->name('dashboard.academic');

    Route::post('final-marks-submission-status/update',[App\Http\Controllers\AcademicController::class,'updateFinalMarksSubmissionStatus'])
        ->name('dashboard.final.marks.submission.status.update');

        // Student
        Route::get('score',[App\Http\Controllers\CourseController::class,'getStudentScores'])
            ->name('dashboard.score');


    // Course Route
    Route::post('course/store',[App\Http\Controllers\CourseController::class,'store'])
            ->name('dashboard.course.store');

    Route::post('course/update',[App\Http\Controllers\CourseController::class,'update'])
            ->name('dashboard.course.update');

    Route::get('course/edit/{id}',[App\Http\Controllers\CourseController::class,'edit'])
            ->name('dashboard.course.edit');

    // Promotions
    Route::get('promotions/index', [App\Http\Controllers\PromotionController::class,'index'])
        ->name('dashboard.promotions.index');

    Route::get('promotions/promote', [App\Http\Controllers\PromotionController::class,'create'])
        ->name('dashboard.promotions.create');

    Route::post('promotions/promote', [App\Http\Controllers\PromotionController::class,'store'])
        ->name('dashboard.promotions.store');

    Route::get('marks/create',[App\Http\Controllers\MarkController::class,'create'])
        ->name('dashboard.course.mark.create');

    Route::post('marks/store',[App\Http\Controllers\MarkController::class,'store'])
        ->name('dashboard.course.mark.store');

    Route::get('marks/view',[App\Http\Controllers\MarkController::class,'showCourseMark'])
        ->name('dashboard.course.mark.show');

    Route::get('marks/results',[App\Http\Controllers\MarkController::class,'index'])
        ->name('dashboard.course.mark.list.show');

    Route::get('marks/final/submit',[App\Http\Controllers\MarkController::class,'showFinalMark'])
        ->name('dashboard.course.final.mark.submit.show');

    Route::post('marks/final/submit',[App\Http\Controllers\MarkController::class,'storeFinalMark'])
        ->name('dashboard.course.final.mark.submit.store');

    // Attendance
    Route::post('attendances',[App\Http\Controllers\AttendanceController::class,'store'])
        ->name('dashboard.attendance.store');

    Route::get('attendances/view',[App\Http\Controllers\AttendanceController::class,'show'])
        ->name('dashboard.attendance.list.show');

    Route::get('attendances/take',[App\Http\Controllers\AttendanceController::class,'create'])
        ->name('dashboard.attendance.create.show');

    // Assignment
   Route::get('courses/assignments/index', [App\Http\Controllers\AssignmentController::class, 'getCourseAssignments'])
        ->name('dashboard.assignment.list.show');

   Route::get('courses/assignments/create', [App\Http\Controllers\AssignmentController::class, 'create'])
        ->name('dashboard.assignment.create');

   Route::post('courses/assignments/create', [App\Http\Controllers\AssignmentController::class, 'store'])
        ->name('dashboard.assignment.store');


    // Admin
    // System Setting Routes
    Route::prefix('system-settings')->group(function(){
        Route::get('',[App\Http\Controllers\SystemSettingsController::class,'index'])
            ->name('dashboard.system.settings');

        Route::get('add-new-setting',[App\Http\Controllers\SystemSettingsController::class,'storeNewSetting'])
            ->name('dashboard.system.settings-add-new-setting');

        Route::get('add-new-group',[App\Http\Controllers\SystemSettingsController::class,'storeNewGroup'])
            ->name('dashboard.system.settings-add-new-group');

        Route::get('add-new-type',[App\Http\Controllers\SystemSettingsController::class,'storeNewType'])
            ->name('dashboard.system.settings-add-new-type');

    });
});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
