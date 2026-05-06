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
                <span class="sb-school-name">SMA KANJENG SEPUH</span>
                <span class="sb-school-tag">Sidayu · Gresik</span>
            </div>
        </div>

        {{-- TOGGLE --}}
        <button class="sb-toggle" id="toggleSidebar" title="Toggle Sidebar (Ctrl+B)">
            <i class="fa-solid fa-bars-staggered"></i>
            <span class="sb-lbl">Sembunyikan Menu</span>
        </button>

        {{-- NAV MENU --}}
        <div class="sb-menu" id="sbMenu">

            <div class="sb-section-label"><span>Utama</span></div>

            <a href="{{ route('dashboard') }}" class="sb-link {{ request()->routeIs('dashboard') ? 'is-active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-gauge-high"></i></span>
                <span class="sb-lbl">Dashboard</span>
            </a>

            {{-- MANAJEMEN USER --}}
            @canany(['view users', 'view roles', 'view permissions'])
            <div class="sb-section-label"><span>Sistem</span></div>
            <div class="sb-drop {{ request()->routeIs('users.*','roles.*','permissions.*') ? 'is-open' : '' }}">
                <button class="sb-link sb-drop-toggle">
                    <span class="sb-icon"><i class="fa-solid fa-users-gear"></i></span>
                    <span class="sb-lbl">Manajemen User</span>
                    <span class="sb-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </button>
                <div class="sb-drop-panel">
                    <div>
                        <a href="{{ route('users.index') }}" class="sb-sub {{ request()->routeIs('users.*') ? 'is-active' : '' }}">
                            <span class="sb-sub-dot"></span><i class="fa-solid fa-user"></i><span>Users</span>
                        </a>
                        <a href="{{ route('roles.index') }}" class="sb-sub {{ request()->routeIs('roles.*') ? 'is-active' : '' }}">
                            <span class="sb-sub-dot"></span><i class="fa-solid fa-user-tag"></i><span>Roles</span>
                        </a>
                        <a href="{{ route('permissions.index') }}" class="sb-sub {{ request()->routeIs('permissions.*') ? 'is-active' : '' }}">
                            <span class="sb-sub-dot"></span><i class="fa-solid fa-key"></i><span>Permissions</span>
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
                            <span class="sb-sub-dot"></span><i class="fa-solid fa-door-open"></i><span>Kelas</span>
                        </a>
                        <a href="{{ route('jurusan.index') }}" class="sb-sub {{ request()->routeIs('jurusan.*') ? 'is-active' : '' }}">
                            <span class="sb-sub-dot"></span><i class="fa-solid fa-graduation-cap"></i><span>Jurusan</span>
                        </a>
                        <a href="{{ route('mapel.index') }}" class="sb-sub {{ request()->routeIs('mapel.*') ? 'is-active' : '' }}">
                            <span class="sb-sub-dot"></span><i class="fa-solid fa-book-open"></i><span>Mata Pelajaran</span>
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
                            <span class="sb-sub-dot"></span><i class="fa-solid fa-user-tie"></i><span>Data Guru</span>
                        </a>
                        <a href="{{ route('pembina.index') }}" class="sb-sub {{ request()->routeIs('pembina.*') ? 'is-active' : '' }}">
                            <span class="sb-sub-dot"></span><i class="fa-solid fa-people-group"></i><span>Data Pembina Ekstra</span>
                        </a>
                        <a href="{{ route('orangtua.index') }}" class="sb-sub {{ request()->routeIs('orangtua.*') ? 'is-active' : '' }}">
                            <span class="sb-sub-dot"></span><i class="fa-solid fa-user-shield"></i><span>Orang Tua</span>
                        </a>
                    </div>
                </div>
            </div>
            @endcanany

            <div class="sb-section-label"><span>Akademik</span></div>

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
            <div class="sb-section-label"><span>Pembelajaran</span></div>
            <div class="sb-drop {{ request()->routeIs('jenis-ujian.*','soal.*','ujian.*') ? 'is-open' : '' }}">
                <button class="sb-link sb-drop-toggle">
                    <span class="sb-icon"><i class="fa-solid fa-book-open-reader"></i></span>
                    <span class="sb-lbl">Materi &amp; Ujian</span>
                    <span class="sb-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </button>
                <div class="sb-drop-panel">
                    <div>
                        <a href="{{ route('jenis-ujian.index') }}" class="sb-sub {{ request()->routeIs('jenis-ujian.*') ? 'is-active' : '' }}">
                            <span class="sb-sub-dot"></span><i class="fa-solid fa-list-check"></i><span>Jenis Ujian</span>
                        </a>
                        <a href="{{ route('soal.index') }}" class="sb-sub {{ request()->routeIs('soal.*') ? 'is-active' : '' }}">
                            <span class="sb-sub-dot"></span><i class="fa-solid fa-circle-question"></i><span>Soal</span>
                        </a>
                        <a href="{{ route('ujian.index') }}" class="sb-sub {{ request()->routeIs('ujian.*') ? 'is-active' : '' }}">
                            <span class="sb-sub-dot"></span><i class="fa-solid fa-file-lines"></i><span>Ujian</span>
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
            <div class="sb-section-label"><span>Ekstrakurikuler</span></div>
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
            <div class="sb-section-label"><span>Kelulusan</span></div>
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
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                @endif
            </div>
            <div class="sb-user-info">
                <span class="sb-user-name">{{ Str::limit(Auth::user()->name, 18) }}</span>
                <span class="sb-user-role">
                    <span class="sb-role-dot"></span>
                    {{ ucfirst(session('active_role') ?? Auth::user()->roles->first()->name ?? 'User') }}
                </span>
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
                <div class="topbar-page-icon">
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
                </div>
                <div class="topbar-page-text">
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
                    <nav class="topbar-breadcrumb" aria-label="breadcrumb">
                        <span>SMA Kanjeng Sepuh</span>
                        <i class="fa-solid fa-chevron-right"></i>
                        <span class="bc-current">{{ request()->routeIs('dashboard') ? 'Dashboard' : 'Menu' }}</span>
                    </nav>
                </div>
            </div>
        </div>

        <div class="topbar-right">
            {{-- Date badge --}}
            <div class="topbar-date">
                <i class="fa-regular fa-calendar-check"></i>
                <span>{{ now()->translatedFormat('d M Y') }}</span>
            </div>

            {{-- Notification bell (placeholder) --}}
            <button class="topbar-icon-btn" title="Notifikasi">
                <i class="fa-regular fa-bell"></i>
                <span class="notif-dot"></span>
            </button>

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
                            <span class="avatar-initial">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
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
                                <span>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            @endif
                        </div>
                        <div class="topbar-dd-info">
                            <p class="topbar-dd-name">{{ Auth::user()->name }}</p>
                            <p class="topbar-dd-email">{{ Auth::user()->email }}</p>
                            <span class="topbar-dd-badge">{{ ucfirst(session('active_role') ?? 'User') }}</span>
                        </div>
                    </div>
                    <div class="topbar-dd-divider"></div>
                    <a href="{{ route('profile.index') }}" class="topbar-dd-item">
                        <span class="dd-item-icon"><i class="fa-regular fa-id-card"></i></span>
                        <span>Profil Saya</span>
                    </a>
                    <div class="topbar-dd-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="topbar-dd-item topbar-dd-logout" type="submit">
                            <span class="dd-item-icon dd-icon-red"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>
