<x-app-dashboard name="Add Studen" icon="address-card">
    <x-form action="{{ route('dashboard.student.store')}}" enctype="multipart/form-data">

        <p class="text-primary">
            <small><i class="fas fa-exclamation me-2"></i> Remember to create related "Class" and "Section" before adding student</small>
        </p>

        <div class="row justify-content-start">
            <input type="hidden" name="role" value="student">
            <input type="hidden" name="session_id" value="{{ $current_school_session_id}}">

            <div class="col-md-4">
                <x-label required label="First Name" />
                <x-form-input
                        id="fname"
                        placeholder="First Name"
                        name="fname"
                        required />
            </div>

            <div class="col-md-4">
                <x-label label="Last Name"  required/>
                <x-form-input id="lname"
                        placeholder="Last Name"
                        name="lname"
                        required />

            </div>

            <div class="col-md-4">
                <x-form-file label="Photo" required name="student_photo" id="photo"/>
            </div>

            <div class="col-md-4">
                <x-form-input type="date"
                    label="Birth Date"
                    name="birthDate"
                    id="birthDate"
                    placeholder="Date Of Birth"
                    required />
            </div>

            <div class="col-md-4">
               <x-form-select id="gender" name="gender" label="Gender" required>
                   <option value="Gender" disabled selected>Select Gender</option>
                   <option value="Male" @selected(old('gender') == 'Male')  >Male</option>
                   <option value="Female" @selected(old('gender') == 'Female') >Female</option>
               </x-form-select>
            </div>

            <div class="col-md-4">
                <x-form-select name="zone" id="zone" label="Zone" required>
                    <option value="" disabled selected>Zone</option>
                    <option value="West" @selected(old('zone') == 'West')>ምዕራብ</option>
                    <option value="South" @selected(old('zone') == 'South')>ደቡብ</option>
                    <option value="East" @selected(old('zone') == 'East') >ምብራቕ</option>
                    <option value="North" @selected(old('zone') == 'North')>ሰሜን ምዕራብ</option>
                </x-form-select>
            </div>

            <div class="col-md-4">
                <x-form-select name="field" id="field" label="Field" required>
                    <option value="" disabled selected>Select Field Type</option>
                    <option value="Natural" @selected(old('field') == 'Natural') >Natural Science</option>
                    <option value="Social" @selected(old('field') == 'Social') >Social Science</option>
                </x-form-select>
            </div>

            <div class="col-md-4">
                <x-form-input label="Woreda/Ketema"
                    id="woreda"
                    placeholder="Woreda or Ketema"
                    name="woreda"
                    required />
            </div>


            <div class="col-md-4">
               <x-form-input label="Phone Number" id="phoneNumber"
                    placeholder="phone number"
                    name="phoneNumber"
                    required>
                   <x-slot name="prepend">
                       +251
                   </x-slot>
               </x-form-input>
            </div>

            <h6 class="col-md-12 mb-0 my-3">
                <p>Parent's Information</p>
            </h6>

            <div class="col-md-3">
                <x-form-input label="Father's Name"
                        id="father_name"
                        placeholder="Father's Name"
                        name="father_name"
                        required/>
            </div>

           <div class="col-md-3">
                <x-form-input label="Father's Phone" id="father_phone"
                     placeholder="father's Phone"
                     name="father_phone"
                     required>
                    <x-slot name="prepend">
                        +251
                    </x-slot>
                </x-form-input>
           </div>

            <div class="col-md-3">
                <x-form-input
                    label="Mother's Name"
                    id="mother_name"
                    placeholder="Mother's Name"
                    name="mother_name"
                    required />
            </div>

            <div class="col-md-3">
                <x-form-input label="Mother's Phone" id="mother_phone"
                     placeholder="Mother's Phone"
                     name="mother_phone"
                     required>
                    <x-slot name="prepend">
                        +251
                    </x-slot>
                </x-form-input>

            </div>

            <h6 class="col-md-12 mt-3">
                <p>Academic Information</p>
            </h6>

            <div class="col-md-4">
                <x-form-select onchange="getSections(this);"
                        label="Assign to class"
                        id="assignToClass"
                        name="class_id"
                        required>
                    <option selected disabled>
                        @if ($school_classes)
                            Please select a class
                        @else
                            There is no class
                        @endif
                    </option>
                    @foreach ($school_classes as $class)
                        <option value="{{$class->id}}" >{{$class->class_name}}</option>
                    @endforeach
                </x-form-select>
            </div>

            <div class="col-md-4">
                <x-form-select label="Assign to section"
                        id="assignToSection"
                        name="section_id"
                        required>
                </x-form-select>
            </div>
        </div>

        <div class="col-md-12 ps-0">
            <!-- Submit Button  -->
            <div class="mb-3">
                <button name="submit" id="signUpRegisterBtn" type="submit" class="btn btn-sm btn-outline-primary">
                    <span class="fas fa-user-plus fa-sm"></span> Add</button>
            </div>
        </div>
    </x-form>

    <script>
        function getSections(obj) {
            var class_id = obj.options[obj.selectedIndex].value;

            var url = "{{route('get.sections.courses.by.classId')}}?class_id=" + class_id

            fetch(url).then((resp) => resp.json())
            .then(function(data) {
                var sectionSelect = document.getElementById('assignToSection');
                sectionSelect.options.length = 0;
                length = data.sections.unshift({'id': 0,'section_name': 'Please select a section'})
                data.sections.forEach(function(section, key) {
                    if (length > 1) {
                        sectionSelect[key] = new Option(section.section_name, section.id);
                    }else{
                        sectionSelect[key] = new Option("There is not section", section.id);
                    }
                });
            })
            .catch(function(error) {
                console.log(error);
            });
        }
    </script>
</x-app-dashboard>