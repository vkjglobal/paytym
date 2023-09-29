@extends('admin.layouts.app')
@section('content')
    @component('admin.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <h6 class="card-title">Report</h6>
                    <div class="float-right mb-3">
                        {{-- <button type="button" class="btn btn-outline-primary btn-icon-text">
                            <i class="btn-icon-prepend" data-feather="printer"></i>
                            Print
                          </button> --}}
                          @if (auth('admin')->user()->role!=2)
                          <button type="button" class="btn btn-primary btn-icon-text" onclick="window.location='{{route("admin.main_report.download")}}'">
                            <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                            Download Report
                          </button> 
                          @endif
                    
                    </div>

                    {{-- <form method="POST" action="{{ route('admin.report.invoice.filter') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mt-4 mb-4" id="" >
                            
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Plan<span class="text-danger"></span></label>
                                    <select name="status" id="status1" class="@if ($errors->has('status')) is-invalid @endif" >
                                        <option selected="true" value="" disabled>All</option>
                                        @foreach ($plans as $plan)
                                        <option value="{{$plan->id}}" {{ old('status') === 0 ? 'selected' : '' }}>{{$plan->plan}}</option>
                                        @endforeach
                                        <option value="0" {{ old('status') === 0 ? 'selected' : '' }}>Custom</option>
                                        
                                    </select>                                
                                    <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                                </div>
                            </div><!-- Col -->
                            
                            <div class="col-sm-2"> 
                                <button class="btn btn-info mt-4 p-2" id="filter_employee">Filter</button>
                            </div>
                        </div><!-- Row -->
                    </form> --}}

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Company</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Plan</th>
                                    <th>Company phone</th>
                                    <th>City/Town</th>
                                    <th>Date of Registration</th>
                                    <th>Active Employees</th>
                                    <th>Inctive Employees</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $company->company }}</td>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->email }}</td>
                                        <td>{{ $company->subscription_name() }}</td>
                                        <td>{{ $company->company_phone  }}</td>
                                        <td>{{ $company->city }}</td>
                                        <td>{{ optional($company->created_at)->format('d-M-Y') ?? 'no data' }}</td>
                                        <td>{{ $company->get_active_employees() }}</td>
                                        <td>{{ $company->get_inactive_employees() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom_css')
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin_assets/js/data-table.js') }}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  
@endpush