</nav>

<style>
/* ============================================
   IMPORTS & BASE RESET
   ============================================ */
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,400;0,500;0,600;1,400&display=swap');

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  /* Core palette — navy blue */
  --n900: #060f22;
  --n800: #0a1628;
  --n700: #0e1e3d;
  --n600: #112554;
  --n500: #163068;
  --n400: #1d4ed8;
  --n300: #3b82f6;
  --n200: #60a5fa;
  --n100: #bfdbfe;
  --n50:  #eff6ff;

  /* Accent */
  --acc:       #3b82f6;
  --acc-soft:  rgba(59,130,246,0.12);
  --acc-glow:  rgba(59,130,246,0.3);
  --acc-border:rgba(59,130,246,0.22);

  /* Text */
  --txt:     rgba(214,228,255,0.82);
  --txt-dim: rgba(140,168,220,0.5);
  --txt-hi:  #e8f0ff;

  /* Sidebar */
  --sb-w:   270px;
  --sb-w-c: 72px;
  --sb-radius: 12px;
}

body {
  font-family: 'DM Sans', sans-serif;
  background: #eef2f9;
  overflow-x: hidden;
}

/* ============================================
   SIDEBAR SHELL
   ============================================ */
.sidebar {
  width: var(--sb-w);
  background: var(--n800);
  position: fixed;
  top: 0; left: 0;
  height: 100vh;
  display: flex;
  flex-direction: column;
  z-index: 1000;
  transition: width 0.32s cubic-bezier(0.4,0,0.2,1);
  overflow: hidden;
  border-right: 1px solid rgba(59,130,246,0.1);
  box-shadow: 4px 0 32px rgba(6,15,34,0.55);
}

