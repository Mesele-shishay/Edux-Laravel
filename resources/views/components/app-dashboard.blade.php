<x-app-layout>

        {{-- Page Wrapper --}}
        <div id="wrapper">

            {{-- Sidebar --}}
            <ul class="navbar-nav bg-darkest sidebar sidebar-dark accordion d-print-none"
                id="accordionSidebar">

                {{-- Sidebar - Brand --}}
                <a class="sidebar-brand d-flex align-items-center justify-content-center"
                    href="{{ route('home') }}">

                    <div class="sidebar-brand-icon rotate-n-15">
                        <img src="{{asset('favicon.png')}}">
                    </div>

                    <div class="sidebar-brand-text mx-3">
                        {{ config('app.name') }}
                    </div>
                </a>

                {{-- Divider --}}
                <hr class="sidebar-divider">

                {{-- Heading --}}
                <div class="sidebar-heading pb-3">
                    Signed us {{ Str::ucfirst(auth()->user()->role) }}
                </div>

                {{-- Divider --}}
                <hr class="sidebar-divider">

                {{-- Sidebar nav items --}}
                <x-side-bar-nav/>

                {{-- Sidebar Toggler (Sidebar) --}}
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>

            {{-- Content Wrapper --}}
            <div id="content-wrapper" class="d-flex flex-column">
                {{-- Main Content --}}
                <div id="content">
                    {{-- Topbar --}}
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <div class="container-fluid">
                            {{-- Sidebar Toggle (Topbar) --}}
                            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle me-3">
                                <i class="fa fa-bars"></i>
                            </button>

                            {{-- Topbar Search --}}
                            <form class="d-none d-sm-inline-block form-inline me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                                <div class="input-group">
                                    <input type="text"
                                        class="form-control bg-light border-0 small"
                                        placeholder="Search for...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @if (session()->has('browse_session_name') and
                                session()->get('browse_session_name') == $current_school_session->session_name )
                                <li class="nav-item d-none d-lg-block ">
                                    <a class="nav-link text-danger disabled ms-2" href="#">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <i class="ms-2  fs-6 text-center">
                                            Browsing as Academic Session {{ session()->get('browse_session_name') }}.
                                        </i>
                                    </a>
                                </li>
                            @elseif($school_sessions->count() > 0)
                                <li class="nav-item d-none d-lg-block ">
                                    <a class="nav-link disabled ms-2" href="#">
                                        <i class="ms-2  fs-6 text-center">
                                            Current Academic Session {{$current_school_session->session_name }}
                                        </i>
                                    </a>
                                </li>
                            @else
                                <li class="nav-item d-none d-lg-block ">
                                    <a class="nav-link text-danger disabled ms-2" href="#">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <i class="ms-2 fs-6 text-center"> Create an Academic Session.</i>
                                    </a>
                                </li>
                            @endif

                            {{-- Topbar Navbar --}}
                            <ul class="navbar-nav ms-auto">
                        {{--         <div class="d-flex">
                                  <div class="form-check form-switch ms-auto mt-3 me-3">
                                    <label class="form-check-label ms-3" for="lightSwitch">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-brightness-high" viewBox="0 0 16 16">
                                        <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
                                      </svg>
                                    </label>
                                    <input class="form-check-input" type="checkbox" id="lightSwitch" onclick="">
                                  </div>
                                </div> --}}
                                {{-- Nav Item - Search Dropdown (Visible Only XS) --}}
                                <li class="nav-item dropdown no-arrow d-sm-none">
                                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-search fa-fw"></i>
                                    </a>
                                    {{-- Dropdown - Messages --}}
                                    <div class="dropdown-menu dropdown-menu-end p-3 shadow animated--grow-in"
                                        aria-labelledby="searchDropdown">
                                        <form class="form-inline me-auto w-100 navbar-search">
                                            <div class="input-group">
                                                <input type="text" class="form-control bg-light border-0 small"
                                                    placeholder="Search for..."
                                                    aria-label="Search"
                                                    aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button">
                                                        <i class="fas fa-search fa-sm"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>

                                {{-- Nav Item - Alerts --}}
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <a class="nav-link dropdown-toggle"
                                        href="#"
                                        id="alertsDropdown"
                                        role="button"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fas fa-bell fa-fw"></i>
                                        {{-- Counter - Alerts --}}
                                        <span class="badge bg-danger badge-counter">1+</span>
                                    </a>

                                    {{-- Dropdown - Alerts --}}
                                    <div class="dropdown-list dropdown-menu dropdown-menu-end shadow animated--grow-in"
                                        aria-labelledby="alertsDropdown">
                                        <h6 class="dropdown-header">
                                            Alerts Center
                                        </h6>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="icon-circle bg-primary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="fs-6 text-gray-500">December 12, 2019</div>
                                                <span class="fw-bold">A new monthly report is ready to download!</span>
                                            </div>
                                        </a>
                                        <a class="dropdown-item text-center fs-6 text-gray-500" href="#">Show All Alerts</a>
                                    </div>
                                </li>

                                {{-- Nav Item - Messages --}}
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-envelope fa-fw"></i>
                                        {{-- Counter - Messages --}}
                                        <span class="badge bg-danger badge-counter">1</span>
                                    </a>
                                    {{-- Dropdown - Messages --}}
                                    <div class="dropdown-list dropdown-menu dropdown-menu-end shadow animated--grow-in"
                                        aria-labelledby="messagesDropdown">
                                        <h6 class="dropdown-header">
                                            Message Center
                                        </h6>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image me-3">
                                                <img class="rounded-circle" src="{{asset('img/undraw_profile_1.svg')}}"
                                                    alt="...">
                                                <div class="status-indicator bg-success"></div>
                                            </div>
                                            <div class="fw-bold">
                                                <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                                    problem I've been having.</div>
                                                <div class="fs-6 text-gray-500">Emily Fowler · 58m</div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item text-center fs-6 text-gray-500" href="#">Read More Messages</a>
                                    </div>
                                </li>

                                <div class="topbar-divider d-none d-sm-block"></div>

                                {{-- Nav Item - User Information --}}
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle"
                                        href="#"
                                        id="userDropdown"
                                        role="button"
                                        data-bs-toggle="dropdown">
                                        <span class="me-2 d-none d-lg-inline fs-6 text-gray-600">
                                            {{ auth()->user()->profile->full_name }}
                                        </span>
                                        <img class="img-profile rounded-circle"src="{{ asset('storage/'.auth()->user()->profile->image )}}">
                                    </a>

                                    {{-- Dropdown - User Information --}}
                                    <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in"
                                        aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                                            Profile
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>
                                            Activity Log
                                        </a>
                                        <a class="dropdown-item" href="#"
                                            href="#"
                                            data-bs-toggle="modal"
                                            data-bs-target="#changePassword">
                                            <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>
                                            Change Password
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item"
                                            href="#"
                                            data-bs-toggle="modal"
                                            data-bs-target="#logoutModal">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                                            Logout
                                        </a>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </nav>

                    {{-- Begin Page Content --}}
                    <div class="container">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-{{ $icon }}"></i> {{ $name }}</h1>
                            @if (Request::is('dashboard'))
                                @role('student')
                                    <a href="#" id="print_page" class="d-none d-sm-inline-block  d-print-none btn btn-sm btn-primary shadow-sm">
                                        <i class="fas fa-print text-white-50"></i>
                                        Print Slip
                                    </a>
                                @endrole
                            @endif
                        </div>
                        {{ $slot }}
                    </div>
                </div>
            </div>

        </div>

        {{-- Scroll to Top Button--}}
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        {{-- Logout Modal--}}
        <x-form action="{{ route('logout') }}">
            <x-modal title="Ready to Leave?" id="logoutModal" >
                Select 'Logout' below if you are ready to end your current session.
                <x-slot:footer>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <input type="submit"  value="Logout" name="submit" class="btn btn-primary">
                </x-slot:footer>
            </x-modal>
        </x-form>

        {{-- Change Modal--}}
        <livewire:change-password/>

</x-app-layout>
