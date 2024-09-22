<x-app-dashboard name="Create Assignment" icon="file-alt">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <div class="row mt-4">
                        <div class="col-md-5">
                            <div class="p-3 border bg-light shadow-sm">
                                <x-form action="{{route('dashboard.assignment.store')}}" enctype="multipart/form-data">
                                    <input type="hidden" name="session_id" value="{{$current_school_session_id}}">
                                    <input type="hidden" name="class_id" value="{{request()->query('class_id')}}">
                                    <input type="hidden" name="semester_id" value="{{request()->query('semester_id')}}">
                                    <input type="hidden" name="course_id" value="{{request()->query('course_id')}}">
                                    <input type="hidden" name="section_id" value="{{request()->query('section_id')}}">

                                    <div class="mb-3">
                                        <x-form-input type="text"  label="Assignment Name" id="assignment-name" name="assignment_name" placeholder="Assignment Name" required />
                                    </div>

                                    <x-form-file name="file" label="Assignment File" id="assignment-file" />

                                    <div class="mb-4">
                                        <button type="submit" class="btn btn-outline-primary"><i class="fas fa-check"></i> Create</button>
                                    </div>
                                </x-form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>

