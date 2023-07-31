@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">

                    <div class="card">
                        <div class="card-body">
                    
                          <h6 class="card-title">Medical Details</h6>
                    
                          <form class="forms-sample">
                            <div class="row mb-3">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                  <span>@isset($medical_detail->users->first_name)
                                    {{$medical_detail->users->first_name.' '.$medical_detail->users->last_name}}
                                  @endisset</span>
                                </div>
                              </div>
                            <div class="row mb-3">
                              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Blood Group</label>
                              <div class="col-sm-9">
                                <span>{{$medical_detail->blood_grp}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Allergies</label>
                              <div class="col-sm-9">
                                <span>{{$medical_detail->allergies}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="exampleInputMobile" class="col-sm-3 col-form-label">Medical Conditions</label>
                              <div class="col-sm-9">  
                                <span>{{$medical_detail->medical_issues}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Weight</label>
                              <div class="col-sm-9">
                                <span>{{$medical_detail->measurement}}</span>
                              </div>
                            </div>
                            <br>
                            <a href="{{ route('employer.medical.edit', $medical_detail->id) }}">
                            <button type="button" class="btn btn-warning me-2" fdprocessedid="t9lgas">Edit</button>
                            </a>
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
