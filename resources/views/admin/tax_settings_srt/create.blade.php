@extends('admin.layouts.app')
@section('content')
@component('admin.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Create Tax Rates</h6>
                <form method="POST" action="{{ route('admin.tax_settings_srt.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                    <div class="col-sm-4">
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
                        </div><!-- Col -->


                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Annual Income From<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('annual_income_from')) is-invalid @endif" name="annual_income_from" value="{{ old('annual_income_from') }}" placeholder="Enter Annual income From">
                                <div class="invalid-feedback">{{ $errors->first('annual_income_from') }}</div>
                            </div>
                        </div><!-- Col -->

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Annual Income To<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('annual_income_to')) is-invalid @endif" name="annual_income_to" value="{{ old('annual_income_to') }}" placeholder="Enter Annual Income To">
                                <div class="invalid-feedback">{{ $errors->first('annual_income_to') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->

                    <label class="control-label" style="color: blue;">Social Responsibility Tax(SRT)</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">SRT Rate(%)<span class="text-danger">*</span></label>
                                <input type="number" class="form-control @if ($errors->has('srt_tax')) is-invalid @endif" name="srt_tax" value="{{ old('srt_tax') }}" placeholder="Enter TaxRate">
                                <div class="invalid-feedback">{{ $errors->first('srt_tax') }}</div>
                            </div>
                        </div><!-- Col -->

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">SRT-Tax(Addon)<span class="text-danger">*</span></label>
                                <input type="number" class="form-control @if ($errors->has('srt_value')) is-invalid @endif" name="srt_value" value="{{ old('srt_value') }}" placeholder="Enter TaxRate">
                                <div class="invalid-feedback">{{ $errors->first('srt_value') }}</div>
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