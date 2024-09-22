<x-app-dashboard name="Student List" icon="graduation-cap">
    <div class="row justify-content-start">
        <div class="col">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h6>Filter list by:</h6>
                    <div class="my-4">
                        <x-form class="row" action="{{route('dashboard.student.list.show')}}" method="GET">
                            <div class="col-sm-6 col-md-4">
                                <x-form-select onchange="getSections(this);" name="class_id" required>
                                    @isset($school_classes)
                                        <option selected disabled>Please select a class</option>
                                        @foreach ($school_classes as $school_class)
                                            <option value="{{$school_class->id}}" {{($school_class->id == request()->query('class_id'))?'selected="selected"':''}}>{{$school_class->class_name}}</option>
                                        @endforeach
                                    @endisset
                                </x-form-select>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <x-form-select id="section-select" name="section_id" required>
                                    <option value="{{request('section_id')}}">{{request('section_name')}}</option>
                                </x-form-select>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt fa-sm"></i> Load List</button>
                            </div>
                        </x-form>
                        @foreach ($studentList as $student)
                            @if ($loop->first)
                                <p class="mt-3"><b>Section:</b> {{$student->section->section_name}}</p>
                                @break
                            @endif
                        @endforeach

                        <div class="bg-white shadow-sm p-3 mt-4">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">ID Card Number</th>
                                        <th scope="col">Photo</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>

                                        <th scope="col">Phone</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($studentList as $student)
                                    <tr>
                                        <th scope="row">{{$student->student->id_number}}</th>
                                        <td>
                                            @if (isset($student->student->image))
                                                <img src="{{asset('/storage/'.$student->student->image)}}" class="rounded" alt="Profile picture" height="30" width="30">
                                            @else
                                                <i class="fas fa-user"></i>
                                            @endif
                                        </td>
                                        <td>{{$student->student->first_name}}</td>
                                        <td>{{$student->student->last_name}}</td>
                                        <td>{{$student->student->email}}</td>
                                        <td>{{$student->student->phone}}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{route('dashboard.student.attendance.show', ['id' => $student->student->user_id])}}" role="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i> Attendance</a>
                                                <a href="{{route('dashboard.student.profile.show',['id' => $student->student->user_id])}}" role="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i> Profile</a>
                                                @can('edit users')
                                                <a href="{{route('dashboard.student.edit.show', ['id' => $student->student->user_id])}}" role="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-pen"></i> Edit</a>
                                                @endcan
                                                {{-- <button type="button" class="btn btn-sm btn-primary"><i class="bi bi-trash2"></i> Delete</button> --}}
                                            </div>
                                        </td>
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

    <script>
        function getSections(obj) {
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
            })
            .catch(function(error) {
                console.log(error);
            });
        }
    </script>
</x-app-dashboard>
