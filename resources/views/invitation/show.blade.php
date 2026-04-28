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
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,500;0,700;1,400&family=Great+Vibes&family=Tangerine:wght@400;700&family=Alex+Brush&family=Parisienne&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://fonts.cdnfonts.com/css/sloop" rel="stylesheet">

    <style>
        :root {
            --deep-purple: #1a0a2e;
            --dark-purple: #2d1b4e;
            --medium-purple: #4a2d7a;
            --light-purple: #6b3fa0;
            --accent-purple: #8b5cf6;
            --soft-purple: #a78bfa;
            --pale-purple: #c4b5fd;
            --ice-white: #f0e6ff;
            --diamond-white: #ffffff;
            --diamond-glow: rgba(200, 180, 255, 0.6);
            --gold: #d4a574;
            --gold-light: #e8d5c4;
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
            background: var(--deep-purple);
            color: var(--ice-white);
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

        /* === DIAMOND BACKGROUND === */
        .diamond-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -3;
            pointer-events: none;
            background:
                radial-gradient(ellipse at 50% 0%, rgba(120, 80, 200, 0.4) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(160, 120, 240, 0.25) 0%, transparent 40%),
                radial-gradient(ellipse at 20% 80%, rgba(100, 60, 180, 0.3) 0%, transparent 45%),
                radial-gradient(ellipse at 50% 50%, rgba(80, 40, 160, 0.15) 0%, transparent 60%),
                linear-gradient(180deg,
                    #0d0015 0%,
                    #1a0a2e 25%,
                    #220d3a 50%,
                    #1a0a2e 75%,
                    #0d0015 100%);
        }

        /* Diamond pattern overlay */
        .diamond-pattern {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            pointer-events: none;
            opacity: 0.08;
            background-image:
                linear-gradient(45deg, rgba(255, 255, 255, 0.1) 25%, transparent 25%),
                linear-gradient(-45deg, rgba(255, 255, 255, 0.1) 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, rgba(255, 255, 255, 0.1) 75%),
                linear-gradient(-45deg, transparent 75%, rgba(255, 255, 255, 0.1) 75%);
            background-size: 40px 40px;
            background-position: 0 0, 0 20px, 20px -20px, -20px 0px;
            mask-image: radial-gradient(ellipse at center, black 30%, transparent 70%);
            -webkit-mask-image: radial-gradient(ellipse at center, black 30%, transparent 70%);
        }

        /* Glowing diamond shapes */
        .diamond-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
            overflow: hidden;
        }

        .diamond-shape {
            position: absolute;
            width: 0;
            height: 0;
        }

        .diamond-shape::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(45deg);
            background: linear-gradient(135deg, rgba(180, 150, 240, 0.15), rgba(120, 80, 200, 0.05));
            border: 1px solid rgba(200, 180, 240, 0.2);
            box-shadow:
                0 0 20px rgba(180, 150, 240, 0.15),
                0 0 40px rgba(140, 100, 220, 0.1),
                inset 0 0 15px rgba(200, 180, 240, 0.1);
            filter: blur(0.5px);
        }

        .diamond-shape.large::before {
            width: 300px;
            height: 300px;
        }

        .diamond-shape.medium::before {
            width: 180px;
            height: 180px;
        }

        .diamond-shape.small::before {
            width: 80px;
            height: 80px;
        }

        /* === SPARKLE EFFECT === */
        .sparkle-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .sparkle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: var(--diamond-white);
            border-radius: 50%;
            box-shadow:
                0 0 6px 3px rgba(255, 255, 255, 0.6),
                0 0 12px 6px rgba(200, 180, 255, 0.4),
                0 0 20px 10px rgba(160, 130, 240, 0.2);
            animation: sparkleFloat 4s ease-in-out infinite;
        }

        @keyframes sparkleFloat {

            0%,
            100% {
                opacity: 0.2;
                transform: scale(0.8);
            }

            50% {
                opacity: 1;
                transform: scale(1.5);
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
            background: rgba(45, 27, 78, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(180, 150, 240, 0.3);
            color: var(--ice-white);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.4s ease;
            position: relative;
            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.4),
                0 0 20px rgba(140, 100, 240, 0.2);
            -webkit-tap-highlight-color: transparent;
            outline: none;
        }

        .music-toggle:active {
            transform: scale(0.95);
        }

        .music-toggle.playing {
            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.4),
                0 0 30px rgba(160, 130, 255, 0.4),
                0 0 60px rgba(140, 100, 240, 0.2);
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
            border: 1px solid rgba(180, 150, 240, 0.2);
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
            transition: opacity 0.8s ease;
        }

        .fade-section.visible {
            opacity: 1;
        }

        /* === SECTION 1: GATE - FULLSCREEN WITH VIDEO BACKGROUND === */
        .section-gate {
            flex-direction: column;
            text-align: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .section-gate-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
        }

        .section-gate::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg,
                    rgba(26, 10, 46, 0.7) 0%,
                    rgba(45, 27, 78, 0.5) 50%,
                    rgba(26, 10, 46, 0.7) 100%);
            z-index: 1;
        }

        .gate-content {
            position: relative;
            z-index: 2;
            padding: 20px 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 600px;
        }

        .gate-logo {
            width: clamp(90px, 18vw, 150px);
            height: auto;
            margin-bottom: 20px;
            filter: drop-shadow(0 0 20px rgba(180, 150, 240, 0.4));
            animation: logoGlow 3s ease-in-out infinite;
        }

        @keyframes logoGlow {

            0%,
            100% {
                filter: drop-shadow(0 0 20px rgba(180, 150, 240, 0.4));
            }

            50% {
                filter: drop-shadow(0 0 35px rgba(200, 180, 255, 0.7));
            }
        }

        .gate-subtitle-top {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(0.8rem, 1.5vw, 0.95rem);
            font-weight: 400;
            letter-spacing: 6px;
            text-transform: uppercase;
            color: var(--pale-purple);
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .gate-subtitle-top::before,
        .gate-subtitle-top::after {
            content: '✦';
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.5rem;
            color: var(--soft-purple);
        }

        .gate-subtitle-top::before {
            left: -25px;
        }

        .gate-subtitle-top::after {
            right: -25px;
        }

        .gate-dear {
            font-family: 'Great Vibes', cursive;
            font-size: clamp(1.8rem, 3.5vw, 2.5rem);
            color: var(--gold-light);
            margin-bottom: 0px;
            font-weight: 400;
            text-shadow: 0 0 30px rgba(212, 167, 116, 0.3);
            line-height: 1;
        }

        .gate-name {
            /* font-family: 'Parisienne', 'Tangerine', 'Great Vibes', cursive; */
            /* font-family: 'Sloop', sans-serif; */
            font-family: 'Great Vibes', cursive;
            font-size: clamp(2.8rem, 7vw, 5.5rem);
            font-weight: 400;
            color: var(--diamond-white);
            letter-spacing: 2px;
            line-height: 1.2;
            margin-bottom: 25px;
            text-shadow:
                0 0 40px rgba(180, 150, 240, 0.5),
                0 0 80px rgba(140, 100, 220, 0.4),
                0 0 120px rgba(120, 80, 200, 0.3);
            position: relative;
        }

        .gate-name::after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 1px;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(180, 150, 240, 0.6),
                    rgba(200, 180, 255, 0.8),
                    rgba(180, 150, 240, 0.6),
                    transparent);
        }

        .btn-open-gate {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 16px 42px;
            background: linear-gradient(135deg,
                    rgba(107, 63, 160, 0.6),
                    rgba(139, 92, 246, 0.5),
                    rgba(107, 63, 160, 0.6));
            color: var(--diamond-white);
            border: 1px solid rgba(180, 150, 240, 0.4);
            border-radius: 50px;
            font-family: 'Inter', sans-serif;
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 4px;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.5s ease;
            -webkit-tap-highlight-color: transparent;
            outline: none;
            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.4),
                0 0 20px rgba(139, 92, 246, 0.3),
                0 0 40px rgba(107, 63, 160, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .btn-open-gate::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .btn-open-gate:hover::before {
            left: 100%;
        }

        .btn-open-gate:active {
            transform: scale(0.97);
        }

        /* === SECTION 2: QUOTES - FULLSCREEN WITH IMAGE BACKGROUND === */
        .section-quotes {
            text-align: center;
            position: relative;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding-bottom: 10%;
            background: url('{{ asset('assets/img/section2.png') }}') center/cover no-repeat;
        }

        .section-quotes::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(0deg,
                    rgba(26, 10, 46, 0.85) 0%,
                    rgba(26, 10, 46, 0.5) 35%,
                    rgba(45, 27, 78, 0.3) 55%,
                    rgba(26, 10, 46, 0.5) 75%,
                    rgba(26, 10, 46, 0.7) 100%);
            z-index: 1;
        }

        .quotes-content {
            position: relative;
            z-index: 2;
            max-width: 700px;
            padding: 30px 30px 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .quotes-icon {
            font-size: 2.5rem;
            color: var(--soft-purple);
            margin-bottom: 20px;
            opacity: 0.7;
            text-shadow: 0 0 20px rgba(167, 139, 250, 0.4);
        }

        /* .quotes-main {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.2rem, 2.8vw, 1.6rem);
            font-style: italic;
            color: var(--ice-white);
            line-height: 1.8;
            margin-bottom: 20px;
            letter-spacing: 0.5px;
            text-shadow: 0 0 20px rgba(200, 180, 240, 0.3);
        } */

        .quotes-main {
            font-family: 'Big Caslon', 'Libre Caslon Text', serif;
            font-size: clamp(1.2rem, 2.8vw, 1.6rem);
            font-style: italic;
            color: var(--ice-white);
            line-height: 1.8;
            margin-bottom: 20px;
            letter-spacing: 0.5px;
            text-shadow: 0 0 20px rgba(200, 180, 240, 0.3);
        }

        .quotes-author {
            font-family: 'Great Vibes', cursive;
            font-size: clamp(1.4rem, 2.8vw, 1.8rem);
            color: var(--gold-light);
            position: relative;
            display: inline-block;
            text-shadow: 0 0 20px rgba(212, 167, 116, 0.2);
        }

        .quotes-author::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -45px;
            width: 25px;
            height: 1px;
            background: rgba(167, 139, 250, 0.4);
        }

        .quotes-author::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -45px;
            width: 25px;
            height: 1px;
            background: rgba(167, 139, 250, 0.4);
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
            box-shadow:
                0 25px 70px rgba(0, 0, 0, 0.6),
                0 0 40px rgba(139, 92, 246, 0.2);
            background: rgba(13, 0, 21, 0.5);
            border: 1px solid rgba(167, 139, 250, 0.2);
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
            background: rgba(167, 139, 250, 0.3);
            border: 1px solid rgba(167, 139, 250, 0.4);
            cursor: pointer;
            transition: all 0.3s;
            -webkit-tap-highlight-color: transparent;
            outline: none;
            padding: 0;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        .slider-dot.active {
            background: var(--soft-purple);
            width: 26px;
            border-radius: 8px;
            border-color: rgba(200, 180, 240, 0.6);
            box-shadow: 0 0 10px rgba(167, 139, 250, 0.5);
        }

        .slider-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(45, 27, 78, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(167, 139, 250, 0.3);
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
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.4);
        }

        .slider-nav:active {
            background: rgba(74, 45, 122, 0.9);
            border-color: rgba(167, 139, 250, 0.5);
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.3);
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

        /* === SECTION 4: DETAILS - FULLSCREEN === */
        .section-details {
            background: radial-gradient(ellipse at center, rgba(45, 27, 78, 0.4) 0%, rgba(26, 10, 46, 0.6) 100%);
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 750px;
            padding: 20px;
        }

        .detail-card {
            background: rgba(45, 27, 78, 0.5);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(167, 139, 250, 0.25);
            border-radius: 20px;
            padding: 35px 25px;
            text-align: center;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .detail-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(200, 180, 240, 0.4),
                    rgba(255, 255, 255, 0.6),
                    rgba(200, 180, 240, 0.4),
                    transparent);
        }

        .detail-card::after {
            content: '';
            position: absolute;
            inset: -1px;
            border-radius: 20px;
            background: linear-gradient(135deg,
                    rgba(167, 139, 250, 0.15),
                    transparent 40%,
                    transparent 60%,
                    rgba(167, 139, 250, 0.15));
            z-index: -1;
            transition: opacity 0.4s ease;
            opacity: 0;
        }

        .detail-card:hover::after {
            opacity: 1;
        }

        .detail-card:hover {
            transform: translateY(-5px);
            border-color: rgba(167, 139, 250, 0.5);
            box-shadow:
                0 20px 50px rgba(0, 0, 0, 0.4),
                0 0 30px rgba(139, 92, 246, 0.2);
        }

        .detail-icon {
            font-size: 2.5rem;
            margin-bottom: 16px;
            color: var(--soft-purple);
            transition: all 0.4s ease;
            text-shadow: 0 0 20px rgba(167, 139, 250, 0.4);
        }

        .detail-card:hover .detail-icon {
            color: var(--pale-purple);
            text-shadow: 0 0 30px rgba(180, 160, 250, 0.6);
            transform: scale(1.1);
        }

        .detail-label {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--soft-purple);
            margin-bottom: 10px;
        }

        .detail-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem;
            font-weight: 500;
            color: var(--ice-white);
            line-height: 1.6;
            text-shadow: 0 0 10px rgba(200, 180, 240, 0.2);
        }

        /* === SECTION 5: RSVP - FULLSCREEN === */
        .section-rsvp {
            flex-direction: column;
            gap: 25px;
            text-align: center;
            background: radial-gradient(ellipse at center, rgba(45, 27, 78, 0.4) 0%, rgba(26, 10, 46, 0.6) 100%);
        }

        .rsvp-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 25px;
            padding: 40px 30px;
        }

        .rsvp-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            color: var(--diamond-white);
            font-weight: 700;
            text-shadow:
                0 0 30px rgba(180, 150, 240, 0.4),
                0 0 60px rgba(140, 100, 220, 0.2);
            position: relative;
            display: inline-block;
        }

        .rsvp-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--soft-purple), transparent);
        }

        .rsvp-subtitle {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem;
            font-style: italic;
            color: var(--pale-purple);
            text-shadow: 0 0 15px rgba(200, 180, 240, 0.2);
        }

        .btn-rsvp {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 20px 55px;
            background: linear-gradient(135deg,
                    rgba(107, 63, 160, 0.7),
                    rgba(139, 92, 246, 0.6),
                    rgba(107, 63, 160, 0.7));
            color: var(--diamond-white);
            border: 1px solid rgba(180, 150, 240, 0.4);
            border-radius: 50px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.4s ease;
            box-shadow:
                0 15px 40px rgba(0, 0, 0, 0.4),
                0 0 25px rgba(139, 92, 246, 0.3),
                0 0 50px rgba(107, 63, 160, 0.2);
            -webkit-tap-highlight-color: transparent;
            outline: none;
            position: relative;
            overflow: hidden;
        }

        .btn-rsvp::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
            transition: left 0.5s ease;
        }

        .btn-rsvp:hover::before {
            left: 100%;
        }

        .btn-rsvp:active {
            transform: scale(0.96);
        }

        .btn-rsvp:hover {
            transform: translateY(-3px);
            box-shadow:
                0 20px 50px rgba(0, 0, 0, 0.5),
                0 0 30px rgba(139, 92, 246, 0.5),
                0 0 60px rgba(107, 63, 160, 0.3);
        }

        .btn-location-outline {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 18px 50px;
            background: transparent;
            color: var(--ice-white);
            border: 1px solid rgba(167, 139, 250, 0.4);
            border-radius: 50px;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 3px;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.4s ease;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            -webkit-tap-highlight-color: transparent;
            outline: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .btn-location-outline:hover {
            border-color: var(--soft-purple);
            color: var(--diamond-white);
            box-shadow:
                0 15px 40px rgba(139, 92, 246, 0.2),
                0 0 20px rgba(167, 139, 250, 0.2);
            transform: translateY(-2px);
        }

        /* === SECTION 6: CLOSING - FULLSCREEN === */
        .section-closing {
            flex-direction: column;
            text-align: center;
            gap: 25px;
            background: radial-gradient(ellipse at center, rgba(45, 27, 78, 0.4) 0%, rgba(26, 10, 46, 0.6) 100%);
        }

        .closing-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            padding: 40px 30px;
        }

        .closing-text {
            font-family: 'Great Vibes', cursive;
            font-size: clamp(3rem, 5vw, 4rem);
            color: var(--gold-light);
            font-weight: 400;
            text-shadow:
                0 0 30px rgba(212, 167, 116, 0.3),
                0 0 60px rgba(212, 167, 116, 0.2);
        }

        .closing-name {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 3vw, 2.8rem);
            color: var(--diamond-white);
            font-weight: 600;
            letter-spacing: 3px;
            text-shadow: 0 0 25px rgba(200, 180, 240, 0.3);
        }

        .closing-thanks {
            color: var(--pale-purple);
            font-size: 1rem;
            font-weight: 300;
            text-shadow: 0 0 15px rgba(200, 180, 240, 0.2);
        }

        .closing-divider {
            width: 80px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--soft-purple), transparent);
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .fullscreen-section {
                padding: 0;
            }

            .gate-content,
            .quotes-content,
            .rsvp-content,
            .closing-content {
                padding: 20px;
            }

            .section-quotes {
                padding-bottom: 12%;
            }

            .gate-logo {
                width: clamp(70px, 15vw, 110px);
                margin-bottom: 15px;
            }

            .slider-nav {
                width: 36px;
                height: 36px;
                font-size: 0.75rem;
            }

            .details-grid {
                grid-template-columns: 1fr 1fr;
                gap: 15px;
            }

            .detail-card {
                padding: 25px 15px;
                border-radius: 16px;
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

            .section-quotes {
                padding-bottom: 15%;
            }

            .gate-logo {
                width: clamp(65px, 14vw, 90px);
                margin-bottom: 12px;
            }

            .btn-open-gate,
            .btn-rsvp,
            .btn-location-outline {
                padding: 14px 30px;
                font-size: 0.75rem;
                letter-spacing: 2px;
            }

            .gate-name {
                font-size: clamp(2.4rem, 6vw, 3.5rem);
            }
        }

        @media (min-width: 1024px) {
            .gate-content {
                max-width: 650px;
                padding: 30px 40px;
            }

            .quotes-content {
                max-width: 700px;
                padding: 40px 40px 50px;
            }
        }

        @media (min-height: 900px) {
            .gate-content {
                padding: 40px 30px;
            }
        }
    </style>
