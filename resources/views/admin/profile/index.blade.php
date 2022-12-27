@extends('admin.layouts.app')
@section('content')
    @component('admin.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">

        <div class="col-md-6 ">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Profile</h6>
                    <form method="POST" action="{{ route('admin.profile') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif"
                                name="name" autocomplete="off" placeholder="Name" value="{{ old('name', $admin->name) }}"
                                required>
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @if ($errors->has('email')) is-invalid @endif"
                                name="email" placeholder="Email" value="{{ old('email', $admin->email) }}" required>
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Update Profile</button>
                    </form>
                </div>
            </div>
        </div><!-- Col -->

        <!-- Password Update -->
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Password Update</h6>
                    <form method="POST" action="{{ route('admin.update.password') }}">
                        @csrf
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @if ($errors->has('password')) is-invalid @endif"
                                name="password" autocomplete="off" placeholder="Password" required>
                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control @if ($errors->has('password_confirmation')) is-invalid @endif"
                                name="password_confirmation" placeholder="Confirm Password" required>
                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                        </div>
                        <button type="submit" class="btn btn-warning mr-2">Update Password</button>
                    </form>
                </div>
            </div>
        </div><!-- Col -->

    </div><!-- Row -->
@endsection
