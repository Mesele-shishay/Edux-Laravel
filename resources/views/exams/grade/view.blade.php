<x-app-dashboard name="View Grading Systems" icon="file-alt">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <div class="mb-4 p-3 bg-white border shadow-sm table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">System Name</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @isset($gradingSystems)
                                    @foreach ($gradingSystems as $gradingSystem)
                                    <tr>
                                        <td>{{$gradingSystem->system_name}}</td>
                                        <td>{{$gradingSystem->schoolClass->class_name}}</td>
                                        <td>{{$gradingSystem->semester->semester_name}}</td>
                                        <td>{{$gradingSystem->created_at}}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{route('dashboard.exam.grade.rule.create',['grading_system_id' => $gradingSystem->id])}}"
                                                    role="button"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-plus"></i> Add Rule</a>

                                                <a href="{{route('dashboard.exam.grade.rule.show',['grading_system_id' => $gradingSystem->id]) }}"
                                                    role="button"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i> View Rules</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>
