@extends('admin.layouts.app')
@section('content')
@component('admin.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">CMS Create</h6>
                <form method="POST" action="{{ route('admin.cms.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">CMS Type<span class="text-danger">*</span></label>
                                <select class="form-control" name="cms_type" id="cms_type" class="form-control @if ($errors->has('cms_type')) is-invalid @endif">
                                    <option value="0">--SELECT--</option>
                                    <option value="About">About</option>
                                    <option value="Employers">For Employers</option>
                                    <option value="Employees">For Employees</option>
                                    <option value="Web Features">Web Features</option>
                                    <option value="Employee Management">Employee Management</option>
                                    <option value="Payroll Management">Payroll Management</option>
                                    <option value="Deposit To Employee Account">Deposit To Employee Account</option>
                                    <option value="Payroll Tax and Contribution">Payroll Tax and Contribution</option>
                                    <option value="Analytics and Report">Analytics and Report</option>
                                    <option value="Chat">Chat</option>
                                    <option value="Testimonials">Testimonials</option>
                                    <option value="Showcase">ShowCase</option>
                                </select>
                                <!-- <input type="text" class="form-control @if ($errors->has('cms_type')) is-invalid @endif" name="cms_type" value="{{ old('cms_type') }}" placeholder="Enter CMS Type"> -->
                                <div class="invalid-feedback">{{ $errors->first('cms_type') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Content<span class="text-danger">*</span></label>
                                <!-- <select class="form-control" id="file_type" name="file_type">
                                    <option value="0">--SELECT--</option>

                                </select> -->
                                <textarea name="content" class="form-control @if ($errors->has('content')) is-invalid @endif" cols="30" rows="5" required>{{ old('content') }}</textarea>

                                <div class="invalid-feedback">{{ $errors->first('content') }}</div>
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