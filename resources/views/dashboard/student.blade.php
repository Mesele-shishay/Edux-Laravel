<x-app-dashboard name="Promote Class Section" icon="fa-upload">
    {{-- {# Messages Card Row #} --}}
    <div class="row  d-print-none">
        {{-- {# Messages Card 1 #} --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row g-0 align-items-center">
                        <div class="col me-2">
                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                Messages
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">
                                59
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comment  fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- {# Messages Card 2 #} --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row g-0 align-items-center">
                        <div class="col me-2">
                            <div class="text-xs fw-bold text-success text-uppercase mb-1">
                                Exams
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">
                                99
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- {# Tasks Card #} --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row g-0 align-items-center">
                        <div class="col me-2">
                            <div class="text-xs fw-bold text-info text-uppercase mb-1">
                                Tasks
                            </div>
                            <div class="row g-0 align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 me-3 fw-bold text-gray-800">
                                        22
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm me-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- {# Pending Requests Card #} --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row g-0 align-items-center">
                        <div class="col me-2">
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                Pending Requests
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">
                                50
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-share-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- {# Content Row 1 #} --}}
    <div class="row">
        {{-- {# User Overview #} --}}
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                {{-- {# Card Header - Dropdown #} --}}
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-primary">Student Overview</h6>
                </div>
                {{-- {# Card Body #} --}}
                <div class="card-body">
                    <div class="mx-4">
                        <div class="row">
                            <div class="col-md-6 ">
                                <ul class="list-unstyled">
                                    <li>

                                        <strong>Full Name :</strong> {{ $user['profile']->first_name }} {{ $user['profile']->last_name }}
                                    </li>

                                    <hr>

                                    <li>
                                        <strong>ID Number :</strong> {{ $user['profile']->id_number }}
                                    </li>

                                    <hr>

                                    <li>
                                        <strong>Admission Year :</strong> {{ $user['profile']->created_at }} G.C
                                    </li>

                                    <hr>

                                    <li>
                                        <strong>Program :</strong> {{ $user['profile']->field }} Science
                                    </li>

                                    <hr>

                                </ul>
                            </div>
                            <div class="col-md-6 ">
                                <ul class="list-unstyled">
                                    <li>
                                        <strong>Class :</strong> {{ $user['schoolClass']->class_name}}
                                    </li>
                                    <hr>
                                    <li>
                                        <strong>Section :</strong> {{ $user['academic_info']->section->section_name }}
                                    </li>
                                    <hr>
                                    <li>
                                        <strong>Reg Status :</strong> {{ $user['profile']->status }}
                                    </li>
                                    <hr>
                                    <li>
                                        <strong>Admission :</strong> {{ $user['profile']->admission }}
                                    </li>
                                    <hr>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- {# Pie Chart #} --}}
        <div class="col-xl-4 col-lg-5  d-print-none">
            <div class="card shadow mb-4">
                {{-- {# Card Header - Dropdown #} --}}
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-primary">
                        User Profile
                    </h6>
                </div>
                {{-- {# Card Body #} --}}
                <div class="card-body text-center">
                    <img class="img-fluid rounded border-left-info"
                        style="width:16rem;"
                        src="{{ asset('storage/'.$user['profile']->image )}}"
                        alt="{{ $user['profile']->first_name }} {{ $user['profile']->last_name }}">
                    <p class="my-0 mt-2">
                        I am {{ $user['profile']->first_name }} {{ $user['profile']->last_name }} {{ $user['schoolClass']->class_name }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    {{-- {# Content Row 2 #} --}}
    <div class="row">
        {{-- {# Content Column #} --}}
        <div class="col-lg mb-4">
            {{-- {# Project Card Example #} --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary">Course Overview</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Course</th>
                                    <th>Instructor</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user['courses'] as $course)
                                    <tr>
                                        <td class="text-capitalize">
                                            {{ $course->course_name }}
                                        </td>
                                        <td class="text-capitalize">
                                            @if (!$course->teacher == NULL)

                                                @if (null !== $course->teacher->teacher->first_name )

                                                    {{ $course->teacher->teacher->first_name  . ' ' .  $course->teacher->teacher->last_name }}
                                                @else

                                                {{ 'Not available' }}

                                                @endif

                                        </td>
                                        <td>
                                            @if (null !== $course->teacher->user->email)
                                               {{ $course->teacher->user->email }}
                                            @else
                                                {{ 'Not available' }}
                                            @endif
                                        </td>
                                            @endif
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="8">
                                        <center>
                                            {{-- {{ bar_code($user.profile.id_number) }} --}}
                                        </center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>

