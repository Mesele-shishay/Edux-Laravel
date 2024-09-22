<?php 
namespace App\Http\controllers;

use App\Models\Semester;
use App\Traits\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\SchoolSession;
use App\Http\Requests\SemesterStoreRequest;
use App\Repositories\Interfaces\SemesterRepositoryInterface;

class SemesterController extends Controller
{
    use SchoolSession;

     protected $semesterRepository;

    public function __construct(
        SemesterRepositoryInterface $semesterRepository)
    {
        $this->semesterRepository = $semesterRepository;
    }

    public function store(SemesterStoreRequest $request)
    {
        $current_school_session_id = $this->getSchoolCurrentSession();

        $allSemesters = $this->semesterRepository;

        if (count($allSemesters->getAll($current_school_session_id)) >= 2) {
            return back()->withError('Only 2 semesters can have i a session');
        }
        try {
            $this->semesterRepository->create($request->validated());

            return back()->with('status', 'Semester creation was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }

    }
}
