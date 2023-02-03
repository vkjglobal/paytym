@extends('employer.layouts.app')
@section('content')
    {{-- @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent --}}

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Attendance Edit</h6>
                    <form method="POST" action="{{ route('employer.attendance.update',$attendance->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"> Name <span class="text-danger"></span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('name')) is-invalid @endif"
                                        name="name" value="{{old('name', $attendance->user->first_name) }}"   disabled>
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"> Date <span class="text-danger"></span></label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('date')) is-invalid @endif"
                                        name="date" value="{{old('date', $attendance->date) }}"   >
                                    <div class="invalid-feedback">{{ $errors->first('date') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"> Check-in-date <span class="text-danger"></span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('date1')) is-invalid @endif"
                                        name="date1" value="{{old('date1', $attendance->check_in) }}"   >
                                    <div class="invalid-feedback">{{ $errors->first('date1') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"> Check-out-date <span class="text-danger"></span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('date2')) is-invalid @endif"
                                        name="date2" value="{{old('date2', $attendance->check_out) }}"     >
                                    <div class="invalid-feedback">{{ $errors->first('date2') }}</div>
                                </div>
                            </div><!-- Col --><br>
                            <div class="col-sm-4">
                                
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"> Status <span class="text-danger"></span></label>
                                    <select name="status" id="">
                                        <option value="0" {{$attendance->status == 0 ? 'selected': '' }}>Halfday</option>
                                        <option value="1" {{$attendance->status == 1 ? 'selected': '' }}>Fullday</option>
                                    </select>
                                    {{-- <input type="text"
                                        class="form-control @if ($errors->has('status')) is-invalid @endif"
                                        name="status" value="{{old('name', $attendance->status) }}"   > --}}
                                    <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                                </div>
                            </div><!-- Col -->
                        

                    </div>
                        <br><button type="submit" class="btn btn-primary submit">Submit</button>
                    
                    </form>
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
