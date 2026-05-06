<!-- resources/views/layouts/navigation.blade.php -->
<nav>
    <!-- ===== SIDEBAR ===== -->
    <aside class="sidebar" id="sidebar">

        {{-- LOGO --}}
        <div class="sb-logo">
            <div class="sb-logo-img">
                <img src="{{ asset('image/logo-sekolah.png') }}" alt="Logo"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                <div class="sb-logo-fallback" style="display:none;">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
            </div>
            <div class="sb-logo-text">
                <span class="sb-school-name">SMA CAKRAWALA</span>
                <span class="sb-school-tag">Excellence in Education</span>
            </div>
        </div>

        {{-- TOGGLE --}}
        <button class="sb-toggle" id="toggleSidebar" title="Toggle Sidebar (Ctrl+B)">
            <i class="fa-solid fa-bars-staggered"></i>
            <span class="sb-lbl">Sembunyikan Menu</span>
        </button>

        {{-- NAV MENU --}}
        <div class="sb-menu" id="sbMenu">

            <div class="sb-section-label">Utama</div>

            <a href="{{ route('dashboard') }}" class="sb-link {{ request()->routeIs('dashboard') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-gauge-high"></i></span>
                <span class="sb-lbl">Dashboard</span>
            </a>

            {{-- MANAJEMEN USER --}}
            @canany(['view users', 'view roles', 'view permissions'])
            <div class="sb-section-label">Sistem</div>
            <div class="sb-drop {{ request()->routeIs('users.*','roles.*','permissions.*') ? 'is-open' : '' }}">
                <button class="sb-link sb-drop-toggle">
                    <span class="sb-icon"><i class="fa-solid fa-users-gear"></i></span>
                    <span class="sb-lbl">Manajemen User</span>
                    <span class="sb-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </button>
                <div class="sb-drop-panel">
                    <div>
                        <a href="{{ route('users.index') }}" class="sb-sub {{ request()->routeIs('users.*') ? 'is-active' : '' }}">
                            <i class="fa-solid fa-user"></i><span>Users</span>
                        </a>
                        <a href="{{ route('roles.index') }}" class="sb-sub {{ request()->routeIs('roles.*') ? 'is-active' : '' }}">
                            <i class="fa-solid fa-user-tag"></i><span>Roles</span>
                        </a>
                        <a href="{{ route('permissions.index') }}" class="sb-sub {{ request()->routeIs('permissions.*') ? 'is-active' : '' }}">
                            <i class="fa-solid fa-key"></i><span>Permissions</span>
                        </a>
                    </div>
                </div>
            </div>
            @endcanany

            {{-- MANAJEMEN KELAS --}}
            @canany(['view users', 'view roles', 'view permissions'])
            <div class="sb-drop {{ request()->routeIs('kelas.*','jurusan.*','mapel.*') ? 'is-open' : '' }}">
                <button class="sb-link sb-drop-toggle">
                    <span class="sb-icon"><i class="fa-solid fa-building-columns"></i></span>
                    <span class="sb-lbl">Manajemen Kelas</span>
                    <span class="sb-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </button>
                <div class="sb-drop-panel">
                    <div>
                        <a href="{{ route('kelas.index') }}" class="sb-sub {{ request()->routeIs('kelas.*') ? 'is-active' : '' }}">
                            <i class="fa-solid fa-door-open"></i><span>Kelas</span>
                        </a>
                        <a href="{{ route('jurusan.index') }}" class="sb-sub {{ request()->routeIs('jurusan.*') ? 'is-active' : '' }}">
                            <i class="fa-solid fa-graduation-cap"></i><span>Jurusan</span>
                        </a>
                        <a href="{{ route('mapel.index') }}" class="sb-sub {{ request()->routeIs('mapel.*') ? 'is-active' : '' }}">
                            <i class="fa-solid fa-book-open"></i><span>Mata Pelajaran</span>
                        </a>
                    </div>
                </div>
            </div>
            @endcanany

            {{-- MANAJEMEN DATA PENGAJAR --}}
            @canany(['view guru'])
            <div class="sb-drop {{ request()->routeIs('guru.*','pembina.*','orangtua.*') ? 'is-open' : '' }}">
                <button class="sb-link sb-drop-toggle">
                    <span class="sb-icon"><i class="fa-solid fa-chalkboard-user"></i></span>
                    <span class="sb-lbl">Data Pengajar</span>
                    <span class="sb-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </button>
                <div class="sb-drop-panel">
                    <div>
                        <a href="{{ route('guru.index') }}" class="sb-sub {{ request()->routeIs('guru.*') ? 'is-active' : '' }}">
                            <i class="fa-solid fa-user-tie"></i><span>Data Guru</span>
                        </a>
                        <a href="{{ route('pembina.index') }}" class="sb-sub {{ request()->routeIs('pembina.*') ? 'is-active' : '' }}">
                            <i class="fa-solid fa-people-group"></i><span>Data Pembina Ekstra</span>
                        </a>
                        <a href="{{ route('orangtua.index') }}" class="sb-sub {{ request()->routeIs('orangtua.*') ? 'is-active' : '' }}">
                            <i class="fa-solid fa-user-shield"></i><span>Orang Tua</span>
                        </a>
                    </div>
                </div>
            </div>
            @endcanany

            <div class="sb-section-label">Akademik</div>

            @can('view siswa')
            <a href="{{ route('siswa.index') }}" class="sb-link {{ request()->routeIs('siswa.*') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-users"></i></span>
                <span class="sb-lbl">Data Siswa</span>
            </a>
            @endcan

            @can('view walikelas')
            <a href="{{ route('walikelas.index') }}" class="sb-link {{ request()->routeIs('walikelas.*') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-id-card-clip"></i></span>
                <span class="sb-lbl">Wali Kelas</span>
            </a>
            @endcan

            @can('view jadwal')
            <a href="{{ route('jadwal.index') }}" class="sb-link {{ request()->routeIs('jadwal.*') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-calendar-days"></i></span>
                <span class="sb-lbl">Jadwal</span>
            </a>
            @endcan

            @can('view presensisiswa')
            <a href="{{ route('presensi.index') }}" class="sb-link {{ request()->routeIs('presensi.*') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-clipboard-check"></i></span>
                <span class="sb-lbl">Presensi</span>
            </a>
            @endcan

            @can('view perizinan')
            <a href="{{ route('perizinan.index') }}" class="sb-link {{ request()->routeIs('perizinan.*') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-file-circle-check"></i></span>
                <span class="sb-lbl">Perizinan</span>
            </a>
            @endcan

            @can('view tugas')
            <a href="{{ route('tugas.index') }}" class="sb-link {{ request()->routeIs('tugas.*') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-laptop-file"></i></span>
                <span class="sb-lbl">Tugas Online</span>
            </a>
            @endcan

            @can('view catatan_perkembangan')
            <a href="{{ route('catatan_perkembangan.index') }}" class="sb-link {{ request()->routeIs('catatan_perkembangan.*') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-book-bookmark"></i></span>
                <span class="sb-lbl">Catatan Perkembangan</span>
            </a>
            @endcan

            {{-- MATERI PEMBELAJARAN --}}
            @canany('view materi')
            <div class="sb-section-label">Pembelajaran</div>
            <div class="sb-drop {{ request()->routeIs('jenis-ujian.*','soal.*','ujian.*') ? 'is-open' : '' }}">
                <button class="sb-link sb-drop-toggle">
                    <span class="sb-icon"><i class="fa-solid fa-book-open-reader"></i></span>
                    <span class="sb-lbl">Materi & Ujian</span>
                    <span class="sb-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </button>
                <div class="sb-drop-panel">
                    <div>
                        <a href="{{ route('jenis-ujian.index') }}" class="sb-sub {{ request()->routeIs('jenis-ujian.*') ? 'is-active' : '' }}">
                            <i class="fa-solid fa-list-check"></i><span>Jenis Ujian</span>
                        </a>
                        <a href="{{ route('soal.index') }}" class="sb-sub {{ request()->routeIs('soal.*') ? 'is-active' : '' }}">
                            <i class="fa-solid fa-circle-question"></i><span>Soal</span>
                        </a>
                        <a href="{{ route('ujian.index') }}" class="sb-sub {{ request()->routeIs('ujian.*') ? 'is-active' : '' }}">
                            <i class="fa-solid fa-file-lines"></i><span>Ujian</span>
                        </a>
                    </div>
                </div>
            </div>
            @endcanany

            @if(Auth::user()->siswa)
            <a href="{{ route('ujian_siswa.index') }}" class="sb-link {{ request()->routeIs('ujian_siswa.*') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-pen-to-square"></i></span>
                <span class="sb-lbl">Ujian Siswa</span>
            </a>
            @endif

            @if(Auth::user()->guru)
            <a href="{{ route('rekap_nilai.index') }}" class="sb-link {{ request()->routeIs('rekap_nilai.*') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-chart-column"></i></span>
                <span class="sb-lbl">Rekap Nilai</span>
            </a>
            @endif

            @if(Auth::user()->siswa)
            <a href="{{ route('rekap_nilai.siswa') }}" class="sb-link {{ request()->routeIs('rekap_nilai.siswa') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-file-alt"></i></span>
                <span class="sb-lbl">Rekap Nilai Saya</span>
            </a>
            @endif

            @if(session('active_role') === 'siswa' || session('active_role') === 'orangtua')
            <a href="{{ route('rapor.siswa') }}" class="sb-link {{ request()->routeIs('rapor.siswa*') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-file-lines"></i></span>
                <span class="sb-lbl">{{ session('active_role') === 'orangtua' ? 'Rapor Anak' : 'Rapor Saya' }}</span>
            </a>
            @endif

            @if(Auth::user()->walikelas || Auth::user()->roles->contains('name', 'superadmin'))
            <a href="{{ route('rapor.index') }}" class="sb-link {{ request()->routeIs('rapor.index','rapor.create','rapor.show') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-file-pdf"></i></span>
                <span class="sb-lbl">Rapor</span>
            </a>
            @endif

            {{-- EKSKUL & PRESTASI --}}
            @can('view extra')
            <div class="sb-section-label">Ekstrakurikuler</div>
            <a href="{{ route('ekstrakurikulers.index') }}" class="sb-link {{ request()->routeIs('ekstrakurikulers.*') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-futbol"></i></span>
                <span class="sb-lbl">Ekstrakurikuler</span>
            </a>
            <a href="{{ route('presensi_ekstra.index') }}" class="sb-link {{ request()->routeIs('presensi_ekstra.*') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-clipboard-user"></i></span>
                <span class="sb-lbl">Presensi Ekstra</span>
            </a>
            @endcan

            @can('view prestasi')
            <a href="{{ route('prestasi.index') }}" class="sb-link {{ request()->routeIs('prestasi.*') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-trophy"></i></span>
                <span class="sb-lbl">Prestasi</span>
            </a>
            @endcan

            {{-- KELULUSAN --}}
            @php
                $user = Auth::user();
                $canViewKelulusan = false;
                if ($user->siswa && $user->siswa->kelas) {
                    $nk = $user->siswa->kelas->nama_kelas;
                    if (str_contains($nk,'12') || preg_match('/\bXII\b/i',$nk)) $canViewKelulusan = true;
                }
                if ($user->hasAnyRole(['tus','kepsek','superadmin'])) $canViewKelulusan = true;

                $canViewRekomendasi = false;
                if ($user->siswa && $user->siswa->kelas) {
                    $nk = $user->siswa->kelas->nama_kelas;
                    if (str_contains($nk,'10') || preg_match('/\bX\b/i',$nk)) $canViewRekomendasi = true;
                }

                $canViewValidasiJurusan = false;
                if ($user->walikelas && $user->walikelas->kelas) {
                    $nk = $user->walikelas->kelas->nama_kelas;
                    if (str_contains($nk,'10') || preg_match('/\bX\b/i',$nk)) $canViewValidasiJurusan = true;
                }
            @endphp

            @if($canViewKelulusan || $canViewRekomendasi || $canViewValidasiJurusan)
            <div class="sb-section-label">Kelulusan</div>
            @endif

            @can('view aturankelulusan')
            <a href="{{ route('aturan-kelulusan.index') }}" class="sb-link {{ request()->routeIs('aturan-kelulusan.*') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-file-contract"></i></span>
                <span class="sb-lbl">Aturan Kelulusan</span>
            </a>
            @endcan

            @if($canViewValidasiJurusan)
            <a href="{{ route('rekomendasi.daftar') }}" class="sb-link {{ request()->routeIs('rekomendasi.daftar') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-clipboard-check"></i></span>
                <span class="sb-lbl">Validasi Rekomendasi</span>
            </a>
            @endif

            @if($canViewRekomendasi)
            <a href="{{ route('rekomendasi.index') }}" class="sb-link {{ request()->routeIs('rekomendasi.*') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-route"></i></span>
                <span class="sb-lbl">Pengajuan Jurusan</span>
            </a>
            @endif

            @if($canViewKelulusan)
            <a href="{{ route('kelulusan.index') }}" class="sb-link {{ request()->routeIs('kelulusan.*') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-graduation-cap"></i></span>
                <span class="sb-lbl">Kelulusan</span>
            </a>
            @endif

        </div>{{-- /.sb-menu --}}

        {{-- BOTTOM USER BADGE --}}
        <div class="sb-user-foot">
            <div class="sb-user-avatar">
                @if(Auth::user()->guru && Auth::user()->guru->foto_profile)
                    <img src="{{ asset('storage/' . Auth::user()->guru->foto_profile) }}" alt="Avatar">
                @elseif(Auth::user()->siswa && Auth::user()->siswa->foto_profile)
                    <img src="{{ asset('storage/' . Auth::user()->siswa->foto_profile) }}" alt="Avatar">
                @else
                    <i class="fa-solid fa-user"></i>
                @endif
            </div>
            <div class="sb-user-info">
                <span class="sb-user-name">{{ Str::limit(Auth::user()->name, 18) }}</span>
                <span class="sb-user-role">{{ ucfirst(session('active_role') ?? Auth::user()->roles->first()->name ?? 'User') }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button class="sb-logout" type="submit" title="Logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </button>
            </form>
        </div>

    </aside>

    <!-- ===== HEADER ===== -->
    <header class="topbar" id="mainHeader">
        <div class="topbar-left">
            <div class="topbar-page">
                <span class="topbar-page-icon">
                    @if(request()->routeIs('dashboard')) <i class="fa-solid fa-gauge-high"></i>
                    @elseif(request()->routeIs('users.*')) <i class="fa-solid fa-users"></i>
                    @elseif(request()->routeIs('roles.*')) <i class="fa-solid fa-user-tag"></i>
                    @elseif(request()->routeIs('permissions.*')) <i class="fa-solid fa-key"></i>
                    @elseif(request()->routeIs('kelas.*')) <i class="fa-solid fa-door-open"></i>
                    @elseif(request()->routeIs('jurusan.*')) <i class="fa-solid fa-graduation-cap"></i>
                    @elseif(request()->routeIs('mapel.*')) <i class="fa-solid fa-book-open"></i>
                    @elseif(request()->routeIs('siswa.*')) <i class="fa-solid fa-users"></i>
                    @elseif(request()->routeIs('guru.*')) <i class="fa-solid fa-chalkboard-user"></i>
                    @elseif(request()->routeIs('jadwal.*')) <i class="fa-solid fa-calendar-days"></i>
                    @elseif(request()->routeIs('presensi.*')) <i class="fa-solid fa-clipboard-check"></i>
                    @elseif(request()->routeIs('walikelas.*')) <i class="fa-solid fa-id-card-clip"></i>
                    @elseif(request()->routeIs('perizinan.*')) <i class="fa-solid fa-file-circle-check"></i>
                    @else <i class="fa-solid fa-circle-dot"></i>
                    @endif
                </span>
                <div>
                    <span class="topbar-page-name">
                        @if(request()->routeIs('dashboard')) Dashboard
                        @elseif(request()->routeIs('users.*')) Manajemen User
                        @elseif(request()->routeIs('roles.*')) Roles
                        @elseif(request()->routeIs('permissions.*')) Permissions
                        @elseif(request()->routeIs('orangtua.*')) Data Orang Tua
                        @elseif(request()->routeIs('kelas.*')) Manajemen Kelas
                        @elseif(request()->routeIs('jurusan.*')) Jurusan
                        @elseif(request()->routeIs('mapel.*')) Mata Pelajaran
                        @elseif(request()->routeIs('siswa.*')) Data Siswa
                        @elseif(request()->routeIs('guru.*')) Data Guru
                        @elseif(request()->routeIs('jadwal.*')) Jadwal
                        @elseif(request()->routeIs('presensi.*')) Presensi
                        @elseif(request()->routeIs('walikelas.*')) Wali Kelas
                        @elseif(request()->routeIs('perizinan.*')) Perizinan
                        @elseif(request()->routeIs('tugas.*')) Tugas Online
                        @elseif(request()->routeIs('ujian.*')) Ujian
                        @elseif(request()->routeIs('ujian_siswa.*')) Ujian Siswa
                        @elseif(request()->routeIs('rekap_nilai.*')) Rekap Nilai
                        @elseif(request()->routeIs('rapor.*')) Rapor
                        @elseif(request()->routeIs('profile.*')) Profil Saya
                        @elseif(request()->routeIs('kelulusan.*')) Kelulusan
                        @elseif(request()->routeIs('prestasi.*')) Prestasi
                        @else Halaman
                        @endif
                    </span>
                    <span class="topbar-breadcrumb">SMA Cakrawala &rsaquo; {{ request()->routeIs('dashboard') ? 'Dashboard' : 'Menu' }}</span>
                </div>
            </div>
        </div>

        <div class="topbar-right">
            {{-- Date badge --}}
            <div class="topbar-date">
                <i class="fa-regular fa-calendar"></i>
                {{ now()->translatedFormat('d M Y') }}
            </div>

            {{-- Profile dropdown --}}
            <div class="topbar-profile" id="profileDropdown">
                <button class="topbar-profile-btn" id="profileBtn">
                    <div class="topbar-avatar">
                        @if(Auth::user()->guru && Auth::user()->guru->foto_profile)
                            <img src="{{ asset('storage/' . Auth::user()->guru->foto_profile) }}" alt="Profile">
                        @elseif(Auth::user()->siswa && Auth::user()->siswa->foto_profile)
                            <img src="{{ asset('storage/' . Auth::user()->siswa->foto_profile) }}" alt="Profile">
                        @elseif(Auth::user()->superadmin && Auth::user()->superadmin->foto_profile)
                            <img src="{{ asset('storage/' . Auth::user()->superadmin->foto_profile) }}" alt="Profile">
                        @else
                            <i class="fa-solid fa-user"></i>
                        @endif
                    </div>
                    <div class="topbar-profile-info">
                        <span class="topbar-name">{{ Str::limit(Auth::user()->name, 20) }}</span>
                        <span class="topbar-role">{{ ucfirst(Auth::user()->roles->first()->name ?? 'User') }}</span>
                    </div>
                    <i class="fa-solid fa-chevron-down topbar-caret"></i>
                </button>

                <div class="topbar-dropdown" id="profileMenu">
                    <div class="topbar-dd-head">
                        <div class="topbar-dd-avatar">
                            @if(Auth::user()->guru && Auth::user()->guru->foto_profile)
                                <img src="{{ asset('storage/' . Auth::user()->guru->foto_profile) }}" alt="Profile">
                            @elseif(Auth::user()->siswa && Auth::user()->siswa->foto_profile)
                                <img src="{{ asset('storage/' . Auth::user()->siswa->foto_profile) }}" alt="Profile">
                            @else
                                <i class="fa-solid fa-user"></i>
                            @endif
                        </div>
                        <div>
                            <p class="topbar-dd-name">{{ Auth::user()->name }}</p>
                            <p class="topbar-dd-email">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="topbar-dd-divider"></div>
                    <a href="{{ route('profile.index') }}" class="topbar-dd-item">
                        <i class="fa-regular fa-id-card"></i> Profil Saya
                    </a>
                    <div class="topbar-dd-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="topbar-dd-item topbar-dd-logout" type="submit">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>
</nav>

<style>
/* ============================================
   IMPORTS & RESET
   ============================================ */
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Sora:wght@600;700;800&display=swap');

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
  font-family: 'DM Sans', sans-serif;
  background: #eef2f9;
  overflow-x: hidden;
}

