@extends('employer.layouts.app')

@section('content')
{{-- @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent --}}

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add Bonus</h6>
                <form method="POST" action="{{ route('employer.bonus.update', $bonus->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Type<span class="text-danger">*</span></label>
                                <select name="type" id="type" class="@if ($errors->has('type')) is-invalid @endif">
                                    <option selected="true" disabled="disabled" value="">Select Type</option>
                                    <option {{ old('type', $bonus->type) == '0' ? "selected" : "" }} value="0">Employee</option>
                                    <option {{ old('type', $bonus->type) == "1" ? "selected" : "" }} value="1">Department</option>
                                    <option {{ old('type', $bonus->type) == '2' ? "selected" : "" }} value="2">Branch</option>
                                    <option {{ old('type', $bonus->type) == '3' ? "selected" : "" }} value="3">Business</option>
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('type') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row" id="temployee" >
                        <div class="col-sm-6">
                            
                            <div class="form-group">
                                <label class="control-label">Employee<span class="text-danger">*</span></label>
                                <select name="type_id" class="@if ($errors->has('type_id')) is-invalid @endif">
                                    <option selected="true" disabled="disabled" >Select User</option>
                                    @foreach($employees as $employee)
                                        <option {{ old('type_id', $bonus->type_id) == $employee->id ? "selected" : "" }}
                                        value="{{$employee->id}}">{{$employee->first_name}}</option>
                                    @endforeach
                                </select>                                
                                <div class="invalid-feedback">{{ $errors->first('type_id') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Rate Type<span class="text-danger">*</span></label>
                                <select name="rate_type" id="type" class="@if ($errors->has('rate_type')) is-invalid @endif">
                                    <option selected="true" disabled="disabled" value="">Select Rate Type</option>
                                    <option value="0" {{ old('rate_type', $bonus->rate_type) == 0  ? "selected" : "" }}>Percentage</option>
                                    <option value="1" {{ old('rate_type', $bonus->rate_type) == 1  ? "selected" : "" }}>Fixed</option>
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('rate_type') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Rate <span class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control @if ($errors->has('rate')) is-invalid @endif"
                                    name="rate" value="{{ old('rate',$bonus->rate) }}" placeholder="Enter Rate" required>
                                <div class="invalid-feedback">{{ $errors->first('rate') }}</div>
                            </div>
                        </div><!-- Col --> 
                    </div><!-- Row -->

                    <input type="submit" class="btn btn-primary submit" value="Submit">
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