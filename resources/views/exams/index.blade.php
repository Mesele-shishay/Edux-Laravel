<x-app-dashboard name="Exams" icon="file-alt">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h6>Filter list by:</h6>
                    <div class="mb-4 mt-4">
                        <form action="{{ route('dashboard.exam.view')}}" method="GET">
                            <div class="row">
                                <div class="col-3">
                                    <select onchange="getCourses(this);" class="custom-select" aria-label="Class" name="class_id">
                                        <option selected disabled>Select Class</option>

                                       @isset($classes)
                                            @foreach ($classes as $school_class)
                                                <option value="{{$school_class->id}}">{{$school_class->class_name}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="col-3">
                                    <select class="custom-select" aria-label="Status" id="course-select" name="course_id">
                                        <option selected disabled>Select Section</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-counterclockwise"></i> Load List</button>
                                </div>
                            </div>
                        </form>
                        <div class="bg-white mt-4 p-3 border shadow-sm table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Course</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Starts</th>
                                        <th scope="col">Ends</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach ($exams as $exam)
                                        @if (Auth::user()->role == "admin")
                                        <tr>
                                            <td>{{$exam->exam_name}}</td>
                                            <td>{{$exam->course->course_name}}</td>
                                            <td>{{$exam->created_at}}</td>
                                            <td>{{$exam->start_date}}</td>
                                            <td>{{$exam->end_date}}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{route('dashboard.exam.rule.create',['exam_id' => $exam->id])}}"
                                                        role="button" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-plus"></i> Add Rule</a>
                                                    <a href="{{route('dashboard.exam.rule.show',['exam_id' => $exam->id])}}"
                                                        role="button" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i> View Rule</a>
                                                </div>
                                            </td>
                                        </tr>
                                        @elseif(Auth::user()->role == "teacher")
                                            @foreach ($teacher_courses as $teacher_course)
                                                @if ($exam->course->id != $teacher_course->course_id)
                                                    @continue
                                                @else
                                                <tr>
                                                    <td>{{$exam->exam_name}}</td>
                                                    <td>{{$exam->course->course_name}}</td>
                                                    <td>{{$exam->created_at}}</td>
                                                    <td>{{$exam->start_date}}</td>
                                                    <td>{{$exam->end_date}}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{route('dashboard.exam.rule.create',['exam_id' => $exam->id])}}"
                                                                role="button"
                                                                class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-plus"></i> Add Rule
                                                            </a>
                                                            <a href="{{route('dashboard.exam.rule.show',['exam_id' => $exam->id])}}"
                                                                role="button"
                                                                class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-eye"></i> View Rule
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
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
