<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
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

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=Inter:wght@200;300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500&family=Great+Vibes&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --silver-100: #ffffff;
            --silver-95: #f5f5f7;
            --silver-90: #e8e8ed;
            --silver-80: #d1d1d6;
            --silver-60: #a1a1a6;
            --silver-40: #6e6e73;
            --silver-20: #3a3a3c;
            --silver-10: #1c1c1e;
            --silver-0: #000000;
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
            cursor: default;
            overflow-x: hidden;
            height: 100%;
        }

        /* === BACKGROUND LAYERS === */
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -3;
            overflow: hidden;
            pointer-events: none;
        }

        .video-background::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at center, transparent 0%, rgba(0, 0, 0, 0.4) 100%);
            z-index: 1;
        }

        .video-background iframe {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 130vw;
            height: 130vh;
            transform: translate(-50%, -50%);
            pointer-events: none;
            object-fit: cover;
            opacity: 0.35;
            filter: grayscale(100%) brightness(0.5) contrast(1.4) blur(0.5px);
        }

        @media (min-aspect-ratio: 16/9) {
            .video-background iframe {
                width: 200vh;
                height: 130vh;
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
            opacity: 0.05;
            mix-blend-mode: overlay;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='6' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='1'/%3E%3C/svg%3E");
            background-repeat: repeat;
            background-size: 150px 150px;
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

        .mist-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .mist {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(ellipse at center, rgba(200, 200, 210, 0.12) 0%, rgba(180, 180, 190, 0.06) 20%, rgba(160, 160, 170, 0.03) 40%, transparent 70%);
            animation: mistFloat linear infinite;
            filter: blur(60px);
            mix-blend-mode: screen;
        }

        .mist-layer-2 {
            position: absolute;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            background: radial-gradient(ellipse at center, rgba(210, 210, 220, 0.1) 0%, rgba(190, 190, 200, 0.05) 30%, transparent 70%);
            animation: mistFloat2 linear infinite;
            filter: blur(80px);
            mix-blend-mode: screen;
        }

        @keyframes mistFloat {
            0% {
                transform: translate(0, 100vh) scale(0.6) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 0.8;
            }

            40% {
                opacity: 0.4;
            }

            70% {
                opacity: 0.15;
            }

            100% {
                transform: translate(10vw, -20vh) scale(1.8) rotate(15deg);
                opacity: 0;
            }
        }

        @keyframes mistFloat2 {
            0% {
                transform: translate(50vw, 120vh) scale(0.5) rotate(0deg);
                opacity: 0;
            }

            15% {
                opacity: 0.7;
            }

            45% {
                opacity: 0.3;
            }

            80% {
                opacity: 0.1;
            }

            100% {
                transform: translate(-10vw, -30vh) scale(2) rotate(-10deg);
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
            perspective: 1000px;
        }

        .particle {
            position: absolute;
            background: radial-gradient(circle, rgba(220, 220, 230, 0.6) 0%, rgba(180, 180, 190, 0.3) 40%, transparent 70%);
            border-radius: 50%;
            animation: particleFloat3D linear infinite;
            box-shadow: 0 0 15px rgba(200, 200, 210, 0.3), 0 0 30px rgba(180, 180, 190, 0.15);
        }

        @keyframes particleFloat3D {
            0% {
                transform: translateY(110vh) translateX(0) translateZ(-200px) scale(0);
                opacity: 0;
            }

            10% {
                opacity: 0.9;
            }

            30% {
                opacity: 0.5;
            }

            60% {
                opacity: 0.2;
            }

            90% {
                opacity: 0.05;
            }

            100% {
                transform: translateY(-10vh) translateX(60px) translateZ(100px) scale(2.5);
                opacity: 0;
            }
        }

        .ring-3d {
            position: fixed;
            pointer-events: none;
            border: 1.5px solid rgba(192, 192, 200, 0.08);
            border-radius: 50%;
            animation: ringRotate linear infinite;
            transform-style: preserve-3d;
            box-shadow: 0 0 40px rgba(192, 192, 200, 0.03), inset 0 0 40px rgba(192, 192, 200, 0.02);
        }

        .ring-3d.ring-1 {
            width: 80vmin;
            height: 80vmin;
            top: -20%;
            right: -15%;
            animation-duration: 40s;
            border-color: rgba(200, 200, 210, 0.06);
        }

        .ring-3d.ring-2 {
            width: 60vmin;
            height: 60vmin;
            bottom: -15%;
            left: -10%;
            animation-duration: 32s;
            animation-direction: reverse;
            border-color: rgba(200, 200, 210, 0.08);
        }

        .ring-3d.ring-3 {
            width: 45vmin;
            height: 45vmin;
            top: 35%;
            left: 45%;
            animation-duration: 25s;
            border-color: rgba(200, 200, 210, 0.05);
            animation-direction: alternate;
        }

        @keyframes ringRotate {
            0% {
                transform: rotate(0deg) rotateX(20deg) rotateY(12deg);
            }

            50% {
                transform: rotate(180deg) rotateX(22deg) rotateY(15deg);
            }

            100% {
                transform: rotate(360deg) rotateX(20deg) rotateY(12deg);
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
            transition: all 0.4s var(--transition-smooth);
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .music-toggle:hover {
            border-color: var(--silver-80);
            color: var(--silver-100);
            transform: scale(1.1);
            box-shadow: 0 15px 40px rgba(192, 192, 192, 0.15);
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
                transform: scale(1.2);
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
            border: 1px solid rgba(192, 192, 192, 0.2);
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
                transform: scale(1.8);
                opacity: 0;
            }
        }

        /* === MAIN SCROLL CONTAINER === */
        .scroll-container {
            position: relative;
            z-index: 1;
            height: 100%;
        }

        .fullscreen-section {
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            scroll-snap-align: start;
            position: relative;
            padding: 20px;
            overflow: hidden;
        }

        /* === SECTION 1: GATE / COVER === */
        .section-gate {
            flex-direction: column;
            text-align: center;
        }

        .gate-content {
            position: relative;
            z-index: 2;
            animation: fadeInUp 2s ease forwards;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(40px);
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
            animation: fadeInUp 1.5s ease forwards;
            animation-delay: 0.3s;
            opacity: 0;
        }

        .gate-dear {
            font-family: 'Great Vibes', cursive;
            font-size: clamp(1.8rem, 4vw, 2.6rem);
            color: var(--silver-80);
            margin-bottom: 10px;
            animation: fadeInUp 1.5s ease forwards;
            animation-delay: 0.6s;
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
            animation: fadeInUp 1.5s ease forwards;
            animation-delay: 0.9s;
            opacity: 0;
            text-shadow: 0 0 80px rgba(192, 192, 192, 0.3), 0 0 120px rgba(192, 192, 192, 0.1);
        }

        .gate-divider-line {
            width: 80px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--silver-40), transparent);
            margin: 0 auto 40px;
            animation: fadeInUp 1.5s ease forwards;
            animation-delay: 1.2s;
            opacity: 0;
        }

        .gate-quote {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1rem, 2.5vw, 1.3rem);
            font-style: italic;
            color: var(--silver-60);
            margin-bottom: 50px;
            line-height: 1.6;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            animation: fadeInUp 1.5s ease forwards;
            animation-delay: 1.5s;
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
            transition: all 0.6s var(--transition-smooth);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            animation: fadeInUp 1.5s ease forwards;
            animation-delay: 1.8s;
            opacity: 0;
        }

        .btn-open-gate::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(192, 192, 192, 0.12), rgba(255, 255, 255, 0.06));
            opacity: 0;
            transition: opacity 0.6s;
            border-radius: 50px;
        }

        .btn-open-gate:hover {
            border-color: var(--silver-80);
            color: var(--silver-100);
            transform: scale(1.03);
            box-shadow: 0 20px 60px rgba(192, 192, 192, 0.12), 0 0 100px rgba(192, 192, 192, 0.05);
            letter-spacing: 5px;
        }

        .btn-open-gate:hover::before {
            opacity: 1;
        }

        .btn-open-gate i {
            transition: transform 0.5s var(--transition-bounce);
        }

        .btn-open-gate:hover i {
            transform: translateY(3px);
        }

        .scroll-hint {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            animation: bounceDown 2s ease-in-out infinite;
            z-index: 5;
        }

        .scroll-hint span {
            font-size: 0.65rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--silver-60);
        }

        .scroll-hint i {
            font-size: 0.8rem;
            color: var(--silver-40);
        }

        @keyframes bounceDown {

            0%,
            100% {
                transform: translateX(-50%) translateY(0);
            }

            50% {
                transform: translateX(-50%) translateY(12px);
            }
        }

        /* === SECTION 2: FULL QUOTES === */
        .section-quotes {
            text-align: center;
            padding: 40px;
        }

        .quotes-content {
            max-width: 650px;
            animation: fadeInUp 1.5s ease forwards;
            opacity: 0;
        }

        .quotes-content.visible {
            opacity: 1;
        }

        .quotes-icon {
            font-size: 3rem;
            color: var(--silver-40);
            margin-bottom: 30px;
            opacity: 0.6;
        }

        .quotes-main {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.3rem, 3vw, 1.8rem);
            font-style: italic;
            color: var(--silver-80);
            line-height: 1.8;
            margin-bottom: 30px;
            letter-spacing: 0.5px;
        }

        .quotes-author {
            font-family: 'Great Vibes', cursive;
            font-size: clamp(1.5rem, 3vw, 2rem);
            color: var(--silver-60);
            letter-spacing: 1px;
        }

        .quotes-divider {
            width: 60px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--silver-40), transparent);
            margin: 20px auto;
        }

        /* === SECTION 3: PHOTO SLIDER === */
        .section-photos {
            padding: 20px;
        }

        .slider-container {
            width: 100%;
            max-width: 700px;
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.5), 0 0 100px rgba(192, 192, 192, 0.05);
            aspect-ratio: 4/3;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .slider-track {
            display: flex;
            height: 100%;
            transition: transform 0.7s var(--transition-smooth);
        }

        .slider-track img {
            min-width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .slider-dots {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }

        .slider-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--silver-40);
            border: 1px solid rgba(255, 255, 255, 0.15);
            cursor: pointer;
            transition: all 0.4s;
        }

        .slider-dot.active {
            background: var(--silver-100);
            width: 28px;
            border-radius: 10px;
        }

        .slider-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .slider-nav:hover {
            background: rgba(0, 0, 0, 0.8);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .slider-nav.prev {
            left: 15px;
        }

        .slider-nav.next {
            right: 15px;
        }

        /* === SECTION 4: DETAILS === */
        .section-details {
            padding: 20px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 700px;
        }

        .detail-card {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 30px 25px;
            text-align: center;
            transition: all 0.5s var(--transition-smooth);
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
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.12), transparent);
        }

        .detail-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5), 0 0 60px rgba(192, 192, 192, 0.03);
            border-color: rgba(255, 255, 255, 0.15);
        }

        .detail-icon {
            font-size: 2rem;
            margin-bottom: 15px;
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
            font-size: 1.2rem;
            font-weight: 500;
            color: var(--silver-90);
            line-height: 1.5;
        }

        /* === SECTION 5: RSVP === */
        .section-rsvp {
            flex-direction: column;
            gap: 25px;
            text-align: center;
        }

        .rsvp-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 5vw, 3rem);
            color: var(--silver-100);
            font-weight: 700;
            text-shadow: 0 0 60px rgba(192, 192, 192, 0.15);
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
            padding: 18px 50px;
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
            transition: all 0.5s var(--transition-bounce);
            box-shadow: 0 15px 40px rgba(192, 192, 192, 0.2), 0 0 80px rgba(192, 192, 192, 0.08);
        }

        .btn-rsvp:hover {
            transform: scale(1.05);
            box-shadow: 0 25px 60px rgba(192, 192, 192, 0.3), 0 0 120px rgba(192, 192, 192, 0.12);
        }

        .btn-location-outline {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 18px 50px;
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
            transition: all 0.5s var(--transition-smooth);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .btn-location-outline:hover {
            border-color: var(--silver-80);
            color: var(--silver-100);
            box-shadow: 0 15px 40px rgba(192, 192, 192, 0.1);
        }

        /* === SECTION 6: CLOSING === */
        .section-closing {
            flex-direction: column;
            text-align: center;
            gap: 20px;
        }

        .closing-text {
            font-family: 'Great Vibes', cursive;
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            color: var(--silver-80);
            font-weight: 400;
            text-shadow: 0 0 40px rgba(192, 192, 192, 0.15);
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
                padding: 15px;
            }

            .slider-nav {
                width: 36px;
                height: 36px;
                font-size: 0.7rem;
            }

            .details-grid {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .detail-card {
                padding: 20px 15px;
            }

            .music-player {
                bottom: 20px;
                right: 20px;
            }

            .music-toggle {
                width: 45px;
                height: 45px;
                font-size: 1rem;
            }

            .quotes-main {
                font-size: clamp(1.1rem, 2.5vw, 1.4rem);
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
                padding: 15px 35px;
                font-size: 0.75rem;
                letter-spacing: 2px;
            }
        }
    </style>
</head>

<body>

    <!-- === BACKGROUND LAYERS === -->
    <div class="light-rays"></div>
    <div class="video-background" id="videoBg">
        <iframe
            src="https://www.youtube.com/embed/HPph35tdMP8?autoplay=1&mute=1&controls=0&loop=1&playlist=HPph35tdMP8&showinfo=0&rel=0&enablejsapi=1&modestbranding=1&iv_load_policy=3&playsinline=1"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen>
        </iframe>
    </div>
    <div class="grain-overlay"></div>
    <div class="ring-3d ring-1"></div>
    <div class="ring-3d ring-2"></div>
    <div class="ring-3d ring-3"></div>
    <div class="mist-container" id="mistContainer"></div>
    <div class="mist-container" id="mistContainer2"></div>
    <div class="particles-container" id="particlesContainer"></div>

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

        {{-- SECTION 1: GATE / COVER --}}
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

        {{-- SECTION 2: FULL QUOTES --}}
        <section class="fullscreen-section section-quotes" id="sectionQuotes">
            <div class="quotes-content" id="quotesContent">
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

        {{-- SECTION 3: PHOTO SLIDER --}}
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
                <div
                    style="display: flex; flex-direction: column; align-items: center; width: 100%; max-width: 700px;">
                    <div class="slider-container" id="photoSlider">
                        <div class="slider-track" id="sliderTrack">
                            @foreach ($photos as $photo)
                                <img src="{{ $photo }}" alt="Event Photo" loading="lazy">
                            @endforeach
                        </div>
                        @if (count($photos) > 1)
                            <button class="slider-nav prev" onclick="slidePhoto(-1)">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="slider-nav next" onclick="slidePhoto(1)">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        @endif
                    </div>
                    @if (count($photos) > 1)
                        <div class="slider-dots" id="sliderDots">
                            @foreach ($photos as $index => $photo)
                                <button class="slider-dot {{ $index === 0 ? 'active' : '' }}"
                                    onclick="goToSlide({{ $index }})"></button>
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
                    <div class="detail-icon">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <p class="detail-label">Date</p>
                    <p class="detail-value">
                        {{ \Carbon\Carbon::parse($guest->event->event_date ?? now())->format('d M Y') }}</p>
                </div>
                <div class="detail-card">
                    <div class="detail-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <p class="detail-label">Venue</p>
                    <p class="detail-value">{{ $guest->event->venue ?? 'Secret Location' }}</p><br>
                    <p class="detail-value">{{ $guest->event->event_time ?? 'To be announced' }}</p>
                </div>
                @if ($guest->event->dresscode ?? false)
                    <div class="detail-card">
                        <div class="detail-icon">
                            <i class="fas fa-tshirt"></i>
                        </div>
                        <p class="detail-label">Dress Code</p>
                        <p class="detail-value">{{ $guest->event->dresscode }}</p>
                    </div>
                @endif
            </div>
        </section>

        {{-- SECTION 5: RSVP --}}
        <section class="fullscreen-section section-rsvp" id="sectionRsvp">
            <h2 class="rsvp-title">
                Confirm Attendance
            </h2>
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
                <i class="fas fa-heart" style="margin-right: 10px; font-size: 0.7em;"></i>
                With Love & Gratitude
                <i class="fas fa-heart" style="margin-left: 10px; font-size: 0.7em;"></i>
            </p>
            <p class="closing-name">{{ $guest->event->title ?? 'Belva' }}</p>
            <p style="color: var(--silver-60); font-size: 0.85rem;">
                <i class="far fa-smile" style="margin-right: 5px;"></i>
                Thank you for being part of this special moment
            </p>
        </section>

    </div>

    <script>
        // ============================================
        // MUSIC PLAYER CONTROLS
        // ============================================
        const bgMusic = document.getElementById('bgMusic');
        const musicPlayer = document.getElementById('musicPlayer');
        const musicToggle = document.getElementById('musicToggle');
        let isMusicPlaying = false;

        function openInvitation(event) {
            event.preventDefault();

            if (bgMusic) {
                bgMusic.play().then(() => {
                    isMusicPlaying = true;
                    updateMusicButton();
                }).catch(error => {
                    console.log('Autoplay was prevented:', error);
                });
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
                bgMusic.play().then(() => {
                    isMusicPlaying = true;
                }).catch(error => {
                    console.log('Play prevented:', error);
                });
                isMusicPlaying = true;
            }

            updateMusicButton();
        }

        function updateMusicButton() {
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

        if (musicToggle) {
            musicToggle.addEventListener('click', toggleMusic);
        }

        if (bgMusic) {
            bgMusic.addEventListener('play', () => {
                isMusicPlaying = true;
                updateMusicButton();
            });

            bgMusic.addEventListener('pause', () => {
                isMusicPlaying = false;
                updateMusicButton();
            });

            bgMusic.addEventListener('ended', () => {
                isMusicPlaying = false;
                updateMusicButton();
            });
        }

        // ============================================
        // SMOOTH SCROLL TO SECTION
        // ============================================
        function smoothScrollTo(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                section.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }

        // ============================================
        // PHOTO SLIDER
        // ============================================
        let currentSlide = 0;
        let totalSlides = {{ count($photos) }};
        let autoSlideInterval;

        function updateSlider() {
            const track = document.getElementById('sliderTrack');
            const dots = document.querySelectorAll('.slider-dot');

            if (track) {
                track.style.transform = `translateX(-${currentSlide * 100}%)`;
            }

            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }

        function slidePhoto(direction) {
            currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
            updateSlider();
            resetAutoSlide();
        }

        function goToSlide(index) {
            currentSlide = index;
            updateSlider();
            resetAutoSlide();
        }

        function startAutoSlide() {
            if (totalSlides > 1) {
                autoSlideInterval = setInterval(() => {
                    currentSlide = (currentSlide + 1) % totalSlides;
                    updateSlider();
                }, 4000);
            }
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            startAutoSlide();
        }

        (function initSwipe() {
            const slider = document.getElementById('photoSlider');
            if (!slider) return;

            let touchStartX = 0;
            let touchEndX = 0;

            slider.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            }, {
                passive: true
            });

            slider.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                const diff = touchStartX - touchEndX;

                if (Math.abs(diff) > 50) {
                    if (diff > 0) {
                        slidePhoto(1);
                    } else {
                        slidePhoto(-1);
                    }
                }
            });
        })();

        if (totalSlides > 1) {
            startAutoSlide();
        }

        // ============================================
        // QUOTES VISIBILITY
        // ============================================
        (function observeQuotes() {
            const quotesContent = document.getElementById('quotesContent');
            if (!quotesContent) return;

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        quotesContent.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.5
            });

            observer.observe(quotesContent);
        })();

        // ============================================
        // MIST/SMOKE GENERATORS
        // ============================================
        (function createMistLayer1() {
            const container = document.getElementById('mistContainer');
            const mistCount = 12;

            for (let i = 0; i < mistCount; i++) {
                const mist = document.createElement('div');
                mist.classList.add('mist');

                const size = Math.random() * 250 + 150;
                const left = Math.random() * 100;
                const duration = Math.random() * 20 + 15;
                const delay = Math.random() * 15;

                mist.style.width = size + 'px';
                mist.style.height = size + 'px';
                mist.style.left = left + '%';
                mist.style.animationDuration = duration + 's';
                mist.style.animationDelay = delay + 's';

                container.appendChild(mist);
            }
        })();

        (function createMistLayer2() {
            const container = document.getElementById('mistContainer2');
            const mistCount = 8;

            for (let i = 0; i < mistCount; i++) {
                const mist = document.createElement('div');
                mist.classList.add('mist-layer-2');

                const size = Math.random() * 300 + 200;
                const left = Math.random() * 100;
                const duration = Math.random() * 25 + 18;
                const delay = Math.random() * 18;

                mist.style.width = size + 'px';
                mist.style.height = size + 'px';
                mist.style.left = left + '%';
                mist.style.animationDuration = duration + 's';
                mist.style.animationDelay = delay + 's';

                container.appendChild(mist);
            }
        })();

        // ============================================
        // PARTICLES GENERATOR
        // ============================================
        (function createParticles() {
            const container = document.getElementById('particlesContainer');
            const count = 50;

            for (let i = 0; i < count; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                const size = Math.random() * 3 + 1.5;
                const left = Math.random() * 100;
                const duration = Math.random() * 12 + 8;
                const delay = Math.random() * 10;

                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = left + '%';
                particle.style.animationDuration = duration + 's';
                particle.style.animationDelay = delay + 's';

                container.appendChild(particle);
            }
        })();

        // ============================================
        // PARALLAX 3D RINGS
        // ============================================
        (function parallaxRings() {
            document.addEventListener('mousemove', (e) => {
                const rings = document.querySelectorAll('.ring-3d');
                const x = (e.clientX / window.innerWidth - 0.5) * 40;
                const y = (e.clientY / window.innerHeight - 0.5) * 40;

                rings.forEach((ring, index) => {
                    const factor = (index + 1) * 0.5;
                    const rotX = 20 + (e.clientY / window.innerHeight) * 10;
                    const rotY = 12 + (e.clientX / window.innerWidth) * 8;
                    ring.style.transform =
                        `translate(${x * factor}px, ${y * factor}px) rotateX(${rotX}deg) rotateY(${rotY}deg)`;
                });
            });
        })();

        // ============================================
        // INTERSECTION OBSERVER FOR ANIMATIONS
        // ============================================
        (function observeSections() {
            const observerOptions = {
                threshold: 0.3,
                rootMargin: '0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.detail-card, .rsvp-title, .rsvp-subtitle, .closing-text, .closing-name')
                .forEach(el => {
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(30px)';
                    el.style.transition = 'all 0.8s cubic-bezier(0.22, 0.61, 0.36, 1)';
                    observer.observe(el);
                });
        })();

        // ============================================
        // KEYBOARD NAVIGATION
        // ============================================
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight' && totalSlides > 1) {
                slidePhoto(1);
            } else if (e.key === 'ArrowLeft' && totalSlides > 1) {
                slidePhoto(-1);
            }
        });

        // ============================================
        // INITIAL LOAD FADE IN
        // ============================================
        window.addEventListener('load', () => {
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 1s ease';
            requestAnimationFrame(() => {
                document.body.style.opacity = '1';
            });
        });
    </script>

</body>

</html>
