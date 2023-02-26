@extends('employer.layouts.app')

@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add Provident fund</h6>
                <form method="POST" action="{{ route('employer.providentfund.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row" id="" >
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Employee<span class="text-danger">*</span></label>
                                <select name="employee" class="@if ($errors->has('employee')) is-invalid @endif" >
                                    <option selected="true" disabled="disabled" >Select User</option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->first_name}}</option>
                                    @endforeach
                                </select>                                
                                <div class="invalid-feedback">{{ $errors->first('employee') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                      
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">User Rate <span class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control @if ($errors->has('user_rate')) is-invalid @endif"
                                    name="user_rate" value="" placeholder="Enter Rate" >
                                <div class="invalid-feedback">{{ $errors->first('user_rate') }}</div>
                            </div>
                        </div><!-- Col --> 
                    </div><!-- Row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Employer Rate <span class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control @if ($errors->has('employer_rate')) is-invalid @endif"
                                    name="employer_rate" value="" placeholder="Enter Rate" >
                                <div class="invalid-feedback">{{ $errors->first('employer_rate') }}</div>
                            </div>
                        </div><!-- Col --> 
                    </div><!-- Row -->

                    <input type="submit" class="btn btn-success submit" value="ADD">
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
@push('custom_js')
<script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>
@endpush