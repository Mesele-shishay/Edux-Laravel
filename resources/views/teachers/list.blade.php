<x-app-dashboard name="Teachers List" icon="graduation-cap">
    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
        <div class="row pt-2">
            <div class="col ps-4">
                <div class="mb-4  p-2 bg-white border shadow-sm">
                    <table class="table table-responsive">
                        <thead>
                            <tr class='small'>
                                <th scope="col">Photo</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <th scope="row">{{$teacher->id_number}}</th>
                                    <td>
                                        @if (isset($teacher->photo))
                                            <img src="{{asset('/storage'.$teacher->image)}}" class="rounded" alt="Profile picture" height="30" width="30">
                                        @else
                                            <i class="fas fa-user"></i>
                                        @endif
                                    </td>
                                    <td>{{$teacher->first_name}}</td>
                                    <td>{{$teacher->last_name}}</td>

                                    <td>0{{$teacher->phone_number}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{route('dashboard.teacher.profile.show',['id'=>$teacher->id])}}" role="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i> Profile</a>
                                            @can('edit users')
                                            <a href="{{route('dashboard.teacher.edit.show', ['id' => $teacher->id])}}" role="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-pen"></i> Edit</a>
                                            @endcan
                                            {{-- <button type="button" class="btn btn-sm btn-primary"><i class="bi bi-trash2"></i> Delete</button> --}}
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
</x-app-dashboard>