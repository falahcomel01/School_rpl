<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Login | SMA Kanjeng Sepuh Sidayu</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,800;0,900;1,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ── ROOT VARIABLES ── */
        :root {
            --navy:   #0a192f;
            --navy-light: #112240;
            --blue:   #2563eb;
            --blue-l: #60a5fa;
            --gold:   #fbbf24;
            --gold-gradient: linear-gradient(135deg, #fcd34d 0%, #f59e0b 100%);
            --text-white: #e2e8f0;
        }

        /* ── RESET & LAYOUT FIX ── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            height: 100%; width: 100%;
            font-family: 'Plus Jakarta Sans', sans-serif; /* Font modern & bersih */
            background-color: #f8fafd; color: #0f172a;
            overflow: hidden; /* NO SCROLL */
            -webkit-font-smoothing: antialiased;
        }

        .main-container {
            display: flex;
            width: 100%;
            height: 100vh;
        }

        /* ══════════════════════════════════════
           LEFT PANEL (THE PREMIUM BRAND SIDE)
        ══════════════════════════════════════ */
        .panel-left {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            background: radial-gradient(circle at top right, #1e3a8a 0%, var(--navy) 100%);
            padding: 3rem;
            overflow: hidden;
        }

        /* Ambient Background Light */
        .panel-left::before {
            content: ''; position: absolute; top: -20%; left: -20%;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(37,99,235,0.15) 0%, transparent 70%);
            filter: blur(60px); z-index: 0;
        }
        .grid-pattern {
            position: absolute; inset: 0;
            background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 40px 40px; z-index: 0;
        }

        /* ══════════════════════════════════════
           GLASS CARD CONTAINER (The Focus)
        ══════════════════════════════════════ */
        .brand-card {
            position: relative; z-index: 10;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 3rem 2rem;
            text-align: center;
            max-width: 420px;
            width: 100%;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: fadeInCard 1s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        /* Top decorative accent on card */
        .brand-card::before {
            content: ''; position: absolute; top: 0; left: 50%; transform: translateX(-50%);
            width: 60px; height: 4px;
            background: var(--gold-gradient);
            border-radius: 0 0 4px 4px;
        }

        /* ══════════════════════════════════════
           LOGO STYLING (Floating & Glowing)
        ══════════════════════════════════════ */
        .logo-wrapper {
            position: relative;
            width: 110px; height: 110px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            background: linear-gradient(145deg, rgba(255,255,255,0.1), rgba(255,255,255,0.02));
            box-shadow: 
                0 0 0 1px rgba(255,255,255,0.1),
                0 10px 30px rgba(0,0,0,0.3),
                0 0 20px rgba(37,99,235,0.2); /* Blue Glow */
            display: flex; align-items: center; justify-content: center;
            animation: floatLogo 6s ease-in-out infinite;
        }

        .brand-logo-img {
            width: 90px; height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255,255,255,0.1);
            z-index: 2;
        }

        /* Badge Excellence (Top Right of Logo) */
        .badge-excellence {
            position: absolute; top: -5px; right: -5px;
            background: var(--gold-gradient);
            color: #fff;
            font-size: 0.65rem; font-weight: 800;
            padding: 4px 8px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
            z-index: 3;
            text-transform: uppercase; letter-spacing: 0.5px;
        }

        /* ══════════════════════════════════════
           TYPOGRAPHY STYLING
        ══════════════════════════════════════ */
        .school-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 0.25rem;
            letter-spacing: -0.5px;
            line-height: 1.2;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .location-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(251, 191, 36, 0.15); /* Gold bg low opacity */
            color: var(--gold);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem; font-weight: 600;
            letter-spacing: 0.5px; text-transform: uppercase;
            border: 1px solid rgba(251, 191, 36, 0.3);
            margin-bottom: 2rem;
        }

        /* Divider Elegant */
        .divider-elegant {
            width: 40px; height: 2px;
            background: rgba(255,255,255,0.2);
            margin: 0 auto 1.5rem;
            border-radius: 2px;
        }

        /* Headline Main */
        .hero-headline {
            font-family: 'Playfair Display', serif;
            font-size: 2rem; /* Default */
            font-weight: 700;
            color: #fff;
            line-height: 1.3;
            margin-bottom: 0.5rem;
        }

        .hero-accent {
            background: linear-gradient(to right, #fbbf24, #fcd34d, #fbbf24);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }

        .live-badge {
            margin-top: 2rem;
            display: inline-flex; align-items: center; gap: 8px;
            padding: 6px 14px; border-radius: 50px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #34d399; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;
        }
        .live-dot {
            width: 6px; height: 6px; background: #10b981; border-radius: 50%;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            animation: pulse-green 2s infinite;
        }

        /* ══════════════════════════════════════
           RIGHT PANEL (FORM - Cleaned)
        ══════════════════════════════════════ */
        .panel-right {
            width: 450px;
            flex-shrink: 0;
            display: flex; flex-direction: column; justify-content: center;
            background: #f8fafc;
            padding: 2.5rem;
            position: relative; overflow: hidden;
        }
        
        .panel-right::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, var(--navy), var(--blue), var(--gold));
        }

        .form-wrap { width: 100%; z-index: 5; }
        
        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem; font-weight: 900; color: var(--navy);
            margin-bottom: 0.5rem;
        }
        .form-desc { color: #64748b; font-size: 0.9rem; margin-bottom: 2rem; }

        .input-group { margin-bottom: 1.25rem; }
        .input-label { display: block; font-size: 0.75rem; font-weight: 700; color: #475569; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; }
        
        .input-wrap { position: relative; }
        .input-prefix-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; transition: 0.3s; }
        
        .form-input {
            width: 100%; padding: 14px 14px 14px 42px;
            border: 1.5px solid #e2e8f0; border-radius: 10px;
            font-size: 1rem; transition: 0.3s; background: #fff;
        }
        .form-input:focus { border-color: var(--blue); box-shadow: 0 0 0 4px rgba(37,99,235,0.1); outline: none; }
        .form-input:focus + .input-prefix-icon { color: var(--blue); }

        .pw-toggle { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); border: none; background: none; cursor: pointer; color: #94a3b8; }

        .btn-login {
            width: 100%; padding: 14px; background: var(--navy); color: white;
            border: none; border-radius: 10px; font-weight: 700; font-size: 1rem;
            cursor: pointer; transition: 0.3s; margin-top: 1rem;
            box-shadow: 0 10px 15px -3px rgba(15, 23, 42, 0.2);
        }
        .btn-login:hover { background: var(--blue); transform: translateY(-2px); box-shadow: 0 20px 25px -5px rgba(37,99,235,0.3); }

        /* ── ANIMATIONS ── */
        @keyframes fadeInCard { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes floatLogo { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
        @keyframes pulse-green { 0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); } 70% { box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); } 100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); } }

        /* ── RESPONSIVE (Still Fixed) ── */
        @media (max-width: 900px) {
            .main-container { flex-direction: column; }
            .panel-left { flex: none; height: 38%; padding: 1.5rem; }
            .brand-card { padding: 1.5rem 1rem; border-radius: 16px; max-width: 100%; }
            .logo-wrapper { width: 80px; height: 80px; }
            .brand-logo-img { width: 65px; height: 65px; }
            .school-name { font-size: 1.4rem; }
            .hero-headline { font-size: 1.3rem; }
            .location-badge { font-size: 0.65rem; padding: 3px 10px; margin-bottom: 1rem; }
            
            .panel-right { width: 100%; height: 62%; padding: 1.5rem; }
            .form-title { font-size: 1.8rem; }
        }
        
        /* Very Small Screens */
        @media (max-width: 480px) {
            .brand-card { padding: 1rem; }
            .hero-headline { font-size: 1.1rem; }
            .school-name { font-size: 1.2rem; }
        }
    </style>
