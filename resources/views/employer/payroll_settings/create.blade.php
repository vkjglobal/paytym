@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Hourly Settings</h6>
                    <form action ="{{route('employer.payroll-setting-hourly.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Over time rate<span class="text-danger">*</span></label>
                                    <input type="number" step=any
                                        class="form-control @if ($errors->has('over_time_rate')) is-invalid @endif"
                                        name="over_time_rate" value="{{ old('over_time_rate') }}" placeholder="Enter Over time rate" required>
                                    <div class="invalid-feedback">{{ $errors->first('over_time_rate') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Double time rate <span class="text-danger">*</span></label>
                                    <input type="number" step=any
                                        class="form-control @if ($errors->has('double_time_rate')) is-invalid @endif"
                                        name="double_time_rate" value="{{ old('double_time_rate') }}" placeholder="Enter Double time rate" required>
                                    <div class="invalid-feedback">{{ $errors->first('double_time_rate') }}</div>
                                </div>
                            </div><!-- Col -->
                            </div>
                    <input type="hidden" name="business_id" value={{$id}}>
                    <button type="submit" class="btn btn-primary">Save</button>
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