/* ============================================
   SIDEBAR SHELL
   ============================================ */
.sidebar {
  --sb-w: 268px;
  --sb-w-c: 72px;

  /* === BLUE THEME PALETTE === */
  --sb-bg:         #0e1e3d;          /* deep navy */
  --sb-bg-mid:     #112554;          /* mid layer */
  --sb-accent:     #3b82f6;          /* vivid blue */
  --sb-accent-2:   #60a5fa;          /* lighter blue */
  --sb-accent-soft: rgba(59,130,246,0.14);
  --sb-glow:       rgba(59,130,246,0.25);
  --sb-text:       rgba(220,230,255,0.78);
  --sb-text-dim:   rgba(148,172,220,0.5);
  --sb-border:     rgba(99,140,220,0.12);

  width: var(--sb-w);
  background: var(--sb-bg);
  position: fixed;
  top: 0; left: 0;
  height: 100vh;
  display: flex;
  flex-direction: column;
  z-index: 1000;
  transition: width 0.3s cubic-bezier(0.4,0,0.2,1);
  overflow: hidden;
  border-right: 1px solid var(--sb-border);
  box-shadow: 4px 0 24px rgba(14,30,61,0.45);
}

/* Ambient blue glow at top */
.sidebar::before {
  content: '';
  position: absolute;
  top: -60px; left: 50%;
  transform: translateX(-50%);
  width: 260px; height: 260px;
  background: radial-gradient(circle, rgba(59,130,246,0.18) 0%, transparent 70%);
  pointer-events: none;
  z-index: 0;
}

