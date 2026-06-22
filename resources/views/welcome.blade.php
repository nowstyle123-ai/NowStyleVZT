<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NowStyle Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">

    <style>
        /* =============================================
           RESET Y BASE
        ============================================= */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #000000;
            color: #ffffff;
            overflow-x: hidden;
        }

        a { text-decoration: none; }

        /* =============================================
           PARTÍCULAS DE FONDO
        ============================================= */
        #particles {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background-color: #dc2626;
            border-radius: 50%;
            opacity: 0;
            animation: floatParticle linear infinite;
        }

        @keyframes floatParticle {
            0%   { transform: translateY(100vh) scale(0); opacity: 0; }
            10%  { opacity: 0.6; }
            90%  { opacity: 0.3; }
            100% { transform: translateY(-10vh) scale(1); opacity: 0; }
        }

        /* =============================================
           NAVBAR
        ============================================= */
        .navbar {
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            z-index: 999;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #1a1a1a;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s;
        }

        .navbar-logo {
            font-size: 1.4rem;
            font-weight: 900;
            text-transform: uppercase;
            color: #ffffff;
            letter-spacing: 0.05em;
        }

        .navbar-logo span { color: #dc2626; }

        .navbar-buttons { display: flex; gap: 0.75rem; }

        .btn {
            padding: 0.6rem 1.4rem;
            border-radius: 0.5rem;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.25s ease;
            letter-spacing: 0.03em;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid #3f3f46;
            color: #ffffff;
        }

        .btn-outline:hover {
            border-color: #dc2626;
            color: #dc2626;
            box-shadow: 0 0 12px rgba(220, 38, 38, 0.3);
        }

        .btn-primary {
            background-color: #dc2626;
            border: 1px solid #dc2626;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #b91c1c;
            box-shadow: 0 0 18px rgba(220, 38, 38, 0.5);
            transform: translateY(-1px);
        }

        /* =============================================
           HERO CON PARALLAX
        ============================================= */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 8rem 2rem 4rem;
            position: relative;
            overflow: hidden;
            background: #000;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse at 20% 50%, rgba(220, 38, 38, 0.12) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(220, 38, 38, 0.08) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 80%, rgba(220, 38, 38, 0.06) 0%, transparent 50%);
            will-change: transform;
        }

        /* Líneas decorativas */
        .hero-lines {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(220, 38, 38, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(220, 38, 38, 0.03) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
        }

        .hero-badge {
            display: inline-block;
            background-color: rgba(220, 38, 38, 0.1);
            border: 1px solid rgba(220, 38, 38, 0.4);
            color: #dc2626;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            padding: 0.45rem 1.2rem;
            border-radius: 2rem;
            margin-bottom: 1.5rem;
            animation: fadeInDown 0.8s ease both;
        }

        .hero-title {
            font-size: clamp(2.8rem, 7vw, 5.5rem);
            font-weight: 900;
            text-transform: uppercase;
            line-height: 1.05;
            margin-bottom: 1.5rem;
            animation: fadeInUp 0.9s ease 0.2s both;
        }

        .hero-title span { color: #dc2626; }

        .hero-title .outline-text {
            -webkit-text-stroke: 2px #dc2626;
            color: transparent;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: #a1a1aa;
            line-height: 1.7;
            margin-bottom: 2.5rem;
            max-width: 520px;
            margin-left: auto;
            margin-right: auto;
            animation: fadeInUp 0.9s ease 0.4s both;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 0.9s ease 0.6s both;
        }

        .btn-hero-primary {
            padding: 0.9rem 2.4rem;
            font-size: 1rem;
            border-radius: 0.5rem;
            background-color: #dc2626;
            color: white;
            border: none;
            font-weight: 900;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.25s;
            letter-spacing: 0.05em;
            position: relative;
            overflow: hidden;
        }

        .btn-hero-primary::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(rgba(255,255,255,0.1), transparent);
            opacity: 0;
            transition: opacity 0.2s;
        }

        .btn-hero-primary:hover {
            background-color: #b91c1c;
            box-shadow: 0 0 30px rgba(220, 38, 38, 0.5);
            transform: translateY(-2px);
        }

        .btn-hero-primary:hover::after { opacity: 1; }

        .btn-hero-outline {
            padding: 0.9rem 2.4rem;
            font-size: 1rem;
            border-radius: 0.5rem;
            background-color: transparent;
            color: white;
            border: 1px solid #3f3f46;
            font-weight: 900;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.25s;
            letter-spacing: 0.05em;
        }

        .btn-hero-outline:hover {
            border-color: #ffffff;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        /* Stats debajo del hero */
        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-top: 4rem;
            flex-wrap: wrap;
            animation: fadeInUp 0.9s ease 0.8s both;
        }

        .stat-item { text-align: center; }

        .stat-number {
            font-size: 2rem;
            font-weight: 900;
            color: #dc2626;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #a1a1aa;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        /* =============================================
           ANIMACIONES DE ENTRADA
        ============================================= */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(30px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

       
        .features {
            padding: 6rem 2rem;
            background-color: #09090b;
            border-top: 1px solid #18181b;
            position: relative;
            z-index: 1;
        }

        .section-header { text-align: center; margin-bottom: 3rem; }

        .section-tag {
            display: inline-block;
            color: #dc2626;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            margin-bottom: 0.75rem;
        }

        .section-title {
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            font-weight: 900;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .section-title span { color: #dc2626; }

        .section-subtitle {
            color: #a1a1aa;
            font-size: 0.95rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 1.5rem;
            max-width: 1100px;
            margin: 0 auto;
        }

        .feature-card {
            background-color: #000000;
            border: 1px solid #27272a;
            border-radius: 1rem;
            padding: 2rem 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            width: 100%; height: 2px;
            background: linear-gradient(90deg, transparent, #dc2626, transparent);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            border-color: #dc2626;
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(220, 38, 38, 0.15);
        }

        .feature-card:hover::before { transform: scaleX(1); }

        .feature-icon {
            font-size: 2.8rem;
            margin-bottom: 1rem;
            display: block;
        }

        .feature-card h3 {
            font-size: 1rem;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
            letter-spacing: 0.05em;
        }

        .feature-card p {
            font-size: 0.85rem;
            color: #a1a1aa;
            line-height: 1.6;
        }

       
        .gallery {
            padding: 6rem 2rem;
            background-color: #000000;
            border-top: 1px solid #18181b;
            position: relative;
            z-index: 1;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .gallery-card {
            background-color: #09090b;
            border: 1px solid #27272a;
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .gallery-card:hover {
            transform: translateY(-8px);
            border-color: #dc2626;
            box-shadow: 0 20px 40px rgba(220, 38, 38, 0.15);
        }

        .gallery-card-img {
            height: 220px;
            overflow: hidden;
            position: relative;
            background-color: #18181b;
        }

        .gallery-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
            filter: brightness(0.85);
        }

        .gallery-card:hover .gallery-card-img img {
            transform: scale(1.08);
            filter: brightness(1);
        }

        /* Overlay en hover */
        .gallery-card-img::after {
            content: 'Ver más →';
            position: absolute;
            inset: 0;
            background: rgba(220, 38, 38, 0.75);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-card:hover .gallery-card-img::after { opacity: 1; }

        .gallery-card-body { padding: 1.25rem; }

        .gallery-card-body h4 {
            font-size: 0.95rem;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 0.25rem;
            letter-spacing: 0.03em;
        }

        .gallery-card-price {
            font-size: 1rem;
            font-weight: 900;
            color: #dc2626;
            margin-bottom: 0.25rem;
        }

        .gallery-card-body p {
            font-size: 0.8rem;
            color: #71717a;
        }

        .gallery-cta {
            text-align: center;
            margin-top: 3rem;
        }

        .cta-banner {
            padding: 5rem 2rem;
            background: linear-gradient(135deg, #1a0000 0%, #000000 50%, #0d0000 100%);
            border-top: 1px solid #27272a;
            text-align: center;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .cta-banner::before {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(220,38,38,0.12) 0%, transparent 70%);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
        }

        .cta-banner h2 {
            font-size: clamp(1.8rem, 4vw, 3rem);
            font-weight: 900;
            text-transform: uppercase;
            margin-bottom: 1rem;
            position: relative;
        }

        .cta-banner h2 span { color: #dc2626; }

        .cta-banner p {
            color: #a1a1aa;
            font-size: 1rem;
            margin-bottom: 2rem;
            position: relative;
        }

       
        .footer {
            background-color: #09090b;
            border-top: 1px solid #18181b;
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .footer-logo {
            font-size: 1.5rem;
            font-weight: 900;
            text-transform: uppercase;
            margin-bottom: 0.75rem;
        }

        .footer-logo span { color: #dc2626; }

        .footer-desc {
            color: #a1a1aa;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
        }

        .footer-socials {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .social-btn {
            background-color: #18181b;
            border: 1px solid #27272a;
            color: #a1a1aa;
            padding: 0.6rem 1.2rem;
            border-radius: 0.5rem;
            font-size: 0.85rem;
            font-weight: 700;
            transition: all 0.25s;
        }

        .social-btn:hover {
            border-color: #dc2626;
            color: #dc2626;
            box-shadow: 0 0 12px rgba(220, 38, 38, 0.2);
            transform: translateY(-2px);
        }

        .footer-copy {
            color: #3f3f46;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>

    {{-- PARTÍCULAS --}}
    <div id="particles"></div>

    {{-- =============================================
         NAVBAR
    ============================================= --}}
    <nav class="navbar">
        <div class="navbar-logo">Now<span>Style</span> Store</div>
        <div class="navbar-buttons">
        </div>
    </nav>

    {{-- =============================================
         HERO
    ============================================= --}}
    <section class="hero" id="hero">
        <div class="hero-bg" id="heroBg"></div>
        <div class="hero-lines"></div>

        <div class="hero-content">
            <div class="hero-badge">✨ Nueva Colección 2026</div>

            <h1 class="hero-title">
                Tu Estilo,<br>
                Tu <span>Identidad</span><br>
                <span class="outline-text">Tu Marca</span>
            </h1>

            <p class="hero-subtitle">
                Ropa urbana de calidad con estampados únicos. Diseña tu propia prenda o elige entre nuestro catálogo exclusivo.
            </p>

            <div class="hero-buttons">
                <a href="{{ route('register') }}" class="btn-hero-primary">🔥 Comenzar Ahora</a>
                <a href="{{ route('login') }}" class="btn-hero-outline">Ya tengo cuenta</a>
            </div>

            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-number">+500</div>
                    <div class="stat-label">Clientes</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">+80</div>
                    <div class="stat-label">Productos</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Calidad</div>
                </div>
            </div>
        </div>
    </section>

    {{-- =============================================
         CARACTERÍSTICAS
    ============================================= --}}
    <section class="features">
        <div class="section-header animate-on-scroll">
            <div class="section-tag">¿Por qué elegirnos?</div>
            <h2 class="section-title">Lo Mejor de <span>NowStyle</span></h2>
            <p class="section-subtitle">Calidad, estilo y personalización en un solo lugar.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card animate-on-scroll">
                <span class="feature-icon">👕</span>
                <h3>Ropa de Calidad</h3>
                <p>Prendas seleccionadas con los mejores materiales del mercado.</p>
            </div>
            <div class="feature-card animate-on-scroll">
                <span class="feature-icon">🎨</span>
                <h3>Personalización</h3>
                <p>Crea tu propio diseño con frases, colores y estampados únicos.</p>
            </div>
            <div class="feature-card animate-on-scroll">
                <span class="feature-icon">🚀</span>
                <h3>Entrega Rápida</h3>
                <p>Recibe tu pedido en tiempo récord directo en tu puerta.</p>
            </div>
            <div class="feature-card animate-on-scroll">
                <span class="feature-icon">🔒</span>
                <h3>Compra Segura</h3>
                <p>Tus datos y pagos siempre protegidos con total confianza.</p>
            </div>
        </div>
    </section>

    {{-- =============================================
         GALERÍA DE PRODUCTOS
    ============================================= --}}
    <section class="gallery">
        <div class="section-header animate-on-scroll">
            <div class="section-tag">Catálogo</div>
            <h2 class="section-title">Nuestros <span>Productos</span></h2>
            <p class="section-subtitle">Una muestra de lo que te espera dentro.</p>
        </div>

        <div class="gallery-grid">
            <div class="gallery-card animate-on-scroll">
                <div class="gallery-card-img">
                    <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400&h=300&fit=crop" alt="Camiseta Urbana">
                </div>
                <div class="gallery-card-body">
                    <h4>Camisetas Urbanas</h4>
                    <div class="gallery-card-price">Desde $49.000 COP</div>
                    <p>Estilo y comodidad en cada prenda</p>
                </div>
            </div>

            <div class="gallery-card animate-on-scroll">
                <div class="gallery-card-img">
                    <img src="https://images.unsplash.com/photo-1551028719-00167b16eac5?w=400&h=300&fit=crop" alt="Chaqueta">
                </div>
                <div class="gallery-card-body">
                    <h4>Chaquetas</h4>
                    <div class="gallery-card-price">Desde $120.000 COP</div>
                    <p>Para los días que necesitas más estilo</p>
                </div>
            </div>

            <div class="gallery-card animate-on-scroll">
                <div class="gallery-card-img">
                    <img src="https://images.unsplash.com/photo-1542272604-787c3835535d?w=400&h=300&fit=crop" alt="Pantalones">
                </div>
                <div class="gallery-card-body">
                    <h4>Pantalones</h4>
                    <div class="gallery-card-price">Desde $89.000 COP</div>
                    <p>Cortes modernos para el día a día</p>
                </div>
            </div>

            <div class="gallery-card animate-on-scroll">
                <div class="gallery-card-img">
                    <img src="https://images.unsplash.com/photo-1588850561407-ed78c282e89b?w=400&h=300&fit=crop" alt="Accesorios">
                </div>
                <div class="gallery-card-body">
                    <h4>Accesorios</h4>
                    <div class="gallery-card-price">Desde $25.000 COP</div>
                    <p>El toque final que marca la diferencia</p>
                </div>
            </div>
        </div>

        <div class="gallery-cta animate-on-scroll">
            <a href="{{ route('register') }}" class="btn-hero-primary">Ver Catálogo Completo →</a>
        </div>
    </section>

    {{-- =============================================
         BANNER CTA
    ============================================= --}}
    <section class="cta-banner">
        <div class="animate-on-scroll">
            <h2>¿Listo para tu <span>próximo look?</span></h2>
            <p>Únete a NowStyle Store y descubre moda que habla por ti.</p>
            <a href="{{ route('register') }}" class="btn-hero-primary">🎯 Crear mi cuenta gratis</a>
        </div>
    </section>

    {{-- =============================================
         FOOTER
    ============================================= --}}
    <footer class="footer">
        <div class="footer-logo">Now<span>Style</span> Store</div>
        <p class="footer-desc">Moda urbana con identidad propia. Estampados únicos, calidad real.</p>

        <div class="footer-socials">
            <a href="#" class="social-btn">📸 Instagram</a>
            <a href="#" class="social-btn">🎵 TikTok</a>
            <a href="#" class="social-btn">💬 WhatsApp</a>
        </div>

        <p class="footer-copy">© {{ date('Y') }} NowStyle Store. Todos los derechos reservados.</p>
    </footer>

    {{-- =============================================
         JAVASCRIPT: Partículas + Parallax + ScrollAnimations
    ============================================= --}}
    <script>
        // ── Partículas flotantes ──────────────────
        const container = document.getElementById('particles');
        for (let i = 0; i < 40; i++) {
            const p = document.createElement('div');
            p.classList.add('particle');
            p.style.left          = Math.random() * 100 + 'vw';
            p.style.width         = (Math.random() * 3 + 1) + 'px';
            p.style.height        = p.style.width;
            p.style.animationDuration  = (Math.random() * 15 + 10) + 's';
            p.style.animationDelay     = (Math.random() * 10) + 's';
            p.style.opacity       = Math.random() * 0.5;
            container.appendChild(p);
        }

        // ── Parallax en el hero ──────────────────
        const heroBg = document.getElementById('heroBg');
        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            if (heroBg) {
                heroBg.style.transform = `translateY(${scrollY * 0.4}px)`;
            }
        });

        // ── Animaciones al hacer scroll ──────────
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, i * 100);
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
    </script>

</body>
</html>