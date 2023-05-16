@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Welcome, {{ auth()->guard('admin')->user()->name }}</h4>
    </div>
</div>


<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow">
            <div class="col-md-4 grid-margin stretch-card">

                <div class="card">
                    <a href="{{Route('admin.employers.index')}}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-3">
                                <h6 class="card-title mb-0">Active Employers</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{count($employers)}}</h3>
                                </div>
                                <!-- <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart1" class="mt-md-3 mt-xl-0"></div>
                                </div> -->
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <a href="{{Route('admin.contact')}}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-3">
                                <h6 class="card-title mb-0">Contacts</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{count($contacts)}}</h3>
                                </div>
                                <!-- <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart2" class="mt-md-3 mt-xl-0"></div>
                                </div> -->
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <a href="{{Route('admin.subscriptions.index')}}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-3">
                                <h6 class="card-title mb-0">Estimates</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{count($projects)}}</h3>
                                </div>
                                <!-- <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart3" class="mt-md-3 mt-xl-0"></div>
                                </div> -->
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div> <!-- row -->

<div class="row justify-content-center mb-4">
    <div class="col-md-8">
        <div class="h-100">
            <div class=" rounded h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0">Montly Revenue by Company Name</h6>
                </div>
                <canvas id="doughnutChart"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row gy-3">
@foreach ($employers as $key => $value )
<div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <div class="d-flex flex-column">
            <strong>{{ $value->company }}</strong>
            <span style="color: red;"><b>{{ $value->get_active_employees() }}</b></span>
            <label for="">Active Employees</label>
        </div>
    </div>
   
@endforeach

  
</div>
@endsection
@push('custom_js')
<script>
    // Doughnut Chart
    var ctx6 = $("#doughnutChart").get(0).getContext("2d");
    var company = [];
    var company = @json($employers);

    const companyNames = company.map(company => company.company);
    console.log(companyNames);


    //console.log("haloo");
    var myChart6 = new Chart(ctx6, {
        type: "doughnut",
        data: {
            //companyNames
            labels: ["c1", "c2", "c3", "c4", "c5","c1", "c2", "c3", "c4", "c5"],
            datasets: [{
                backgroundColor: [
                    "#0014ff",
                    "#ff0000",
                    "#ff00d4",
                    "#00bd9a",
                    "#2d9b00",
                    "#0014ff",
                    "#ff0000",
                    "#ff00d4",
                    "#00bd9a",
                    "#2d9b00",
                ],
                data: [55, 49, 44, 24, 15,55, 49, 44, 24, 15]
            }]
        },
        options: {
            // borderWidth:0,
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
</script>
@endpush