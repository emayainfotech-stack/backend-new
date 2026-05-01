@extends('layouts.landing')

@section('title', 'My City Only | Your City, Your News')
@section('meta_description', 'Your city, your news. Stay informed with hyper-local stories, real-time updates, and a beautifully smooth reading experience.')

@push('styles')
<style>
    /* ── HERO ── */
    .hero-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        padding: 7rem 0 4rem;
    }
    .hero-bg-word {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-family: var(--ff-display);
        font-size: clamp(100px, 18vw, 240px);
        font-weight: 900;
        color: rgba(255,255,255,0.02);
        white-space: nowrap;
        pointer-events: none;
        user-select: none;
        letter-spacing: -0.04em;
        z-index: 0;
    }
    .hero-glow {
        position: absolute;
        width: 500px; height: 500px;
        background: radial-gradient(circle, var(--accent-glow-07) 0%, transparent 70%);
        right: 5%;
        top: 20%;
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
    }
    .hero-title {
        font-family: var(--ff-display);
        font-size: clamp(2.8rem, 5.5vw, 5rem);
        font-weight: 900;
        line-height: 1.02;
        letter-spacing: -0.03em;
        color: var(--white);
        margin-bottom: 1.5rem;
    }
    .hero-lead {
        font-size: 1.05rem;
        font-weight: 300;
        color: rgba(255,255,255,0.52);
        line-height: 1.75;
        max-width: 440px;
        margin-bottom: 2.5rem;
    }
    .hero-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.72rem;
        font-weight: 500;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--accent);
        background: var(--accent-dim);
        border: 1px solid var(--accent-bdr);
        padding: 0.35rem 0.85rem;
        border-radius: 2px;
        margin-bottom: 2rem;
    }
    .hero-tag-dot {
        width: 6px; height: 6px;
        background: var(--secondary);
        border-radius: 50%;
        animation: blink 2s infinite;
    }
    @keyframes blink {
        0%, 100% { opacity: 1; }
        50%       { opacity: 0.25; }
    }

    /* Phone hero card */
    .hero-phone {
        animation: float 5s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50%       { transform: translateY(-12px); }
    }
    .phone-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.2rem;
    }
    .phone-brand {
        font-family: var(--ff-display);
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--white);
    }
    .live-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        font-size: 0.6rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #4ade80;
        background: rgba(74,222,128,0.1);
        border: 1px solid rgba(74,222,128,0.25);
        padding: 0.2rem 0.55rem;
        border-radius: 99px;
    }
    .live-pill::before {
        content: '';
        width: 5px; height: 5px;
        background: #4ade80;
        border-radius: 50%;
        animation: blink 2s infinite;
    }
    .news-item {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 10px;
        padding: 0.75rem 0.9rem;
        margin-bottom: 0.55rem;
    }
    .news-item:last-child { margin-bottom: 0; }
    .news-item-tag {
        font-size: 0.58rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--accent);
        margin-bottom: 0.3rem;
    }
    .news-item-title {
        font-size: 0.76rem;
        font-weight: 500;
        color: var(--white);
        line-height: 1.4;
        margin-bottom: 0.3rem;
    }
    .news-item-meta {
        font-size: 0.62rem;
        color: rgba(255,255,255,0.28);
    }
    .news-item-featured {
        background: var(--accent-glow-09);
        border-color: var(--accent-bdr-20);
    }
    .phone-bottom-nav {
        margin-top: 1rem;
        padding-top: 0.85rem;
        border-top: 1px solid rgba(255,255,255,0.07);
        display: flex;
        justify-content: space-around;
    }
    .pbn-dot {
        width: 22px; height: 2px;
        background: rgba(255,255,255,0.15);
        border-radius: 1px;
        position: relative;
    }
    .pbn-dot.active { background: var(--accent); }
    .pbn-dot::before, .pbn-dot::after {
        content: '';
        position: absolute;
        left: 0; right: 0;
        height: 2px;
        border-radius: 1px;
        background: inherit;
    }
    .pbn-dot::before { top: -5px; }
    .pbn-dot::after  { top:  5px; }

    /* ── TICKER ── */
    .ticker-bar {
        background: var(--accent);
        padding: 0.6rem 0;
        overflow: hidden;
    }
    .ticker-track {
        display: flex;
        gap: 3rem;
        white-space: nowrap;
        animation: scroll-ticker 28s linear infinite;
    }
    .ticker-item {
        font-size: 0.72rem;
        font-weight: 500;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.85);
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .ticker-sep { color: rgba(255,255,255,0.3); }
    @keyframes scroll-ticker {
        from { transform: translateX(0); }
        to   { transform: translateX(-50%); }
    }

    /* ── FEATURES ── */
    .features-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1px;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 10px;
        overflow: hidden;
        margin-top: 3.5rem;
    }
    .feature-card {
        background: var(--ink-soft);
        padding: 2.5rem;
        position: relative;
        overflow: hidden;
        transition: background 0.25s;
    }
    .feature-card:hover { background: var(--ink-muted); }
    .feat-num {
        font-size: 0.64rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        color: rgba(255,255,255,0.18);
        margin-bottom: 1.5rem;
    }
    .feature-icon {
        font-size: 1.4rem;
        margin-bottom: 0.9rem;
        display: block;
    }
    .feature-card h5 {
        font-family: var(--ff-display);
        font-size: 1.3rem;
        font-weight: 700;
        letter-spacing: -0.02em;
        color: var(--white);
        margin-bottom: 0.55rem;
    }
    .feature-card p {
        font-size: 0.88rem;
        font-weight: 300;
        color: rgba(255,255,255,0.42);
        line-height: 1.65;
        margin-bottom: 0;
    }
    .feat-glow {
        position: absolute;
        bottom: -10px; right: -10px;
        width: 80px; height: 80px;
        background: radial-gradient(circle, var(--accent-glow-12) 0%, transparent 70%);
        pointer-events: none;
    }
    @media (max-width: 576px) {
        .features-grid { grid-template-columns: 1fr; }
    }

    /* ── STATS ── */
    .stats-section {
        background: var(--ink-soft);
        border-top: 1px solid rgba(255,255,255,0.06);
        border-bottom: 1px solid rgba(255,255,255,0.06);
        padding: 5rem 0;
    }
    .stat-card {
        padding: 3rem 2rem;
        border-right: 1px solid rgba(255,255,255,0.07);
        text-align: left;
    }
    .stat-card:last-child { border-right: none; }
    .stat-number {
        font-family: var(--ff-display);
        font-size: clamp(3rem, 5vw, 5rem);
        font-weight: 900;
        letter-spacing: -0.04em;
        color: var(--white);
        line-height: 1;
        margin-bottom: 0.5rem;
    }
    .stat-number span { color: var(--accent); }
    .stat-label {
        font-size: 0.85rem;
        font-weight: 300;
        color: rgba(255,255,255,0.4);
        line-height: 1.5;
    }

    /* ── SCREENS ── */
    .bg-soft-mint {
        background: var(--cream);
    }
    .screens-section .section-kicker { color: var(--accent); }
    .screens-section .section-heading { color: var(--ink); }
    .screens-section .section-heading em { color: var(--accent); }

    .screen-card {
        background: var(--ink);
        border-radius: 16px;
        padding: 2.25rem;
        height: 100%;
        overflow: hidden;
        position: relative;
    }
    .screen-card-num {
        font-size: 0.68rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 0.4rem;
    }
    .screen-card h4 {
        font-family: var(--ff-display);
        font-size: 1.55rem;
        font-weight: 700;
        letter-spacing: -0.02em;
        color: var(--white);
        margin-bottom: 0.5rem;
    }
    .screen-card p {
        font-size: 0.88rem;
        font-weight: 300;
        color: rgba(255,255,255,0.42);
        line-height: 1.65;
        margin-bottom: 1.5rem;
    }

    .mini-story {
        display: flex;
        align-items: center;
        gap: 0.7rem;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 8px;
        padding: 0.6rem 0.8rem;
        margin-bottom: 0.5rem;
    }
    .mini-story:last-child { margin-bottom: 0; }
    .mini-dot {
        width: 7px; height: 7px;
        border-radius: 50%;
        background: var(--accent);
        flex-shrink: 0;
    }
    .mini-dot.off { background: rgba(255,255,255,0.18); }
    .mini-story-text {
        flex: 1;
        font-size: 0.76rem;
        color: rgba(255,255,255,0.68);
    }
    .mini-story-time {
        font-size: 0.62rem;
        color: rgba(255,255,255,0.22);
        flex-shrink: 0;
    }

    .mini-cats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
    }
    .mini-cat {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 8px;
        padding: 0.65rem 0.9rem;
        font-size: 0.78rem;
        color: rgba(255,255,255,0.6);
    }
    .mini-cat.active {
        background: var(--accent-glow-10);
        border-color: var(--accent-bdr-28);
        color: var(--accent);
    }

    /* ── DOWNLOAD ── */
    .download-section {
        padding: 8rem 0;
        position: relative;
        overflow: hidden;
        text-align: center;
    }
    .download-section .hero-glow {
        left: 30%;
        top: 50%;
        transform: translate(-50%, -50%);
        right: auto;
    }
    .store-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 8px;
        padding: 0.85rem 1.5rem;
        text-decoration: none;
        transition: background 0.2s, border-color 0.2s, transform 0.2s;
        min-width: 160px;
    }
    .store-btn:hover {
        background: rgba(255,255,255,0.09);
        border-color: rgba(255,255,255,0.22);
        transform: translateY(-2px);
    }
    .store-icon { font-size: 1.45rem; }
    .store-small {
        display: block;
        font-size: 0.6rem;
        color: rgba(255,255,255,0.38);
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }
    .store-name {
        display: block;
        font-size: 0.95rem;
        font-weight: 500;
        color: var(--white);
    }
    .landing-legal {
        margin-top: 2rem;
        font-size: 0.78rem;
        font-weight: 400;
        color: rgba(255,255,255,0.38);
        line-height: 1.6;
    }
    .landing-legal a {
        color: rgba(255,255,255,0.55);
        text-decoration: underline;
        text-underline-offset: 2px;
        transition: color 0.2s;
    }
    .landing-legal a:hover {
        color: var(--white);
    }
