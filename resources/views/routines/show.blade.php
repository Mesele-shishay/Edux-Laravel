<x-app-dashboard name="Show Routine" icon="">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    @if (count($routines) > 0 )
                        <div class="bg-white p-3 border shadow-sm">
                            <table class="table table-bordered text-center">
                                </thead>
                                <tbody>
                                    @foreach($routines as $day => $courses)
                                    <tr><th>{{getDayName($day)}}</th>
                                        @php
                                            $courses = $courses->sortBy('start');
                                        @endphp
                                        @foreach($courses as $course)
                                            <td>
                                                <span>{{$course->course->course_name}}</span>
                                                <div>{{$course->start}} - {{$course->end}}</div>
                                            </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                    <div class="p-3 bg-white border shadow-sm">No routine.</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>


