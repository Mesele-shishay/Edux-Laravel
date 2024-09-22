<x-app-dashboard name="classes" icon="school">
     <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <div class="row">
                        @if (isset($school_classes))
                            @foreach ($school_classes as $school_class)
                            @php
                                $total_sections = 0;
                            @endphp
                            <div class="col-12">
                                <div class="card my-3">
                                    <div class="card-header bg-transparent">
                                        <ul class="nav nav-tabs card-header-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active"
                                                    data-bs-toggle="tab"
                                                    href="#class{{$school_class->id}}"
                                                    role="tab" ><i class="fas fa-project-diagram"></i> {{$school_class->class_name}}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                    data-bs-toggle="tab"
                                                    href="#class{{$school_class->id}}-syllabus"
                                                    role="tab" ><i class="fas fa-journal-whills"></i> Syllabus
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                    data-bs-toggle="tab"
                                                    href="#class{{$school_class->id}}-courses"
                                                    role="tab" ><i class="fas fa-book-open"></i> Courses
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body text-dark">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="class{{$school_class->id}}" role="tabpanel">
                                                <div class="accordion" id="accordionClass{{$school_class->id}}">
                                                @isset($school_sections)
                                                    @foreach ($school_sections as $school_section)
                                                        @if ($school_section->class_id == $school_class->id)
                                                            @php
                                                                $total_sections++;
                                                            @endphp
                                                            <div class="card shadow mb-4">
                                                                <!-- Card Header - Accordion -->
                                                                <a href="#collapseClass{{ $school_section->id }}"
                                                                    class="d-block card-header py-3 collapsed"
                                                                    data-bs-toggle="collapse"
                                                                    role="button"
                                                                    aria-expanded="false" >
                                                                    <h6 class="m-0 fw-bold text-primary">
                                                                        {{$school_section->section_name}}
                                                                    </h6>
                                                                </a>
                                                                <!-- Card Content - Collapse -->
                                                                <div class="collapse" id="collapseClass{{ $school_section->id }}" style="">
                                                                    <div class="card-body">
                                                                        <p class="lead d-flex justify-content-between">
                                                                            <span>Room No: {{$school_section->room_no}}</span>
                                                                            @can('edit sections')
                                                                            <span>
                                                                                <a href="{{ route('dashboard.section.edit', ['id' => $school_section->id])}}"
                                                                                    role="button"
                                                                                    class="btn btn-sm btn-outline-primary">
                                                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                                                </a>
                                                                            </span>
                                                                            @endcan
                                                                        </p>
                                                                        <div class="list-group">
                                                                            <a href="{{ route('dashboard.student.list.show',[
                                                                                    'class_id' =>$school_class->id,
                                                                                    'section_id' => $school_section->id,
                                                                                    'section_name' =>$school_section->section_name ]) }}"
                                                                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                                                View Students
                                                                            </a>
                                                                            <a
                                                                                href="{{ route('dashboard.routine.show',[
                                                                                    'class_id' => $school_class->id,
                                                                                    'section_id' => $school_section->id ]) }}"
                                                                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                                                View Routine
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endisset
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="class{{$school_class->id}}-syllabus" role="tabpanel">

                                            @isset($school_class->syllabi)
                                            <table class="table table-borderless">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Syllabus Name</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($school_class->syllabi as $syllabus)
                                                    <tr>
                                                    <td>{{$syllabus->syllabus_name}}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ asset('storage/'->$syllabus->syllabus_file_path)}}"
                                                                role="button"
                                                                class="btn btn-sm btn-outline-primary">
                                                                <i class="bi bi-download"></i> Download
                                                            </a>
                                                        </div>
                                                    </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            @endisset

                                            </div>
                                            <div class="tab-pane fade" id="class{{$school_class->id}}-courses" role="tabpanel">
                                            @isset($school_class->courses)
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Course Name</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($school_class->courses as $course)
                                                        <tr>
                                                            <td>{{$course->course_name}}</td>
                                                            <td>{{$course->course_type}}</td>
                                                            <td>
                                                                @can('edit courses')
                                                                <a href="{{route('dashboard.course.edit', ['id' => $course->id])}}"
                                                                    class="btn btn-sm btn-outline-primary"
                                                                    role="button">
                                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                                </a>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            @endisset
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent d-flex justify-content-between">

                                        @isset($total_sections)
                                            <span>Total Sections: {{$total_sections}}</span>
                                        @endisset

                                        @can('edit classes')
                                        <span><a href="{{route('dashboard.classes.edit', ['id' => $school_class->id])}}" class="btn btn-sm btn-outline-primary" role="button"><i class="bi bi-pencil"></i> Edit Class</a></span>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>