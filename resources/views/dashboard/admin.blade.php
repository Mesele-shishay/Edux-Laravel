<x-app-dashboard>
    <!-- Content Row -->
    <div class="row">
        {{-- Total students --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row g-0 align-items-center">
                        <div class="col me-2">
                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                Total students
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">{{$students['total']}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas  fa-user-graduate fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total teachers --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row g-0 align-items-center">
                        <div class="col me-2">
                            <div class="text-xs fw-bold text-success text-uppercase mb-1">
                                Total teachers
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">{{$teachers['total']}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total sections --}}
       <div class="col-xl-3 col-md-6 mb-4">
           <div class="card border-left-info shadow h-100 py-2">
               <div class="card-body">
                   <div class="row g-0 align-items-center">
                       <div class="col me-2">
                           <div class="text-xs fw-bold text-info text-uppercase mb-1">
                               Total Sections
                           </div>
                            <div class="h5 mb-0 fw-bold text-gray-800" > {{ $sections->count() }}</div>
                       </div>
                       <div class="col-auto">
                           <i class="fas fa-school fa-2x text-gray-300"></i>
                       </div>
                   </div>
               </div>
           </div>
       </div>

        {{-- Total Classes --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row g-0 align-items-center">
                        <div class="col me-2">
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                Total Classes
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">{{$classes->count()}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="card-title">Users Chart</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex mx-auto text-center justify-content-center mb-4">
                        <div class="d-flex text-center justify-content-center me-3"><span class="dot-label bg-primary my-auto"></span>Total Students -</div>
                        <div class="d-flex text-center justify-content-center"><span class="dot-label bg-secondary my-auto"></span>  - Total Teachers</div>
                    </div>
                    <div class="chartjs-wrapper-demo">
                        <canvas id="transactions" class="chart-dropshadow" height="660" width="1521" style="display: block; box-sizing: border-box; height: 330px; width: 760.5px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <input type="hidden" name="chardDataStudents" value={{  $chartData['students'] }} id="chardDataStudents">
            <input type="hidden" name="chardDataTeachers" value={{ $chartData['teachers'] }} id="chardDataTeachers">

            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Students Statistic Chart</h6>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="chartPie" class="h-275" style="display: block; box-sizing: border-box; height: 275px; width: 618px;" width="618" height="275"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>