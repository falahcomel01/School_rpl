<!-- resources/views/layouts/navigation.blade.php -->
<nav>
    <!-- === SIDEBAR === -->
    <aside class="sidebar" id="sidebar">
        <!-- ✅ LOGO SECTION (INTEGRATED WITH SIDEBAR) -->
        <div class="sidebar-logo-section">
            <div class="logo-container">
                <img src="{{ asset('image/logo-sekolah.png') }}" alt="Logo Sekolah" class="logo-image" 
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                <!-- Fallback icon jika gambar tidak ada -->
                <i class="fa-solid fa-graduation-cap" style="display: none; font-size: 28px; color: #e63946;"></i>
            </div>
            <div class="logo-text">
                <h4 class="school-name">SMA CAKRAWALA</h4>
                <p class="school-tagline">Excellence in Education</p>
            </div>
        </div>
        
        <div class="sidebar-divider"></div>

        <div class="sidebar-header">
            <button id="toggleSidebar" class="nav-link btn-toggle">
                <i class="fa-solid fa-bars"></i>
                <span class="link-text">Menu</span>
            </button>
        </div>
        
        <div class="sidebar-divider"></div>

        <!-- ✅ SIDEBAR MENU -->
        <div class="sidebar-menu">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line"></i>
                <span class="link-text">Dashboard</span>
            </a>

            <!-- Manajemen User -->
            @canany(['view users', 'view roles', 'view permissions'])
            <div class="nav-item-elite-red-dropdown {{ request()->routeIs('users.*','roles.*','permissions.*','landing.setting.*','orangtua.*') ? 'active' : '' }}">
                <button class="nav-link elite-red-dropdown-toggle d-flex align-items-center">
                    <i class="fa-solid fa-users-gear"></i>
                    <span class="link-text">Manajemen User</span>
                    <i class="fa-solid fa-chevron-right toggle-icon ms-auto"></i>
                </button>
                <div class="elite-red-inline-dropdown-menu">
                    <a href="{{ route('users.index') }}" class="elite-red-dropdown-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-user"></i>
                        <span>Users</span>
                    </a>
                    <a href="{{ route('roles.index') }}" class="elite-red-dropdown-item {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-tag"></i>
                        <span>Roles</span>
                    </a>
                    <a href="{{ route('permissions.index') }}" class="elite-red-dropdown-item {{ request()->routeIs('permissions.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-key"></i>
                        <span>Permissions</span>
                    </a>
                </div>
            </div>
            @endcanany

            <!-- Manajemen Kelas -->
            @canany(['view users', 'view roles', 'view permissions'])
            <div class="nav-item-elite-red-dropdown {{ request()->routeIs('kelas.*','jurusan.*','mapel.*') ? 'active' : '' }}">
                <button class="nav-link elite-red-dropdown-toggle d-flex align-items-center">
                    <i class="fa-solid fa-building-columns"></i>
                    <span class="link-text">Manajemen Kelas</span>
                    <i class="fa-solid fa-chevron-right toggle-icon ms-auto"></i>
                </button>
                <div class="elite-red-inline-dropdown-menu">
                    <a href="{{ route('kelas.index') }}" class="elite-red-dropdown-item {{ request()->routeIs('kelas.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-door-open"></i>
                        <span>Kelas</span>
                    </a>
                    <a href="{{ route('jurusan.index') }}" class="elite-red-dropdown-item {{ request()->routeIs('jurusan.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <span>Jurusan</span>
                    </a>
                    <a href="{{ route('mapel.index') }}" class="elite-red-dropdown-item {{ request()->routeIs('mapel.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-book-open"></i>
                        <span>Matapelajaran</span>
                    </a>
                </div>
            </div>
            @endcanany   
       @canany(['view guru'])
<div class="nav-item-elite-red-dropdown {{ request()->routeIs('guru.*','pembina.*','orangtua.*') ? 'active' : '' }}">
    <button class="nav-link elite-red-dropdown-toggle d-flex align-items-center">
        <i class="fa-solid fa-chalkboard-user"></i>
        <span class="link-text">Manajemen Data Pengajar</span>
        <i class="fa-solid fa-chevron-right toggle-icon ms-auto"></i>
    </button>

    <div class="elite-red-inline-dropdown-menu">

        <a href="{{ route('guru.index') }}"
           class="elite-red-dropdown-item {{ request()->routeIs('guru.*') ? 'active' : '' }}">
            <i class="fa-solid fa-user-tie"></i>
            <span>Data Guru</span>
        </a>

        <a href="{{ route('pembina.index') }}"
           class="elite-red-dropdown-item {{ request()->routeIs('pembina.*') ? 'active' : '' }}">
            <i class="fa-solid fa-people-group"></i>
            <span>Data Pembina Ekstra</span>
        </a>

        <a href="{{ route('orangtua.index') }}"
           class="elite-red-dropdown-item {{ request()->routeIs('orangtua.*') ? 'active' : '' }}">
            <i class="fa-solid fa-user-shield"></i>
            <span>Orangtua</span>
        </a>

    </div>
