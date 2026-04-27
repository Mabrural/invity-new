<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Belva's 17th Birthday Invitation</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Inter:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Great+Vibes&family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f0eb;
            color: #4a4a4a;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
            line-height: 1.6;
        }

        .invitation-container {
            max-width: 480px;
            margin: 0 auto;
            background: #f5f0eb;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 40px rgba(0,0,0,0.1);
        }

        /* Header Section */
        .header-section {
            text-align: center;
            padding: 50px 30px 20px;
            position: relative;
        }

        .top-ornament {
            font-size: 2.5rem;
            color: #c4a882;
            margin-bottom: 15px;
            letter-spacing: 8px;
        }

        .header-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.4rem;
            color: #8b7355;
            letter-spacing: 3px;
            margin-bottom: 30px;
            font-weight: 400;
        }

        .header-line {
            width: 120px;
            height: 1px;
            background: linear-gradient(90deg, transparent, #c4a882, transparent);
            margin: 0 auto 25px;
        }

        .header-subtitle {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 1.2rem;
            color: #a0896b;
            letter-spacing: 2px;
            font-weight: 400;
        }

        /* Main Photo Section */
        .photo-section {
            position: relative;
            width: 100%;
            height: 70vh;
            max-height: 600px;
            overflow: hidden;
            margin-bottom: 0;
        }

        .photo-slider {
            width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .slider-track {
            display: flex;
            height: 100%;
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .slider-track img {
            min-width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
        }

        .slider-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.9);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            color: #8b7355;
            font-size: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }

        .slider-nav:hover {
            background: #fff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        .slider-nav.prev {
            left: 15px;
        }

        .slider-nav.next {
            right: 15px;
        }

        .slider-dots {
            position: absolute;
            bottom: 80px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 10;
        }

        .slider-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255,255,255,0.6);
            border: 1px solid rgba(139,115,85,0.3);
            cursor: pointer;
            transition: all 0.3s;
        }

        .slider-dot.active {
            background: #8b7355;
            width: 24px;
            border-radius: 4px;
        }

        .photo-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(245,240,235,1) 0%, rgba(245,240,235,0.9) 20%, transparent 100%);
            padding: 60px 30px 30px;
            text-align: center;
            z-index: 5;
        }

        .overlay-name {
            font-family: 'Great Vibes', cursive;
            font-size: 3.5rem;
            color: #6b5b4b;
            margin-bottom: 5px;
            font-weight: 400;
            line-height: 1;
        }

        .overlay-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            color: #8b7355;
            letter-spacing: 2px;
            font-weight: 400;
        }

        /* Content Section */
        .content-section {
            padding: 20px 30px 40px;
            background: #f5f0eb;
        }

        .verse-container {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .verse-icon {
            font-size: 2rem;
            color: #c4a882;
            margin-bottom: 20px;
            opacity: 0.7;
        }

        .verse-text {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 1.3rem;
            color: #6b5b4b;
            line-height: 1.8;
            font-weight: 400;
            max-width: 350px;
            margin: 0 auto;
        }

        .verse-reference {
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.9rem;
            color: #a0896b;
            margin-top: 15px;
            letter-spacing: 1px;
        }

        .divider {
            width: 80px;
            height: 1px;
            background: linear-gradient(90deg, transparent, #c4a882, transparent);
            margin: 40px auto;
        }

        .event-details {
            text-align: center;
            margin-bottom: 40px;
        }

        .detail-item {
            margin-bottom: 35px;
        }

        .detail-icon {
            font-size: 2rem;
            color: #c4a882;
            margin-bottom: 12px;
        }

        .detail-label {
            font-family: 'Inter', sans-serif;
            font-size: 0.7rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #a0896b;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .detail-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.3rem;
            color: #4a4a4a;
            font-weight: 500;
            line-height: 1.6;
        }

        .detail-subvalue {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1rem;
            color: #6b5b4b;
            margin-top: 5px;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin: 40px 0;
            align-items: center;
        }

        .btn-rsvp {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 40px;
            background: #8b7355;
            color: #fff;
            border: none;
            border-radius: 50px;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 8px 25px rgba(139,115,85,0.3);
        }

        .btn-rsvp:hover {
            background: #7a6248;
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(139,115,85,0.4);
        }

        .btn-location {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 40px;
            background: transparent;
            color: #8b7355;
            border: 1.5px solid #c4a882;
            border-radius: 50px;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-location:hover {
            background: rgba(196,168,130,0.1);
            border-color: #8b7355;
        }

        .closing-section {
            text-align: center;
            margin-top: 50px;
            padding-bottom: 40px;
        }

        .closing-text {
            font-family: 'Great Vibes', cursive;
            font-size: 2.8rem;
            color: #6b5b4b;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .closing-icon {
            font-size: 1.5rem;
            color: #c4a882;
            margin-bottom: 20px;
        }

        .closing-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            color: #8b7355;
            letter-spacing: 2px;
            font-weight: 500;
        }

        /* Music Toggle */
        .music-toggle {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(139,115,85,0.9);
            border: none;
            color: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            transition: all 0.3s;
        }

        .music-toggle:hover {
            background: #7a6248;
            transform: scale(1.05);
        }

        .music-toggle.playing {
            animation: musicPulse 2s ease-in-out infinite;
        }

        @keyframes musicPulse {
            0%, 100% { box-shadow: 0 5px 20px rgba(0,0,0,0.2); }
            50% { box-shadow: 0 5px 30px rgba(139,115,85,0.5); }
        }

        @media (max-width: 480px) {
            .photo-section {
                height: 60vh;
                max-height: 500px;
            }
            
            .overlay-name {
                font-size: 2.8rem;
            }
            
            .content-section {
                padding: 20px 20px 40px;
            }
            
            .verse-text {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <div class="invitation-container">
        <!-- Header -->
        <div class="header-section">
            <div class="top-ornament">❦</div>
            <h2 class="header-title">THE CELEBRATION OF</h2>
            <div class="header-line"></div>
            <p class="header-subtitle">Belva's 17th Birthday</p>
        </div>

        <!-- Photo Section -->
        <div class="photo-section">
            <div class="photo-slider" id="photoSlider">
                <div class="slider-track" id="sliderTrack">
                    @php
                        $photos = [];
                        if (isset($guest) && $guest->event) {
                            if ($guest->event->event_photo_1 ?? false) $photos[] = asset('storage/' . $guest->event->event_photo_1);
                            if ($guest->event->event_photo_2 ?? false) $photos[] = asset('storage/' . $guest->event->event_photo_2);
                            if ($guest->event->event_photo_3 ?? false) $photos[] = asset('storage/' . $guest->event->event_photo_3);
                        }
                        if (empty($photos)) {
                            $photos[] = 'https://images.unsplash.com/photo-1519741497674-611481863552?w=600';
                            $photos[] = 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=600';
                        }
                    @endphp
                    
                    @foreach($photos as $photo)
                        <img src="{{ $photo }}" alt="Belva" loading="lazy">
                    @endforeach
                </div>
                
                @if(count($photos) > 1)
                    <button class="slider-nav prev" onclick="slidePhoto(-1)">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="slider-nav next" onclick="slidePhoto(1)">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <div class="slider-dots" id="sliderDots">
                        @foreach($photos as $index => $photo)
                            <button class="slider-dot {{ $index === 0 ? 'active' : '' }}" 
                                    onclick="goToSlide({{ $index }})"></button>
                        @endforeach
                    </div>
                @endif
            </div>
            
            <div class="photo-overlay">
                <h1 class="overlay-name">Belva</h1>
                <p class="overlay-title">Seventeen Years of Grace</p>
            </div>
        </div>

        <!-- Content -->
        <div class="content-section">
            <div class="verse-container">
                <div class="verse-icon">
                    <i class="fas fa-feather-alt"></i>
                </div>
                <p class="verse-text">
                    "For you formed my inward parts; you knitted me together in my mother's womb. I praise you, for I am fearfully and wonderfully made. Wonderful are your works; my soul knows it very well."
                </p>
                <p class="verse-reference">— Psalm 139:13-14</p>
            </div>

            <div class="divider"></div>

            <div class="event-details">
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <p class="detail-label">Date</p>
                    <p class="detail-value">
                        {{ isset($guest) && $guest->event ? \Carbon\Carbon::parse($guest->event->event_date ?? now())->format('d F Y') : '15 March 2025' }}
                    </p>
                </div>

                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <p class="detail-label">Venue</p>
                    <p class="detail-value">
                        {{ isset($guest) && $guest->event ? ($guest->event->venue ?? 'Grand Ballroom') : 'Grand Ballroom' }}
                    </p>
                    <p class="detail-subvalue">
                        {{ isset($guest) && $guest->event ? ($guest->event->event_time ?? '7:00 PM - 10:00 PM') : '7:00 PM - 10:00 PM' }}
                    </p>
                </div>

                @if(isset($guest) && $guest->event && ($guest->event->dresscode ?? false))
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-tshirt"></i>
                        </div>
                        <p class="detail-label">Dress Code</p>
                        <p class="detail-value">{{ $guest->event->dresscode }}</p>
                    </div>
                @endif
            </div>

            <div class="action-buttons">
                @if(isset($guest) && $guest->event && ($guest->event->no_wa_confirmation ?? false))
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $guest->event->no_wa_confirmation) }}?text={{ urlencode('Hello! I would like to confirm my attendance - ' . ($guest->name ?? 'Guest')) }}" 
                       target="_blank" 
                       rel="noopener" 
                       class="btn-rsvp">
                        <i class="fab fa-whatsapp"></i>
                        <span>RSVP Now</span>
                    </a>
                @else
                    <a href="#" class="btn-rsvp">
                        <i class="fab fa-whatsapp"></i>
                        <span>RSVP Now</span>
                    </a>
                @endif

                @if(isset($guest) && $guest->event && ($guest->event->link_googlemaps ?? false))
                    <a href="{{ $guest->event->link_googlemaps }}" 
                       target="_blank" 
                       rel="noopener" 
                       class="btn-location">
                        <i class="fas fa-map-marked-alt"></i>
                        <span>View Location</span>
                    </a>
                @else
                    <a href="#" class="btn-location">
                        <i class="fas fa-map-marked-alt"></i>
                        <span>View Location</span>
                    </a>
                @endif
            </div>

            <div class="divider"></div>

            <div class="closing-section">
                <p class="closing-text">With Love & Gratitude</p>
                <div class="closing-icon">♡</div>
                <p class="closing-name">
                    {{ isset($guest) && $guest->event ? ($guest->event->title ?? 'Belva') : 'Belva' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Music Toggle -->
    <button class="music-toggle" id="musicToggle" onclick="toggleMusic()">
        <i class="fas fa-music"></i>
    </button>
    
    <audio id="bgMusic" preload="auto" loop>
        <source src="{{ asset('assets/blessingmaria.mp3') }}" type="audio/mpeg">
    </audio>

    <script>
        // Photo Slider
        let currentSlide = 0;
        const totalSlides = {{ count($photos) }};
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

        // Touch support for slider
        const slider = document.getElementById('photoSlider');
        if (slider) {
            let touchStartX = 0;
            let touchEndX = 0;

            slider.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });

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
        }

        startAutoSlide();

        // Music Player
        const bgMusic = document.getElementById('bgMusic');
        const musicToggle = document.getElementById('musicToggle');
        let isPlaying = false;

        function toggleMusic() {
            if (!bgMusic) return;
            
            if (isPlaying) {
                bgMusic.pause();
                musicToggle.classList.remove('playing');
            } else {
                bgMusic.play().then(() => {
                    musicToggle.classList.add('playing');
                }).catch(() => {
                    // Autoplay blocked
                });
            }
            isPlaying = !isPlaying;
        }

        if (bgMusic) {
            bgMusic.addEventListener('play', () => {
                isPlaying = true;
                musicToggle?.classList.add('playing');
            });
            
            bgMusic.addEventListener('pause', () => {
                isPlaying = false;
                musicToggle?.classList.remove('playing');
            });
        }

        // Auto-play music on first user interaction
        document.addEventListener('click', function initMusic() {
            if (bgMusic && !isPlaying) {
                bgMusic.play().then(() => {
                    musicToggle?.classList.add('playing');
                    isPlaying = true;
                }).catch(() => {});
            }
        }, { once: true });
    </script>
</body>
</html>