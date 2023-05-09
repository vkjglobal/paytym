@extends('employer.layouts.app')
@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Create User Capabilities </h6>
                <form method="POST" action="{{ route('employer.userroles.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">User Role<span class="text-danger">*</span></label>
                                <input placeholder="Enter User Role" type="text" name="user_role" class="form-control @if ($errors->has('user_role')) is-invalid @endif" value="{{ old('user_role') }}" required>
                                <div class="invalid-feedback">{{ $errors->first('user_role') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div>
                    <input type="submit" class="btn btn-primary submit" value="Submit">
                </form>

            </div>
        </div>
    </div>
</div>
@endsection