<x-app-dashboard name="Edit Section" icon="project-diagram">
    <div class="container-fluid">
        <!-- {# Subjects Overview #} -->
        <div class="row">
            @foreach ($courses as $course)
                <div class="col-xl-3 col-md-6 mb-4 hover-cursor"
                    data-toggle="modal"
                    data-target="#{{ Str::lower($course->course_name) }}">
                    <div class="card border-left-{{ course_icon($course->course_name)['color']}} shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ $course->course_name }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        @if ($course->marks->count())
                                            {{ $course->marks->marks }}
                                        @else
                                            Not Available
                                        @endif

                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-{{ course_icon($course->course_name)['icon']}}  fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


</x-app-dashboard>

@foreach ($courses as $course)
    <div class="modal fade show"
        id="{{ Str::lower($course->course_name) }}"
        tabindex="-1"
        role="dialog"
        aria-modal="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ Str::ucfirst($course->course_name) }}</h5>
                    <button class="close" type="button"
                        data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr class="table-info">
                                    <th>Semesters</th>
                                    @foreach ($course->marks as $mark)
                                        <th class="small o-hidden">{{ $mark->exam  ? $mark->exam->exam_name : '%' }}</th>
                                    {{-- @else
                                        <th>10%</th>
                                        <th>15%</th>
                                        <th>25%</th>
                                        <th>50%</th>
                                        <th>100%</th> --}}
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold">{{$current_school_semester->semester_name}}</td>
                                    @if ($course->marks)
                                        @foreach ($course->marks as $mark)
                                            <td>{{ $mark->marks }}</td>
                                        @endforeach
                                    @endif

                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endforeach