</head>
<body>

    <div class="main-container">

        <!-- PANEL KIRI: PREMIUM BRANDING -->
        <div class="panel-left">
            <div class="grid-pattern"></div>

            <!-- Kartu Kaca Utama -->
            <div class="brand-card">
                
                <!-- Logo Area -->
                <div class="logo-wrapper">
                    <span class="badge-excellence">Official</span>
                    <!-- FOTO ASLI KAMU -->
                    <img src="{{ asset('image/logo-sekolah.jpg') }}" 
                         alt="Logo SMA Kanjeng Sepuh" 
                         class="brand-logo-img"
                         onerror="this.src='https://ui-avatars.com/api/?name=SMA+Kanjeng&background=0f2557&color=fbbf24&font-size=0.3'">
                </div>

                <!-- Nama Sekolah -->
                <h2 class="school-name">SMA Kanjeng Sepuh</h2>
                
                <!-- Lokasi Badge -->
                <div class="location-badge">
                    <i class="fas fa-map-marker-alt"></i> Sidayu, Gresik
                </div>

                <!-- Garis Pembatas Elegan -->
                <div class="divider-elegant"></div>

                <!-- Headline -->
                <h1 class="hero-headline">
                    Selamat Datang<br>
                    di <span class="hero-accent">Portal Akademik</span>
                </h1>

                <!-- Status Live -->
                <div class="live-badge">
                    <span class="live-dot"></span> Sistem Terintegrasi
                </div>

            </div>
        </div>

        <!-- PANEL KANAN: LOGIN FORM -->
        <div class="panel-right">
            <div class="form-wrap">
                <h2 class="form-title">Login</h2>
                <p class="form-desc">Silakan masuk untuk mengakses fitur akademik.</p>

                <form id="loginForm" onsubmit="event.preventDefault();">
                    <div class="input-group">
                        <label class="input-label">Username / NIS</label>
                        <div class="input-wrap">
                            <i class="fas fa-user input-prefix-icon"></i>
                            <input type="text" class="form-input" placeholder="Contoh: user123" required autofocus>
                        </div>
                    </div>

                    <div class="input-group">
                        <label class="input-label">Password</label>
                        <div class="input-wrap">
                            <i class="fas fa-lock input-prefix-icon"></i>
                            <input type="password" class="form-input" id="pass" placeholder="••••••••" required>
                            <button type="button" class="pw-toggle" onclick="document.getElementById('pass').type = (document.getElementById('pass').type==='password'?'text':'password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">Masuk Sekarang</button>
                    
                    <div style="text-align: center; margin-top: 1rem; font-size: 0.8rem; color: #94a3b8;">
                        <a href="#" style="color: var(--blue); text-decoration: none; font-weight: 600;">Lupa password?</a>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        // Simple logic for toggling password if needed (handled inline above but good to have here)
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = this.querySelector('.btn-login');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            setTimeout(() => {
                btn.innerHTML = 'Login Berhasil';
                btn.style.background = '#10b981';
            }, 1500);
        });
    </script>

</body>
</html>