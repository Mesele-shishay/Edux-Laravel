<x-app-dashboard name="Edit Student" icon="person-lines-fill">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <div class="mb-4">
                        <x-form class="row g-3" action="{{route('dashboard.student.student.update')}}">
                            <input type="hidden" name="student_id" value="{{$student->id}}">
                            <div class="row g-3">
                                <div class="col-11 col-md-4 col-lg-3">
                                    <x-form-input label="First Name" id="inputFirstName"
                                        name="first_name"
                                        placeholder="First Name"
                                        required
                                        value="{{$student->profile->first_name}}"/>
                                </div>

                                <div class="col-11 col-md-4 col-lg-3">
                                    <x-form-input label="Last Name" id="inputLastName"
                                        name="last_name"
                                        placeholder="Last Name"
                                        required
                                        value="{{$student->profile->last_name}}"/>
                                </div>

                                <div class="col-11 col-md-4 col-lg-3">
                                    <x-form-input type="date" label="Birthday"
                                        id="inputBirthday"
                                        name="birth_date"
                                        placeholder="Birthday"
                                        required
                                        value="{{$student->profile->birth_date}}"/>
                                </div>

                                <div class="col-11 col-md-4 col-lg-3">
                                    <x-form-input  label="Woreda/Ketema" id="inputWoreda"
                                        name="woreda"
                                        placeholder="634 Main St"
                                        required
                                        value="{{$student->profile->woreda}}"/>
                                </div>

                                <div class="col-11 col-md-4 col-lg-3">
                                    <x-form-select id="inputState" label="Gender" name="gender" required>
                                        <option value="Male" @selected($student->profile->gender == 'Male' )>Male</option>
                                        <option value="Female" @selected($student->profile->gender == 'Female')>Female</option>
                                    </x-form-select>
                                </div>

                                <div class="col-11 col-md-4 col-lg-3">
                                    <x-form-input  label="Phone" id="inputPhone"
                                        name="phone_number"
                                        placeholder="+880 01......"
                                        required
                                        value="{{$student->profile->phone_number}}"/>
                                </div>

                                <div class="col-11 col-md-4 col-lg-3">
                                    <x-form-input type="text" label="Id Card Number"
                                        id="inputIdCardNumber"
                                        name="id_card_number"
                                        placeholder="e.g. 2021-03-01-02-01 (Year Semester Class Section Roll)"
                                        required
                                        value="{{$promotion_info->student_id}}"/>
                                </div>
                            </div>

                            <h6 class="mb-3">Parents' Information</h6>
                            <div class="row g-3">

                                <div class="col-11 col-md-4 col-lg-3">
                                    <x-form-input label="Father Name"
                                        id="inputFatherName"
                                        name="father_name"
                                        placeholder="Father Name"
                                        required
                                        value="{{$parent_info->father_name}}"/>
                                </div>

                                <div class="col-11 col-md-4 col-lg-3">
                                    <x-form-input class="Father's Phone" id="inputFatherPhone"
                                        label="Father's Phone"
                                        name="father_phone"
                                        placeholder="+880 01......"
                                        required
                                        value="{{$parent_info->father_phone}}"/>
                                </div>
                                <div class="col-11 col-md-4 col-lg-3">
                                    <x-form-input type="text" label="Mother Name"
                                        id="inputMotherName"
                                        name="mother_name"
                                        placeholder="Mother Name"
                                        required
                                        value="{{$parent_info->mother_name}}"/>
                                </div>
                                <div class="col-11 col-md-4 col-lg-3">
                                    <x-form-input type="text" label="Mother's Phone"
                                        id="inputMotherPhone"
                                        name="mother_phone"
                                        placeholder="+880 01......"
                                        required
                                        value="{{$parent_info->mother_phone}}"/>
                                </div>
                            </div>
                            <div class="col ps-0">
                                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-person-check"></i> Update</button>
                            </div>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewFile() {
            const preview = document.querySelector('#previewPhoto');
            preview.innerHTML = '';

            const photoHiddenInput = document.querySelector('#photoHiddenInput');
            const file = document.querySelector('input[type=file]').files[0];

            if ( /\.(jpe?g|png)$/i.test(file.name) ) {
                const sizeInKB = Math.round(parseInt(file.size)/1024);
                const sizeLimit= 500; // 500 KB

                if (sizeInKB > sizeLimit) {
                    alert(`Allowed file size: ${sizeLimit} KB.\nYour file size: ${sizeInKB} KB`);
                } else {
                    const reader = new FileReader();

                    reader.addEventListener("load", function () {
                        var image = new Image();
                        image.height = 100;
                        image.title = file.name;
                        // convert image file to base64 string
                        image.src = this.result;
                        preview.appendChild( image );
                        photoHiddenInput.value = this.result;
                    }, false);

                    if (file) {
                        reader.readAsDataURL(file);
                    }
                }
            } else {
                alert('Allowed file types: jpeg, jpg, png');
            }
        }
    </script>
</x-app-dashboard>