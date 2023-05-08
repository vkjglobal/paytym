@extends('employer.layouts.app')
@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"> Create Holiday</h6>
                <form method="POST" action="{{ route('employer.holiday.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Holiday Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('holiday')) is-invalid @endif" name="name" value="{{ old('holiday') }}" placeholder="Enter Holiday Name" required>
                                <div class="invalid-feedback">{{ $errors->first('holiday') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Date<span class="text-danger">*</span></label>
                                <input type="date" name="holiday_date" id="holiday_date" class="form-control @if ($errors->has('holiday_date')) is-invalid @endif" required>
                                <div class="invalid-feedback">{{ $errors->first('holiday_date') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <input type="submit" class="btn btn-primary submit" value="submit">
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