/* Subtle grid texture */
.sidebar::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(59,130,246,0.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(59,130,246,0.03) 1px, transparent 1px);
  background-size: 24px 24px;
  pointer-events: none;
  z-index: 0;
}

.sidebar.is-collapsed { width: var(--sb-w-c); }

/* ============================================
   LOGO
   ============================================ */
.sb-logo {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 20px 16px 16px;
  border-bottom: 1px solid var(--sb-border);
  flex-shrink: 0;
  position: relative;
  z-index: 1;
}

.sb-logo-img {
  width: 40px;
  height: 40px;
  border-radius: 11px;
  background: linear-gradient(135deg, #1d4ed8, #3b82f6);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  overflow: hidden;
  box-shadow: 0 0 0 2px rgba(96,165,250,0.4), 0 4px 16px rgba(59,130,246,0.35);
}

.sb-logo-img img { width: 100%; height: 100%; object-fit: cover; }
.sb-logo-fallback {
  width: 100%; height: 100%;
  display: flex; align-items: center; justify-content: center;
  color: #fff; font-size: 20px;
}

.sb-logo-text {
  display: flex;
  flex-direction: column;
  overflow: hidden;
  white-space: nowrap;
  transition: opacity 0.25s, width 0.3s;
}

.sidebar.is-collapsed .sb-logo-text { opacity: 0; width: 0; pointer-events: none; }

.sb-school-name {
  font-family: 'Sora', sans-serif;
  font-size: 13px;
  font-weight: 800;
  color: #fff;
  letter-spacing: 0.06em;
}

.sb-school-tag {
  font-size: 10px;
  font-weight: 500;
  color: var(--sb-text-dim);
  text-transform: uppercase;
  letter-spacing: 0.08em;
  margin-top: 2px;
}

/* ============================================
   TOGGLE BUTTON
   ============================================ */
.sb-toggle {
  display: flex;
  align-items: center;
  gap: 10px;
  width: calc(100% - 24px);
  margin: 10px 12px;
  padding: 9px 12px;
  background: rgba(59,130,246,0.08);
  border: 1px solid rgba(59,130,246,0.18);
  border-radius: 10px;
  color: var(--sb-text);
  font-family: 'DM Sans', sans-serif;
  font-size: 12.5px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s;
  flex-shrink: 0;
  position: relative;
  z-index: 1;
  overflow: hidden;
  white-space: nowrap;
}

.sb-toggle i { font-size: 15px; color: var(--sb-accent-2); flex-shrink: 0; transition: transform 0.3s; }
.sb-toggle:hover { background: rgba(59,130,246,0.16); border-color: rgba(59,130,246,0.4); color: #fff; }
.sb-toggle:hover i { transform: rotate(90deg); }
.sidebar.is-collapsed .sb-toggle { justify-content: center; padding: 9px; }
.sidebar.is-collapsed .sb-toggle .sb-lbl { display: none; }

/* ============================================
   MENU AREA
   ============================================ */
.sb-menu {
  flex: 1;
  overflow-y: auto;
  overflow-x: hidden;
  padding: 6px 10px 10px;
  position: relative;
  z-index: 1;
  scrollbar-width: thin;
  scrollbar-color: rgba(59,130,246,0.4) transparent;
}

.sb-menu::-webkit-scrollbar { width: 4px; }
.sb-menu::-webkit-scrollbar-track { background: transparent; }
.sb-menu::-webkit-scrollbar-thumb { background: rgba(59,130,246,0.35); border-radius: 4px; }

/* Section labels */
.sb-section-label {
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 0.13em;
  text-transform: uppercase;
  color: var(--sb-text-dim);
  padding: 14px 10px 6px;
  white-space: nowrap;
  overflow: hidden;
  transition: opacity 0.25s;
}

.sidebar.is-collapsed .sb-section-label { opacity: 0; height: 4px; padding: 2px 0; }

/* ============================================
   NAV LINKS
   ============================================ */
.sb-link {
  display: flex;
  align-items: center;
  gap: 10px;
  width: 100%;
  padding: 9px 10px;
  border-radius: 10px;
  color: var(--sb-text);
  font-size: 13px;
  font-weight: 500;
  text-decoration: none;
  background: transparent;
  border: none;
  cursor: pointer;
  transition: all 0.18s ease;
  white-space: nowrap;
  overflow: hidden;
  position: relative;
  margin-bottom: 2px;
}

.sb-link:hover {
  background: rgba(59,130,246,0.1);
  color: #e0eaff;
}

.sb-link.is-active {
  background: var(--sb-accent-soft);
  color: #fff;
  font-weight: 600;
  box-shadow: inset 0 0 0 1px rgba(59,130,246,0.2);
}

.sb-link.is-active::before {
  content: '';
  position: absolute;
  left: 0; top: 20%; bottom: 20%;
  width: 3px;
  background: linear-gradient(180deg, #60a5fa, #3b82f6);
  border-radius: 0 3px 3px 0;
  box-shadow: 0 0 8px rgba(96,165,250,0.6);
}

/* Icons */
.sb-icon {
  width: 32px;
  height: 32px;
  border-radius: 9px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  font-size: 14px;
  background: rgba(59,130,246,0.08);
  color: rgba(148,172,220,0.6);
  transition: all 0.18s;
}

.sb-link:hover .sb-icon,
.sb-link.is-active .sb-icon {
  background: rgba(59,130,246,0.22);
  color: #93c5fd;
}

/* Text label */
.sb-link .sb-lbl {
  flex: 1;
  transition: opacity 0.2s;
  overflow: hidden;
  text-overflow: ellipsis;
}

.sidebar.is-collapsed .sb-link .sb-lbl,
.sidebar.is-collapsed .sb-arrow { opacity: 0; width: 0; pointer-events: none; }

.sidebar.is-collapsed .sb-link { justify-content: center; padding: 9px; }
.sidebar.is-collapsed .sb-icon { margin: 0; }

/* Arrow */
.sb-arrow {
  font-size: 11px;
  color: var(--sb-text-dim);
  transition: transform 0.25s, opacity 0.2s;
  flex-shrink: 0;
}

/* ============================================
   DROPDOWN
   ============================================ */
.sb-drop { margin-bottom: 2px; }

.sb-drop-panel {
  display: grid;
  grid-template-rows: 0fr;
  transition: grid-template-rows 0.28s ease;
  overflow: hidden;
  padding-left: 12px;
  margin-top: 2px;
}

.sb-drop-panel > div { min-height: 0; overflow: hidden; }

.sb-drop.is-open .sb-drop-panel { grid-template-rows: 1fr; }
.sb-drop.is-open .sb-arrow { transform: rotate(180deg); }

.sb-drop.is-open > .sb-link {
  background: rgba(59,130,246,0.1);
  color: #e0eaff;
}

.sb-drop.is-open > .sb-link .sb-icon {
  background: rgba(59,130,246,0.2);
  color: #93c5fd;
}

/* Sub-items */
.sb-sub {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 8px 10px;
  border-radius: 8px;
  color: rgba(148,172,220,0.7);
  font-size: 12.5px;
  font-weight: 400;
  text-decoration: none;
  transition: all 0.18s;
  margin-bottom: 1px;
  position: relative;
  border-left: 1px solid rgba(59,130,246,0.12);
  margin-left: 4px;
}

.sb-sub i { font-size: 13px; color: rgba(148,172,220,0.35); width: 16px; text-align: center; flex-shrink: 0; }

.sb-sub:hover {
  background: rgba(59,130,246,0.1);
  color: #e0eaff;
  padding-left: 14px;
  border-left-color: rgba(59,130,246,0.5);
}

.sb-sub:hover i { color: #93c5fd; }

.sb-sub.is-active {
  background: var(--sb-accent-soft);
  color: #fff;
  border-left-color: var(--sb-accent);
  font-weight: 600;
}

.sb-sub.is-active i { color: #93c5fd; }

.sidebar.is-collapsed .sb-drop-panel { display: none; }

/* ============================================
   BOTTOM USER STRIP
   ============================================ */
.sb-user-foot {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 14px;
  border-top: 1px solid var(--sb-border);
  flex-shrink: 0;
  position: relative;
  z-index: 1;
  background: rgba(14,30,61,0.6);
  backdrop-filter: blur(4px);
  overflow: hidden;
}

.sb-user-avatar {
  width: 34px;
  height: 34px;
  border-radius: 9px;
  background: linear-gradient(135deg, #1d4ed8, #3b82f6);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-size: 14px;
  overflow: hidden;
  flex-shrink: 0;
  border: 1.5px solid rgba(96,165,250,0.3);
  box-shadow: 0 0 0 1px rgba(59,130,246,0.15);
}

.sb-user-avatar img { width: 100%; height: 100%; object-fit: cover; }

.sb-user-info {
  flex: 1;
  min-width: 0;
  display: flex;
  flex-direction: column;
  transition: opacity 0.25s, width 0.3s;
  overflow: hidden;
  white-space: nowrap;
}

.sidebar.is-collapsed .sb-user-info { opacity: 0; width: 0; }

.sb-user-name { font-size: 12.5px; font-weight: 600; color: #e0eaff; overflow: hidden; text-overflow: ellipsis; }
.sb-user-role { font-size: 10.5px; color: var(--sb-text-dim); margin-top: 1px; }

.sb-logout {
  width: 30px;
  height: 30px;
  border-radius: 8px;
  background: rgba(59,130,246,0.1);
  border: 1px solid rgba(59,130,246,0.2);
  color: #93c5fd;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.18s;
  font-size: 13px;
  flex-shrink: 0;
}

.sb-logout:hover { background: rgba(239,68,68,0.2); border-color: rgba(239,68,68,0.4); color: #fca5a5; }
.sidebar.is-collapsed .sb-logout { margin: 0 auto; }

/* ============================================
   TOPBAR
   ============================================ */
.topbar {
  position: fixed;
  top: 0;
  left: var(--sb-w, 268px);
  right: 0;
  height: 64px;
  background: #ffffff;
  border-bottom: 1px solid #dde4f0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 24px;
  z-index: 999;
  transition: left 0.3s cubic-bezier(0.4,0,0.2,1);
  gap: 16px;
  box-shadow: 0 1px 12px rgba(14,30,80,0.07);
}

.sidebar.is-collapsed ~ .topbar,
.topbar.is-collapsed { left: 72px; }

.topbar-left { display: flex; align-items: center; gap: 12px; }

.topbar-page {
  display: flex;
  align-items: center;
  gap: 12px;
}

.topbar-page-icon {
  width: 38px;
  height: 38px;
  border-radius: 11px;
  background: linear-gradient(135deg, #eff6ff, #dbeafe);
  color: #2563eb;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 15px;
  border: 1px solid #bfdbfe;
  box-shadow: 0 2px 8px rgba(37,99,235,0.12);
}

.topbar-page-name {
  display: block;
  font-size: 15px;
  font-weight: 700;
  color: #0e1e3d;
  line-height: 1.2;
  font-family: 'Sora', sans-serif;
}

.topbar-breadcrumb {
  display: block;
  font-size: 11px;
  color: #94a3b8;
  margin-top: 2px;
  font-weight: 400;
}

/* Right side */
.topbar-right { display: flex; align-items: center; gap: 12px; }

.topbar-date {
  display: flex;
  align-items: center;
  gap: 7px;
  font-size: 12.5px;
  color: #4b5e80;
  font-weight: 500;
  background: #f0f5ff;
  border: 1px solid #dbeafe;
  border-radius: 9px;
  padding: 7px 12px;
  white-space: nowrap;
}

.topbar-date i { color: #3b82f6; }

/* Profile button */
.topbar-profile { position: relative; }

.topbar-profile-btn {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 6px 14px 6px 6px;
  background: #f0f5ff;
  border: 1px solid #dbeafe;
  border-radius: 11px;
  cursor: pointer;
  transition: all 0.18s;
  font-family: 'DM Sans', sans-serif;
}

.topbar-profile-btn:hover { background: #e0eaff; border-color: #93c5fd; }

.topbar-avatar {
  width: 34px;
  height: 34px;
  border-radius: 9px;
  background: linear-gradient(135deg, #1d4ed8, #3b82f6);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-size: 14px;
  overflow: hidden;
  flex-shrink: 0;
  box-shadow: 0 2px 8px rgba(37,99,235,0.25);
}

.topbar-avatar img { width: 100%; height: 100%; object-fit: cover; }

.topbar-profile-info { display: flex; flex-direction: column; align-items: flex-start; }
.topbar-name { font-size: 13px; font-weight: 600; color: #0e1e3d; line-height: 1.2; }
.topbar-role { font-size: 11px; color: #7c9cbf; }
.topbar-caret { font-size: 11px; color: #93c5fd; transition: transform 0.2s; }
.topbar-profile.is-open .topbar-caret { transform: rotate(180deg); }

/* Dropdown menu */
.topbar-dropdown {
  position: absolute;
  top: calc(100% + 8px);
  right: 0;
  width: 280px;
  background: #fff;
  border: 1px solid #dde4f0;
  border-radius: 14px;
  box-shadow: 0 12px 40px rgba(14,30,80,0.13);
  padding: 8px;
  opacity: 0;
  transform: translateY(-6px) scale(0.97);
  pointer-events: none;
  transition: all 0.18s ease;
  z-index: 1001;
}

.topbar-profile.is-open .topbar-dropdown {
  opacity: 1;
  transform: translateY(0) scale(1);
  pointer-events: all;
}

.topbar-dd-head {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 10px 12px;
  background: linear-gradient(135deg, #eff6ff, #dbeafe);
  border-radius: 10px;
  margin-bottom: 6px;
  border: 1px solid #bfdbfe;
}

.topbar-dd-avatar {
  width: 40px;
  height: 40px;
  border-radius: 10px;
  background: linear-gradient(135deg, #1d4ed8, #3b82f6);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-size: 16px;
  overflow: hidden;
  flex-shrink: 0;
  box-shadow: 0 3px 10px rgba(37,99,235,0.3);
}

.topbar-dd-avatar img { width: 100%; height: 100%; object-fit: cover; }

.topbar-dd-name { font-size: 13.5px; font-weight: 700; color: #0e1e3d; margin: 0 0 2px; }
.topbar-dd-email { font-size: 11.5px; color: #5a7a9e; margin: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 170px; }

.topbar-dd-divider { height: 1px; background: #edf0f7; margin: 4px 0; }

.topbar-dd-item {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 12px;
  border-radius: 8px;
  font-size: 13px;
  color: #1e3a5f;
  text-decoration: none;
  transition: all 0.15s;
  font-weight: 500;
  width: 100%;
  background: none;
  border: none;
  cursor: pointer;
  font-family: 'DM Sans', sans-serif;
  text-align: left;
}

.topbar-dd-item i { font-size: 14px; color: #93c5fd; width: 18px; }
.topbar-dd-item:hover { background: #eff6ff; color: #1d4ed8; }
.topbar-dd-item:hover i { color: #3b82f6; }
.topbar-dd-logout { color: #dc2626; }
.topbar-dd-logout i { color: #fca5a5; }
.topbar-dd-logout:hover { background: #fef2f2; color: #dc2626; }

/* ============================================
   MAIN CONTENT OFFSET
   ============================================ */
.main-content {
  margin-left: 268px;
  margin-top: 64px;
  transition: margin-left 0.3s cubic-bezier(0.4,0,0.2,1);
  min-height: calc(100vh - 64px);
}

.main-content.is-collapsed { margin-left: 72px; }

/* ============================================
   RESPONSIVE
   ============================================ */
@media (max-width: 900px) {
  .sidebar { width: 72px; }
  .main-content { margin-left: 72px; }
  .topbar { left: 72px; }
  .topbar-date { display: none; }
}

@media (max-width: 600px) {
  .topbar-profile-info { display: none; }
  .topbar-caret { display: none; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

  /* ── elements ── */
  const sidebar     = document.getElementById('sidebar');
  const toggleBtn   = document.getElementById('toggleSidebar');
  const topbar      = document.getElementById('mainHeader');
  const mainContent = document.querySelector('.main-content');

  /* ── COLLAPSE STATE ── */
  const COLL_KEY = 'sb_collapsed';
  if (localStorage.getItem(COLL_KEY) === '1') {
    sidebar.classList.add('is-collapsed');
    topbar && topbar.classList.add('is-collapsed');
    mainContent && mainContent.classList.add('is-collapsed');
  }

  toggleBtn && toggleBtn.addEventListener('click', function () {
    sidebar.classList.toggle('is-collapsed');
    topbar && topbar.classList.toggle('is-collapsed');
    mainContent && mainContent.classList.toggle('is-collapsed');
    localStorage.setItem(COLL_KEY, sidebar.classList.contains('is-collapsed') ? '1' : '0');
  });

  /* ── DROPDOWNS ── */
  document.querySelectorAll('.sb-drop-toggle').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      if (sidebar.classList.contains('is-collapsed')) return;
      const drop = this.closest('.sb-drop');
      const isOpen = drop.classList.contains('is-open');

      document.querySelectorAll('.sb-drop.is-open').forEach(d => {
        if (d !== drop) d.classList.remove('is-open');
      });

      drop.classList.toggle('is-open', !isOpen);
    });
  });

  /* ── PROFILE DROPDOWN ── */
  const profileWrap = document.getElementById('profileDropdown');
  const profileBtn  = document.getElementById('profileBtn');

  profileBtn && profileBtn.addEventListener('click', function (e) {
    e.stopPropagation();
    profileWrap.classList.toggle('is-open');
  });

  document.addEventListener('click', function (e) {
    if (profileWrap && !profileWrap.contains(e.target)) {
      profileWrap.classList.remove('is-open');
    }
  });

  /* ── KEYBOARD ── */
  document.addEventListener('keydown', function (e) {
    if ((e.ctrlKey || e.metaKey) && e.key === 'b') {
      e.preventDefault();
      toggleBtn && toggleBtn.click();
    }
    if (e.key === 'Escape') {
      profileWrap && profileWrap.classList.remove('is-open');
    }
  });

  /* ── AUTO-COLLAPSE ON MOBILE ── */
  function checkMobile() {
    if (window.innerWidth <= 900) {
      sidebar.classList.add('is-collapsed');
      topbar && topbar.classList.add('is-collapsed');
      mainContent && mainContent.classList.add('is-collapsed');
    }
  }
  checkMobile();
  let resizeT;
  window.addEventListener('resize', () => { clearTimeout(resizeT); resizeT = setTimeout(checkMobile, 200); });

  /* ── COLLAPSED TOOLTIP ── */
  document.querySelectorAll('.sb-link').forEach(link => {
    const lbl = link.querySelector('.sb-lbl');
    if (!lbl) return;
    link.addEventListener('mouseenter', function () {
      if (!sidebar.classList.contains('is-collapsed')) return;
      let tip = document.createElement('div');
      tip.className = 'sb-tooltip';
      tip.textContent = lbl.textContent.trim();
      tip.style.cssText = 'position:fixed;left:80px;background:#0e1e3d;color:#e0eaff;padding:6px 12px;border-radius:8px;font-size:12.5px;font-weight:500;z-index:9999;pointer-events:none;box-shadow:0 4px 16px rgba(14,30,80,0.3);white-space:nowrap;border:1px solid rgba(59,130,246,0.2);';
      const r = this.getBoundingClientRect();
      tip.style.top = (r.top + r.height / 2 - 14) + 'px';
      document.body.appendChild(tip);
      link._tip = tip;
    });
    link.addEventListener('mouseleave', function () {
      if (link._tip) { link._tip.remove(); link._tip = null; }
    });
  });

});
</script>