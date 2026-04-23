@extends('layouts.landing')

@section('title', 'Terms & Conditions — My City Only')
@section('meta_description', 'Read the Terms & Conditions for using the My City Only app and services.')

@section('content')
    <main>
        <!-- Hero -->
        <section class="legal-hero">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <div class="kicker mb-2">Legal</div>
                        <h1 class="display-6 fw-bold mb-2">Terms &amp; Conditions</h1>
                        <p class="text-muted mb-0 legal-lead">
                            These Terms govern your use of My City Only. By accessing or using the service, you agree to these Terms.
                        </p>
                        <div class="text-muted small mt-2">
                            Last updated: <span class="fw-semibold">{{ now()->format('d M Y') }}</span>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('public.privacy') }}"
                           class="btn btn-danger rounded-3 px-4"
                           style="background:var(--landing-accent);border-color:var(--landing-accent);">
                            Privacy Policy
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
                                    <a href="#use">1. Use of Service</a>
                                    <a href="#content">2. Content</a>
                                    <a href="#accounts">3. Accounts</a>
                                    <a href="#ip">4. Intellectual Property</a>
                                    <a href="#liability">5. Limitation of Liability</a>
                                    <a href="#changes">6. Changes</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="col-lg-8">
                        <div class="legal-card p-4 p-md-5">
                            <div class="legal-section" id="use">
                                <h4 class="fw-semibold mb-2">1. Use of Service</h4>
                                <p class="text-muted mb-0">
                                    You agree to use the service lawfully and not to misuse, disrupt, or attempt to gain unauthorized access to the platform.
                                </p>
                            </div>

                            <hr class="legal-divider my-4">

                            <div class="legal-section" id="content">
                                <h4 class="fw-semibold mb-2">2. Content</h4>
                                <p class="text-muted mb-0">
                                    News summaries and media are provided for informational purposes. We may update, modify, or remove content at any time.
                                </p>
                            </div>

                            <hr class="legal-divider my-4">

                            <div class="legal-section" id="accounts">
                                <h4 class="fw-semibold mb-2">3. Accounts (Admin/Reporter)</h4>
                                <p class="text-muted mb-0">
                                    If you have an account, you are responsible for maintaining confidentiality of your credentials and all activities under your account.
                                </p>
                            </div>

                            <hr class="legal-divider my-4">

                            <div class="legal-section" id="ip">
                                <h4 class="fw-semibold mb-2">4. Intellectual Property</h4>
                                <p class="text-muted mb-0">
                                    The service, branding, and designs are owned by My City Only (or its licensors). You may not copy or redistribute without permission.
                                </p>
                            </div>

                            <hr class="legal-divider my-4">

                            <div class="legal-section" id="liability">
                                <h4 class="fw-semibold mb-2">5. Limitation of Liability</h4>
                                <p class="text-muted mb-0">
                                    To the maximum extent permitted by law, we are not liable for indirect, incidental, or consequential damages arising from your use of the service.
                                </p>
                            </div>

                            <hr class="legal-divider my-4">

                            <div class="legal-section" id="changes">
                                <h4 class="fw-semibold mb-2">6. Changes</h4>
                                <p class="text-muted mb-0">
                                    We may revise these Terms from time to time. Continued use after changes means you accept the updated Terms.
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 legal-bottom-actions d-flex flex-wrap gap-2">
                            <a href="{{ url('/') }}" class="btn btn-outline-dark rounded-3 px-4">Back to Home</a>
                            <a href="{{ route('public.privacy') }}"
                               class="btn btn-danger rounded-3 px-4"
                               style="background:var(--landing-accent);border-color:var(--landing-accent);">
                                Read Privacy Policy
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

