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
           NAVBAR PREMIUM LIMPIO
        ============================================= */
        .navbar {
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            z-index: 999;
            background-color: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #1a1a1a;
            padding: 1.2rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-logo {
            font-size: 1.4rem;
            font-weight: 900;
            text-transform: uppercase;
            color: #ffffff;
            letter-spacing: 0.05em;
        }

        .navbar-logo span { color: #dc2626; }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .btn-nav-outline {
            border: 1px solid #3f3f46;
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 0.35rem;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            transition: all 0.2s;
        }

        .btn-nav-outline:hover {
            border-color: #ffffff;
            background-color: rgba(255, 255, 255, 0.05);
        }

        .btn-nav-primary {
            background-color: #dc2626;
            color: white !important;
            padding: 0.5rem 1rem;
            border-radius: 0.35rem;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            transition: all 0.2s;
        }

        .btn-nav-primary:hover {
            background-color: #ef4444;
        }

        /* =============================================
           HERO SECTION LOCAL Y SEGURO
        ============================================= */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-bg-split {
            position: absolute;
            inset: 0;
            display: flex;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .hero-split-left {
            flex: 1;
            background-image: linear-gradient(to bottom, rgba(0,0,0,0.35), rgba(0,0,0,0.75)), url('{{ asset("img/uno.jpg") }}');
            background-size: cover;
            background-position: 65% center;
            border-right: 1px solid #1a1a1a;
        }

        .hero-split-right {
            flex: 1;
            background-image: linear-gradient(to bottom, rgba(0,0,0,0.35), rgba(0,0,0,0.75)), url('{{ asset("img/dos.jpg") }}');
            background-size: cover;
            background-position: center center;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            padding: 2rem;
        }

        .hero-title {
            font-size: clamp(2.8rem, 7vw, 5.5rem);
            font-weight: 900;
            text-transform: uppercase;
            line-height: 1.05;
            margin-bottom: 1.5rem;
            letter-spacing: 0.02em;
            color: #ffffff;
            text-shadow: 0 4px 12px rgba(0,0,0,0.7);
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: #e4e4e7;
            line-height: 1.7;
            margin-bottom: 2.5rem;
            max-width: 520px;
            margin-left: auto;
            margin-right: auto;
            font-weight: 500;
            text-shadow: 0 2px 8px rgba(0,0,0,0.8);
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
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
        }

        .btn-hero-primary:hover {
            background-color: #b91c1c;
            box-shadow: 0 0 30px rgba(220, 38, 38, 0.5);
            transform: translateY(-2px);
        }

        .btn-hero-outline {
            padding: 0.9rem 2.4rem;
            font-size: 1rem;
            border-radius: 0.5rem;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            border: 1px solid #3f3f46;
            font-weight: 900;
            text-transform: uppercase;
            cursor: pointer;
            backdrop-filter: blur(4px);
            transition: all 0.25s;
            letter-spacing: 0.05em;
        }

        .btn-hero-outline:hover {
            border-color: #ffffff;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        /* =============================================
           SECCIÓN DEL CATÁLOGO
        ============================================= */
        .products-section {
            padding: 5rem 2rem;
            max-width: 1300px;
            margin: 0 auto;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 3rem;
            text-align: left;
            border-left: 4px solid #dc2626;
            padding-left: 1rem;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background-color: #0b0b0c;
            border: 1px solid #18181b;
            border-radius: 0.5rem;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s, border-color 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            border-color: #3f3f46;
        }

        .product-image-wrapper {
            position: relative;
            width: 100%;
            padding-top: 120%; /* Proporción de la foto */
            background-color: #18181b;
            overflow: hidden;
        }

        .product-image-wrapper img {
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .badge-sale {
            position: absolute;
            top: 15px; left: 15px;
            background-color: #dc2626;
            color: #ffffff;
            font-size: 0.7rem;
            font-weight: 900;
            padding: 0.3rem 0.8rem;
            text-transform: uppercase;
            border-radius: 0.25rem;
            letter-spacing: 0.05em;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }

        .product-prices {
            display: flex;
            gap: 0.8rem;
            font-size: 0.9rem;
            font-weight: 700;
            align-items: center;
        }

        .old-price {
            color: #71717a;
            text-decoration: line-through;
            font-size: 0.85rem;
        }

        .current-price {
            color: #dc2626;
        }

        /* =============================================
           FOOTER
        ============================================= */
        .footer {
            background-color: #09090b;
            border-top: 1px solid #18181b;
            padding: 2.5rem 2rem;
            text-align: center;
        }

        .footer-logo { font-size: 1.4rem; font-weight: 900; text-transform: uppercase; margin-bottom: 0.5rem; }
        .footer-logo span { color: #dc2626; }
        .footer-copy { color: #3f3f46; font-size: 0.8rem; }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="navbar-logo">Now<span>Style</span> Store</div>
        <div class="nav-links">
            <a href="#catalogo" style="color: #a1a1aa; font-weight: 700; margin-right: 1rem; font-size: 0.85rem; text-transform: uppercase;">Catálogo</a>
            <a href="{{ route('login') }}" class="btn-nav-outline">Ya tengo cuenta</a>
            <a href="{{ route('register') }}" class="btn-nav-primary">Registrarse</a>
        </div>
    </nav>

    <section class="hero" id="hero">
        <div class="hero-bg-split">
            <div class="hero-split-left"></div>
            <div class="hero-split-right"></div>
        </div>

        <div class="hero-content">
            <h1 class="hero-title">NOW<br>STYLE<br>STORE</h1>
            <p class="hero-subtitle">Tu Estilo, Tu Identidad, Tu Marca</p>

            <div class="hero-buttons">
                <a href="#catalogo" class="btn-hero-primary">🔥 Ver Catálogo</a>
                <a href="{{ route('register') }}" class="btn-hero-outline">Registrarse</a>
            </div>
        </div>
    </section>

 <section class="products-section" id="catalogo">
        <h2 class="section-title">Nuestra Colección</h2>
        
        <div class="products-grid">
            
            <div class="product-card">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/buzo1.jpg') }}" alt="Oversized Hoodie">
                    <span class="badge-sale">Oferta</span>
                </div>
                <div class="product-info">
                    <div class="product-name">Oversized Hoodie Premium</div>
                    <div class="product-prices">
                        <span class="old-price">₱56.00 PHP</span>
                        <span class="current-price">₱45.00 PHP</span>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/chaqueta1.jpg') }}" alt="Street Jacket Essential">
                    <span class="badge-sale">Oferta</span>
                </div>
                <div class="product-info">
                    <div class="product-name">Street Jacket Essential</div>
                    <div class="product-prices">
                        <span class="old-price">₱67.00 PHP</span>
                        <span class="current-price">₱45.00 PHP</span>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/buzo2.jpg') }}" alt="Urban Hoodie">
                    <span class="badge-sale">Popular</span>
                </div>
                <div class="product-info">
                    <div class="product-name">Urban Hoodie Signature</div>
                    <div class="product-prices">
                        <span class="old-price">₱67.00 PHP</span>
                        <span class="current-price">₱56.00 PHP</span>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/pantalon1.jpg') }}" alt="Jogger Cargo">
                    
                </div>
                <div class="product-info">
                    <div class="product-name">pantalon baggy</div>
                    <div class="product-prices">
                        <span class="old-price">$120000</span>
                        <span class="current-price">$100.000</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <footer class="footer">
        <div class="footer-logo">Now<span>Style</span> Store</div>
        <div class="footer-copy">&copy; 2026 NowStyle Store. Todos los derechos reservados.</div>
    </footer>

</body>
</html>