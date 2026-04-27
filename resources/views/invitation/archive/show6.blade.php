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
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,500;0,700;1,400&family=Great+Vibes&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --silver-100: #ffffff;
            --silver-90: #e8e8ed;
            --silver-80: #d1d1d6;
            --silver-60: #a1a1a6;
            --silver-40: #6e6e73;
            --silver-0: #000000;
            --glass-bg: rgba(28, 28, 30, 0.5);
            --glass-border: rgba(255, 255, 255, 0.08);
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
            cursor: default;
            overflow-x: hidden;
            height: 100%;
            position: relative;
            -webkit-tap-highlight-color: transparent;
            -webkit-user-select: none;
            user-select: none;
        }

        /* === BACKGROUND BASE === */
        .bg-base {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -3;
            pointer-events: none;
            background: #0a0a0a;
            overflow: hidden;
        }

        .bg-gradient {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(ellipse at 30% 20%, rgba(80, 80, 100, 0.25) 0%, transparent 55%),
                radial-gradient(ellipse at 70% 60%, rgba(60, 60, 80, 0.2) 0%, transparent 55%),
                radial-gradient(ellipse at 50% 90%, rgba(50, 50, 70, 0.15) 0%, transparent 50%);
            animation: gradientShift 18s ease-in-out infinite;
        }

        @keyframes gradientShift {

            0%,
            100% {
                opacity: 0.7;
            }

            25% {
                opacity: 1;
            }

            50% {
                opacity: 0.6;
            }

            75% {
                opacity: 0.9;
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
            opacity: 0.035;
            mix-blend-mode: overlay;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
            background-repeat: repeat;
            background-size: 150px 150px;
        }

        /* === FALLING DIAMONDS === */
        .diamonds-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
            contain: layout style paint;
        }

        .diamond {
            position: absolute;
            width: 12px;
            height: 12px;
            background: rgba(200, 200, 220, 0.25);
            transform: rotate(45deg);
            animation: diamondFall linear infinite;
            will-change: transform, opacity;
            border: 1px solid rgba(220, 220, 240, 0.15);
            box-shadow: 0 0 6px rgba(200, 200, 220, 0.2), inset 0 0 4px rgba(255, 255, 255, 0.1);
        }

        .diamond.small {
            width: 6px;
            height: 6px;
            opacity: 0.5;
            box-shadow: 0 0 3px rgba(200, 200, 220, 0.15);
        }

        .diamond.large {
            width: 18px;
            height: 18px;
            opacity: 0.6;
            box-shadow: 0 0 12px rgba(200, 200, 220, 0.3), inset 0 0 6px rgba(255, 255, 255, 0.15);
        }

        .diamond.sparkle {
            width: 4px;
            height: 4px;
            background: rgba(240, 240, 255, 0.8);
            border: none;
            box-shadow: 0 0 8px rgba(220, 220, 255, 0.7), 0 0 15px rgba(200, 200, 230, 0.4);
            animation: diamondSparkle linear infinite;
        }

        @keyframes diamondFall {
            0% {
                transform: translateY(-20vh) rotate(45deg) translateX(0);
                opacity: 0;
            }

            5% {
                opacity: 0.7;
            }

            40% {
                opacity: 0.5;
            }

            70% {
                opacity: 0.2;
            }

            100% {
                transform: translateY(110vh) rotate(225deg) translateX(40px);
                opacity: 0;
            }
        }

        @keyframes diamondSparkle {
            0% {
                transform: translateY(-10vh) rotate(45deg) scale(0);
                opacity: 0;
            }

            3% {
                opacity: 0.9;
                transform: translateY(0vh) rotate(45deg) scale(1.2);
            }

            6% {
                opacity: 0.7;
                transform: translateY(5vh) rotate(135deg) scale(0.8);
            }

            12% {
                opacity: 0.3;
                transform: translateY(15vh) rotate(225deg) scale(1);
            }

            25% {
                opacity: 0;
                transform: translateY(40vh) rotate(315deg) scale(0.2);
            }

            100% {
                opacity: 0;
                transform: translateY(60vh) rotate(405deg) scale(0);
            }
        }

        /* === FLOATING MIST === */
        .mist-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
            contain: layout style paint;
        }

        .mist {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(ellipse at center, rgba(200, 200, 215, 0.08) 0%, transparent 60%);
            animation: mistFloat linear infinite;
            filter: blur(60px);
            mix-blend-mode: screen;
            will-change: transform, opacity;
            transform: translateZ(0);
        }

        @keyframes mistFloat {
            0% {
                transform: translate3d(0, 100vh, 0) scale(0.5);
                opacity: 0;
            }

            10% {
                opacity: 0.6;
            }

            40% {
                opacity: 0.25;
            }

            70% {
                opacity: 0.08;
            }

            100% {
                transform: translate3d(15vw, -25vh, 0) scale(1.6);
                opacity: 0;
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
            transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            pointer-events: none;
        }

        .music-player.active {
            opacity: 1;
            transform: scale(1);
            pointer-events: auto;
        }

        .music-toggle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            color: var(--silver-90);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.4s ease;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            -webkit-tap-highlight-color: transparent;
            outline: none;
        }

        .music-toggle:active {
            transform: scale(0.95);
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

        .music-toggle.paused i {
            animation: none;
        }

        .music-toggle::before,
        .music-toggle::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            border: 1px solid rgba(192, 192, 192, 0.15);
            animation: visualizerRing 2s ease-out infinite;
            opacity: 0;
        }

        .music-toggle::after {
            animation-delay: 1s;
        }

        .music-toggle.playing::before,
        .music-toggle.playing::after {
            opacity: 1;
        }

        @keyframes visualizerRing {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            100% {
                transform: scale(1.6);
                opacity: 0;
            }
        }

        /* === MAIN SCROLL === */
        .scroll-container {
            position: relative;
            z-index: 1;
            height: 100%;
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
            padding: 20px;
            overflow: hidden;
            contain: layout style paint;
        }

        /* === SECTION 1: GATE === */
        .section-gate {
            flex-direction: column;
            text-align: center;
        }

        .gate-content {
            position: relative;
            z-index: 2;
            animation: fadeInUp 1.5s ease forwards;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .gate-event-label {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(0.9rem, 2vw, 1.1rem);
            font-weight: 300;
            letter-spacing: 8px;
            text-transform: uppercase;
            color: var(--silver-60);
            margin-bottom: 30px;
            animation: fadeInUp 1.2s ease forwards;
            animation-delay: 0.2s;
            opacity: 0;
        }

        .gate-dear {
            font-family: 'Great Vibes', cursive;
            font-size: clamp(1.8rem, 4vw, 2.6rem);
            color: var(--silver-80);
            margin-bottom: 10px;
            animation: fadeInUp 1.2s ease forwards;
            animation-delay: 0.4s;
            opacity: 0;
            font-weight: 400;
        }

        .gate-name {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.8rem, 7vw, 5rem);
            font-weight: 700;
            color: var(--silver-100);
            letter-spacing: -1px;
            line-height: 1.1;
            margin-bottom: 40px;
            animation: fadeInUp 1.2s ease forwards;
            animation-delay: 0.6s;
            opacity: 0;
            text-shadow: 0 0 60px rgba(192, 192, 192, 0.2);
        }

        .gate-divider-line {
            width: 80px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--silver-40), transparent);
            margin: 0 auto 40px;
            animation: fadeInUp 1.2s ease forwards;
            animation-delay: 0.8s;
            opacity: 0;
        }

        .btn-open-gate {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            padding: 18px 48px;
            background: transparent;
            color: var(--silver-90);
            border: 1px solid rgba(192, 192, 192, 0.25);
            border-radius: 50px;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 4px;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.5s ease;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            animation: fadeInUp 1.2s ease forwards;
            animation-delay: 1s;
            opacity: 0;
            -webkit-tap-highlight-color: transparent;
            outline: none;
        }

        .btn-open-gate:active {
            transform: scale(0.97);
        }

        .btn-open-gate:hover {
            border-color: var(--silver-80);
            color: var(--silver-100);
            box-shadow: 0 15px 40px rgba(192, 192, 192, 0.1);
        }

        /* === SECTION 2: QUOTES === */
        .section-quotes {
            text-align: center;
            padding: 40px;
        }

        .quotes-content {
            max-width: 650px;
            animation: fadeInUp 1s ease forwards;
            opacity: 0;
        }

        .quotes-content.visible {
            opacity: 1;
        }

        .quotes-icon {
            font-size: 2.5rem;
            color: var(--silver-40);
            margin-bottom: 25px;
            opacity: 0.5;
        }

        .quotes-main {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.3rem, 3vw, 1.8rem);
            font-style: italic;
            color: var(--silver-80);
            line-height: 1.7;
            margin-bottom: 25px;
            letter-spacing: 0.5px;
        }

        .quotes-author {
            font-family: 'Great Vibes', cursive;
            font-size: clamp(1.5rem, 3vw, 2rem);
            color: var(--silver-60);
        }

        .quotes-divider {
            width: 60px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--silver-40), transparent);
            margin: 20px auto;
        }

        /* === SECTION 3: PHOTO SLIDER 9:16 === */
        .section-photos {
            padding: 10px;
        }

        .photo-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            height: 100%;
            justify-content: center;
            gap: 10px;
        }

        .slider-container {
            width: auto;
            height: 75vh;
            height: 75dvh;
            max-height: 85vh;
            max-height: 85dvh;
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            aspect-ratio: 9 / 16;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.05);
            contain: layout style paint;
        }

        @media (min-width: 769px) {
            .slider-container {
                height: 80vh;
                height: 80dvh;
                max-height: 90vh;
                max-height: 90dvh;
            }
        }

        .slider-track {
            display: flex;
            height: 100%;
            transition: transform 0.6s cubic-bezier(0.22, 0.61, 0.36, 1);
        }

        .slider-track img {
            min-width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            -webkit-user-drag: none;
            content-visibility: auto;
        }

        .slider-dots {
            display: flex;
            gap: 8px;
            justify-content: center;
            flex-shrink: 0;
        }

        .slider-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--silver-40);
            border: 1px solid rgba(255, 255, 255, 0.15);
            cursor: pointer;
            transition: all 0.3s;
            -webkit-tap-highlight-color: transparent;
            outline: none;
            padding: 0;
        }

        .slider-dot.active {
            background: var(--silver-100);
            width: 24px;
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
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: background 0.3s;
            font-size: 0.8rem;
            -webkit-tap-highlight-color: transparent;
            outline: none;
        }

        .slider-nav:active {
            background: rgba(0, 0, 0, 0.8);
        }

        .slider-nav.prev {
            left: 10px;
        }

        .slider-nav.next {
            right: 10px;
        }

        /* === SECTION 4: DETAILS === */
        .section-details {
            padding: 20px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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
            padding: 25px 20px;
            text-align: center;
            transition: transform 0.3s ease, border-color 0.3s;
            position: relative;
            overflow: hidden;
            contain: layout style paint;
        }

        .detail-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        }

        .detail-icon {
            font-size: 1.8rem;
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
            font-size: clamp(2rem, 5vw, 3rem);
            color: var(--silver-100);
            font-weight: 700;
            text-shadow: 0 0 40px rgba(192, 192, 192, 0.1);
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
            gap: 10px;
            padding: 16px 45px;
            background: var(--silver-100);
            color: var(--silver-0);
            border: none;
            border-radius: 50px;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.3s ease, box-shadow 0.3s;
            box-shadow: 0 10px 30px rgba(192, 192, 192, 0.15);
            -webkit-tap-highlight-color: transparent;
            outline: none;
        }

        .btn-rsvp:active {
            transform: scale(0.96);
        }

        .btn-location-outline {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 45px;
            background: transparent;
            color: var(--silver-90);
            border: 1px solid rgba(192, 192, 192, 0.25);
            border-radius: 50px;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: none;
            transition: border-color 0.3s, color 0.3s;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            -webkit-tap-highlight-color: transparent;
            outline: none;
        }

        .btn-location-outline:hover {
            border-color: var(--silver-80);
            color: var(--silver-100);
        }

        /* === SECTION 6: CLOSING === */
        .section-closing {
            flex-direction: column;
            text-align: center;
            gap: 16px;
        }

        .closing-text {
            font-family: 'Great Vibes', cursive;
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            color: var(--silver-80);
            font-weight: 400;
            text-shadow: 0 0 30px rgba(192, 192, 192, 0.1);
        }

        .closing-name {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.5rem, 3vw, 2rem);
            color: var(--silver-100);
            font-weight: 600;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .fullscreen-section {
                padding: 12px;
            }

            .slider-container {
                height: 70vh;
                height: 70dvh;
                max-height: 80vh;
                max-height: 80dvh;
                border-radius: 12px;
            }

            .slider-nav {
                width: 32px;
                height: 32px;
                font-size: 0.7rem;
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

            .music-toggle {
                width: 44px;
                height: 44px;
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .slider-container {
                height: 65vh;
                height: 65dvh;
                max-height: 75vh;
                max-height: 75dvh;
            }

            .details-grid {
                grid-template-columns: 1fr;
                max-width: 320px;
            }

            .btn-open-gate,
            .btn-rsvp,
            .btn-location-outline {
                padding: 14px 30px;
                font-size: 0.75rem;
                letter-spacing: 2px;
            }
        }
    </style>
</head>

<body>

    <!-- === BACKGROUND === -->
    <div class="bg-base">
        <div class="bg-gradient"></div>
    </div>
    <div class="diamonds-container" id="diamondsContainer"></div>
    <div class="grain-overlay"></div>
    <div class="mist-container" id="mistContainer"></div>

    <!-- === MUSIC PLAYER === -->
    <div class="music-player" id="musicPlayer">
        <button class="music-toggle paused" id="musicToggle" aria-label="Toggle music">
            <i class="fas fa-music"></i>
        </button>
    </div>

    <audio id="bgMusic" preload="auto" loop>
        <source src="{{ asset('assets/blessingmaria.mp3') }}" type="audio/mpeg">
    </audio>

    <!-- === MAIN SCROLL === -->
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
            <div class="quotes-content" id="quotesContent">
                <div class="quotes-icon"><i class="fas fa-feather-alt"></i></div>
                <p class="quotes-main">
                    "In the tapestry of life, every thread of friendship weaves a story of love, laughter, and cherished
                    memories. Today, we gather not just to celebrate a milestone, but to honor the beautiful soul that
                    has touched our hearts in ways words cannot express."
                </p>
                <div class="quotes-divider"></div>
                <p class="quotes-author">— With Love, Belva</p>
            </div>
        </section>

        {{-- SECTION 3: PHOTO SLIDER 9:16 --}}
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
                <div class="photo-wrapper">
                    <div class="slider-container" id="photoSlider">
                        <div class="slider-track" id="sliderTrack">
                            @foreach ($photos as $photo)
                                <img src="{{ $photo }}" alt="Event Photo" loading="lazy" decoding="async">
                            @endforeach
                        </div>
                        @if (count($photos) > 1)
                            <button class="slider-nav prev" onclick="slidePhoto(-1)" aria-label="Previous"><i
                                    class="fas fa-chevron-left"></i></button>
                            <button class="slider-nav next" onclick="slidePhoto(1)" aria-label="Next"><i
                                    class="fas fa-chevron-right"></i></button>
                        @endif
                    </div>
                    @if (count($photos) > 1)
                        <div class="slider-dots" id="sliderDots">
                            @foreach ($photos as $index => $photo)
                                <button class="slider-dot {{ $index === 0 ? 'active' : '' }}"
                                    onclick="goToSlide({{ $index }})"
                                    aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                        </div>
                    @endif
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
                    <p class="detail-label">Venue</p>
                    <p class="detail-value">{{ $guest->event->venue ?? 'Secret Location' }}</p>
                    <p class="detail-value" style="font-size:0.95rem;margin-top:4px;">
                        {{ $guest->event->event_time ?? 'To be announced' }}</p>
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
                    <i class="fab fa-whatsapp"></i><span>RSVP via WhatsApp</span>
                </a>
            @endif
            @if ($guest->event->link_googlemaps ?? false)
                <a href="{{ $guest->event->link_googlemaps }}" target="_blank" rel="noopener"
                    class="btn-location-outline">
                    <i class="fas fa-map-marked-alt"></i><span>View Location</span><i class="fas fa-external-link-alt"
                        style="font-size:0.7rem;"></i>
                </a>
            @endif
        </section>

        {{-- SECTION 6: CLOSING --}}
        <section class="fullscreen-section section-closing" id="sectionClosing">
            <p class="closing-text"><i class="fas fa-heart" style="margin-right:10px;font-size:0.7em;"></i>With Love
                & Gratitude<i class="fas fa-heart" style="margin-left:10px;font-size:0.7em;"></i></p>
            <p class="closing-name">{{ $guest->event->title ?? 'Belva' }}</p>
            <p style="color:var(--silver-60);font-size:0.85rem;"><i class="far fa-smile"
                    style="margin-right:5px;"></i>Thank you for being part of this special moment</p>
        </section>

    </div>

    <script>
        var bgMusic = document.getElementById('bgMusic');
        var musicPlayer = document.getElementById('musicPlayer');
        var musicToggle = document.getElementById('musicToggle');
        var isMusicPlaying = false;

        function openInvitation(e) {
            e.preventDefault();
            if (bgMusic) {
                var p = bgMusic.play();
                if (p) {
                    p.then(function() {
                        isMusicPlaying = true;
                        updateMusicBtn();
                    }).catch(function() {
                        isMusicPlaying = false;
                        updateMusicBtn();
                    });
                }
            }
            musicPlayer.classList.add('active');
            smoothScrollTo('sectionQuotes');
        }

        function toggleMusic() {
            if (!bgMusic) return;
            if (isMusicPlaying) {
                bgMusic.pause();
                isMusicPlaying = false;
            } else {
                var p = bgMusic.play();
                if (p) {
                    p.then(function() {
                        isMusicPlaying =
                            true;
                    }).catch(function() {
                        isMusicPlaying = false;
                    });
                }
                isMusicPlaying = true;
            }
            updateMusicBtn();
        }

        function updateMusicBtn() {
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
        if (musicToggle) musicToggle.addEventListener('click', toggleMusic);
        if (bgMusic) {
            bgMusic.addEventListener('play', function() {
                isMusicPlaying = true;
                updateMusicBtn();
            });
            bgMusic.addEventListener('pause', function() {
                isMusicPlaying = false;
                updateMusicBtn();
            });
            bgMusic.addEventListener('ended', function() {
                isMusicPlaying = false;
                updateMusicBtn();
            });
        }

        function smoothScrollTo(id) {
            var s = document.getElementById(id);
            if (s) s.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        var currentSlide = 0;
        var totalSlides = {{ count($photos) }};
        var autoSlideTimer = null;

        function updateSlider() {
            var t = document.getElementById('sliderTrack');
            var d = document.querySelectorAll(
                '.slider-dot');
            if (t) t.style.transform = 'translateX(-' + (currentSlide * 100) + '%)';
            d.forEach(function(dot, i) {
                dot.classList.toggle('active', i === currentSlide);
            });
        }

        function slidePhoto(dir) {
            currentSlide = (currentSlide + dir + totalSlides) % totalSlides;
            updateSlider();
            resetAutoSlide();
        }

        function goToSlide(i) {
            currentSlide = i;
            updateSlider();
            resetAutoSlide();
        }

        function startAutoSlide() {
            if (totalSlides > 1) autoSlideTimer = setInterval(function() {
                currentSlide = (
                    currentSlide + 1) % totalSlides;
                updateSlider();
            }, 4000);
        }

        function resetAutoSlide() {
            if (autoSlideTimer) clearInterval(autoSlideTimer);
            startAutoSlide();
        }
        if (totalSlides > 1) startAutoSlide();
        (function() {
            var s = document.getElementById('photoSlider');
            if (!s) return;
            var sx = 0,
                ex = 0;
            s.addEventListener('touchstart', function(e) {
                sx = e.changedTouches[0].screenX;
            }, {
                passive: true
            });
            s.addEventListener('touchend', function(e) {
                ex = e.changedTouches[0].screenX;
                if (Math.abs(sx - ex) > 50)
                    slidePhoto(sx > ex ? 1 : -1);
            });
        })();
        (function() {
            var q = document.getElementById('quotesContent');
            if (!q) return;
            new IntersectionObserver(
                function(e) {
                    if (e[0].isIntersecting) q.classList.add('visible');
                }, {
                    threshold: 0.4
                }).observe(
                q);
        })();

        // FALLING DIAMONDS GENERATOR
        (function() {
            var c = document.getElementById('diamondsContainer');
            if (!c) return;
            var frag = document.createDocumentFragment();
            // Regular diamonds
            for (var i = 0; i < 20; i++) {
                var d = document.createElement('div');
                d.classList.add('diamond');
                var r = Math.random();
                if (r < 0.15) d.classList.add('large');
                else if (r < 0.4) d.classList.add('small');
                d.style.left = (Math.random() * 95) + '%';
                d.style.animationDuration = (Math.random() * 18 + 10) + 's';
                d.style.animationDelay = (Math.random() * 15) + 's';
                frag.appendChild(d);
            }
            // Sparkle diamonds
            for (var j = 0; j < 12; j++) {
                var s = document.createElement('div');
                s.classList.add('diamond', 'sparkle');
                s.style.left = (Math.random() * 95) + '%';
                s.style.animationDuration = (Math.random() * 6 + 4) + 's';
                s.style.animationDelay = (Math.random() * 8) + 's';
                frag.appendChild(s);
            }
            c.appendChild(frag);
        })();

        // MIST GENERATOR
        (function() {
            var c = document.getElementById('mistContainer');
            if (!c) return;
            var frag = document.createDocumentFragment();
            for (var i = 0; i < 5; i++) {
                var m = document.createElement('div');
                m.classList.add('mist');
                m.style.width = (Math.random() * 200 + 150) + 'px';
                m.style.height = m.style.width;
                m.style.left = (Math.random() * 100) + '%';
                m.style.animationDuration = (Math.random() * 20 + 16) + 's';
                m.style.animationDelay = (Math.random() * 16) + 's';
                frag.appendChild(m);
            }
            c.appendChild(frag);
        })();

        // ANIMATION OBSERVER
        (function() {
            var obs = new IntersectionObserver(function(e) {
                e.forEach(function(en) {
                    if (en.isIntersecting) {
                        en
                            .target.style.opacity = '1';
                        en.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.3
            });
            document.querySelectorAll('.detail-card, .rsvp-title, .rsvp-subtitle, .closing-text, .closing-name')
                .forEach(
                    function(el) {
                        el.style.opacity = '0';
                        el.style.transform = 'translateY(20px)';
                        el.style.transition = 'all 0.6s ease';
                        obs.observe(el);
                    });
        })();

        document.addEventListener('keydown', function(e) {
            if (totalSlides > 1) {
                if (e.key === 'ArrowRight')
                    slidePhoto(1);
                else if (e.key === 'ArrowLeft') slidePhoto(-1);
            }
        });
        window.addEventListener('load', function() {
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.5s ease';
            requestAnimationFrame(function() {
                document.body.style.opacity = '1';
            });
        });
    </script>

</body>

</html>
