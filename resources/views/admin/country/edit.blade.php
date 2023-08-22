@extends('admin.layouts.app')
@section('content')
@component('admin.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Create Country</h6>
                <form method="POST" action="{{ route('admin.country.update',$country->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" value="{{ old('name',$country->name) }}" placeholder="Enter Name">
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            </div>
                        </div><!-- Col -->

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Currency<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('cms_type')) is-invalid @endif" name="currency" value="{{ old('currency',$country->currency) }}" placeholder="Enter Currency">
                                <div class="invalid-feedback">{{ $errors->first('currency') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                <div class="row">
                <!-- <div class="col-sm-6">
                            <div class="form-group">
                                <input type="number" class="form-control @if ($errors->has('cms_type')) is-invalid @endif" name="tax" value="{{ old('tax',$country->tax) }}" placeholder="Enter Tax">
                                <div class="invalid-feedback">{{ $errors->first('tax') }}</div>
                            </div>
                        </div>

                <div class="col-sm-6">
                            <div class="form-group">
                                <input type="number" class="form-control @if ($errors->has('srt')) is-invalid @endif" name="srt" value="{{ old('srt',$country->srt_tax) }}" placeholder="Enter SRT">
                                <div class="invalid-feedback">{{ $errors->first('srt') }}</div>
                            </div>
                        </div> -->

                <div class="col-sm-6">
                            <div class="form-group">
                                <!-- <label class="control-label">ECAL<span class="text-danger">*</span></label> -->
                                <input type="number" class="form-control @if ($errors->has('ecal')) is-invalid @endif" name="ecal" value="{{ old('ecal',$country->ecal_tax) }}" placeholder="Enter ECAL">
                                <div class="invalid-feedback">{{ $errors->first('ecal') }}</div>
                            </div>
                        </div><!-- Col -->

                        <div class="col-sm-6">
                            <div class="form-group">
                                <!-- <label class="control-label">FNPF<span class="text-danger">*</span></label> -->
                                <input type="number" class="form-control @if ($errors->has('fnpf')) is-invalid @endif" name="fnpf" value="{{ old('fnpf',$country->fnpf) }}" placeholder="Enter FNPF">
                                <div class="invalid-feedback">{{ $errors->first('fnpf') }}</div>
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