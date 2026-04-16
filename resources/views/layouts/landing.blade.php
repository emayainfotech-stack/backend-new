<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'News App')</title>
    <meta name="description" content="@yield('meta_description', 'Read news in short, fast, and clean.')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --landing-text: #0f172a;
            --landing-muted: #64748b;
            --landing-border: rgba(15, 23, 42, .10);
            --landing-bg: #ffffff;
            --landing-soft: #f8fafc;
            --landing-accent: #ef4444;
        }
        html, body { height: 100%; }
        body {
            font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            color: var(--landing-text);
            background: var(--landing-bg);
        }
        .landing-nav {
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,.8);
            border-bottom: 1px solid var(--landing-border);
        }
        .brand-mark {
            width: 34px; height: 34px; border-radius: 9px;
            background: radial-gradient(circle at 30% 30%, #ff6b6b, #ef4444 55%, #b91c1c 100%);
            display: inline-flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 800; letter-spacing: -.02em;
            box-shadow: 0 12px 30px rgba(239,68,68,.22);
        }
        .hero {
            padding-top: 5.25rem;
            padding-bottom: 4.5rem;
        }
        .hero h1 { letter-spacing: -.03em; }
        .hero-lead { color: var(--landing-muted); max-width: 42rem; }
        .store-btn {
            border: 1px solid var(--landing-border);
            background: #fff;
            border-radius: 12px;
            padding: 10px 14px;
            text-decoration: none;
            color: var(--landing-text);
            display: inline-flex;
            gap: 10px;
            align-items: center;
            transition: transform .15s ease, box-shadow .15s ease;
        }
        .store-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 26px rgba(15, 23, 42, .08);
        }
        .store-btn small { color: var(--landing-muted); display:block; line-height:1.1; }
        .store-btn strong { display:block; line-height:1.2; font-size: .98rem; }
        .phone-shell {
            width: 100%;
            max-width: 380px;
            aspect-ratio: 9 / 16;
            border-radius: 34px;
            border: 1px solid rgba(15,23,42,.14);
            background: linear-gradient(180deg, #0b1220 0%, #0f172a 35%, #0b1220 100%);
            padding: 16px;
            box-shadow: 0 28px 70px rgba(15, 23, 42, .18);
            position: relative;
            overflow: hidden;
        }
        .phone-notch {
            width: 38%;
            height: 20px;
            border-radius: 0 0 14px 14px;
            background: rgba(0,0,0,.55);
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: 0;
        }
        .phone-screen {
            height: 100%;
            border-radius: 22px;
            overflow: hidden;
            background: #fff;
            display: flex;
            flex-direction: column;
        }
        .screen-top {
            padding: 14px 14px 10px;
            border-bottom: 1px solid rgba(15,23,42,.08);
            display:flex;
            align-items:center;
            justify-content: space-between;
            gap: 10px;
        }
        .pill {
            font-size: .72rem;
            background: rgba(239,68,68,.10);
            color: #b91c1c;
            border: 1px solid rgba(239,68,68,.22);
            padding: 6px 10px;
            border-radius: 999px;
            font-weight: 600;
        }
        .screen-card {
            padding: 14px;
            display:grid;
            gap: 10px;
        }
        .line {
            height: 10px;
            border-radius: 999px;
            background: rgba(15,23,42,.09);
        }
        .line.w-60 { width: 60%; }
        .line.w-80 { width: 80%; }
        .line.w-90 { width: 90%; }
        .thumb {
            width: 100%;
            height: 160px;
            border-radius: 14px;
            background: linear-gradient(135deg, rgba(239,68,68,.20), rgba(37,99,235,.18));
            border: 1px solid rgba(15,23,42,.10);
        }
        .section {
            padding: 4.5rem 0;
        }
        .section-muted { background: var(--landing-soft); border-top: 1px solid rgba(15,23,42,.06); border-bottom: 1px solid rgba(15,23,42,.06); }
        .kicker { color: var(--landing-muted); font-weight: 600; letter-spacing: .02em; text-transform: uppercase; font-size: .78rem; }
        .feature {
            padding: 18px 18px;
            border: 1px solid rgba(15,23,42,.08);
            background: #fff;
            border-radius: 16px;
        }
        .stat {
            border-radius: 16px;
            border: 1px solid rgba(15,23,42,.08);
            background: #fff;
            padding: 18px;
        }
        .footer {
            border-top: 1px solid var(--landing-border);
            padding: 3rem 0;
            color: var(--landing-muted);
        }
        .footer a { color: var(--landing-muted); text-decoration: none; }
        .footer a:hover { color: var(--landing-text); }
    </style>

    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg landing-nav sticky-top">
        <div class="container py-2">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ url('/') }}">
                <span class="brand-mark">N</span>
                <span>News App</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#landingNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="landingNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#screens">Screens</a></li>
                    <li class="nav-item"><a class="nav-link" href="#stats">Stats</a></li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-outline-dark btn-sm" href="{{ route('login') }}">Admin Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>

