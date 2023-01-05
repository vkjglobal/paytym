@extends('admin.layouts.app')
@section('content')
@component('admin.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Custom Subscription Edit</h6>
                <form method="POST" action="{{ route('admin.custom_subscriptions.update', $custom_subscription->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                    <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Company<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('company')) is-invalid @endif" name="company" value="{{ old('company') }}">
                                    <option value="">--SELECT--</option>
                                    @foreach ($employer as $key => $value)
                                    <option value="{{$value['id']}}" @if ($value['id']==$custom_subscription->employer_id)
                                        selected
                                    @endif>{{$value['company']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('company') }}</div>
                            </div>
                        </div><!-- Col -->

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Plan Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('plan')) is-invalid @endif" name="plan" value="{{ old('plan',$custom_subscription->plan) }}" placeholder="Enter Plan name">
                                <div class="invalid-feedback">{{ $errors->first('plan') }}</div>
                            </div>
                        </div><!-- Col -->

                    </div><!-- Col -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Employee Range From <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('range_from')) is-invalid @endif" name="range_from" value="{{ old('range_from',$custom_subscription->range_from) }}" placeholder="Enter Range From">
                                <div class="invalid-feedback">{{ $errors->first('range_from') }}</div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Employee Range To <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('range_to')) is-invalid @endif" name="range_to" value="{{ old('range_to',$custom_subscription->range_to) }}" placeholder="Enter Range To">
                                <div class="invalid-feedback">{{ $errors->first('range_to') }}</div>
                            </div>
                        </div>
                    </div><!-- Row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Rate Per Employee<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('rate_per_employee')) is-invalid @endif" name="rate_per_employee" value="{{ old('rate_per_employee',$custom_subscription->rate_per_employee) }}" placeholder="Enter Rate Per Employee">
                                <div class="invalid-feedback">{{ $errors->first('rate_per_employee') }}</div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Rate Per Month</label>
                                <input type="text" class="form-control @if ($errors->has('rate_per_month')) is-invalid @endif" name="rate_per_month" value="{{ old('rate_per_month',$custom_subscription->rate_per_month) }}" placeholder="Enter Rate Per Month">
                                <div class="invalid-feedback">{{ $errors->first('rate_per_month') }}</div>
                            </div>
                        </div>
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