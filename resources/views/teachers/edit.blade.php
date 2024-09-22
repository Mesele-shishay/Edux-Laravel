<x-app-dashboard name="Edit Teacher" icon="person-lines-fill">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <div class="mb-4">
                        <x-form class="row g-3" action="{{route('dashboard.teacher.update')}}">
                            <input type="hidden" name="teacher_id" value="{{$teacher->user_id}}">

                            <div class="col-md-4">
                                <x-form-input label="First Name" id="inputFirstName" name="first_name" placeholder="First Name" required value="{{$teacher->first_name}}" />
                            </div>

                            <div class="col-md-4">
                                <x-form-input label="Last Name" id="inputLastName" name="last_name" placeholder="Last Name" required value="{{$teacher->last_name}}" />
                            </div>

                            <div class="col-md-4">
                                <x-form-input label="Woreda/Ketema" id="inputAddress" name="woreda" placeholder="634 Main St" required value="{{$teacher->woreda}}" />
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="phoneNumber">Phone Number</label><sup><i class="fas fa-asterisk text-primary"></i></sup>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+251</span>
                                    </div>
                                <input type="text" class="form-control" id="inputPhone" name="phone_number" placeholder="+880 01......" required value="{{$teacher->phone_number}}">

                                </div>
                            </div>


                            <div class="col-md-4">
                                <x-form-select id="inputState" label="Gender" name="gender" required>
                                    <option value="Male"  @selected($teacher->gender == 'Male')>Male</option>
                                    <option value="Female" @selected($teacher->gender == 'Female')>Female</option>
                                </x-form-select>
                            </div>

                            <div class="col-12 mb-3">
                                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-person-check"></i> Update</button>
                            </div>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>