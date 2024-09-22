<x-app-dashboard name="Teacher Profile" icon="user">
    @if ($teacher != null)
        <div class="row justify-content-start">
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
                <div class="row pt-2">
                    <div class="col ps-4">
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-sm-4 col-md-3">
                                    <div class="card bg-light">
                                        <div class="px-5 pt-2">
                                           @if (isset($teacher->image))
                                                <img src="{{asset('/storage/'.$teacher->image)}}" class="rounded-3 card-img-top" alt="Profile photo">
                                            @else
                                                <img src="{{asset('img/profile.png')}}" class="rounded-3 card-img-top" alt="Profile photo">
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{$teacher->first_name}} {{$teacher->last_name}}</h5>
                                            <p class="card-text"><span class="fw-bold">#ID:</span> {{$teacher->id_number}}</p>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><span class="fw-bold">Gender: </span>{{$teacher->gender}}</li>
                                            <li class="list-group-item"><span class="fw-bold">Phone: </span>0{{$teacher->phone_number}}</li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-8 col-md-9">
                                    <div class="p-3 mb-3 border rounded bg-white table-responsive">
                                        <h6>Teacher Information</h6>
                                        <table class="table mt-3">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">First Name:</th>
                                                    <td>{{$teacher->first_name}}</td>
                                                    <th>Last Name:</th>
                                                    <td>{{$teacher->last_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Birthday:</th>
                                                    <td class="pe-5">{{$teacher->birth_date}}</td>
                                                    <th scope="row">City:</th>
                                                    <td>{{$teacher->woreda}}</td>
                                                </tr>

                                                <tr>
                                                    <th scope="row">Gender:</th>
                                                    <td colspan="3">{{$teacher->gender}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p class="text-danger">Teacher Not found with that is</p>
    @endif
</x-app-dashboard>