<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>@yield('title', 'My City Only | Your City, Your News')</title>
    <meta name="description" content="@yield('meta_description', 'Your city, your news. Stay informed with hyper-local stories, real-time updates, and a beautifully smooth reading experience.')">
    
    <!-- Google Fonts Premium -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 (lightweight grid + components) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #FFFFFF;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Premium Color Palette: #2563EB | #0F172A | #00B894 | #64748B */
        :root {
            --primary: #2563EB;
            --primary-dark: #1E40AF;
            --secondary: #00B894;
            --deep-slate: #0F172A;
            --muted-gray: #64748B;
            --bg-soft: #F8FAFE;
            --border-light: rgba(15, 23, 42, 0.08);
            --shadow-sm: 0 12px 30px rgba(15, 23, 42, 0.06);
            --shadow-hover: 0 28px 38px -18px rgba(0, 0, 0, 0.15);
            --transition-smooth: cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* Custom smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Responsive sections */
        .section-premium {
            padding: 6rem 0;
        }

        .section-premium-sm {
            padding: 4rem 0;
        }

        @media (max-width: 768px) {
            .section-premium {
                padding: 4rem 0;
            }
            .section-premium-sm {
                padding: 3rem 0;
            }
        }

        /* Glassmorphism Navbar */
        .navbar-premium {
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border-light);
            transition: all 0.3s var(--transition-smooth);
            padding: 0.9rem 0;
        }

        .navbar-premium.scrolled {
            padding: 0.5rem 0;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        }

        .brand-logo-img {
            width: 160px;
            height: auto;
            object-fit: contain;
            background: #fff;
            border: 1px solid var(--border-light);
            border-radius: 14px;
            box-shadow: 0 12px 30px rgba(15,23,42,.08);
        }

        .brand-dot {
            color: var(--secondary);
        }

        .nav-link-premium {
            font-weight: 500;
            color: var(--deep-slate);
            margin: 0 0.5rem;
            transition: color 0.2s;
            font-size: 0.95rem;
        }

        .nav-link-premium:hover {
            color: var(--primary);
        }

        /* Hero Section */
        .hero-section {
            min-height: 85vh;
            display: flex;
            align-items: center;
            background: linear-gradient(125deg, #FFFFFF 0%, #F0F4FE 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-glow {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.08) 0%, rgba(0, 184, 148, 0.02) 80%);
            right: -150px;
            top: -100px;
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1.2;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
        }

        .gradient-primary {
            background: linear-gradient(120deg, var(--primary), var(--secondary));
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .hero-lead {
            color: var(--muted-gray);
            font-size: 1.1rem;
            max-width: 90%;
        }

        .btn-premium {
            background: var(--primary);
            border: none;
            padding: 0.85rem 2rem;
            border-radius: 60px;
            font-weight: 600;
            transition: all 0.25s ease;
            box-shadow: 0 12px 22px -10px rgba(37, 99, 235, 0.35);
            color: white;
        }

        .btn-premium:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 20px 28px -12px rgba(37, 99, 235, 0.45);
            color: white;
        }

        .btn-outline-premium {
            border: 1px solid var(--border-light);
            background: white;
            padding: 0.8rem 1.8rem;
            border-radius: 60px;
            font-weight: 500;
            color: var(--deep-slate);
            transition: all 0.2s;
        }

        .btn-outline-premium:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
        }

        /* Responsive mockup card */
        .phone-mockup {
            max-width: 300px;
            margin: 0 auto;
            border-radius: 42px;
            background: #fff;
            box-shadow: 0 35px 65px -20px rgba(15, 23, 42, 0.25);
            border: 1px solid var(--border-light);
            overflow: hidden;
            transition: transform 0.4s ease;
        }

        @media (min-width: 992px) {
            .phone-mockup {
                max-width: 330px;
            }
        }

        .mockup-screen {
            background: var(--deep-slate);
            border-radius: 32px;
            margin: 10px;
            overflow: hidden;
            aspect-ratio: 9 / 19;
            background: linear-gradient(145deg, #0F172A, #1e293b);
            padding: 16px 12px;
        }

        /* Feature Card */
        .feature-card {
            background: white;
            border-radius: 28px;
            padding: 2rem 1.5rem;
            transition: all 0.35s var(--transition-smooth);
            border: 1px solid var(--border-light);
            height: 100%;
            box-shadow: var(--shadow-sm);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            border-color: rgba(37, 99, 235, 0.2);
            box-shadow: var(--shadow-hover);
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            background: rgba(37, 99, 235, 0.1);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        /* Stat Card */
        .stat-card {
            background: white;
            border-radius: 32px;
            padding: 2rem;
            text-align: center;
            border: 1px solid var(--border-light);
            transition: all 0.3s;
            box-shadow: var(--shadow-sm);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--deep-slate), var(--primary));
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        /* News Card (City News Preview) */
        .news-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid var(--border-light);
            transition: all 0.3s ease;
            height: 100%;
        }

        .news-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
        }

        .news-img-placeholder {
            background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
        }

        .section-kicker {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .bg-soft-mint {
            background-color: #F0FDF9;
        }

        .city-badge {
            background: rgba(0, 184, 148, 0.12);
            color: #008b6e;
            border-radius: 40px;
            padding: 0.3rem 0.9rem;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .footer-premium {
            background: var(--deep-slate);
            color: #94a3b8;
            padding: 3rem 0;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        /* responsive adjustments */
        @media (max-width: 576px) {
            .hero-lead {
                max-width: 100%;
            }
            .btn-premium, .btn-outline-premium {
                padding: 0.7rem 1.5rem;
                font-size: 0.9rem;
            }
            .stat-number {
                font-size: 2.3rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Premium Navigation -->
    <nav class="navbar navbar-expand-lg navbar-premium fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}" aria-label="My City Only">
                <img src="{{ asset('images/logo.png') }}" alt="My City Only" class="brand-logo-img">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#premiumNav" aria-label="Menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="premiumNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center gap-lg-2">
                    @if(url()->current() === url('/'))
                        <li class="nav-item"><a class="nav-link nav-link-premium" href="#features">Features</a></li>
                        <li class="nav-item"><a class="nav-link nav-link-premium" href="#city-news">City News</a></li>
                        <li class="nav-item"><a class="nav-link nav-link-premium" href="#stats">Insights</a></li>
                        <li class="nav-item"><a class="nav-link nav-link-premium" href="#download">Get App</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link nav-link-premium" href="{{ url('/') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link nav-link-premium" href="{{ route('public.terms') }}">Terms</a></li>
                        <li class="nav-item"><a class="nav-link nav-link-premium" href="{{ route('public.privacy') }}">Privacy</a></li>
                    @endif
                    <li class="nav-item ms-lg-2"><a class="btn btn-outline-premium btn-sm" href="{{ route('login') }}">Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="footer-premium">
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-md-6">
                    <a href="{{ url('/') }}" class="d-inline-flex align-items-center" aria-label="My City Only">
                        <img src="{{ asset('images/logo.png') }}" alt="My City Only" style="width: 160px; height: auto; background:#fff;border-radius:14px;border:1px solid rgba(255,255,255,.10);">
                    </a>
                    <p class="small opacity-75 mt-2 mb-0">© {{ date('Y') }} — Hyperlocal for the modern citizen.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="small mb-0">
                        <a href="{{ url('/') }}" class="text-white-50 text-decoration-none me-3">Home</a>
                        <a href="{{ route('public.terms') }}" class="text-white-50 text-decoration-none me-3">Terms</a>
                        <a href="{{ route('public.privacy') }}" class="text-white-50 text-decoration-none">Privacy</a>
                    </p>
                    <p class="small text-white-50 mt-2 mb-0">🌍 Every city has a voice — we amplify yours.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS with smooth settings
        AOS.init({
            duration: 800,
            once: true,
            offset: 60,
            easing: 'ease-out-quad'
        });

        // Navbar scroll effect
        const nav = document.getElementById('mainNav');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 30) nav.classList.add('scrolled');
            else nav.classList.remove('scrolled');
        });

        // Smooth anchor scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === "#" || href === "") return;
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>