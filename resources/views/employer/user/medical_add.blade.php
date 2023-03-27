@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">

                    <div class="card">
                        <div class="card-body">
                    
                          <h6 class="card-title">Medical Details</h6>
                    
                          <form class="forms-sample" method="POST" action="{{ route('employer.medical.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                  <span>{{$employee->first_name}}</span>
                                  <input type="hidden" name="employee_id" value="{{$employee->id}}">
                                </div>
                              </div>
                            <div class="row mb-3">
                                <label class="control-label">Blood Group <span class="col-sm-3 col-form-label text-danger">*</span></label>
                                <input type="text"
                                    class="col-sm-9 form-control @if ($errors->has('blood_grp')) is-invalid @endif"
                                    name="blood_grp" value="" placeholder="Enter First Name" required>
                                <div class="invalid-feedback">{{ $errors->first('blood_grp') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label">Allergies <span class="col-sm-3 text-danger">*</span></label>
                                <input type="text"
                                    class="col-sm-9 form-control @if ($errors->has('allergies')) is-invalid @endif"
                                    name="allergies" value="" placeholder="Enter First Name" required>
                                <div class="invalid-feedback">{{ $errors->first('allergies') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label">Medical Conditions<span class="col-sm-3 text-danger">*</span></label>
                                <input type="text"
                                    class="col-sm-9 form-control @if ($errors->has('medical_issues')) is-invalid @endif"
                                    name="medical_issues" value="" placeholder="Enter First Name" required>
                                <div class="invalid-feedback">{{ $errors->first('medical_issues') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label">Weight<span class="col-sm-3 text-danger">*</span></label>
                                <input type="text"
                                    class="col-sm-9 form-control @if ($errors->has('measurement')) is-invalid @endif"
                                    name="measurement" value="" placeholder="Enter First Name" required>
                                <div class="invalid-feedback">{{ $errors->first('measurement') }}</div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success me-2">Submit</button>
                            {{-- <button class="btn btn-danger" fdprocessedid="bbrcxd">Delete</button> --}}
                          </form>
                    
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
