<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paytym | Admin Login</title>
    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/demo_1/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('admin_assets/images/favicon.png') }}" />
    <style>
         .auth-page .auth-left-wrapper {
            background-image: url('../admin_assets/images/employer-login.jpeg');
            background-position: center;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">

                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-4 pr-md-0">
                                    <div class="auth-left-wrapper">

                                    </div>
                                </div>
                                <div class="col-md-8 pl-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <a href="#"
                                            class="noble-ui-logo d-block mb-2">Paytym<span>Admin</span></a>

                                        <form method="POST" action="{{ route('admin.login') }}">
                                            @csrf
                                            
                                            <div class="form-group">
                                                <label for="email">{{ __('Email Address') }}</label>
                                                <input type="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('email') }}" placeholder="Email" required>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="password">{{ __('Password') }}</label>
                                                <input type="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="Password" required>

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="remember"
                                                        id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>

                                            <div class="mt-3">
                                                <button type="submit"
                                                    class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">
                                                    {{ __('Login') }}
                                                </button>

                                                <!-- Forgot Password -->
                                                @if (Route::has('admin.password.request'))
                                                    <a class="btn btn-link"
                                                        href="{{ route('admin.password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a>
                                                @endif
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- core:js -->
    <script src="{{ asset('admin_assets/vendors/core/core.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/template.js') }}"></script>
</body>

</html>