/* Layered ambient glows */
.sidebar::before {
  content:'';
  position:absolute;
  top:-80px; left:50%;
  transform:translateX(-50%);
  width:320px; height:320px;
  background:radial-gradient(circle, rgba(59,130,246,0.14) 0%, transparent 70%);
  pointer-events:none;
  z-index:0;
}
.sidebar::after {
  content:'';
  position:absolute;
  bottom: -40px; right: -40px;
  width:200px; height:200px;
  background:radial-gradient(circle, rgba(29,78,216,0.1) 0%, transparent 70%);
  pointer-events:none;
  z-index:0;
}

/* Subtle dot grid */
.sidebar > * { position: relative; z-index: 1; }

.sidebar.is-collapsed { width: var(--sb-w-c); }

/* ============================================
   LOGO AREA
   ============================================ */
.sb-logo {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 22px 16px 18px;
  border-bottom: 1px solid rgba(59,130,246,0.1);
  flex-shrink: 0;
}

.sb-logo-img {
  width: 42px; height: 42px;
  border-radius: 13px;
  background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 100%);
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
  overflow: hidden;
  box-shadow:
    0 0 0 2px rgba(96,165,250,0.35),
    0 4px 20px rgba(59,130,246,0.4);
  transition: box-shadow 0.3s;
}

.sb-logo-img:hover {
  box-shadow: 0 0 0 3px rgba(96,165,250,0.6), 0 6px 24px rgba(59,130,246,0.5);
}

.sb-logo-img img { width:100%; height:100%; object-fit:cover; }
.sb-logo-fallback {
  width:100%; height:100%;
  display:flex; align-items:center; justify-content:center;
  color:#fff; font-size:20px;
}

.sb-logo-text {
  display: flex;
  flex-direction: column;
  overflow: hidden;
  white-space: nowrap;
  transition: opacity 0.22s, width 0.32s;
}

.sidebar.is-collapsed .sb-logo-text { opacity: 0; width: 0; pointer-events: none; }

.sb-school-name {
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 12.5px;
  font-weight: 800;
  color: #fff;
  letter-spacing: 0.07em;
  line-height: 1.2;
}

.sb-school-tag {
  font-size: 10.5px;
  color: var(--txt-dim);
  letter-spacing: 0.04em;
  margin-top: 3px;
  font-weight: 400;
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
  padding: 10px 14px;
  background: rgba(59,130,246,0.07);
  border: 1px solid rgba(59,130,246,0.14);
  border-radius: 10px;
  color: var(--txt);
  font-family: 'DM Sans', sans-serif;
  font-size: 12.5px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s;
  flex-shrink: 0;
  overflow: hidden;
  white-space: nowrap;
}

