@extends('layouts.landing')

@section('title', 'Terms & Conditions — My City Only')
@section('meta_description', 'Terms & Conditions for My City Only.')

@section('content')
    <main>
        <section class="hero-section">
            <div class="hero-glow"></div>
            <div class="container position-relative" style="z-index: 2; margin-top: 100px;">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8" data-aos="fade-up" data-aos-duration="800">
                        <span class="section-kicker d-block">Legal</span>
                        <h1 class="hero-title mb-2">Terms &amp; Conditions</h1>
                        <p class="hero-lead mb-3" style="max-width: 48rem;">
                            These Terms govern your use of My City Only. By accessing or using the service, you agree to these Terms.
                        </p>
                        <div class="text-muted small">Last updated: <strong>{{ now()->format('d M Y') }}</strong></div>
                    </div>
                    <div class="col-lg-4 text-lg-end" data-aos="fade-up" data-aos-delay="100">
                        <a href="{{ route('public.privacy') }}" class="btn btn-premium">Privacy</a>
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
                            <h4 class="fw-bold mb-2">Use of Service</h4>
                            <p class="text-muted mb-0">Use the service lawfully and do not attempt unauthorized access or disruption.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-card h-100">
                            <div class="feature-icon">2</div>
                            <h4 class="fw-bold mb-2">Content</h4>
                            <p class="text-muted mb-0">Content is informational. We may update, modify, or remove content at any time.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-card h-100">
                            <div class="feature-icon">3</div>
                            <h4 class="fw-bold mb-2">Accounts</h4>
                            <p class="text-muted mb-0">You are responsible for your account credentials and activity under your account.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-card h-100">
                            <div class="feature-icon">4</div>
                            <h4 class="fw-bold mb-2">Intellectual Property</h4>
                            <p class="text-muted mb-0">Branding and designs are owned by My City Only (or licensors).</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-card h-100">
                            <div class="feature-icon">5</div>
                            <h4 class="fw-bold mb-2">Limitation of Liability</h4>
                            <p class="text-muted mb-0">We are not liable for indirect or consequential damages to the extent permitted by law.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-card h-100">
                            <div class="feature-icon">6</div>
                            <h4 class="fw-bold mb-2">Changes</h4>
                            <p class="text-muted mb-0">We may revise these Terms. Continued use means acceptance of updated Terms.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
