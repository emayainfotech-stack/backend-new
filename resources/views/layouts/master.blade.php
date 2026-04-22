<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="My City Only">
    <title>@yield('title', 'My City Only')</title>

    <!-- color-modes:js -->
    <script src="{{ asset('Backend/assets/js/color-modes.js') }}"></script>
    <!-- endinject -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('Backend/assets/css/demo1/style.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('Backend/assets/images/favicon.png') }}" />
</head>
<body>
    <div class="main-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('partials.sidebar')
        <!-- partial -->

        <div class="page-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('partials.header')
            <!-- partial -->

            <div class="page-content ">
                {{-- Global toast notifications --}}
                <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1080;">
                    @if (session('success'))
                        <div id="appToast"
                             class="toast align-items-center text-bg-success border-0"
                             role="alert" aria-live="assertive" aria-atomic="true"
                             data-bs-delay="3000">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{ session('success') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                        data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    @elseif (session('error'))
                        <div id="appToast"
                             class="toast align-items-center text-bg-danger border-0"
                             role="alert" aria-live="assertive" aria-atomic="true"
                             data-bs-delay="4000">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{ session('error') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                        data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                </div>

                @yield('content')
            </div>

            <!-- partial:partials/_footer.html -->
         <footer class="footer d-flex flex-row align-items-center justify-content-between px-4 py-3 border-top small">
            <p class="text-secondary mb-1 mb-md-0">
                Copyright © <span id="year"></span> 
                <a href="#" target="_blank">My City Only</a>.
            </p>

        
        </footer>

        <script>
            document.getElementById('year').textContent = new Date().getFullYear();
        </script>
            <!-- partial -->
        </div>
    </div>

    <!-- core:js -->
    <script src="{{ asset('Backend/assets/vendors/core/core.js') }}"></script>
    <!-- endinject -->

    <!-- inject:js -->
    <script src="{{ asset('Backend/assets/js/app.js') }}"></script>
    <!-- endinject -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const el = document.getElementById('appToast');
            if (!el) return;

            // Bootstrap 5 toast
            if (window.bootstrap && typeof window.bootstrap.Toast === 'function') {
                const toast = new window.bootstrap.Toast(el);
                toast.show();
                return;
            }

            // Fallback (if bootstrap.Toast is not available)
            el.classList.add('show');
            setTimeout(() => el.classList.remove('show'), 3500);
        });
    </script>

    @stack('scripts')
</body>
</html>
