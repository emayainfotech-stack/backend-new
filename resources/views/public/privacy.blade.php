@extends('layouts.landing')

@section('title', 'Privacy Policy — My City Only')
@section('meta_description', 'Privacy Policy for My City Only.')

@section('content')
    <main>
        <section class="hero-section">
            <div class="hero-glow"></div>
            <div class="container position-relative" style="z-index: 2; margin-top: 100px;">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8" data-aos="fade-up" data-aos-duration="800">
                        <span class="section-kicker d-block">Legal</span>
                        <h1 class="hero-title mb-2">Privacy Policy</h1>
                        <p class="hero-lead mb-3" style="max-width: 48rem;">
                            This policy explains how My City Only collects, uses, and protects information when you use our app and services.
                        </p>
                        <div class="text-muted small">Last updated: <strong>{{ now()->format('d M Y') }}</strong></div>
                    </div>
                    <div class="col-lg-4 text-lg-end" data-aos="fade-up" data-aos-delay="100">
                        <a href="{{ route('public.terms') }}" class="btn btn-premium">Terms</a>
                        <a href="{{ url('/') }}" class="btn btn-outline-premium ms-2">Home</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-premium">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="feature-card h-100">
                            <div class="feature-icon">1</div>
                            <h4 class="fw-bold mb-2">Information We Collect</h4>
                            <p class="text-muted mb-0">Basic device/usage info. If notifications are enabled, we store your Expo push token.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-card h-100">
                            <div class="feature-icon">2</div>
                            <h4 class="fw-bold mb-2">How We Use It</h4>
                            <p class="text-muted mb-0">Operate the service, improve performance, and deliver relevant notifications.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-card h-100">
                            <div class="feature-icon">3</div>
                            <h4 class="fw-bold mb-2">Notifications</h4>
                            <p class="text-muted mb-0">Tokens are used only to send news alerts and updates.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-card h-100">
                            <div class="feature-icon">4</div>
                            <h4 class="fw-bold mb-2">Sharing</h4>
                            <p class="text-muted mb-0">We do not sell personal info. Limited sharing may occur to operate the app.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-card h-100">
                            <div class="feature-icon">5</div>
                            <h4 class="fw-bold mb-2">Security</h4>
                            <p class="text-muted mb-0">We take reasonable steps to protect data, but no system is 100% secure.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-card h-100">
                            <div class="feature-icon">6</div>
                            <h4 class="fw-bold mb-2">Contact</h4>
                            <p class="text-muted mb-0">For privacy questions, contact your official support email/phone.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
