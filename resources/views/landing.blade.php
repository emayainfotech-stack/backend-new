@extends('layouts.landing')

@section('title', 'My City Only — Short News, Big Impact')

@section('content')
    <main>
        <!-- HERO -->
        <section class="hero">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <div class="kicker mb-2">Get News in 60 seconds</div>
                        <h1 class="display-5 fw-bold mb-3">Short, crisp news for busy readers.</h1>
                        <p class="hero-lead fs-5 mb-4">
                            Read top stories in a clean, distraction‑free format. Built for fast scrolling, quick understanding, and daily updates.
                        </p>

                        <div class="d-flex flex-wrap gap-3 align-items-center">
                            <a class="store-btn" href="#" aria-label="Get it on Google Play">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-3"
                                      style="width:38px;height:38px;background:rgba(15,23,42,.06);">
                                    <!-- play icon -->
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M4 4.8v14.4c0 .9 1 1.5 1.8 1l14-7.2c.9-.5.9-1.7 0-2.2l-14-7.2c-.8-.5-1.8.1-1.8 1z" fill="#0f172a" opacity=".9"/>
                                    </svg>
                                </span>
                                <span>
                                    <small>Get it on</small>
                                    <strong>Google Play</strong>
                                </span>
                            </a>

                            <a class="store-btn" href="#" aria-label="Download on the App Store">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-3"
                                      style="width:38px;height:38px;background:rgba(15,23,42,.06);">
                                    <!-- apple icon -->
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M16.7 13.2c0-2 1.7-3 1.8-3.1-1-1.4-2.6-1.6-3.2-1.6-1.4-.1-2.7.8-3.4.8-.7 0-1.8-.8-3-.8-1.5 0-2.9.9-3.7 2.2-1.6 2.7-.4 6.7 1.1 8.9.7 1.1 1.6 2.3 2.8 2.3 1.1 0 1.6-.7 2.9-.7 1.3 0 1.7.7 2.9.7 1.2 0 2-.9 2.7-2 .8-1.2 1.2-2.4 1.2-2.5-.1 0-2.1-.8-2.1-3.2z" fill="#0f172a" opacity=".9"/>
                                        <path d="M14.7 6.9c.6-.8 1-1.9.9-3-1 .1-2.2.7-2.9 1.5-.6.7-1.1 1.8-1 2.9 1.1.1 2.3-.6 3-1.4z" fill="#0f172a" opacity=".9"/>
                                    </svg>
                                </span>
                                <span>
                                    <small>Download on</small>
                                    <strong>App Store</strong>
                                </span>
                            </a>

                            <a href="#features" class="btn btn-danger rounded-3 px-4" style="background:var(--landing-accent);border-color:var(--landing-accent);">
                                Explore Features
                            </a>
                        </div>

                        <div class="mt-4 d-flex gap-4 text-muted small">
                            <div><strong class="text-dark">No ads</strong> (optional)</div>
                            <div><strong class="text-dark">Fast</strong> loading</div>
                            <div><strong class="text-dark">Daily</strong> updates</div>
                        </div>
                    </div>

                    <div class="col-lg-6 d-flex justify-content-lg-end justify-content-center">
                        <div class="phone-shell">
                            <div class="phone-notch"></div>
                            <div class="phone-screen">
                                <div class="screen-top">
                                    <div class="fw-bold">Top</div>
                                    <div class="pill">Trending</div>
                                </div>
                                <div class="screen-card">
                                    <div class="thumb"></div>
                                    <div class="line w-90"></div>
                                    <div class="line w-80"></div>
                                    <div class="line w-60"></div>
                                    <div class="mt-2 d-flex gap-2">
                                        <span class="pill" style="background:rgba(37,99,235,.10);border-color:rgba(37,99,235,.20);color:#1d4ed8;">India</span>
                                        <span class="pill" style="background:rgba(16,185,129,.10);border-color:rgba(16,185,129,.20);color:#047857;">World</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FEATURES -->
        <section id="features" class="section section-muted">
            <div class="container">
                <div class="row align-items-start g-4">
                    <div class="col-lg-5">
                        <div class="kicker mb-2">Why people love it</div>
                        <h2 class="fw-bold mb-3">Designed for quick reading.</h2>
                        <p class="text-muted mb-0">
                            A simple experience that helps readers understand the story in seconds — ideal for Hindi and English audiences.
                        </p>
                    </div>
                    <div class="col-lg-7">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="feature h-100">
                                    <div class="fw-semibold mb-1">Short format</div>
                                    <div class="text-muted">Compact summaries that keep you updated without noise.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature h-100">
                                    <div class="fw-semibold mb-1">Clean UI</div>
                                    <div class="text-muted">No clutter. Focus on the headline and the facts.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature h-100">
                                    <div class="fw-semibold mb-1">Categories</div>
                                    <div class="text-muted">Politics, sports, tech, entertainment — all in one place.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature h-100">
                                    <div class="fw-semibold mb-1">Push alerts</div>
                                    <div class="text-muted">Notify users for important breaking news.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SCREENS -->
        <section id="screens" class="section">
            <div class="container">
                <div class="text-center mb-5">
                    <div class="kicker mb-2">Screens</div>
                    <h2 class="fw-bold mb-2">Simple flow. Better reading.</h2>
                    <p class="text-muted mb-0">A few key screens that keep readers engaged.</p>
                </div>

                <div class="row align-items-center g-5 mb-5">
                    <div class="col-lg-6 text-lg-end">
                        <div class="kicker mb-2">Top stories</div>
                        <h3 class="fw-bold mb-2">Swipe through trending headlines</h3>
                        <p class="text-muted mb-0">Quickly scan and open stories that matter the most.</p>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-center justify-content-lg-start">
                        <div class="phone-shell" style="max-width:320px;">
                            <div class="phone-notch"></div>
                            <div class="phone-screen">
                                <div class="screen-top">
                                    <div class="fw-bold">For You</div>
                                    <div class="pill">Hindi</div>
                                </div>
                                <div class="screen-card">
                                    <div class="thumb" style="height:130px;"></div>
                                    <div class="line w-90"></div>
                                    <div class="line w-80"></div>
                                    <div class="line w-60"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center g-5">
                    <div class="col-lg-6 d-flex justify-content-center justify-content-lg-end">
                        <div class="phone-shell" style="max-width:320px;">
                            <div class="phone-notch"></div>
                            <div class="phone-screen">
                                <div class="screen-top">
                                    <div class="fw-bold">Categories</div>
                                    <div class="pill">Explore</div>
                                </div>
                                <div class="screen-card">
                                    <div class="d-grid gap-2">
                                        <div class="feature">Business</div>
                                        <div class="feature">Sports</div>
                                        <div class="feature">Technology</div>
                                        <div class="feature">Entertainment</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="kicker mb-2">Categories</div>
                        <h3 class="fw-bold mb-2">Personalized reading</h3>
                        <p class="text-muted mb-0">Pick what you like and keep your feed relevant every day.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- STATS -->
        <section id="stats" class="section section-muted">
            <div class="container">
                <div class="row align-items-end g-4 mb-4">
                    <div class="col-lg-6">
                        <div class="kicker mb-2">Trusted by readers</div>
                        <h2 class="fw-bold mb-0">Built for speed and clarity.</h2>
                    </div>
                    <div class="col-lg-6 text-lg-end text-muted">
                        Make your newsroom workflow smoother with simple publishing tools.
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="stat">
                            <div class="fs-3 fw-bold">60s</div>
                            <div class="text-muted">Average time to read a story</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat">
                            <div class="fs-3 fw-bold">70</div>
                            <div class="text-muted">Words per summary (max)</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat">
                            <div class="fs-3 fw-bold">24×7</div>
                            <div class="text-muted">Updates & breaking news</div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <a class="btn btn-dark rounded-3 px-4" href="{{ route('login') }}">Go to Admin Login</a>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="footer">
            <div class="container">
                <div class="row g-4 align-items-start">
                    <div class="col-md-5">
                        <div class="d-flex align-items-center gap-2 fw-bold text-dark mb-2">
                            <span class="brand-mark" style="width:30px;height:30px;border-radius:10px;">N</span>
                            <span>My City Only</span>
                        </div>
                        <div class="text-muted">Short news, better reading. © <span id="landingYear"></span></div>
                    </div>
                    <div class="col-md-7">
                        <div class="row g-3">
                            <div class="col-6 col-lg-4">
                                <div class="fw-semibold text-dark mb-2">Product</div>
                                <div class="d-grid gap-1">
                                    <a href="#features">Features</a>
                                    <a href="#screens">Screens</a>
                                    <a href="#stats">Stats</a>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4">
                                <div class="fw-semibold text-dark mb-2">Company</div>
                                <div class="d-grid gap-1">
                                    <a href="#">About</a>
                                    <a href="#">Contact</a>
                                    <a href="#">Privacy</a>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="fw-semibold text-dark mb-2">Admin</div>
                                <div class="d-grid gap-1">
                                    <a href="{{ route('login') }}">Login</a>
                                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>
@endsection

@push('scripts')
    <script>
        document.getElementById('landingYear').textContent = new Date().getFullYear();
    </script>
@endpush

