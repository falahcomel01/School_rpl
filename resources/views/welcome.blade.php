<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMA Cakrawala Gresik - Sistem Informasi Akademik</title>
    
    <!-- Fonts: Poppins (Modern & Clean) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Config Tailwind untuk Blue Theme yang Elegan -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        // Palette Royal Blue Profesional
                        primary: '#1e3a8a',   /* Deep Blue 900 */
                        secondary: '#3b82f6', /* Blue 500 */
                        accent: '#60a5fa',    /* Blue 400 */
                        slate: {
                            850: '#151e2e',   /* Lebih gelap dari slate-900 */
                        }
                    },
                    boxShadow: {
                        'glow': '0 0 20px rgba(59, 130, 246, 0.15)',
                        'floating': '0 20px 40px -5px rgba(0, 0, 0, 0.1)',
                    }
                }
            }
        }
    </script>

    <style>
        /* Global Reset & Base */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            overflow-x: hidden;
        }

        /* Smooth Scrolling */
        html { scroll-behavior: smooth; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* ===== PREMIUM LOADING SCREEN ===== */
        #loading-screen {
            position: fixed;
            inset: 0;
            /* Gradasi Biru Laut Dalam yang Elegan */
            background: linear-gradient(135deg, #0f172a 0%, #1e40af 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #loading-screen.hidden {
            opacity: 0;
            pointer-events: none;
        }

        /* Particle Background */
        .particles { position: absolute; inset: 0; overflow: hidden; }
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            animation: floatUp 15s infinite linear;
        }

        @keyframes floatUp {
            0% { transform: translateY(100vh) scale(0); opacity: 0; }
            50% { opacity: 0.5; }
            100% { transform: translateY(-10vh) scale(1); opacity: 0; }
        }

        /* Logo Loader */
        .loader-logo-wrapper {
            position: relative;
            width: 140px;
            height: 140px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 2rem;
        }

        .loader-ring {
            position: absolute;
            width: 100%;
            height: 100%;
            border: 3px solid rgba(255,255,255,0.1);
            border-top-color: #60a5fa;
            border-radius: 50%;
            animation: spin 1.2s cubic-bezier(0.68, -0.55, 0.27, 1.55) infinite;
        }

        .loader-ring:nth-child(2) {
            width: 85%;
            height: 85%;
            border-bottom-color: #fff;
            animation: spin 2s linear infinite reverse;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        .loader-img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 50%;
            z-index: 10;
            box-shadow: 0 0 25px rgba(59, 130, 246, 0.5);
        }

        /* Progress Bar */
        .progress-container {
            width: 260px;
            height: 4px;
            background: rgba(255,255,255,0.1);
            border-radius: 2px;
            overflow: hidden;
            margin-top: 1rem;
        }
        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #3b82f6, #ffffff);
            width: 0%;
            transition: width 0.2s ease;
            box-shadow: 0 0 15px #3b82f6;
        }

        /* ===== MAIN CONTENT ANIMATIONS ===== */
        /* Reveal on Scroll */
        .reveal-up {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }
        .reveal-up.active {
            opacity: 1;
            transform: translateY(0);
        }
        .delay-100 { transition-delay: 0.1s; }
        .delay-200 { transition-delay: 0.2s; }
        .delay-300 { transition-delay: 0.3s; }

        /* Glassmorphism Navbar */
        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        /* Card Styles */
        .modern-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1.5rem;
            transition: all 0.4s ease;
            overflow: hidden;
        }

        .modern-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(30, 58, 138, 0.15);
            border-color: #bfdbfe;
        }

        /* Image Hover Effect */
        .img-hover-zoom {
            overflow: hidden;
        }
        .img-hover-zoom img {
            transition: transform 0.7s ease;
        }
        .img-hover-zoom:hover img {
            transform: scale(1.05);
        }

        /* Text Gradients */
        .text-gradient-blue {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body class="loading antialiased selection:bg-blue-100 selection:text-blue-900">

    <!-- PREMIUM LOADING SCREEN -->
    <div id="loading-screen">
        <div class="particles" id="particles"></div>
        
        <div class="loader-logo-wrapper">
            <div class="loader-ring"></div>
            <div class="loader-ring"></div>
            <!-- Blade Asset: Logo -->
            <img src="{{ asset('image/logo-sekolah.png') }}" alt="Logo SMA Cakrawala" class="loader-img">
        </div>

        <h2 class="text-white text-3xl font-bold tracking-widest mb-2 drop-shadow-md">SMA CAKRAWALA</h2>
        <p class="text-blue-200 text-sm font-medium tracking-[0.2em] mb-8">GRESIK, JAWA TIMUR</p>

        <div class="progress-container">
            <div class="progress-bar" id="progress-bar"></div>
        </div>
        <div class="text-blue-300 text-xs mt-4 font-mono" id="loading-text">Memuat sistem...</div>
    </div>

    <!-- MAIN WRAPPER -->
    <div id="main-wrapper" class="opacity-0 transition-opacity duration-1000">
        
        <!-- NAVBAR -->
        <nav class="fixed w-full z-50 glass-nav transition-all duration-300 py-4" id="navbar">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <!-- Logo Area -->
                    <a href="#" class="flex items-center gap-3 group">
                        <div class="relative">
                            <!-- Blade Asset -->
                            <img src="{{ asset('image/logo-sekolah.png') }}" alt="Logo" class="w-10 h-10 rounded-full border-2 border-blue-100 group-hover:border-blue-500 transition-colors shadow-sm">
                            <div class="absolute inset-0 rounded-full ring-2 ring-blue-400 opacity-0 group-hover:opacity-20 transition-opacity animate-pulse"></div>
                        </div>
                        <div class="leading-none">
                            <h1 class="font-bold text-lg text-primary leading-tight tracking-tight">SMA Cakrawala</h1>
                            <p class="text-[10px] text-gray-500 font-medium tracking-wide uppercase">Gresik, Jawa Timur</p>
                        </div>
                    </a>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center space-x-10">
                        <a href="#home" class="text-sm font-semibold text-gray-600 hover:text-primary transition-colors relative group py-2">
                            Beranda
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="#tentang" class="text-sm font-semibold text-gray-600 hover:text-primary transition-colors relative group py-2">
                            Tentang
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="#visi-misi" class="text-sm font-semibold text-gray-600 hover:text-primary transition-colors relative group py-2">
                            Visi & Misi
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="#fasilitas" class="text-sm font-semibold text-gray-600 hover:text-primary transition-colors relative group py-2">
                            Fasilitas
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    </div>

                    <!-- CTA Button (Desktop) -->
                    <!-- Blade Route -->
                    <a href="{{ route('login') }}" class="hidden md:inline-flex items-center px-6 py-2.5 bg-primary text-white text-sm font-semibold rounded-full shadow-lg hover:bg-blue-800 hover:shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-0.5">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login Portal
                    </a>

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="md:hidden text-gray-600 hover:text-primary focus:outline-none p-2">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div id="mobile-menu" class="md:hidden absolute w-full bg-white border-t border-gray-100 shadow-xl max-h-0 overflow-hidden transition-all duration-300">
                <div class="px-6 py-4 flex flex-col space-y-4">
                    <a href="#home" class="mobile-link text-gray-600 hover:text-primary font-medium text-sm py-2 border-b border-gray-50">Beranda</a>
                    <a href="#tentang" class="mobile-link text-gray-600 hover:text-primary font-medium text-sm py-2 border-b border-gray-50">Tentang</a>
                    <a href="#visi-misi" class="mobile-link text-gray-600 hover:text-primary font-medium text-sm py-2 border-b border-gray-50">Visi & Misi</a>
                    <a href="#fasilitas" class="mobile-link text-gray-600 hover:text-primary font-medium text-sm py-2 border-b border-gray-50">Fasilitas</a>
                    <a href="{{ route('login') }}" class="text-center w-full py-3 bg-primary text-white rounded-lg text-sm font-bold shadow-md mt-2">Login Portal</a>
                </div>
            </div>
        </nav>

        <!-- HERO SECTION -->
        <section id="home" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
            <!-- Background Blobs (Decoration) -->
            <div class="absolute top-0 right-0 -mr-40 -mt-40 w-[600px] h-[600px] bg-blue-200/30 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse"></div>
            <div class="absolute bottom-0 left-0 -ml-40 -mb-40 w-[500px] h-[500px] bg-indigo-200/30 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse delay-700"></div>

            <div class="max-w-7xl mx-auto px-6 lg:px-8 relative">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <!-- Text Content -->
                    <div class="reveal-up">
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-primary text-xs font-bold uppercase tracking-widest mb-6 border border-blue-100 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                            Sistem Informasi Akademik Terintegrasi
                        </div>
                        <h2 class="text-5xl lg:text-7xl font-extrabold text-slate-900 leading-[1.1] tracking-tight mb-8">
                            Membangun Generasi <br>
                            <span class="text-gradient-blue">Cerdas & Berkarakter</span>
                        </h2>
                        <p class="text-slate-600 text-lg mb-10 leading-relaxed max-w-lg">
                            Selamat datang di SMA Cakrawala Gresik. Platform digital modern yang dirancang untuk mempermudah pengelolaan akademik, absensi, dan pengembangan potensi siswa secara real-time.
                        </p>
                        
                        <div class="flex flex-wrap gap-4">
                            <a href="#tentang" class="px-8 py-4 bg-primary text-white font-bold rounded-xl shadow-xl hover:bg-blue-900 hover:shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-1 flex items-center gap-2">
                                Pelajari Profil <i class="fas fa-arrow-right text-sm"></i>
                            </a>
                            <a href="#fasilitas" class="px-8 py-4 bg-white text-slate-700 border border-slate-200 font-bold rounded-xl hover:bg-slate-50 hover:border-blue-300 transition-all duration-300 shadow-sm">
                                Lihat Fasilitas
                            </a>
                        </div>

                        <!-- Trusted By / Mini Stats -->
                        <div class="mt-16 flex items-center gap-8 pt-8 border-t border-slate-200">
                            <div>
                                <h3 class="text-4xl font-bold text-primary">25+</h3>
                                <p class="text-xs text-slate-500 font-medium mt-1 uppercase tracking-wide">Tahun Berdiri</p>
                            </div>
                            <div class="w-px h-12 bg-slate-200"></div>
                            <div>
                                <h3 class="text-4xl font-bold text-primary">1.2K</h3>
                                <p class="text-xs text-slate-500 font-medium mt-1 uppercase tracking-wide">Alumni Sukses</p>
                            </div>
                            <div class="w-px h-12 bg-slate-200"></div>
                            <div>
                                <h3 class="text-4xl font-bold text-primary">A+</h3>
                                <p class="text-xs text-slate-500 font-medium mt-1 uppercase tracking-wide">Akreditasi</p>
                            </div>
                        </div>
                    </div>

                    <!-- Hero Image -->
                    <div class="relative reveal-up delay-200">
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white transform rotate-2 hover:rotate-0 transition-transform duration-700 z-10 group">
                            <!-- Blade Asset -->
                            <img src="{{ asset('image/section.png') }}" alt="Ilustrasi Siswa" class="w-full h-auto object-cover">
                            
                            <!-- Floating Badge (Overlay) -->
                            <div class="absolute bottom-6 left-6 right-6 bg-white/95 backdrop-blur p-4 rounded-2xl shadow-lg flex items-center gap-4 border border-blue-50">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-primary text-xl">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Prestasi Terbaru</p>
                                    <p class="font-bold text-slate-800 text-sm">Juara Umum Olimpiade Sains Nasional 2024</p>
                                </div>
                            </div>
                        </div>
                        <!-- Decorative Shadow behind image -->
                        <div class="absolute -inset-4 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl blur-2xl opacity-20 -z-10 transform translate-y-4"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- TENTANG SECTION -->
        <section id="tentang" class="py-24 bg-white relative">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-20 items-center">
                    <!-- Image Grid Layout -->
                    <div class="relative reveal-up">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-4 mt-8">
                                <!-- Blade Asset -->
                                <div class="rounded-2xl overflow-hidden shadow-lg border border-slate-100">
                                    <img src="{{ asset('image/logo-sekolah.png') }}" alt="Gedung Sekolah" class="w-full h-48 object-cover">
                                </div>
                                <div class="rounded-2xl overflow-hidden shadow-lg border border-slate-100 p-6 bg-blue-50 flex flex-col justify-center items-center text-center">
                                    <i class="fas fa-award text-4xl text-primary mb-2"></i>
                                    <span class="font-bold text-primary text-sm">Sekolah Unggulan</span>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <!-- Blade Asset -->
                                <div class="rounded-2xl overflow-hidden shadow-lg border border-slate-100">
                                    <img src="https://picsum.photos/seed/schoolbuilding/400/500" alt="Kegiatan Sekolah" class="w-full h-64 object-cover">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Text Content -->
                    <div class="reveal-up delay-200">
                        <h3 class="text-primary font-bold tracking-widest uppercase text-sm mb-3">Tentang Kami</h3>
                        <h2 class="text-4xl font-extrabold text-slate-900 mb-6 leading-tight">Dedikasi Untuk Masa Depan Pendidikan</h2>
                        <p class="text-slate-600 text-lg leading-relaxed mb-6">
                            SMA Cakrawala Gresik berdiri dengan visi mulia untuk mencetak pemimpin masa depan. Kami percaya bahwa pendidikan bukan hanya tentang nilai, tetapi tentang membentuk karakter integritas dan inovasi.
                        </p>
                        <p class="text-slate-600 text-lg leading-relaxed mb-8">
                            Dengan dukungan fasilitas berbasis teknologi dan kurikulum adaptif, kami memastikan setiap siswa siap menghadapi tantangan global di era digital.
                        </p>

                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center gap-4">
                                <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-xs">
                                    <i class="fas fa-check"></i>
                                </div>
                                <span class="text-slate-700 font-medium">Kurikulum Merdeka Belajar Terakreditasi A</span>
                            </li>
                            <li class="flex items-center gap-4">
                                <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-xs">
                                    <i class="fas fa-check"></i>
                                </div>
                                <span class="text-slate-700 font-medium">Program Ekstrakurikuler Berbasis Talenta</span>
                            </li>
                            <li class="flex items-center gap-4">
                                <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-xs">
                                    <i class="fas fa-check"></i>
                                </div>
                                <span class="text-slate-700 font-medium">Sistem Digital Pintar (Smart School)</span>
                            </li>
                        </ul>

                        <a href="#" class="inline-flex items-center font-bold text-primary hover:text-blue-700 transition-colors group">
                            Lihat Profil Lengkap Sekolah 
                            <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- VISI MISI SECTION -->
        <section id="visi-misi" class="py-24 bg-slate-50 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#1e3a8a 1px, transparent 1px); background-size: 30px 30px;"></div>
            
            <div class="max-w-7xl mx-auto px-6 lg:px-8 relative">
                <div class="text-center max-w-2xl mx-auto mb-16 reveal-up">
                    <span class="text-primary font-bold tracking-widest uppercase text-xs mb-2 block">Arah Kami</span>
                    <h2 class="text-3xl lg:text-4xl font-extrabold text-slate-900 mb-4">Visi & Misi Sekolah</h2>
                    <div class="w-20 h-1.5 bg-gradient-to-r from-blue-600 to-indigo-600 mx-auto rounded-full"></div>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Visi Card -->
                    <div class="modern-card p-10 relative reveal-up">
                        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-600 to-blue-400"></div>
                        <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-primary text-2xl mb-8">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-6">Visi Sekolah</h3>
                        <p class="text-slate-600 leading-relaxed italic border-l-4 border-blue-100 pl-6">
                            "Menjadi lembaga pendidikan unggul yang menghasilkan generasi cerdas, berkarakter luhur, religius, dan kompetitif di kancah global."
                        </p>
                    </div>

                    <!-- Misi Card -->
                    <div class="modern-card p-10 relative reveal-up delay-200">
                        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-indigo-600 to-purple-500"></div>
                        <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 text-2xl mb-8">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-6">Misi Sekolah</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-4">
                                <span class="mt-1 w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold flex-shrink-0">1</span>
                                <span class="text-slate-600">Menyelenggarakan pendidikan berbasis teknologi dan iman.</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <span class="mt-1 w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold flex-shrink-0">2</span>
                                <span class="text-slate-600">Mengembangkan potensi akademik dan non-akademik siswa.</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <span class="mt-1 w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold flex-shrink-0">3</span>
                                <span class="text-slate-600">Membangun kemitraan strategis dengan institusi pendidikan.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- FASILITAS SECTION -->
        <section id="fasilitas" class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-end mb-16 reveal-up">
                    <div class="max-w-2xl">
                        <span class="text-primary font-bold tracking-widest uppercase text-xs mb-2 block">Sarana Prasarana</span>
                        <h2 class="text-3xl lg:text-4xl font-extrabold text-slate-900">Fasilitas Pendukung</h2>
                    </div>
                    <a href="#" class="hidden md:flex items-center text-primary font-bold hover:text-blue-800 transition-colors mt-4 md:mt-0">
                        Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Facility 1 -->
                    <div class="group bg-white p-8 rounded-3xl border border-slate-100 hover:border-blue-200 hover:shadow-2xl transition-all duration-500 reveal-up">
                        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-primary text-xl mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h4 class="font-bold text-lg text-slate-900 mb-3 group-hover:text-primary transition-colors">Ruang Kelas Digital</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Dilengkapi Smartboard, AC Sentral, dan CCTV 24 Jam.</p>
                    </div>

                    <!-- Facility 2 -->
                    <div class="group bg-white p-8 rounded-3xl border border-slate-100 hover:border-blue-200 hover:shadow-2xl transition-all duration-500 reveal-up delay-100">
                        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-primary text-xl mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                            <i class="fas fa-flask"></i>
                        </div>
                        <h4 class="font-bold text-lg text-slate-900 mb-3 group-hover:text-primary transition-colors">Laboratorium Sains</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Lab Kimia, Fisika, dan Biologi dengan peralatan modern.</p>
                    </div>

                    <!-- Facility 3 -->
                    <div class="group bg-white p-8 rounded-3xl border border-slate-100 hover:border-blue-200 hover:shadow-2xl transition-all duration-500 reveal-up delay-200">
                        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-primary text-xl mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h4 class="font-bold text-lg text-slate-900 mb-3 group-hover:text-primary transition-colors">E-Perpustakaan</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Ribuan koleksi buku fisik dan digital untuk literasi.</p>
                    </div>

                    <!-- Facility 4 -->
                    <div class="group bg-white p-8 rounded-3xl border border-slate-100 hover:border-blue-200 hover:shadow-2xl transition-all duration-500 reveal-up delay-300">
                        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-primary text-xl mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                            <i class="fas fa-basketball-ball"></i>
                        </div>
                        <h4 class="font-bold text-lg text-slate-900 mb-3 group-hover:text-primary transition-colors">Sport Center</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Lapangan Basket, Futsal, Voli, dan Gymnasium.</p>
                    </div>
                </div>
                
                <div class="mt-8 text-center md:hidden">
                    <a href="#" class="inline-flex items-center text-primary font-bold hover:text-blue-800 transition-colors">
                        Lihat Semua Fasilitas <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="bg-slate-900 text-white pt-20 pb-10 border-t border-slate-800">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid md:grid-cols-4 gap-12 mb-16">
                    <!-- Brand -->
                    <div class="col-span-1 md:col-span-1">
                        <div class="flex items-center gap-3 mb-6">
                            <!-- Blade Asset -->
                            <img src="{{ asset('image/logo-sekolah.png') }}" alt="Logo" class="w-10 h-10 rounded-full bg-white p-1">
                            <h2 class="font-bold text-xl tracking-wide">SMA Cakrawala</h2>
                        </div>
                        <p class="text-slate-400 text-sm leading-relaxed mb-6">
                            Membentuk karakter, meraih prestasi, dan membangun peradaban melalui pendidikan berkualitas dan berbasis teknologi.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white transition-all"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white transition-all"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white transition-all"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>

                    <!-- Links 1 -->
                    <div>
                        <h4 class="font-bold text-lg mb-6 text-white">Akademik</h4>
                        <ul class="space-y-4">
                            <li><a href="#" class="text-slate-400 hover:text-primary text-sm transition-colors">Kalender Pendidikan</a></li>
                            <li><a href="#" class="text-slate-400 hover:text-primary text-sm transition-colors">Kurikulum</a></li>
                            <li><a href="#" class="text-slate-400 hover:text-primary text-sm transition-colors">E-Learning</a></li>
                            <li><a href="#" class="text-slate-400 hover:text-primary text-sm transition-colors">Prestasi Siswa</a></li>
                        </ul>
                    </div>

                    <!-- Links 2 -->
                    <div>
                        <h4 class="font-bold text-lg mb-6 text-white">Informasi</h4>
                        <ul class="space-y-4">
                            <li><a href="#" class="text-slate-400 hover:text-primary text-sm transition-colors">PPDB Online</a></li>
                            <li><a href="#" class="text-slate-400 hover:text-primary text-sm transition-colors">Ekstrakurikuler</a></li>
                            <li><a href="#" class="text-slate-400 hover:text-primary text-sm transition-colors">Berita Sekolah</a></li>
                            <li><a href="#" class="text-slate-400 hover:text-primary text-sm transition-colors">Galeri Foto</a></li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h4 class="font-bold text-lg mb-6 text-white">Hubungi Kami</h4>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <i class="fas fa-map-marker-alt mt-1 text-primary"></i>
                                <span class="text-slate-400 text-sm">Jl. Pendidikan No. 123, Gresik, Jawa Timur 61121</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-phone-alt text-primary"></i>
                                <span class="text-slate-400 text-sm">(031) 395-1234</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-envelope text-primary"></i>
                                <span class="text-slate-400 text-sm">info@smacakrawala.sch.id</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-slate-500 text-sm mb-4 md:mb-0">
                        © 2025 SMA Cakrawala Gresik. All rights reserved.
                    </p>
                    <p class="text-slate-600 text-xs">
                        Developed with <i class="fas fa-heart text-red-500 mx-1"></i> by IT Division
                    </p>
                </div>
            </div>
        </footer>
    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // --- 1. LOADING SCREEN ---
            const loadingScreen = document.getElementById('loading-screen');
            const mainWrapper = document.getElementById('main-wrapper');
            const progressBar = document.getElementById('progress-bar');
            const loadingText = document.getElementById('loading-text');
            const particlesContainer = document.getElementById('particles');

            // Particles
            const particleCount = 50;
            for (let i = 0; i < particleCount; i++) {
                const p = document.createElement('div');
                p.classList.add('particle');
                const size = Math.random() * 4 + 1 + 'px';
                p.style.width = size;
                p.style.height = size;
                p.style.left = Math.random() * 100 + '%';
                p.style.animationDuration = Math.random() * 10 + 10 + 's';
                p.style.animationDelay = Math.random() * 5 + 's';
                particlesContainer.appendChild(p);
            }

            // Progress Logic
            let progress = 0;
            const messages = ["Memuat sistem...", "Menyiapkan data...", "Menghubungkan server...", "Siap!"];
            const interval = setInterval(() => {
                progress += Math.random() * 5;
                if (progress > 100) progress = 100;
                
                progressBar.style.width = progress + '%';
                
                if (progress < 30) loadingText.innerText = messages[0];
                else if (progress < 60) loadingText.innerText = messages[1];
                else if (progress < 90) loadingText.innerText = messages[2];
                else loadingText.innerText = messages[3];

                if (progress === 100) {
                    clearInterval(interval);
                    setTimeout(() => {
                        loadingScreen.classList.add('hidden');
                        mainWrapper.style.opacity = '1';
                    }, 500);
                }
            }, 50);

            // --- 2. MOBILE MENU ---
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            const mobileLinks = document.querySelectorAll('.mobile-link');

            btn.addEventListener('click', () => {
                menu.classList.toggle('max-h-96'); // Toggle height
                const icon = btn.querySelector('i');
                if (menu.classList.contains('max-h-96')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            });

            mobileLinks.forEach(link => {
                link.addEventListener('click', () => {
                    menu.classList.remove('max-h-96');
                    const icon = btn.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                });
            });

            // --- 3. SCROLL REVEAL (Intersection Observer) ---
            const observerOptions = { threshold: 0.1, rootMargin: "0px 0px -50px 0px" };
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal-up').forEach(el => observer.observe(el));

            // --- 4. NAVBAR GLASS EFFECT ON SCROLL ---
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 20) {
                    navbar.classList.add('shadow-md');
                } else {
                    navbar.classList.remove('shadow-md');
                }
            });
        });
    </script>
</body>
</html>