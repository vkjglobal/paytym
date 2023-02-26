@extends('employer.layouts.app')
@section('content')
    {{-- @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent --}}

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Payroll</h6>
                    <div class="table-responsive">
                        <form method="POST" action="{{ route('employer.payroll.store') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label"> Name <span class="text-danger"></span></label>
    
                                        <select name="name" id="" required>
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
                                        <label class="control-label"> Salary <span class="text-danger"></span></label>
                                        <input type="number"
                                            class="form-control @if ($errors->has('salary')) is-invalid @endif"
                                            name="salary" value=""   required>
                                        <div class="invalid-feedback">{{ $errors->first('salary') }}</div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label"> Paid Salary <span class="text-danger"></span></label>
                                        <input type="number"
                                            class="form-control @if ($errors->has('paid_salary')) is-invalid @endif"
                                            name="paid_salary" value=""   required>
                                        <div class="invalid-feedback">{{ $errors->first('paid_salary') }}</div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">fund_deduction <span class="text-danger"></span></label>
                                        <input type="number"
                                            class="form-control @if ($errors->has('fund_deduction')) is-invalid @endif"
                                            name="fund_deduction" value=""    required >
                                        <div class="invalid-feedback">{{ $errors->first('fund_deduction') }}</div>
                                    </div>
                                </div><!-- Col --><br>
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label"> p tax <span class="text-danger"></span></label>
                                        {{-- <select name="status" id="">
                                            <option value="0 ">Halfday</option>
                                            <option value="1">Fullday</option>
                                        </select> --}}
                                        <input type="text"
                                            class="form-control @if ($errors->has('p_tax')) is-invalid @endif"
                                            name="p_tax" value=""  required >
                                        <div class="invalid-feedback">{{ $errors->first('p_tax') }}</div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">total_deduction <span class="text-danger"></span></label>
                                        <input type="number"
                                            class="form-control @if ($errors->has('total_deduction')) is-invalid @endif"
                                            name="total_deduction" value=""   required  >
                                        <div class="invalid-feedback">{{ $errors->first('total_deduction') }}</div>
                                    </div>
                                </div><!-- Col --><br>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Pay slip <span class="text-danger"></span></label>
                                        <input type="file"
                                            class=" @if ($errors->has('logo')) is-invalid @endif"
                                            name="slip" value="" placeholder="Enter logo" required >
                                        <div class="invalid-feedback">{{ $errors->first('slip') }}</div>
                                    </div>
                                </div><!-- Col -->
                            
    
                        </div>
                            <br><button type="submit" class="btn btn-primary submit">Submit</button>
                        
                        </form>
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
