<x-app-layout>
  <div class="dashboard-container">
    <div class="dashboard-wrapper">

      {{-- ==== WELCOME SECTION ==== --}}
      <div class="welcome-card">
        <div class="welcome-bg-pattern"></div>
        <div class="welcome-content">
          <div class="welcome-left">
            <div class="school-badge">
              <i class="fa-solid fa-graduation-cap"></i>
              <span>SMA Kanjeng Sepuh Sidayu</span>
            </div>
            <h2 class="welcome-title">
              Selamat Datang, <span>{{ Auth::user()->name ?? 'User' }}</span>
            </h2>

            @if(session('active_role') === 'superadmin')
              <p class="welcome-text">Dashboard Manajemen Sistem</p>
            @elseif(session('active_role') === 'kepsek')
              <p class="welcome-text">Dashboard Monitoring Kelulusan Siswa</p>
            @elseif(session('active_role') === 'guru')
              <p class="welcome-text">Dashboard Guru — Jadwal Mengajar</p>
            @elseif(session('active_role') === 'siswa')
              <p class="welcome-text">Dashboard Siswa — Jadwal Pelajaran</p>
            @else
              <p class="welcome-text">Sistem Informasi Akademik</p>
            @endif

            <div class="role-badge">
              <i class="fa-solid fa-circle-user"></i>
              <span>Role Aktif:</span>
              <strong>{{ ucfirst(session('active_role')) }}</strong>
            </div>
          </div>
          <div class="welcome-right">
            <div class="welcome-stat-bubble">
              <i class="fa-solid fa-shield-halved"></i>
              <span>Sistem Aman</span>
            </div>
          </div>
        </div>
      </div>

      {{-- ==== MULTI ROLE SELECTOR ==== --}}
      @php
        $roles = Auth::user()->getRoleNames();
      @endphp

      @if($roles->count() > 1)
      <div class="section-card">
        <h3 class="section-title">
          <i class="fa-solid fa-user-gear"></i> Pilih Role Aktif
        </h3>

        <div class="role-select-group">
          @foreach($roles as $role)
            <form method="POST" action="{{ route('set-role') }}">
              @csrf
              <input type="hidden" name="role" value="{{ $role }}">
              <button type="submit" class="role-btn {{ session('active_role') === $role ? 'active' : '' }}">
                @if($role === 'superadmin') <i class="fa-solid fa-crown"></i>
                @elseif($role === 'kepsek') <i class="fa-solid fa-user-tie"></i>
                @elseif($role === 'guru') <i class="fa-solid fa-chalkboard-user"></i>
                @elseif($role === 'siswa') <i class="fa-solid fa-user-graduate"></i>
                @else <i class="fa-solid fa-user"></i>
                @endif
                {{ ucfirst($role) }}
              </button>
            </form>
          @endforeach
        </div>
      </div>
      @endif

      {{-- ==== STATISTIK SUPERADMIN ==== --}}
      @if(session('active_role') === 'superadmin' && isset($superadminData))
      <div class="section-card">
        <h3 class="section-title">
          <i class="fa-solid fa-chart-line"></i> Statistik Sistem
        </h3>

        <div class="stats-grid">
          <div class="stat-card stat-blue">
            <div class="stat-icon-wrap"><i class="fa-solid fa-users"></i></div>
            <div class="stat-details">
              <span class="stat-label">Total User</span>
              <p class="stat-number">{{ number_format($superadminData['totalUsers']) }}</p>
              <span class="stat-sub">Terdaftar</span>
            </div>
            <div class="stat-deco"></div>
          </div>

          <div class="stat-card stat-teal">
            <div class="stat-icon-wrap"><i class="fa-solid fa-user-shield"></i></div>
            <div class="stat-details">
              <span class="stat-label">Total Role</span>
              <p class="stat-number">{{ number_format($superadminData['totalRoles']) }}</p>
              <span class="stat-sub">Aktif</span>
            </div>
            <div class="stat-deco"></div>
          </div>

          <div class="stat-card stat-gold">
            <div class="stat-icon-wrap"><i class="fa-solid fa-key"></i></div>
            <div class="stat-details">
              <span class="stat-label">Total Permission</span>
              <p class="stat-number">{{ number_format($superadminData['totalPermissions']) }}</p>
              <span class="stat-sub">{{ $superadminData['assignedPermissions'] }} Assigned</span>
            </div>
            <div class="stat-deco"></div>
          </div>
        </div>
      </div>

      @if($superadminData['dominantRole'])
      <div class="info-box info-gold">
        <div class="info-content">
          <i class="fa-solid fa-crown"></i>
          <p>
            <strong>Role Dominan:</strong> {{ ucfirst($superadminData['dominantRole']->name) }}
            dengan {{ $superadminData['dominantRole']->total }} user
          </p>
        </div>
      </div>
      @endif

      <div class="section-card">
        <div class="chart-grid">
          <div class="chart-card">
            <h4 class="chart-title"><i class="fa-solid fa-chart-pie"></i> Distribusi User per Role</h4>
            <div class="chart-wrapper"><canvas id="usersPerRoleChart"></canvas></div>
          </div>
          <div class="chart-card">
            <h4 class="chart-title"><i class="fa-solid fa-chart-bar"></i> Permission per Role</h4>
            <div class="chart-wrapper"><canvas id="permissionsPerRoleChart"></canvas></div>
          </div>
        </div>
      </div>

      <div class="section-card">
        <div class="chart-grid">
          <div class="chart-card">
            <h4 class="chart-title"><i class="fa-solid fa-chart-line"></i> Pertumbuhan User (6 Bulan Terakhir)</h4>
            <div class="chart-wrapper"><canvas id="userGrowthChart"></canvas></div>
          </div>
          <div class="chart-card">
            <h4 class="chart-title"><i class="fa-solid fa-ranking-star"></i> Top 5 Role Terpopuler</h4>
            <div class="table-wrapper">
              <table class="data-table">
                <thead>
                  <tr><th>#</th><th>Role Name</th><th>Total Users</th><th>Persentase</th></tr>
                </thead>
                <tbody>
                  @foreach($superadminData['topRoles'] as $index => $role)
                  <tr>
                    <td class="text-center"><span class="rank-badge">{{ $index + 1 }}</span></td>
                    <td><strong>{{ ucfirst($role->name) }}</strong></td>
                    <td class="text-center text-accent">{{ $role->total }}</td>
                    <td class="text-center">
                      <span class="badge badge-blue">{{ round(($role->total / $superadminData['totalUsers']) * 100, 1) }}%</span>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      @endif

      {{-- ==== DASHBOARD KEPSEK ==== --}}
      @if(session('active_role') === 'kepsek' && isset($kelulusanData))

      <div class="section-card">
        <h3 class="section-title"><i class="fa-solid fa-graduation-cap"></i> Statistik Kelulusan</h3>
        <div class="stats-grid stats-3">
          <div class="stat-card stat-teal">
            <div class="stat-icon-wrap"><i class="fa-solid fa-circle-check"></i></div>
            <div class="stat-details">
              <span class="stat-label">Total Lulus</span>
              <p class="stat-number">{{ number_format($kelulusanData['totalLulus']) }}</p>
              <span class="stat-sub">{{ $kelulusanData['persentaseLulus'] }}%</span>
            </div>
            <div class="stat-deco"></div>
          </div>
          <div class="stat-card stat-red">
            <div class="stat-icon-wrap"><i class="fa-solid fa-circle-xmark"></i></div>
            <div class="stat-details">
              <span class="stat-label">Tidak Lulus</span>
              <p class="stat-number">{{ number_format($kelulusanData['totalTidakLulus']) }}</p>
              <span class="stat-sub">{{ 100 - $kelulusanData['persentaseLulus'] }}%</span>
            </div>
            <div class="stat-deco"></div>
          </div>
          <div class="stat-card stat-blue">
            <div class="stat-icon-wrap"><i class="fa-solid fa-users"></i></div>
            <div class="stat-details">
              <span class="stat-label">Total Keseluruhan</span>
              <p class="stat-number">{{ number_format($kelulusanData['totalKeseluruhan']) }}</p>
              <span class="stat-sub">100%</span>
            </div>
            <div class="stat-deco"></div>
          </div>
        </div>
      </div>

      <div class="section-card">
        <div class="chart-grid">
          <div class="chart-card">
            <h4 class="chart-title"><i class="fa-solid fa-chart-pie"></i> Status Kelulusan</h4>
            <div class="chart-wrapper"><canvas id="statusChart"></canvas></div>
          </div>
          <div class="chart-card">
            <h4 class="chart-title"><i class="fa-solid fa-table"></i> Statistik Per Tahun</h4>
            <div class="table-wrapper">
              <table class="data-table">
                <thead>
                  <tr><th>Tahun</th><th>Lulus</th><th>Tidak Lulus</th><th>Persentase</th></tr>
                </thead>
                <tbody>
                  @foreach($kelulusanData['statsPerTahun'] as $stat)
                  <tr>
                    <td class="text-center"><strong>{{ $stat->tahun_lulus }}</strong></td>
                    <td class="text-center text-teal">{{ $stat->lulus }}</td>
                    <td class="text-center text-red">{{ $stat->tidak_lulus }}</td>
                    <td class="text-center">
                      <span class="badge {{ $stat->persentase_lulus >= 75 ? 'badge-teal' : 'badge-yellow' }}">
                        {{ $stat->persentase_lulus }}%
                      </span>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="section-card">
        <div class="chart-grid">
          <div class="chart-card">
            <h4 class="chart-title"><i class="fa-solid fa-chart-line"></i> Tren Kelulusan Per Tahun</h4>
            <div class="chart-wrapper"><canvas id="trenTahunChart"></canvas></div>
          </div>
          <div class="chart-card">
            <h4 class="chart-title"><i class="fa-solid fa-chart-bar"></i> Kelulusan Per Jurusan</h4>
            <div class="chart-wrapper"><canvas id="jurusanChart"></canvas></div>
          </div>
        </div>
      </div>

      <div class="info-box info-blue">
        <div class="info-content">
          <i class="fa-solid fa-circle-info"></i>
          <p>Lihat dashboard kelulusan lengkap dengan filter dan detail lebih lanjut</p>
        </div>
        <a href="{{ route('kelulusan.dashboard') }}" class="btn-primary">
          <i class="fa-solid fa-arrow-up-right-from-square"></i> Dashboard Kelulusan
        </a>
      </div>
      @endif

      {{-- ==== DASHBOARD GURU ==== --}}
      @if(session('active_role') === 'guru' && isset($jadwalData))
      <div class="section-card">
        <h3 class="section-title">
          <i class="fa-solid fa-calendar-days"></i> Jadwal Mengajar Hari Ini
          <span class="title-day-badge">{{ $jadwalData['hariIni'] }}</span>
        </h3>

        @if($jadwalData['jadwalHariIni']->count() > 0)
        <div class="table-wrapper">
          <table class="data-table">
            <thead>
              <tr><th>Jam</th><th>Mata Pelajaran</th><th>Kelas</th><th>Jurusan</th><th>Status</th></tr>
            </thead>
            <tbody>
              @foreach($jadwalData['jadwalHariIni'] as $jadwal)
              @php
                $jamSekarang = now()->format('H:i');
                $isAktif = $jamSekarang >= $jadwal->jam_mulai && $jamSekarang <= $jadwal->jam_selesai;
                $sudahLewat = $jamSekarang > $jadwal->jam_selesai;
              @endphp
              <tr class="{{ $isAktif ? 'row-active' : '' }}">
                <td class="text-center">
                  <div class="time-pill">{{ substr($jadwal->jam_mulai, 0, 5) }} – {{ substr($jadwal->jam_selesai, 0, 5) }}</div>
                </td>
                <td><strong>{{ $jadwal->mapel->nama_mapel ?? '-' }}</strong></td>
                <td>{{ $jadwal->kelas->nama_kelas ?? '-' }}</td>
                <td>{{ $jadwal->kelas->jurusan->nama_jurusan ?? '-' }}</td>
                <td class="text-center">
                  @if($isAktif)
                    <span class="badge badge-live"><i class="fa-solid fa-circle"></i> Berlangsung</span>
                  @elseif($sudahLewat)
                    <span class="badge badge-gray">Selesai</span>
                  @else
                    <span class="badge badge-blue">Akan Datang</span>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="empty-state">
          <i class="fa-solid fa-calendar-xmark"></i>
          <p>Tidak ada jadwal mengajar hari ini</p>
        </div>
        @endif
      </div>

      <div class="section-card">
        <h3 class="section-title"><i class="fa-solid fa-chart-simple"></i> Statistik Jadwal Minggu Ini</h3>
        <div class="stats-grid stats-3">
          <div class="stat-card stat-blue">
            <div class="stat-icon-wrap"><i class="fa-solid fa-calendar-week"></i></div>
            <div class="stat-details">
              <span class="stat-label">Total Jadwal</span>
              <p class="stat-number">{{ $jadwalData['totalJadwalMingguIni'] }}</p>
              <span class="stat-sub">Minggu Ini</span>
            </div>
            <div class="stat-deco"></div>
          </div>
          <div class="stat-card stat-teal">
            <div class="stat-icon-wrap"><i class="fa-solid fa-chalkboard-user"></i></div>
            <div class="stat-details">
              <span class="stat-label">Hari Ini</span>
              <p class="stat-number">{{ $jadwalData['jadwalHariIni']->count() }}</p>
              <span class="stat-sub">Kelas</span>
            </div>
            <div class="stat-deco"></div>
          </div>
          <div class="stat-card stat-gold">
            <div class="stat-icon-wrap"><i class="fa-solid fa-book-open"></i></div>
            <div class="stat-details">
              <span class="stat-label">Mata Pelajaran</span>
              <p class="stat-number">{{ $jadwalData['jadwalHariIni']->unique('mapel_id')->count() }}</p>
              <span class="stat-sub">Hari Ini</span>
            </div>
            <div class="stat-deco"></div>
          </div>
        </div>
      </div>

      <div class="section-card">
        <h4 class="chart-title mb-4"><i class="fa-solid fa-calendar"></i> Jadwal Lengkap Minggu Ini</h4>
        <div class="schedule-week">
          @php $hariUrutan = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; @endphp
          @foreach($hariUrutan as $hari)
            <div class="schedule-day {{ $jadwalData['hariIni'] === $hari ? 'today' : '' }}">
              <div class="day-header">
                <strong>{{ $hari }}</strong>
                <span class="badge-count">{{ isset($jadwalData['jadwalMingguIni'][$hari]) ? $jadwalData['jadwalMingguIni'][$hari]->count() : 0 }}</span>
              </div>
              @if(isset($jadwalData['jadwalMingguIni'][$hari]) && $jadwalData['jadwalMingguIni'][$hari]->count() > 0)
              <div class="day-schedule">
                @foreach($jadwalData['jadwalMingguIni'][$hari] as $jadwal)
                <div class="schedule-item">
                  <div class="schedule-time"><i class="fa-solid fa-clock"></i> {{ substr($jadwal->jam_mulai, 0, 5) }} – {{ substr($jadwal->jam_selesai, 0, 5) }}</div>
                  <div class="schedule-info">
                    <strong>{{ $jadwal->mapel->nama_mapel ?? '-' }}</strong>
                    <span>{{ $jadwal->kelas->nama_kelas ?? '-' }}</span>
                    <span>{{ $jadwal->kelas->jurusan->nama_jurusan ?? '-' }}</span>
                  </div>
                </div>
                @endforeach
              </div>
              @else
              <div class="day-empty"><i class="fa-solid fa-calendar-xmark"></i><span>Tidak ada jadwal</span></div>
              @endif
            </div>
          @endforeach
        </div>
      </div>

      <div class="info-box info-blue">
        <div class="info-content">
          <i class="fa-solid fa-circle-info"></i>
          <p>Lihat jadwal lengkap dengan detail dan kelola jadwal mengajar Anda</p>
        </div>
        <a href="{{ route('jadwal.index') }}" class="btn-primary"><i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Semua Jadwal</a>
      </div>
      @endif

      {{-- ==== DASHBOARD SISWA ==== --}}
      @if(session('active_role') === 'siswa' && isset($jadwalData))
      <div class="section-card">
        <h3 class="section-title">
          <i class="fa-solid fa-book-open-reader"></i> Jadwal Pelajaran Hari Ini
          <span class="title-day-badge">{{ $jadwalData['hariIni'] }}</span>
        </h3>

        <div class="info-box info-teal" style="margin-bottom: 20px;">
          <div class="info-content">
            <i class="fa-solid fa-school"></i>
            <p><strong>Kelas:</strong> {{ $jadwalData['namaKelas'] }}</p>
          </div>
        </div>

        @if($jadwalData['jadwalHariIni']->count() > 0)
        <div class="table-wrapper">
          <table class="data-table">
            <thead>
              <tr><th>Jam</th><th>Mata Pelajaran</th><th>Guru</th><th>Status</th></tr>
            </thead>
            <tbody>
              @foreach($jadwalData['jadwalHariIni'] as $jadwal)
              @php
                $jamSekarang = now()->format('H:i');
                $isAktif = $jamSekarang >= $jadwal->jam_mulai && $jamSekarang <= $jadwal->jam_selesai;
                $sudahLewat = $jamSekarang > $jadwal->jam_selesai;
              @endphp
              <tr class="{{ $isAktif ? 'row-active' : '' }}">
                <td class="text-center">
                  <div class="time-pill">{{ substr($jadwal->jam_mulai, 0, 5) }} – {{ substr($jadwal->jam_selesai, 0, 5) }}</div>
                </td>
                <td><strong>{{ $jadwal->mapel->nama_mapel ?? '-' }}</strong></td>
                <td>{{ $jadwal->guru->user->name ?? '-' }}</td>
                <td class="text-center">
                  @if($isAktif)
                    <span class="badge badge-live"><i class="fa-solid fa-circle"></i> Berlangsung</span>
                  @elseif($sudahLewat)
                    <span class="badge badge-gray">Selesai</span>
                  @else
                    <span class="badge badge-blue">Akan Datang</span>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="empty-state">
          <i class="fa-solid fa-calendar-xmark"></i>
          <p>Tidak ada jadwal pelajaran hari ini</p>
        </div>
        @endif
      </div>

      <div class="section-card">
        <h3 class="section-title"><i class="fa-solid fa-chart-simple"></i> Statistik Jadwal Minggu Ini</h3>
        <div class="stats-grid stats-3">
          <div class="stat-card stat-blue">
            <div class="stat-icon-wrap"><i class="fa-solid fa-calendar-week"></i></div>
            <div class="stat-details">
              <span class="stat-label">Total Pelajaran</span>
              <p class="stat-number">{{ $jadwalData['totalJadwalMingguIni'] }}</p>
              <span class="stat-sub">Minggu Ini</span>
            </div>
            <div class="stat-deco"></div>
          </div>
          <div class="stat-card stat-teal">
            <div class="stat-icon-wrap"><i class="fa-solid fa-book-open"></i></div>
            <div class="stat-details">
              <span class="stat-label">Hari Ini</span>
              <p class="stat-number">{{ $jadwalData['jadwalHariIni']->count() }}</p>
              <span class="stat-sub">Pelajaran</span>
            </div>
            <div class="stat-deco"></div>
          </div>
          <div class="stat-card stat-gold">
            <div class="stat-icon-wrap"><i class="fa-solid fa-chalkboard-teacher"></i></div>
            <div class="stat-details">
              <span class="stat-label">Guru Pengajar</span>
              <p class="stat-number">{{ $jadwalData['jadwalHariIni']->unique('guru_id')->count() }}</p>
              <span class="stat-sub">Hari Ini</span>
            </div>
            <div class="stat-deco"></div>
          </div>
        </div>
      </div>

      <div class="section-card">
        <h4 class="chart-title mb-4"><i class="fa-solid fa-calendar"></i> Jadwal Lengkap Minggu Ini</h4>
        <div class="schedule-week">
          @php $hariUrutan = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; @endphp
          @foreach($hariUrutan as $hari)
            <div class="schedule-day {{ $jadwalData['hariIni'] === $hari ? 'today' : '' }}">
              <div class="day-header">
                <strong>{{ $hari }}</strong>
                <span class="badge-count">{{ isset($jadwalData['jadwalMingguIni'][$hari]) ? $jadwalData['jadwalMingguIni'][$hari]->count() : 0 }}</span>
              </div>
              @if(isset($jadwalData['jadwalMingguIni'][$hari]) && $jadwalData['jadwalMingguIni'][$hari]->count() > 0)
              <div class="day-schedule">
                @foreach($jadwalData['jadwalMingguIni'][$hari] as $jadwal)
                <div class="schedule-item">
                  <div class="schedule-time"><i class="fa-solid fa-clock"></i> {{ substr($jadwal->jam_mulai, 0, 5) }} – {{ substr($jadwal->jam_selesai, 0, 5) }}</div>
                  <div class="schedule-info">
                    <strong>{{ $jadwal->mapel->nama_mapel ?? '-' }}</strong>
                    <span>{{ $jadwal->guru->user->name ?? '-' }}</span>
                  </div>
                </div>
                @endforeach
              </div>
              @else
              <div class="day-empty"><i class="fa-solid fa-calendar-xmark"></i><span>Tidak ada jadwal</span></div>
              @endif
            </div>
          @endforeach
        </div>
      </div>

      <div class="info-box info-blue">
        <div class="info-content">
          <i class="fa-solid fa-circle-info"></i>
          <p>Lihat jadwal lengkap pelajaran untuk kelas {{ $jadwalData['namaKelas'] }}</p>
        </div>
        <a href="{{ route('jadwal.index') }}" class="btn-primary"><i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Semua Jadwal</a>
      </div>
      @endif

    </div>
  </div>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap');

    :root {
      --navy-900: #0a1628;
      --navy-800: #0f1f3d;
      --navy-700: #162447;
      --navy-600: #1a2d5a;
      --navy-500: #1e3a73;
      --blue-500: #3b82f6;
      --blue-400: #60a5fa;
      --blue-300: #93c5fd;
      --blue-100: #dbeafe;
      --teal-500: #0ea5e9;
      --teal-400: #38bdf8;
      --teal-100: #e0f2fe;
      --gold-500: #f59e0b;
      --gold-400: #fbbf24;
      --gold-100: #fef3c7;
      --red-500: #ef4444;
      --red-100: #fee2e2;
      --gray-50: #f8fafc;
      --gray-100: #f1f5f9;
      --gray-200: #e2e8f0;
      --gray-400: #94a3b8;
      --gray-500: #64748b;
      --gray-700: #334155;
      --gray-900: #0f172a;
      --white: #ffffff;
      --radius-sm: 6px;
      --radius-md: 10px;
      --radius-lg: 14px;
      --shadow-sm: 0 1px 3px rgba(10, 22, 40, 0.08);
      --shadow-md: 0 4px 16px rgba(10, 22, 40, 0.12);
      --shadow-lg: 0 8px 32px rgba(10, 22, 40, 0.18);
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: #f0f4f8;
      color: var(--gray-700);
    }

    /* ============== LAYOUT ============== */
    .dashboard-container { padding: 24px; }
    .dashboard-wrapper { max-width: 1400px; margin: 0 auto; }
    .mb-4 { margin-bottom: 16px; }

    /* ============== WELCOME CARD ============== */
    .welcome-card {
      background: linear-gradient(135deg, var(--navy-900) 0%, var(--navy-600) 50%, var(--navy-500) 100%);
      border-radius: var(--radius-lg);
      padding: 36px 40px;
      margin-bottom: 24px;
      box-shadow: var(--shadow-lg);
      position: relative;
      overflow: hidden;
    }

    .welcome-bg-pattern {
      position: absolute;
      inset: 0;
      background-image:
        radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 20% 80%, rgba(14, 165, 233, 0.1) 0%, transparent 50%);
      pointer-events: none;
    }

    .welcome-card::after {
      content: '';
      position: absolute;
      top: -60px; right: -60px;
      width: 220px; height: 220px;
      border-radius: 50%;
      background: rgba(59, 130, 246, 0.08);
      border: 1px solid rgba(59, 130, 246, 0.15);
    }

    .welcome-card::before {
      content: '';
      position: absolute;
      bottom: -40px; right: 80px;
      width: 140px; height: 140px;
      border-radius: 50%;
      background: rgba(14, 165, 233, 0.06);
      border: 1px solid rgba(14, 165, 233, 0.1);
    }

    .welcome-content {
      position: relative;
      z-index: 2;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
    }

    .welcome-left { flex: 1; }

    .school-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 20px;
      padding: 5px 14px;
      font-size: 11px;
      font-weight: 600;
      color: var(--blue-300);
      letter-spacing: 0.4px;
      text-transform: uppercase;
      margin-bottom: 14px;
    }

    .school-badge i { font-size: 12px; color: var(--gold-400); }

    .welcome-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 26px;
      font-weight: 800;
      color: var(--white);
      margin: 0 0 8px 0;
      line-height: 1.2;
    }

    .welcome-title span {
      background: linear-gradient(90deg, var(--blue-400), var(--teal-400));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .welcome-text {
      font-size: 14px;
      color: rgba(255,255,255,0.6);
      margin: 0 0 20px 0;
    }

    .role-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 18px;
      background: rgba(59, 130, 246, 0.2);
      border: 1px solid rgba(59, 130, 246, 0.4);
      border-radius: var(--radius-sm);
      font-size: 13px;
      color: var(--blue-300);
    }

    .role-badge i { color: var(--teal-400); }
    .role-badge strong { color: var(--white); font-weight: 700; }

    .welcome-right { flex-shrink: 0; }

    .welcome-stat-bubble {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 6px;
      background: rgba(255,255,255,0.08);
      border: 1px solid rgba(255,255,255,0.12);
      border-radius: var(--radius-md);
      padding: 20px 24px;
      color: rgba(255,255,255,0.7);
      font-size: 12px;
      font-weight: 600;
    }

    .welcome-stat-bubble i { font-size: 24px; color: var(--teal-400); }

    /* ============== SECTION CARD ============== */
    .section-card {
      background: var(--white);
      border: 1px solid var(--gray-200);
      border-radius: var(--radius-lg);
      padding: 24px;
      margin-bottom: 20px;
      box-shadow: var(--shadow-sm);
    }

    .section-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 15px;
      font-weight: 700;
      color: var(--navy-800);
      margin: 0 0 20px 0;
      display: flex;
      align-items: center;
      gap: 10px;
      padding-bottom: 14px;
      border-bottom: 2px solid var(--gray-100);
    }

    .section-title i {
      width: 32px; height: 32px;
      background: linear-gradient(135deg, var(--navy-800), var(--blue-500));
      color: white;
      border-radius: var(--radius-sm);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      flex-shrink: 0;
    }

    .title-day-badge {
      margin-left: auto;
      padding: 4px 12px;
      background: linear-gradient(135deg, var(--navy-700), var(--blue-500));
      color: white;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.3px;
    }

    /* ============== ROLE SELECT ============== */
    .role-select-group {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .role-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 20px;
      border: 2px solid var(--gray-200);
      border-radius: var(--radius-md);
      background: var(--gray-50);
      color: var(--gray-500);
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 600;
      font-size: 13px;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .role-btn:hover {
      border-color: var(--blue-500);
      background: var(--blue-100);
      color: var(--navy-800);
      transform: translateY(-1px);
      box-shadow: var(--shadow-sm);
    }

    .role-btn.active {
      background: linear-gradient(135deg, var(--navy-800), var(--navy-600));
      color: var(--white);
      border-color: var(--navy-700);
      box-shadow: 0 4px 12px rgba(10, 22, 40, 0.25);
    }

    /* ============== STAT CARDS ============== */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 16px;
    }

    .stats-3 { grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); }

    .stat-card {
      border-radius: var(--radius-md);
      padding: 22px 20px;
      display: flex;
      align-items: center;
      gap: 16px;
      position: relative;
      overflow: hidden;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-card:hover {
      transform: translateY(-3px);
      box-shadow: var(--shadow-md);
    }

    .stat-deco {
      position: absolute;
      top: -20px; right: -20px;
      width: 80px; height: 80px;
      border-radius: 50%;
      opacity: 0.15;
    }

    .stat-blue { background: linear-gradient(135deg, var(--navy-800) 0%, var(--navy-600) 100%); color: white; border: none; }
    .stat-blue .stat-deco { background: var(--blue-400); }
    .stat-teal { background: linear-gradient(135deg, #0369a1 0%, var(--teal-500) 100%); color: white; border: none; }
    .stat-teal .stat-deco { background: var(--teal-400); }
    .stat-gold { background: linear-gradient(135deg, #92400e 0%, var(--gold-500) 100%); color: white; border: none; }
    .stat-gold .stat-deco { background: var(--gold-400); }
    .stat-red { background: linear-gradient(135deg, #991b1b 0%, var(--red-500) 100%); color: white; border: none; }
    .stat-red .stat-deco { background: #fca5a5; }

    .stat-icon-wrap {
      width: 56px; height: 56px;
      border-radius: var(--radius-md);
      background: rgba(255,255,255,0.15);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      flex-shrink: 0;
      position: relative;
      z-index: 1;
    }

    .stat-details { position: relative; z-index: 1; }

    .stat-label {
      display: block;
      font-size: 11px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.6px;
      opacity: 0.75;
      margin-bottom: 4px;
    }

    .stat-number {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 30px;
      font-weight: 800;
      margin: 0 0 2px 0;
      line-height: 1;
    }

    .stat-sub {
      font-size: 12px;
      opacity: 0.65;
    }

    /* ============== CHART GRID ============== */
    .chart-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(420px, 1fr));
      gap: 16px;
    }

    .chart-card {
      background: var(--gray-50);
      border: 1px solid var(--gray-200);
      border-radius: var(--radius-md);
      padding: 20px;
    }

    .chart-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 13px;
      font-weight: 700;
      color: var(--navy-800);
      margin: 0 0 16px 0;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .chart-title i { color: var(--blue-500); }
    .chart-wrapper { height: 280px; position: relative; }

    /* ============== TABLE ============== */
    .table-wrapper { overflow-x: auto; max-height: 380px; overflow-y: auto; }

    .data-table { width: 100%; border-collapse: collapse; font-size: 13px; }

    .data-table thead {
      background: linear-gradient(135deg, var(--navy-900), var(--navy-700));
      position: sticky; top: 0; z-index: 1;
    }

    .data-table th {
      padding: 12px 14px;
      text-align: left;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      color: rgba(255,255,255,0.85);
      font-size: 10px;
      text-transform: uppercase;
      letter-spacing: 0.8px;
    }

    .data-table td {
      padding: 12px 14px;
      border-bottom: 1px solid var(--gray-100);
      color: var(--gray-700);
    }

    .data-table tbody tr:hover { background: var(--gray-50); }

    .data-table tbody tr.row-active {
      background: linear-gradient(90deg, rgba(14, 165, 233, 0.08), transparent);
      border-left: 3px solid var(--teal-500);
    }

    .text-center { text-align: center; }
    .text-accent { color: var(--blue-500); font-weight: 700; }
    .text-teal { color: #0369a1; font-weight: 700; }
    .text-red { color: var(--red-500); font-weight: 700; }

    .rank-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 24px; height: 24px;
      background: var(--navy-800);
      color: white;
      border-radius: 50%;
      font-size: 11px;
      font-weight: 700;
    }

    .time-pill {
      display: inline-block;
      padding: 4px 10px;
      background: var(--navy-800);
      color: white;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 700;
      white-space: nowrap;
    }

    .badge {
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 700;
      display: inline-flex;
      align-items: center;
      gap: 4px;
    }

    .badge-blue { background: var(--blue-100); color: #1e40af; }
    .badge-teal { background: var(--teal-100); color: #0369a1; }
    .badge-yellow { background: var(--gold-100); color: #92400e; }
    .badge-gray { background: var(--gray-100); color: var(--gray-500); }
    .badge-live {
      background: linear-gradient(135deg, #d1fae5, #a7f3d0);
      color: #065f46;
      animation: pulse-dot 1.5s ease-in-out infinite;
    }
    .badge-live i { font-size: 7px; color: #10b981; }

    @keyframes pulse-dot {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.7; }
    }

    /* ============== INFO BOX ============== */
    .info-box {
      background: var(--white);
      border: 1px solid var(--gray-200);
      border-radius: var(--radius-md);
      padding: 16px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      margin-top: 16px;
      border-left: 4px solid var(--blue-500);
    }

    .info-teal { border-left-color: var(--teal-500); }
    .info-gold { border-left-color: var(--gold-500); }

    .info-content {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .info-content i { font-size: 20px; color: var(--blue-500); }
    .info-teal .info-content i { color: var(--teal-500); }
    .info-gold .info-content i { color: var(--gold-500); }

    .info-content p { margin: 0; color: var(--gray-700); font-size: 13px; font-weight: 500; }
    .info-content strong { font-weight: 700; color: var(--gray-900); }

    .btn-primary {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 9px 18px;
      background: linear-gradient(135deg, var(--navy-800), var(--navy-600));
      color: var(--white);
      border-radius: var(--radius-sm);
      text-decoration: none;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 12px;
      transition: all 0.2s ease;
      white-space: nowrap;
      letter-spacing: 0.3px;
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, var(--navy-700), var(--blue-500));
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(10, 22, 40, 0.3);
    }

    /* ============== SCHEDULE WEEK ============== */
    .schedule-week {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 12px;
    }

    .schedule-day {
      background: var(--gray-50);
      border: 1px solid var(--gray-200);
      border-radius: var(--radius-md);
      overflow: hidden;
      transition: box-shadow 0.2s;
    }

    .schedule-day:hover { box-shadow: var(--shadow-sm); }

    .schedule-day.today {
      border-color: var(--blue-500);
      box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.15);
    }

    .day-header {
      padding: 12px 14px;
      background: var(--gray-100);
      border-bottom: 1px solid var(--gray-200);
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 13px;
      font-weight: 700;
      color: var(--navy-800);
    }

    .today .day-header {
      background: linear-gradient(135deg, var(--navy-900), var(--navy-600));
      color: white;
      border-bottom-color: var(--navy-700);
    }

    .badge-count {
      background: rgba(0,0,0,0.1);
      color: inherit;
      padding: 2px 8px;
      border-radius: 10px;
      font-size: 11px;
      font-weight: 700;
    }

    .today .badge-count { background: rgba(255,255,255,0.2); }

    .day-schedule { padding: 10px; }

    .schedule-item {
      background: var(--white);
      border: 1px solid var(--gray-200);
      border-radius: var(--radius-sm);
      padding: 10px 12px;
      margin-bottom: 8px;
      border-left: 3px solid var(--blue-500);
      transition: transform 0.15s;
    }

    .schedule-item:hover { transform: translateX(2px); }
    .schedule-item:last-child { margin-bottom: 0; }

    .schedule-time {
      font-size: 10px;
      color: var(--gray-400);
      margin-bottom: 5px;
      display: flex;
      align-items: center;
      gap: 4px;
      font-weight: 600;
    }

    .schedule-time i { color: var(--blue-500); }

    .schedule-info strong {
      display: block;
      font-size: 12px;
      color: var(--navy-800);
      font-weight: 700;
      margin-bottom: 2px;
    }

    .schedule-info span {
      display: block;
      font-size: 11px;
      color: var(--gray-400);
    }

    .day-empty {
      padding: 28px 14px;
      text-align: center;
      color: var(--gray-400);
    }

    .day-empty i { font-size: 28px; margin-bottom: 6px; display: block; opacity: 0.4; }
    .day-empty span { font-size: 11px; }

    /* ============== EMPTY STATE ============== */
    .empty-state {
      text-align: center;
      padding: 60px 20px;
      color: var(--gray-400);
    }

    .empty-state i { font-size: 56px; margin-bottom: 12px; display: block; opacity: 0.25; }
    .empty-state p { font-size: 14px; margin: 0; }

    /* ============== RESPONSIVE ============== */
    @media (max-width: 1024px) {
      .chart-grid { grid-template-columns: 1fr; }
      .schedule-week { grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); }
    }

    @media (max-width: 768px) {
      .dashboard-container { padding: 14px; }
      .welcome-card { padding: 24px 20px; }
      .welcome-right { display: none; }
      .welcome-title { font-size: 20px; }
      .stats-grid, .stats-3 { grid-template-columns: 1fr; }
      .info-box { flex-direction: column; align-items: flex-start; gap: 10px; }
      .schedule-week { grid-template-columns: 1fr; }
      .chart-grid { grid-template-columns: 1fr; }
    }
  </style>

  {{-- CHART.JS SCRIPTS --}}
  @if(session('active_role') === 'superadmin' && isset($superadminData))
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <script>
    const chartColors = {
      navy:   '#0f1f3d',
      blue:   '#3b82f6',
      teal:   '#0ea5e9',
      gold:   '#f59e0b',
      red:    '#ef4444',
      indigo: '#6366f1',
      violet: '#8b5cf6',
      pink:   '#ec4899',
    };

    Chart.defaults.font.family = "'DM Sans', sans-serif";
    Chart.defaults.color = '#64748b';

    new Chart(document.getElementById('usersPerRoleChart'), {
      type: 'doughnut',
      data: {
        labels: @json($superadminData['roleLabels']),
        datasets: [{
          data: @json($superadminData['roleData']),
          backgroundColor: [chartColors.blue, chartColors.teal, chartColors.gold, chartColors.red, chartColors.indigo],
          borderWidth: 3,
          borderColor: '#fff',
          hoverOffset: 6
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { position: 'bottom', labels: { padding: 16, usePointStyle: true, pointStyle: 'circle' } }
        },
        cutout: '60%'
      }
    });

    new Chart(document.getElementById('permissionsPerRoleChart'), {
      type: 'bar',
      data: {
        labels: @json($superadminData['permissionRoleLabels']),
        datasets: [{
          label: 'Permissions',
          data: @json($superadminData['permissionRoleData']),
          backgroundColor: (ctx) => {
            const g = ctx.chart.ctx.createLinearGradient(0, 0, 0, 260);
            g.addColorStop(0, chartColors.blue);
            g.addColorStop(1, chartColors.teal);
            return g;
          },
          borderRadius: 8
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' } },
          x: { grid: { display: false } }
        }
      }
    });

    new Chart(document.getElementById('userGrowthChart'), {
      type: 'line',
      data: {
        labels: @json($superadminData['monthLabels']),
        datasets: [{
          label: 'New Users',
          data: @json($superadminData['monthData']),
          borderColor: chartColors.teal,
          backgroundColor: 'rgba(14, 165, 233, 0.08)',
          tension: 0.4,
          fill: true,
          borderWidth: 3,
          pointRadius: 5,
          pointBackgroundColor: chartColors.teal,
          pointBorderColor: '#fff',
          pointBorderWidth: 2,
          pointHoverRadius: 7
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom', labels: { usePointStyle: true } } },
        scales: {
          y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' } },
          x: { grid: { display: false } }
        }
      }
    });
  </script>
  @endif

  @if(session('active_role') === 'kepsek' && isset($kelulusanData))
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    Chart.defaults.font.family = "'DM Sans', sans-serif";
    Chart.defaults.color = '#64748b';

    const kColors = { teal: '#0ea5e9', red: '#ef4444', navy: '#0f1f3d', blue: '#3b82f6' };

    const statusCanvas = document.getElementById('statusChart');
    if (statusCanvas) {
      const statusData = @json($kelulusanData['statusData']);
      if (statusData && statusData.some(v => v > 0)) {
        new Chart(statusCanvas, {
          type: 'doughnut',
          data: {
            labels: @json($kelulusanData['statusLabels']),
            datasets: [{
              data: statusData,
              backgroundColor: [kColors.teal, kColors.red],
              borderWidth: 3, borderColor: '#fff', hoverOffset: 6
            }]
          },
          options: {
            responsive: true, maintainAspectRatio: false,
            plugins: {
              legend: { position: 'bottom', labels: { usePointStyle: true, pointStyle: 'circle', padding: 16 } },
              tooltip: {
                callbacks: {
                  label: function(ctx) {
                    const total = ctx.dataset.data.reduce((a,b) => a+b, 0);
                    return ctx.label + ': ' + ctx.parsed + ' (' + ((ctx.parsed/total)*100).toFixed(1) + '%)';
                  }
                }
              }
            },
            cutout: '60%'
          }
        });
      } else {
        statusCanvas.parentElement.innerHTML = '<div class="empty-state"><i class="fa-solid fa-chart-pie"></i><p>Belum ada data kelulusan</p></div>';
      }
    }

    const trenCanvas = document.getElementById('trenTahunChart');
    if (trenCanvas) {
      const tahunLabels = @json($kelulusanData['tahunLabels']);
      if (tahunLabels && tahunLabels.length > 0) {
        new Chart(trenCanvas, {
          type: 'line',
          data: {
            labels: tahunLabels,
            datasets: [
              {
                label: 'Lulus',
                data: @json($kelulusanData['tahunDataLulus']),
                borderColor: kColors.teal,
                backgroundColor: 'rgba(14, 165, 233, 0.08)',
                tension: 0.4, fill: true, borderWidth: 3,
                pointRadius: 5, pointBackgroundColor: kColors.teal,
                pointBorderColor: '#fff', pointBorderWidth: 2
              },
              {
                label: 'Tidak Lulus',
                data: @json($kelulusanData['tahunDataTidakLulus']),
                borderColor: kColors.red,
                backgroundColor: 'rgba(239, 68, 68, 0.06)',
                tension: 0.4, fill: true, borderWidth: 3,
                pointRadius: 5, pointBackgroundColor: kColors.red,
                pointBorderColor: '#fff', pointBorderWidth: 2
              }
            ]
          },
          options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 16 } } },
            scales: {
              y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: 'rgba(0,0,0,0.04)' } },
              x: { grid: { display: false } }
            }
          }
        });
      } else {
        trenCanvas.parentElement.innerHTML = '<div class="empty-state"><i class="fa-solid fa-chart-line"></i><p>Belum ada data per tahun</p></div>';
      }
    }

    const jurusanCanvas = document.getElementById('jurusanChart');
    if (jurusanCanvas) {
      const jurusanLabels = @json($kelulusanData['jurusanLabels']);
      const jurusanDataLulus = @json($kelulusanData['jurusanDataLulus']);
      const jurusanDataTidakLulus = @json($kelulusanData['jurusanDataTidakLulus']);
      if (jurusanLabels && jurusanLabels.length > 0) {
        new Chart(jurusanCanvas, {
          type: 'bar',
          data: {
            labels: jurusanLabels,
            datasets: [
              { label: 'Lulus', data: jurusanDataLulus, backgroundColor: kColors.teal, borderRadius: 6 },
              { label: 'Tidak Lulus', data: jurusanDataTidakLulus, backgroundColor: kColors.red, borderRadius: 6 }
            ]
          },
          options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 16 } } },
            scales: {
              y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: 'rgba(0,0,0,0.04)' } },
              x: { grid: { display: false } }
            }
          }
        });
      } else {
        jurusanCanvas.parentElement.innerHTML = '<div class="empty-state"><i class="fa-solid fa-chart-bar"></i><p>Belum ada data per jurusan</p></div>';
      }
    }
  });
  </script>
  @endif

</x-app-layout>