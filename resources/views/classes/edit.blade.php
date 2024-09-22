<x-app-dashboard name="Edit Class" icon="upload">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col-md-6 ps-4">
                    <div class="row">
                        @if ($class_id and $schoolClass)
                            <x-form class="col" action="{{route('dashboard.class.update')}}">
                                <input type="hidden" name="session_id" value="{{$current_school_session_id}}">
                                <input type="hidden" name="class_id" value="{{$class_id}}">
                                <x-form-input id="class_name" name="class_name"
                                        label="Class Name"
                                        value="{{$schoolClass->class_name}}" required/>
                                        <button
                                            type="submit"
                                            class="btn btn-outline-primary mb-3">
                                            <i class="fas fa-sm fa-check "></i>
                                            Save
                                        </button>
                            </x-form>
                        @else
                            <p class="text-danger">No Class Found With That id</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>
