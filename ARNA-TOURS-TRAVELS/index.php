<?php
declare(strict_types=1);

session_start();
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/models/Service.php';

$csrfToken = csrfToken();
$websiteServices = (new Service())->all(true);

sendSecurityHeaders();
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arna Tour & Travels | Premium Taxi & Travel Services</title>
  <meta name="description" content="Premium taxi, airport, outstation and travel booking assistance from Arna Tour & Travels across India.">
  <link rel="preload" as="image" href="assets/img/innova-1200.webp" fetchpriority="high">

  <!-- Google Fonts: Plus Jakarta Sans / Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"></noscript>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com" defer></script>

  <link rel="stylesheet" href="assets/css/booking.css">

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
          },
          colors: {
            tapsi: {
              purple: '#130424',
              violet: '#1d0838',
              surface: '#240a45',
              border: 'rgba(255, 255, 255, 0.08)',
              accent: '#8b4df5',
              electric: '#9d5eff',
              lightText: '#c4b9d3',
              cardDark: '#1a0631',
              cardLight: '#ffffff',
              bgLight: '#f5f5f7',
              slateText: '#5f5e6b',
              darkHeading: '#16092b'
            }
          }
        }
      }
    }
  </script>

  <style>
    /* Custom refined animations & typography */
    body {
      background-color: #130424;
      color: #ffffff;
      font-family: 'Plus Jakarta Sans', sans-serif;
      overflow-x: hidden;
      margin: 0;
      padding: 0;
    }

    /* Subtle background grid & noise pattern */
    .bg-storyboard-grid {
      background-image:
        radial-gradient(circle at 50% 30%, rgba(139, 77, 245, 0.18) 0%, rgba(19, 4, 36, 0.95) 75%),
        linear-gradient(to right, rgba(255, 255, 255, 0.02) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
      background-size: 100% 100%, 48px 48px, 48px 48px;
    }

    .bg-light-pattern {
      background-image:
        radial-gradient(circle at 85% 20%, rgba(139, 77, 245, 0.04) 0%, transparent 60%),
        linear-gradient(to right, rgba(20, 5, 40, 0.03) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(20, 5, 40, 0.03) 1px, transparent 1px);
      background-size: 100% 100%, 40px 40px, 40px 40px;
    }

    .glass-pill {
      background: rgba(255, 255, 255, 0.04);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .glass-card {
      background: rgba(26, 6, 49, 0.7);
      backdrop-filter: blur(16px);
      border: 1px solid rgba(255, 255, 255, 0.08);
    }

    /* Glowing underglow */
    .car-underglow {
      filter: drop-shadow(0 25px 35px rgba(139, 77, 245, 0.45));
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 6px;
    }

    ::-webkit-scrollbar-track {
      background: #130424;
    }

    ::-webkit-scrollbar-thumb {
      background: #341259;
      border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #8b4df5;
    }

    /* Perspective 3D phone */
    .phone-mockup-wrapper {
      transform: perspective(1000px) rotateY(-8deg) rotateX(4deg);
      transition: transform 0.5s ease;
    }

    .phone-mockup-wrapper:hover {
      transform: perspective(1000px) rotateY(-2deg) rotateX(1deg);
    }

    /* Floating ambient wave */
    @keyframes floatWave {

      0%,
      100% {
        transform: translateY(0px) scale(1);
      }

      50% {
        transform: translateY(-10px) scale(1.02);
      }
    }

    .animate-float-wave {
      animation: floatWave 8s ease-in-out infinite;
    }

    /* ==========================================
   SERVICE FEATURES VISIBILITY FIX
   ========================================== */

    #features {
      position: relative;
      z-index: 1;
    }

    #features .feature-card {
      position: relative;
      display: flex;
      visibility: visible;
    }

    .hero-carousel{width:100%;position:relative;display:flex;flex-direction:column;align-items:center}.hero-carousel-image{width:100%;max-width:620px;height:auto;aspect-ratio:3/2;object-fit:contain;display:block}.hero-carousel-controls{display:flex;align-items:center;justify-content:center;gap:10px;margin-top:8px;position:relative;z-index:12}.hero-carousel-button,.hero-carousel-dot{min-width:44px;min-height:44px;border-radius:999px;border:1px solid rgba(255,255,255,.16);background:rgba(19,4,36,.78);color:#fff;display:grid;place-items:center;cursor:pointer}.hero-carousel-button{font-size:18px}.hero-carousel-dot{width:44px;padding:0;position:relative}.hero-carousel-dot::after{content:'';width:8px;height:8px;border-radius:50%;background:#c4b9d3}.hero-carousel-dot.is-active{background:#8b4df5;border-color:#8b4df5}.hero-carousel-dot.is-active::after{background:#fff}.hero-carousel-button:focus-visible,.hero-carousel-dot:focus-visible{outline:3px solid #fff;outline-offset:3px}
  </style>
</head>

<body class="selection:bg-tapsi-accent selection:text-white">

  <!-- ==================== HEADER / NAVIGATION ==================== -->
  <nav id="mainNav"
    class="fixed top-0 left-0 w-full z-50 transition-all duration-300 py-5 px-6 lg:px-14 border-b border-transparent">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
      <!-- Logo -->
      <a href="#hero" class="flex items-center gap-2.5 group">
        <div
          class="w-8 h-8 rounded-lg bg-gradient-to-br from-tapsi-accent to-purple-800 flex items-center justify-center text-white shadow-lg shadow-purple-900/30">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
            <path
              d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.04 3H5.81l1.04-3zM19 17H5v-4.66l.12-.34h13.77l.11.34V17z" />
            <circle cx="7.5" cy="14.5" r="1.5" />
            <circle cx="16.5" cy="14.5" r="1.5" />
          </svg>
        </div>
        <span class="text-xl font-bold tracking-tight text-white nav-logo-text transition-colors">Arna Tour & Travels<span
            class="text-tapsi-accent">.</span></span>
      </a>

      <!-- Desktop Nav Links -->
      <div
        class="hidden md:flex items-center gap-8 glass-pill py-2 px-6 rounded-full border border-white/10 nav-links-box transition-colors">
        <a href="#hero"
          class="text-xs font-medium uppercase tracking-wider text-white/90 hover:text-tapsi-electric transition-colors">Home</a>
        <a href="#revolution"
          class="text-xs font-medium uppercase tracking-wider text-white/70 hover:text-white transition-colors">Solutions</a>
        <a href="#services"
          class="text-xs font-medium uppercase tracking-wider text-white/70 hover:text-white transition-colors">Services</a>
        <a href="vehicles.php"
          class="text-xs font-medium uppercase tracking-wider text-white/70 hover:text-white transition-colors">Our Fleet</a>
        <a href="#testimonials"
          class="text-xs font-medium uppercase tracking-wider text-white/70 hover:text-white transition-colors">Clients</a>
        <a href="#benefits"
          class="text-xs font-medium uppercase tracking-wider text-white/70 hover:text-white transition-colors">Benefits</a>
      </div>

      <!-- Header CTA -->
      <div class="flex items-center gap-4">
        <a href="#booking"
          class="hidden sm:inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wider px-5 py-2.5 rounded-full bg-white text-tapsi-purple hover:bg-tapsi-electric hover:text-white transition-all transform hover:-translate-y-0.5 shadow-md shadow-purple-950/40">
          Book a Ride
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
          </svg>
        </a>

        <!-- Mobile Menu Hamburger -->
        <button id="mobileMenuBtn" aria-label="Toggle Menu"
          class="md:hidden p-2 text-white/80 hover:text-white focus:outline-none">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile Navigation Overlay -->
    <div id="mobileMenu"
      class="hidden md:hidden px-6 pt-4 pb-6 mt-3 bg-tapsi-violet/95 backdrop-blur-xl border border-white/10 rounded-2xl flex-col gap-4">
      <a href="#hero" class="text-sm font-semibold text-white hover:text-tapsi-electric py-1">Home</a>
      <a href="#revolution" class="text-sm font-semibold text-white/80 hover:text-tapsi-electric py-1">Solutions</a>
      <a href="#features" class="text-sm font-semibold text-white/80 hover:text-tapsi-electric py-1">Features</a>
      <a href="#testimonials" class="text-sm font-semibold text-white/80 hover:text-tapsi-electric py-1">Clients</a>
      <a href="#benefits" class="text-sm font-semibold text-white/80 hover:text-tapsi-electric py-1">Benefits</a>
      <a href="#booking"
        class="text-center text-xs font-bold uppercase tracking-wider py-2.5 rounded-full bg-white text-tapsi-purple mt-2">Book
        a Ride</a>
    </div>
  </nav>

  <!-- ==================== SECTION 1: HERO SECTION ==================== -->
  <section id="hero"
    class="relative min-h-screen bg-tapsi-purple bg-storyboard-grid flex flex-col justify-between pt-32 pb-16 px-6 lg:px-14 overflow-hidden">
    <!-- Ambient glowing visual shapes -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-purple-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div
      class="absolute top-1/4 right-1/4 w-[36rem] h-[36rem] bg-tapsi-accent/15 rounded-full blur-[140px] pointer-events-none animate-float-wave">
    </div>

    <!-- Background Decorative SVG Lines & Waves from Storyboard -->
    <svg class="absolute inset-0 w-full h-full pointer-events-none opacity-25" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="purpleGlow" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" stop-color="#8b4df5" stop-opacity="0.6" />
          <stop offset="100%" stop-color="#1d0838" stop-opacity="0" />
        </linearGradient>
      </defs>
      <path d="M-100,200 C300,50 800,350 1600,100" fill="none" stroke="url(#purpleGlow)" stroke-width="1.5"
        stroke-dasharray="4 8" />
      <path d="M-100,380 C400,250 900,500 1700,280" fill="none" stroke="url(#purpleGlow)" stroke-width="1" />
      <circle cx="80%" cy="35%" r="180" fill="none" stroke="rgba(157, 94, 255, 0.12)" stroke-width="1" />
      <circle cx="80%" cy="35%" r="280" fill="none" stroke="rgba(157, 94, 255, 0.05)" stroke-width="1" />
    </svg>

    <!-- Hero Content Container -->
    <div class="max-w-7xl mx-auto w-full relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center flex-grow">
      <!-- Hero Headline & Copy -->
      <div class="lg:col-span-6 space-y-6 pt-6">
        <div
          class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full glass-pill border border-purple-400/20 text-xs font-semibold text-purple-200 tracking-wider uppercase hero-badge">
          <span class="w-2 h-2 rounded-full bg-tapsi-electric animate-pulse"></span>
          Next-Gen Transportation
        </div>

        <h1
          class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-white leading-[1.05] hero-headline">
          Get even more from <br class="hidden sm:inline" />
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-purple-100 to-tapsi-electric">
            Taxi services
          </span>
        </h1>

        <p class="text-base sm:text-lg text-tapsi-lightText max-w-lg leading-relaxed font-normal hero-subtext">
          Experience seamless, chauffeured corporate commutes designed for executives and tech teams. Precision
          dispatch, well-maintained vehicles and straightforward booking support.
        </p>

        <div class="flex flex-wrap items-center gap-4 pt-2 hero-actions">
          <a href="#revolution"
            class="inline-flex items-center gap-3 px-7 py-3.5 rounded-full bg-white text-tapsi-purple font-semibold text-sm hover:bg-tapsi-electric hover:text-white transition-all transform hover:-translate-y-1 shadow-xl shadow-purple-950/50 group">
            Explore Service
            <span
              class="w-6 h-6 rounded-full bg-tapsi-purple/10 group-hover:bg-white/20 flex items-center justify-center transition-colors">
              <svg class="w-3 h-3 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
              </svg>
            </span>
          </a>
          <a href="#features"
            class="inline-flex items-center gap-2 px-6 py-3.5 rounded-full glass-pill text-white/90 hover:text-white hover:bg-white/10 text-sm font-medium transition-all">
            See App Features
          </a>
        </div>

        <!-- Metric micro-badges -->
        <div class="grid grid-cols-3 gap-4 pt-8 border-t border-white/10 max-w-md hero-metrics">
          <div>
            <div class="text-2xl font-bold text-white tracking-tight">99.8%</div>
            <div class="text-xs text-tapsi-lightText mt-0.5">On-Time Rate</div>
          </div>
          <div>
            <div class="text-2xl font-bold text-white tracking-tight">&lt; 3 min</div>
            <div class="text-xs text-tapsi-lightText mt-0.5">Pickup Arrival</div>
          </div>
          <div>
            <div class="text-2xl font-bold text-white tracking-tight">4.98 ★</div>
            <div class="text-xs text-tapsi-lightText mt-0.5">Customer Rating</div>
          </div>
        </div>
      </div>

      <!-- Hero Vehicle Storyboard Placement (Car cuts into the right visual canvas) -->
      <div class="lg:col-span-6 relative flex items-center justify-center min-h-[360px] lg:min-h-[480px]">
        <!-- Circular Graphic Rings behind vehicle from storyboard frame 01-05 -->
        <div
          class="absolute w-72 sm:w-96 lg:w-[480px] h-72 sm:h-96 lg:h-[480px] rounded-full border border-purple-500/20 flex items-center justify-center pointer-events-none">
          <div class="w-3/4 h-3/4 rounded-full border border-purple-400/15 flex items-center justify-center">
            <div class="w-1/2 h-1/2 rounded-full bg-tapsi-electric/10 blur-xl"></div>
          </div>
        </div>

        <!-- Floating UI Card 1 (Speed/Route) -->
        <div
          class="absolute -top-4 right-4 glass-card px-4 py-2.5 rounded-xl border border-white/10 shadow-2xl hidden sm:flex items-center gap-3 z-20 animate-float-wave">
          <div class="w-8 h-8 rounded-lg bg-tapsi-electric/20 flex items-center justify-center text-tapsi-electric">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
          </div>
          <div>
            <div class="text-xs font-bold text-white">Direct Executive Lane</div>
            <div class="text-[10px] text-tapsi-lightText">Route Planning Support</div>
          </div>
        </div>

        <!-- Hero Car Image Asset (Transiting seamlessly on scroll) -->
        <div id="heroCarContainer" class="relative z-10 w-full max-w-2xl">
          <div id="heroCarousel" class="hero-carousel" aria-roledescription="carousel" aria-label="Arna vehicle showcase">
            <img id="heroCarImg" class="hero-carousel-image car-underglow" src="assets/img/innova-1200.webp" srcset="assets/img/innova-480.webp 480w, assets/img/innova-768.webp 768w, assets/img/innova-1200.webp 1200w, assets/img/innova-1536.webp 1536w" sizes="(max-width: 900px) 92vw, 46vw" width="1536" height="1024" alt="Arna premium taxi vehicle" fetchpriority="high">
            <div class="hero-carousel-controls" aria-label="Vehicle carousel controls"><button type="button" class="hero-carousel-button" id="heroPrev" aria-label="Previous vehicle">&#8592;</button><div class="hero-carousel-dots" role="tablist" aria-label="Select vehicle"><button type="button" class="hero-carousel-dot is-active" data-slide="0" role="tab" aria-selected="true" aria-label="Show Innova vehicle"></button><button type="button" class="hero-carousel-dot" data-slide="1" role="tab" aria-selected="false" aria-label="Show Etios vehicle"></button><button type="button" class="hero-carousel-dot" data-slide="2" role="tab" aria-selected="false" aria-label="Show fleet showcase vehicle"></button></div><button type="button" class="hero-carousel-button" id="heroNext" aria-label="Next vehicle">&#8594;</button></div>
          </div>
        </div>

        <!-- Floating UI Card 2 (Driver Status) -->
        <div
          class="absolute -bottom-4 left-4 glass-card px-4 py-3 rounded-xl border border-white/10 shadow-2xl hidden sm:flex items-center gap-3 z-20">
          <div class="relative">
            <div class="w-9 h-9 rounded-full bg-purple-700 overflow-hidden border border-purple-400/40">
              <img
                src="assets/img/ertiga-480.webp" srcset="assets/img/ertiga-480.webp 480w, assets/img/ertiga-768.webp 768w" sizes="36px" width="1536" height="1024" loading="lazy"
                alt="Arna fleet vehicle" class="w-full h-full object-cover grayscale">
            </div>
            <span
              class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-400 border-2 border-tapsi-purple"></span>
          </div>
          <div>
            <div class="text-xs font-bold text-white">Ertiga</div>
            <div class="text-[10px] text-tapsi-lightText">Ertiga Model S • Executive Suite</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Scroll Down Prompt Indicator -->
    <div class="w-full flex justify-center pt-8 relative z-10">
      <a href="#revolution"
        class="flex flex-col items-center gap-2 text-white/50 hover:text-white transition-colors group">
        <span
          class="text-[11px] font-semibold uppercase tracking-widest text-tapsi-lightText group-hover:text-white">Scroll
          to Explore</span>
        <div class="w-5 h-8 rounded-full border border-white/20 flex justify-center pt-1.5">
          <div class="w-1 h-2 bg-tapsi-electric rounded-full animate-bounce"></div>
        </div>
      </a>
    </div>
  </section>


  <!-- ==================== BOOKING SECTION ==================== -->
  <section id="booking" class="booking-section relative overflow-hidden bg-white text-tapsi-darkHeading px-6 lg:px-14 py-20 sm:py-24">
    <div class="booking-glow booking-glow-one"></div>
    <div class="booking-glow booking-glow-two"></div>

    <div class="max-w-7xl mx-auto relative z-10">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-start">

        <!-- Booking Intro -->
        <div class="lg:col-span-5 lg:sticky lg:top-28">
          <div class="inline-flex items-center gap-2 text-xs font-bold text-tapsi-accent uppercase tracking-[0.2em] mb-5">
            <span class="w-2 h-2 rounded-full bg-tapsi-accent animate-pulse"></span>
            Book Your Journey
          </div>

          <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.05]">
            Your ride.<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-tapsi-purple via-tapsi-accent to-tapsi-electric">
              Your way.
            </span>
          </h2>

          <p class="mt-6 text-base text-tapsi-slateText leading-relaxed max-w-xl">
            Tell us where you are going and when you need to travel. Send a booking request in a few seconds and our team will get in touch with you.
          </p>

          <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-3 max-w-lg">
            <div class="booking-trust-card">
              <span class="booking-trust-icon">✓</span>
              <div>
                <strong>Easy booking</strong>
                <span>Simple online request</span>
              </div>
            </div>
            <div class="booking-trust-card">
              <span class="booking-trust-icon">24</span>
              <div>
                <strong>Travel support</strong>
                <span>Help when you need it</span>
              </div>
            </div>
          </div>

          <div class="mt-8 flex flex-wrap gap-3">
            <a href="tel:+918007961759" class="inline-flex items-center gap-2 rounded-full bg-tapsi-purple px-5 py-3 text-xs font-bold uppercase tracking-wider text-white transition hover:-translate-y-0.5 hover:bg-tapsi-violet">
              Call +91 80079 61759
            </a>
            <span class="inline-flex items-center rounded-full border border-slate-200 px-5 py-3 text-xs font-semibold text-tapsi-slateText">
              No payment required to request
            </span>
          </div>
        </div>

        <!-- Booking Form -->
        <div class="lg:col-span-7">
          <div class="booking-card">
            <div class="booking-card-header">
              <div>
                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-tapsi-accent">Request a ride</p>
                <h3 class="mt-2 text-2xl sm:text-3xl font-extrabold tracking-tight text-tapsi-darkHeading">
                  Plan your next trip
                </h3>
              </div>
              <div class="booking-card-mark" aria-hidden="true">ARNA</div>
            </div>

            <div id="bookingAlert" class="booking-alert hidden" role="alert" aria-live="polite"></div>

            <form id="bookingForm" novalidate data-site-today="<?= e(appToday()) ?>">
              <input type="hidden" name="csrf_token" value="<?= e($csrfToken) ?>">
              <input type="text" name="website" class="booking-honeypot" tabindex="-1" autocomplete="off" aria-hidden="true">

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="booking-field sm:col-span-1">
                  <label for="bookingFullName">Full Name <span>*</span></label>
                  <input id="bookingFullName" type="text" name="full_name" maxlength="150" autocomplete="name" placeholder="Enter your full name" required>
                  <small class="booking-error" data-error-for="full_name"></small>
                </div>

                <div class="booking-field sm:col-span-1">
                  <label for="bookingMobile">Mobile Number <span>*</span></label>
                  <div class="booking-phone-input">
                    <span>+91</span>
                    <input id="bookingMobile" type="tel" name="mobile_number" inputmode="numeric" maxlength="10" autocomplete="tel-national" placeholder="10-digit mobile number" required>
                  </div>
                  <small class="booking-error" data-error-for="mobile_number"></small>
                </div>

                <div class="booking-field">
                  <label for="bookingSource">Pickup Location <span>*</span></label>
                  <div class="booking-input-icon">
                    <span>⌖</span>
                    <input id="bookingSource" type="text" name="source_location" maxlength="255" autocomplete="street-address" placeholder="Where should we pick you up?" required>
                  </div>
                  <small class="booking-error" data-error-for="source_location"></small>
                </div>

                <div class="booking-field">
                  <label for="bookingDestination">Destination <span>*</span></label>
                  <div class="booking-input-icon">
                    <span>⌖</span>
                    <input id="bookingDestination" type="text" name="destination_location" maxlength="255" placeholder="Where are you going?" required>
                  </div>
                  <small class="booking-error" data-error-for="destination_location"></small>
                </div>

                <div class="booking-field">
                  <label>Trip Type <span>*</span></label>
                  <div class="booking-trip-options">
                    <label class="booking-trip-option">
                      <input type="radio" name="trip_type" value="ROUND_TRIP" checked>
                      <span>Round Trip</span>
                    </label>
                    <label class="booking-trip-option">
                      <input type="radio" name="trip_type" value="DROP">
                      <span>Drop</span>
                    </label>
                  </div>
                  <small class="booking-error" data-error-for="trip_type"></small>
                </div>

                <div class="booking-field">
                  <label for="bookingDate">Preferred Date <span>*</span></label>
                  <input id="bookingDate" type="date" name="preferred_date" required>
                  <small class="booking-error" data-error-for="preferred_date"></small>
                </div>

                <div class="booking-field sm:col-span-2">
                  <label for="bookingParticipants">Number of Visitors / Participants <span>*</span></label>
                  <input id="bookingParticipants" type="number" name="participants" min="1" max="100" value="1" inputmode="numeric" required>
                  <small class="booking-hint">Tell us how many people will be travelling.</small>
                  <small class="booking-error" data-error-for="participants"></small>
                </div>
              </div>

              <div class="booking-submit-row">
                <div class="booking-secure-note">
                  <span>●</span> Your request is sent securely to Arna Tours & Travels.
                </div>
                <button id="bookingSubmit" type="submit" class="booking-submit">
                  <span class="booking-submit-text">Request a Ride</span>
                  <span class="booking-submit-loading hidden">Submitting…</span>
                  <span class="booking-submit-arrow">→</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Booking Success Modal -->
  <div id="bookingSuccessModal" class="booking-modal hidden" role="dialog" aria-modal="true" aria-labelledby="bookingSuccessTitle">
    <div class="booking-modal-backdrop" data-booking-close></div>
    <div class="booking-success-card">
      <button type="button" class="booking-modal-close" data-booking-close aria-label="Close">×</button>
      <div class="booking-success-icon">✓</div>
      <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-tapsi-accent">Booking request received</p>
      <h3 id="bookingSuccessTitle" class="mt-2 text-3xl font-extrabold tracking-tight text-tapsi-darkHeading">You're all set.</h3>
      <p class="mt-3 text-sm leading-relaxed text-tapsi-slateText">
        Thank you for choosing Arna Tours & Travels. Keep your booking number for reference. Our team will contact you shortly.
      </p>
      <div class="booking-number-box">
        <span>Booking Number</span>
        <strong id="bookingNumber">ARNA-00000000-000000</strong>
      </div>
      <div class="flex flex-col sm:flex-row gap-3 mt-5">
        <button type="button" data-booking-close class="booking-modal-primary">Done</button>
        <a href="tel:+918007961759" class="booking-modal-secondary">Call Arna</a>
      </div>
    </div>
  </div>


  <!-- ==================== TRAVEL SERVICES ==================== -->
  <section id="services" class="relative bg-[#f7f5fa] text-tapsi-darkHeading px-6 lg:px-14 py-24 border-t border-purple-100/60">
    <div class="max-w-7xl mx-auto">
      <div class="grid lg:grid-cols-12 gap-10 items-end mb-12">
        <div class="lg:col-span-8">
          <div class="inline-flex items-center gap-2 text-xs font-bold text-tapsi-accent uppercase tracking-[0.2em] mb-4"><span class="w-2 h-2 rounded-full bg-tapsi-accent"></span> Travel Services</div>
          <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.05]">Everything you need to <span class="text-transparent bg-clip-text bg-gradient-to-r from-tapsi-purple via-tapsi-accent to-tapsi-electric">travel better.</span></h2>
        </div>
        <div class="lg:col-span-4"><p class="text-sm sm:text-base text-tapsi-slateText leading-relaxed">Arna Tour & Travels provides travel assistance for road journeys and booking support across India.</p></div>
      </div>
      <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <?php foreach ($websiteServices as $service): ?>
        <article class="rounded-3xl bg-white border border-purple-100 p-6 shadow-sm hover:-translate-y-1 hover:shadow-xl transition-all">
          <div class="w-12 h-12 rounded-2xl bg-purple-50 flex items-center justify-center text-2xl mb-5"><?= e($service['icon']) ?></div>
          <h3 class="text-lg font-extrabold"><?= e($service['title']) ?></h3>
          <p class="mt-2 text-xs leading-relaxed text-tapsi-slateText"><?= e($service['short_description']) ?></p>
          <a href="#booking" class="inline-flex min-h-[44px] items-center mt-4 text-xs font-bold uppercase tracking-wider text-tapsi-accent">Request this service <span class="ml-2">→</span></a>
        </article>
        <?php endforeach; ?>
      </div>
      <div class="mt-8 flex flex-wrap items-center justify-between gap-4 rounded-3xl bg-tapsi-purple text-white p-6 sm:p-8">
        <div><div class="text-xs font-bold uppercase tracking-[0.2em] text-tapsi-electric">Travel Coverage</div><div class="mt-1 text-xl font-extrabold">Serving All India</div></div>
        <a href="#booking" class="rounded-full bg-white text-tapsi-purple px-6 py-3 text-xs font-bold uppercase tracking-wider">Plan Your Journey →</a>
      </div>
    </div>
  </section>

  <!-- ==================== SECTION 2: "REVOLUTIONIZING COMMUTE" (WHITE LIGHT SECTION) ==================== -->
  <!-- Storyboard Frames 06 - 15: The car and dark purple transitions into a clean white editorial section -->
  <section id="revolution"
    class="relative bg-white text-tapsi-darkHeading py-28 px-6 lg:px-14 overflow-hidden border-t border-purple-100/50">
    <div class="max-w-7xl mx-auto w-full relative z-10">

      <!-- Top Section Header -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-end mb-16">
        <div class="lg:col-span-8">
          <div
            class="inline-flex items-center gap-2 text-xs font-bold text-tapsi-accent uppercase tracking-widest mb-4">
            <span class="w-1.5 h-1.5 rounded-full bg-tapsi-accent"></span>
            Seamless Mobility System
          </div>
          <h2
            class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-tapsi-darkHeading leading-[1.08] rev-heading">
            Revolutionizing commute for IT professionals
          </h2>
        </div>
        <div class="lg:col-span-4 pb-2">
          <p class="text-base text-tapsi-slateText font-normal leading-relaxed">
            Eliminate transit fatigue with on-demand executive transport built specifically for high-growth tech firms
            and engineering enterprises.
          </p>
        </div>
      </div>

      <!-- Car transition & visual alignment row -->
      <div
        class="relative w-full rounded-3xl bg-tapsi-bgLight p-8 sm:p-12 lg:p-16 border border-purple-100/80 shadow-sm overflow-hidden mb-16">
        <!-- Subtle background watermark -->
        <div
          class="absolute -right-10 -bottom-10 text-9xl font-black text-purple-900/[0.03] select-none pointer-events-none">
          TAPSI
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
          <!-- Transited vehicle visual in white section context -->
          <div class="lg:col-span-7 flex justify-center items-center">
            <div class="relative w-full max-w-xl group">
              <img
                src="assets/img/etios-1200.webp" srcset="assets/img/etios-480.webp 480w, assets/img/etios-768.webp 768w, assets/img/etios-1200.webp 1200w, assets/img/etios-1536.webp 1536w" sizes="(max-width: 900px) 92vw, 46vw" width="1536" height="1024" loading="lazy"
                alt="Arna Etios fleet vehicle"
                class="w-full h-auto object-contain transform transition-transform duration-500 group-hover:scale-105" />
              <div class="absolute bottom-2 left-1/2 -translate-x-1/2 w-4/5 h-4 bg-purple-900/10 rounded-full blur-md">
              </div>
            </div>
          </div>

          <!-- Feature Bullets alongside vehicle -->
          <div class="lg:col-span-5 space-y-6">
            <div class="space-y-2">
              <span class="text-xs font-bold text-tapsi-accent uppercase tracking-wider">Fleet Standards</span>
              <h3 class="text-2xl font-bold text-tapsi-darkHeading tracking-tight">Comfort-focused travel</h3>
              <p class="text-sm text-tapsi-slateText leading-relaxed">
                Comfortable cabins with practical travel amenities, clean interiors and a smooth ride for local and outstation journeys.
              </p>
            </div>

            <div class="grid grid-cols-2 gap-4 pt-2">
              <div class="p-4 rounded-xl bg-white border border-purple-100 shadow-sm">
                <div class="text-xs font-semibold text-tapsi-slateText">Fleet Quality</div>
                <div class="text-lg font-extrabold text-tapsi-darkHeading mt-1">100% Electric</div>
              </div>
              <div class="p-4 rounded-xl bg-white border border-purple-100 shadow-sm">
                <div class="text-xs font-semibold text-tapsi-slateText">WiFi Latency</div>
                <div class="text-lg font-extrabold text-tapsi-darkHeading mt-1">Connectivity support</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Metrics Row (20K+ | 500+ | 3K+) Matching Storyboard Frames 08-14 -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 pt-6 border-t border-slate-200">
        <!-- Stat Card 1 -->
        <div
          class="stat-card p-6 rounded-2xl bg-tapsi-bgLight/60 border border-slate-100 transition-all hover:bg-white hover:shadow-lg hover:border-purple-200 group">
          <div class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-tapsi-darkHeading tracking-tight counter"
            data-target="20">
            20K+
          </div>
          <div class="text-base font-bold text-tapsi-darkHeading mt-2">Active Commuters</div>
          <p class="text-xs text-tapsi-slateText mt-1 leading-relaxed">Software developers, product leaders, and IT
            executives moved smoothly each week.</p>
        </div>

        <!-- Stat Card 2 -->
        <div
          class="stat-card p-6 rounded-2xl bg-tapsi-bgLight/60 border border-slate-100 transition-all hover:bg-white hover:shadow-lg hover:border-purple-200 group">
          <div class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-tapsi-darkHeading tracking-tight counter"
            data-target="500">
            500+
          </div>
          <div class="text-base font-bold text-tapsi-darkHeading mt-2">Enterprise Partners</div>
          <p class="text-xs text-tapsi-slateText mt-1 leading-relaxed">Travel teams using Arna for coordinated journeys.</p>
        </div>

        <!-- Stat Card 3 -->
        <div
          class="stat-card p-6 rounded-2xl bg-tapsi-bgLight/60 border border-slate-100 transition-all hover:bg-white hover:shadow-lg hover:border-purple-200 group">
          <div class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-tapsi-darkHeading tracking-tight counter"
            data-target="3">
            3K+
          </div>
          <div class="text-base font-bold text-tapsi-darkHeading mt-2">Electric Vehicles</div>
          <p class="text-xs text-tapsi-slateText mt-1 leading-relaxed">Dedicated luxury chauffeur units constantly
            serviced and ready in city hubs.</p>
        </div>
      </div>

    </div>
  </section>


  <!-- ==================== SECTION 3: SERVICE FEATURES ==================== -->
  <!-- Storyboard Frames 16 - 25: "Service features: Elevating your commute experience" with asymmetric interactive cards -->
  <section id="features"
    class="relative bg-tapsi-bgLight text-tapsi-darkHeading py-28 px-6 lg:px-14 overflow-hidden border-t border-slate-200/80">
    <div class="max-w-7xl mx-auto w-full">

      <!-- Section Title -->
      <div class="max-w-3xl mb-16">
        <div class="inline-flex items-center gap-2 text-xs font-bold text-tapsi-accent uppercase tracking-widest mb-3">
          <span class="w-1.5 h-1.5 rounded-full bg-tapsi-accent"></span>
          Tailored Chauffeur Experience
        </div>
        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-tapsi-darkHeading leading-[1.1]">
          Service features: Elevating your commute experience
        </h2>
        <p class="text-base text-tapsi-slateText mt-4 max-w-xl leading-relaxed">
          Carefully engineered amenities that transform travel time into an extension of your creative and productive
          sanctuary.
        </p>
      </div>

      <!-- Asymmetric Storyboard Bento Grid of Feature Cards -->
      <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-stretch">

        <!-- Large Dark Hero Card 1: Route Planning Support -->
        <div
          class="md:col-span-7 bg-tapsi-purple text-white rounded-3xl p-8 sm:p-12 relative overflow-hidden flex flex-col justify-between shadow-xl border border-white/5 feature-card transform transition-all duration-300 hover:-translate-y-1">
          <!-- Background glow circle -->
          <div
            class="absolute -right-20 -top-20 w-80 h-80 bg-tapsi-accent/20 rounded-full blur-3xl pointer-events-none">
          </div>

          <div class="relative z-10 space-y-4">
            <div
              class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center text-tapsi-electric border border-white/10">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
              </svg>
            </div>
            <span class="text-xs font-bold text-tapsi-electric uppercase tracking-wider">Route Planning Support</span>
            <h3 class="text-2xl sm:text-3xl font-extrabold tracking-tight">AI-Driven Dynamic Route Optimization</h3>
            <p class="text-sm text-tapsi-lightText leading-relaxed max-w-md">
              Algorithms anticipate corridor bottlenecks 20 minutes in advance, rerouting via dedicated bus & transit
              arteries to bypass morning peak traffic.
            </p>
          </div>

          <!-- UI Interactive Graphic Component -->
          <div
            class="mt-8 pt-6 border-t border-white/10 flex items-center justify-between text-xs text-tapsi-lightText">
            <div class="flex items-center gap-2">
              <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
              Average time saved: <strong class="text-white">24 min/commute</strong>
            </div>
            <div class="font-semibold text-tapsi-electric flex items-center gap-1">
              Travel Coordination
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>
          </div>
        </div>

        <!-- Light Card 2: Real-time Updates -->
        <div
          class="md:col-span-5 bg-white text-tapsi-darkHeading rounded-3xl p-8 sm:p-10 flex flex-col justify-between shadow-sm border border-purple-100 feature-card transform transition-all duration-300 hover:-translate-y-1">
          <div class="space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-purple-100 flex items-center justify-center text-tapsi-accent">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <span class="text-xs font-bold text-tapsi-accent uppercase tracking-wider">Instant Transparency</span>
            <h3 class="text-2xl font-extrabold tracking-tight">Real-Time Precision Status</h3>
            <p class="text-sm text-tapsi-slateText leading-relaxed">
              Second-by-second telematics updates on your driver’s arrival, cabin air quality index, and charging
              readiness.
            </p>
          </div>

          <!-- Micro interactive phone preview badge -->
          <div
            class="mt-8 p-4 rounded-2xl bg-tapsi-bgLight border border-slate-200/70 flex items-center justify-between">
            <div class="flex items-center gap-3">
              <div
                class="w-8 h-8 rounded-full bg-emerald-500/20 text-emerald-600 flex items-center justify-center font-bold text-xs">
                ✓</div>
              <div>
                <div class="text-xs font-bold text-tapsi-darkHeading">Car 04 Arrived</div>
                <div class="text-[10px] text-tapsi-slateText">Gate 2 Tech Campus</div>
              </div>
            </div>
            <span class="text-[11px] font-bold text-tapsi-accent px-2.5 py-1 rounded-full bg-purple-100">Ready</span>
          </div>
        </div>

        <!-- Light Card 3: High-Time Efficiency -->
        <div
          class="md:col-span-4 bg-white text-tapsi-darkHeading rounded-3xl p-8 flex flex-col justify-between shadow-sm border border-purple-100 feature-card transform transition-all duration-300 hover:-translate-y-1">
          <div class="space-y-3">
            <div class="w-10 h-10 rounded-xl bg-purple-50 text-tapsi-accent flex items-center justify-center font-bold">
              ⚡
            </div>
            <h4 class="text-xl font-bold tracking-tight">High-Time Efficiency</h4>
            <p class="text-xs text-tapsi-slateText leading-relaxed">
              Seamless terminal access with automated gate clearance and pre-registered badge entry for corporate hubs.
            </p>
          </div>
          <div
            class="mt-6 pt-4 border-t border-slate-100 text-xs font-semibold text-tapsi-accent flex items-center justify-between">
            <span>Fast-Track Clearance</span>
            <span>&rarr;</span>
          </div>
        </div>

        <!-- Dark Card 4: Flexible Corporate Payments -->
        <div
          class="md:col-span-4 bg-tapsi-surface text-white rounded-3xl p-8 flex flex-col justify-between shadow-md border border-white/5 feature-card transform transition-all duration-300 hover:-translate-y-1">
          <div class="space-y-3">
            <div
              class="w-10 h-10 rounded-xl bg-white/10 text-tapsi-electric flex items-center justify-center font-bold">
              💳
            </div>
            <h4 class="text-xl font-bold tracking-tight">Flexible Payments</h4>
            <p class="text-xs text-tapsi-lightText leading-relaxed">
              Consolidated corporate invoicing, expensing through Concur and Expensify, or individual frictionless
              digital tap.
            </p>
          </div>
          <div
            class="mt-6 pt-4 border-t border-white/10 text-xs font-semibold text-tapsi-electric flex items-center justify-between">
            <span>Automated Invoicing</span>
            <span>&rarr;</span>
          </div>
        </div>

        <!-- Light Card 5: 24/7 Priority Availability -->
        <div
          class="md:col-span-4 bg-white text-tapsi-darkHeading rounded-3xl p-8 flex flex-col justify-between shadow-sm border border-purple-100 feature-card transform transition-all duration-300 hover:-translate-y-1">
          <div class="space-y-3">
            <div class="w-10 h-10 rounded-xl bg-purple-50 text-tapsi-accent flex items-center justify-center font-bold">
              🛡️
            </div>
            <h4 class="text-xl font-bold tracking-tight">24/7 Availability</h4>
            <p class="text-xs text-tapsi-slateText leading-relaxed">
              Travel assistance is available according to operating hours and service availability.
            </p>
          </div>
          <div
            class="mt-6 pt-4 border-t border-slate-100 text-xs font-semibold text-tapsi-accent flex items-center justify-between">
            <span>Direct Concierge</span>
            <span>&rarr;</span>
          </div>
        </div>

      </div>

    </div>
  </section>


  <!-- ==================== SECTION 4: TESTIMONIAL / CUSTOMER SECTION ==================== -->
  <!-- Storyboard Frames 26 - 37: Deep purple customer stories section -->
  <section id="testimonials"
    class="relative bg-tapsi-purple py-32 px-6 lg:px-14 overflow-hidden border-t border-white/10">
    <!-- Atmospheric glows -->
    <div
      class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[45rem] h-[45rem] bg-tapsi-accent/10 rounded-full blur-[160px] pointer-events-none">
    </div>

    <div class="max-w-7xl mx-auto w-full relative z-10">

      <!-- Section Title -->
      <div class="text-center max-w-3xl mx-auto mb-20">
        <div
          class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full glass-pill text-xs font-semibold text-purple-200 tracking-wider uppercase mb-4">
          Client Endorsements
        </div>
        <h2 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-white leading-[1.08]">
          What our valued customers <br />
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-tapsi-electric">
            have to say about Arna Tour & Travels
          </span>
        </h2>
      </div>

      <div class="max-w-4xl mx-auto glass-card rounded-3xl p-8 sm:p-14 border border-white/10 shadow-2xl relative">
        <?php
        $testimonials = [];
        try {
            $stmt = Database::getConnection()->query("SELECT customer_name, message, rating FROM testimonials WHERE status = 'ACTIVE' ORDER BY created_at DESC LIMIT 3");
            $testimonials = $stmt->fetchAll();
        } catch (Throwable $e) { $testimonials = []; }
        ?>
        <?php if ($testimonials): ?>
          <div class="space-y-8">
            <?php foreach ($testimonials as $testimonial): ?>
              <article class="border-b border-white/10 pb-7 last:border-0 last:pb-0">
                <div class="text-tapsi-electric mb-3" aria-label="Rating <?=e((string)$testimonial['rating'])?> out of 5"><?=str_repeat('★', max(1,min(5,(int)$testimonial['rating'])))?></div>
                <blockquote class="text-lg sm:text-xl text-white/95 font-medium leading-relaxed italic">“<?=e($testimonial['message'])?>”</blockquote>
                <p class="mt-4 text-xs font-bold text-tapsi-lightText"><?=e($testimonial['customer_name'])?></p>
              </article>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="text-center py-10">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-tapsi-electric">Customer Stories</p>
            <h3 class="mt-3 text-2xl sm:text-3xl font-extrabold text-white">Real customer feedback will appear here.</h3>
            <p class="mt-3 text-sm text-tapsi-lightText max-w-xl mx-auto">Testimonials are published only after they are added and approved in the Arna admin panel.</p>
            <a href="#booking" class="inline-flex min-h-[44px] items-center justify-center mt-6 px-6 py-3 rounded-full bg-white text-tapsi-purple text-xs font-bold uppercase tracking-wider">Book a Ride</a>
          </div>
        <?php endif; ?>
      </div>

    </div>
  </section>


  <!-- ==================== SECTION 5: BENEFITS & MOBILE APP SECTION ==================== -->
  <!-- Storyboard Frames 41 - 56: "Unlock Exceptional Benefits with Arna Tour & Travels" with mobile phone interface mockup -->
  <section id="benefits"
    class="relative bg-white text-tapsi-darkHeading py-28 px-6 lg:px-14 overflow-hidden border-t border-purple-100">
    <div class="max-w-7xl mx-auto w-full">

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

        <!-- Left Column: Copy & Benefit Checklist -->
        <div class="lg:col-span-6 space-y-8">
          <div>
            <div
              class="inline-flex items-center gap-2 text-xs font-bold text-tapsi-accent uppercase tracking-widest mb-3">
              <span class="w-1.5 h-1.5 rounded-full bg-tapsi-accent"></span>
              Enterprise Perks
            </div>
            <h2
              class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-tapsi-darkHeading leading-[1.08]">
              Unlock Exceptional Benefits with Arna Tour & Travels
            </h2>
            <p class="text-base text-tapsi-slateText mt-4 leading-relaxed max-w-xl">
              From travel planning to booking support, we help teams coordinate journeys with clear communication.
            </p>
          </div>

          <!-- Benefits List Items -->
          <div class="space-y-4">
            <div
              class="flex items-start gap-4 p-4 rounded-2xl bg-tapsi-bgLight border border-slate-200/60 transition-colors hover:border-purple-200">
              <div
                class="w-8 h-8 rounded-xl bg-purple-100 text-tapsi-accent flex items-center justify-center font-bold text-sm shrink-0">
                ✓
              </div>
              <div>
                <h4 class="text-base font-bold text-tapsi-darkHeading">Zero Surge Pricing Guarantee</h4>
                <p class="text-xs text-tapsi-slateText mt-0.5">Fixed contracted rates regardless of weather, transit
                  strikes, or tech conferences.</p>
              </div>
            </div>

            <div
              class="flex items-start gap-4 p-4 rounded-2xl bg-tapsi-bgLight border border-slate-200/60 transition-colors hover:border-purple-200">
              <div
                class="w-8 h-8 rounded-xl bg-purple-100 text-tapsi-accent flex items-center justify-center font-bold text-sm shrink-0">
                ✓
              </div>
              <div>
                <h4 class="text-base font-bold text-tapsi-darkHeading">Single-Tap Corporate Expensing</h4>
                <p class="text-xs text-tapsi-slateText mt-0.5">Direct integration with Okta SSO, Workday, SAP, and
                  automated receipt matching.</p>
              </div>
            </div>

            <div
              class="flex items-start gap-4 p-4 rounded-2xl bg-tapsi-bgLight border border-slate-200/60 transition-colors hover:border-purple-200">
              <div
                class="w-8 h-8 rounded-xl bg-purple-100 text-tapsi-accent flex items-center justify-center font-bold text-sm shrink-0">
                ✓
              </div>
              <div>
                <h4 class="text-base font-bold text-tapsi-darkHeading">Pre-Scheduled Recurring Chauffeurs</h4>
                <p class="text-xs text-tapsi-slateText mt-0.5">Lock in your favorite professional driver for the entire
                  quarter at set pickup times.</p>
              </div>
            </div>
          </div>

          <!-- App Store Badges / Booking CTA -->
          <!-- <div class="flex flex-wrap items-center gap-4 pt-2">
            <a href="#"
              class="inline-flex items-center gap-3 px-6 py-3 rounded-full bg-tapsi-darkHeading text-white font-semibold text-xs uppercase tracking-wider hover:bg-tapsi-accent transition-all shadow-md">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                <path
                  d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M15.97 6.37c.62-.75 1.04-1.8 0.92-2.85-.9.04-2 0.6-2.65 1.35-.58.66-1.09 1.73-.95 2.76 1.01.08 2.05-.51 2.68-1.26z" />
              </svg>
              Download iOS App
            </a>
            <a href="#"
              class="inline-flex items-center gap-3 px-6 py-3 rounded-full bg-slate-100 text-tapsi-darkHeading font-semibold text-xs uppercase tracking-wider hover:bg-slate-200 transition-all border border-slate-200">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                <path
                  d="M3.609 1.814L13.792 12 3.61 22.186a1.99 1.99 0 0 1-.61-.902V2.716c.15-.36.37-.67.61-.902zm11.602 11.602l2.308 2.308-11.83 6.83 9.522-9.138zm2.308-2.308l-2.308 2.308L5.688 4.282l11.831 6.826zm1.481.854l2.842 1.641a1.27 1.27 0 0 1 0 2.2l-2.842 1.64-1.87-1.87 1.87-1.611z" />
              </svg>
              Android Play Store
            </a>
          </div> -->

        </div>

        <!-- Right Column: Realistic 3D Perspective Mobile Phone UI Mockup from Storyboard -->
        <div class="lg:col-span-6 flex justify-center">
          <div
            class="phone-mockup-wrapper relative w-[310px] sm:w-[340px] h-[640px] bg-tapsi-purple rounded-[48px] p-3 shadow-2xl border-[6px] border-slate-900 ring-1 ring-purple-500/20">

            <!-- Dynamic Island / Speaker notch -->
            <div
              class="absolute top-6 left-1/2 -translate-x-1/2 w-24 h-5 bg-black rounded-full z-30 flex items-center justify-end px-2">
              <div class="w-2.5 h-2.5 rounded-full bg-blue-900/40 border border-blue-500/30"></div>
            </div>

            <!-- Inner Phone Screen Screen content -->
            <div
              class="w-full h-full bg-tapsi-violet rounded-[40px] overflow-hidden flex flex-col justify-between p-5 pt-10 text-white relative">

              <!-- Screen Ambient Glow -->
              <div
                class="absolute top-0 right-0 w-44 h-44 bg-tapsi-accent/30 rounded-full blur-2xl pointer-events-none">
              </div>

              <!-- App Top Bar -->
              <div class="flex items-center justify-between relative z-10">
                <div class="flex items-center gap-2">
                  <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-tapsi-accent to-purple-800 flex items-center justify-center text-white shadow-lg shadow-purple-900/30">A
                  </div>
                  <span class="text-xs font-bold tracking-tight">Arna Tour & Travels</span>
                </div>
                <div class="w-7 h-7 rounded-full bg-white/10 flex items-center justify-center text-xs">
                  🔔
                </div>
              </div>

              <!-- Active Booking Card inside Phone -->
              <div class="my-auto space-y-4 relative z-10">
                <div class="glass-card p-4 rounded-2xl border border-white/10 space-y-3">
                  <div class="flex justify-between items-center text-[10px] text-tapsi-lightText">
                    <span>NEXT COMMUTE</span>
                    <span class="text-emerald-400 font-bold">CONFIRMED</span>
                  </div>
                  <div class="text-sm font-bold text-white">08:15 AM Pickup</div>
                  <div class="space-y-1.5 text-xs text-tapsi-lightText">
                    <div class="flex items-center gap-2">
                      <span class="w-2 h-2 rounded-full bg-tapsi-electric"></span>
                      <span>Pickup location</span>
                    </div>
                    <div class="flex items-center gap-2">
                      <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                      <span>Destination location</span>
                    </div>
                  </div>
                </div>

                <!-- Mini Car Graphic Inside Phone -->
                <div class="relative py-2 flex justify-center">
                  <img
                    src="assets/img/ertiga-480.webp" srcset="assets/img/ertiga-480.webp 480w, assets/img/ertiga-768.webp 768w" sizes="192px" width="1536" height="1024" loading="lazy"
                    alt="Arna fleet vehicle thumbnail" class="w-48 h-auto object-contain drop-shadow-md">
                </div>

                <div class="p-3.5 rounded-2xl bg-white/5 border border-white/10 text-center">
                  <div class="text-xs font-bold text-white">Ertiga</div>
                </div>
              </div>

              <!-- App Bottom CTA -->
              <div class="relative z-10 pt-2">
                <button
                  class="w-full py-3 rounded-full bg-tapsi-electric text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-purple-900/50 hover:bg-white hover:text-tapsi-purple transition-all">
                  Manage Daily Schedule
                </button>
              </div>

            </div>

          </div>
        </div>

      </div>

    </div>
  </section>


  <!-- ==================== SECTION 6: FOOTER ==================== -->
  <!-- Storyboard Frames 57 - 71: Deep purple cinematic closing & minimalist footer -->
  <footer
    class="bg-tapsi-purple text-white pt-24 pb-12 px-6 lg:px-14 border-t border-white/10 relative overflow-hidden">
    <!-- Subtle footer glow -->
    <div class="absolute bottom-0 left-1/3 w-96 h-96 bg-purple-600/10 rounded-full blur-[140px] pointer-events-none">
    </div>

    <div class="max-w-7xl mx-auto w-full relative z-10">

      <!-- Big CTA Banner before Links -->
      <div
        class="rounded-3xl bg-gradient-to-r from-tapsi-violet via-tapsi-surface to-purple-950 p-8 sm:p-14 border border-white/10 shadow-2xl mb-16 flex flex-col lg:flex-row items-center justify-between gap-8">
        <div class="space-y-3 text-center lg:text-left">
          <h3 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Ready to plan your next journey?</h3>
          <p class="text-sm text-tapsi-lightText max-w-lg">Share your travel requirements and our team will help plan the right vehicle and journey.</p>
        </div>
        <div class="flex flex-wrap items-center justify-center gap-4">
          <a href="#booking"
            class="px-8 py-3.5 rounded-full bg-white text-tapsi-purple font-bold text-xs uppercase tracking-wider hover:bg-tapsi-electric hover:text-white transition-all transform hover:-translate-y-0.5 shadow-xl">
            Request Corporate Demo
          </a>
          <a href="contact.php"
            class="px-7 py-3.5 rounded-full glass-pill text-white hover:bg-white/10 font-semibold text-xs uppercase tracking-wider transition-all">
            Contact Chauffeur Desk
          </a>
        </div>
      </div>

      <!-- Links Grid -->
      <div class="grid grid-cols-2 md:grid-cols-5 gap-8 pb-16 border-b border-white/10">

        <!-- Col 1: Brand & Bio -->
        <div class="col-span-2 space-y-4">
          <div class="flex items-center gap-2.5">
            <div
              class="w-8 h-8 rounded-lg bg-gradient-to-br from-tapsi-accent to-purple-800 flex items-center justify-center text-white">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                <path
                  d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.04 3H5.81l1.04-3z" />
              </svg>
            </div>
            <span class="text-xl font-bold tracking-tight text-white">Arna Tour & Travels<span
                class="text-tapsi-accent">.</span></span>
          </div>
          <p class="text-xs text-tapsi-lightText max-w-sm leading-relaxed">
            Premium travel support for local, airport and outstation journeys across India.
          </p>
          <div class="flex items-center gap-3 text-white/60 pt-2">
            <a href="contact.php" aria-label="Contact Arna"
              class="w-10 h-10 rounded-full glass-pill flex items-center justify-center hover:text-white hover:bg-white/10 transition-colors">Contact</a>
            <a href="contact.php" aria-label="Contact Arna"
              class="w-10 h-10 rounded-full glass-pill flex items-center justify-center hover:text-white hover:bg-white/10 transition-colors">Call</a>
            <a href="contact.php" aria-label="Contact Arna"
              class="w-10 h-10 rounded-full glass-pill flex items-center justify-center hover:text-white hover:bg-white/10 transition-colors">Info</a>
          </div>
        </div>

        <!-- Col 2: Services -->
        <div class="space-y-3">
          <div class="text-xs font-bold text-white uppercase tracking-wider">Vehicles</div>
          <ul class="space-y-2 text-xs text-tapsi-lightText">
            <li><a href="vehicles.php" class="hover:text-white transition-colors">Toyota Etios</a></li>
            <li><a href="vehicles.php" class="hover:text-white transition-colors">Swift Dezire</a></li>
            <li><a href="vehicles.php" class="hover:text-white transition-colors">Kiya Karan</a></li>
            <li><a href="vehicles.php" class="hover:text-white transition-colors">Innova Crysta</a></li>
            <li><a href="vehicles.php" class="hover:text-white transition-colors">Tempo Traveller 12 to 25 Seats</a></li>
            <li><a href="vehicles.php" class="hover:text-white transition-colors">Urbania AC</a></li>
          </ul>
        </div>

        <!-- Col 4: Company -->
        <div class="space-y-3">
          <div class="text-xs font-bold text-white uppercase tracking-wider">Travel</div>
          <ul class="space-y-2 text-xs text-tapsi-lightText">
            <li><a href="#services" class="hover:text-white transition-colors">Taxi & Cab Booking</a></li>
            <li><a href="#services" class="hover:text-white transition-colors">Bus Booking</a></li>
            <li><a href="#services" class="hover:text-white transition-colors">Train Booking</a></li>
            <li><a href="#services" class="hover:text-white transition-colors">Flight Booking</a></li>
            <li><a href="#services" class="hover:text-white transition-colors">Hotel & Resort Booking</a></li>
            <li><a href="vehicles.php" class="hover:text-white transition-colors">Our Fleet</a></li>
          </ul>
        </div>

      </div>

      <!-- Copyright & Bottom Disclaimers -->
      <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-tapsi-lightText gap-4">
        <div>
          © <?= date('Y') ?> Arna Tour & Travels. All rights reserved. Travel services across India.
        </div>
        <div class="flex items-center gap-6">
          <a href="contact.php#policies" class="hover:text-white transition-colors">Privacy Policy</a>
          <a href="contact.php#policies" class="hover:text-white transition-colors">Terms of Service</a>
          <a href="contact.php#policies" class="hover:text-white transition-colors">Cookie Settings</a>
        </div>
      </div>

    </div>
  </footer>

  <script src="assets/js/booking.js"></script>

  <script>
  document.addEventListener('DOMContentLoaded',()=>{
    const nav=document.getElementById('mainNav'), menuBtn=document.getElementById('mobileMenuBtn'), menu=document.getElementById('mobileMenu');
    const reduce=window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const updateNav=()=>{const on=window.scrollY>40;nav?.classList.toggle('bg-tapsi-purple/90',on);nav?.classList.toggle('backdrop-blur-md',on);nav?.classList.toggle('shadow-lg',on);nav?.classList.toggle('border-white/10',on)};
    addEventListener('scroll',updateNav,{passive:true});updateNav();
    menuBtn?.setAttribute('aria-expanded','false');menuBtn?.addEventListener('click',()=>{const open=menu?.classList.toggle('hidden')===false;menuBtn.setAttribute('aria-expanded',open?'true':'false')});menu?.querySelectorAll('a').forEach(a=>a.addEventListener('click',()=>{menu.classList.add('hidden');menuBtn?.setAttribute('aria-expanded','false')}));
    const els=document.querySelectorAll('.feature-card,#testimonials .glass-card,.reveal');
    if(reduce)els.forEach(e=>{e.classList.add('revealed');e.style.opacity='1';e.style.transform='none'});else if('IntersectionObserver'in window){const io=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting){e.target.classList.add('revealed');io.unobserve(e.target)}}),{threshold:.12,rootMargin:'0px 0px -40px 0px'});els.forEach(e=>io.observe(e))}
    document.querySelectorAll('.counter').forEach(c=>{const io=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting){const t=c.dataset.target;c.textContent=t+(t==='20'?'K+':t==='500'?'+':'K+');io.disconnect()}}),{threshold:.5});io.observe(c)});
    const slides=[['assets/img/innova-1200.webp','assets/img/innova-480.webp 480w, assets/img/innova-768.webp 768w, assets/img/innova-1200.webp 1200w, assets/img/innova-1536.webp 1536w','Arna Innova premium taxi vehicle'],['assets/img/etios-1200.webp','assets/img/etios-480.webp 480w, assets/img/etios-768.webp 768w, assets/img/etios-1200.webp 1200w, assets/img/etios-1536.webp 1536w','Arna Etios fleet vehicle'],['assets/img/car-1-1200.webp','assets/img/car-1-480.webp 480w, assets/img/car-1-768.webp 768w, assets/img/car-1-1200.webp 1200w, assets/img/car-1-1536.webp 1536w','Arna fleet showcase vehicle']];
    const img=document.getElementById('heroCarImg'),dots=[...document.querySelectorAll('.hero-carousel-dot')];let current=0;function show(i){current=(i+slides.length)%slides.length;img.src=slides[current][0];img.srcset=slides[current][1];img.alt=slides[current][2];dots.forEach((d,n)=>{d.classList.toggle('is-active',n===current);d.setAttribute('aria-selected',n===current?'true':'false')})};
    document.getElementById('heroPrev')?.addEventListener('click',()=>show(current-1));document.getElementById('heroNext')?.addEventListener('click',()=>show(current+1));dots.forEach(d=>d.addEventListener('click',()=>show(+d.dataset.slide)));if(!reduce)setInterval(()=>show(current+1),6500);
    const heroCar=document.getElementById('heroCarContainer'); let ticking=false;
    const moveHeroCar=()=>{ticking=false;if(!heroCar||reduce||window.innerWidth<901)return;const h=document.getElementById('hero')?.offsetHeight||window.innerHeight;const p=Math.min(1,Math.max(0,window.scrollY/h));heroCar.style.transform=`translate3d(${-Math.round(p*40)}px,${Math.round(p*120)}px,0) scale(${1-p*.08})`;heroCar.style.opacity=String(1-p*.15)};
    addEventListener('scroll',()=>{if(!ticking){ticking=true;requestAnimationFrame(moveHeroCar)}},{passive:true});addEventListener('resize',moveHeroCar,{passive:true});moveHeroCar();
  });
  </script>
</body>

</html>