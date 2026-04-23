@extends('layouts.landing')

@section('title', 'Privacy Policy — My City Only')
@section('meta_description', 'Read the Privacy Policy for My City Only, including what data we collect and how we use it.')

@section('content')
    <main>
        <!-- Hero -->
        <section class="legal-hero">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <div class="kicker mb-2">Legal</div>
                        <h1 class="display-6 fw-bold mb-2">Privacy Policy</h1>
                        <p class="text-muted mb-0 legal-lead">
                            This policy explains how My City Only collects, uses, and protects information when you use our app and services.
                        </p>
                        <div class="text-muted small mt-2">
                            Last updated: <span class="fw-semibold">{{ now()->format('d M Y') }}</span>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('public.terms') }}"
                           class="btn btn-danger rounded-3 px-4"
                           style="background:var(--landing-accent);border-color:var(--landing-accent);">
                            Terms
                        </a>
                        <a href="{{ url('/') }}" class="btn btn-outline-dark rounded-3 px-4">Home</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <div class="row g-4">
                    <!-- TOC -->
                    <div class="col-lg-4 d-none d-lg-block">
                        <div class="legal-toc position-sticky" style="top: 96px;">
                            <div class="legal-card p-4">
                                <div class="fw-semibold mb-2">On this page</div>
                                <div class="d-grid gap-2 legal-links">
                                    <a href="#collect">1. Information We Collect</a>
                                    <a href="#use">2. How We Use Information</a>
                                    <a href="#notifications">3. Notifications</a>
                                    <a href="#sharing">4. Sharing</a>
                                    <a href="#security">5. Data Security</a>
                                    <a href="#contact">6. Contact</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="col-lg-8">
                        <div class="legal-card p-4 p-md-5">
                            <div class="legal-section" id="collect">
                                <h4 class="fw-semibold mb-2">1. Information We Collect</h4>
                                <p class="text-muted mb-0">
                                    We may collect basic device and usage information (such as app interactions). If you opt-in to notifications, we store your device token to send alerts.
                                </p>
                            </div>

                            <hr class="legal-divider my-4">

                            <div class="legal-section" id="use">
                                <h4 class="fw-semibold mb-2">2. How We Use Information</h4>
                                <p class="text-muted mb-0">
                                    We use data to operate the service, improve performance, deliver notifications, and enhance user experience.
                                </p>
                            </div>

                            <hr class="legal-divider my-4">

                            <div class="legal-section" id="notifications">
                                <h4 class="fw-semibold mb-2">3. Notifications</h4>
                                <p class="text-muted mb-0">
                                    If you enable push notifications, your device token is stored securely and used only to send news alerts.
                                </p>
                            </div>

                            <hr class="legal-divider my-4">

                            <div class="legal-section" id="sharing">
                                <h4 class="fw-semibold mb-2">4. Sharing</h4>
                                <p class="text-muted mb-0">
                                    We do not sell personal information. We may share limited data with service providers strictly to operate the app (e.g., notification delivery).
                                </p>
                            </div>

                            <hr class="legal-divider my-4">

                            <div class="legal-section" id="security">
                                <h4 class="fw-semibold mb-2">5. Data Security</h4>
                                <p class="text-muted mb-0">
                                    We take reasonable steps to protect data. However, no system can be guaranteed 100% secure.
                                </p>
                            </div>

                            <hr class="legal-divider my-4">

                            <div class="legal-section" id="contact">
                                <h4 class="fw-semibold mb-2">6. Contact</h4>
                                <p class="text-muted mb-0">
                                    For privacy questions, contact us at your official support email/phone.
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 legal-bottom-actions d-flex flex-wrap gap-2">
                            <a href="{{ url('/') }}" class="btn btn-outline-dark rounded-3 px-4">Back to Home</a>
                            <a href="{{ route('public.terms') }}"
                               class="btn btn-danger rounded-3 px-4"
                               style="background:var(--landing-accent);border-color:var(--landing-accent);">
                                Read Terms
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('styles')
<style>
    .legal-hero {
        padding: 4.25rem 0 2.25rem;
        background:
            radial-gradient(900px 420px at 20% 0%, rgba(239,68,68,.14), transparent 60%),
            radial-gradient(900px 420px at 100% 10%, rgba(37,99,235,.12), transparent 55%),
            linear-gradient(180deg, rgba(15,23,42,.04), transparent 70%);
        border-bottom: 1px solid rgba(15,23,42,.08);
    }
    .legal-lead { max-width: 52rem; }
    .legal-card {
        background: rgba(255,255,255,.92);
        border: 1px solid rgba(15,23,42,.10);
        border-radius: 18px;
        box-shadow: 0 22px 55px rgba(15, 23, 42, .06);
    }
    .legal-divider { border-top-color: rgba(15,23,42,.08); }
    .legal-links a {
        padding: 10px 12px;
        border-radius: 12px;
        border: 1px solid rgba(15,23,42,.08);
        background: rgba(248,250,252,.75);
        text-decoration: none;
        color: var(--landing-text);
        font-weight: 600;
        font-size: .95rem;
        transition: transform .12s ease, box-shadow .12s ease, background .12s ease;
    }
    .legal-links a:hover {
        background: #fff;
        transform: translateY(-1px);
        box-shadow: 0 10px 26px rgba(15, 23, 42, .08);
    }
    .legal-section p { line-height: 1.75; }
</style>
@endpush

