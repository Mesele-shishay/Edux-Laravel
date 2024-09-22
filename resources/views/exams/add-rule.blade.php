<x-app-dashboard name="Exam Rules" icon="file">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="p-3 border bg-light shadow-sm">
                                <x-form action="{{route('dashboard.exam.rule.store')}}">
                                    <input type="hidden" name="exam_id" value="{{$exam_id}}">
                                    <input type="hidden" name="session_id" value="{{$current_school_session_id}}">

                                    <x-form-input type="number" id="inputTotalMarks" placeholder="10, 100, ..." name="total_marks" step="0.01" label="Total Marks" required />

                                    <x-form-input type="number" id="inputPassMarks" placeholder="5, 33, ..." name="pass_marks" step="0.01" required label="Pass Marks" />

                                    <x-form-textarea id="inputMarksDistributionNote" rows="3" placeholder="Written: 7, MCQ: 3, ..." name="marks_distribution_note" required />

                                    <button type="submit" class="mt-3 btn btn-sm btn-outline-primary">
                                        <i class="fas fa-plus"></i> Add
                                    </button>

                                </x-form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>