.sb-toggle i { font-size: 15px; color: var(--n200); flex-shrink: 0; transition: transform 0.35s ease; }
.sb-toggle:hover { background: rgba(59,130,246,0.15); border-color: rgba(59,130,246,0.35); color: #fff; }
.sb-toggle:hover i { transform: rotate(180deg); color: #fff; }

.sidebar.is-collapsed .sb-toggle { justify-content: center; padding: 10px; }
.sidebar.is-collapsed .sb-toggle .sb-lbl { display: none; }

/* ============================================
   MENU SCROLL AREA
   ============================================ */
.sb-menu {
  flex: 1;
  overflow-y: auto;
  overflow-x: hidden;
  padding: 6px 10px 16px;
  scrollbar-width: thin;
  scrollbar-color: rgba(59,130,246,0.3) transparent;
}

.sb-menu::-webkit-scrollbar { width: 4px; }
.sb-menu::-webkit-scrollbar-track { background: transparent; }
.sb-menu::-webkit-scrollbar-thumb { background: rgba(59,130,246,0.25); border-radius: 4px; }
.sb-menu::-webkit-scrollbar-thumb:hover { background: rgba(59,130,246,0.5); }

/* ---- Section labels ---- */
.sb-section-label {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 16px 10px 6px;
  overflow: hidden;
  transition: opacity 0.22s, padding 0.32s;
}

.sb-section-label::after {
  content: '';
  flex: 1;
  height: 1px;
  background: rgba(59,130,246,0.1);
}

.sb-section-label span {
  font-size: 9.5px;
  font-weight: 700;
  letter-spacing: 0.16em;
  text-transform: uppercase;
  color: var(--txt-dim);
  white-space: nowrap;
  flex-shrink: 0;
}

.sidebar.is-collapsed .sb-section-label { opacity: 0; height: 6px; padding: 3px 0; }
.sidebar.is-collapsed .sb-section-label::after { display: none; }

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
  color: var(--txt);
  font-size: 13px;
  font-weight: 500;
  text-decoration: none;
  background: transparent;
  border: none;
  cursor: pointer;
  transition: background 0.18s, color 0.18s, transform 0.15s;
  white-space: nowrap;
  overflow: hidden;
  position: relative;
  margin-bottom: 1px;
  letter-spacing: 0.01em;
}

.sb-link:hover {
  background: rgba(59,130,246,0.1);
  color: var(--txt-hi);
}

.sb-link:hover .sb-icon { background: rgba(59,130,246,0.2); color: var(--n200); }

/* Active state */
.sb-link.is-active {
  background: linear-gradient(90deg, rgba(59,130,246,0.18), rgba(59,130,246,0.06));
  color: #fff;
  font-weight: 600;
}

.sb-link.is-active .sb-icon {
  background: rgba(59,130,246,0.25);
  color: var(--n200);
  box-shadow: 0 0 10px rgba(59,130,246,0.25);
}

/* Active indicator bar */
.sb-link.is-active::before {
  content:'';
  position:absolute;
  left: 0; top: 18%; bottom: 18%;
  width: 3px;
  background: linear-gradient(180deg, var(--n200), var(--acc));
  border-radius: 0 3px 3px 0;
  box-shadow: 0 0 10px rgba(96,165,250,0.7);
}

/* Icon wrap */
.sb-icon {
  width: 32px; height: 32px;
  border-radius: 9px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
  font-size: 13.5px;
  background: rgba(59,130,246,0.07);
  color: var(--txt-dim);
  transition: all 0.18s;
}

/* Label */
.sb-link .sb-lbl {
  flex: 1;
  overflow: hidden;
  text-overflow: ellipsis;
  transition: opacity 0.2s;
}

.sidebar.is-collapsed .sb-link .sb-lbl,
.sidebar.is-collapsed .sb-arrow { opacity: 0; width: 0; pointer-events: none; }

.sidebar.is-collapsed .sb-link { justify-content: center; padding: 10px; }
.sidebar.is-collapsed .sb-icon { margin: 0; }

/* Arrow */
.sb-arrow {
  font-size: 10px;
  color: var(--txt-dim);
  transition: transform 0.25s ease, opacity 0.2s;
  flex-shrink: 0;
}

/* ============================================
   DROPDOWN
   ============================================ */
.sb-drop { margin-bottom: 1px; }

.sb-drop-panel {
  display: grid;
  grid-template-rows: 0fr;
  transition: grid-template-rows 0.3s ease;
  overflow: hidden;
  padding-left: 10px;
  margin-top: 2px;
}

.sb-drop-panel > div { min-height: 0; overflow: hidden; }

.sb-drop.is-open .sb-drop-panel { grid-template-rows: 1fr; }
.sb-drop.is-open .sb-arrow { transform: rotate(180deg); }
.sb-drop.is-open > .sb-link { background: rgba(59,130,246,0.1); color: var(--txt-hi); }
.sb-drop.is-open > .sb-link .sb-icon { background: rgba(59,130,246,0.18); color: var(--n200); }

/* Sub-items */
.sb-sub {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 8px 10px 8px 14px;
  border-radius: 8px;
  color: rgba(148,172,220,0.65);
  font-size: 12.5px;
  font-weight: 400;
  text-decoration: none;
  transition: all 0.18s;
  margin-bottom: 1px;
  position: relative;
  border-left: 1px solid rgba(59,130,246,0.1);
  margin-left: 6px;
}

.sb-sub-dot {
  width: 5px; height: 5px;
  border-radius: 50%;
  background: rgba(96,165,250,0.25);
  flex-shrink: 0;
  transition: all 0.18s;
}

.sb-sub i {
  font-size: 12px;
  color: rgba(148,172,220,0.3);
  width: 16px;
  text-align: center;
  flex-shrink: 0;
  transition: color 0.18s;
}

.sb-sub:hover {
  background: rgba(59,130,246,0.1);
  color: var(--txt-hi);
  padding-left: 18px;
  border-left-color: rgba(59,130,246,0.5);
}

.sb-sub:hover .sb-sub-dot { background: var(--acc); box-shadow: 0 0 6px rgba(59,130,246,0.6); }
.sb-sub:hover i { color: var(--n200); }

.sb-sub.is-active {
  background: rgba(59,130,246,0.13);
  color: #fff;
  border-left-color: var(--acc);
  font-weight: 600;
}

.sb-sub.is-active .sb-sub-dot { background: var(--n200); box-shadow: 0 0 8px rgba(96,165,250,0.7); }
.sb-sub.is-active i { color: var(--n200); }

.sidebar.is-collapsed .sb-drop-panel { display: none; }

/* ============================================
   BOTTOM USER STRIP
   ============================================ */
.sb-user-foot {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 14px;
  border-top: 1px solid rgba(59,130,246,0.1);
  flex-shrink: 0;
  background: rgba(6,15,34,0.5);
  backdrop-filter: blur(8px);
  overflow: hidden;
}

.sb-user-avatar {
  width: 36px; height: 36px;
  border-radius: 10px;
  background: linear-gradient(135deg, #1d4ed8, #3b82f6);
  display: flex; align-items: center; justify-content: center;
  color: #fff;
  font-size: 14px;
  font-weight: 700;
  font-family: 'Plus Jakarta Sans', sans-serif;
  overflow: hidden;
  flex-shrink: 0;
  border: 1.5px solid rgba(96,165,250,0.35);
  box-shadow: 0 0 0 2px rgba(59,130,246,0.15), 0 3px 10px rgba(6,15,34,0.4);
}

.sb-user-avatar img { width:100%; height:100%; object-fit:cover; }

.sb-user-info {
  flex: 1; min-width: 0;
  display: flex; flex-direction: column;
  transition: opacity 0.22s, width 0.32s;
  overflow: hidden; white-space: nowrap;
}

.sidebar.is-collapsed .sb-user-info { opacity: 0; width: 0; }

.sb-user-name {
  font-size: 12.5px;
  font-weight: 600;
  color: var(--txt-hi);
  overflow: hidden;
  text-overflow: ellipsis;
}

.sb-user-role {
  font-size: 10.5px;
  color: var(--txt-dim);
  margin-top: 2px;
  display: flex;
  align-items: center;
  gap: 5px;
}

.sb-role-dot {
  width: 5px; height: 5px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 5px rgba(34,197,94,0.7);
  flex-shrink: 0;
}

.sb-logout {
  width: 32px; height: 32px;
  border-radius: 9px;
  background: rgba(59,130,246,0.08);
  border: 1px solid rgba(59,130,246,0.18);
  color: var(--n200);
  display: flex; align-items: center; justify-content: center;
  cursor: pointer;
  transition: all 0.18s;
  font-size: 13px;
  flex-shrink: 0;
}

.sb-logout:hover {
  background: rgba(239,68,68,0.18);
  border-color: rgba(239,68,68,0.4);
  color: #fca5a5;
  transform: translateX(2px);
}

.sidebar.is-collapsed .sb-logout { margin: 0 auto; }

/* ============================================
   TOPBAR
   ============================================ */
.topbar {
  position: fixed;
  top: 0;
  left: var(--sb-w);
  right: 0;
  height: 62px;
  background: #ffffff;
  border-bottom: 1px solid #dde6f5;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 24px;
  z-index: 999;
  transition: left 0.32s cubic-bezier(0.4,0,0.2,1);
  gap: 16px;
  box-shadow: 0 1px 16px rgba(10,22,60,0.07);
}

.sidebar.is-collapsed ~ .topbar,
.topbar.is-collapsed { left: var(--sb-w-c); }

.topbar-left { display: flex; align-items: center; gap: 16px; }

/* Page info */
.topbar-page { display: flex; align-items: center; gap: 14px; }

.topbar-page-icon {
  width: 40px; height: 40px;
  border-radius: 12px;
  background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
  color: #fff;
  display: flex; align-items: center; justify-content: center;
  font-size: 15px;
  flex-shrink: 0;
  box-shadow: 0 3px 12px rgba(29,78,216,0.25);
}

.topbar-page-text { display: flex; flex-direction: column; }

.topbar-page-name {
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 15px;
  font-weight: 700;
  color: var(--n700);
  line-height: 1.2;
}

.topbar-breadcrumb {
  display: flex;
  align-items: center;
  gap: 5px;
  font-size: 11px;
  color: #8faac8;
  margin-top: 2px;
}

.topbar-breadcrumb i { font-size: 8px; color: #b4c8e0; }
.topbar-breadcrumb .bc-current { color: var(--n400); font-weight: 500; }

/* Right side */
.topbar-right { display: flex; align-items: center; gap: 10px; }

.topbar-date {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 12.5px;
  color: #4a6080;
  font-weight: 500;
  background: #f0f6ff;
  border: 1px solid #dbeafe;
  border-radius: 10px;
  padding: 7px 14px;
  white-space: nowrap;
  transition: all 0.2s;
}

.topbar-date:hover { background: #e0ecff; border-color: #93c5fd; }
.topbar-date i { color: var(--acc); }

/* Icon button */
.topbar-icon-btn {
  width: 38px; height: 38px;
  border-radius: 10px;
  background: #f0f6ff;
  border: 1px solid #dbeafe;
  color: #4a6080;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer;
  transition: all 0.18s;
  font-size: 15px;
  position: relative;
}

.topbar-icon-btn:hover { background: #e0ecff; border-color: #93c5fd; color: var(--n400); }

.notif-dot {
  position: absolute;
  top: 7px; right: 8px;
  width: 7px; height: 7px;
  border-radius: 50%;
  background: #ef4444;
  border: 2px solid #fff;
  box-shadow: 0 0 6px rgba(239,68,68,0.5);
}

/* Profile button */
.topbar-profile { position: relative; }

.topbar-profile-btn {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 5px 14px 5px 5px;
  background: #f0f6ff;
  border: 1px solid #dbeafe;
  border-radius: 12px;
  cursor: pointer;
  transition: all 0.18s;
  font-family: 'DM Sans', sans-serif;
}

.topbar-profile-btn:hover { background: #e0ecff; border-color: #93c5fd; }

.topbar-avatar {
  width: 36px; height: 36px;
  border-radius: 10px;
  background: linear-gradient(135deg, var(--n700), var(--n400));
  display: flex; align-items: center; justify-content: center;
  color: #fff;
  font-size: 15px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-weight: 700;
  overflow: hidden;
  flex-shrink: 0;
  box-shadow: 0 2px 10px rgba(29,78,216,0.28);
}

.topbar-avatar img { width:100%; height:100%; object-fit:cover; }
.avatar-initial { font-size: 14px; font-weight: 800; }

.topbar-profile-info { display: flex; flex-direction: column; align-items: flex-start; }
.topbar-name { font-size: 13px; font-weight: 600; color: var(--n700); line-height: 1.2; }
.topbar-role { font-size: 11px; color: #7c9cbf; margin-top: 1px; }
.topbar-caret { font-size: 10px; color: #93c5fd; transition: transform 0.22s; }
.topbar-profile.is-open .topbar-caret { transform: rotate(180deg); }

/* Dropdown */
.topbar-dropdown {
  position: absolute;
  top: calc(100% + 10px);
  right: 0;
  width: 288px;
  background: #fff;
  border: 1px solid #dde6f5;
  border-radius: 16px;
  box-shadow: 0 16px 48px rgba(10,22,60,0.14);
  padding: 8px;
  opacity: 0;
  transform: translateY(-8px) scale(0.97);
  pointer-events: none;
  transition: all 0.2s cubic-bezier(0.4,0,0.2,1);
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
  padding: 12px 14px;
  background: linear-gradient(135deg, #f0f6ff 0%, #e4efff 100%);
  border-radius: 12px;
  margin-bottom: 6px;
  border: 1px solid #dbeafe;
}

.topbar-dd-avatar {
  width: 44px; height: 44px;
  border-radius: 12px;
  background: linear-gradient(135deg, var(--n700), var(--n400));
  display: flex; align-items: center; justify-content: center;
  color: #fff;
  font-size: 18px;
  font-weight: 700;
  font-family: 'Plus Jakarta Sans', sans-serif;
  overflow: hidden;
  flex-shrink: 0;
  box-shadow: 0 4px 14px rgba(29,78,216,0.35);
}

.topbar-dd-avatar img { width:100%; height:100%; object-fit:cover; }
.topbar-dd-avatar span { font-size: 17px; }

.topbar-dd-info { min-width: 0; }
.topbar-dd-name { font-size: 13.5px; font-weight: 700; color: var(--n700); margin: 0 0 2px; }
.topbar-dd-email { font-size: 11.5px; color: #6a8cb0; margin: 0 0 6px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 168px; }

.topbar-dd-badge {
  display: inline-block;
  padding: 2px 8px;
  background: linear-gradient(90deg, var(--n700), var(--n400));
  color: #fff;
  font-size: 10px;
  font-weight: 700;
  border-radius: 20px;
  letter-spacing: 0.05em;
  font-family: 'Plus Jakarta Sans', sans-serif;
}

.topbar-dd-divider { height: 1px; background: #edf2fb; margin: 5px 0; }

.topbar-dd-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 10px 12px;
  border-radius: 10px;
  font-size: 13px;
  color: #1e3a5f;
  text-decoration: none;
  transition: all 0.16s;
  font-weight: 500;
  width: 100%;
  background: none;
  border: none;
  cursor: pointer;
  font-family: 'DM Sans', sans-serif;
  text-align: left;
}

.dd-item-icon {
  width: 30px; height: 30px;
  border-radius: 8px;
  background: #eff6ff;
  display: flex; align-items: center; justify-content: center;
  font-size: 13px;
  color: var(--acc);
  flex-shrink: 0;
  transition: all 0.16s;
}

.dd-icon-red { background: #fef2f2; color: #ef4444; }

.topbar-dd-item:hover { background: #f0f6ff; color: #1d4ed8; }
.topbar-dd-item:hover .dd-item-icon { background: #dbeafe; }
.topbar-dd-logout { color: #b91c1c; }
.topbar-dd-logout:hover { background: #fef2f2; }
.topbar-dd-logout:hover .dd-icon-red { background: #fee2e2; }

/* ============================================
   MAIN CONTENT OFFSET
   ============================================ */
.main-content {
  margin-left: var(--sb-w);
  margin-top: 62px;
  transition: margin-left 0.32s cubic-bezier(0.4,0,0.2,1);
  min-height: calc(100vh - 62px);
}

.main-content.is-collapsed { margin-left: var(--sb-w-c); }

/* ============================================
   TOOLTIP FOR COLLAPSED
   ============================================ */
.sb-tooltip {
  position: fixed;
  left: 82px;
  background: var(--n700);
  color: #e8f0ff;
  padding: 6px 12px;
  border-radius: 9px;
  font-size: 12.5px;
  font-weight: 500;
  z-index: 9999;
  pointer-events: none;
  box-shadow: 0 6px 20px rgba(6,15,34,0.35);
  white-space: nowrap;
  border: 1px solid rgba(59,130,246,0.2);
  animation: tip-in 0.12s ease;
}

@keyframes tip-in {
  from { opacity: 0; transform: translateX(-6px); }
  to   { opacity: 1; transform: translateX(0); }
}

/* ============================================
   RESPONSIVE
   ============================================ */
@media (max-width: 900px) {
  .sidebar { width: var(--sb-w-c); }
  .main-content { margin-left: var(--sb-w-c); }
  .topbar { left: var(--sb-w-c); }
  .topbar-date { display: none; }
}

@media (max-width: 600px) {
  .topbar-profile-info { display: none; }
  .topbar-caret { display: none; }
  .topbar { padding: 0 14px; }
}

/* ============================================
   ENTRANCE ANIMATION
   ============================================ */
@keyframes sb-slide-in {
  from { opacity: 0; transform: translateX(-8px); }
  to   { opacity: 1; transform: translateX(0); }
}

.sb-link { animation: sb-slide-in 0.2s ease both; }
.sb-link:nth-child(1)  { animation-delay: 0.02s; }
.sb-link:nth-child(2)  { animation-delay: 0.04s; }
.sb-link:nth-child(3)  { animation-delay: 0.06s; }
.sb-link:nth-child(4)  { animation-delay: 0.08s; }
.sb-link:nth-child(5)  { animation-delay: 0.10s; }
.sb-link:nth-child(6)  { animation-delay: 0.12s; }
.sb-link:nth-child(7)  { animation-delay: 0.14s; }
.sb-link:nth-child(8)  { animation-delay: 0.16s; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

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
    mainContent && mainContent.classList.add('is-collapsed');
    const collapsed = sidebar.classList.contains('is-collapsed');
    mainContent && mainContent.classList.toggle('is-collapsed', collapsed);
    localStorage.setItem(COLL_KEY, collapsed ? '1' : '0');
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
  window.addEventListener('resize', () => { clearTimeout(resizeT); resizeT = setTimeout(checkMobile, 180); });

  /* ── TOOLTIP FOR COLLAPSED SIDEBAR ── */
  document.querySelectorAll('.sb-link').forEach(link => {
    const lbl = link.querySelector('.sb-lbl');
    if (!lbl) return;
    link.addEventListener('mouseenter', function () {
      if (!sidebar.classList.contains('is-collapsed')) return;
      const tip = document.createElement('div');
      tip.className = 'sb-tooltip';
      tip.textContent = lbl.textContent.trim();
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