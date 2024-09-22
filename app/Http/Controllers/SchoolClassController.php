<?php 
namespace App\Http\controllers;


use App\Models\Section;
use App\Traits\UserProfile;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\SchoolSession;
use App\Http\Requests\SchoolClassStoreRequest;
use App\Repositories\Interfaces\SchoolClassRepositoryInterface;

/***
 *
 * School Class Controller
 *
 * */
class SchoolClassController extends Controller
{
	use UserProfile;
    use SchoolSession;


    public function __construct(
        SchoolClassRepositoryInterface $schoolClassRepository)
    {
        $this->schoolClassRepository = $schoolClassRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_school_session_id = $this->getSchoolCurrentSession();

        $data = $this->schoolClassRepository->getClassesAndSections($current_school_session_id);

        return view('classes.index', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  SchoolClassStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SchoolClassStoreRequest $request)
    {
        try {
            $this->schoolClassRepository->create($request->validated());

            return back()->with('status', 'Class creation was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  $class_id
     * @return \Illuminate\Http\Response
     */
    public function edit($class_id)
    {
        $current_school_session_id = $this->getSchoolCurrentSession();

        $schoolClass = $this->schoolClassRepository->findById($class_id);

        $data = [
            'current_school_session_id' => $current_school_session_id,
            'class_id'                  => $class_id,
            'schoolClass'               => $schoolClass,
        ];
        return view('classes.edit', $data);
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
            $this->schoolClassRepository->update($request);

            return back()->with('status', 'Class edit was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }



}
