@extends('admin.layouts.app')
@section('content')
@component('admin.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Create Bank</h6>
                <form method="POST" action="{{ route('admin.bank.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Country<span class="text-danger">*</span></label>
                                <select class="form-control" class="form-control @if ($errors->has('country_id')) is-invalid @endif" name="country_id" value="{{ old('country_id') }}" required>
                                    <option value="">--SELECT--</option>
                                    @foreach ($countries as $key => $value)
                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('country_id') }}</div>

                            </div>
                        </div><!-- Col -->

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Bank Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('bank_name')) is-invalid @endif" name="bank_name" value="{{ old('bank_name') }}" placeholder="Enter Name" required>
                                <div class="invalid-feedback">{{ $errors->first('bank_name') }}</div>
                            </div>
                        </div><!-- Col -->

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Address<span class="text-danger">*</span></label>
                                <textarea class="form-control @if ($errors->has('address')) is-invalid @endif" name="address" required>
                                </textarea>
                                <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                        <div class="form-group">
                                <label class="control-label">Other Bank Code</label>
                                <input type="text" class="form-control @if ($errors->has('bank_code')) is-invalid @endif" name="bank_code" value="{{ old('bank_code') }}" placeholder="Enter Other Bank Code">
                                <div class="invalid-feedback">{{ $errors->first('bank_code') }}</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                        <div class="form-group">
                                <label class="control-label">Branch Code</label>
                                <input type="text" class="form-control @if ($errors->has('branch_code')) is-invalid @endif" name="branch_code" value="{{ old('branch_code') }}" placeholder="Enter Branch Code">
                                <div class="invalid-feedback">{{ $errors->first('branch_code') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Row -->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Bank Template<span class="text-danger">*</span></label>
                                <input type="file" class="form-control @if ($errors->has('bank_template')) is-invalid @endif" name="bank_template" value="{{ old('bank_template') }}" placeholder="Enter Bank Template" required>
                                <div class="invalid-feedback">{{ $errors->first('bank_template') }}</div>
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