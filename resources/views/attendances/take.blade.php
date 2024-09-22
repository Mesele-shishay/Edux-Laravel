<x-app-dashboard name="Take Attendance" icon="calendar-alt">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">

                    <h4><i class="fas fa-compass"></i>
                        Class #{{request()->query('class_name')}},
                        @if ($academic_setting->attendance_type == 'course')
                            Course: {{request()->query('course_name')}}
                        @else
                            Section #{{request()->query('section_name')}}
                        @endif
                    </h4>
                    <div class="mt-4">Current Date and Time: {{ date("d/m/Y") }}</div>
                    <div class="row mt-4">
                        <div class="col-10 bg-white border p-3 shadow-sm">

                            <x-form  action="{{route('dashboard.attendance.store')}}">
                                <input type="hidden" name="session_id" value="{{$current_school_session_id}}">
                                <input type="hidden" name="class_id" value="{{request()->query('class_id')}}">
                                @if ($academic_setting->attendance_type == 'course')
                                    <input type="hidden" name="course_id" value="{{request()->query('course_id')}}">
                                    <input type="hidden" name="section_id" value="0">
                                @else
                                    <input type="hidden" name="course_id" value="0">
                                    <input type="hidden" name="section_id" value="{{request()->query('section_id')}}">
                                @endif

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col"># ID Card Number</th>
                                                <th scope="col">Student Name</th>
                                                <th scope="col">Present</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($student_list as $student)
                                                <input type="hidden" name="student_ids[]" value="{{$student->student_id}}">
                                                 <tr>
                                                    <th scope="row">{{$student->student->id_number}}</th>
                                                    <td>{{$student->student->first_name}} {{$student->student->last_name}}</td>
                                                    <td>
                                                        <x-form-check id="{{$student->student_id}}" name="status[{{$student->student_id}}]" label="" checked=false/>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                @if(count($student_list) > 0 && $attendance_count < 1)
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-outline-primary"><i class="fas fa-check fa-sm"></i> Submit</button>
                                </div>
                                @endif


                            </x-form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-dashboard>
