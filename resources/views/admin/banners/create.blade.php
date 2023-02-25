@extends('admin.layouts.app')
@section('content')
@component('admin.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Banner Create</h6>
                <form method="POST" onsubmit = "return validateForm()" action="{{ route('admin.banner.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Banner Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" value="{{ old('name') }}" placeholder="Enter Banner Name">
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Image<span class="text-danger">*</span></label>
                               
                                <input type="file"
                                        class="form-control @if ($errors->has('image')) is-invalid @endif"
                                        name="image" value="{{ old('image') }}" placeholder="Choose Image" required>
                                    <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                               
                            </div>
                        </div><!-- Col -->

                    </div><!-- Row -->


                    

                  <!--   <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Employee Range From <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('range_from')) is-invalid @endif" name="range_from" value="{{ old('range_from') }}" placeholder="Enter Range From" >
                                <div class="invalid-feedback">{{ $errors->first('range_from') }}</div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Employee Range To <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('range_to')) is-invalid @endif" name="range_to" value="{{ old('range_to') }}" placeholder="Enter Range To">
                                <div class="invalid-feedback">{{ $errors->first('range_to') }}</div>
                            </div>
                        </div>
                    </div> --><!-- Row -->

                <!--     <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Rate Per Employee<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('rate_per_employee')) is-invalid @endif" name="rate_per_employee" value="{{ old('rate_per_employee') }}" placeholder="Enter Rate Per Employee">
                                <div class="invalid-feedback">{{ $errors->first('rate_per_employee') }}</div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Rate Per Month</label>
                                <input type="text" class="form-control @if ($errors->has('rate_per_month')) is-invalid @endif" name="rate_per_month" value="{{ old('rate_per_month') }}" placeholder="Enter Rate Per Month">
                                <div class="invalid-feedback">{{ $errors->first('rate_per_month') }}</div>
                            </div>
                        </div>
                    </div> --><!-- Row -->
                    @if($bannercount == 0)
                    <input type="submit" class="btn btn-primary submit" value="Submit">
                    @else
                    <input type="submit" class="btn btn-primary submit" value="Submit" disabled="disabled">
                    @endif
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