</div>
@endcanany

   <!-- Data Siswa -->
            @can('view siswa')
            <a href="{{ route('siswa.index') }}" class="nav-link {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i>
                <span class="link-text">Data Siswa</span>
            </a>
            @endcan
            <!-- Wali Kelas -->
            @can('view walikelas')
            <a href="{{ route('walikelas.index') }}" class="nav-link {{ request()->routeIs('walikelas.*') ? 'active' : '' }}">
                <i class="fa-solid fa-id-card-clip"></i>
                <span class="link-text">Wali Kelas</span>
            </a>
            @endcan

            <!-- Jadwal -->
            @can('view jadwal')
            <a href="{{ route('jadwal.index') }}" class="nav-link {{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-days"></i>
                <span class="link-text">Jadwal</span>
            </a>
            @endcan

            <!-- Presensi -->
            @can('view presensisiswa')
            <a href="{{ route('presensi.index') }}" class="nav-link {{ request()->routeIs('presensi.*') ? 'active' : '' }}">
                <i class="fa-solid fa-clipboard-check"></i>
                <span class="link-text">Presensi</span>
            </a>
            @endcan

            <!-- Perizinan -->
            @can('view perizinan')
            <a href="{{ route('perizinan.index') }}" class="nav-link {{ request()->routeIs('perizinan.*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-circle-check"></i>
                <span class="link-text">Perizinan</span>
            </a>
            @endcan

            @can('view tugas')
            <a href="{{ route('tugas.index') }}" class="nav-link {{ request()->routeIs('tugas.*') ? 'active' : '' }}">
                <i class="fa-solid fa-laptop-file"></i>
                <span class="link-text">Tugas Online</span>
            </a>
            @endcan
            @can('view catatan_perkembangan')
            <a href="{{ route('catatan_perkembangan.index') }}" class="nav-link {{ request()->routeIs('catatan_perkembangan.*') ? 'active' : '' }}">
                <i class="fa-solid fa-book-bookmark"></i>
                <span class="link-text">Catatan Perkembangan</span>
            </a>
@endcan
            <!-- Materi Pembelajaran -->
            @canany('view materi')
            <div class="nav-item-elite-red-dropdown {{ request()->routeIs('jenis-ujian.*','soal.*','ujian.*') ? 'active' : '' }}">
                <button class="nav-link elite-red-dropdown-toggle d-flex align-items-center">
                    <i class="fa-solid fa-book-open-reader"></i>
                    <span class="link-text">Materi Pembelajaran</span>
                    <i class="fa-solid fa-chevron-right toggle-icon ms-auto"></i>
                </button>
                <div class="elite-red-inline-dropdown-menu">
                    <a href="{{ route('jenis-ujian.index') }}" class="elite-red-dropdown-item {{ request()->routeIs('jenis-ujian.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-list-check"></i>
                        <span>Jenis Ujian</span>
                    </a>
                    <a href="{{ route('soal.index') }}" class="elite-red-dropdown-item {{ request()->routeIs('soal.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-circle-question"></i>
                        <span>Soal</span>
                    </a>
                    <a href="{{ route('ujian.index') }}" class="elite-red-dropdown-item {{ request()->routeIs('ujian.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-file-lines"></i>
                        <span>Ujian</span>
                    </a>
                </div>
            </div>
@endcanany
            @if(Auth::user()->siswa)
            <a href="{{ route('ujian_siswa.index') }}" class="nav-link {{ request()->routeIs('ujian_siswa.*') ? 'active' : '' }}">
                <i class="fa-solid fa-pen-to-square"></i>
                <span class="link-text">Ujian Siswa</span>
            </a>
            @endif

            <!-- Rekap Nilai (Untuk Guru) -->
            @if(Auth::user()->guru)
            <a href="{{ route('rekap_nilai.index') }}" class="nav-link {{ request()->routeIs('rekap_nilai.*') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-column"></i>
                <span class="link-text">Rekap Nilai</span>
            </a>
            @endif
              @if(Auth::user()->siswa)
            <a href="{{ route('rekap_nilai.siswa') }}" class="nav-link {{ request()->routeIs('rekap_nilai.siswa') ? 'active' : '' }}">
                <i class="fa-solid fa-file-alt"></i>
                <span class="link-text">Rekap Nilai Saya</span>
            </a>
            @endif

          <!-- Rapor Saya (SISWA & ORANG TUA) -->
@if(
    session('active_role') === 'siswa' ||
    session('active_role') === 'orangtua'
)
    <a href="{{ route('rapor.siswa') }}"
       class="nav-link {{ request()->routeIs('rapor.siswa*') ? 'active' : '' }}">
        <i class="fa-solid fa-file-lines"></i>
        <span class="link-text">
            {{ session('active_role') === 'orangtua' ? 'Rapor Anak' : 'Rapor Saya' }}
        </span>
    </a>
@endif


            <!-- Rapor (Untuk Guru & Superadmin) -->
            @if(Auth::user()->walikelas || Auth::user()->roles->contains('name', 'superadmin'))
            <a href="{{ route('rapor.index') }}" class="nav-link {{ request()->routeIs('rapor.index', 'rapor.create', 'rapor.show') ? 'active' : '' }}">
                <i class="fa-solid fa-file-pdf"></i>
                <span class="link-text">Rapor</span>
            </a>
            @endif
          @can('view extra')
            <a href="{{ route('ekstrakurikulers.index') }}" class="nav-link {{ request()->routeIs('ekstrakurikulers.*') ? 'active' : '' }}">
                <i class="fa-solid fa-futbol"></i>
                <span class="link-text">Ekstrakurikuler</span>
            </a>
            <a href="{{ route('presensi_ekstra.index') }}" class="nav-link {{ request()->routeIs('presensi_ekstra.*') ? 'active' : '' }}">
                <i class="fa-solid fa-clipboard-user"></i>
                <span class="link-text">Presensi Ekstra</span>
            </a>
            @endcan
            @can('view prestasi')
            <a href="{{ route('prestasi.index') }}" class="nav-link {{ request()->routeIs('prestasi.*') ? 'active' : '' }}">
                <i class="fa-solid fa-trophy"></i>
                <span class="link-text">Prestasi</span>
            </a> @endcan
             @can('view aturankelulusan')
            <a href="{{ route('aturan-kelulusan.index') }}" class="nav-link {{ request()->routeIs('aturan-kelulusan.*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-contract"></i>
                <span class="link-text">Aturan Kelulusan</span>
            </a>
@endcan
        
@php
    $canViewKelulusan = false;
    
    if(Auth::user()->siswa) {
        $kelas = Auth::user()->siswa->kelas;
        if($kelas && $kelas->nama_kelas == '12') {
            $canViewKelulusan = true;
        }
    }
    
    // TU dan Kepsek bisa lihat (melalui role atau permission)
    if(Auth::user()->hasAnyRole(['tus', 'kepsek', 'superadmin'])) {
        $canViewKelulusan = true;
    }
