@extends('admin.layouts.app')
@section('content')
@component('admin.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">{{ $employer->name }}&nbsp; Details</h6>
                <form method="POST" action="{{ route('admin.employers.update', $employer->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Company Name </label>
                                <input type="text" class="form-control @if ($errors->has('company')) is-invalid @endif" name="company" value="{{ old('company', $employer->company) }}" placeholder="Enter company name" disabled>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Name </label>
                                <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" value="{{ old('name', $employer->name) }}" placeholder="Enter name" disabled>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input type="email" class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" value="{{ old('email', $employer->email) }}" placeholder="Enter Email" disabled>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Phone</label>
                                <input type="number" class="form-control @if ($errors->has('phone')) is-invalid @endif" name="phone" value="{{ old('phone', $employer->phone) }}" placeholder="Enter phone" disabled>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Company Phone </label>
                                <input type="number" class="form-control @if ($errors->has('company_phone')) is-invalid @endif" name="company_phone" value="{{ old('company_phone', $employer->company_phone) }}" placeholder="Enter company phone" disabled>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Street</label>
                                <input type="text" class="form-control @if ($errors->has('street')) is-invalid @endif" name="street" value="{{ old('street', $employer->street) }}" placeholder="Enter Street" disabled>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">City</label>
                                <input type="text" class="form-control @if ($errors->has('city')) is-invalid @endif" name="city" value="{{ old('city', $employer->city) }}" disabled>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Postcode</label>
                                <input type="text" class="form-control @if ($errors->has('postcode')) is-invalid @endif" name="postcode" value="{{ old('postcode', $employer->postcode) }}" disabled>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Country</label>
                                <select class="form-control" class="form-control @if ($errors->has('country')) is-invalid @endif" name="country" value="{{ old('country')}}" disabled>
                                    <option value="">--SELECT--</option>
                                    @foreach ($country as $key => $value)
                                    <option value="{{$value['id']}}" @if ($value['id']==$employer->country_id)
                                        selected
                                        @endif>{{$value['name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('country') }}</div>
                            </div>
                        </div><!-- Col -->

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Tax Identification Number (TIN)</label>
                                <input type="text" class="form-control @if ($errors->has('tin')) is-invalid @endif" name="tin" value="{{ old('tin', $employer->tin) }}" disabled>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Website</label>
                                <input type="url" class="form-control @if ($errors->has('website')) is-invalid @endif" name="website" value="{{ old('website', $employer->website) }}" disabled>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Registration Certificate</label>
                                <iframe src="{{ asset('storage/' . $employer->registration_certificate) }}" class="img-thumbnail mt-2" style="width:60%"></iframe>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Tin Letter</label>
                                <iframe src="{{ asset('storage/' . $employer->tin_letter) }}" class="img-thumbnail mt-2" style="width:60%"></iframe>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">logo</label>
                                <iframe src="{{ asset('storage/' . $employer->logo) }}"   class="img-thumbnail mt-2" style="width:60%"></iframe>
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