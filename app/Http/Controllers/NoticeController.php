<?php 
namespace App\Http\controllers;

use App\Traits\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\NoticeRepository;
use App\Http\Requests\NoticeStoreRequest;
use App\Repositories\Interfaces\SchoolSessionRepositoryInterface;

class NoticeController extends Controller
{
	use UserProfile;

    protected $schoolSessionRepository;

    public function __construct(
        SchoolSessionRepositoryInterface $schoolSessionRepository)
    {
        $this->schoolSessionRepository = $schoolSessionRepository;
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $current_school_session_id = $this->getSchoolCurrentSession();
        return view('notices.create', compact('current_school_session_id'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  NoticeStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoticeStoreRequest $request)
    {
        try {
            $noticeRepository = new NoticeRepository();
            $noticeRepository->store($request->validated());

            return back()->with('status', 'Creating Notice was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
}