@endphp
@if($canViewKelulusan)
<a href="{{ route('kelulusan.index') }}" class="nav-link {{ request()->routeIs('kelulusan.*') ? 'active' : '' }}">
    <i class="fa-solid fa-graduation-cap"></i>
    <span class="link-text">Kelulusan</span>
</a>
@endif

<!-- Menu Dinamis Berdasarkan Kelas -->
@if(Auth::user()->siswa)
    @php
        $siswaData = Auth::user()->siswa;
        if (!$siswaData->relationLoaded('kelas')) {
            $siswaData->load('kelas');
        }
        
        $kelas = $siswaData->kelas;
        $namaKelas = $kelas ? $kelas->nama_kelas : '';
        
        // Deteksi kelas 10 (untuk menu Rekomendasi Jurusan)
        $isKelas10 = !empty($namaKelas) && (
            str_contains($namaKelas, '10') || 
            preg_match('/\bX\b/i', $namaKelas)
        );
        
        // Deteksi kelas 12 (untuk menu Info Kelulusan)
        $isKelas12 = !empty($namaKelas) && (
            str_contains($namaKelas, '12') || 
            preg_match('/\bXII\b/i', $namaKelas)
        );
    @endphp
    
    <!-- Menu Rekomendasi Jurusan (Hanya Kelas 10) -->
    @if($isKelas10)
    <a href="{{ route('rekomendasi.index') }}" class="nav-link {{ request()->routeIs('rekomendasi.*') ? 'active' : '' }}">
        <i class="fa-solid fa-route"></i>
        <span>Rekomendasi Jurusan</span>
    </a>
    @endif
    
    <!-- Menu Info Kelulusan (Hanya Kelas 12) -->
    @if($isKelas12)
    <a href="{{ route('kelulusan.index') }}" class="nav-link {{ request()->routeIs('kelulusan.*') ? 'active' : '' }}">
        <i class="fa-solid fa-graduation-cap"></i>
        <span>Info Kelulusan</span>
    </a>
    @endif
@endif
        </div>
    </aside>

    <!-- === HEADER === -->
    <header class="navbar-top shadow-sm d-flex align-items-center justify-content-between px-4" id="mainHeader">
        <div class="d-flex align-items-center gap-3">
            <div class="breadcrumb-section">
                <h5 class="fw-semibold mb-0">
                    @if (request()->routeIs('dashboard'))
                        Dashboard
                    @elseif (request()->routeIs('users.*'))
                        Manajemen User
                    @elseif (request()->routeIs('roles.*'))
                        Roles
                    @elseif (request()->routeIs('permissions.*'))
                        Permissions
                    @elseif (request()->routeIs('orangtua.*'))
                        Data Orangtua
                    @elseif (request()->routeIs('kelas.*'))
                        Manajemen Kelas
                    @elseif (request()->routeIs('jurusan.*'))
                        Jurusan
                    @elseif (request()->routeIs('mapel.*'))
                        Mata Pelajaran
                    @elseif (request()->routeIs('siswa.*'))
                        Data Siswa
                    @elseif (request()->routeIs('guru.*'))
                        Data Guru
                    @elseif (request()->routeIs('jadwal.*'))
                        Jadwal
                    @elseif (request()->routeIs('presensi.*'))
                        Presensi
                    @elseif (request()->routeIs('walikelas.*'))
                        Wali Kelas
                    @elseif (request()->routeIs('perizinan.*'))
                        Perizinan
                    @elseif (request()->routeIs('tugas.*'))
                        Tugas Online
                    @elseif (request()->routeIs('soal.*'))
                        Soal
                    @elseif (request()->routeIs('ujian.*'))
                        Ujian
                    @elseif (request()->routeIs('ujian_siswa.*'))
                        Ujian Siswa
                    @elseif (request()->routeIs('rekap_nilai.*'))
                        Rekap Nilai
                    @elseif (request()->routeIs('rapor.*'))
                        Rapor
                    @elseif (request()->routeIs('profile.*'))
                        Profil
                    @endif
                </h5>
            </div>
        </div>

        <div class="header-actions d-flex align-items-center gap-3">
            <!-- Profile Dropdown -->
            <div class="dropdown profile">
                <button class="profile-btn dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                    <div class="profile-avatar me-2">
                        @if(Auth::user()->guru && Auth::user()->guru->foto_profile)
                            <img src="{{ asset('storage/' . Auth::user()->guru->foto_profile) }}" alt="Profile Picture">
                        @elseif(Auth::user()->siswa && Auth::user()->siswa->foto_profile)
                            <img src="{{ asset('storage/' . Auth::user()->siswa->foto_profile) }}" alt="Profile Picture">
                        @elseif(Auth::user()->superadmin && Auth::user()->superadmin->foto_profile)
                            <img src="{{ asset('storage/' . Auth::user()->superadmin->foto_profile) }}" alt="Profile Picture">
                        @elseif(Auth::user()->tus && Auth::user()->tus->foto_profile)
                            <img src="{{ asset('storage/' . Auth::user()->tus->foto_profile) }}" alt="Profile Picture">
                        @else
                            <i class="fa-solid fa-user"></i>
                        @endif
                    </div>
                    <div class="profile-info">
                        <span class="profile-name">{{ Auth::user()->name }}</span>
                        <small class="profile-role">{{ Auth::user()->roles->first()->name ?? 'User' }}</small>
                    </div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end elite-dropdown">
                    <li class="dropdown-header">
                        <div class="d-flex align-items-center gap-2">
                            <div class="profile-avatar-lg">
                                @if(Auth::user()->guru && Auth::user()->guru->foto_profile)
                                    <img src="{{ asset('storage/' . Auth::user()->guru->foto_profile) }}" alt="Profile">
                                @elseif(Auth::user()->siswa && Auth::user()->siswa->foto_profile)
                                    <img src="{{ asset('storage/' . Auth::user()->siswa->foto_profile) }}" alt="Profile">
                                @elseif(Auth::user()->superadmin && Auth::user()->superadmin->foto_profile)
                                    <img src="{{ asset('storage/' . Auth::user()->superadmin->foto_profile) }}" alt="Profile">
                                @elseif(Auth::user()->tus && Auth::user()->tus->foto_profile)
                                    <img src="{{ asset('storage/' . Auth::user()->tus->foto_profile) }}" alt="Profile">
                                @else
                                    <i class="fa-solid fa-user"></i>
                                @endif
                            </div>
                            <div>
                                <div class="fw-bold">{{ Auth::user()->name }}</div>
                                <small class="text-muted">{{ Auth::user()->email }}</small>
                            </div>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="fa-regular fa-id-card me-2"></i> Profil Saya
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger fw-semibold" type="submit">
                                <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>
