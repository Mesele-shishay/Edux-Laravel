<x-app-dashboard name="Exam Rules" icon="file-text">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <div class="mb-4 bg-white border shadow-sm p-3">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">Total Marks</th>
                                    <th scope="col">Pass Marks</th>
                                    <th scope="col">Marks Distribution Note</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exam_rules as $exam_rule)
                                <tr>
                                    <td>{{$exam_rule->total_marks}}</td>
                                    <td>{{$exam_rule->pass_marks}}</td>
                                    <td>{{$exam_rule->marks_distribution_note}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a  href="{{route('dashboard.exam.rule.edit',['exam_rule_id'=> $exam_rule->id ])}}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-pen"></i> Edit
                                            </a>
                                             <button type="button" class="btn btn-sm btn-primary">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                 @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>