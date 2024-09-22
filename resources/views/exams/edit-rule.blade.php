<x-app-dashboard name="Edit Exam Rule" icon="file-plus">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <div class="row">
                        <div class="col-md-5 mb-4">
                            <div class="p-3 border bg-light shadow-sm">

                                <x-form action="{{ route('dashboard.exam.rule.update')}}">

                                    <input type="hidden" name="exam_rule_id" value="{{$exam_rule_id}}">

                                    <x-form-input label="Total Marks" type="number"  id="inputTotalMarks" value="{{$exam_rule->total_marks}}" name="total_marks" step="0.01" required/>

                                    <x-form-input label="Pass Marks" type="number" id="inputPassMarks" value="{{$exam_rule->pass_marks}}" name="pass_marks" step="0.01" required/>

                                    <x-form-textarea label="Marks Distribution Note" id="inputMarksDistributionNote" rows="3" name="marks_distribution_note" required>
                                        {{$exam_rule->marks_distribution_note}}
                                    </x-form-textarea>

                                    <button type="submit" class="mt-3 btn btn-sm btn-outline-primary">
                                        <i class="fas fa-check"></i> Save
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