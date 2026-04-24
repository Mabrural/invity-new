<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0, viewport-fit=cover">
    <title>Digital Invitation | {{ $guest->name }}</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/' . $event->favicon) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/' . $event->favicon) }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/' . $event->favicon) }}">

    <meta property="og:title" content="{{ $event->title }}">
    <meta property="og:description" content="You're invited to our special day">
    <meta property="og:image" content="{{ asset('storage/' . $event->favicon) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,400;1,500&family=Great+Vibes&display=swap"
        rel="stylesheet">

    <!-- Font Awesome - Load CSS only, defer JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        media="print" onload="this.media='all'">

    <style>
        :root {
            --silver-100: #ffffff;
            --silver-90: #e8e8ed;
            --silver-80: #d1d1d6;
            --silver-60: #a1a1a6;
            --silver-40: #6e6e73;
            --glass-bg: rgba(28, 28, 30, 0.5);
            --glass-border: rgba(255, 255, 255, 0.08);
            --transition-smooth: cubic-bezier(0.22, 0.61, 0.36, 1);
            --transition-bounce: cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-snap-type: y mandatory;
            overflow-y: scroll;
            scrollbar-width: none;
            height: 100%;
            -webkit-overflow-scrolling: touch;
        }

        html::-webkit-scrollbar {
            display: none;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #0a0a0a;
            color: var(--silver-90);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
            height: 100%;
            position: relative;
            -webkit-tap-highlight-color: transparent;
            -webkit-user-select: none;
            user-select: none;
            contain: paint;
        }

        /* === CSS BACKGROUND - OPTIMIZED === */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -3;
            pointer-events: none;
            background: #0a0a0a;
            will-change: transform;
            transform: translateZ(0);
        }

        .animated-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(ellipse at 20% 50%, rgba(60, 60, 70, 0.3) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(50, 50, 60, 0.25) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 80%, rgba(40, 40, 50, 0.2) 0%, transparent 50%);
            animation: bgShift 15s ease-in-out infinite;
        }

        @keyframes bgShift {

            0%,
            100% {
                opacity: 0.8;
            }

            33% {
                opacity: 1;
            }

            66% {
                opacity: 0.6;
            }
        }

        .grain-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            pointer-events: none;
            opacity: 0.04;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            background-size: 200px 200px;
        }

        .light-rays {
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            z-index: -1;
            pointer-events: none;
            background: radial-gradient(ellipse at 30% 20%, rgba(200, 200, 210, 0.04) 0%, transparent 50%),
                radial-gradient(ellipse at 70% 80%, rgba(200, 200, 210, 0.03) 0%, transparent 50%);
            animation: lightShift 20s ease-in-out infinite;
            will-change: transform;
            transform: translateZ(0);
        }

        @keyframes lightShift {

            0%,
            100% {
                transform: translate(0, 0);
            }

            33% {
                transform: translate(2%, -1%);
            }

            66% {
                transform: translate(-1%, 2%);
            }
        }

        /* Reduced mist count via JS */
        .mist-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
            contain: strict;
        }

        .mist {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(ellipse at center, rgba(200, 200, 210, 0.1) 0%, rgba(180, 180, 190, 0.05) 20%, transparent 60%);
            animation: mistFloat linear infinite;
            filter: blur(60px);
            will-change: transform, opacity;
            transform: translateZ(0);
        }

        @keyframes mistFloat {
            0% {
                transform: translate(0, 110vh) scale(0.6);
                opacity: 0;
            }

            10% {
                opacity: 0.7;
            }

            40% {
                opacity: 0.35;
            }

            100% {
                transform: translate(10vw, -20vh) scale(1.6);
                opacity: 0;
            }
        }

        .particles-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
            contain: strict;
        }

        .particle {
            position: absolute;
            background: radial-gradient(circle, rgba(220, 220, 230, 0.5) 0%, transparent 60%);
            border-radius: 50%;
            animation: particleFloat linear infinite;
            will-change: transform, opacity;
            transform: translateZ(0);
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(110vh) scale(0);
                opacity: 0;
            }

            10% {
                opacity: 0.8;
            }

            40% {
                opacity: 0.3;
            }

            100% {
                transform: translateY(-10vh) translateX(40px) scale(2);
                opacity: 0;
            }
        }

        .ring-3d {
            position: fixed;
            pointer-events: none;
            border: 1px solid rgba(192, 192, 200, 0.06);
            border-radius: 50%;
            animation: ringRotate linear infinite;
            will-change: transform;
            transform: translateZ(0);
        }

        .ring-3d.ring-1 {
            width: 70vmin;
            height: 70vmin;
            top: -15%;
            right: -10%;
            animation-duration: 40s;
        }

        .ring-3d.ring-2 {
            width: 50vmin;
            height: 50vmin;
            bottom: -10%;
            left: -5%;
            animation-duration: 32s;
            animation-direction: reverse;
        }

        @keyframes ringRotate {
            0% {
                transform: rotate(0deg) rotateX(15deg) rotateY(10deg);
            }

            100% {
                transform: rotate(360deg) rotateX(15deg) rotateY(10deg);
            }
        }

        /* === MUSIC PLAYER === */
        .music-player {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            opacity: 0;
            transform: scale(0);
            transition: all 0.6s var(--transition-bounce);
            pointer-events: none;
        }

        .music-player.active {
            opacity: 1;
            transform: scale(1);
            pointer-events: auto;
        }

        .music-toggle {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            color: var(--silver-90);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            transition: all 0.3s;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .music-toggle.playing i {
            animation: musicPulse 1.5s ease-in-out infinite;
        }

        @keyframes musicPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.15);
            }
        }

        .music-toggle.paused {
            opacity: 0.7;
        }

        /* === MAIN SCROLL CONTAINER === */
        .scroll-container {
            position: relative;
            z-index: 1;
        }

        .fullscreen-section {
            height: 100vh;
            height: 100dvh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            scroll-snap-align: start;
            position: relative;
            padding: 16px;
            contain: content;
        }

        /* === SECTION 1: GATE === */
        .section-gate {
            flex-direction: column;
            text-align: center;
        }

        .gate-content {
            position: relative;
            z-index: 2;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .gate-event-label {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(0.85rem, 1.8vw, 1rem);
            font-weight: 300;
            letter-spacing: 6px;
            text-transform: uppercase;
            color: var(--silver-60);
            margin-bottom: 24px;
            animation: fadeInUp 1.2s ease forwards;
            animation-delay: 0.2s;
            opacity: 0;
        }

        .gate-dear {
            font-family: 'Great Vibes', cursive;
            font-size: clamp(1.6rem, 3.5vw, 2.4rem);
            color: var(--silver-80);
            margin-bottom: 8px;
            animation: fadeInUp 1.2s ease forwards;
            animation-delay: 0.5s;
            opacity: 0;
        }

        .gate-name {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.4rem, 6vw, 4.5rem);
            font-weight: 700;
            color: var(--silver-100);
            letter-spacing: -1px;
            line-height: 1.1;
            margin-bottom: 32px;
            animation: fadeInUp 1.2s ease forwards;
            animation-delay: 0.8s;
            opacity: 0;
            text-shadow: 0 0 60px rgba(192, 192, 192, 0.25);
        }

        .gate-divider-line {
            width: 60px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--silver-40), transparent);
            margin: 0 auto 32px;
            animation: fadeInUp 1.2s ease forwards;
            animation-delay: 1s;
            opacity: 0;
        }

        .btn-open-gate {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 16px 44px;
            background: transparent;
            color: var(--silver-90);
            border: 1px solid rgba(192, 192, 192, 0.25);
            border-radius: 50px;
            font-family: 'Inter', sans-serif;
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 3px;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.5s var(--transition-smooth);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            animation: fadeInUp 1.2s ease forwards;
            animation-delay: 1.4s;
            opacity: 0;
            -webkit-tap-highlight-color: transparent;
        }

        /* === SECTION 2: QUOTES === */
        .section-quotes {
            text-align: center;
            padding: 32px;
        }

        .quotes-content {
            max-width: 600px;
        }

        .quotes-icon {
            font-size: 2.5rem;
            color: var(--silver-40);
            margin-bottom: 24px;
            opacity: 0.5;
        }

        .quotes-main {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.2rem, 2.5vw, 1.6rem);
            font-style: italic;
            color: var(--silver-80);
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .quotes-author {
            font-family: 'Great Vibes', cursive;
            font-size: clamp(1.3rem, 2.5vw, 1.8rem);
            color: var(--silver-60);
        }

        .quotes-divider {
            width: 50px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--silver-40), transparent);
            margin: 16px auto;
        }

        /* === SECTION 3: PHOTO SLIDER - 9:16 RATIO === */
        .section-photos {
            padding: 0;
        }

        .slider-wrapper {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .slider-container {
            width: 100%;
            max-width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
            background: #000;
        }

        .slider-track {
            display: flex;
            height: 100%;
            transition: transform 0.6s var(--transition-smooth);
        }

        .slider-track img {
            min-width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            background: #000;
        }

        .slider-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 20;
        }

        .slider-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
            transition: all 0.3s;
        }

        .slider-dot.active {
            background: #fff;
            width: 22px;
            border-radius: 8px;
        }

        .slider-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 15;
            transition: all 0.3s;
            font-size: 0.8rem;
        }

        .slider-nav.prev {
            left: 12px;
        }

        .slider-nav.next {
            right: 12px;
        }

        /* === SECTION 4: DETAILS === */
        .section-details {
            padding: 16px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            width: 100%;
            max-width: 650px;
        }

        .detail-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 24px 20px;
            text-align: center;
            transition: transform 0.4s var(--transition-smooth);
        }

        .detail-icon {
            font-size: 1.7rem;
            margin-bottom: 12px;
            color: var(--silver-60);
        }

        .detail-label {
            font-size: 0.6rem;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--silver-60);
            margin-bottom: 6px;
        }

        .detail-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--silver-90);
            line-height: 1.4;
        }

        /* === SECTION 5: RSVP === */
        .section-rsvp {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .rsvp-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 4vw, 2.6rem);
            color: var(--silver-100);
            font-weight: 700;
        }

        .rsvp-subtitle {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1rem;
            font-style: italic;
            color: var(--silver-60);
        }

        .btn-rsvp {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 16px 44px;
            background: var(--silver-100);
            color: #000;
            border: none;
            border-radius: 50px;
            font-family: 'Inter', sans-serif;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.4s var(--transition-bounce);
            box-shadow: 0 12px 35px rgba(192, 192, 192, 0.15);
        }

        .btn-location-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 16px 44px;
            background: transparent;
            color: var(--silver-90);
            border: 1px solid rgba(192, 192, 192, 0.25);
            border-radius: 50px;
            font-family: 'Inter', sans-serif;
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.4s;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        /* === SECTION 6: CLOSING === */
        .section-closing {
            flex-direction: column;
            text-align: center;
            gap: 16px;
        }

        .closing-text {
            font-family: 'Great Vibes', cursive;
            font-size: clamp(2.2rem, 4vw, 3rem);
            color: var(--silver-80);
        }

        .closing-name {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.3rem, 2.5vw, 1.8rem);
            color: var(--silver-100);
            font-weight: 600;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .fullscreen-section {
                padding: 12px;
            }

            .slider-nav {
                width: 34px;
                height: 34px;
            }

            .details-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .detail-card {
                padding: 18px 14px;
            }

            .music-player {
                bottom: 20px;
                right: 20px;
            }
        }

        @media (max-width: 480px) {
            .details-grid {
                grid-template-columns: 1fr;
                max-width: 320px;
            }

            .btn-open-gate,
            .btn-rsvp,
            .btn-location-outline {
                padding: 14px 32px;
                font-size: 0.72rem;
            }
        }
    </style>
