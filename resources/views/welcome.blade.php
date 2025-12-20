<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMA Cakrawala Gresik - Sistem Informasi Akademik</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background: #faf9f8;
        }

        /* ===== PREMIUM LOADING SCREEN ===== */
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #450a0a 0%, #7f1d1d 50%, #dc2626 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.8s ease;
        }

        #loading-screen.hidden {
            opacity: 0;
            pointer-events: none;
        }

        /* Subtle Particles Background */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            pointer-events: none;
            animation: float 15s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) translateX(0);
                opacity: 0;
            }
            10% {
                opacity: 0.4;
            }
            90% {
                opacity: 0.4;
            }
            100% {
                transform: translateY(-100vh) translateX(100px);
                opacity: 0;
            }
        }

        /* Logo Container - Elegant Animation */
        .logo-container {
            position: relative;
            margin-bottom: 40px;
            animation: subtlePulse 4s ease-in-out infinite;
        }

        @keyframes subtlePulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .logo-circle {
            width: 180px;
            height: 180px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.2);
        }

        .loading-logo {
            width: 120px;
            height: 120px;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.3));
        }

        /* Single Elegant Rotating Ring */
        .glow-ring {
            position: absolute;
            width: 220px;
            height: 220px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            animation: spin 10s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* School Name */
        .school-name {
            color: white;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: 2px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .school-tagline {
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            font-weight: 400;
            margin-bottom: 40px;
            letter-spacing: 1px;
            text-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);
        }

        /* Elegant Loading Bar */
        .loading-bar-container {
            width: 300px;
            height: 6px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            box-shadow: inset 0 1px 5px rgba(0, 0, 0, 0.2);
        }

        .loading-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #ffffff, #fef3c7);
            border-radius: 10px;
            animation: loadingProgress 3s ease-in-out forwards;
        }

        @keyframes loadingProgress {
            0% { width: 0%; }
            100% { width: 100%; }
        }

        /* Loading Messages */
        .loading-message {
            color: white;
            font-size: 14px;
            font-weight: 400;
            margin-top: 20px;
            letter-spacing: 0.5px;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            min-height: 20px;
        }

        .loading-percentage {
            color: white;
            font-size: 14px;
            font-weight: 600;
            margin-top: 10px;
            font-family: monospace;
            letter-spacing: 1px;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        }

        /* Main Content Animations */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease forwards;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .slide-right {
            opacity: 0;
            transform: translateX(20px);
            animation: slideInRight 0.8s ease forwards;
            animation-delay: 0.2s;
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Gradient */
        .red-gradient {
            background: linear-gradient(135deg, #b91c1c, #ef4444);
        }

        /* Button Hover */
        .btn-login {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
        }

        /* Card Hover */
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Navbar Sticky */
        .navbar-sticky {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        /* Hide main content during loading */
        body.loading #main-content {
            opacity: 0;
        }

        #main-content {
            opacity: 0;
            animation: fadeInContent 0.8s ease 0.3s forwards;
        }

        @keyframes fadeInContent {
            to { opacity: 1; }
        }

        /* Hover effects for nav links */
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #b91c1c;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Elegant Facility Icons */
        .facility-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(185, 28, 28, 0.1), rgba(239, 68, 68, 0.1));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .facility-icon::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #b91c1c, #ef4444);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .facility-icon i {
            font-size: 36px;
            color: #b91c1c;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .facility-card:hover .facility-icon {
            transform: translateY(-5px);
        }

        .facility-card:hover .facility-icon::before {
            opacity: 1;
        }

        .facility-card:hover .facility-icon i {
            color: white;
            transform: scale(1.1);
        }

        .facility-card {
            transition: all 0.3s ease;
        }

        .facility-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="loading">

    <!-- PREMIUM LOADING SCREEN -->
    <div id="loading-screen">
        <!-- Subtle Particles -->
        <div class="particles" id="particles"></div>
        
        <!-- Logo with Elegant Ring -->
        <div class="logo-container">
            <div class="glow-ring"></div>
            <div class="logo-circle">
                <img src="{{ asset('image/logo-sekolah.png') }}" alt="Logo SMA Cakrawala" class="loading-logo">
            </div>
        </div>

        <!-- School Information -->
        <div class="school-name">SMA CAKRAWALA</div>
        <div class="school-tagline">GRESIK, JAWA TIMUR</div>

        <!-- Elegant Loading Bar -->
        <div class="loading-bar-container">
            <div class="loading-bar-fill"></div>
        </div>
        
        <!-- Loading Messages -->
        <div class="loading-message" id="loading-message">Memuat sistem...</div>
        <div class="loading-percentage" id="loading-percentage">0%</div>
    </div>

    <!-- MAIN CONTENT -->
    <div id="main-content">
        <!-- Navbar -->
        <nav class="navbar-sticky shadow-md py-3 px-6 lg:px-8 fade-in">
            <div class="w-full flex items-center justify-between">
                <!-- Logo & Name -->
                <div class="flex items-center gap-2.5">
                    <img src="{{ asset('image/logo-sekolah.png') }}" alt="Logo SMA Cakrawala" class="w-10 h-10 rounded-full shadow-md">
                    <div>
                        <h1 class="font-bold text-base text-[#b91c1c]">SMA Cakrawala</h1>
                        <p class="text-[10px] text-gray-500">Gresik, Jawa Timur</p>
                    </div>
                </div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#home" class="nav-link text-gray-700 hover:text-[#b91c1c] transition font-medium text-sm smooth-link">Beranda</a>
                    <a href="#tentang" class="nav-link text-gray-700 hover:text-[#b91c1c] transition font-medium text-sm smooth-link">Tentang</a>
                    <a href="#visi-misi" class="nav-link text-gray-700 hover:text-[#b91c1c] transition font-medium text-sm smooth-link">Visi & Misi</a>
                    <a href="#fasilitas" class="nav-link text-gray-700 hover:text-[#b91c1c] transition font-medium text-sm smooth-link">Fasilitas</a>
                </div>

                <!-- Login Button -->
                <a href="{{ route('login') }}" class="red-gradient text-white px-7 py-2.5 rounded-lg font-semibold btn-login shadow-md text-sm">
                    Login
                </a>
            </div>
        </nav>

        <!-- Hero Section -->
        <section id="home" class="max-w-7xl mx-auto px-8 lg:px-16 py-20 lg:py-28">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-16">
                <!-- Text Content -->
                <div class="flex-1 fade-in" style="animation-delay: 0.1s;">
                    <div class="inline-block bg-red-50 text-[#b91c1c] px-5 py-2.5 rounded-full text-base font-semibold mb-6">
                        Sistem Informasi Akademik Digital
                    </div>
                    <h2 class="text-5xl lg:text-6xl font-extrabold text-gray-800 leading-tight mb-7">
                        Selamat Datang di<br>
                        <span class="text-[#b91c1c]">SMA Cakrawala Gresik</span>
                    </h2>
                    <p class="text-gray-600 text-xl leading-relaxed mb-10">
                        Platform digital terintegrasi untuk pengelolaan akademik, absensi, nilai, dan ekstrakurikuler secara efisien dan modern.
                    </p>
                    <div class="flex gap-5">
                        <a href="#tentang" class="red-gradient text-white px-9 py-3.5 rounded-lg font-semibold btn-login shadow-lg smooth-link text-base">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>

                <!-- Image -->
                <div class="flex-1 slide-right">
                    <img src="{{ asset('image/section.png') }}" alt="Ilustrasi Siswa" class="w-full max-w-lg mx-auto drop-shadow-2xl">
                </div>
            </div>
        </section>

        <!-- Tentang Sekolah -->
        <section id="tentang" class="bg-white py-16 lg:py-20">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="text-center mb-12 fade-in">
                    <h3 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-4">Tentang SMA Cakrawala</h3>
                    <div class="w-20 h-1 red-gradient mx-auto rounded-full"></div>
                </div>

                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="fade-in" style="animation-delay: 0.1s;">
                        <img src="{{ asset('image/logo-sekolah.png') }}" alt="Logo Sekolah" class="w-2/3 mx-auto rounded-2xl shadow-xl">
                    </div>

                    <div class="fade-in" style="animation-delay: 0.2s;">
                        <p class="text-gray-600 text-lg leading-relaxed mb-6">
                            <strong class="text-[#b91c1c]">SMA Cakrawala Gresik</strong> adalah lembaga pendidikan menengah atas yang berkomitmen untuk mencetak generasi unggul, berkarakter, dan berprestasi. Dengan didukung oleh tenaga pendidik profesional dan fasilitas modern, kami menghadirkan pembelajaran yang berkualitas dan berorientasi pada masa depan.
                        </p>
                        <p class="text-gray-600 text-lg leading-relaxed mb-6">
                            Sekolah kami menyediakan berbagai program unggulan seperti kelas akselerasi, ekstrakurikuler yang beragam, dan sistem pembelajaran digital yang terintegrasi untuk mempersiapkan siswa menghadapi tantangan era modern.
                        </p>

                        <div class="grid grid-cols-3 gap-6 mt-8">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-[#b91c1c]">10+</div>
                                <div class="text-sm text-gray-600 mt-1">Tahun Berdiri</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-[#b91c1c]">100+</div>
                                <div class="text-sm text-gray-600 mt-1">Siswa Aktif</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-[#b91c1c]">30+</div>
                                <div class="text-sm text-gray-600 mt-1">Tenaga Pendidik</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Visi Misi -->
        <section id="visi-misi" class="py-16 lg:py-20">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="text-center mb-12 fade-in">
                    <h3 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-4">Visi & Misi</h3>
                    <div class="w-20 h-1 red-gradient mx-auto rounded-full"></div>
                </div>

                <div class="grid lg:grid-cols-2 gap-8">
                    <!-- Visi -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg card-hover fade-in" style="animation-delay: 0.1s;">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-14 h-14 red-gradient rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                V
                            </div>
                            <h4 class="text-2xl font-bold text-gray-800">Visi</h4>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            Menjadi lembaga pendidikan unggul yang menghasilkan generasi cerdas, berkarakter, religius, dan berwawasan global untuk menyongsong masa depan yang gemilang.
                        </p>
                    </div>

                    <!-- Misi -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg card-hover fade-in" style="animation-delay: 0.2s;">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-14 h-14 red-gradient rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                M
                            </div>
                            <h4 class="text-2xl font-bold text-gray-800">Misi</h4>
                        </div>
                        <ul class="text-gray-600 space-y-3">
                            <li class="flex items-start gap-3">
                                <span class="text-[#b91c1c] font-bold">•</span>
                                <span>Menyelenggarakan pendidikan berkualitas dengan kurikulum terkini</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-[#b91c1c] font-bold">•</span>
                                <span>Mengembangkan karakter siswa melalui nilai-nilai religius dan moral</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-[#b91c1c] font-bold">•</span>
                                <span>Memfasilitasi pengembangan bakat dan minat siswa</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-[#b91c1c] font-bold">•</span>
                                <span>Membangun kerjasama dengan berbagai pihak untuk kemajuan pendidikan</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Fasilitas -->
        <section id="fasilitas" class="bg-white py-16 lg:py-20">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="text-center mb-12 fade-in">
                    <h3 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-4">Fasilitas Unggulan</h3>
                    <div class="w-20 h-1 red-gradient mx-auto rounded-full"></div>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Fasilitas Item - Ruang Kelas -->
                    <div class="bg-gradient-to-br from-red-50 to-white p-6 rounded-xl shadow-md facility-card fade-in" style="animation-delay: 0.1s;">
                        <div class="facility-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h5 class="font-bold text-lg text-gray-800 mb-2">Ruang Kelas Modern</h5>
                        <p class="text-gray-600 text-sm">AC, proyektor, dan fasilitas multimedia lengkap</p>
                    </div>

                    <!-- Fasilitas Item - Laboratorium -->
                    <div class="bg-gradient-to-br from-red-50 to-white p-6 rounded-xl shadow-md facility-card fade-in" style="animation-delay: 0.2s;">
                        <div class="facility-icon">
                            <i class="fas fa-flask"></i>
                        </div>
                        <h5 class="font-bold text-lg text-gray-800 mb-2">Laboratorium</h5>
                        <p class="text-gray-600 text-sm">Lab Komputer, Fisika, Kimia, dan Biologi</p>
                    </div>

                    <!-- Fasilitas Item - Perpustakaan -->
                    <div class="bg-gradient-to-br from-red-50 to-white p-6 rounded-xl shadow-md facility-card fade-in" style="animation-delay: 0.3s;">
                        <div class="facility-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h5 class="font-bold text-lg text-gray-800 mb-2">Perpustakaan</h5>
                        <p class="text-gray-600 text-sm">Koleksi buku yang lengkap</p>
                    </div>

                    <!-- Fasilitas Item - Lapangan Olahraga -->
                    <div class="bg-gradient-to-br from-red-50 to-white p-6 rounded-xl shadow-md facility-card fade-in" style="animation-delay: 0.4s;">
                        <div class="facility-icon">
                            <i class="fas fa-running"></i>
                        </div>
                        <h5 class="font-bold text-lg text-gray-800 mb-2">Lapangan Olahraga</h5>
                        <p class="text-gray-600 text-sm">Basket, Voli, Futsal, dan Atletik</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="red-gradient text-white py-8">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="grid md:grid-cols-3 gap-8 mb-6">
                    <!-- Info -->
                    <div>
                        <h5 class="font-bold text-lg mb-4">SMA Cakrawala Gresik</h5>
                        <p class="text-white/80 text-sm leading-relaxed">
                            Lembaga pendidikan menengah atas yang berkomitmen mencetak generasi unggul dan berprestasi.
                        </p>
                    </div>

                    <!-- Kontak -->
                    <div>
                        <h5 class="font-bold text-lg mb-4">Kontak</h5>
                        <ul class="text-white/80 text-sm space-y-2">
                            <li>📍 Jl. Pendidikan No. 123, Gresik</li>
                            <li>📞 (031) 1234-5678</li>
                            <li>✉️ info@smacakrawala.sch.id</li>
                        </ul>
                    </div>

                    <!-- Link Cepat -->
                    <div>
                        <h5 class="font-bold text-lg mb-4">Link Cepat</h5>
                        <ul class="text-white/80 text-sm space-y-2">
                            <li><a href="#home" class="hover:text-white transition smooth-link">Beranda</a></li>
                            <li><a href="#tentang" class="hover:text-white transition smooth-link">Tentang Kami</a></li>
                            <li><a href="{{ route('login') }}" class="hover:text-white transition">Login Sistem</a></li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-white/20 pt-6 text-center text-white/80 text-sm">
                    © 2025 Sistem Informasi Akademik SMA Cakrawala Gresik. All rights reserved.
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Premium Loading Screen
        window.addEventListener('load', function() {
            const loadingMessages = [
                'Memuat sistem...',
                'Menyiapkan data...',
                'Mengecek koneksi...',
                'Memuat aset...',
                'Hampir selesai...',
                'Selamat datang!'
            ];
            
            let messageIndex = 0;
            const messageElement = document.getElementById('loading-message');
            
            // Change loading message
            const messageInterval = setInterval(() => {
                if (messageIndex < loadingMessages.length) {
                    messageElement.textContent = loadingMessages[messageIndex];
                    messageIndex++;
                }
            }, 500);

            // Create subtle particles
            const particlesContainer = document.getElementById('particles');
            for (let i = 0; i < 30; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                const size = Math.random() * 3 + 1;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 15 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 15) + 's';
                
                particlesContainer.appendChild(particle);
            }

            // Animate loading percentage
            let percentage = 0;
            const percentageElement = document.getElementById('loading-percentage');
            const interval = setInterval(() => {
                percentage += Math.random() * 10 + 5;
                if (percentage >= 100) {
                    percentage = 100;
                    clearInterval(interval);
                    clearInterval(messageInterval);
                    messageElement.textContent = 'Selamat datang!';
                    
                    // Hide loading screen after reaching 100%
                    setTimeout(() => {
                        document.getElementById('loading-screen').classList.add('hidden');
                        document.body.classList.remove('loading');
                    }, 500);
                }
                percentageElement.textContent = Math.floor(percentage) + '%';
            }, 150);
        });

        // Smooth Scroll without transition overlay
        document.querySelectorAll('.smooth-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);
                
                if (targetSection) {
                    // Direct smooth scroll to target
                    targetSection.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>

</body>
</html>