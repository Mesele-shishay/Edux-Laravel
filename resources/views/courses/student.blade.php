<x-app-dashboard name="My Courses" icon="journal-medical">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">

                    <div class="mb-4 mt-4">
                        <div class="p-3 mt-3 bg-white border shadow-sm  table-responsive-md">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Course Name</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($courses)
                                        @foreach ($courses as $course)
                                        <tr>
                                            <td>{{$course->course_name}}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{route('dashboard.course.mark.show',[
                                                        'course_id' => $course->id,
                                                        'course_name'=>  $course->course_name,
                                                        'semester_id'=>  $course->semester_id,
                                                        'class_id'  =>  $class_info->class_id,
                                                        'session_id'=>  $course->session_id,
                                                        'section_id' =>  $class_info->section_id,
                                                        'student_id' =>  auth()->user()->id
                                                        ])}}" role="button"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-cloud-sun"></i> View Marks
                                                    </a>
                                                    <a href="#"
                                                        role="button"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-journal-whills"></i> View Syllabus
                                                    </a>
                                                    <a href="{{route('dashboard.assignment.list.show',['course_id' => $course->id])}}"
                                                        role="button"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-file"></i> View Assignments
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>

