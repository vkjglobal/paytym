@extends('admin.layouts.app')
@section('content')
@component('admin.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"> Create Leave Type</h6>
                <form method="POST" action="{{ route('admin.leave-type.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                    <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Country<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('country_id')) is-invalid @endif" name="country_id" value="{{ old('country_id') }}">
                                    <option value="">--SELECT--</option>
                                    @foreach ($countries as $key => $value)
                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('country_id') }}</div>
                               
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Leave Type <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('leavetype')) is-invalid @endif" name="leavetype" value="{{ old('leavetype') }}" placeholder="Enter leave Type" required>
                                <div class="invalid-feedback">{{ $errors->first('leavetype') }}</div>
                            </div>
                        </div><!-- Col -->

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">No of days allowed </label>
                                <input type="number" class="form-control @if ($errors->has('num_days')) is-invalid @endif" name="num_days" value="{{ old('num_days') }}" placeholder="Enter no of days">
                                <div class="invalid-feedback">{{ $errors->first('num_days') }}</div>
                            </div>
                        </div><!-- Col -->

                    </div><!-- Row -->




                    <button type="submit" class="btn btn-primary submit">Submit</button>
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