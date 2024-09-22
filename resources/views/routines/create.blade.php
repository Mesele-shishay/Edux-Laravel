<x-app-dashboard name="Promote Class Section" icon="upload">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <div class="row">
                        <div class="col-md-5 mb-4">
                            <div class="p-3 border bg-light shadow-sm">
                                <x-form action="{{route('dashboard.routine.store')}}">
                                    <input type="hidden" name="session_id" value="{{$current_school_session_id}}">

                                    <div>
                                        <x-form-select onchange="getSectionsAndCourses(this);" name="class_id" required label="Select class">
                                            @if ($classes)
                                                <option selected disabled>Please select a class</option>
                                                @foreach ($classes as $school_class)
                                                    <option value="{{$school_class->id}}">
                                                        {{$school_class->class_name}}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </x-form-select>
                                    </div>

                                    <div>
                                        <x-form-select id="section-select" name="section_id" required label="Select section">
                                        </x-form-select>
                                    </div>

                                    <div>
                                        <x-form-select id="course-select" name="course_id" required label="Select course">
                                        </x-form-select>
                                    </div>

                                    <div>
                                        <x-form-select id="course-select" name="weekday" required label="Week Day">
                                            <option value="1">Monday</option>
                                            <option value="2">Tuesday</option>
                                            <option value="3">Wednesday</option>
                                            <option value="4">Thursday</option>
                                            <option value="5">Friday</option>
                                            <option value="6">Saturday</option>
                                            <option value="7">Sunday</option>
                                        </x-form-select>
                                    </div>

                                    <div>
                                        <x-form-input type="datetime-local" id="inputStarts" name="start" placeholder="09:00am" required label="Starts"/>
                                    </div>

                                    <div>
                                        <x-form-input type="datetime-local" class="form-control" id="inputEnds" name="end" placeholder="09:50am" required label="Ends" />
                                    </div>

                                    <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i class="fas fa-check fa-xs"></i> Create</button>

                                </x-form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <script>
        function getSectionsAndCourses(obj) {
            var class_id = obj.options[obj.selectedIndex].value;

            var url = "{{route('get.sections.courses.by.classId')}}?class_id=" + class_id

            fetch(url)
            .then((resp) => resp.json())
            .then(function(data) {
                var sectionSelect = document.getElementById('section-select');
                sectionSelect.options.length = 0;
                data.sections.unshift({'id': 0,'section_name': 'Please select a section'})
                data.sections.forEach(function(section, key) {
                    sectionSelect[key] = new Option(section.section_name, section.id);
                });

                var courseSelect = document.getElementById('course-select');
                courseSelect.options.length = 0;
                data.courses.unshift({'id': 0,'course_name': 'Please select a course'})
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