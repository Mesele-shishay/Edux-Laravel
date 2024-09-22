{{-- Accessible for all logged in users --}}
{{-- Nav Item - Dashboard - --}}
<div id="accordion">
<li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-grip-horizontal"></i>
        <span>Dashboard</span>
    </a>
</li>

{{-- Accessible only by admin --}}
@role('admin')
{{-- Nav Item - Classes - --}}
<li class="nav-item {{ request()->is('dashboard/classes*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('dashboard.classes.index')}}">
        <i class="fas fa-sitemap"></i>
        <span>Classes</span>
    </a>
</li>
@endrole

@role('student')

{{-- Nav Item - Scores --}}
<li class="nav-item {{ request()->is('dashboard/score*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard.score') }}">
        <i class="fas fa-fw fa-book-reader"></i>
        <span>Scores</span>
    </a>
</li>


<li class="nav-item {{ request()->is('dashboard/students*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard.student.attendance.show',['id' => auth()->user()->id]) }}">
        <i class="fas fa-fw fa-calendar-alt"></i>
        <span>Attendances</span>
    </a>
</li>

<li class="nav-item {{ request()->is('dashboard/course*') ? 'active' : '' }}" >
    <a class="nav-link"
        href="{{route('dashboard.course.student.list.show',['student_id' => auth()->user()->id])}}">
        <i class="fas fa-book-reader"></i>
        <span>Courses</span>
    </a>
</li>


{{-- Nav Item - Schedules --}}
<li class="nav-item {{ request()->is('dashboard/routine*') ? 'active' : '' }}">
    @if (session()->has('browse_session_id'))
    @php
        $class_info = App\Models\Promotion::where('session_id', session('browse_session_id'))
                    ->where('student_id', auth()->user()->id )
                    ->first();
    @endphp

    @else
        @php
            $latest_session = App\Models\SchoolSession::latest()->first();
        @endphp

        @if ($latest_session)
            @php
                $class_info = \App\Models\Promotion::where('session_id', $latest_session->id)
                            ->where('student_id', auth()->user()->id)
                            ->first();
            @endphp
        @else
            @php
                $class_info = [];
            @endphp
        @endif
    @endif


    <a class="nav-link"
        href="{{route('dashboard.routine.show', [
                'class_id'   -> $class_info->class_id ?? '',
                'section_id' -> $class_info->section_id ?? ''
                ])}}">
        <i class="far fa-calendar-alt"></i>
        <span>Routine</span>
    </a>
</li>

{{-- Nav Item - General Info- --}}
<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fas fa-fw fa-info-circle"></i>
        <span>General Information</span>
    </a>
</li>
@endrole


{{-- Accessible only by admin and teachers and supper admin--}}

