<x-app-dashboard name="Give Final Marks" icon="cloud-sun">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-cloud-sun"></i> Give Final Marks
                    </h1>
                    <h5><i class="bi bi-diagram-2"></i> Class {{$class_name}}, Section #{{$section_name}}</h5>
                    <h5><i class="bi bi-compass"></i> Course: {{$course_name}}</h5>
                    <x-form action="{{route('dashboard.course.final.mark.submit.store')}}" >
                        <input type="hidden" name="session_id" value="{{$current_school_session_id}}">

                        <div class="row mt-3">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Student Name</th>
                                                <th scope="col">Calculated Marks</th>
                                                <th scope="col">Final Marks</th>
                                                <th scope="col">Note</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($students_with_marks)
                                                @foreach ($students_with_marks as $id => $students_with_mark)
                                                <tr>
                                                    <td>{{$students_with_mark[0]->student->first_name}} {{$students_with_mark[0]->student->last_name}}</td>
                                                    @php
                                                        $calculated_marks = 0;
                                                    @endphp
                                                    @foreach ($students_with_mark as $st)
                                                        @php
                                                            $calculated_marks += $st->marks;
                                                        @endphp
                                                    @endforeach
                                                    <td>
                                                        <x-form-input type="number"
                                                            step="0.01"
                                                            name="calculated_mark[{{$students_with_mark[0]->student->id}}]"
                                                            value="{{$calculated_marks}}"
                                                            readonly @if ($final_marks_submitted) disabled @endif />
                                                    </td>
                                                    <td>
                                                        <x-form-input type="number"
                                                            step="0.01"
                                                            name="final_mark[{{$students_with_mark[0]->student->id}}]"
                                                            required @if ($final_marks_submitted) disabled @endif />
                                                    </td>
                                                    <td>
                                                        <x-form-textarea rows="1"
                                                            name="note[{{$students_with_mark[0]->student->id}}]"
                                                            placeholder="Counted best 2 Quizes from 3,..."
                                                            @if ($final_marks_submitted) disabled @endif></x-form-textarea>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endisset
                                           <input type="hidden" name="semester_id" value="{{$semester_id}}">
                                            <input type="hidden" name="class_id" value="{{$class_id}}">
                                            <input type="hidden" name="section_id" value="{{$section_id}}">
                                            <input type="hidden" name="course_id" value="{{$course_id}}">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if (!$final_marks_submitted)
                            <div class="col-3 mb-3">
                            <button type="submit" class="btn btn-outline-primary"><i class="fas fa-check"></i> Save</button>
                        </div>
                        @else
                            <p class="text-success">
                                <i class="fas fa-exclamation-triangle me-2"></i> Marks are submitted.
                            </p>
                        @endif
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>