@extends('layouts.landing')

@section('title', 'My City Only | Your City, Your News')
@section('meta_description', 'Your city, your news. Stay informed with hyper-local stories, real-time updates, and a beautifully smooth reading experience.')

@section('content')
    <main>
        <!-- Hero -->
        <section class="hero-section" id="home">
            <div class="hero-glow"></div>
            <div class="container position-relative" style="z-index: 2; margin-top: 100px;">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-duration="900">
                        <span class="section-kicker d-block">🌟 Your City. Your News.</span>
                        <h1 class="hero-title mb-3">
                            Local stories,<br>
                            <span class="gradient-primary">hyper-relevant.</span>
                        </h1>
                        <p class="hero-lead mb-4">
                            Personalized city news that cuts through the noise. Real-time updates, local voices, and a sleek reading experience — built for the way you live.
                        </p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="#download" class="btn btn-premium">Get the App</a>
                            <a href="#features" class="btn btn-outline-premium">Explore Features</a>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                        <div class="phone-mockup">
                            <div class="mockup-screen d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-white fw-semibold small">My City Only</span>
                                    <span class="city-badge" style="background: rgba(0,184,148,0.25); color:#00B894;">LIVE</span>
                                </div>
                                <div class="bg-white bg-opacity-10 rounded-3 p-2 mb-2">
                                    <div class="text-white small fw-semibold">Breaking city update</div>
                                    <div class="text-white-50 small">2 min read • just now</div>
                                </div>
                                <div class="bg-white bg-opacity-10 rounded-3 p-2 mt-1" style="background: rgba(37,99,235,0.2);">
                                    <div class="text-white small fw-semibold">Local headlines you care about</div>
                                </div>
                                <div class="mt-auto pt-4 text-center">
                                    <span class="text-white-50 small">✨ Your daily city briefing</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FEATURES -->
        <section id="features" class="section-premium">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <span class="section-kicker">Why people love it</span>
                    <h2 class="display-6 fw-bold" style="color: var(--deep-slate);">
                        Designed for <span class="gradient-primary">quick reading</span>
                    </h2>
                    <p class="text-muted mx-auto mt-3" style="max-width: 640px;">
                        A simple experience that helps readers understand the story in seconds — ideal for Hindi and English audiences.
                    </p>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="50">
                        <div class="feature-card">
                            <div class="feature-icon">📝</div>
                            <h5 class="fw-bold mb-2">Short format</h5>
                            <p class="text-muted mb-0">Compact summaries that keep you updated without noise.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="120">
                        <div class="feature-card">
                            <div class="feature-icon">✨</div>
                            <h5 class="fw-bold mb-2">Clean UI</h5>
                            <p class="text-muted mb-0">No clutter. Focus on the headline and the facts.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="190">
                        <div class="feature-card">
                            <div class="feature-icon">🗂️</div>
                            <h5 class="fw-bold mb-2">Categories</h5>
                            <p class="text-muted mb-0">Politics, sports, tech, entertainment — all in one place.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="260">
                        <div class="feature-card">
                            <div class="feature-icon">🚨</div>
                            <h5 class="fw-bold mb-2">Push alerts</h5>
                            <p class="text-muted mb-0">Notify users for important breaking news.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SCREENS -->
        <section id="screens" class="section-premium bg-soft-mint">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <span class="section-kicker">Screens</span>
                    <h2 class="display-6 fw-bold" style="color: var(--deep-slate);">Simple flow. Better reading.</h2>
                    <p class="text-muted mb-0">A few key screens that keep readers engaged.</p>
                </div>

                <div class="row g-4 align-items-stretch">
                    <div class="col-lg-6" data-aos="fade-right">
                        <div class="feature-card h-100">
                            <div class="feature-icon">📰</div>
                            <h4 class="fw-bold mb-2">Top stories</h4>
                            <p class="text-muted mb-4">Swipe through trending headlines and open stories that matter the most.</p>
                            <div class="phone-mockup" style="max-width: 320px;">
                                <div class="mockup-screen d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="text-white fw-semibold small">For You</span>
                                        <span class="city-badge" style="background: rgba(37,99,235,0.22); color:#93c5fd;">Trending</span>
                                    </div>
                                    <div class="bg-white bg-opacity-10 rounded-3 p-2 mb-2">
                                        <div class="text-white small fw-semibold">Big headline in 70 words</div>
                                        <div class="text-white-50 small">2 min read</div>
                                    </div>
                                    <div class="bg-white bg-opacity-10 rounded-3 p-2 mt-1">
                                        <div class="text-white small fw-semibold">Quick swipe feed</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="feature-card h-100">
                            <div class="feature-icon">🧭</div>
                            <h4 class="fw-bold mb-2">Categories</h4>
                            <p class="text-muted mb-4">Pick what you like and keep your feed relevant every day.</p>
                            <div class="phone-mockup" style="max-width: 320px;">
                                <div class="mockup-screen d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="text-white fw-semibold small">Categories</span>
                                        <span class="city-badge" style="background: rgba(0,184,148,0.22); color:#86efac;">Explore</span>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <div class="bg-white bg-opacity-10 rounded-3 p-2 text-white small fw-semibold">Business</div>
                                        <div class="bg-white bg-opacity-10 rounded-3 p-2 text-white small fw-semibold">Sports</div>
                                        <div class="bg-white bg-opacity-10 rounded-3 p-2 text-white small fw-semibold">Technology</div>
                                        <div class="bg-white bg-opacity-10 rounded-3 p-2 text-white small fw-semibold">Entertainment</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- STATS -->
        <section id="stats" class="section-premium">
            <div class="container">
                <div class="row align-items-end g-4 mb-5">
                    <div class="col-lg-7" data-aos="fade-up">
                        <span class="section-kicker">Trusted by readers</span>
                        <h2 class="display-6 fw-bold" style="color: var(--deep-slate);">Built for speed and clarity.</h2>
                    </div>
                    <div class="col-lg-5 text-lg-end text-muted" data-aos="fade-up" data-aos-delay="80">
                        Make your newsroom workflow smoother with simple publishing tools.
                    </div>
                </div>

                <div class="row g-4 text-center">
                    <div class="col-md-4" data-aos="zoom-in-up" data-aos-duration="600">
                        <div class="stat-card">
                            <div class="stat-number">60s</div>
                            <p class="fw-semibold mt-2 mb-0">Average read time</p>
                            <small class="text-muted">fast & crisp</small>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="zoom-in-up" data-aos-duration="600" data-aos-delay="100">
                        <div class="stat-card">
                            <div class="stat-number">70</div>
                            <p class="fw-semibold mt-2 mb-0">Words per story</p>
                            <small class="text-muted">maximum</small>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="zoom-in-up" data-aos-duration="600" data-aos-delay="200">
                        <div class="stat-card">
                            <div class="stat-number">24×7</div>
                            <p class="fw-semibold mt-2 mb-0">Updates</p>
                            <small class="text-muted">always on</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection

