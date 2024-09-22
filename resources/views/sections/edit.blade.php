<x-app-dashboard name="Edit Section" icon="project-diagram">
     <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3"></h1>
                    <div class="row">
                        <x-form class="col-md-6" action="{{ route('dashboard.section.update')}}">

                            <input type="hidden" name="session_id" value="{{$current_school_session_id}}">
                            <input type="hidden" name="section_id" value="{{$section_id}}">

                            <x-form-input id="section_name" name="section_name" value="{{$section->section_name}}" label="Section Name" required />

                            <x-form-input id="room_no" name="room_no"  value="{{$section->room_no}}" label="Room number" required/>

                            <button type="submit" class="btn btn-outline-primary mb-3"><i class="fas fa-check fa-sm"></i> Save</button>

                        </x-form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>