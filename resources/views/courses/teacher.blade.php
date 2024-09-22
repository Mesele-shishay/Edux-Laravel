<x-app-dashboard name="Courses" icon="file-alt">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <div class="mxj-4">
                        <x-form  action="{{route('dashboard.course.teacher.list.show')}}" method="GET">
                            <input type="hidden" name="teacher_id" value="{{ auth()->user()->id }}">
                            <div class="row">
                                <div class="col">
                                    <x-form-select name="semester_id" label="Filter list by">
                                        @if ($semesters)
                                            @foreach ($semesters as $semester)
                                                <option value="{{$semester->id}}"
                                                {{$semester->id == request()->query('semester_id') ? 'selected':''}}>
                                                {{$semester->semester_name}}
                                            </option>
                                            @endforeach
                                        @endif
                                    </x-form-select>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-arrow-counterclockwise"></i> Load List</button>
                                </div>
                            </div>
                        </x-form>
                        <div class="p-3 mt-3 bg-white border shadow-sm table-responsive-md">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Course Name</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Section</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($courses)
                                        @foreach ($courses as $course)
                                        <tr>
                                            <td>{{ $course->course->course_name }}</td>
                                            <td>{{ $course->schoolClass->class_name }}</td>
                                            <td>{{ $course->section->section_name }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle"
                                                            data-bs-toggle="dropdown">Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{route('dashboard.attendance.create.show', [
                                                            'class_id' =>  $course->schoolClass->id,
                                                            'section_id' =>  $course->section->id,
                                                            'course_id' =>  $course->course->id,
                                                            'class_name' =>  $course->schoolClass->class_name,
                                                            'section_name' =>  $course->section->section_name,
                                                            'course_name' =>  $course->course->course_name])}}">
                                                            <i class="fas fa-calendar-alt me-2"></i> Take Attendance
                                                        </a>

                                                        <a class="dropdown-item"
                                                            href="{{ route('dashboard.attendance.list.show',[
                                                            'class_id' => $course->schoolClass->id,
                                                            'section_id' => $course->section->id,
                                                            'course_id' => $course->course->id,
                                                            'class_name' => $course->schoolClass->class_name,
                                                            'section_name' => $course->section->section_name,
                                                            'course_name' => $course->course->course_name]) }}">
                                                            <i class="fas fa-calendar me-2"></i> View Attendance
                                                        </a>

                                                        <a class="dropdown-item"
                                                            href="route('course.syllabus.index', ['course_id' => $course->course->id])}}">
                                                            <i class="fas fa-journal-whills me-2"></i> View Syllabus
                                                        </a>
                                                        @php
                                                        $semester_id = 0;
                                                        @endphp

                                                        <a class="dropdown-item"
                                                            href="{{ route('dashboard.assignment.create',[
                                                            'class_id' =>  $course->schoolClass->id,
                                                            'section_id' =>  $course->section->id,
                                                            'course_id' =>  $course->course->id,
                                                            'semester_id' =>  request()->query('semester_id') ?? $semester_id
                                                            ])}}">
                                                            <i class="fas fa-file-alt me-2"></i> Create Assignment
                                                        </a>

                                                        <a class="dropdown-item"
                                                            href="{{route('dashboard.assignment.list.show',['course_id' => $course->course->id])}}">
                                                            <i class="fas fa-file me-2"></i> View Assignments
                                                        </a>

                                                        <a class="dropdown-item"
                                                            href="{{ route('dashboard.course.mark.create',[
                                                            'class_id' => $course->schoolClass->id,
                                                            'class_name' => $course->schoolClass->class_name,
                                                            'section_id' => $course->section->id,
                                                            'section_name' => $course->section->section_name,
                                                            'course_id' => $course->course->id,
                                                            'course_name' => $course->course->course_name,
                                                            'semester_id' => $selected_semester_id
                                                            ]) }}">
                                                            <i class="fas fa-i-cursor me-2"></i> Give Marks
                                                        </a>

                                                        <a class="dropdown-item"
                                                            href="{{route('dashboard.course.mark.list.show',[
                                                            'class_id' => $course->schoolClass->id,
                                                            'class_name'=> $course->schoolClass->class_name,
                                                            'section_id' => $course->section->id,
                                                            'section_name' => $course->section->section_name,
                                                            'course_id' => $course->course->id,
                                                            'course_name' => $course->course->course_name,
                                                            'semester_id'=> $selected_semester_id
                                                            ])}}">
                                                            <i class="fas fa-cloud-sun me-2"></i> View Final Results
                                                        </a>

                                                        <a class="dropdown-item disabled"
                                                            href="#">
                                                            <i class="fas fa-chat-left-text me-2"></i> Message Students
                                                        </a>

                                                    </div>
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


