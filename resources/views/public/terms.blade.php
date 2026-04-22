@extends('layouts.landing')

@section('title', 'Terms & Conditions — My City Only')
@section('meta_description', 'Read the Terms & Conditions for using the My City Only app and services.')

@section('content')
    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="mb-4">
                        <div class="kicker mb-2">Legal</div>
                        <h1 class="fw-bold mb-2">Terms &amp; Conditions</h1>
                        <p class="text-muted mb-0">
                            These Terms govern your use of My City Only. By accessing or using the service, you agree to these Terms.
                        </p>
                        <div class="text-muted small mt-2">Last updated: {{ now()->format('d M Y') }}</div>
                    </div>

                    <div class="border rounded-4 p-4 bg-white">
                        <h5 class="fw-semibold">1. Use of Service</h5>
                        <p class="text-muted">
                            You agree to use the service lawfully and not to misuse, disrupt, or attempt to gain unauthorized access to the platform.
                        </p>

                        <h5 class="fw-semibold mt-4">2. Content</h5>
                        <p class="text-muted">
                            News summaries and media are provided for informational purposes. We may update, modify, or remove content at any time.
                        </p>

                        <h5 class="fw-semibold mt-4">3. Accounts (Admin/Reporter)</h5>
                        <p class="text-muted">
                            If you have an account, you are responsible for maintaining confidentiality of your credentials and all activities under your account.
                        </p>

                        <h5 class="fw-semibold mt-4">4. Intellectual Property</h5>
                        <p class="text-muted">
                            The service, branding, and designs are owned by My City Only (or its licensors). You may not copy or redistribute without permission.
                        </p>

                        <h5 class="fw-semibold mt-4">5. Limitation of Liability</h5>
                        <p class="text-muted">
                            To the maximum extent permitted by law, we are not liable for indirect, incidental, or consequential damages arising from your use of the service.
                        </p>

                        <h5 class="fw-semibold mt-4">6. Changes</h5>
                        <p class="text-muted mb-0">
                            We may revise these Terms from time to time. Continued use after changes means you accept the updated Terms.
                        </p>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <a href="{{ url('/') }}" class="btn btn-outline-dark rounded-3">Back to Home</a>
                        <a href="{{ route('public.privacy') }}" class="btn btn-danger rounded-3"
                           style="background:var(--landing-accent);border-color:var(--landing-accent);">
                            Privacy Policy
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

