<x-app-dashboard name="Add Grading Rule" icon="file-alt">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <div class="row">
                        <div class="col-md-5 mb-4">
                            <div class="p-3 border bg-light">

                                <x-form action="{{route('dashboard.exam.grade.rule.store')}}">

                                    <input type="hidden" name="grading_system_id" value="{{$grading_system_id}}">
                                    <input type="hidden" name="session_id" value="{{$current_school_session_id}}">

                                    <x-form-input label="Point" type="number" step="0.01" name="point" id="inputPoint" placeholder="3.5, 4.0, ..." required />

                                    <x-form-input label="Grade" type="text" name="grade" step="0.01"  id="inputGrade" placeholder="A+, A-, ..." required />

                                    <x-form-input label="Starts" type="number" step="0.01" name="start_at"  id="inputStarts" placeholder="90, 85, ..." required />

                                    <x-form-input label="End" ttype="number" step="0.01" name="end_at" id="inputEnds" placeholder="100, 89, ..." required />

                                    <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i class="fas fa-plus"></i> Add</button>

                                </x-form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>