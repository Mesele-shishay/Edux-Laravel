<x-app-dashboard name="View Attendance" icon="calendar-alt">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                     @if(request()->query('course_name'))
                        <h4><i class="fas fa-compass"></i> Course: {{ request('course_name') }} </h3>
                     @elseif(request()->query('section_name'))
                        <h4><i class="fa fa-diagram"></i> Section: {{ request('section_name') }} </h3>
                    @endif
                    <div class="mt-4">Current Date and Time: {{ date('Y-m-d') }}</div>
                    <div class="row mt-4">
                        <div class="col bg-white border shadow-sm pt-2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Today's Status</th>
                                        <th scope="col">Total Attended</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach ($attendances as $attendance)
                                        @php
                                            $total_attended = \App\Models\Attendance::where('student_id', $attendance->student_id)->where('session_id', $attendance->session_id)->count();
                                        @endphp
                                        <tr>
                                            <td>{{$attendance->student->first_name}} {{$attendance->student->last_name}}</td>
                                            <td>
                                                @if ($attendance->status == "on")
                                                    <span class="badge bg-success">PRESENT</span>
                                                @else
                                                    <span class="badge bg-danger">ABSENT</span>
                                                @endif

                                            </td>
                                            <td>{{$total_attended}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>
