@extends('admin.layouts.app')
@section('content')
    @component('admin.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Employer Create</h6>
                    <form method="POST" action="{{ route('admin.employers.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Company Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('company')) is-invalid @endif"
                                        name="company" value="{{ old('company') }}" placeholder="Enter company name"
                                        required>
                                    <div class="invalid-feedback">{{ $errors->first('company') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('name')) is-invalid @endif"
                                        name="name" value="{{ old('name') }}" placeholder="Enter name" required>
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
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
                                    <input type="number"
                                        class="form-control @if ($errors->has('phone')) is-invalid @endif"
                                        name="phone" value="{{ old('phone') }}" placeholder="Enter phone" required>
                                    <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Company Phone <span class="text-danger">*</span></label>
                                    <input type="number"
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
                                    <label class="control-label">Street</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('street')) is-invalid @endif"
                                        name="street" value="{{ old('street') }}" placeholder="Enter Street">
                                    <div class="invalid-feedback">{{ $errors->first('street') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">City</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('city')) is-invalid @endif"
                                        name="city" value="{{ old('city') }}" placeholder="Enter City">
                                    <div class="invalid-feedback">{{ $errors->first('city') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Postcode</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('postcode')) is-invalid @endif"
                                        name="postcode" value="{{ old('postcode') }}" placeholder="Enter postcode">
                                    <div class="invalid-feedback">{{ $errors->first('postcode') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Country <span class="text-danger">*</span></label>
                                    <!-- <input type="text"
                                        class="form-control @if ($errors->has('country')) is-invalid @endif"
                                        name="country" value="{{ old('country') }}" placeholder="Enter Country" required>
                                     -->
                                   <!--  <select name="country" class="form-control category-dropdown" id="country" placeholder="Choose Country">
                                    <option value=" ">--All--</option>
                                        @foreach($country as $cntry)
                                            <option value="{{$cntry->id}}" {{Request::get('country') == $cntry->name ? 'selected': ''}}>{{$cntry->name}}</option>
                                        @endforeach 
                                </select> -->
                                <select class="form-control"  class="form-control @if ($errors->has('country')) is-invalid @endif" name="country" value="{{ old('country') }}">
                                    <option value="">--SELECT--</option>
                                    @foreach ($country as $key => $value)
                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('country') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Tax Identification Number (TIN)</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('tin')) is-invalid @endif"
                                        name="tin" value="{{ old('tin') }}" placeholder="Enter TIN">
                                    <div class="invalid-feedback">{{ $errors->first('tin') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
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
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Registration Certificate</label>
                                    <input type="file"
                                        class="form-control @if ($errors->has('registration_certificate')) is-invalid @endif"
                                        name="registration_certificate" value="{{ old('registration_certificate') }}"
                                        placeholder="Enter registration certificate">
                                    <div class="invalid-feedback">{{ $errors->first('registration_certificate') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Tin Letter</label>
                                    <input type="file"
                                        class="form-control @if ($errors->has('tin_letter')) is-invalid @endif"
                                        name="tin_letter" value="{{ old('tin_letter') }}"
                                        placeholder="Enter tin letter">
                                    <div class="invalid-feedback">{{ $errors->first('tin_letter') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">logo</label>
                                    <input type="file"
                                        class="form-control @if ($errors->has('logo')) is-invalid @endif"
                                        name="logo" value="{{ old('logo') }}" placeholder="Enter logo">
                                    <div class="invalid-feedback">{{ $errors->first('logo') }}</div>
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
