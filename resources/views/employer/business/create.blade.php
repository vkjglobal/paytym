@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Create Business</h6>
                    <form method="POST" action="{{ route('employer.business.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Business Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('business')) is-invalid @endif"
                                        name="name" value="{{ old('business') }}" placeholder="Enter Business Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('business') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Description<span class="text-danger">*</span></label>
                                <!-- <select class="form-control" id="file_type" name="file_type">
                                    <option value="0">--SELECT--</option>

                                </select> -->
                                <textarea name="description" class="form-control @if ($errors->has('description')) is-invalid @endif" cols="30"
                                        rows="5" required>{{ old('description') }}</textarea>
                                    
                                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                            </div>
                        </div><!-- Col -->
                        </div><!-- Row -->

                        <div class="row">
                        <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Country <span class="text-danger">*</span></label>
                                    <select class="form-control" name="country" id="country" value="{{ old('country') }}">
                                        <option value="">--Choose Country--</option>
                                        @foreach ($country as $key => $value )
                                        <option value="{{ $value['id'] }}">{{ $value['name']}}</option>
                                        @endforeach
                                    </select>
                                    
                                    <div class="invalid-feedback">{{ $errors->first('country') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-4" style="display: none;" id="bank_div">
                                <div class="form-group">
                                    <label class="control-label">bank <span class="text-danger">*</span></label>
                                    <select class="form-control" name="bank" id="bank" value="{{ old('bank') }}">
                                    </select>

                                    <div class="invalid-feedback">{{ $errors->first('bank') }}</div>
                                </div>
                            </div><!-- Col -->

                        </div><!-- Row -->
                        

                        <div class="row" id="wbc_details" style="display: none;"> 
                        <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Full Company Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @if ($errors->has('company_name')) is-invalid @endif"
                                        name="company_name" id="company_name"  value="{{ old('company_name') }}" placeholder="Enter Company Name">
                                    <div class="invalid-feedback">{{ $errors->first('company_name') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Account  Number<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @if ($errors->has('account_number')) is-invalid @endif"
                                        name="account_number" id="account_number"  value="{{ old('account_number') }}" placeholder="Enter Account Number">
                                    <div class="invalid-feedback">{{ $errors->first('company_name') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">At least one Batch No. registered with WBC*<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @if ($errors->has('batch_no')) is-invalid @endif"
                                        name="batch_no" id="batch_no"  value="{{ old('batch_no') }}" placeholder="Enter Batch No">
                                    <div class="invalid-feedback">{{ $errors->first('batch_no') }}</div>
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
    <script src="{{ asset('admin_assets/js/bank_data.js') }}"></script>
@endpush
