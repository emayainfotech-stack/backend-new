<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <title>Login - My City Only</title>

    <script src="{{ asset('Backend/assets/js/color-modes.js') }}"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/css/demo1/style.css') }}">

    <link rel="shortcut icon" href="{{ asset('Backend/assets/images/favicon.png') }}" />
</head>
<body>
<div class="main-wrapper">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">
            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="row">
                            
                            <!-- Left Side -->
                            <div class="col-md-4 pe-md-0">
                                <div class="auth-side-wrapper"></div>
                            </div>

                            <!-- Right Side -->
                            <div class="col-md-8 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    
                                    <a href="#" class="nobleui-logo d-block mb-2">
                                        My City <span>Only</span>
                                    </a>

                                    <h5 class="text-secondary fw-normal mb-4">
                                        Welcome back! Log in to your account.
                                    </h5>

                                    <form action="{{ route('login.submit') }}" method="POST">
                                        @csrf

                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label class="form-label">Email address</label>
                                            <input type="email"
                                                   name="email"
                                                   value="{{ old('email') }}"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   placeholder="Email"
                                                   required>

                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Password -->
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password"
                                                   name="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   placeholder="Password"
                                                   required>

                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- <!-- Remember -->
                                        <div class="mb-3 d-flex justify-content-between align-items-center">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="remember" value="1">
                                                <label class="form-check-label">Remember me</label>
                                            </div>
                                            <a href="#" class="text-muted">Forgot password?</a>
                                        </div> --}}

                                        <!-- Button -->
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary w-100">
                                                Login
                                            </button>
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

</body>
</html>