</style>
@endpush

@section('content')
<main>

    {{-- ── HERO ── --}}
    <section class="hero-section" id="home">
        <div class="hero-glow"></div>
        <div class="hero-bg-word" aria-hidden="true">NEWS</div>

        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center g-5">

                {{-- Left --}}
                <div class="col-lg-6" data-aos="fade-up" data-aos-duration="900">
                    <div class="hero-tag">
                        <span class="hero-tag-dot"></span>
                        Live local coverage
                    </div>
                    <h1 class="hero-title">
                        Your city,<br>
                        <em class="gradient-primary">as it happens.</em>
                    </h1>
                    <p class="hero-lead">
                        Hyper-local news compressed to 60 seconds. Real voices, real stories — from the streets you know.
                    </p>
                    <div class="d-flex flex-wrap gap-3 align-items-center">
                        <a href="#download" class="btn-premium">Download Free</a>
                        <a href="#features" class="btn-outline-premium">Explore features</a>
                    </div>
                </div>

                {{-- Right — Phone --}}
                <div class="col-lg-6 d-flex justify-content-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                    <div class="phone-mockup hero-phone">
                        <div class="mockup-notch"></div>
                        <div class="mockup-screen">
                            <div class="phone-header">
                                <span class="phone-brand">MyCityOnly</span>
                                <span class="live-pill">Live</span>
                            </div>
                            <div class="news-item news-item-featured">
                                <div class="news-item-tag">Breaking</div>
                                <div class="news-item-title">Traffic diversion near Ring Road — alternate routes advised</div>
                                <div class="news-item-meta">2 min read · just now</div>
                            </div>
                            <div class="news-item">
                                <div class="news-item-tag">Politics</div>
                                <div class="news-item-title">New municipal policy on waste collection announced</div>
                                <div class="news-item-meta">1 min read · 8 min ago</div>
                            </div>
                            <div class="news-item">
                                <div class="news-item-tag">Sports</div>
                                <div class="news-item-title">Local team advances to state-level finals</div>
                                <div class="news-item-meta">1 min read · 25 min ago</div>
                            </div>
                            <div class="phone-bottom-nav">
                                <div class="pbn-dot active"></div>
                                <div class="pbn-dot"></div>
                                <div class="pbn-dot"></div>
                                <div class="pbn-dot"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── TICKER ── --}}
    <div class="ticker-bar" aria-hidden="true">
        <div class="ticker-track">
            @foreach(['Short format news', 'Hindi & English', '70 words max', 'Push alerts', 'Always 24×7', 'Clean UI',
                      'Short format news', 'Hindi & English', '70 words max', 'Push alerts', 'Always 24×7', 'Clean UI'] as $item)
                <span class="ticker-item">{{ $item }} <span class="ticker-sep">—</span></span>
            @endforeach
        </div>
    </div>

    {{-- ── FEATURES ── --}}
    <section id="features" class="section-premium">
        <div class="container">
            <div data-reveal>
                <span class="section-kicker">Why people love it</span>
                <h2 class="section-heading">
                    Built for<br><em>quick minds.</em>
                </h2>
                <p class="section-sub" style="max-width:460px;">
                    One tap. The story. Done. No opinion pieces, no filler — just what your city actually needs to know.
                </p>
            </div>

            <div class="features-grid">
                @php
                $features = [
                    ['01', '📝', 'Short format',  'Every story under 70 words. You\'re informed in 60 seconds — not 6 minutes.'],
                    ['02', '✦',  'Clean reading', 'Zero ads cluttering the story. A focused layout that respects your attention.'],
                    ['03', '🗂',  'Categories',   'Pick what you care about — politics, sports, tech, or entertainment.'],
                    ['04', '🔔', 'Push alerts',   'Breaking news, delivered the moment it matters. Only relevant to your city.'],
                ];
                @endphp
                @foreach($features as $i => [$num, $icon, $title, $desc])
                <div class="feature-card" data-reveal="d{{ $i + 1 }}">
                    <div class="feat-num">{{ $num }}</div>
                    <span class="feature-icon">{{ $icon }}</span>
                    <h5>{{ $title }}</h5>
                    <p>{{ $desc }}</p>
                    <div class="feat-glow"></div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── STATS ── --}}
    <section id="stats" class="stats-section">
        <div class="container">
            <div class="row g-0" style="border:1px solid rgba(255,255,255,0.07); border-radius:10px; overflow:hidden;">
                <div class="col-md-4" data-reveal>
                    <div class="stat-card">
                        <div class="stat-number">60<span>s</span></div>
                        <p class="stat-label">Average read time<br>per story</p>
                    </div>
                </div>
                <div class="col-md-4" data-reveal="d1">
                    <div class="stat-card">
                        <div class="stat-number">60</div>
                        <p class="stat-label">Words per story,<br>maximum</p>
                    </div>
                </div>
                <div class="col-md-4" data-reveal="d2">
                    <div class="stat-card" style="border-right:none;">
                        <div class="stat-number">24<span>×7</span></div>
                        <p class="stat-label">Around-the-clock<br>live updates</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── SCREENS ── --}}
    <section id="screens" class="section-premium bg-soft-mint screens-section">
        <div class="container">
            <div data-reveal>
                <span class="section-kicker">App screens</span>
                <h2 class="section-heading" style="color:var(--ink);">
                    Simple flow.<br><em>Better reading.</em>
                </h2>
                <p class="section-sub dark" style="max-width:440px;">
                    Designed for how readers actually consume news — fast, focused, frictionless.
                </p>
            </div>

            <div class="row g-4 mt-2 align-items-stretch">

                {{-- Screen 1: Top stories --}}
                <div class="col-lg-6" data-reveal="d1">
                    <div class="screen-card h-100">
                        <div class="screen-card-num">Screen 01</div>
                        <h4>Top stories</h4>
                        <p>Swipe through trending city headlines. Ranked by what's happening right now.</p>
                        <div>
                            <div class="mini-story">
                                <div class="mini-dot"></div>
                                <div class="mini-story-text">Ring Road traffic update — diversion in place</div>
                                <div class="mini-story-time">now</div>
                            </div>
                            <div class="mini-story">
                                <div class="mini-dot off"></div>
                                <div class="mini-story-text">New market opens in Vaishali Nagar</div>
                                <div class="mini-story-time">12m</div>
                            </div>
                            <div class="mini-story">
                                <div class="mini-dot off"></div>
                                <div class="mini-story-text">Rains expected tonight — IMD alert issued</div>
                                <div class="mini-story-time">31m</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Screen 2: Categories --}}
                <div class="col-lg-6" data-reveal="d2">
                    <div class="screen-card h-100">
                        <div class="screen-card-num">Screen 02</div>
                        <h4>Categories</h4>
                        <p>Pick your interests and keep your feed dialled into what actually matters to you.</p>
                        <div class="mini-cats">
                            <div class="mini-cat active">🏛 Politics</div>
                            <div class="mini-cat">⚽ Sports</div>
                            <div class="mini-cat active">💻 Tech</div>
                            <div class="mini-cat">🎬 Entertainment</div>
                            <div class="mini-cat">💼 Business</div>
                            <div class="mini-cat">🌦 Weather</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── DOWNLOAD ── --}}
    <section id="download" class="download-section">
        <div class="hero-glow"></div>
        <div class="container position-relative" style="z-index:2;">
            <span class="section-kicker d-block" data-reveal>Available now</span>
            <h2 class="section-heading d-block" data-reveal="d1" style="margin-bottom:1rem;">
                Your city is<br><em>waiting.</em>
            </h2>
            <p class="section-sub mx-auto" data-reveal="d2" style="max-width:400px; margin-bottom:2.5rem;">
                Free to download. No account needed. Start reading in under 30 seconds.
            </p>
            <div class="d-flex flex-wrap gap-3 justify-content-center" data-reveal="d3">
                <a href="#" class="store-btn">
                    <span class="store-icon">🍎</span>
                    <span>
                        <span class="store-small">Download on the</span>
                        <span class="store-name">App Store</span>
                    </span>
                </a>
                <a href="#" class="store-btn">
                    <span class="store-icon">▶</span>
                    <span>
                        <span class="store-small">Get it on</span>
                        <span class="store-name">Google Play</span>
                    </span>
                </a>
            </div>
            <p class="landing-legal mb-0" data-reveal="d4">
                <a href="{{ route('public.terms') }}">Terms &amp; conditions</a>
                <span class="mx-1" style="opacity:0.5;">·</span>
                <a href="{{ route('public.privacy') }}">Privacy policy</a>
            </p>
        </div>
    </section>

</main>
@endsection