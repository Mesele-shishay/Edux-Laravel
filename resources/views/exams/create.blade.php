<x-app-dashboard name="Create Exam" icon="fa-file-alt">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <div class="row">
                        <div class="col-md-5 mb-4">
                            <div class="p-3 border bg-light shadow-sm">

                                <x-form action="{{ route('dashboard.exam.store')}}">

                                    <input type="hidden" name="session_id" value="{{$current_school_session_id}}">

                                    <x-form-select name="semester_id" required label="Select Semester" required>
                                        @isset($semesters)
                                                @foreach ($semesters as $semester)
                                                <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
                                                @endforeach
                                            @endisset
                                    </x-form-select>

                                    <x-form-select required label="Select class"  onchange="getCourses(this);" name="class_id">
                                        @isset($classes)
                                                <option selected disabled>Please select a class</option>
                                                @foreach ($classes as $school_class)
                                                <option value="{{$school_class->id}}">{{$school_class->class_name}}</option>
                                                @endforeach
                                            @endisset
                                    </x-form-select>

                                    <x-form-select id="course-select" name="course_id" required label="Select course">

                                    </x-form-select>

                                    <x-form-input name="exam_name" placeholder="Quiz, Assignment, Mid term, Final, ..." aria-label="Quiz, Assignment, Mid term, Final, ..." value="{{ old('exam_name') }}" label="Exam name" required/>

                                    <x-form-input label="Starts" type="datetime-local" id="inputStarts" name="start_date" placeholder="Starts" required/>

                                    <x-form-input label="Ends" type="datetime-local" id="inputEnds" name="end_date" placeholder="Ends" required/>

                                    <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i class="fas fa-check fa-xs"></i> Create</button>

                                </x-form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function getCourses(obj) {
            var class_id = obj.options[obj.selectedIndex].value;

            var url = "{{route('get.sections.courses.by.classId') }}?class_id=" + class_id;

            fetch(url)
            .then((resp) => resp.json())
            .then(function(data) {

                var courseSelect = document.getElementById('course-select');
                courseSelect.options.length = 0;
                data.courses.unshift({'id': 0,'course_name': 'Please select a course'});
                data.courses.forEach(function(course, key) {
                    courseSelect[key] = new Option(course.course_name, course.id);
                });
            })
            .catch(function(error) {
                console.log(error);
            });
        }
    </script>

</x-app-dashboard>