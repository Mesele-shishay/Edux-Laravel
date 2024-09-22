<x-app-dashboard name="Edit Course" icon="fa-file-alt">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <div class="row">

                        <x-form class="col-md-6" action="{{route('dashboard.course.update')}}" >
                            <input type="hidden" name="session_id" value="{{$current_school_session_id}}">
                            <input type="hidden" name="course_id" value="{{$course_id}}">

                            <x-form-input id="course_name" name="course_name" value="{{$course->course_name}}" label="Course Name" required />

                            <x-form-select id="course_type" name="course_type" label="Course Type" required>

                                <option value="Core" @selected($course->course_type == 'Core') >Core</option>

                                <option value="General" @selected($course->course_type == 'General')>General</option>

                                <option value="Elective" @selected($course->course_type == 'Elective')>Elective</option>

                                <option value="Optional" @selected($course->course_type == 'Optional')>Optional</option>
                            </x-form-select>

                            <button type="submit" class="btn btn-outline-primary mb-3"><i class="fas fa-check fa-sm"></i> Save</button>

                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>

