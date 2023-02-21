@extends('employer.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Welcome, {{ auth()->guard('employer')->user()->name }}</h4>
        </div>
    </div>


    <!-- <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <a href="{{Route('employer.user.index')}}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-3">
                                <h6 class="card-title mb-0">Users</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{$user}}</h3>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart1" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div></a>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{Route('employer.branch.list')}}">
                            <div class="d-flex justify-content-between align-items-baseline mb-3">
                                <h6 class="card-title mb-0">Branches</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{$branches}}</h3>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart2" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div></a>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <a href="{{Route('employer.department.index')}}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-3">
                                <h6 class="card-title mb-0">Departments</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{$departments}}</h3>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart3" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div></a>
                    </div>
                </div>
            </div>
        </div>
    </div> row -->


    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <a href="#">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-3">
                                <h6 class="card-title mb-0">Checked IN</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{$checked_in}}</h3>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart1" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div></a>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <a href="#">
                            <div class="d-flex justify-content-between align-items-baseline mb-3">
                                <h6 class="card-title mb-0">Checked Out</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{$checked_out}}</h3>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart2" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div></a>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <a href="#">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-3">
                                <h6 class="card-title mb-0">On Annual Leave</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{$on_annual_leave}}</h3>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart3" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div></a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->


    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow">
            <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <a href="#">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-3">
                                <h6 class="card-title mb-0">Absentees</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{$absentees}}</h3>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart1" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div></a>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <a href="#">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-3">
                                <h6 class="card-title mb-0">on Day OFF</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{$totaldayoffs}}</h3>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart1" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div></a>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <a href="#">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-3">
                                <h6 class="card-title mb-0">On Sick Leave</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{$on_sick_leave}}</h3>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div></a>
                    </div>
                </div>
              
                
            </div>
        </div>
    </div> <!-- row -->
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow">
            <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <a href="#">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-3">
                                <h6 class="card-title mb-0">Loans</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{$totalloans}}</h3>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart1" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div></a>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <a href="#">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-3">
                                <h6 class="card-title mb-0">on Loss of Pay</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{$lwop}}</h3>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart1" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div></a>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <a href="#">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-3">
                                <h6 class="card-title mb-0">Missing in action</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{$mia}}</h3>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div></a>
                    </div>
                </div>
              
                
            </div>
        </div>
    </div> <!-- row -->
  
    <!-- <div id="piechart" style="width: 900px; height: 500px;"></div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Checked In', 'Hours per Day'],
          ['Checked Out',     11],
          ['On Annual Leave',      2],
          ['On Loss of Pay',  2],
          ['On Day Off', 2],
          ['On Sick Leave',    7]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  -->


@endsection
