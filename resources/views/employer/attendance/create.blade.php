@extends('employer.layouts.app')
@section('content')
    {{-- @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent --}}

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Attendance Edit</h6>
                    <form method="POST" action="{{ route('employer.attendance.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"> Name <span class="text-danger"></span></label>

                                    <select name="name" id="">
                                        <option value="" default>Select User</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->first_name}}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text"
                                        class="form-control @if ($errors->has('name')) is-invalid @endif"
                                        name="name" value=""   >
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div> --}}
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"> Date <span class="text-danger"></span></label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('date')) is-invalid @endif"
                                        name="date" value=""   >
                                    <div class="invalid-feedback">{{ $errors->first('date') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"> Check-in-date <span class="text-danger"></span></label>
                                    <input type="datetime-local"
                                        class="form-control @if ($errors->has('date1')) is-invalid @endif"
                                        name="date1" value=""   >
                                    <div class="invalid-feedback">{{ $errors->first('date1') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"> Check-out-date <span class="text-danger"></span></label>
                                    <input type="datetime-local"
                                        class="form-control @if ($errors->has('date2')) is-invalid @endif"
                                        name="date2" value=""     >
                                    <div class="invalid-feedback">{{ $errors->first('date2') }}</div>
                                </div>
                            </div><!-- Col --><br>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"> Status <span class="text-danger"></span></label>
                                    <select name="status" id="">
                                        <option value="0 ">Halfday</option>
                                        <option value="1">Fullday</option>
                                    </select>
                                    {{-- <input type="text"
                                        class="form-control @if ($errors->has('status')) is-invalid @endif"
                                        name="status" value=""   > --}}
                                    <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                                </div>
                            </div><!-- Col -->
                        

                    </div>
                        <br><button type="submit" class="btn btn-primary submit">Submit</button>
                    
                    </form>

                    <div class="row mt-4">
                        <div class="col-sm-4">
                            <span class="text-dark"><strong>OR</strong></span><br>
                            <form method="POST" action="{{ route('employer.attendance.csvfile') }}" enctype="multipart/form-data">
                                @csrf
                                <h6 class="card-title mt-3">Upload a CSV file</h6> 
                                <input type="file" name="csvfile" class="mt-2">
                                <button type="submit" class="btn btn-primary submit mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom_css')
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
@endpush
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin_assets/js/data-table.js') }}"></script>
@endpush
