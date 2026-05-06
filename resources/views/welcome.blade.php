<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMA Kanjeng Sepuh Sidayu — Sistem Informasi Akademik</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['"Playfair Display"', 'serif'],
                        sans: ['"DM Sans"', 'sans-serif'],
                    },
                    colors: {
                        navy:   { DEFAULT: '#0f2557', 50: '#eef3ff', 100: '#dce6ff', 500: '#2563eb', 700: '#1d4ed8', 900: '#0f2557' },
                        sky:    { soft: '#f0f7ff' },
                    },
                }
            }
        }
    </script>

    <style>
        :root {
            --navy:   #0f2557;
            --blue:   #2563eb;
            --blue-l: #60a5fa;
            --gold:   #f59e0b;
            --white:  #ffffff;
            --slate:  #64748b;
            --bg:     #f8fafd;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: #1e293b;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 3px; }

        #loading-screen {
            position: fixed; inset: 0; z-index: 9999;
            background: linear-gradient(145deg, #060f2e 0%, #0f2557 45%, #1d4ed8 100%);
            display: flex; flex-direction: column;
            justify-content: center; align-items: center;
            transition: opacity 0.9s cubic-bezier(0.4,0,0.2,1), transform 0.9s ease;
        }
        #loading-screen.hidden { opacity: 0; pointer-events: none; transform: scale(1.03); }

        #loading-screen::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px);
            background-size: 28px 28px;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(96,165,250,0.2);
            animation: floatUp 18s infinite linear;
        }
        @keyframes floatUp {
            0%   { transform: translateY(110vh) scale(0); opacity: 0; }
            20%  { opacity: 0.6; }
            100% { transform: translateY(-10vh) scale(1); opacity: 0; }
        }

        .loader-wrap { position: relative; width: 130px; height: 130px; display: flex; align-items: center; justify-content: center; margin-bottom: 2rem; }
        .ring {
            position: absolute; inset: 0;
            border: 2.5px solid transparent;
            border-radius: 50%;
            animation: spin 1.4s cubic-bezier(0.5,0,0.5,1) infinite;
        }
        .ring-1 { border-top-color: var(--blue-l); border-right-color: rgba(96,165,250,0.2); }
        .ring-2 { inset: 10px; border-bottom-color: #fff; border-left-color: rgba(255,255,255,0.15); animation-duration: 2.2s; animation-direction: reverse; }
        @keyframes spin { to { transform: rotate(360deg); } }

        .loader-logo {
            width: 82px; height: 82px; border-radius: 50%; object-fit: cover; z-index: 2;
            box-shadow: 0 0 0 3px rgba(96,165,250,0.3), 0 0 30px rgba(37,99,235,0.5);
            background: white;
        }
        .loader-fallback {
            width: 82px; height: 82px; border-radius: 50%; background: linear-gradient(135deg, #1d4ed8, #3b82f6);
            display: flex; align-items: center; justify-content: center;
            font-size: 2rem; color: white; z-index: 2;
            box-shadow: 0 0 0 3px rgba(96,165,250,0.3), 0 0 30px rgba(37,99,235,0.5);
        }

        .progress-track { width: 240px; height: 3px; background: rgba(255,255,255,0.1); border-radius: 2px; overflow: hidden; margin-top: 1.25rem; }
        .progress-fill { height: 100%; background: linear-gradient(90deg, #3b82f6, #93c5fd); width: 0%; transition: width 0.15s ease; box-shadow: 0 0 10px rgba(96,165,250,0.6); }

        #navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            padding: 0;
            transition: all 0.35s ease;
        }
        #navbar .nav-inner {
            max-width: 1200px; margin: 0 auto;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 2rem; height: 72px;
            transition: height 0.35s ease;
        }
        #navbar.scrolled {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(14px);
            box-shadow: 0 1px 0 rgba(0,0,0,0.06), 0 4px 20px rgba(15,37,87,0.08);
        }
        #navbar.scrolled .nav-inner { height: 64px; }

        .nav-link {
            font-size: 0.875rem; font-weight: 600; color: #334155;
            text-decoration: none; position: relative; padding: 4px 0;
            letter-spacing: 0.01em;
        }
        .nav-link::after {
            content: ''; position: absolute; bottom: 0; left: 0;
            width: 0; height: 2px; background: var(--blue);
            border-radius: 1px; transition: width 0.25s ease;
        }
        .nav-link:hover { color: var(--navy); }
        .nav-link:hover::after { width: 100%; }

        #navbar:not(.scrolled) .nav-link { color: rgba(255,255,255,0.85); }
        #navbar:not(.scrolled) .nav-link:hover { color: white; }
        #navbar:not(.scrolled) .nav-link::after { background: white; }
        #navbar:not(.scrolled) .nav-logo-text { color: white; }
        #navbar:not(.scrolled) .nav-logo-sub { color: rgba(255,255,255,0.6); }

        .nav-cta {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 22px; border-radius: 100px;
            font-size: 0.875rem; font-weight: 600; text-decoration: none;
            background: var(--navy); color: white;
            box-shadow: 0 4px 14px rgba(15,37,87,0.3);
            transition: all 0.25s ease;
        }
        .nav-cta:hover { background: var(--blue); box-shadow: 0 6px 20px rgba(37,99,235,0.4); transform: translateY(-1px); }
        #navbar:not(.scrolled) .nav-cta { background: white; color: var(--navy); }
        #navbar:not(.scrolled) .nav-cta:hover { background: rgba(255,255,255,0.9); }

        #mobile-menu {
            background: white; border-top: 1px solid #f1f5f9;
            box-shadow: 0 8px 24px rgba(15,37,87,0.1);
            max-height: 0; overflow: hidden; transition: max-height 0.35s ease;
        }
        #mobile-menu.open { max-height: 400px; }

        #home {
            position: relative; min-height: 100vh;
            display: flex; align-items: center;
            background: linear-gradient(145deg, #060f2e 0%, #0f2557 50%, #1a3a7a 100%);
            overflow: hidden;
        }

        #home::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(rgba(96,165,250,0.08) 1.5px, transparent 1.5px);
            background-size: 32px 32px;
        }

        .hero-blob {
            position: absolute; border-radius: 50%;
            filter: blur(80px); pointer-events: none;
        }
        .hero-blob-1 { width: 500px; height: 500px; background: rgba(37,99,235,0.25); top: -100px; right: -100px; }
        .hero-blob-2 { width: 400px; height: 400px; background: rgba(96,165,250,0.15); bottom: -80px; left: -80px; }
        .hero-blob-3 { width: 300px; height: 300px; background: rgba(245,158,11,0.08); top: 40%; left: 35%; }

        .hero-strip {
            position: absolute; bottom: 0; left: 0; right: 0; height: 120px;
            background: var(--bg);
            clip-path: polygon(0 60%, 100% 0%, 100% 100%, 0 100%);
        }

        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 7px 16px; border-radius: 100px;
            background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15);
            font-size: 0.7rem; font-weight: 700; letter-spacing: 0.12em;
            text-transform: uppercase; color: rgba(255,255,255,0.85);
            backdrop-filter: blur(8px); margin-bottom: 1.5rem;
        }
        .hero-badge-dot { width: 7px; height: 7px; border-radius: 50%; background: #60a5fa; animation: blink 1.8s ease-in-out infinite; }
        @keyframes blink { 0%,100% { opacity: 1; } 50% { opacity: 0.3; } }

        .stats-bar {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(15,37,87,0.12);
            border: 1px solid rgba(226,232,240,0.8);
            padding: 2rem 3rem;
            display: flex; align-items: center; justify-content: space-around;
            flex-wrap: wrap; gap: 1.5rem;
            margin-top: -2.5rem; position: relative; z-index: 10;
        }
        .stat-divider { width: 1px; height: 48px; background: #e2e8f0; flex-shrink: 0; }

        .section-eyebrow {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 0.7rem; font-weight: 700; letter-spacing: 0.15em;
            text-transform: uppercase; color: var(--blue);
            margin-bottom: 0.75rem;
        }
        .section-eyebrow::before { content: ''; width: 24px; height: 2px; background: var(--blue); border-radius: 1px; }

        .visi-card {
            border-radius: 20px; overflow: hidden;
            box-shadow: 0 4px 24px rgba(15,37,87,0.07);
            border: 1px solid #e2e8f0;
            background: white;
            transition: all 0.4s ease;
        }
        .visi-card:hover { transform: translateY(-6px); box-shadow: 0 16px 48px rgba(15,37,87,0.13); border-color: #bfdbfe; }
        .visi-card-header { padding: 2rem 2rem 1.5rem; border-bottom: 1px solid #f1f5f9; }
        .visi-card-body { padding: 2rem; }

        .facility-card {
            background: white; border: 1px solid #e8eef6;
            border-radius: 20px; padding: 2rem;
            transition: all 0.35s ease; position: relative; overflow: hidden;
        }
        .facility-card::before {
            content: ''; position: absolute;
            top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, var(--navy), var(--blue));
            opacity: 0; transition: opacity 0.35s;
        }
        .facility-card:hover::before { opacity: 1; }
        .facility-card:hover { transform: translateY(-6px); box-shadow: 0 20px 50px rgba(15,37,87,0.1); border-color: #bfdbfe; }

        .facility-icon {
            width: 56px; height: 56px; border-radius: 14px;
            background: #eef3ff; display: flex; align-items: center; justify-content: center;
            font-size: 1.25rem; color: var(--navy);
            margin-bottom: 1.25rem; transition: all 0.35s ease;
        }
        .facility-card:hover .facility-icon { background: var(--navy); color: white; }

        .reveal {
            opacity: 0; transform: translateY(30px);
            transition: opacity 0.75s cubic-bezier(0.5,0,0,1), transform 0.75s cubic-bezier(0.5,0,0,1);
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .delay-1 { transition-delay: 0.1s; }
        .delay-2 { transition-delay: 0.2s; }
        .delay-3 { transition-delay: 0.3s; }
        .delay-4 { transition-delay: 0.4s; }

        .footer-link { color: #94a3b8; font-size: 0.875rem; text-decoration: none; transition: color 0.2s; display: block; margin-bottom: 0.75rem; }
        .footer-link:hover { color: var(--blue-l); }

        .gradient-text {
            background: linear-gradient(135deg, #60a5fa 0%, #ffffff 60%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .btn-primary {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 14px 28px; border-radius: 12px;
            background: var(--blue); color: white;
            font-size: 0.9rem; font-weight: 700; text-decoration: none;
            box-shadow: 0 6px 20px rgba(37,99,235,0.35);
            transition: all 0.25s ease;
        }
        .btn-primary:hover { background: #1d4ed8; transform: translateY(-2px); box-shadow: 0 10px 28px rgba(37,99,235,0.45); }
        .btn-outline {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 14px 28px; border-radius: 12px;
            background: transparent; color: rgba(255,255,255,0.9);
            border: 1.5px solid rgba(255,255,255,0.25);
            font-size: 0.9rem; font-weight: 600; text-decoration: none;
            transition: all 0.25s ease;
        }
        .btn-outline:hover { background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.5); }

        .img-stack { position: relative; }
        .img-main { border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(15,37,87,0.18); }
        .img-secondary {
            position: absolute; bottom: -28px; right: -28px;
            width: 55%; border-radius: 16px; overflow: hidden;
            box-shadow: 0 16px 40px rgba(15,37,87,0.2);
            border: 4px solid white;
        }
        .img-float-badge {
            position: absolute; top: -20px; left: -20px;
            background: var(--navy); color: white;
            padding: 1rem 1.25rem; border-radius: 16px;
            box-shadow: 0 8px 24px rgba(15,37,87,0.3);
            text-align: center;
        }

        .check-item { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 1rem; }
        .check-icon {
            width: 22px; height: 22px; border-radius: 50%;
            background: #dbeafe; color: var(--blue);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.65rem; flex-shrink: 0; margin-top: 1px;
        }
    </style>
</head>

<body>

<!-- LOADING SCREEN -->
<div id="loading-screen">
    <div id="particles-wrap" style="position:absolute;inset:0;pointer-events:none;overflow:hidden;"></div>

    <div class="loader-wrap" style="position:relative;z-index:1;">
        <div class="ring ring-1"></div>
        <div class="ring ring-2"></div>
        <img src="{{ asset('image/logo-sekolah.jpg') }}" alt="Logo" class="loader-logo"
             onerror="this.style.display='none';this.nextSibling.style.display='flex'">
        <div class="loader-fallback" style="display:none;position:absolute;">
            <i class="fas fa-graduation-cap"></i>
        </div>
    </div>

    <h2 style="font-family:'DM Sans',sans-serif;font-weight:800;font-size:1.5rem;color:white;letter-spacing:0.1em;margin-bottom:0.25rem;">SMA KANJENG SEPUH</h2>
    <p style="font-size:0.7rem;font-weight:600;letter-spacing:0.22em;color:rgba(148,189,255,0.7);text-transform:uppercase;margin-bottom:1.75rem;">Sidayu, Gresik — Jawa Timur</p>

    <div class="progress-track">
        <div class="progress-fill" id="progress-bar"></div>
    </div>
    <p id="loading-text" style="font-size:0.7rem;color:rgba(148,189,255,0.6);margin-top:0.75rem;font-family:monospace;letter-spacing:0.05em;">Memuat sistem...</p>
</div>


<!-- MAIN WRAPPER -->
<div id="main-wrapper" style="opacity:0;transition:opacity 0.8s ease;">

    <!-- NAVBAR -->
    <nav id="navbar">
        <div class="nav-inner">
            <a href="#" style="display:flex;align-items:center;gap:12px;text-decoration:none;">
                <img src="{{ asset('image/logo-sekolah.jpg') }}" alt="Logo"
                     style="width:40px;height:40px;border-radius:50%;object-fit:cover;background:white;border:2px solid rgba(255,255,255,0.3);"
                     onerror="this.style.display='none'">
                <div>
                    <div class="nav-logo-text" style="font-family:'DM Sans',sans-serif;font-weight:800;font-size:0.95rem;line-height:1.2;color:#0f2557;letter-spacing:0.02em;">SMA Kanjeng Sepuh</div>
                    <div class="nav-logo-sub" style="font-size:0.65rem;color:#64748b;font-weight:500;letter-spacing:0.06em;text-transform:uppercase;">Sidayu, Gresik</div>
                </div>
            </a>

            <div class="hidden md:flex" style="align-items:center;gap:2.5rem;">
                <a href="#home" class="nav-link">Beranda</a>
                <a href="#tentang" class="nav-link">Tentang</a>
                <a href="#visi-misi" class="nav-link">Visi & Misi</a>
                <a href="#fasilitas" class="nav-link">Fasilitas</a>
            </div>

            <div style="display:flex;align-items:center;gap:12px;">
                <a href="{{ route('login') }}" class="nav-cta hidden md:inline-flex">
                    <i class="fas fa-sign-in-alt" style="font-size:0.8rem;"></i> Masuk Portal
                </a>
                <button id="mobile-menu-btn" class="md:hidden"
                    style="width:40px;height:40px;border-radius:10px;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.2);color:white;font-size:1rem;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu">
            <div style="padding:1.25rem 1.5rem;display:flex;flex-direction:column;gap:0.25rem;">
                <a href="#home" class="mobile-link" style="padding:0.75rem 1rem;border-radius:10px;font-size:0.9rem;font-weight:600;color:#334155;text-decoration:none;">Beranda</a>
                <a href="#tentang" class="mobile-link" style="padding:0.75rem 1rem;border-radius:10px;font-size:0.9rem;font-weight:600;color:#334155;text-decoration:none;">Tentang</a>
                <a href="#visi-misi" class="mobile-link" style="padding:0.75rem 1rem;border-radius:10px;font-size:0.9rem;font-weight:600;color:#334155;text-decoration:none;">Visi & Misi</a>
                <a href="#fasilitas" class="mobile-link" style="padding:0.75rem 1rem;border-radius:10px;font-size:0.9rem;font-weight:600;color:#334155;text-decoration:none;">Fasilitas</a>
                <a href="{{ route('login') }}" style="margin-top:0.5rem;padding:0.875rem;border-radius:12px;text-align:center;background:var(--navy);color:white;font-weight:700;font-size:0.875rem;text-decoration:none;">
                    <i class="fas fa-sign-in-alt mr-2"></i>Masuk Portal
                </a>
            </div>
        </div>
    </nav>


    <!-- HERO SECTION -->
    <section id="home" style="position:relative;min-height:100vh;display:flex;align-items:center;background:linear-gradient(145deg,#060f2e 0%,#0f2557 50%,#1a3a7a 100%);overflow:hidden;padding-top:72px;">

        <div style="position:absolute;inset:0;background-image:radial-gradient(rgba(96,165,250,0.07) 1.5px,transparent 1.5px);background-size:30px 30px;"></div>

        <div class="hero-blob hero-blob-1"></div>
        <div class="hero-blob hero-blob-2"></div>
        <div class="hero-blob hero-blob-3"></div>
        <div class="hero-strip"></div>

        <div style="max-width:1200px;margin:0 auto;padding:5rem 2rem 10rem;width:100%;position:relative;z-index:1;">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:center;" class="hero-grid">

                <!-- Left: Text -->
                <div class="reveal">
                    <div class="hero-badge">
                        <span class="hero-badge-dot"></span>
                        Sistem Informasi Akademik Terintegrasi
                    </div>

                    <h1 style="font-family:'Playfair Display',serif;font-size:clamp(2.4rem,4vw,3.8rem);font-weight:900;line-height:1.12;color:white;margin-bottom:1.5rem;letter-spacing:-0.01em;">
                        Membangun Generasi<br>
                        <span class="gradient-text">Cerdas & Berkarakter</span>
                    </h1>

                    <p style="font-size:1.05rem;color:rgba(203,213,225,0.9);line-height:1.8;max-width:520px;margin-bottom:2.5rem;font-weight:400;">
                        Platform akademik digital SMA Kanjeng Sepuh Sidayu — dirancang untuk mempermudah pengelolaan
                        absensi, nilai, dan potensi siswa secara <strong style="color:white;font-weight:600;">real-time dan terpadu</strong>.
                    </p>

                    <div style="display:flex;flex-wrap:wrap;gap:12px;">
                        <a href="#tentang" class="btn-primary">
                            Pelajari Profil <i class="fas fa-arrow-right" style="font-size:0.8rem;"></i>
                        </a>
                        <a href="#fasilitas" class="btn-outline">
                            Lihat Fasilitas
                        </a>
                    </div>
                </div>

                <!-- Right: Hero visual -->
                <div class="reveal delay-2" style="position:relative;">
                    <div style="border-radius:24px;overflow:hidden;box-shadow:0 32px 80px rgba(0,0,0,0.4);border:1px solid rgba(255,255,255,0.1);position:relative;">
                        <img src="{{ asset('image/section.png') }}" alt="Siswa SMA Kanjeng Sepuh"
                             style="width:100%;display:block;object-fit:cover;"
                             onerror="this.parentElement.style.background='linear-gradient(135deg,#1d4ed8,#0f2557)';this.style.display='none'">

                        <div style="position:absolute;bottom:0;left:0;right:0;padding:1.25rem;background:linear-gradient(0deg,rgba(9,17,40,0.95) 0%,transparent 100%);">
                            <div style="display:flex;align-items:center;gap:12px;">
                                <div style="width:42px;height:42px;background:rgba(245,158,11,0.2);border:1px solid rgba(245,158,11,0.3);border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fbbf24;font-size:1rem;flex-shrink:0;">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <div>
                                    <p style="font-size:0.65rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:rgba(148,189,255,0.7);margin:0;">Prestasi Terbaru</p>
                                    <p style="font-size:0.825rem;font-weight:600;color:white;margin:2px 0 0;">Juara Umum Olimpiade Sains Nasional 2024</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="position:absolute;top:-20px;right:-24px;background:rgba(255,255,255,0.08);backdrop-filter:blur(12px);border:1px solid rgba(255,255,255,0.15);border-radius:16px;padding:1rem 1.25rem;text-align:center;min-width:100px;">
                        <div style="font-size:1.75rem;font-weight:800;color:white;line-height:1;">A</div>
                        <div style="font-size:0.65rem;font-weight:700;color:rgba(148,189,255,0.8);text-transform:uppercase;letter-spacing:0.08em;margin-top:3px;">Akreditasi</div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- STATS BAR -->
    <section style="background:var(--bg);padding:0 2rem;">
        <div style="max-width:900px;margin:0 auto;">
            <div class="stats-bar reveal">
                <div style="text-align:center;">
                    <div style="font-family:'Playfair Display',serif;font-size:2.25rem;font-weight:900;color:var(--navy);line-height:1;">25+</div>
                    <div style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#94a3b8;margin-top:4px;">Tahun Berdiri</div>
                </div>
                <div class="stat-divider"></div>
                <div style="text-align:center;">
                    <div style="font-family:'Playfair Display',serif;font-size:2.25rem;font-weight:900;color:var(--navy);line-height:1;">1.200+</div>
                    <div style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#94a3b8;margin-top:4px;">Alumni Sukses</div>
                </div>
                <div class="stat-divider"></div>
                <div style="text-align:center;">
                    <div style="font-family:'Playfair Display',serif;font-size:2.25rem;font-weight:900;color:var(--navy);line-height:1;">50+</div>
                    <div style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#94a3b8;margin-top:4px;">Tenaga Pendidik</div>
                </div>
                <div class="stat-divider"></div>
                <div style="text-align:center;">
                    <div style="font-family:'Playfair Display',serif;font-size:2.25rem;font-weight:900;color:var(--navy);line-height:1;">120+</div>
                    <div style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#94a3b8;margin-top:4px;">Penghargaan</div>
                </div>
            </div>
        </div>
    </section>


    <!-- TENTANG SECTION -->
    <section id="tentang" style="padding:7rem 2rem;background:white;">
        <div style="max-width:1200px;margin:0 auto;">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:6rem;align-items:center;" class="about-grid">

                <div class="img-stack reveal" style="padding:2rem 2rem 3rem 0;">
                    <div class="img-main">
                        <img src="{{ asset('image/sekolah-kami.png') }}" alt="Kegiatan"
                             style="width:100%;height:380px;object-fit:cover;display:block;">
                    </div>
                    <div class="img-secondary">
                        <img src="{{ asset('image/diskusi.png') }}" alt="Kegiatan"
                             style="width:100%;height:200px;object-fit:cover;display:block;"
                             onerror="this.parentElement.style.background='#eef3ff'">
                    </div>
                    <div class="img-float-badge">
                        <div style="font-family:'Playfair Display',serif;font-size:2rem;font-weight:900;line-height:1;">25+</div>
                        <div style="font-size:0.65rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:rgba(148,189,255,0.8);margin-top:2px;">Tahun<br>Pengalaman</div>
                    </div>
                </div>

                <div class="reveal delay-2">
                    <p class="section-eyebrow">Tentang Kami</p>
                    <h2 style="font-family:'Playfair Display',serif;font-size:clamp(1.8rem,3vw,2.6rem);font-weight:900;color:var(--navy);line-height:1.2;margin-bottom:1.25rem;">
                        Dedikasi Penuh untuk<br>Masa Depan Pendidikan
                    </h2>
                    <div style="width:48px;height:3px;background:linear-gradient(90deg,var(--navy),var(--blue));border-radius:2px;margin-bottom:1.5rem;"></div>

                    <p style="font-size:0.95rem;color:#475569;line-height:1.9;margin-bottom:1rem;">
                        SMA Kanjeng Sepuh Sidayu berdiri dengan visi mulia untuk mencetak pemimpin masa depan. Kami percaya bahwa pendidikan bukan sekadar tentang nilai, namun tentang membentuk <strong style="color:var(--navy);">karakter, integritas, dan inovasi</strong>.
                    </p>
                    <p style="font-size:0.95rem;color:#475569;line-height:1.9;margin-bottom:2rem;">
                        Dengan fasilitas berbasis teknologi dan kurikulum adaptif, kami memastikan setiap siswa siap menghadapi tantangan global di era digital dari jantung kota Sidayu, Gresik.
                    </p>

                    <div style="margin-bottom:2rem;">
                        <div class="check-item">
                            <div class="check-icon"><i class="fas fa-check"></i></div>
                            <span style="font-size:0.9rem;color:#334155;font-weight:500;">Kurikulum Merdeka Belajar Terakreditasi <strong>A</strong></span>
                        </div>
                        <div class="check-item">
                            <div class="check-icon"><i class="fas fa-check"></i></div>
                            <span style="font-size:0.9rem;color:#334155;font-weight:500;">Program Ekstrakurikuler Berbasis Talenta & Minat</span>
                        </div>
                        <div class="check-item">
                            <div class="check-icon"><i class="fas fa-check"></i></div>
                            <span style="font-size:0.9rem;color:#334155;font-weight:500;">Sistem Digital Cerdas (Smart School) Terintegrasi</span>
                        </div>
                        <div class="check-item">
                            <div class="check-icon"><i class="fas fa-check"></i></div>
                            <span style="font-size:0.9rem;color:#334155;font-weight:500;">Lingkungan Belajar Kondusif & Berbasis Riset</span>
                        </div>
                    </div>

                    <a href="#" style="display:inline-flex;align-items:center;gap:8px;font-weight:700;font-size:0.9rem;color:var(--blue);text-decoration:none;padding:12px 0;border-bottom:2px solid #dbeafe;transition:all 0.2s;">
                        Lihat Profil Lengkap <i class="fas fa-arrow-right" style="font-size:0.75rem;"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- VISI MISI SECTION -->
    <section id="visi-misi" style="padding:7rem 2rem;background:#f8fafd;position:relative;overflow:hidden;">

        <div style="position:absolute;inset:0;background-image:radial-gradient(#c7d7f5 1px,transparent 1px);background-size:28px 28px;opacity:0.4;"></div>

        <div style="max-width:1100px;margin:0 auto;position:relative;">

            <div style="text-align:center;max-width:560px;margin:0 auto 4rem;" class="reveal">
                <p class="section-eyebrow" style="justify-content:center;">Arah & Tujuan Kami</p>
                <h2 style="font-family:'Playfair Display',serif;font-size:clamp(1.75rem,3vw,2.5rem);font-weight:900;color:var(--navy);line-height:1.2;margin-bottom:1rem;">
                    Visi & Misi Sekolah
                </h2>
                <p style="font-size:0.95rem;color:#64748b;line-height:1.8;">Landasan nilai yang menjadi arah gerak seluruh civitas akademika SMA Kanjeng Sepuh Sidayu.</p>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem;" class="visi-grid">

                <!-- Visi -->
                <div class="visi-card reveal delay-1">
                    <div class="visi-card-header" style="background:linear-gradient(135deg,#0f2557,#1d4ed8);position:relative;overflow:hidden;">
                        <div style="position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.06) 1px,transparent 1px);background-size:20px 20px;"></div>
                        <div style="position:relative;">
                            <div style="width:52px;height:52px;background:rgba(255,255,255,0.12);border-radius:14px;display:flex;align-items:center;justify-content:center;color:white;font-size:1.25rem;margin-bottom:1rem;border:1px solid rgba(255,255,255,0.2);">
                                <i class="fas fa-eye"></i>
                            </div>
                            <h3 style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:700;color:white;margin-bottom:0.25rem;">Visi Sekolah</h3>
                            <p style="font-size:0.7rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:rgba(148,189,255,0.7);">Our Vision</p>
                        </div>
                    </div>
                    <div class="visi-card-body">
                        <blockquote style="font-size:1rem;color:#334155;line-height:1.85;font-style:italic;border-left:3px solid #bfdbfe;padding-left:1.25rem;margin:0;">
                            "Menjadi lembaga pendidikan unggul yang menghasilkan generasi cerdas, berkarakter luhur, religius, dan kompetitif di kancah global."
                        </blockquote>
                    </div>
                </div>

                <!-- Misi -->
                <div class="visi-card reveal delay-2">
                    <div class="visi-card-header" style="background:linear-gradient(135deg,#1e40af,#3b82f6);position:relative;overflow:hidden;">
                        <div style="position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.06) 1px,transparent 1px);background-size:20px 20px;"></div>
                        <div style="position:relative;">
                            <div style="width:52px;height:52px;background:rgba(255,255,255,0.12);border-radius:14px;display:flex;align-items:center;justify-content:center;color:white;font-size:1.25rem;margin-bottom:1rem;border:1px solid rgba(255,255,255,0.2);">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <h3 style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:700;color:white;margin-bottom:0.25rem;">Misi Sekolah</h3>
                            <p style="font-size:0.7rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:rgba(148,189,255,0.7);">Our Mission</p>
                        </div>
                    </div>
                    <div class="visi-card-body">
                        <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:1rem;">
                            <li style="display:flex;align-items:flex-start;gap:12px;">
                                <span style="width:26px;height:26px;background:#dbeafe;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.7rem;font-weight:700;color:var(--blue);flex-shrink:0;margin-top:1px;">1</span>
                                <span style="font-size:0.9rem;color:#475569;line-height:1.7;">Menyelenggarakan pendidikan berkualitas berbasis teknologi dan nilai-nilai keimanan.</span>
                            </li>
                            <li style="display:flex;align-items:flex-start;gap:12px;">
                                <span style="width:26px;height:26px;background:#dbeafe;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.7rem;font-weight:700;color:var(--blue);flex-shrink:0;margin-top:1px;">2</span>
                                <span style="font-size:0.9rem;color:#475569;line-height:1.7;">Mengembangkan potensi akademik dan non-akademik siswa secara holistik.</span>
                            </li>
                            <li style="display:flex;align-items:flex-start;gap:12px;">
                                <span style="width:26px;height:26px;background:#dbeafe;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.7rem;font-weight:700;color:var(--blue);flex-shrink:0;margin-top:1px;">3</span>
                                <span style="font-size:0.9rem;color:#475569;line-height:1.7;">Membangun kemitraan strategis dengan institusi pendidikan dan industri.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- FASILITAS SECTION -->
    <section id="fasilitas" style="padding:7rem 2rem;background:white;">
        <div style="max-width:1200px;margin:0 auto;">

            <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:3.5rem;flex-wrap:wrap;gap:1rem;" class="reveal">
                <div>
                    <p class="section-eyebrow">Sarana & Prasarana</p>
                    <h2 style="font-family:'Playfair Display',serif;font-size:clamp(1.75rem,3vw,2.5rem);font-weight:900;color:var(--navy);line-height:1.2;">Fasilitas Pendukung Belajar</h2>
                </div>
                <a href="#" style="display:inline-flex;align-items:center;gap:8px;font-size:0.875rem;font-weight:700;color:var(--blue);text-decoration:none;">
                    Lihat Semua <i class="fas fa-arrow-right" style="font-size:0.75rem;"></i>
                </a>
            </div>

            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;" class="facility-grid">

                <div class="facility-card reveal delay-1">
                    <div class="facility-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    <h4 style="font-size:1rem;font-weight:700;color:var(--navy);margin-bottom:0.5rem;">Ruang Kelas Digital</h4>
                    <p style="font-size:0.85rem;color:#64748b;line-height:1.7;margin:0;">Dilengkapi Smartboard interaktif, AC sentral, dan CCTV 24 jam untuk kenyamanan belajar.</p>
                </div>

                <div class="facility-card reveal delay-2">
                    <div class="facility-icon"><i class="fas fa-flask"></i></div>
                    <h4 style="font-size:1rem;font-weight:700;color:var(--navy);margin-bottom:0.5rem;">Laboratorium Sains</h4>
                    <p style="font-size:0.85rem;color:#64748b;line-height:1.7;margin:0;">Lab Kimia, Fisika, dan Biologi dengan peralatan modern berstandar nasional.</p>
                </div>

                <div class="facility-card reveal delay-3">
                    <div class="facility-icon"><i class="fas fa-book-open"></i></div>
                    <h4 style="font-size:1rem;font-weight:700;color:var(--navy);margin-bottom:0.5rem;">E-Perpustakaan</h4>
                    <p style="font-size:0.85rem;color:#64748b;line-height:1.7;margin:0;">Ribuan koleksi buku fisik dan akses digital untuk mendukung literasi siswa.</p>
                </div>

                <div class="facility-card reveal delay-4">
                    <div class="facility-icon"><i class="fas fa-basketball-ball"></i></div>
                    <h4 style="font-size:1rem;font-weight:700;color:var(--navy);margin-bottom:0.5rem;">Sport Center</h4>
                    <p style="font-size:0.85rem;color:#64748b;line-height:1.7;margin:0;">Lapangan Basket, Futsal, Voli, Badminton, dan Gymnasium berstandar kompetisi.</p>
                </div>

                <div class="facility-card reveal delay-1">
                    <div class="facility-icon"><i class="fas fa-laptop-code"></i></div>
                    <h4 style="font-size:1rem;font-weight:700;color:var(--navy);margin-bottom:0.5rem;">Lab Komputer</h4>
                    <p style="font-size:0.85rem;color:#64748b;line-height:1.7;margin:0;">100+ unit PC terkini dengan koneksi internet fiber optik berkecepatan tinggi.</p>
                </div>

                <div class="facility-card reveal delay-2">
                    <div class="facility-icon"><i class="fas fa-utensils"></i></div>
                    <h4 style="font-size:1rem;font-weight:700;color:var(--navy);margin-bottom:0.5rem;">Kantin Sehat</h4>
                    <p style="font-size:0.85rem;color:#64748b;line-height:1.7;margin:0;">Kantin higienis dengan menu bergizi yang terseleksi dan bersertifikasi halal.</p>
                </div>

                <div class="facility-card reveal delay-3">
                    <div class="facility-icon"><i class="fas fa-music"></i></div>
                    <h4 style="font-size:1rem;font-weight:700;color:var(--navy);margin-bottom:0.5rem;">Studio Seni</h4>
                    <p style="font-size:0.85rem;color:#64748b;line-height:1.7;margin:0;">Ruang berkreasi untuk musik, tari, dan seni visual dengan peralatan lengkap.</p>
                </div>

                <div class="facility-card reveal delay-4">
                    <div class="facility-icon"><i class="fas fa-clinic-medical"></i></div>
                    <h4 style="font-size:1rem;font-weight:700;color:var(--navy);margin-bottom:0.5rem;">Klinik Kesehatan</h4>
                    <p style="font-size:0.85rem;color:#64748b;line-height:1.7;margin:0;">Unit kesehatan sekolah dengan tenaga medis terlatih siap melayani 24 jam.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- CTA BANNER -->
    <section style="padding:3rem 2rem;background:#f8fafd;">
        <div style="max-width:1100px;margin:0 auto;">
            <div class="reveal" style="background:linear-gradient(135deg,#0f2557 0%,#1d4ed8 100%);border-radius:24px;padding:3.5rem 4rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:2rem;position:relative;overflow:hidden;">
                <div style="position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.05) 1.5px,transparent 1.5px);background-size:24px 24px;"></div>
                <div style="position:absolute;top:-60px;right:-60px;width:250px;height:250px;background:rgba(96,165,250,0.12);border-radius:50%;filter:blur(40px);"></div>
                <div style="position:relative;">
                    <h3 style="font-family:'Playfair Display',serif;font-size:1.75rem;font-weight:900;color:white;margin-bottom:0.5rem;">Siap Bergabung Bersama Kami?</h3>
                    <p style="font-size:0.95rem;color:rgba(203,213,225,0.85);margin:0;">Masuk ke portal akademik dan mulai kelola informasi sekolahmu hari ini.</p>
                </div>
                <a href="{{ route('login') }}" style="position:relative;display:inline-flex;align-items:center;gap:10px;padding:14px 28px;background:white;color:var(--navy);border-radius:12px;font-weight:700;font-size:0.9rem;text-decoration:none;box-shadow:0 8px 24px rgba(0,0,0,0.2);transition:all 0.25s;flex-shrink:0;">
                    <i class="fas fa-sign-in-alt"></i> Masuk Portal Sekarang
                </a>
            </div>
        </div>
    </section>


    <!-- FOOTER -->
    <footer style="background:#060f2e;color:white;padding:5rem 2rem 2rem;">
        <div style="max-width:1200px;margin:0 auto;">

            <div style="display:grid;grid-template-columns:2fr 1fr 1fr 1.5fr;gap:3rem;margin-bottom:4rem;" class="footer-grid">

                <!-- Brand -->
                <div>
                    <div style="display:flex;align-items:center;gap:12px;margin-bottom:1.25rem;">
                        <img src="{{ asset('image/logo-sekolah.jpg') }}" alt="Logo"
                             style="width:42px;height:42px;border-radius:50%;object-fit:cover;background:white;padding:2px;"
                             onerror="this.style.display='none'">
                        <div>
                            <div style="font-weight:800;font-size:1rem;letter-spacing:0.02em;">SMA Kanjeng Sepuh</div>
                            <div style="font-size:0.65rem;color:rgba(148,189,255,0.6);font-weight:500;text-transform:uppercase;letter-spacing:0.08em;">Sidayu, Gresik — Jawa Timur</div>
                        </div>
                    </div>
                    <p style="font-size:0.875rem;color:#64748b;line-height:1.8;margin-bottom:1.5rem;max-width:280px;">
                        Membentuk karakter, meraih prestasi, dan membangun peradaban melalui pendidikan berkualitas di Sidayu, Gresik.
                    </p>
                    <div style="display:flex;gap:10px;">
                        <a href="#" style="width:38px;height:38px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:10px;display:flex;align-items:center;justify-content:center;color:#64748b;text-decoration:none;transition:all 0.2s;font-size:0.875rem;" onmouseover="this.style.background='var(--blue)';this.style.color='white';this.style.borderColor='var(--blue)'" onmouseout="this.style.background='rgba(255,255,255,0.05)';this.style.color='#64748b';this.style.borderColor='rgba(255,255,255,0.1)'"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" style="width:38px;height:38px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:10px;display:flex;align-items:center;justify-content:center;color:#64748b;text-decoration:none;transition:all 0.2s;font-size:0.875rem;" onmouseover="this.style.background='var(--blue)';this.style.color='white';this.style.borderColor='var(--blue)'" onmouseout="this.style.background='rgba(255,255,255,0.05)';this.style.color='#64748b';this.style.borderColor='rgba(255,255,255,0.1)'"><i class="fab fa-instagram"></i></a>
                        <a href="#" style="width:38px;height:38px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:10px;display:flex;align-items:center;justify-content:center;color:#64748b;text-decoration:none;transition:all 0.2s;font-size:0.875rem;" onmouseover="this.style.background='var(--blue)';this.style.color='white';this.style.borderColor='var(--blue)'" onmouseout="this.style.background='rgba(255,255,255,0.05)';this.style.color='#64748b';this.style.borderColor='rgba(255,255,255,0.1)'"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Akademik -->
                <div>
                    <h4 style="font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:rgba(148,189,255,0.6);margin-bottom:1.25rem;">Akademik</h4>
                    <a href="#" class="footer-link">Kalender Pendidikan</a>
                    <a href="#" class="footer-link">Kurikulum Merdeka</a>
                    <a href="#" class="footer-link">E-Learning</a>
                    <a href="#" class="footer-link">Prestasi Siswa</a>
                    <a href="#" class="footer-link">Rekap Nilai</a>
                </div>

                <!-- Informasi -->
                <div>
                    <h4 style="font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:rgba(148,189,255,0.6);margin-bottom:1.25rem;">Informasi</h4>
                    <a href="#" class="footer-link">PPDB Online</a>
                    <a href="#" class="footer-link">Ekstrakurikuler</a>
                    <a href="#" class="footer-link">Berita Sekolah</a>
                    <a href="#" class="footer-link">Galeri Foto</a>
                    <a href="#" class="footer-link">Kontak</a>
                </div>

                <!-- Kontak -->
                <div>
                    <h4 style="font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:rgba(148,189,255,0.6);margin-bottom:1.25rem;">Hubungi Kami</h4>
                    <div style="display:flex;flex-direction:column;gap:1rem;">
                        <div style="display:flex;align-items:flex-start;gap:12px;">
                            <div style="width:32px;height:32px;background:rgba(37,99,235,0.15);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#60a5fa;font-size:0.8rem;flex-shrink:0;margin-top:1px;">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <span style="font-size:0.85rem;color:#64748b;line-height:1.6;">Jl. Raya Sidayu, Sidayu,<br>Gresik, Jawa Timur 61153</span>
                        </div>
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:32px;height:32px;background:rgba(37,99,235,0.15);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#60a5fa;font-size:0.8rem;flex-shrink:0;">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <span style="font-size:0.85rem;color:#64748b;">(031) 395-1234</span>
                        </div>
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:32px;height:32px;background:rgba(37,99,235,0.15);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#60a5fa;font-size:0.8rem;flex-shrink:0;">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <span style="font-size:0.85rem;color:#64748b;">info@smakanjeng.sch.id</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom bar -->
            <div style="border-top:1px solid rgba(255,255,255,0.06);padding-top:2rem;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;">
                <p style="font-size:0.8rem;color:#475569;margin:0;">© 2025 SMA Kanjeng Sepuh Sidayu, Gresik. Hak cipta dilindungi undang-undang.</p>
                <p style="font-size:0.75rem;color:#334155;margin:0;">
                    Dikembangkan oleh Divisi IT Sekolah
                </p>
            </div>
        </div>
    </footer>

</div><!-- /.main-wrapper -->


<style>
@media (max-width: 1024px) {
    .hero-grid, .about-grid { grid-template-columns: 1fr !important; gap: 3rem !important; }
    .facility-grid { grid-template-columns: repeat(2,1fr) !important; }
    .footer-grid { grid-template-columns: 1fr 1fr !important; }
    .visi-grid { grid-template-columns: 1fr !important; }
    .img-secondary { display: none; }
    .stats-bar { flex-direction: column; gap: 1.5rem !important; }
    .stat-divider { display: none; }
}
@media (max-width: 640px) {
    .facility-grid { grid-template-columns: 1fr !important; }
    .footer-grid { grid-template-columns: 1fr !important; }
    .stats-bar { padding: 1.5rem !important; }
    #home { padding-bottom: 8rem !important; }
}
</style>


<script>
document.addEventListener('DOMContentLoaded', () => {

    /* 1. LOADING SCREEN */
    const loadingScreen = document.getElementById('loading-screen');
    const mainWrapper   = document.getElementById('main-wrapper');
    const progressBar   = document.getElementById('progress-bar');
    const loadingText   = document.getElementById('loading-text');
    const particlesWrap = document.getElementById('particles-wrap');

    for (let i = 0; i < 40; i++) {
        const p = document.createElement('div');
        p.classList.add('particle');
        const size = (Math.random() * 5 + 2) + 'px';
        Object.assign(p.style, {
            width: size, height: size,
            left: Math.random() * 100 + '%',
            animationDuration: (Math.random() * 12 + 12) + 's',
            animationDelay: (Math.random() * 8) + 's',
        });
        particlesWrap.appendChild(p);
    }

    const msgs = ['Memuat sistem...', 'Menyiapkan data...', 'Menghubungkan server...', 'Hampir selesai...', 'Siap!'];
    let prog = 0;
    const iv = setInterval(() => {
        prog += Math.random() * 4 + 1;
        if (prog >= 100) { prog = 100; clearInterval(iv); }
        progressBar.style.width = prog + '%';
        loadingText.textContent = prog < 25 ? msgs[0] : prog < 50 ? msgs[1] : prog < 75 ? msgs[2] : prog < 95 ? msgs[3] : msgs[4];
        if (prog === 100) {
            setTimeout(() => {
                loadingScreen.classList.add('hidden');
                mainWrapper.style.opacity = '1';
            }, 600);
        }
    }, 45);


    /* 2. NAVBAR */
    const navbar = document.getElementById('navbar');
    const updateNav = () => {
        if (window.scrollY > 40) {
            navbar.classList.add('scrolled');
            const mBtn = document.getElementById('mobile-menu-btn');
            if (mBtn) { mBtn.style.background = 'rgba(15,37,87,0.08)'; mBtn.style.borderColor = '#e2e8f0'; mBtn.style.color = '#0f2557'; }
        } else {
            navbar.classList.remove('scrolled');
            const mBtn = document.getElementById('mobile-menu-btn');
            if (mBtn) { mBtn.style.background = 'rgba(255,255,255,0.1)'; mBtn.style.borderColor = 'rgba(255,255,255,0.2)'; mBtn.style.color = 'white'; }
        }
    };
    window.addEventListener('scroll', updateNav, { passive: true });
    updateNav();


    /* 3. MOBILE MENU */
    const mBtn  = document.getElementById('mobile-menu-btn');
    const mMenu = document.getElementById('mobile-menu');

    mBtn.addEventListener('click', () => {
        const isOpen = mMenu.classList.toggle('open');
        mBtn.querySelector('i').className = isOpen ? 'fas fa-times' : 'fas fa-bars';
    });

    document.querySelectorAll('.mobile-link').forEach(l => {
        l.addEventListener('click', () => {
            mMenu.classList.remove('open');
            mBtn.querySelector('i').className = 'fas fa-bars';
        });
    });


    /* 4. SCROLL REVEAL */
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
        });
    }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.reveal').forEach(el => io.observe(el));

});
</script>

</body>
</html>