</head>

<body>

    <!-- === DIAMOND BACKGROUND === -->
    <div class="diamond-bg"></div>
    <div class="diamond-pattern"></div>
    <div class="diamond-shapes">
        <div class="diamond-shape large" style="top: 10%; left: 15%;"></div>
        <div class="diamond-shape medium" style="top: 40%; right: 10%;"></div>
        <div class="diamond-shape small" style="bottom: 20%; left: 50%;"></div>
        <div class="diamond-shape medium" style="top: 60%; left: 5%;"></div>
        <div class="diamond-shape small" style="top: 25%; right: 25%;"></div>
        <div class="diamond-shape large" style="bottom: 30%; right: 5%;"></div>
        <div class="diamond-shape small" style="top: 75%; left: 30%;"></div>
        <div class="diamond-shape medium" style="top: 15%; left: 60%;"></div>
    </div>
    <div class="sparkle-container" id="sparkleContainer"></div>

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
            <video class="section-gate-video" autoplay muted loop playsinline>
                <source src="{{ asset('assets/img/section1.mp4') }}" type="video/mp4">
            </video>
            <div class="gate-content">
                <img src="{{ asset('assets/img/logo-b.png') }}" alt="Logo" class="gate-logo">
                <p class="gate-subtitle-top">The Celebration of Belva 17th Birthday</p>
                <p class="gate-dear">Dear</p>
                <h1 class="gate-name">{{ $guest->name }}</h1>
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
                <p class="quotes-main">
                    "For you formed my inward parts;<br>
                    you knitted me together in<br>
                    my mother's womb. I praise you,<br>
                    for I am fearfully and wonderfully made.<br>
                    Wonderful are your works;<br>
                    my soul knows it very well."
                </p>
                <p class="quotes-author">— Psalm 139:13-14</p>
            </div>
        </div>

        {{-- SECTION 3: PHOTO SLIDER --}}
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
            <div class="rsvp-content">
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
                        <i class="fas fa-map-marked-alt"></i><span>View Location</span><i
                            class="fas fa-external-link-alt" style="font-size:0.7rem;"></i>
                    </a>
                @endif
            </div>
        </div>

        {{-- SECTION 6: CLOSING --}}
        <div class="fullscreen-section section-closing fade-section" data-index="5">
            <div class="closing-content">
                <p class="closing-text"><i class="fas fa-heart" style="margin-right:10px;font-size:0.7em;"></i>With
                    Love & Gratitude<i class="fas fa-heart" style="margin-left:10px;font-size:0.7em;"></i></p>
                <div class="closing-divider"></div>
                <p class="closing-name" style="font-family: 'Sloop', sans-serif;">
                    {{ $guest->event->title ?? 'Belva' }}</p>
                <p class="closing-thanks"><i class="far fa-smile" style="margin-right:5px;"></i>Thank you for being
                    part of this special moment</p>
            </div>
        </div>

    </div>

    <script>
        // Generate sparkles
        (function() {
            var container = document.getElementById('sparkleContainer');
            if (!container) return;
            var frag = document.createDocumentFragment();
            for (var i = 0; i < 25; i++) {
                var sparkle = document.createElement('div');
                sparkle.classList.add('sparkle');
                sparkle.style.left = (Math.random() * 95) + '%';
                sparkle.style.top = (Math.random() * 95) + '%';
                sparkle.style.animationDuration = (Math.random() * 3 + 2) + 's';
                sparkle.style.animationDelay = (Math.random() * 4) + 's';
                frag.appendChild(sparkle);
            }
            container.appendChild(frag);
        })();

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
        // SCROLL SYSTEM
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
                    if (currentSection > 0) goToSection(currentSection - 1);
                } else {
                    if (currentSection < totalSections - 1) goToSection(currentSection + 1);
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
                if (Math.abs(sx - ex) > 50) {
                    slidePhoto(sx > ex ? 1 : -1);
                    e.stopPropagation();
                }
            });
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
