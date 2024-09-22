<?php

namespace App\Http\controllers;

use App\Models\Section;
use App\Models\Promotion;
use App\Traits\UserProfile;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use Illuminate\Http\Response;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\SectionRepositoryInterface;
use App\Repositories\Interfaces\PromotionRepositoryInterface;
use App\Repositories\Interfaces\SchoolClassRepositoryInterface;
use App\Repositories\Interfaces\SchoolSessionRepositoryInterface;


class PromotionController extends Controller
{
    use SchoolSession;
    use UserProfile;

    /**
    * Create a new Controller instance
    *
    * @param SchoolSessionInterface $schoolSessionRepository
    * @return void
    */
    public function __construct(
        SchoolSessionRepositoryInterface $schoolSessionRepository,
        UserRepositoryInterface $userRepository,
        SchoolClassRepositoryInterface $schoolClassRepository,
        SectionRepositoryInterface $schoolSectionRepository,
        PromotionRepositoryInterface $promotionRepository

    ) {
        $this->schoolSessionRepository = $schoolSessionRepository;
        $this->userRepository = $userRepository;
        $this->schoolClassRepository = $schoolClassRepository;
        $this->schoolSectionRepository = $schoolSectionRepository;
        $this->promotionRepository = $promotionRepository;

    }

     /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $class_id = $request->query('class_id', 0);

        $promotionRepository = $this->promotionRepository;
        $previousSession = $this->schoolSessionRepository->getPreviousSession();

        if(count($previousSession) < 1) {
            return back()->withError('No previous session');
        }

        $previousSessionClasses = $promotionRepository->getClasses($previousSession['id']);

        $previousSessionSections = $promotionRepository->getSections($previousSession['id'], $class_id);

        $current_school_session_id = $this->getSchoolCurrentSession();
        $currentSessionSections = $promotionRepository->getSectionsBySession($current_school_session_id);

        $currentSessionSectionsCounts = $currentSessionSections->count();

        $data = [
            'previousSessionClasses'        => $previousSessionClasses,
            'class_id'                      => $class_id,
            'previousSessionSections'       => $previousSessionSections,
            'currentSessionSectionsCounts'  => $currentSessionSectionsCounts,
            'previousSessionId'             => $previousSession['id'],
        ];

        return view('promotions.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @param  ResponseInterface  $request
     * 
     * @return RequestInterface
     */
    public function create(Request $request)
    {
        $user = auth()->user();
        $userProfile = $this->userProfile($user);

        $class_id = $request->query('previous_class_id');
        $section_id = $request->query('previous_section_id');
        $session_id = $request->query('previousSessionId');

        if($class_id == null || $section_id == null ||$session_id == null) {
            return redirect('dashboard.promotions.index');
        }

        $students = $this->userRepository->getAllStudents($session_id, $class_id, $section_id);
        $students_passed = [];

        // Filtering only passed students
        foreach ($students as $student) {
            if ($student['final_mark']) {
                $final_mark_semester_1 = $student['final_mark'][0]['final_marks'] ?? 0;
                $final_mark_semester_2 = $student['final_mark'][1]['final_marks'] ?? 0;

                if (($final_mark_semester_1 + $final_mark_semester_2)/2 >50.0) {
                    array_push($students_passed, $student);
                }
            }
        }

        $schoolClass = $this->schoolClassRepository->findById($class_id);
        $section = $this->schoolSectionRepository->findById($section_id);

        $latest_school_session = $this->schoolSessionRepository->getLatestSession();

        $school_classes = $this->schoolClassRepository->getAllBySession($latest_school_session->id);

        $data = [
            'students'      => $students_passed,
            'schoolClass'   => $schoolClass,
            'section'       => $section,
            'school_classes'=> $school_classes->toArray(),
        ];

        return view('promotions.promote', $data);


    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_card_numbers = $request->id_card_number;
        $latest_school_session = $this->schoolSessionRepository->getLatestSession();

        $rows = [];
        $i = 0;
        foreach($id_card_numbers as $student_id => $id_card_number) {
            $row = [
                'student_id'    => $student_id,
                'id_card_number'=> $id_card_number,
                'class_id'      => $request->class_id[$i],
                'section_id'    => $request->section_id[$i],
                'session_id'    => $latest_school_session->id,
            ];
            array_push($rows, $row);
            $i++;
        }

        try {
            $promotionRepository = new PromotionRepository();
            $promotionRepository->massPromotion($rows);

            return back()->with('status', 'Promoting students was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return RequestInterface
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return RequestInterface
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ResponseInterface  $request
     * @param  \App\Models\Promotion  $promotion
     * @return RequestInterface
     */
    public function update(Request $request, Promotion $promotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return RequestInterface
     */
    public function destroy(Promotion $promotion)
    {
        //
    }
}
