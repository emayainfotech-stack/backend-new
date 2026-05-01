@extends('layouts.landing')

@section('title', 'Privacy Policy — My City Only')
@section('meta_description', 'Privacy Policy for My City Only.')

@push('styles')
<style>
    /* ── LEGAL HERO ── */
    .legal-hero {
        padding: 9rem 0 5rem;
        position: relative;
        overflow: hidden;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .legal-hero .hero-glow {
        position: absolute;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(232,87,42,0.07) 0%, transparent 70%);
        left: -100px; top: -80px;
        border-radius: 50%;
        pointer-events: none;
    }
    .legal-hero-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.7rem;
        font-weight: 500;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--accent);
        background: var(--accent-dim);
        border: 1px solid var(--accent-bdr);
        padding: 0.3rem 0.8rem;
        border-radius: 2px;
        margin-bottom: 1.5rem;
    }
    .legal-title {
        font-family: var(--ff-display);
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        font-weight: 900;
        letter-spacing: -0.03em;
        line-height: 1.04;
        color: var(--white);
        margin-bottom: 1.1rem;
    }
    .legal-title em {
        font-style: italic;
        color: var(--accent);
    }
    .legal-lead {
        font-size: 1rem;
        font-weight: 300;
        color: rgba(255,255,255,0.48);
        line-height: 1.75;
        max-width: 520px;
        margin-bottom: 1.25rem;
    }
    .legal-date {
        font-size: 0.78rem;
        color: rgba(255,255,255,0.28);
        letter-spacing: 0.02em;
    }
    .legal-date strong { color: rgba(255,255,255,0.5); font-weight: 500; }

    .legal-nav-btns {
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
        align-items: center;
        flex-wrap: wrap;
    }

    /* ── CARDS GRID ── */
    .legal-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1px;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 10px;
        overflow: hidden;
    }
    .legal-card {
        background: var(--ink-soft);
        padding: 2.25rem;
        position: relative;
        overflow: hidden;
        transition: background 0.25s;
    }
    .legal-card:hover { background: var(--ink-muted); }

    .legal-card-num {
        font-size: 0.64rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        color: rgba(255,255,255,0.18);
        margin-bottom: 1.25rem;
    }
    .legal-card h4 {
        font-family: var(--ff-display);
        font-size: 1.25rem;
        font-weight: 700;
        letter-spacing: -0.02em;
        color: var(--white);
        margin-bottom: 0.55rem;
    }
    .legal-card p {
        font-size: 0.88rem;
        font-weight: 300;
        color: rgba(255,255,255,0.42);
        line-height: 1.7;
        margin-bottom: 0;
    }
    .legal-card-glow {
        position: absolute;
        bottom: -10px; right: -10px;
        width: 70px; height: 70px;
        background: radial-gradient(circle, rgba(232,87,42,0.1) 0%, transparent 70%);
        pointer-events: none;
    }

    @media (max-width: 576px) {
        .legal-grid { grid-template-columns: 1fr; }
        .legal-nav-btns { justify-content: flex-start; }
    }
</style>
@endpush

@section('content')
<main>

    {{-- ── HERO ── --}}
    <section class="legal-hero">
        <div class="hero-glow"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center g-4">

                <div class="col-lg-8" data-aos="fade-up" data-aos-duration="800">
                    <div class="legal-hero-tag">Legal</div>
                    <h1 class="legal-title">
                        Privacy<br><em>Policy.</em>
                    </h1>
                    <p class="legal-lead">
                        This policy explains how My City Only collects, uses, and protects information when you use our app and services.
                    </p>
                    <div class="legal-date">
                        Last updated: <strong>{{ now()->format('d M Y') }}</strong>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="legal-nav-btns">
                        <a href="{{ route('public.terms') }}" class="btn-premium">Terms</a>
                        <a href="{{ url('/') }}" class="btn-outline-premium">Home</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── CARDS ── --}}
    <section class="section-premium">
        <div class="container">
            <div class="legal-grid">

                @php
                $items = [
                    ['01', 'Information We Collect',
                     'Basic device and usage info. If notifications are enabled, we store your Expo push token to deliver alerts.'],
                    ['02', 'How We Use It',
                     'Operate the service, improve performance, and deliver relevant notifications tailored to your city.'],
                    ['03', 'Notifications',
                     'Push tokens are used only to send news alerts and updates. We do not use them for any other purpose.'],
                    ['04', 'Sharing',
                     'We do not sell personal information. Limited sharing may occur strictly to operate the app.'],
                    ['05', 'Security',
                     'We take reasonable steps to protect your data, but no system is 100% secure.'],
                    ['06', 'Contact',
                     'For privacy questions, reach out via your official support email or phone number.'],
                ];
                @endphp

                @foreach($items as $i => [$num, $title, $desc])
                <div class="legal-card" data-reveal="d{{ ($i % 3) + 1 }}">
                    <div class="legal-card-num">{{ $num }}</div>
                    <h4>{{ $title }}</h4>
                    <p>{{ $desc }}</p>
                    <div class="legal-card-glow"></div>
                </div>
                @endforeach

            </div>
        </div>
    </section>

</main>
@endsection