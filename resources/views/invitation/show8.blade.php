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
            scroll-behavior: auto;
            overflow-y: auto;
            scrollbar-width: none;
            height: 100%;
            -webkit-overflow-scrolling: auto;
            overscroll-behavior: none;
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
            overflow: hidden;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            -webkit-tap-highlight-color: transparent;
            -webkit-user-select: none;
            user-select: none;
            touch-action: pan-y;
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
            width: 0;
            height: 0;
            border-style: solid;
            will-change: transform, opacity;
            animation: diamondFall linear infinite;
            filter: drop-shadow(0 0 4px rgba(200, 200, 220, 0.3));
        }

        /* Diamond shape using CSS borders - creates a true diamond/rhombus */
        .diamond::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(45deg);
            background: rgba(200, 200, 220, 0.25);
            border: 1px solid rgba(220, 220, 240, 0.2);
            box-shadow: 0 0 8px rgba(200, 200, 220, 0.2), inset 0 0 5px rgba(255, 255, 255, 0.1);
        }

        .diamond.small::before {
            width: 8px;
            height: 8px;
            background: rgba(200, 200, 220, 0.35);
            box-shadow: 0 0 5px rgba(200, 200, 220, 0.25), inset 0 0 3px rgba(255, 255, 255, 0.1);
        }

        .diamond.large::before {
            width: 22px;
            height: 22px;
            background: rgba(200, 200, 220, 0.3);
            border: 1.5px solid rgba(220, 220, 240, 0.25);
            box-shadow: 0 0 15px rgba(200, 200, 220, 0.35), inset 0 0 8px rgba(255, 255, 255, 0.15);
        }

        .diamond.sparkle::before {
            width: 5px;
            height: 5px;
            background: rgba(240, 240, 255, 0.9);
            border: none;
            box-shadow: 0 0 10px rgba(220, 220, 255, 0.8), 0 0 20px rgba(200, 200, 230, 0.5), 0 0 30px rgba(180, 180, 210, 0.3);
            animation: sparkleInner 2s ease-in-out infinite;
        }

        @keyframes sparkleInner {

            0%,
            100% {
                transform: translate(-50%, -50%) rotate(45deg) scale(1);
                opacity: 0.8;
            }

            50% {
                transform: translate(-50%, -50%) rotate(45deg) scale(1.5);
                opacity: 1;
            }
        }

        @keyframes diamondFall {
            0% {
                transform: translateY(-20vh) translateX(0) rotate(0deg);
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
                transform: translateY(110vh) translateX(40px) rotate(360deg);
                opacity: 0;
            }
        }

        .diamond.sparkle {
            animation: diamondSparkle linear infinite;
        }

        @keyframes diamondSparkle {
            0% {
                transform: translateY(-10vh) translateX(0) rotate(0deg);
                opacity: 0;
            }

            3% {
                opacity: 1;
                transform: translateY(0vh) translateX(5px) rotate(90deg);
            }

            6% {
                opacity: 0.8;
                transform: translateY(5vh) translateX(-5px) rotate(180deg);
            }

            12% {
                opacity: 0.4;
                transform: translateY(15vh) translateX(3px) rotate(270deg);
            }

            25% {
                opacity: 0;
                transform: translateY(40vh) translateX(-3px) rotate(360deg);
            }

            100% {
                opacity: 0;
                transform: translateY(60vh) translateX(0) rotate(450deg);
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

        /* === MAIN SCROLL CONTAINER === */
        .scroll-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            transition: transform 0.45s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: transform;
        }

        .scroll-container.scrolling-fast {
            transition: transform 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .fullscreen-section {
            height: 100vh;
            height: 100dvh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 0;
            overflow: hidden;
        }

        /* === FADE TRANSITION === */
        .fade-section {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .fade-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* === SECTION 1: GATE === */
        .section-gate {
            flex-direction: column;
            text-align: center;
            padding: 20px;
        }

        .gate-content {
            position: relative;
            z-index: 2;
        }

        .gate-event-label {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(0.9rem, 2vw, 1.1rem);
            font-weight: 300;
            letter-spacing: 8px;
            text-transform: uppercase;
            color: var(--silver-60);
            margin-bottom: 30px;
        }

        .gate-dear {
            font-family: 'Great Vibes', cursive;
            font-size: clamp(1.8rem, 4vw, 2.6rem);
            color: var(--silver-80);
            margin-bottom: 10px;
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
            text-shadow: 0 0 60px rgba(192, 192, 192, 0.2);
        }

        .gate-divider-line {
            width: 80px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--silver-40), transparent);
            margin: 0 auto 40px;
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

        /* === SECTION 3: PHOTO SLIDER FULLSCREEN === */
        .section-photos {
            padding: 0;
        }

        .photo-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            height: 100%;
            justify-content: center;
            gap: 12px;
        }

        .slider-container {
            width: 100%;
            height: 82vh;
            height: 82dvh;
            max-height: 88vh;
            max-height: 88dvh;
            position: relative;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.5);
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.04);
        }

        @media (min-width: 769px) {
            .slider-container {
                width: auto;
                height: 85vh;
                height: 85dvh;
                max-height: 92vh;
                max-height: 92dvh;
                aspect-ratio: 9 / 16;
                border-radius: 18px;
            }
        }

        @media (max-width: 768px) {
            .slider-container {
                border-radius: 0;
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
        }

        .slider-dots {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-shrink: 0;
            position: absolute;
            bottom: 18px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 15;
        }

        .slider-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
            transition: all 0.3s;
            -webkit-tap-highlight-color: transparent;
            outline: none;
            padding: 0;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        .slider-dot.active {
            background: var(--silver-100);
            width: 26px;
            border-radius: 8px;
            border-color: rgba(255, 255, 255, 0.4);
        }

        .slider-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: white;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s;
            font-size: 0.9rem;
            -webkit-tap-highlight-color: transparent;
            outline: none;
        }

        .slider-nav:active {
            background: rgba(0, 0, 0, 0.8);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .slider-nav.prev {
            left: 12px;
        }

        .slider-nav.next {
            right: 12px;
        }

        @media (min-width: 769px) {
            .slider-nav {
                width: 44px;
                height: 44px;
            }

            .slider-nav.prev {
                left: 16px;
            }

            .slider-nav.next {
                right: 16px;
            }
        }

        /* === SECTION 4: DETAILS === */
        .section-details {
            padding: 20px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 18px;
            width: 100%;
            max-width: 680px;
        }

        .detail-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 18px;
            padding: 28px 22px;
            text-align: center;
            transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
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

        .detail-card:hover {
            transform: translateY(-3px);
            border-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .detail-icon {
            font-size: 2rem;
            margin-bottom: 14px;
            color: var(--silver-60);
            transition: color 0.3s;
        }

        .detail-card:hover .detail-icon {
            color: var(--silver-80);
        }

        .detail-label {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--silver-60);
            margin-bottom: 8px;
        }

        .detail-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.15rem;
            font-weight: 500;
            color: var(--silver-90);
            line-height: 1.5;
        }

        /* === SECTION 5: RSVP === */
        .section-rsvp {
            flex-direction: column;
            gap: 22px;
            text-align: center;
            padding: 20px;
        }

        .rsvp-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.2rem, 5vw, 3.2rem);
            color: var(--silver-100);
            font-weight: 700;
            text-shadow: 0 0 50px rgba(192, 192, 192, 0.12);
        }

        .rsvp-subtitle {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            font-style: italic;
            color: var(--silver-60);
        }

        .btn-rsvp {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 17px 48px;
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
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 12px 35px rgba(192, 192, 192, 0.18);
            -webkit-tap-highlight-color: transparent;
            outline: none;
        }

        .btn-rsvp:active {
            transform: scale(0.96);
        }

        .btn-rsvp:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 45px rgba(192, 192, 192, 0.25);
        }

        .btn-location-outline {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 17px 48px;
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
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            -webkit-tap-highlight-color: transparent;
            outline: none;
        }

        .btn-location-outline:hover {
            border-color: var(--silver-80);
            color: var(--silver-100);
            box-shadow: 0 12px 35px rgba(192, 192, 192, 0.08);
        }

        /* === SECTION 6: CLOSING === */
        .section-closing {
            flex-direction: column;
            text-align: center;
            gap: 18px;
            padding: 20px;
        }

        .closing-text {
            font-family: 'Great Vibes', cursive;
            font-size: clamp(2.8rem, 5vw, 3.8rem);
            color: var(--silver-80);
            font-weight: 400;
            text-shadow: 0 0 40px rgba(192, 192, 192, 0.12);
        }

        .closing-name {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.6rem, 3vw, 2.2rem);
            color: var(--silver-100);
            font-weight: 600;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .fullscreen-section {
                padding: 0;
            }

            .section-gate,
            .section-quotes,
            .section-details,
            .section-rsvp,
            .section-closing {
                padding: 15px;
            }

            .slider-nav {
                width: 36px;
                height: 36px;
                font-size: 0.75rem;
            }

            .details-grid {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .detail-card {
                padding: 20px 14px;
                border-radius: 14px;
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
            .details-grid {
                grid-template-columns: 1fr;
                max-width: 350px;
            }

            .btn-open-gate,
            .btn-rsvp,
            .btn-location-outline {
                padding: 15px 32px;
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

    <!-- === MAIN SCROLL CONTAINER === -->
    <div class="scroll-container" id="scrollContainer">

        {{-- SECTION 1: GATE --}}
        <div class="fullscreen-section section-gate fade-section" data-index="0">
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
        </div>

        {{-- SECTION 2: QUOTES --}}
        <div class="fullscreen-section section-quotes fade-section" data-index="1">
            <div class="quotes-content">
                <div class="quotes-icon"><i class="fas fa-feather-alt"></i></div>
                <p class="quotes-main">
                    "In the tapestry of life, every thread of friendship weaves a story of love, laughter, and cherished
                    memories. Today, we gather not just to celebrate a milestone, but to honor the beautiful soul that
                    has touched our hearts in ways words cannot express."
                </p>
                <div class="quotes-divider"></div>
                <p class="quotes-author">— With Love, Belva</p>
            </div>
        </div>

        {{-- SECTION 3: PHOTO SLIDER FULLSCREEN --}}
        <div class="fullscreen-section section-photos fade-section" data-index="2">
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
                </div>
            @endif
        </div>

        {{-- SECTION 4: DETAILS --}}
        <div class="fullscreen-section section-details fade-section" data-index="3">
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
                    <p class="detail-value" style="font-size:1rem;margin-top:4px;">
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
        </div>

        {{-- SECTION 5: RSVP --}}
        <div class="fullscreen-section section-rsvp fade-section" data-index="4">
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
        </div>

        {{-- SECTION 6: CLOSING --}}
        <div class="fullscreen-section section-closing fade-section" data-index="5">
            <p class="closing-text"><i class="fas fa-heart" style="margin-right:10px;font-size:0.7em;"></i>With Love
                & Gratitude<i class="fas fa-heart" style="margin-left:10px;font-size:0.7em;"></i></p>
            <p class="closing-name">{{ $guest->event->title ?? 'Belva' }}</p>
            <p style="color:var(--silver-60);font-size:0.9rem;"><i class="far fa-smile"
                    style="margin-right:5px;"></i>Thank you for being part of this special moment</p>
        </div>

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
            goToSection(1);
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
                        isMusicPlaying = true;
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

        // ============================================
        // REELS/TIKTOK STYLE SCROLL SYSTEM
        // ============================================
        var scrollContainer = document.getElementById('scrollContainer');
        var sections = document.querySelectorAll('.fullscreen-section');
        var totalSections = sections.length;
        var currentSection = 0;
        var isTransitioning = false;
        var touchStartY = 0;
        var touchDeltaY = 0;
        var touchStartTime = 0;
        var minSwipeDistance = 40;
        var maxSwipeTime = 500;

        function goToSection(index) {
            if (index < 0 || index >= totalSections || isTransitioning) return;

            isTransitioning = true;
            currentSection = index;

            var offset = -currentSection * window.innerHeight;
            scrollContainer.style.transform = 'translateY(' + offset + 'px)';

            updateVisibleSection();

            setTimeout(function() {
                isTransitioning = false;
            }, 500);
        }

        function updateVisibleSection() {
            sections.forEach(function(section, i) {
                if (i === currentSection) {
                    section.classList.add('visible');
                }
                if (i <= currentSection) {
                    setTimeout(function() {
                        section.classList.add('visible');
                    }, i === currentSection ? 100 : 0);
                }
            });
        }

        document.addEventListener('touchstart', function(e) {
            touchStartY = e.touches[0].clientY;
            touchStartTime = Date.now();
            touchDeltaY = 0;
        }, {
            passive: true
        });

        document.addEventListener('touchmove', function(e) {
            touchDeltaY = e.touches[0].clientY - touchStartY;
        }, {
            passive: true
        });

        document.addEventListener('touchend', function(e) {
            var elapsed = Date.now() - touchStartTime;
            var absDelta = Math.abs(touchDeltaY);

            if (absDelta > minSwipeDistance && elapsed < maxSwipeTime) {
                if (touchDeltaY > 0) {
                    if (currentSection > 0) {
                        scrollContainer.classList.add('scrolling-fast');
                        goToSection(currentSection - 1);
                        setTimeout(function() {
                            scrollContainer.classList.remove('scrolling-fast');
                        }, 400);
                    }
                } else {
                    if (currentSection < totalSections - 1) {
                        scrollContainer.classList.add('scrolling-fast');
                        goToSection(currentSection + 1);
                        setTimeout(function() {
                            scrollContainer.classList.remove('scrolling-fast');
                        }, 400);
                    }
                }
                return;
            }

            if (absDelta > 20) {
                if (touchDeltaY > 0 && currentSection > 0) {
                    goToSection(currentSection - 1);
                } else if (touchDeltaY < 0 && currentSection < totalSections - 1) {
                    goToSection(currentSection + 1);
                }
            }
        }, {
            passive: true
        });

        var wheelAccumulator = 0;
        var wheelTimeout = null;

        document.addEventListener('wheel', function(e) {
            e.preventDefault();
            wheelAccumulator += e.deltaY;
            clearTimeout(wheelTimeout);
            wheelTimeout = setTimeout(function() {
                if (Math.abs(wheelAccumulator) > 30) {
                    if (wheelAccumulator > 0 && currentSection < totalSections - 1) {
                        goToSection(currentSection + 1);
                    } else if (wheelAccumulator < 0 && currentSection > 0) {
                        goToSection(currentSection - 1);
                    }
                }
                wheelAccumulator = 0;
            }, 80);
        }, {
            passive: false
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowDown' || e.key === 'PageDown') {
                e.preventDefault();
                if (currentSection < totalSections - 1) goToSection(currentSection + 1);
            } else if (e.key === 'ArrowUp' || e.key === 'PageUp') {
                e.preventDefault();
                if (currentSection > 0) goToSection(currentSection - 1);
            } else if (e.key === 'Home') {
                e.preventDefault();
                goToSection(0);
            } else if (e.key === 'End') {
                e.preventDefault();
                goToSection(totalSections - 1);
            }
        });

        scrollContainer.addEventListener('touchmove', function(e) {
            var sliderTrack = document.getElementById('sliderTrack');
            if (sliderTrack && sliderTrack.contains(e.target)) return;
        }, {
            passive: true
        });

        updateVisibleSection();

        window.addEventListener('resize', function() {
            var offset = -currentSection * window.innerHeight;
            scrollContainer.style.transition = 'none';
            scrollContainer.style.transform = 'translateY(' + offset + 'px)';
            setTimeout(function() {
                scrollContainer.style.transition = 'transform 0.45s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            }, 50);
        });

        // ============================================
        // PHOTO SLIDER
        // ============================================
        var currentSlide = 0;
        var totalSlides = {{ count($photos) }};
        var autoSlideTimer = null;

        function updateSlider() {
            var t = document.getElementById('sliderTrack');
            var d = document.querySelectorAll('.slider-dot');
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
                currentSlide = (currentSlide + 1) % totalSlides;
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
                e.stopPropagation();
            }, {
                passive: true
            });
            s.addEventListener('touchend', function(e) {
                ex = e.changedTouches[0].screenX;
                if (Math.abs(sx - ex) >
                    50) {
                    slidePhoto(sx > ex ? 1 : -1);
                    e.stopPropagation();
                }
            });
        })();

        // FALLING DIAMONDS GENERATOR
        (function() {
            var c = document.getElementById('diamondsContainer');
            if (!c) return;
            var frag = document.createDocumentFragment();
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

        window.addEventListener('load', function() {
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.4s ease';
            requestAnimationFrame(function() {
                document.body.style.opacity = '1';
            });
        });
    </script>

</body>

</html>
