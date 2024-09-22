<x-app-dashboard name="Student" icon="user">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-sm-4 col-md-3 mb-3">
                                <div class="card bg-light">
                                    <div class="px-5 pt-2">
                                        @if (isset($student->profile->image))
                                            <img src="{{asset('/storage/'.$student->profile->image)}}" class="rounded-3 card-img-top" alt="Profile photo">
                                        @else
                                            <img src="{{asset('img/default.png')}}" class="rounded-3 card-img-top" alt="Profile photo">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$student->profile->first_name}} {{$student->profile->last_name}}</h5>
                                        <p class="card-text"><span class="fw-bold">#ID:</span> {{$student->profile->id_number}}</p>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><span class="fw-bold">Gender: </span>{{$student->profile->gender}}</li>
                                        <li class="list-group-item"><span class="fw-bold">Phone: </span>0{{$student->profile->phone_number}}</li>

                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-8 col-md-9">
                                <div class="p-3 mb-3 border rounded bg-white table-responsive ">
                                    <h6>Student Information</h6>
                                    <table class="table mt-3">
                                        <tbody>
                                            <tr>
                                                <th scope="row">First Name:</th>
                                                <td>{{$student->profile->first_name}}</td>
                                                <th>Last Name:</th>
                                                <td>{{$student->profile->last_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Birthday:</th>
                                                <td class="pe-5">{{$student->profile->birth_date}}</td>
                                                <th scope="rjow">City:</th>
                                                <td>{{$student->profile->woreda}}</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Gender:</th>
                                                <td colspan="3">{{$student->profile->gender}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="p-3 mb-3 border rounded bg-white table-responsive">
                                    <h6>Parents' Information</h6>
                                    <table class="table mt-3">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Father's Name:</th>
                                                <td>{{$student->parent_info->father_name}}</td>
                                                <th>Mother's Name:</th>
                                                <td>{{$student->parent_info->mother_name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Father's Phone:</th>
                                                <td>+251{{$student->parent_info->father_phone}}</td>
                                                <th>Mother's Phone:</th>
                                                <td>+251{{$student->parent_info->mother_phone}}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="p-3 mb-3 border rounded bg-white table-responsive">
                                    <h6>Academic Information</h6>
                                    <table class="table mt-3">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Class:</th>
                                                <td>{{ $promotion_info->schoolClass->class_name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Section:</th>
                                                <td colspan="3">{{ $promotion_info->section->section_name}}</td>
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
</x-app-dashboard>