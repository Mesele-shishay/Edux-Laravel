<x-app-dashboard name="View Grading Rules" icon="file-alt">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <div class="mb-4 mt-4">
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">System Name</th>
                                    <th scope="col">Points</th>
                                    <th scope="col">Grade</th>
                                    <th scope="col">Starts At</th>
                                    <th scope="col">Ends At</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($gradeRules)
                                    @foreach ($gradeRules as $gradeRule)
                                    <tr>
                                        <td>{{$gradeRule->gradingSystem->system_name}}</td>
                                        <td>{{$gradeRule->point}}</td>
                                        <td>{{$gradeRule->grade}}</td>
                                        <td>{{$gradeRule->start_at}}</td>
                                        <td>{{$gradeRule->end_at}}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{route('dashboard.exam.grade.rule.delete')}}" role="button" class="btn btn-sm btn-primary"
                                                    onclick="event.preventDefault();document.getElementById('delete-form-{{$gradeRule->id}}').submit();">
                                                    <i class="fas fa-trash-alt fa-sm"></i> Delete</a>
                                                <form id="delete-form-{{$gradeRule->id}}" action="{{route('dashboard.exam.grade.rule.delete') }}" method="POST" class="d-none">
                                                    {{ csrf() }}
                                                    <input type="hidden" name="id" value="{{$gradeRule->id}}">
                                                </form>
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
