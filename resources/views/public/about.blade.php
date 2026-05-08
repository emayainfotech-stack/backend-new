@extends('layouts.landing')

@section('title', 'About & Contact — My City Only')
@section('meta_description', 'Learn about My City Only and contact our team.')

@push('styles')
<style>
    .about-wrap{
        padding: 9rem 0 5.5rem;
        position: relative;
        overflow: hidden;
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }
    .about-glow{
        position:absolute;
        width: 520px; height: 520px;
        background: radial-gradient(circle, var(--accent-glow-09) 0%, transparent 70%);
        left: -130px; top: -110px;
        border-radius: 50%;
        pointer-events:none;
        filter: blur(0.2px);
    }
    .about-tag{
        display:inline-flex;
        align-items:center;
        gap:.5rem;
        font-size:.7rem;
        font-weight:500;
        letter-spacing:.12em;
        text-transform:uppercase;
        color: var(--accent);
        background: rgba(37, 99, 235, 0.12);
        border: 1px solid rgba(37, 99, 235, 0.25);
        padding: .3rem .8rem;
        border-radius:2px;
        margin-bottom: 1.25rem;
    }
    .about-title{
        font-family: var(--ff-display);
        font-size: clamp(2.4rem, 5vw, 4.2rem);
        font-weight: 900;
        letter-spacing: -0.03em;
        line-height: 1.06;
        margin-bottom: 1.05rem;
        color: var(--white);
    }
    .about-title em{ font-style: italic; color: var(--accent); }
    .about-lead{
        font-size: 1rem;
        font-weight: 300;
        color: rgba(255,255,255,0.55);
        line-height: 1.8;
        max-width: 720px;
        margin-bottom: 0;
    }

    .about-section{ padding: 4.75rem 0 6.5rem; }
    .about-card{
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.10);
        border-radius: 14px;
        padding: 2.1rem;
        height: 100%;
    }
    .about-card h3{
        font-family: var(--ff-display);
        font-size: 1.45rem;
        font-weight: 900;
        letter-spacing: -0.01em;
        color: var(--white);
        margin-bottom: .85rem;
    }
    .about-card p{
        color: rgba(255,255,255,0.52);
        line-height: 1.8;
        margin-bottom: 0;
    }
    .contact-row{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 1.25rem;
        padding-top: 1.25rem;
        border-top: 1px solid rgba(255,255,255,0.10);
    }
    .contact-email{
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        font-size: .95rem;
        color: rgba(255,255,255,0.72);
        text-decoration: none;
    }
    .contact-email:hover{
        color: rgba(255,255,255,0.92);
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    @media (max-width: 768px){
        .about-card{ padding: 1.6rem; }
    }
</style>
@endpush

@section('content')
<main>
    <section class="about-wrap">
        <div class="about-glow"></div>
        <div class="container position-relative" style="z-index:2;">
            <span class="about-tag">About My City Only</span>
            <h1 class="about-title">Your city, your <em>news</em>.</h1>
            <p class="about-lead">
                My City Only is built for hyper-local updates — fast, clear, and focused on what matters in your city.
                We’re working to make local news easier to read, easier to share, and easier to trust.
            </p>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="about-card" data-reveal="d1">
                        <h3>What we do</h3>
                        <p>
                            We publish short, high-signal stories with categories so readers can find what they care about
                            quickly — without the noise.
                        </p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about-card" data-reveal="d2">
                        <h3>Contact</h3>
                        <p>For business, partnerships, corrections, or support, contact us at:</p>
                        <div class="contact-row">
                            <a class="contact-email" href="mailto:mycityonlybusiness@gmail.com">mycityonlybusiness@gmail.com</a>
                            <a class="btn-premium" href="mailto:mycityonlybusiness@gmail.com?subject=My%20City%20Only%20-%20Contact">Email us</a>
                        </div>
                        <small class="d-block mt-3" style="color: rgba(255,255,255,0.38); line-height: 1.6;">
                            Tip: Please include your city name and a short summary so we can respond faster.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

