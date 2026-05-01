<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>@yield('title', 'My City Only | Your City, Your News')</title>
    <meta name="description" content="@yield('meta_description', 'Your city, your news. Stay informed with hyper-local stories, real-time updates, and a beautifully smooth reading experience.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700;1,900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #2563EB;
            --primary-dark: #1E40AF;
            --secondary: #00B894;
            --deep-slate: #0F172A;

            --ink:        var(--deep-slate);
            --ink-soft:   #131c2f;
            --ink-muted:  #1e293b;
            --cream:      #faf8f3;
            --accent:     var(--primary);
            --accent-dim: rgba(37, 99, 235, 0.12);
            --accent-bdr: rgba(37, 99, 235, 0.25);
            --accent-glow-07: rgba(37, 99, 235, 0.07);
            --accent-glow-09: rgba(37, 99, 235, 0.09);
            --accent-glow-10: rgba(37, 99, 235, 0.1);
            --accent-glow-12: rgba(37, 99, 235, 0.12);
            --accent-bdr-20: rgba(37, 99, 235, 0.2);
            --accent-bdr-28: rgba(37, 99, 235, 0.28);
            --white:      #ffffff;
            --muted:      #94a3b8;
            --border:     rgba(255,255,255,0.08);
            --ff-display: 'Playfair Display', Georgia, serif;
            --ff-body:    'DM Sans', system-ui, sans-serif;
            --transition: cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: var(--ff-body);
            background: var(--ink);
            color: var(--white);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ── NAVBAR ── */
        .navbar-premium {
            background: rgba(15, 23, 42, 0.88);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
            padding: 1.1rem 0;
            transition: padding 0.3s var(--transition), background 0.3s;
        }
        .navbar-premium.scrolled {
            padding: 0.6rem 0;
            background: rgba(15, 23, 42, 0.97);
        }

        .brand-logo-text {
            font-family: var(--ff-display);
            font-weight: 700;
            font-size: 1.15rem;
            color: var(--white);
            text-decoration: none;
            letter-spacing: -0.01em;
        }
        .brand-logo-text span { color: var(--accent); }

        .brand-logo-img {
            height: 36px;
            width: auto;
            object-fit: contain;
        }

        .nav-link-premium {
            font-size: 0.82rem;
            font-weight: 400;
            color: var(--muted) !important;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            transition: color 0.2s;
            padding: 0.25rem 0 !important;
        }
        .nav-link-premium:hover { color: var(--white) !important; }

        .btn-nav-cta {
            background: var(--accent);
            color: var(--white) !important;
            padding: 0.5rem 1.3rem !important;
            border-radius: 2px;
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            transition: background 0.2s, transform 0.15s;
            border: none;
        }
        .btn-nav-cta:hover {
            background: var(--primary-dark) !important;
            transform: translateY(-1px);
            color: var(--white) !important;
        }

        .navbar-toggler {
            border: 1px solid var(--border);
            padding: 0.35rem 0.6rem;
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255,255,255,0.6%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* ── FOOTER ── */
        .footer-premium {
            background: var(--ink-soft);
            border-top: 1px solid var(--border);
            padding: 2.5rem 0;
        }
        .footer-logo {
            font-family: var(--ff-display);
            font-weight: 700;
            font-size: 1rem;
            color: rgba(255,255,255,0.45);
            text-decoration: none;
        }
        .footer-logo span { color: var(--accent); }
        .footer-copy {
            font-size: 0.78rem;
            color: rgba(255,255,255,0.22);
            letter-spacing: 0.02em;
        }
        .footer-links a {
            font-size: 0.78rem;
            color: rgba(255,255,255,0.35);
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-links a:hover { color: var(--white); }

        /* ── SHARED UTILITIES ── */
        .section-premium { padding: 7rem 0; }

        .section-kicker {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 1.1rem;
        }

        .section-heading {
            font-family: var(--ff-display);
            font-size: clamp(2rem, 3.5vw, 3.4rem);
            font-weight: 900;
            line-height: 1.05;
            letter-spacing: -0.03em;
            color: var(--white);
            margin-bottom: 1rem;
        }
        .section-heading em {
            font-style: italic;
            color: var(--accent);
        }
        .section-heading.dark { color: var(--ink); }

        .section-sub {
            font-size: 1rem;
            font-weight: 300;
            color: rgba(255,255,255,0.45);
            line-height: 1.75;
        }
        .section-sub.dark { color: rgba(15, 23, 42, 0.55); }

        .gradient-primary {
            font-style: italic;
            color: var(--accent);
        }

        /* ── PHONE MOCKUP (shared) ── */
        .phone-mockup {
            background: var(--ink-soft);
            border-radius: 36px;
            border: 1px solid rgba(255,255,255,0.1);
            padding: 1.5rem 1.25rem;
            box-shadow: 0 40px 80px rgba(0,0,0,0.55);
            max-width: 270px;
            margin: 0 auto;
        }
        .mockup-notch {
            width: 80px; height: 6px;
            background: rgba(255,255,255,0.1);
            border-radius: 3px;
            margin: 0 auto 1.25rem;
        }
        .mockup-screen {
            background: linear-gradient(145deg, var(--deep-slate), var(--ink-soft));
            border-radius: 24px;
            padding: 1rem 0.85rem;
            min-height: 220px;
        }
        .city-badge {
            font-size: 0.6rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.2rem 0.6rem;
            border-radius: 99px;
        }

        /* ── BUTTONS ── */
        .btn-premium {
            background: var(--accent);
            color: var(--white);
            padding: 0.85rem 2rem;
            border-radius: 2px;
            font-size: 0.88rem;
            font-weight: 500;
            text-decoration: none;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            border: none;
            transition: background 0.2s, transform 0.2s;
            display: inline-block;
        }
        .btn-premium:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            color: var(--white);
        }
        .btn-outline-premium {
            background: transparent;
            color: rgba(255,255,255,0.5);
            font-size: 0.88rem;
            font-weight: 400;
            text-decoration: none;
            letter-spacing: 0.02em;
            border: none;
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }
        .btn-outline-premium::after { content: '→'; transition: transform 0.2s; }
        .btn-outline-premium:hover { color: var(--white); }
        .btn-outline-premium:hover::after { transform: translateX(4px); }

        /* ── SCROLL REVEAL ── */
        [data-reveal] {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        [data-reveal].visible { opacity: 1; transform: translateY(0); }
        [data-reveal="d1"] { transition-delay: 0.1s; }
        [data-reveal="d2"] { transition-delay: 0.2s; }
        [data-reveal="d3"] { transition-delay: 0.3s; }
        [data-reveal="d4"] { transition-delay: 0.4s; }

        @media (max-width: 768px) {
            .section-premium { padding: 4rem 0; }
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-premium fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}" aria-label="My City Only">
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ asset('images/logo.png') }}" alt="My City Only" class="brand-logo-img">
                @else
                    <span class="brand-logo-text">My<span>City</span>Only</span>
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#premiumNav" aria-label="Menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            @php
                $onHome = url()->current() === url('/');
                $hash = fn ($id) => $onHome ? '#'.$id : url('/#'.$id);
            @endphp
            <div class="collapse navbar-collapse" id="premiumNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center gap-lg-3">
                    <li class="nav-item"><a class="nav-link nav-link-premium" href="{{ $hash('features') }}">Features</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-premium" href="{{ $hash('screens') }}">Screens</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-premium" href="{{ $hash('stats') }}">Stats</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-premium" href="{{ route('public.terms') }}">Terms</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-premium" href="{{ route('public.privacy') }}">Privacy</a></li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn-nav-cta nav-link" href="{{ $hash('download') }}">Get App</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="footer-premium">
        <div class="container">
            <div class="row align-items-center gy-3">
                <div class="col-md-4">
                    <a href="{{ url('/') }}" class="footer-logo">My<span>City</span>Only</a>
                    <p class="footer-copy mt-1 mb-0">© {{ date('Y') }} MyCityOnly. All rights reserved.</p>
                </div>
                <div class="col-md-4 text-md-center">
                    <p class="footer-copy mb-0">Every city has a voice — we amplify yours.</p>
                </div>
                <div class="col-md-4 text-md-end footer-links d-flex gap-3 justify-content-md-end">
                    <a href="{{ url('/') }}">Home</a>
                    <a href="{{ route('public.terms') }}">Terms</a>
                    <a href="{{ route('public.privacy') }}">Privacy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true, offset: 60, easing: 'ease-out-quad' });

        const nav = document.getElementById('mainNav');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 30);
        });

        // Scroll reveal
        const reveals = document.querySelectorAll('[data-reveal]');
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
            });
        }, { threshold: 0.1 });
        reveals.forEach(el => io.observe(el));

        // Smooth anchors
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#' || href === '') return;
                const target = document.querySelector(href);
                if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>