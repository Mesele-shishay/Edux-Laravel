<x-app-dashboard name="Create Grading System" icon="file-alt">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <div class="row">
                        <div class="col-md-5 mb-4">
                            <div class="p-3 border shadow-sm bg-light">

                                <x-form action="{{route('dashboard.exam.grade.store')}}">
                                    <input type="hidden" name="session_id" value="{{$current_school_session_id}}">

                                    <x-form-select required label="Select class" name="class_id">
                                        @isset($school_classes)
                                            @foreach ($school_classes as $school_class)
                                            <option value="{{$school_class->id}}">{{$school_class->class_name}}</option>
                                            @endforeach
                                        @endisset
                                    </x-form-select>

                                    <x-form-select required label="Select semester" name="semester_id">
                                       @isset($semesters)
                                           @foreach ($semesters as $semester)
                                           <option value="{{$semester->id}}" {{($semester->id === request()->query('semester_id'))?'selected':''}}>{{$semester->semester_name}}</option>
                                           @endforeach
                                       @endisset
                                    </x-form-select>

                                    <x-form-input placeholder="Grading System 1" name="system_name" label="Grading System name" required />

                                    <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i class="fas fa-check"></i> Create</button>

                                </x-form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>