</nav>
<style>
/* === GOOGLE FONTS === */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

/* === GLOBAL STYLES === */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
    overflow-x: hidden;
}

/* === SIDEBAR === */
.sidebar {
    width: 260px;
    background: linear-gradient(180deg, #1a0000 0%, #4a0000 50%, #780000 100%);
    color: #fff;
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    display: flex;
    flex-direction: column;
    z-index: 1000;
    box-shadow: 4px 0 20px rgba(193, 18, 31, 0.3);
    transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    overflow: hidden;
    border-right: 1px solid rgba(255, 255, 255, 0.1);
}

.sidebar::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.02)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
    pointer-events: none;
}

.sidebar.collapsed {
    width: 80px;
}

/* === LOGO SECTION === */
.sidebar-logo-section {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px 15px;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    position: relative;
    overflow: hidden;
    transition: all 0.4s ease;
}

.sidebar-logo-section::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 123, 115, 0.1) 0%, transparent 70%);
    animation: pulse 3s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 0.5; }
    50% { transform: scale(1.1); opacity: 0.8; }
}

.logo-container {
    width: 55px;
    height: 55px;
    border-radius: 15px;
    background: linear-gradient(135deg, #fff 0%, #f0f0f0 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3), inset 0 1px 2px rgba(255, 255, 255, 0.5);
    border: 2px solid rgba(255, 255, 255, 0.2);
    transition: all 0.4s ease;
    flex-shrink: 0;
    position: relative;
    z-index: 1;
}

.logo-container::after {
    content: '';
    position: absolute;
    inset: -3px;
    border-radius: 17px;
    background: linear-gradient(45deg, #ff7b73, #ff3c3c, #e63946);
    z-index: -1;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.sidebar:not(.collapsed) .logo-container:hover::after {
    opacity: 1;
    animation: rotate 2s linear infinite;
}

@keyframes rotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.logo-image {
    width: 45px;
    height: 45px;
    border-radius: 10px;
    object-fit: cover;
}

.logo-text {
    display: flex;
    flex-direction: column;
    gap: 2px;
    transition: all 0.4s ease;
    position: relative;
    z-index: 1;
}

.school-name {
    font-size: 18px;
    font-weight: 700;
    color: #fff;
    margin: 0;
    letter-spacing: 1px;
    text-shadow: 0 2px 10px rgba(255, 123, 115, 0.5);
    background: linear-gradient(90deg, #fff 0%, #ff7b73 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.school-tagline {
    font-size: 10px;
    font-weight: 400;
    color: rgba(255, 255, 255, 0.7);
    margin: 0;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.sidebar.collapsed .logo-text {
    opacity: 0;
    width: 0;
    overflow: hidden;
}

.sidebar.collapsed .sidebar-logo-section {
    justify-content: center;
    padding: 20px 10px;
}

/* === SIDEBAR HEADER === */
.sidebar-header {
    width: 100%;
    padding: 10px 15px;
}

.btn-toggle {
    width: 100%;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #fff;
    font-weight: 500;
    font-size: 14px;
    padding: 12px 15px;
    border-radius: 12px;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.btn-toggle::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 123, 115, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.5s, height 0.5s;
}

.btn-toggle:hover::before {
    width: 300px;
    height: 300px;
}

.btn-toggle:hover {
    background: rgba(255, 123, 115, 0.2);
    border-color: rgba(255, 123, 115, 0.5);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 123, 115, 0.3);
}

.btn-toggle i {
    font-size: 18px;
    color: #ff7b73;
    transition: all 0.3s ease;
    position: relative;
    z-index: 1;
}

.btn-toggle:hover i {
    transform: rotate(90deg);
    color: #fff;
}

.sidebar.collapsed .btn-toggle {
    justify-content: center;
}

.sidebar.collapsed .btn-toggle .link-text {
    display: none;
}

.sidebar-divider {
    width: 85%;
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.2), transparent);
    margin: 10px auto;
}

/* === SIDEBAR MENU === */
.sidebar-menu {
    width: 100%;
    padding: 10px 15px;
    display: flex;
    flex-direction: column;
    overflow-y: auto;
    max-height: calc(100vh - 280px);
    scrollbar-width: thin;
    scrollbar-color: #ff7b73 transparent;
}

.sidebar-menu::-webkit-scrollbar {
    width: 5px;
}

.sidebar-menu::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar-menu::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #ff7b73, #ff3c3c);
    border-radius: 10px;
}

/* === NAV LINKS === */
.sidebar .nav-link {
    color: rgba(255, 255, 255, 0.8);
    font-weight: 500;
    font-size: 14px;
    padding: 12px 15px;
    border-radius: 12px;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: transparent;
    position: relative;
    overflow: hidden;
    margin-bottom: 5px;
}

.sidebar .nav-link::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 3px;
    background: linear-gradient(180deg, #ff7b73, #ff3c3c);
    transform: scaleY(0);
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.sidebar .nav-link:hover::before,
.sidebar .nav-link.active::before {
    transform: scaleY(1);
}

.sidebar .nav-link:hover {
    background: rgba(255, 123, 115, 0.15);
    color: #fff;
    transform: translateX(5px);
}

.sidebar .nav-link.active {
    background: linear-gradient(90deg, rgba(255, 123, 115, 0.3), rgba(255, 60, 60, 0.2));
    color: #fff;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(255, 123, 115, 0.2);
}

.sidebar .nav-link i {
    font-size: 18px;
    color: #ff7b73;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.sidebar .nav-link:hover i,
.sidebar .nav-link.active i {
    color: #fff;
    transform: scale(1.1);
}

/* === DROPDOWN === */
.nav-item-elite-red-dropdown {
    width: 100%;
    margin-bottom: 5px;
}

.elite-red-dropdown-toggle {
    color: rgba(255, 255, 255, 0.8);
    font-weight: 500;
    font-size: 14px;
    padding: 12px 15px;
    border-radius: 12px;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: transparent;
    border: none;
    text-align: left;
    position: relative;
    overflow: hidden;
}

.elite-red-dropdown-toggle::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 3px;
    background: linear-gradient(180deg, #ff7b73, #ff3c3c);
    transform: scaleY(0);
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.elite-red-dropdown-toggle:hover {
    background: rgba(255, 123, 115, 0.15);
    color: #fff;
    transform: translateX(5px);
}

.elite-red-dropdown-toggle:hover::before {
    transform: scaleY(1);
}

.elite-red-dropdown-toggle i:not(.toggle-icon) {
    font-size: 18px;
    color: #ff7b73;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.elite-red-dropdown-toggle:hover i:not(.toggle-icon) {
    transform: scale(1.1);
    color: #fff;
}

.nav-item-elite-red-dropdown.active .elite-red-dropdown-toggle {
    background: linear-gradient(90deg, rgba(255, 123, 115, 0.3), rgba(255, 60, 60, 0.2));
    color: #fff;
    font-weight: 600;
}

.nav-item-elite-red-dropdown.active .elite-red-dropdown-toggle::before {
    transform: scaleY(1);
}

.nav-item-elite-red-dropdown.active .elite-red-dropdown-toggle i:not(.toggle-icon) {
    color: #fff;
}

.toggle-icon {
    font-size: 12px;
    color: #ff7b73;
    transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    margin-left: auto;
}

.nav-item-elite-red-dropdown.active .toggle-icon,
.elite-red-dropdown-toggle:hover .toggle-icon {
    color: #fff;
}

.nav-item-elite-red-dropdown.active .toggle-icon {
    transform: rotate(90deg);
}

/* ✅ FIXED DROPDOWN MENU - DISPLAY NONE LOGIC */
.elite-red-inline-dropdown-menu {
    display: none;
    flex-direction: column;
    margin-top: 0;
    margin-left: 15px;
    border-left: 2px solid rgba(255, 123, 115, 0.3);
    padding-left: 10px;
    max-height: 0;
    opacity: 0;
    overflow: hidden;
    transition: max-height 0.5s cubic-bezier(0.4, 0, 0.2, 1),
                opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                margin-top 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    transform-origin: top;
}

.elite-red-inline-dropdown-menu.show {
    display: flex;
    max-height: 500px;
    opacity: 1;
    margin-top: 8px;
}

.elite-red-dropdown-item {
    color: rgba(255, 255, 255, 0.7);
    padding: 10px 15px;
    font-size: 13px;
    font-weight: 400;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    margin-bottom: 3px;
    position: relative;
    overflow: hidden;
    transform: translateX(0);
}

.elite-red-dropdown-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    width: 0;
    height: 0;
    background: rgba(255, 123, 115, 0.2);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.elite-red-dropdown-item:hover::before {
    width: 200%;
    height: 200%;
}

.elite-red-dropdown-item:hover {
    color: #fff;
    background: rgba(255, 123, 115, 0.15);
    transform: translateX(8px);
}

.elite-red-dropdown-item i {
    font-size: 14px;
    color: #ff7b73;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 1;
}

.elite-red-dropdown-item:hover i {
    color: #fff;
    transform: rotate(5deg) scale(1.1);
}

.elite-red-dropdown-item span {
    position: relative;
    z-index: 1;
}

.elite-red-dropdown-item.active {
    background: rgba(255, 123, 115, 0.25);
    color: #fff;
    font-weight: 500;
}

.elite-red-dropdown-item.active i {
    color: #fff;
}

/* Animation when dropdown opens */
.elite-red-inline-dropdown-menu.show .elite-red-dropdown-item {
    animation: slideInFromLeft 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    opacity: 0;
}

.elite-red-inline-dropdown-menu.show .elite-red-dropdown-item:nth-child(1) {
    animation-delay: 0.05s;
}

.elite-red-inline-dropdown-menu.show .elite-red-dropdown-item:nth-child(2) {
    animation-delay: 0.1s;
}

.elite-red-inline-dropdown-menu.show .elite-red-dropdown-item:nth-child(3) {
    animation-delay: 0.15s;
}

.elite-red-inline-dropdown-menu.show .elite-red-dropdown-item:nth-child(4) {
    animation-delay: 0.2s;
}

.elite-red-inline-dropdown-menu.show .elite-red-dropdown-item:nth-child(5) {
    animation-delay: 0.25s;
}

@keyframes slideInFromLeft {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Collapsed States */
.sidebar.collapsed .link-text,
.sidebar.collapsed .elite-red-inline-dropdown-menu,
.sidebar.collapsed .toggle-icon {
    display: none;
}

.sidebar.collapsed .nav-link,
.sidebar.collapsed .elite-red-dropdown-toggle {
    justify-content: center;
    padding: 12px;
}

.sidebar.collapsed .elite-red-dropdown-item {
    padding: 10px;
    justify-content: center;
}

/* === HEADER === */
.navbar-top {
    width: calc(100% - 260px);
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    color: #2c3e50;
    height: 70px;
    position: fixed;
    top: 0;
    left: 260px;
    z-index: 999;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 30px;
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    backdrop-filter: blur(10px);
}

.sidebar.collapsed ~ #mainHeader {
    width: calc(100% - 80px);
    left: 80px;
}

.breadcrumb-section {
    display: flex;
    align-items: center;
    gap: 10px;
}

.breadcrumb-section i {
    color: #e63946;
    font-size: 16px;
}

.breadcrumb-section h5 {
    color: #2c3e50;
    font-weight: 600;
    margin: 0;
    font-size: 18px;
}

/* === HEADER ACTIONS === */
.header-actions {
    display: flex;
    align-items: center;
    gap: 15px;
}

.icon-btn {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: rgba(230, 57, 70, 0.1);
    border: none;
    color: #e63946;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

.icon-btn:hover {
    background: rgba(230, 57, 70, 0.2);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(230, 57, 70, 0.2);
}

.notification-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: linear-gradient(135deg, #ff3c3c, #e63946);
    color: white;
    font-size: 10px;
    font-weight: 600;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid white;
    box-shadow: 0 2px 8px rgba(230, 57, 70, 0.4);
}

/* === PROFILE BUTTON === */
.profile-btn {
    background: rgba(230, 57, 70, 0.08);
    border: 1px solid rgba(230, 57, 70, 0.1);
    border-radius: 12px;
    padding: 8px 15px;
    font-weight: 500;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
}

.profile-btn:hover {
    background: rgba(230, 57, 70, 0.15);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(230, 57, 70, 0.15);
}

.profile-avatar {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #e63946, #ff3c3c);
    color: white;
    font-size: 16px;
    flex-shrink: 0;
    border: 2px solid white;
    box-shadow: 0 2px 8px rgba(230, 57, 70, 0.2);
}

.profile-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-info {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.profile-name {
    font-size: 14px;
    font-weight: 600;
    color: #2c3e50;
    line-height: 1.2;
}

.profile-role {
    font-size: 11px;
    color: #6c757d;
    font-weight: 400;
}

/* === ELITE DROPDOWN === */
.elite-dropdown {
    min-width: 280px;
    border: none;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    padding: 10px;
    margin-top: 10px;
    background: white;
}

.elite-dropdown .dropdown-header {
    padding: 15px;
    background: linear-gradient(135deg, rgba(230, 57, 70, 0.1), rgba(255, 60, 60, 0.05));
    border-radius: 12px;
    margin-bottom: 10px;
}

.profile-avatar-lg {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    overflow: hidden;
    background: linear-gradient(135deg, #e63946, #ff3c3c);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 18px;
    border: 2px solid white;
    box-shadow: 0 4px 12px rgba(230, 57, 70, 0.3);
}

.profile-avatar-lg img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.elite-dropdown .dropdown-item {
    padding: 12px 15px;
    border-radius: 10px;
    transition: all 0.3s ease;
    font-size: 14px;
    color: #2c3e50;
}

.elite-dropdown .dropdown-item:hover {
    background: rgba(230, 57, 70, 0.08);
    transform: translateX(5px);
}

.elite-dropdown .dropdown-item i {
    width: 20px;
    color: #e63946;
}

.elite-dropdown .dropdown-divider {
    margin: 8px 0;
    border-color: rgba(0, 0, 0, 0.05);
}

/* === MAIN CONTENT RESPONSIF === */
.main-content {
    margin-left: 260px;
    margin-top: 70px;
    padding: 30px;
    transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    min-height: calc(100vh - 70px);
}

.main-content.collapsed {
    margin-left: 80px;
}

/* === RESPONSIVE === */
@media (max-width: 768px) {
    .sidebar {
        width: 80px;
    }
    .sidebar .logo-text {
        display: none;
    }
    .navbar-top {
        width: calc(100% - 80px);
        left: 80px;
    }
    .main-content {
        margin-left: 80px;
        padding: 20px;
    }
    .profile-info {
        display: none;
    }
}

@media (max-width: 576px) {
    .breadcrumb-section h5 {
        font-size: 14px;
    }
    .navbar-top {
        padding: 0 15px;
    }
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // ==========================================
    // TOGGLE SIDEBAR (COLLAPSE/EXPAND)
    // ==========================================
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('.main-content');
    
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            if (mainContent) {
                mainContent.classList.toggle('collapsed');
            }
            
            // Close all dropdowns when collapsing sidebar
            if (sidebar.classList.contains('collapsed')) {
                document.querySelectorAll('.nav-item-elite-red-dropdown').forEach(item => {
                    item.classList.remove('active');
                    const menu = item.querySelector('.elite-red-inline-dropdown-menu');
                    if (menu) {
                        menu.classList.remove('show');
                        menu.style.display = 'none'; // ← FIX: Force hide
                    }
                });
            }
        });
    }

    // ==========================================
    // DROPDOWN TOGGLE WITH SMOOTH ANIMATION (FIXED)
    // ==========================================
    const dropdownToggles = document.querySelectorAll('.elite-red-dropdown-toggle');
    
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Don't toggle if sidebar is collapsed
            if (sidebar.classList.contains('collapsed')) {
                return;
            }
            
            const parentItem = this.closest('.nav-item-elite-red-dropdown');
            const dropdownMenu = parentItem.querySelector('.elite-red-inline-dropdown-menu');
            const isActive = parentItem.classList.contains('active');
            
            // Close all other dropdowns with smooth transition
            document.querySelectorAll('.nav-item-elite-red-dropdown').forEach(item => {
                if (item !== parentItem && item.classList.contains('active')) {
                    item.classList.remove('active');
                    const menu = item.querySelector('.elite-red-inline-dropdown-menu');
                    if (menu) {
                        menu.classList.remove('show');
                        // Hide immediately untuk menu lain
                        menu.style.display = 'none';
                    }
                }
            });
            
            // Toggle current dropdown with animation (FIXED LOGIC)
            if (isActive) {
                // Close dropdown - remove class dulu, tunggu animasi, baru hide
                parentItem.classList.remove('active');
                dropdownMenu.classList.remove('show');
                // Tunggu transition selesai (400ms sesuai CSS)
                setTimeout(() => {
                    dropdownMenu.style.display = 'none';
                }, 400);
            } else {
                // Open dropdown - show dulu, terus add class
                dropdownMenu.style.display = 'flex'; // ← FIX: Display flex dulu
                parentItem.classList.add('active');
                
                // Small delay untuk smooth animation
                setTimeout(() => {
                    dropdownMenu.classList.add('show');
                }, 10);
            }
        });
        
        // Add hover effect for better UX
        toggle.addEventListener('mouseenter', function() {
            if (!sidebar.classList.contains('collapsed')) {
                this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            }
        });
    });

    // ==========================================
    // AUTO-OPEN ACTIVE DROPDOWN ON PAGE LOAD
    // ==========================================
    const activeDropdown = document.querySelector('.nav-item-elite-red-dropdown.active');
    if (activeDropdown && !sidebar.classList.contains('collapsed')) {
        const menu = activeDropdown.querySelector('.elite-red-inline-dropdown-menu');
        if (menu) {
            // Set display flex dulu
            menu.style.display = 'flex';
            // Delay untuk ensure smooth initial animation
            setTimeout(() => {
                menu.classList.add('show');
            }, 300);
        }
    }

    // ==========================================
    // SMOOTH HOVER EFFECT FOR NAV LINKS
    // ==========================================
    const navLinks = document.querySelectorAll('.nav-link:not(.elite-red-dropdown-toggle)');
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        });
        
        link.addEventListener('mouseleave', function() {
            this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        });
    });

    // ==========================================
    // DROPDOWN ITEMS ANIMATION
    // ==========================================
    const dropdownItems = document.querySelectorAll('.elite-red-dropdown-item');
    dropdownItems.forEach((item, index) => {
        item.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        });
    });

    // ==========================================
    // PREVENT DROPDOWN CLOSE WHEN CLICKING INSIDE
    // ==========================================
    document.querySelectorAll('.elite-red-inline-dropdown-menu').forEach(menu => {
        menu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });

    // ==========================================
    // CLOSE DROPDOWN WHEN CLICKING OUTSIDE (FIXED)
    // ==========================================
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.nav-item-elite-red-dropdown')) {
            document.querySelectorAll('.nav-item-elite-red-dropdown.active').forEach(item => {
                item.classList.remove('active');
                const menu = item.querySelector('.elite-red-inline-dropdown-menu');
                if (menu) {
                    menu.classList.remove('show');
                    // Tunggu animasi selesai baru hide
                    setTimeout(() => {
                        menu.style.display = 'none';
                    }, 400);
                }
            });
        }
    });

    // ==========================================
    // SMOOTH SCROLL FOR SIDEBAR MENU
    // ==========================================
    const sidebarMenu = document.querySelector('.sidebar-menu');
    if (sidebarMenu) {
        let isScrolling = false;
        
        sidebarMenu.addEventListener('scroll', function() {
            if (!isScrolling) {
                window.requestAnimationFrame(function() {
                    // Add custom scroll behavior here if needed
                    isScrolling = false;
                });
                isScrolling = true;
            }
        });
    }

    // ==========================================
    // LOGO ANIMATION ON HOVER
    // ==========================================
    const logoContainer = document.querySelector('.logo-container');
    if (logoContainer) {
        logoContainer.addEventListener('mouseenter', function() {
            if (!sidebar.classList.contains('collapsed')) {
                this.style.transform = 'scale(1.05) rotate(5deg)';
            }
        });
        
        logoContainer.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
        });
    }

    // ==========================================
    // RESPONSIVE: AUTO-COLLAPSE ON MOBILE
    // ==========================================
    function handleResponsive() {
        if (window.innerWidth <= 768) {
            sidebar.classList.add('collapsed');
            if (mainContent) {
                mainContent.classList.add('collapsed');
            }
        }
    }
    
    // Check on load
    handleResponsive();
    
    // Check on resize with debounce
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            handleResponsive();
        }, 250);
    });

    // ==========================================
    // TOGGLE ICON ANIMATION
    // ==========================================
    const toggleIcons = document.querySelectorAll('.toggle-icon');
    toggleIcons.forEach(icon => {
        const parentDropdown = icon.closest('.nav-item-elite-red-dropdown');
        if (parentDropdown) {
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.attributeName === 'class') {
                        if (parentDropdown.classList.contains('active')) {
                            icon.style.transform = 'rotate(90deg)';
                        } else {
                            icon.style.transform = 'rotate(0deg)';
                        }
                    }
                });
            });
            
            observer.observe(parentDropdown, {
                attributes: true
            });
        }
    });

    // ==========================================
    // DROPDOWN MENU HEIGHT AUTO-ADJUST
    // ==========================================
    function adjustDropdownHeight() {
        document.querySelectorAll('.elite-red-inline-dropdown-menu.show').forEach(menu => {
            const items = menu.querySelectorAll('.elite-red-dropdown-item');
            const totalHeight = Array.from(items).reduce((sum, item) => {
                return sum + item.offsetHeight + 3; // 3px is margin-bottom
            }, 0);
            
            menu.style.maxHeight = (totalHeight + 20) + 'px'; // 20px for padding
        });
    }
    
    // Adjust on dropdown open
    const dropdownObserver = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName === 'class') {
                const target = mutation.target;
                if (target.classList.contains('show')) {
                    setTimeout(adjustDropdownHeight, 100);
                }
            }
        });
    });
    
    document.querySelectorAll('.elite-red-inline-dropdown-menu').forEach(menu => {
        dropdownObserver.observe(menu, {
            attributes: true
        });
    });

    // ==========================================
    // SMOOTH PAGE TRANSITION
    // ==========================================
    document.querySelectorAll('a[href]').forEach(link => {
        // Skip external links and links with target attribute
        if (link.hostname === window.location.hostname && !link.hasAttribute('target')) {
            link.addEventListener('click', function(e) {
                // Add fade out effect before navigation
                const href = this.getAttribute('href');
                if (href && href !== '#' && !href.startsWith('javascript:')) {
                    document.body.style.opacity = '0.8';
                    document.body.style.transition = 'opacity 0.2s ease';
                }
            });
        }
    });

    // ==========================================
    // KEYBOARD NAVIGATION SUPPORT
    // ==========================================
    document.addEventListener('keydown', function(e) {
        // Toggle sidebar with Ctrl + B
        if (e.ctrlKey && e.key === 'b') {
            e.preventDefault();
            if (toggleBtn) {
                toggleBtn.click();
            }
        }
        
        // Close all dropdowns with Escape (FIXED)
        if (e.key === 'Escape') {
            document.querySelectorAll('.nav-item-elite-red-dropdown.active').forEach(item => {
                item.classList.remove('active');
                const menu = item.querySelector('.elite-red-inline-dropdown-menu');
                if (menu) {
                    menu.classList.remove('show');
                    setTimeout(() => {
                        menu.style.display = 'none';
                    }, 400);
                }
            });
        }
    });

    // ==========================================
    // PERFORMANCE: LAZY LOAD DROPDOWN CONTENT
    // ==========================================
    const observerOptions = {
        root: null,
        rootMargin: '50px',
        threshold: 0.1
    };
    
    const dropdownContentObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.visibility = 'visible';
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.elite-red-inline-dropdown-menu').forEach(menu => {
        dropdownContentObserver.observe(menu);
    });

    // ==========================================
    // HIGHLIGHT ACTIVE MENU ON SCROLL (OPTIONAL)
    // ==========================================
    function highlightActiveMenu() {
        const scrollPosition = window.scrollY;
        const windowHeight = window.innerHeight;
        
        // Add glow effect to active menu items
        document.querySelectorAll('.nav-link.active').forEach(link => {
            link.style.boxShadow = '0 4px 15px rgba(255, 123, 115, 0.3)';
        });
    }
    
    // Throttled scroll event
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        if (!scrollTimeout) {
            scrollTimeout = setTimeout(function() {
                highlightActiveMenu();
                scrollTimeout = null;
            }, 100);
        }
    });

    // ==========================================
    // PROFILE DROPDOWN ANIMATION
    // ==========================================
    const profileBtn = document.querySelector('.profile-btn');
    if (profileBtn) {
        profileBtn.addEventListener('click', function() {
            // Add pulse animation to profile avatar
            const avatar = this.querySelector('.profile-avatar');
            if (avatar) {
                avatar.style.animation = 'pulse 0.5s ease';
                setTimeout(() => {
                    avatar.style.animation = '';
                }, 500);
            }
        });
    }

    // ==========================================
    // BREADCRUMB ANIMATION
    // ==========================================
    const breadcrumbSection = document.querySelector('.breadcrumb-section');
    if (breadcrumbSection) {
        breadcrumbSection.style.opacity = '0';
        breadcrumbSection.style.transform = 'translateY(-10px)';
        
        setTimeout(() => {
            breadcrumbSection.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
            breadcrumbSection.style.opacity = '1';
            breadcrumbSection.style.transform = 'translateY(0)';
        }, 200);
    }

    // ==========================================
    // MENU ITEMS STAGGERED ANIMATION ON LOAD
    // ==========================================
    const menuItems = document.querySelectorAll('.sidebar-menu > .nav-link, .sidebar-menu > .nav-item-elite-red-dropdown');
    menuItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateX(-20px)';
        
        setTimeout(() => {
            item.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
            item.style.opacity = '1';
            item.style.transform = 'translateX(0)';
        }, 100 + (index * 50));
    });

    // ==========================================
    // TOOLTIP FOR COLLAPSED SIDEBAR (OPTIONAL)
    // ==========================================
    function showTooltip() {
        if (sidebar.classList.contains('collapsed')) {
            navLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    const text = this.querySelector('.link-text');
                    if (text) {
                        const tooltip = document.createElement('div');
                        tooltip.className = 'sidebar-tooltip';
                        tooltip.textContent = text.textContent;
                        tooltip.style.cssText = `
                            position: fixed;
                            left: 90px;
                            background: #2c3e50;
                            color: white;
                            padding: 8px 12px;
                            border-radius: 8px;
                            font-size: 13px;
                            font-weight: 500;
                            z-index: 10000;
                            pointer-events: none;
                            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
                            white-space: nowrap;
                        `;
                        
                        const rect = this.getBoundingClientRect();
                        tooltip.style.top = rect.top + (rect.height / 2) - 20 + 'px';
                        
                        document.body.appendChild(tooltip);
                        
                        this.addEventListener('mouseleave', function() {
                            tooltip.remove();
                        }, { once: true });
                    }
                });
            });
        }
    }
    
    // Initialize tooltips
    showTooltip();
    
    // Re-initialize tooltips when sidebar is toggled
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            setTimeout(showTooltip, 400);
        });
    }

    // ==========================================
    // CONSOLE LOG: NAVIGATION LOADED
    // ==========================================
    console.log('%c✅ Elite Navigation System Loaded Successfully!', 
        'color: #4CAF50; font-weight: bold; font-size: 14px; padding: 10px; background: #f0f0f0; border-radius: 5px;');
    console.log('%c🎨 Smooth animations and interactions are ready!', 
        'color: #2196F3; font-size: 12px;');
    console.log('%c📊 FIXED: Dropdown display logic now working perfectly!', 
        'color: #FF9800; font-size: 12px;');

});
</script>