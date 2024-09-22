<x-app-dashboard name="Academic Settings" icon="cogs">
	<div class="row">
		@if ($latest_school_session_id == $current_school_session_id )
			<div class="col-md-6 col-lg-4 px-0">
			    <div class="container-fluid px-3">
			    	@if ($latest_school_session_id == $current_school_session_id)
			    		<div class="mb-3">
			    		    <div class="p-3 border bg-light shadow-sm">
			    		        <h6>Create Session</h6>
			    		        <p class="text-danger">
			    		            <small><i class="fas fa-exclamation-triangle me-2"></i> Create one Session per academic year. Last created session will be considered as the latest academic session.</small>
			    		        </p>

			    		        <label>Session Name: <sup><i class="fas fa-asterisk text-primary"></i></sup></label>
			    		        <x-form action="{{route('dashboard.session.store')}}">
			    		        	<div class="mb-3">
			    		        		<x-form-input size="sm"
			    		        					placeholder="2021 - 2022"
			    		                     		aria-label="Current Session"
			    		                     		name="session_name"
			    		                     		required>
			    		        		</x-form-input>
			    		        		<button class="btn btn-sm btn-outline-primary" type="submit"><i class="fas fa-check fa-xs"></i> Create</button>
			    		        	</div>
			    		        </x-form>
			    		    </div>
			    		</div>
			    	@endif

			       <div class="mb-3">
			           <div class="p-3 border bg-light shadow-sm">
			               <h6>Attendance Type</h6>
			               <p class="text-danger">
			                   <small><i class="fas fa-exclamation-triangle me-2"></i> Do not change the type in the middle of a Semester.</small>
			               </p>

			               <x-form action="{{ route('dashboard.attendance.type.update') }}">
				               	<x-radio-button id="attendance_type_section"
				               				name="attendance_type"
				               				value="section"
				               				:check="$academic_setting->attendance_type == 'section'"
				               				label="Attendance by Section"/>


				               	<x-radio-button id="attendance_type_course"
				               				name="attendance_type"
				               				value="course"
				               				:check="$academic_setting->attendance_type == 'course'"
				               				label="Attendance by Course"/>

				               <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i class="fas fa-check fa-xs"></i> Save</button>
				            </x-form>

			           </div>
			       </div>

			       <div class="mb-3">
			           <div class="p-3 border bg-light shadow-sm">
			               <h6>Assign Teacher</h6>
			               <x-form action="{{ route('dashboard.teacher.assign') }}">
			                   <input type="hidden" name="session_id" value="{{ $current_school_session_id }}">

			                   <x-form-select label="Select Teacher" name="teacher_id" required>
			                   		@if (isset($teachers))
			                   			@foreach ($teachers as $teacher)
			                   				<option value="{{$teacher->user_id}}">{{$teacher->full_name}}</option>
			                   			@endforeach
			                   		@endif
			                   </x-form-select >

			               		<x-form-select label="Assign to semester" name="semester_id">
			               			@if (isset($semesters))
			               				@foreach ($semesters as $semester)
			               					<option value="{{$semester->id}}">{{$semester->semester_name }}</option>
			               				@endforeach
			               			@endif
			               		</x-form-select>

			               		<x-form-select label="Assign to class" name="class_id" onchange="getSectionsAndCourses(this);">
			               			@if (isset($school_classes))
			               				<option selected disabled>Please select a class</option>
			               				@foreach ($school_classes as $school_class)
			               					<option value="{{$school_class->id}}">{{$school_class->class_name }}</option>
			               				@endforeach
			               			@endif
			               		</x-form-select>

			               		<x-form-select label="Assign to section" name="section_id"  id="section-select"/>

			               		<x-form-select label="Assign to course" name="course_id"  id="course-select"/>

			               		<button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i class="fas fa-check fa-xs"></i> Save</button>
			               </x-form>

			           </div>
			       </div>

			    </div>
			</div>
		@endif

		<div class="col-md-6 col-lg-4 px-0">
		    <div class="container-fluid px-3">
		        <div class="mb-3">
		             <div class="p-3 border bg-light shadow-sm">
		                 <h6>Browse by Session</h6>
		                 <p class="text-danger">
		                     <small><i class="fas fa-exclamation-triangle me-2"></i> Only use this when you want to browse data from previous Sessions.</small>
		                 </p>

		                 <x-form action="{{route('dashboard.session.browse')}}">
		                 	<div class="mb-3">
		                 		<x-form-select name="session_id" label='Select "Session" to browse by '>
	                 				@if ($school_sessions)
	                 					@foreach ($school_sessions as $school_session)
	                 						<option value="{{$school_session->id}}" @selected($loop->last)>{{$school_session->session_name}}
	                 			         </option>
	                 					@endforeach
	                 				@endif
		                 		</x-form-select>
		                 		<button class="btn btn-sm btn-outline-primary" type="submit"><i class="fas fa-check fa-xs"></i> Set</button>
		                 	</div>
		                 </x-form>
		             </div>
		        </div>

		        @if ( $latest_school_session_id == $current_school_session_id)
		        	<div class="mb-3">
		        	    <div class="p-3 border bg-light shadow-sm">
		        	        <h6>Create Class</h6>
		        	        <x-form action="{{ route('dashboard.class.store') }}">
		        	        	<input type="hidden" name="session_id" value="{{ $current_school_session_id  }}">
		        	        	<div class="mb-3">
		        	        	    <x-form-input size="sm" name="class_name" placeholder="Class name" aria-label="Class name" required/>
		        	        	</div>
		        	        	<button class="btn btn-sm btn-outline-primary" type="submit"><i class="fas fa-check fa-xs"></i> Create</button>
		        	        </x-form>

		        	    </div>
		        	</div>

		        	<div class="mb-3">
		        	    <div class="p-3 border bg-light shadow-sm">
		        	        <h6>Create Course</h6>

		        	        <x-form action="{{ route('dashboard.course.store') }}">
		        	        	<input type="hidden" name="session_id" value="{{ $current_school_session_id }}">
		        	        	<div class="mb-1">
		        	        	    <x-form-input label="Course Name" size="sm" name="course_name" placeholder="Course name" aria-label="Course name" required/>
		        	        	</div>

		        	        	<div class="mb-3">
		        	        	    <x-form-select label="Course Type" class="select2" name="course_type" required id="timezone">
		        	        	    	<option value="Core">Core</option>
		        	        	    	<option value="General">General</option>
		        	        	    	<option value="Elective">Elective</option>
		        	        	    	<option value="Optional">Optional</option>
		        	        	    </x-form-select>
		        	        	</div>

		        	        	<div class="mb-3">
		        	        	    <x-form-select label="Assign to semester" name="semester_id" required>
		        	        	    		@if (isset($semesters))
		        	        	    			@foreach ($semesters as $semester)
		        	        	    	            <option value={{ $semester->id }}>{{ $semester->semester_name }}</option>

		        	        	    			@endforeach
		        	        	    		@endif
		        	        	    </x-form-select>
		        	        	</div>

		        	        	<div class="mb-3">
		        	        	    <x-form-select label="Assign to class" name="class_id" required>
		        	        	    	@if (isset($school_classes))
		        	        	    		@foreach ($school_classes as $class)
		        	        	    	        <option value="{{ $class->id }}">{{ $class->class_name }}</option>

		        	        	    		@endforeach
		        	        	    	@endif
		        	        	    </x-form-select>
		        	        	</div>

		        	        	<button class="btn btn-sm btn-outline-primary" type="submit"><i class="fas fa-check fa-xs"></i> Create</button>

		        	        </x-form>
		        	    </div>
		        	</div>

		        @endif
		    </div>
		</div>

		<div class="col-md-6 col-lg-4 px-0">
		    <div class="container-fluid px-3">
		    	@if ($current_school_session_id == $latest_school_session_id)
		    		<div class="mb-3">
		    		    <div class="p-3 border bg-light shadow-sm">
		    		        <h6>Create Semester for Current Session</h6>

		    		        <x-form action="{{route('dashboard.semester.store')}}">
		    		        	<input type="hidden" name="session_id" value="{{ $current_school_session_id }}">
		    		        	<div class="mt-2">
		    		        	    <p>Semester name<sup><i class="fas fa-asterisk text-primary"></i></sup></p>
		    		        	    <x-form-input size="sm" name="semester_name" required placeholder="First Semester"/>
		    		        	</div>

		    		        	<div class="mt-2">
		    		        	    <label for="inputStarts" class="form-label">Starts<sup><i class="fas fa-asterisk text-primary"></i></sup></label>
		    		        	    <x-form-input type="date" size="sm" id="inputStarts" placeholder="Starts" name="start_date" required/>
		    		        	</div>

		    		        	 <div class="mt-2">
		    		                <label for="inputEnds" class="form-label">Ends<sup><i class="fas fa-asterisk text-primary"></i></sup></label>
		    		        	    <x-form-input type="date" size="sm" id="inputEnds" placeholder="Ends" name="end_date" required/>
		    		            </div>

		    		            <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i class="fas fa-check fa-xs"></i> Create</button>

		    		        </x-form>
		    		    </div>
		    		</div>
		    	@endif

		        <div class="mb-3">
		            <div class="p-3 border bg-light shadow-sm">
		                <h6>Create Section</h6>

		                <x-form action="{{ route('dashboard.section.store') }}" >

		                	<input type="hidden" name="session_id" value="{{ $current_school_session_id }}" >

		                	<div class="mb-3">
		                	    <x-form-input label="Section Name" name="section_name" type="text" placeholder="Section name" required />
		                	</div>

		                	<div class="mb-3">
		                	    <x-form-input label="Room Number" name="room_no" type="text" placeholder="Room No." required />
		                	</div>

		                	<div class="mb-3">
		                	    <x-form-select id="assign_class_to" name="class_id" label="Assign section to class">
	                	    		@if (isset($school_classes))
	                	    			@foreach ($school_classes as $school_class)
	                	    	           <option value="{{ $school_class->id }}">{{ $school_class->class_name}}</option>
	                	    			@endforeach
	                	    		@endif
		                	    </x-form-select>
		                	</div>
		                	<button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i class="fas fa-check fa-xs"></i> Save</button>

		                </x-form>
		            </div>
		        </div>

		        <div class="mb-3">
		            <div class="p-3 border bg-light shadow-sm">
		                <h6>Allow Final Marks Submission</h6>
		                <x-form action="{{ route('dashboard.final.marks.submission.status.update') }}">
		                	<p class="text-danger">
		                        <small>
		                            <i class="fas fa-exclamation-triangle me-2"></i>
		                            Usually teachers are allowed to submit final marks just before the end of a "Semester".
		                        </small>
		                    </p>

		                    <p class="text-primary">
		                        <small>
		                            <i class="fas fa-exclamation-triangle me-2"></i>
		                            Disallow at the start of a "Semester".
		                        </small>
		                    </p>

		                    <x-form-switch name="marks_submission_status" id="marks_submission_status_check"
		                    			:check="$academic_setting->marks_submission_status == 'on'" :label="($academic_setting->marks_submission_status == 'on') ? 'Allowed' : 'Disallowed'">

		                    </x-form-switch>

		                    <button type="submit" class="mt-3 btn btn-sm btn-outline-primary">
		                        <i class="fas fa-check fa-xs"></i>
		                        Save
		                    </button>

		                </x-form>
		            </div>
		        </div>

		    </div>
		</div>
	</div>

	<script>
	    function getSectionsAndCourses(obj) {
	        var class_id = obj.options[obj.selectedIndex].value;
	        var url = "{{route('get.sections.courses.by.classId')}}?class_id=" + class_id

	        fetch(url)
	        .then((resp) => resp.json())
	        .then(function(data) {
	            var sectionSelect = document.getElementById('section-select');
	            sectionSelect.options.length = 0;
	            data.sections.unshift({'id': 0,'section_name': 'Please select a section'})
	            data.sections.forEach(function(section, key) {
	                sectionSelect[key] = new Option(section.section_name, section.id);
	            });

	            var courseSelect = document.getElementById('course-select');
	            courseSelect.options.length = 0;
	            data.courses.unshift({'id': 0,'course_name': 'Please select a course'})
	            data.courses.forEach(function(course, key) {
	                courseSelect[key] = new Option(course.course_name, course.id);
	            });
	        })
	        .catch(function(error) {
	            console.log(error);
	        });
	    }
	</script>

</x-app-dashboard>
