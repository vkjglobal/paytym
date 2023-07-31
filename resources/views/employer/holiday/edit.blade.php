@extends('employer.layouts.app')
@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"> Edit Business</h6>
                <form method="POST" action="{{ route('employer.holiday.update',$holidays->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Holiday Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('holidays')) is-invalid @endif" name="name" value="{{ old('holidays',$holidays->name) }}" placeholder="Enter Holiday Name" required>
                                <div class="invalid-feedback">{{ $errors->first('holidays') }}</div>
                            </div>
                        </div><!-- Col -->




                    </div><!-- Row -->

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Date<span class="text-danger">*</span></label>
                                <input type="date" id="holiday_date" name="holiday_date" class="form-control @if ($errors->has('holiday_date')) is-invalid @endif" value="{{ old('holiday_date',$holidays->date) }}">
                                <div class="invalid-feedback">{{ $errors->first('holiday_date') }}</div>
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