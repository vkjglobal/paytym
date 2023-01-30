@extends('employer.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>{{ __('Register') }}</b></div>

                <div class="card-body">
                <form method="POST" action="{{ route('employer.register') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('name')) is-invalid @endif"
                                            name="name" value="{{ old('name') }}" placeholder="Enter your name"
                                            required>
                                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Company Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('company_name')) is-invalid @endif"
                                            name="company_name" value="{{ old('company_name') }}"
                                            placeholder="Enter company name" required>
                                        <div class="invalid-feedback">{{ $errors->first('company_name') }}</div>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Email <span class="text-danger">*</span></label>
                                        <input type="email"
                                            class="form-control @if ($errors->has('email')) is-invalid @endif"
                                            name="email" value="{{ old('email') }}" placeholder="Enter Email" required>
                                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Phone <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('phone')) is-invalid @endif"
                                            name="phone" value="{{ old('phone') }}" placeholder="Enter phone" required>
                                        <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Company Phone <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('company_phone')) is-invalid @endif"
                                            name="company_phone" value="{{ old('company_phone') }}"
                                            placeholder="Enter company phone" required>
                                        <div class="invalid-feedback">{{ $errors->first('company_phone') }}</div>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                   
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Street <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('street')) is-invalid @endif"
                                            name="street" value="{{ old('street') }}" placeholder="Enter Street" required>
                                        <div class="invalid-feedback">{{ $errors->first('street') }}</div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">City <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('city')) is-invalid @endif"
                                            name="city" value="{{ old('city') }}" placeholder="Enter City" required>
                                        <div class="invalid-feedback">{{ $errors->first('city') }}</div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Country <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('country')) is-invalid @endif"
                                            name="country" value="{{ old('country') }}" placeholder="Enter Country"
                                            required>
                                        <div class="invalid-feedback">{{ $errors->first('country') }}</div>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Tax Identification Number (TIN) <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('tin')) is-invalid @endif"
                                            name="tin" value="{{ old('tin') }}" placeholder="Enter TIN" required>
                                        <div class="invalid-feedback">{{ $errors->first('tin') }}</div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Website</label>
                                        <input type="url"
                                            class="form-control @if ($errors->has('website')) is-invalid @endif"
                                            name="website" value="{{ old('website') }}" placeholder="Enter Website">
                                        <div class="invalid-feedback">{{ $errors->first('website') }}</div>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                        
                        
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Registration Certificate</label>
                                        <input type="file"
                                            class="form-control @if ($errors->has('registration_certificate')) is-invalid @endif"
                                            name="registration_certificate" value="{{ old('registration_certificate') }}" placeholder="Enter Image">
                                        <div class="invalid-feedback">{{ $errors->first('registration_certificate') }}</div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">logo</label>
                                        <input type="file"
                                            class="form-control @if ($errors->has('image')) is-invalid @endif"
                                            name="image" value="{{ old('logo') }}" placeholder="Enter Image">
                                        <div class="invalid-feedback">{{ $errors->first('logo') }}</div>
                                    </div>
                                </div>
                            </div><!-- Row -->

                          
                            
                            <button type="submit" class="btn btn-primary submit">Register</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
