<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="News App">
    <title>@yield('title', 'News Management System')</title>

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
                @yield('content')
            </div>

            <!-- partial:partials/_footer.html -->
         <footer class="footer d-flex flex-row align-items-center justify-content-between px-4 py-3 border-top small">
            <p class="text-secondary mb-1 mb-md-0">
                Copyright © <span id="year"></span> 
                <a href="#" target="_blank">News App</a>.
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

    @stack('scripts')
</body>
</html>
