<x-app-dashboard name="Promote Class Section" icon="upload">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <div class="my-4">
                        <x-form action="{{route('dashboard.promotions.index')}}" method="GET">
                            <x-label  label="Filter list by" required/>
                            <div class="row">
                                <div class="col-sm-11 col-md-5 col-lg-6">
                                    <x-form-select name="class_id">
                                        @if (isset($previousSessionClasses))
                                            <option selected disabled>Please select a class</option>
                                            @foreach ($previousSessionClasses as $school_class)
                                                <option value="{{$school_class->schoolClass->id}}">
                                                    {{$school_class->schoolClass->class_name}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </x-form-select>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt fa-sm"></i> Load List</button>
                                </div>
                            </div>
                        </x-form>
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">Section Name</th>
                                    <th scope="col">Promotion Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($previousSessionSections))
                                    @foreach ($previousSessionSections as $previousSessionSection)
                                    <tr>
                                        <td>{{$previousSessionSection->section->section_name}}</td>
                                        <td>{{$currentSessionSectionsCounts > 0 ? 'Promoted' : 'Not Promoted' }}</td>
                                        <td>
                                            @if ($currentSessionSectionsCounts > 0)
                                                {{'No action needed'}}
                                            @else
                                            <div class="btn-group" role="group">
                                                    <a href="{{route('dashboard.promotions.create',[
                                                        'previousSessionId' => $previousSessionId,
                                                        'previous_section_id'=> $previousSessionSection->section->id,
                                                        'previous_class_id' => $class_id
                                                        ]) }}"
                                                        role="button"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-sort-numeric-up-alt"></i> Promote</a>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>