@role(['admin','teacher','sa'])
    @can(['create users','view users'])

        {{-- Nav Item - Students - --}}
        <li class="nav-item {{ request()->is('dashboard/student*') ? 'active' : '' }}">
            <a class="nav-link collapsed"
                href="#"
                data-bs-toggle="collapse"
                data-bs-target="#students"
                aria-expanded="false"
                aria-controls="students">
                <i class="fas fa-fw fa-cog"></i>
                <span>Students</span>
            </a>
            <div id="students" class="collapse" data-bs-parent="#accordion">
                <div class="bg-light py-2 collapse-inner border-left-dark">

                    <a class="collapse-item {{ request()->routeIs('dashboard.student.list.show') ? 'active' : '' }} "
                        href="{{route('dashboard.student.list.show')}}">View Students</a>

                    <a class="collapse-item {{ request()->routeIs('dashboard.student.add') ? 'active' : '' }}"
                        href="{{route('dashboard.student.add')}}">Add Student</a>
                </div>
            </div>
        </li>

        {{-- Nav Item - Teachers - --}}
        <li class="nav-item {{ request()->is('dashboard/teacher*') ? 'active' : '' }}">
            <a class="nav-link collapsed "
                href="#"
                data-bs-toggle="collapse"
                data-bs-target="#teachers"
                aria-expanded="false"
                aria-controls="teachers">
                <i class="fas fa-fw fa-cog"></i>
                <span>Teachers</span>
            </a>
            <div id="teachers" class="collapse" data-bs-parent="#accordion">
                <div class="bg-light py-2 collapse-inner border-left-dark">
                    <a class="collapse-item  {{ request()->routeIs('dashboard.teacher.list.show') ? 'active' : '' }}"
                        href="{{route('dashboard.teacher.list.show')}}">View Teachers</a>
                    <a class="collapse-item {{ request()->routeIs('dashboard.teacher.add') ? 'active' : '' }}"
                        href="{{route('dashboard.teacher.add')}}">Add Teacher</a>
                </div>
            </div>
        </li>
    @endcan

    @can('create exams')
        {{-- Nav Item - Exams / Grades - --}}
        <li class="nav-item {{ request()->is('dashboard/exam*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="{{ route('dashboard.exam.view') }}" data-bs-toggle="collapse" data-bs-target="#exams" aria-expanded="false" aria-controls="exams">
                <i class="fas fa-fw fa-cog"></i>
                <span>Exams / Grades</span>
            </a>
            <div id="exams" class="collapse" data-bs-parent="#accordion">
                <div class="bg-light py-2 collapse-inner border-left-dark">
                    <a class="collapse-item  {{ request()->routeIs('dashboard.exam.view') ? "active"  : ''}}"
                         href="{{ route('dashboard.exam.view') }}" >View Exams</a>

                    <a class="collapse-item {{ request()->routeIs('dashboard.exam.create') }}"
                        href="{{route('dashboard.exam.create')}}">Create Exams</a>
                        @if (auth()->user()->role == 'admin')
                            <a class="collapse-item {{ request()->routeIs('dashboard.exam.grade.create') ? 'active' : '' }} "
                        href="{{route('dashboard.exam.grade.create')}}">Add Grade Systems</a>
                        @endif

                    <a class="collapse-item {{ request()->routeIs('dashboard.exam.grade.view') ? 'active' : '' }} "
                        href="{{route('dashboard.exam.grade.view')}}">View Grade Systems</a>
                </div>
            </div>
        </li>
    @endcan

@endrole


{{-- Accessible only by admin --}}

@role(['admin','sa'])
{{-- Nav Item - Notice - --}}
<li class="nav-item  {{ request()->is('dashboard/notice*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('dashboard.notice')}}">
        <i class="fas fa-bullhorn"></i>
        <span> Notices </span>
    </a>
</li>


{{-- Nav Item - Routine - --}}
<li class="nav-item {{ request()->is('dashboard/routine*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('dashboard.routine')}}">
        <i class="far fa-calendar-alt"></i>
        <span>Routine</span>
    </a>
</li>


{{-- Nav Item - Academic - --}}
<li class="nav-item {{ request()->is('dashboard/academic*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard.academic') }}">
        <i class="fas fa-fw fa-tools"></i>
        <span>Academic</span>
    </a>
</li>

{{-- Nav Item - Promotion - --}}
<li class="nav-item {{ request()->is('dashboard/promotions*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard.promotions.index') }}">
        <i class="fas fa-sort-numeric-up"></i>
        <span>Promotion</span>
    </a>
</li>


{{-- Nav Item - Feedback's - --}}
<li class="nav-item  {{ request()->is('dashboard/contact*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard.contact') }}">
        <i class="fas fa-fw fa-comment-alt"></i>
        <span>Feedback's</span>
    </a>
</li>

{{-- Nav Item - System Setting - --}}
<li class="nav-item {{ request()->is('dashboard/system*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard.system.settings') }}">
        <i class="fas fa-fw fa-cogs"></i>
        <span>System Setting</span>
    </a>
</li>

@endrole


@role('teacher')
{{-- Nav Item - My Courses - --}}

<li class="nav-item {{ request()->is('dashboard/course*') ? 'active' : '' }}">
   <a class="nav-link" href="{{ route('dashboard.course.teacher.list.show') }}">
       <i class="fas fa-chalkboard-teacher"></i>
       <span>My Courses</span>
   </a>
</li>
@endrole

</div>

{{-- Divider --}}
<hr class="sidebar-divider d-none d-md-block">