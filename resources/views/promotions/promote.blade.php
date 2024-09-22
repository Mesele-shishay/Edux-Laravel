<x-app-dashboard name="Promote Class Section" icon="">
    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
        <div class="row pt-2">
            <div class="col ps-4">
                <p class="text-danger text-center">
                    <small>
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Students must be promoted only once to a new Session. Usually, Admin will create a New Session once Academic activity ends for the Current Session.
                    </small>
                </p>
                <div class="my-3">
                    <x-form action="{{route('dashboard.promotions.store')}}">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr style="font-size : 14px">
                                        <th scope="col">#ID Card Number</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Previous Class</th>
                                        <th scope="col">Previous Section</th>
                                        <th scope="col">Promoting to Class</th>
                                        <th scope="col">Promoting to Section</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($students)
                                        @foreach ($students as $index => $student)
                                        <tr>
                                            <th scope="row">
                                                <input type="text"
                                                    class="form-control form-control-sm"
                                                    name="id_card_number[{{$student->student->user_id}}]"
                                                    value="{{$student->student->user_id}}">
                                            </th>
                                            <td>{{$student->student->first_name}}</td>
                                            <td>{{$student->student->last_name}}</td>
                                            <td>{{$schoolClass->class_name}}</td>
                                            <td>{{$section->section_name}}</td>
                                            <td>
                                                <x-form-select id="inputAssignToClass{{$index}}"
                                                        name="class_id[{{$index}}]"
                                                        onchange="getSections(this, {{$index}});"
                                                        required>
                                                    @isset($school_classes)
                                                        <option selected disabled>Please select a class</option>
                                                        @foreach ($school_classes as $school_class)
                                                            <option value="{{$school_class->id}}">{{$school_class->class_name}}</option>
                                                         @endforeach

                                                     @endisset
                                                </x-form-select>
                                            </td>
                                            <td>
                                                <x-form-select id="inputAssignToSection{{$index}}"
                                                    name="section_id[{{$index}}]"
                                                    required>
                                                </x-form-select>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-outline-primary mb-3"><i class="fas fa-sort-numeric-up-alt"></i> Promote</button>
                    </x-form>

                </div>
            </div>
        </div>
    </div>
    <script>
        function getSections(obj, index) {
            var class_id = obj.options[obj.selectedIndex].value;

            var url = "{{route('get.sections.courses.by.classId')}}?class_id=" + class_id

            fetch(url)
            .then((resp) => resp.json())
            .then(function(data) {
                var sectionSelect = document.getElementById('inputAssignToSection'+index);
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
