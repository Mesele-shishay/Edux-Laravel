<x-app-dashboard name="Add Teacher" icon="address-card">
    <x-form action="{{ route('dashboard.teacher.store')}}" enctype="multipart/form-data">
       <div class="row justify-content-start">
           <input type="hidden" name="role" value="teacher">
           <input type="hidden" name="admission" value="{{ $current_school_session ? $current_school_session->session_name : '' }}">
           <div class="col-md-4">
               <x-form-input label="First Name" id="fname"
                    placeholder="First Name"
                    name="fname"
                    required />
           </div>

           <div class="col-md-4">
                <x-form-input label="Last Name"  id="lname"
                        placeholder="Last Name"
                        name="lname"
                        required />
           </div>

           <div class="col-md-4">
               <!-- Profile image upload input -->
               <x-form-file label="Photo" required id="teacher_photo" name="teacher_photo"  required/>
           </div>

           <div class="col-md-4">
                <x-form-input type="date"  name="birthDate" id="birthDate"
                       placeholder="Date Of Birth"
                       label="Birth Date"
                       required />
           </div>

           <div class="col-md-4 pb-3">
              <x-form-select label="Gender" id="gender" name="gender" required>
                  <option value="Gender" disabled selected>Select Gender</option>
                  <option value="Male" @selected(old('gender') == 'Male')  >Male</option>
                  <option value="Female" @selected(old('gender') == 'Female') >Female</option>
              </x-form-select>
           </div>

           <div class="col-md-4 pb-3">
               <x-form-select name="zone" id="zone" label="Zone" required>
                   <option value="" disabled selected>Zone</option>
                   <option value="West"  @selected(old('zone') == 'West')>ምዕራብ</option>
                   <option value="South"  @selected(old('zone') == 'South')>ደቡብ</option>
                   <option value="East"  @selected(old('zone') == 'East') >ምብራቕ</option>
                   <option value="North" @selected(old('zone') == 'North')>ሰሜን ምዕራብ</option>
               </x-form-select>
           </div>

           <div class="col-md-4 pb-3">
               <x-form-select name="field" id="field" label="Field" required>
                   <option value="" disabled selected>Select Field Type</option>
                   <option value="Natural"  @selected(old('field') == 'Natural')>Natural Science</option>
                   <option value="Social" @selected(old('field') == 'Social')>Social Science</option>
               </x-form-select>
           </div>

           <div class="col-md-4">
               <x-form-input label="Woreda/Ketema"  id="woreda"
                    placeholder="Woreda or Ketema"
                    name="woreda"
                    required />
           </div>

           <div class="col-md-4">
               <!-- Phone number input -->
               <div class="form-group">
                   <label for="phoneNumber">Phone Number</label><sup><i class="fas fa-asterisk text-primary"></i></sup><
                   <div class="input-group">
                       <div class="input-group-prepend">
                           <span class="input-group-text">+251</span>
                       </div>
                       <input type="number" class="form-control  @error('phoneNumber') is-invalid @enderror" id="phoneNumber"
                           placeholder="phone number" name="phoneNumber" value="{{ old('phoneNumber') }}" required>
                           {{-- <x-error name="phoneNumber"> --}}
                   </div>
               </div>
            </div>

           <div class="col-md-12">
               <!-- Submit Button  -->
               <div class="mb-3">
                   <button name="submit" id="signUpRegisterBtn" type="submit" class="btn btn-sm btn-outline-primary">
                       <span class="fas fa-user-plus fa-sm"></span> Add</button>
               </div>
           </div>
       </div>
    </x-form>
</x-app-dashboard>
