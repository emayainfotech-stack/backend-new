@extends('layouts.landing')

@section('title', 'Privacy Policy — My City Only')
@section('meta_description', 'Read the Privacy Policy for My City Only, including what data we collect and how we use it.')

@section('content')
    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="mb-4">
                        <div class="kicker mb-2">Legal</div>
                        <h1 class="fw-bold mb-2">Privacy Policy</h1>
                        <p class="text-muted mb-0">
                            This policy explains how My City Only collects, uses, and protects information when you use our app and services.
                        </p>
                        <div class="text-muted small mt-2">Last updated: {{ now()->format('d M Y') }}</div>
                    </div>

                    <div class="border rounded-4 p-4 bg-white">
                        <h5 class="fw-semibold">1. Information We Collect</h5>
                        <p class="text-muted">
                            We may collect basic device and usage information (such as app interactions). If you opt-in to notifications, we store your device token to send alerts.
                        </p>

                        <h5 class="fw-semibold mt-4">2. How We Use Information</h5>
                        <p class="text-muted">
                            We use data to operate the service, improve performance, deliver notifications, and enhance user experience.
                        </p>

                        <h5 class="fw-semibold mt-4">3. Notifications</h5>
                        <p class="text-muted">
                            If you enable push notifications, your device token is stored securely and used only to send news alerts.
                        </p>

                        <h5 class="fw-semibold mt-4">4. Sharing</h5>
                        <p class="text-muted">
                            We do not sell personal information. We may share limited data with service providers strictly to operate the app (e.g., notification delivery).
                        </p>

                        <h5 class="fw-semibold mt-4">5. Data Security</h5>
                        <p class="text-muted">
                            We take reasonable steps to protect data. However, no system can be guaranteed 100% secure.
                        </p>

                        <h5 class="fw-semibold mt-4">6. Contact</h5>
                        <p class="text-muted mb-0">
                            For privacy questions, contact us at your official support email/phone.
                        </p>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <a href="{{ url('/') }}" class="btn btn-outline-dark rounded-3">Back to Home</a>
                        <a href="{{ route('public.terms') }}" class="btn btn-danger rounded-3"
                           style="background:var(--landing-accent);border-color:var(--landing-accent);">
                            Terms &amp; Conditions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