</head>

<body>

    <!-- === BACKGROUND LAYERS (SIMPLIFIED) === -->
    <div class="animated-bg"></div>
    <div class="light-rays"></div>
    <div class="grain-overlay"></div>
    <div class="ring-3d ring-1"></div>
    <div class="ring-3d ring-2"></div>
    <div class="mist-container" id="mistContainer"></div>
    <div class="particles-container" id="particlesContainer"></div>

    <!-- === MUSIC PLAYER === -->
    <div class="music-player" id="musicPlayer">
        <button class="music-toggle paused" id="musicToggle" aria-label="Toggle music">
            <i class="fas fa-music"></i>
        </button>
    </div>

    <audio id="bgMusic" preload="none" loop>
        <source src="{{ asset('assets/blessingmaria.mp3') }}" type="audio/mpeg">
    </audio>

    <!-- === MAIN SCROLL CONTAINER === -->
    <div class="scroll-container" id="scrollContainer">

        {{-- SECTION 1: GATE --}}
        <section class="fullscreen-section section-gate" id="sectionGate">
            <div class="gate-content">
                <p class="gate-event-label">The Celebration of Belva 17th Birthday</p>
                <p class="gate-dear">Dear,</p>
                <h1 class="gate-name">{{ $guest->name }}</h1>
                <div class="gate-divider-line"></div>
                <a href="#sectionQuotes" class="btn-open-gate" id="btnOpenGate" onclick="openInvitation(event)">
                    <i class="far fa-envelope-open"></i>
                    <span>Open Invitation</span>
                    <i class="fas fa-chevron-down"></i>
                </a>
            </div>
        </section>

        {{-- SECTION 2: QUOTES --}}
        <section class="fullscreen-section section-quotes" id="sectionQuotes">
            <div class="quotes-content">
                <div class="quotes-icon">
                    <i class="fas fa-feather-alt"></i>
                </div>
                <p class="quotes-main">
                    "In the tapestry of life, every thread of friendship weaves a story of love, laughter, and cherished
                    memories. Today, we gather not just to celebrate a milestone, but to honor the beautiful soul that
                    has touched our hearts in ways words cannot express."
                </p>
                <div class="quotes-divider"></div>
                <p class="quotes-author">— With Love, Belva</p>
            </div>
        </section>

        {{-- SECTION 3: PHOTO SLIDER - 9:16 FULLSCREEN --}}
        <section class="fullscreen-section section-photos" id="sectionPhotos">
            @php
                $photos = [];
                if ($guest->event->event_photo_1 ?? false) {
                    $photos[] = asset('storage/' . $guest->event->event_photo_1);
                }
                if ($guest->event->event_photo_2 ?? false) {
                    $photos[] = asset('storage/' . $guest->event->event_photo_2);
                }
                if ($guest->event->event_photo_3 ?? false) {
                    $photos[] = asset('storage/' . $guest->event->event_photo_3);
                }
            @endphp

            @if (count($photos) > 0)
                <div class="slider-wrapper">
                    <div class="slider-container" id="photoSlider">
                        <div class="slider-track" id="sliderTrack">
                            @foreach ($photos as $photo)
                                <img src="{{ $photo }}" alt="Event Photo" loading="eager" decoding="async"
                                    fetchpriority="high">
                            @endforeach
                        </div>
                        @if (count($photos) > 1)
                            <button class="slider-nav prev" onclick="slidePhoto(-1)" aria-label="Previous">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="slider-nav next" onclick="slidePhoto(1)" aria-label="Next">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                            <div class="slider-dots" id="sliderDots">
                                @foreach ($photos as $index => $photo)
                                    <button class="slider-dot {{ $index === 0 ? 'active' : '' }}"
                                        onclick="goToSlide({{ $index }})"
                                        aria-label="Slide {{ $index + 1 }}"></button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </section>

        {{-- SECTION 4: DETAILS --}}
        <section class="fullscreen-section section-details" id="sectionDetails">
            <div class="details-grid">
                <div class="detail-card">
                    <div class="detail-icon"><i class="far fa-calendar-alt"></i></div>
                    <p class="detail-label">Date</p>
                    <p class="detail-value">
                        {{ \Carbon\Carbon::parse($guest->event->event_date ?? now())->format('d M Y') }}</p>
                </div>
                <div class="detail-card">
                    <div class="detail-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <p class="detail-label">Venue & Time</p>
                    <p class="detail-value">{{ $guest->event->venue ?? 'Secret Location' }}</p>
                    <p class="detail-value">{{ $guest->event->event_time ?? 'To be announced' }}</p>
                </div>
                @if ($guest->event->dresscode ?? false)
                    <div class="detail-card">
                        <div class="detail-icon"><i class="fas fa-tshirt"></i></div>
                        <p class="detail-label">Dress Code</p>
                        <p class="detail-value">{{ $guest->event->dresscode }}</p>
                    </div>
                @endif
            </div>
        </section>

        {{-- SECTION 5: RSVP --}}
        <section class="fullscreen-section section-rsvp" id="sectionRsvp">
            <h2 class="rsvp-title">Confirm Attendance</h2>
            <p class="rsvp-subtitle">We would be honored by your presence</p>

            @if ($guest->event->no_wa_confirmation ?? false)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $guest->event->no_wa_confirmation) }}?text={{ urlencode('Hello! I would like to confirm my attendance for ' . ($guest->event->title ?? 'the event') . '. - ' . $guest->name) }}"
                    target="_blank" rel="noopener" class="btn-rsvp">
                    <i class="fab fa-whatsapp"></i>
                    <span>RSVP via WhatsApp</span>
                </a>
            @endif

            @if ($guest->event->link_googlemaps ?? false)
                <a href="{{ $guest->event->link_googlemaps }}" target="_blank" rel="noopener"
                    class="btn-location-outline">
                    <i class="fas fa-map-marked-alt"></i>
                    <span>View Location</span>
                    <i class="fas fa-external-link-alt" style="font-size:0.7rem;"></i>
                </a>
            @endif
        </section>

        {{-- SECTION 6: CLOSING --}}
        <section class="fullscreen-section section-closing" id="sectionClosing">
            <p class="closing-text">
                <i class="fas fa-heart" style="margin-right: 8px; font-size: 0.65em;"></i>
                With Love & Gratitude
                <i class="fas fa-heart" style="margin-left: 8px; font-size: 0.65em;"></i>
            </p>
            <p class="closing-name">{{ $guest->event->title ?? 'Belva' }}</p>
            <p style="color: var(--silver-60); font-size: 0.8rem;">
                <i class="far fa-smile" style="margin-right: 4px;"></i>
                Thank you for being part of this special moment
            </p>
        </section>

    </div>

    <script>
        // ============================================
        // OPTIMIZED MUSIC PLAYER
        // ============================================
        var bgMusic = document.getElementById('bgMusic');
        var musicPlayer = document.getElementById('musicPlayer');
        var musicToggle = document.getElementById('musicToggle');
        var isMusicPlaying = false;

        function openInvitation(e) {
            e.preventDefault();
            if (bgMusic) {
                bgMusic.load();
                var p = bgMusic.play();
                if (p) p.then(function() {
                    isMusicPlaying = true;
                    updateBtn();
                }).catch(function() {
                    isMusicPlaying = false;
                    updateBtn();
                });
            }
            musicPlayer.classList.add('active');
            document.getElementById('sectionQuotes').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function toggleMusic() {
            if (!bgMusic) return;
            if (isMusicPlaying) {
                bgMusic.pause();
                isMusicPlaying = false;
            } else {
                var p = bgMusic.play();
                if (p) p.then(function() {
                    isMusicPlaying = true;
                }).catch(function() {
                    isMusicPlaying = false;
                });
                isMusicPlaying = true;
            }
            updateBtn();
        }

        function updateBtn() {
            if (isMusicPlaying) {
                musicToggle.classList.remove('paused');
                musicToggle.classList.add('playing');
                musicToggle.innerHTML = '<i class="fas fa-pause"></i>';
            } else {
                musicToggle.classList.remove('playing');
                musicToggle.classList.add('paused');
                musicToggle.innerHTML = '<i class="fas fa-play"></i>';
            }
        }

        musicToggle && musicToggle.addEventListener('click', toggleMusic);
        bgMusic && bgMusic.addEventListener('play', function() {
            isMusicPlaying = true;
            updateBtn();
        });
        bgMusic && bgMusic.addEventListener('pause', function() {
            isMusicPlaying = false;
            updateBtn();
        });

        // ============================================
        // OPTIMIZED PHOTO SLIDER
        // ============================================
        var currentSlide = 0;
        var totalSlides = {{ count($photos) }};
        var autoSlideInterval = null;

        function updateSlider() {
            var track = document.getElementById('sliderTrack');
            var dots = document.querySelectorAll('.slider-dot');
            if (track) track.style.transform = 'translateX(-' + (currentSlide * 100) + '%)';
            if (dots.length) {
                for (var i = 0; i < dots.length; i++) {
                    dots[i].classList.toggle('active', i === currentSlide);
                }
            }
        }

        function slidePhoto(d) {
            currentSlide = (currentSlide + d + totalSlides) % totalSlides;
            updateSlider();
            resetAutoSlide();
        }

        function goToSlide(i) {
            currentSlide = i;
            updateSlider();
            resetAutoSlide();
        }

        function startAutoSlide() {
            if (totalSlides > 1) {
                autoSlideInterval = setInterval(function() {
                    currentSlide = (currentSlide + 1) % totalSlides;
                    updateSlider();
                }, 4500);
            }
        }

        function resetAutoSlide() {
            if (autoSlideInterval) clearInterval(autoSlideInterval);
            startAutoSlide();
        }

        // Touch swipe
        (function() {
            var s = document.getElementById('photoSlider');
            if (!s) return;
            var sx = 0;
            s.addEventListener('touchstart', function(e) {
                sx = e.changedTouches[0].screenX;
            }, {
                passive: true
            });
            s.addEventListener('touchend', function(e) {
                var d = sx - e.changedTouches[0].screenX;
                if (Math.abs(d) > 40) slidePhoto(d > 0 ? 1 : -1);
            });
        })();

        if (totalSlides > 1) startAutoSlide();

        // ============================================
        // LIGHTWEIGHT MIST & PARTICLES
        // ============================================
        (function() {
            var c = document.getElementById('mistContainer');
            if (c)
                for (var i = 0; i < 6; i++) {
                    var m = document.createElement('div');
                    m.className = 'mist';
                    m.style.cssText = 'width:' + (Math.random() * 200 + 120) + 'px;height:' + (Math.random() * 200 +
                        120) + 'px;left:' + (Math.random() * 90) + '%;animation-duration:' + (Math.random() * 18 +
                        14) + 's;animation-delay:' + (Math.random() * 12) + 's;';
                    c.appendChild(m);
                }
        })();

        (function() {
            var c = document.getElementById('particlesContainer');
            if (c)
                for (var i = 0; i < 25; i++) {
                    var p = document.createElement('div');
                    p.className = 'particle';
                    p.style.cssText = 'width:' + (Math.random() * 2.5 + 1) + 'px;height:' + (Math.random() * 2.5 + 1) +
                        'px;left:' + (Math.random() * 95) + '%;animation-duration:' + (Math.random() * 10 + 8) +
                        's;animation-delay:' + (Math.random() * 8) + 's;';
                    c.appendChild(p);
                }
        })();

        // ============================================
        // PARALLAX RINGS (throttled)
        // ============================================
        (function() {
            var ticking = false;
            document.addEventListener('mousemove', function(e) {
                if (!ticking) {
                    requestAnimationFrame(function() {
                        var rings = document.querySelectorAll('.ring-3d');
                        var x = (e.clientX / window.innerWidth - 0.5) * 30;
                        var y = (e.clientY / window.innerHeight - 0.5) * 30;
                        for (var i = 0; i < rings.length; i++) {
                            var f = (i + 1) * 0.4;
                            rings[i].style.transform = 'translate(' + (x * f) + 'px, ' + (y * f) +
                                'px) rotateX(15deg) rotateY(10deg)';
                        }
                        ticking = false;
                    });
                    ticking = true;
                }
            }, {
                passive: true
            });
        })();

        // ============================================
        // INITIAL LOAD
        // ============================================
        window.addEventListener('load', function() {
            document.body.style.opacity = '1';
        });
        document.body.style.opacity = '0';
        document.body.style.transition = 'opacity 0.6s ease';
    </script>

</body>

</html>
