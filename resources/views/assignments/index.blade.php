<x-app-dashboard name="Assignments" icon="journal-medical">
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
                <div class="row pt-2">
                    <div class="col ps-4">
                        <div class="mb-4 mt-4">
                            <div class="p-3 mt-3 bg-white border shadow-sm">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Assignment Name</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($assignments as $assignment)
                                           <tr>
                                               <td>{{$assignment->assignment_name}}</td>
                                               <td>
                                                   <div class="btn-group" role="group">
                                                       <a href="{{asset('storage/'.$assignment->assignment_file_path)}}" role="button" class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i> Download</a>
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
        </div>
    </div>
</x-app-dashboard>
