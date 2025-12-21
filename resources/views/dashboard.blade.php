<x-app-layout>
  <div class="dashboard-container">
    <div class="dashboard-wrapper">

      {{-- ==== WELCOME SECTION ==== --}}
      <div class="welcome-card">
        <div class="welcome-content">
          <h2 class="welcome-title">
            Selamat Datang, <span>{{ Auth::user()->name ?? 'User' }}</span>
          </h2>

          @if(session('active_role') === 'superadmin')
            <p class="welcome-text">Dashboard Manajemen Sistem</p>
          @elseif(session('active_role') === 'kepsek')
            <p class="welcome-text">Dashboard Monitoring Kelulusan Siswa</p>
          @elseif(session('active_role') === 'guru')
            <p class="welcome-text">Dashboard Guru - Jadwal Mengajar</p>
          @elseif(session('active_role') === 'siswa')
            <p class="welcome-text">Dashboard Siswa - Jadwal Pelajaran</p>
          @else
            <p class="welcome-text">Sistem Informasi Akademik</p>
          @endif

          <div class="role-badge">
            <i class="fa-solid fa-user-circle"></i>
            Role: <strong>{{ ucfirst(session('active_role')) }}</strong>
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
          <i class="fa-solid fa-user-switch"></i> Pilih Role Aktif
        </h3>

        <div class="role-select-group">
          @foreach($roles as $role)
            <form method="POST" action="{{ route('set-role') }}">
              @csrf
              <input type="hidden" name="role" value="{{ $role }}">

              <button type="submit" class="role-btn {{ session('active_role') === $role ? 'active' : '' }}">
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
            <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
            <div class="stat-details">
              <h4>Total User</h4>
              <p class="stat-number">{{ number_format($superadminData['totalUsers']) }}</p>
              <span class="stat-label">Terdaftar</span>
            </div>
          </div>

          <div class="stat-card stat-green">
            <div class="stat-icon"><i class="fa-solid fa-user-shield"></i></div>
            <div class="stat-details">
              <h4>Total Role</h4>
              <p class="stat-number">{{ number_format($superadminData['totalRoles']) }}</p>
              <span class="stat-label">Aktif</span>
            </div>
          </div>

          <div class="stat-card stat-red">
            <div class="stat-icon"><i class="fa-solid fa-key"></i></div>
            <div class="stat-details">
              <h4>Total Permission</h4>
              <p class="stat-number">{{ number_format($superadminData['totalPermissions']) }}</p>
              <span class="stat-label">{{ $superadminData['assignedPermissions'] }} Assigned</span>
            </div>
          </div>
        </div>
      </div>

      {{-- Info Box Role Dominan --}}
      @if($superadminData['dominantRole'])
      <div class="info-box info-green">
        <div class="info-content">
          <i class="fa-solid fa-crown"></i>
          <p>
            <strong>Role Dominan:</strong> {{ ucfirst($superadminData['dominantRole']->name) }} 
            dengan {{ $superadminData['dominantRole']->total }} user
          </p>
        </div>
      </div>
      @endif

      {{-- Grafik Row 1 --}}
      <div class="section-card">
        <div class="chart-grid">
          <div class="chart-card">
            <h4 class="chart-title">
              <i class="fa-solid fa-chart-pie"></i> Distribusi User per Role
            </h4>
            <div class="chart-wrapper">
              <canvas id="usersPerRoleChart"></canvas>
            </div>
          </div>

          <div class="chart-card">
            <h4 class="chart-title">
              <i class="fa-solid fa-chart-bar"></i> Permission per Role
            </h4>
            <div class="chart-wrapper">
              <canvas id="permissionsPerRoleChart"></canvas>
            </div>
          </div>
        </div>
      </div>

      {{-- Grafik Row 2 --}}
      <div class="section-card">
        <div class="chart-grid">
          <div class="chart-card">
            <h4 class="chart-title">
              <i class="fa-solid fa-chart-line"></i> Pertumbuhan User (6 Bulan Terakhir)
            </h4>
            <div class="chart-wrapper">
              <canvas id="userGrowthChart"></canvas>
            </div>
          </div>

          <div class="chart-card">
            <h4 class="chart-title">
              <i class="fa-solid fa-ranking-star"></i> Top 5 Role Terpopuler
            </h4>
            <div class="table-wrapper">
              <table class="data-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Role Name</th>
                    <th>Total Users</th>
                    <th>Persentase</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($superadminData['topRoles'] as $index => $role)
                  <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ ucfirst($role->name) }}</td>
                    <td class="text-center text-green">{{ $role->total }}</td>
                    <td class="text-center">
                      <span class="badge badge-green">
                        {{ round(($role->total / $superadminData['totalUsers']) * 100, 1) }}%
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

      @endif

      {{-- ==== DASHBOARD KEPSEK ==== --}}
      @if(session('active_role') === 'kepsek' && isset($kelulusanData))
      
      <div class="section-card">
        <h3 class="section-title">
          <i class="fa-solid fa-graduation-cap"></i> Statistik Kelulusan
        </h3>

        <div class="stats-grid stats-3">
          <div class="stat-card stat-green">
            <div class="stat-icon"><i class="fa-solid fa-check-circle"></i></div>
            <div class="stat-details">
              <h4>Total Lulus</h4>
              <p class="stat-number">{{ number_format($kelulusanData['totalLulus']) }}</p>
              <span class="stat-label">{{ $kelulusanData['persentaseLulus'] }}%</span>
            </div>
          </div>

          <div class="stat-card stat-red">
            <div class="stat-icon"><i class="fa-solid fa-times-circle"></i></div>
            <div class="stat-details">
              <h4>Tidak Lulus</h4>
              <p class="stat-number">{{ number_format($kelulusanData['totalTidakLulus']) }}</p>
              <span class="stat-label">{{ 100 - $kelulusanData['persentaseLulus'] }}%</span>
            </div>
          </div>

          <div class="stat-card stat-blue">
            <div class="stat-icon"><i class="fa-solid fa-chart-pie"></i></div>
            <div class="stat-details">
              <h4>Total Keseluruhan</h4>
              <p class="stat-number">{{ number_format($kelulusanData['totalKeseluruhan']) }}</p>
              <span class="stat-label">100%</span>
            </div>
          </div>
        </div>
      </div>

      {{-- Grafik Kelulusan --}}
      <div class="section-card">
        <div class="chart-grid">
          <div class="chart-card">
            <h4 class="chart-title">
              <i class="fa-solid fa-chart-pie"></i> Status Kelulusan
            </h4>
            <div class="chart-wrapper">
              <canvas id="statusChart"></canvas>
            </div>
          </div>

          <div class="chart-card">
            <h4 class="chart-title">
              <i class="fa-solid fa-table"></i> Statistik Per Tahun
            </h4>
            <div class="table-wrapper">
              <table class="data-table">
                <thead>
                  <tr>
                    <th>Tahun</th>
                    <th>Lulus</th>
                    <th>Tidak Lulus</th>
                    <th>Persentase</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($kelulusanData['statsPerTahun'] as $stat)
                  <tr>
                    <td class="text-center">{{ $stat->tahun_lulus }}</td>
                    <td class="text-center text-green">{{ $stat->lulus }}</td>
                    <td class="text-center text-red">{{ $stat->tidak_lulus }}</td>
                    <td class="text-center">
                      <span class="badge {{ $stat->persentase_lulus >= 75 ? 'badge-green' : 'badge-yellow' }}">
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
            <h4 class="chart-title">
              <i class="fa-solid fa-chart-line"></i> Tren Kelulusan Per Tahun
            </h4>
            <div class="chart-wrapper">
              <canvas id="trenTahunChart"></canvas>
            </div>
          </div>

          <div class="chart-card">
            <h4 class="chart-title">
              <i class="fa-solid fa-chart-bar"></i> Kelulusan Per Jurusan
            </h4>
            <div class="chart-wrapper">
              <canvas id="jurusanChart"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="info-box info-blue">
        <div class="info-content">
          <i class="fa-solid fa-info-circle"></i>
          <p>Lihat dashboard kelulusan lengkap dengan filter dan detail lebih lanjut</p>
        </div>
        <a href="{{ route('kelulusan.dashboard') }}" class="btn-primary">
          <i class="fa-solid fa-external-link-alt"></i> Dashboard Kelulusan
        </a>
      </div>

      @endif

      {{-- ==== DASHBOARD GURU - JADWAL ==== --}}
      @if(session('active_role') === 'guru' && isset($jadwalData))

      <div class="section-card">
        <h3 class="section-title">
          <i class="fa-solid fa-calendar-days"></i> Jadwal Mengajar Hari Ini ({{ $jadwalData['hariIni'] }})
        </h3>

        @if($jadwalData['jadwalHariIni']->count() > 0)
        <div class="table-wrapper">
          <table class="data-table">
            <thead>
              <tr>
                <th>Jam</th>
                <th>Mata Pelajaran</th>
                <th>Kelas</th>
                <th>jurusan</th>
                <th>Status</th>
              </tr>
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
                  <strong>{{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}</strong>
                </td>
                <td><strong>{{ $jadwal->mapel->nama_mapel ?? '-' }}</strong></td>
                <td>{{ $jadwal->kelas->nama_kelas ?? '-' }}</td>
                <td>{{ $jadwal->kelas->jurusan->nama_jurusan ?? '-' }}</td>
                <td class="text-center">
                  @if($isAktif)
                    <span class="badge badge-green">Sedang Berlangsung</span>
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

      {{-- Statistik Jadwal Minggu Ini --}}
      <div class="section-card">
        <h3 class="section-title">
          <i class="fa-solid fa-chart-simple"></i> Statistik Jadwal Minggu Ini
        </h3>

        <div class="stats-grid stats-3">
          <div class="stat-card stat-blue">
            <div class="stat-icon"><i class="fa-solid fa-calendar-week"></i></div>
            <div class="stat-details">
              <h4>Total Jadwal</h4>
              <p class="stat-number">{{ $jadwalData['totalJadwalMingguIni'] }}</p>
              <span class="stat-label">Minggu Ini</span>
            </div>
          </div>

          <div class="stat-card stat-green">
            <div class="stat-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
            <div class="stat-details">
              <h4>Hari Ini</h4>
              <p class="stat-number">{{ $jadwalData['jadwalHariIni']->count() }}</p>
              <span class="stat-label">Kelas</span>
            </div>
          </div>

          <div class="stat-card stat-red">
            <div class="stat-icon"><i class="fa-solid fa-book"></i></div>
            <div class="stat-details">
              <h4>Mata Pelajaran</h4>
              <p class="stat-number">{{ $jadwalData['jadwalHariIni']->unique('mapel_id')->count() }}</p>
              <span class="stat-label">Hari Ini</span>
            </div>
          </div>
        </div>
      </div>

      {{-- Tabel Jadwal Seminggu --}}
      <div class="section-card">
        <h4 class="chart-title">
          <i class="fa-solid fa-calendar"></i> Jadwal Lengkap Minggu Ini
        </h4>

        <div class="schedule-week">
          @php
            $hariUrutan = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
          @endphp

          @foreach($hariUrutan as $hari)
            <div class="schedule-day">
              <div class="day-header {{ $jadwalData['hariIni'] === $hari ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-day"></i>
                <strong>{{ $hari }}</strong>
                <span class="badge-count">{{ isset($jadwalData['jadwalMingguIni'][$hari]) ? $jadwalData['jadwalMingguIni'][$hari]->count() : 0 }}</span>
              </div>

              @if(isset($jadwalData['jadwalMingguIni'][$hari]) && $jadwalData['jadwalMingguIni'][$hari]->count() > 0)
              <div class="day-schedule">
                @foreach($jadwalData['jadwalMingguIni'][$hari] as $jadwal)
                <div class="schedule-item">
                  <div class="schedule-time">
                    <i class="fa-solid fa-clock"></i>
                    {{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}
                  </div>
                  <div class="schedule-info">
                    <strong>{{ $jadwal->mapel->nama_mapel ?? '-' }}</strong>
                    <span>{{ $jadwal->kelas->nama_kelas ?? '-' }}</span>
                      <span>{{ $jadwal->kelas->jurusan->nama_jurusan ?? '-' }}</span>
                  </div>
                </div>
                @endforeach
              </div>
              @else
              <div class="day-empty">
                <i class="fa-solid fa-calendar-xmark"></i>
                <span>Tidak ada jadwal</span>
              </div>
              @endif
            </div>
          @endforeach
        </div>
      </div>

      <div class="info-box info-blue">
        <div class="info-content">
          <i class="fa-solid fa-info-circle"></i>
          <p>Lihat jadwal lengkap dengan detail dan kelola jadwal mengajar Anda</p>
        </div>
        <a href="{{ route('jadwal.index') }}" class="btn-primary">
          <i class="fa-solid fa-external-link-alt"></i> Lihat Semua Jadwal
        </a>
      </div>

      @endif

      {{-- ==== DASHBOARD SISWA - JADWAL ==== --}}
      @if(session('active_role') === 'siswa' && isset($jadwalData))

      <div class="section-card">
        <h3 class="section-title">
          <i class="fa-solid fa-graduation-cap"></i> Jadwal Pelajaran Hari Ini ({{ $jadwalData['hariIni'] }})
        </h3>

        <div class="info-box info-green" style="margin-bottom: 20px;">
          <div class="info-content">
            <i class="fa-solid fa-school"></i>
            <p><strong>Kelas:</strong> {{ $jadwalData['namaKelas'] }}</p>
          </div>
        </div>

        @if($jadwalData['jadwalHariIni']->count() > 0)
        <div class="table-wrapper">
          <table class="data-table">
            <thead>
              <tr>
                <th>Jam</th>
                <th>Mata Pelajaran</th>
                <th>Guru</th>
                <th>Status</th>
              </tr>
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
                  <strong>{{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}</strong>
                </td>
                <td><strong>{{ $jadwal->mapel->nama_mapel ?? '-' }}</strong></td>
                <td>{{ $jadwal->guru->user->name ?? '-' }}</td>
                <td class="text-center">
                  @if($isAktif)
                    <span class="badge badge-green">Sedang Berlangsung</span>
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

      {{-- Statistik Jadwal Minggu Ini --}}
      <div class="section-card">
        <h3 class="section-title">
          <i class="fa-solid fa-chart-simple"></i> Statistik Jadwal Minggu Ini
        </h3>

        <div class="stats-grid stats-3">
          <div class="stat-card stat-blue">
            <div class="stat-icon"><i class="fa-solid fa-calendar-week"></i></div>
            <div class="stat-details">
              <h4>Total Pelajaran</h4>
              <p class="stat-number">{{ $jadwalData['totalJadwalMingguIni'] }}</p>
              <span class="stat-label">Minggu Ini</span>
            </div>
          </div>

          <div class="stat-card stat-green">
            <div class="stat-icon"><i class="fa-solid fa-book-open"></i></div>
            <div class="stat-details">
              <h4>Hari Ini</h4>
              <p class="stat-number">{{ $jadwalData['jadwalHariIni']->count() }}</p>
              <span class="stat-label">Pelajaran</span>
            </div>
          </div>

          <div class="stat-card stat-red">
            <div class="stat-icon"><i class="fa-solid fa-chalkboard-teacher"></i></div>
            <div class="stat-details">
              <h4>Guru Pengajar</h4>
              <p class="stat-number">{{ $jadwalData['jadwalHariIni']->unique('guru_id')->count() }}</p>
              <span class="stat-label">Hari Ini</span>
            </div>
          </div>
        </div>
      </div>

      {{-- Tabel Jadwal Seminggu --}}
      <div class="section-card">
        <h4 class="chart-title">
          <i class="fa-solid fa-calendar"></i> Jadwal Lengkap Minggu Ini
        </h4>

        <div class="schedule-week">
          @php
            $hariUrutan = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
          @endphp

          @foreach($hariUrutan as $hari)
            <div class="schedule-day">
              <div class="day-header {{ $jadwalData['hariIni'] === $hari ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-day"></i>
                <strong>{{ $hari }}</strong>
                <span class="badge-count">{{ isset($jadwalData['jadwalMingguIni'][$hari]) ? $jadwalData['jadwalMingguIni'][$hari]->count() : 0 }}</span>
              </div>

              @if(isset($jadwalData['jadwalMingguIni'][$hari]) && $jadwalData['jadwalMingguIni'][$hari]->count() > 0)
              <div class="day-schedule">
                @foreach($jadwalData['jadwalMingguIni'][$hari] as $jadwal)
                <div class="schedule-item">
                  <div class="schedule-time">
                    <i class="fa-solid fa-clock"></i>
                    {{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}
                  </div>
                  <div class="schedule-info">
                    <strong>{{ $jadwal->mapel->nama_mapel ?? '-' }}</strong>
                    <span>{{ $jadwal->guru->user->name ?? '-' }}</span>
                  </div>
                </div>
                @endforeach
              </div>
              @else
              <div class="day-empty">
                <i class="fa-solid fa-calendar-xmark"></i>
                <span>Tidak ada jadwal</span>
              </div>
              @endif
            </div>
          @endforeach
        </div>
      </div>

      <div class="info-box info-blue">
        <div class="info-content">
          <i class="fa-solid fa-info-circle"></i>
          <p>Lihat jadwal lengkap pelajaran untuk kelas {{ $jadwalData['namaKelas'] }}</p>
        </div>
        <a href="{{ route('jadwal.index') }}" class="btn-primary">
          <i class="fa-solid fa-external-link-alt"></i> Lihat Semua Jadwal
        </a>
      </div>

      @endif

    </div>
  </div>

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f5f5f5;
    }

    .dashboard-container {
      padding: 20px;
    }

    .dashboard-wrapper {
      max-width: 1400px;
      margin: 0 auto;
    }

    /* ===== WELCOME CARD ===== */
    .welcome-card {
      background: linear-gradient(135deg, #b91c1c 0%, #dc2626 100%);
      border-radius: 8px;
      padding: 30px;
      margin-bottom: 20px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      border: 1px solid #991b1b;
    }

    .welcome-title {
      font-size: 24px;
      font-weight: 700;
      color: #ffffff;
      margin: 0 0 8px 0;
    }

    .welcome-title span {
      color: #fef2f2;
      font-weight: 800;
    }

    .welcome-text {
      font-size: 14px;
      color: #fecaca;
      margin: 0 0 15px 0;
    }

    .role-badge {
      display: inline-block;
      padding: 8px 16px;
      background: rgba(255, 255, 255, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 6px;
      font-size: 13px;
      color: #ffffff;
    }

    .role-badge i {
      margin-right: 6px;
    }

    .role-badge strong {
      font-weight: 700;
    }

    /* ===== SECTION CARD ===== */
    .section-card {
      background: #ffffff;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .section-title {
      font-size: 16px;
      font-weight: 700;
      color: #1f2937;
      margin: 0 0 20px 0;
      display: flex;
      align-items: center;
      gap: 8px;
      padding-bottom: 12px;
      border-bottom: 2px solid #b91c1c;
    }

    .section-title i {
      color: #b91c1c;
    }

    /* ===== ROLE SELECT ===== */
    .role-select-group {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .role-btn {
      padding: 10px 20px;
      border: 2px solid #d1d5db;
      border-radius: 6px;
      background: #f9fafb;
      color: #374151;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.2s;
    }

    .role-btn:hover {
      border-color: #b91c1c;
      background: #fef2f2;
      color: #991b1b;
    }

    .role-btn.active {
      background: #b91c1c;
      color: #ffffff;
      border-color: #b91c1c;
    }

    /* ===== STATS GRID ===== */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 15px;
    }

    .stats-3 {
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }

    .stat-card {
      background: #ffffff;
      border: 2px solid #e5e7eb;
      border-radius: 8px;
      padding: 20px;
      display: flex;
      align-items: center;
      gap: 15px;
      transition: all 0.2s;
    }

    .stat-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .stat-icon {
      width: 60px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      font-size: 28px;
    }

    .stat-blue .stat-icon {
      background: #dbeafe;
      color: #1e40af;
    }

    .stat-green .stat-icon {
      background: #d1fae5;
      color: #065f46;
    }

    .stat-red .stat-icon {
      background: #fee2e2;
      color: #991b1b;
    }

    .stat-details h4 {
      font-size: 13px;
      font-weight: 600;
      color: #6b7280;
      margin: 0 0 5px 0;
    }

    .stat-number {
      font-size: 28px;
      font-weight: 800;
      color: #1f2937;
      margin: 0 0 3px 0;
    }

    .stat-label {
      font-size: 12px;
      color: #9ca3af;
    }

    /* ===== CHART GRID ===== */
    .chart-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
      gap: 15px;
    }

    .chart-card {
      background: #ffffff;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      padding: 20px;
    }

    .chart-title {
      font-size: 14px;
      font-weight: 700;
      color: #1f2937;
      margin: 0 0 15px 0;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .chart-title i {
      color: #b91c1c;
    }

    .chart-wrapper {
      height: 300px;
      position: relative;
    }

    /* ===== TABLE ===== */
    .table-wrapper {
      overflow-x: auto;
      max-height: 400px;
      overflow-y: auto;
    }

    .data-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 13px;
    }

    .data-table thead {
      background: #f9fafb;
      position: sticky;
      top: 0;
      z-index: 1;
    }

    .data-table th {
      padding: 12px 10px;
      text-align: left;
      font-weight: 700;
      color: #374151;
      border-bottom: 2px solid #e5e7eb;
      text-transform: uppercase;
      font-size: 11px;
      letter-spacing: 0.5px;
    }

    .data-table td {
      padding: 12px 10px;
      border-bottom: 1px solid #f3f4f6;
      color: #4b5563;
    }

    .data-table tbody tr:hover {
      background: #f9fafb;
    }

    .data-table tbody tr.row-active {
      background: #fef3c7;
      border-left: 3px solid #f59e0b;
    }

    .text-center {
      text-align: center;
    }

    .text-green {
      color: #059669;
      font-weight: 700;
    }

    .text-red {
      color: #dc2626;
      font-weight: 700;
    }

    .badge {
      padding: 4px 10px;
      border-radius: 12px;
      font-size: 11px;
      font-weight: 600;
      display: inline-block;
    }

    .badge-green {
      background: #d1fae5;
      color: #065f46;
    }

    .badge-yellow {
      background: #fef3c7;
      color: #92400e;
    }

    .badge-blue {
      background: #dbeafe;
      color: #1e40af;
    }

    .badge-gray {
      background: #f3f4f6;
      color: #6b7280;
    }

    /* ===== INFO BOX ===== */
    .info-box {
      background: #ffffff;
      border: 1px solid #e5e7eb;
      border-left: 4px solid #b91c1c;
      border-radius: 8px;
      padding: 16px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: 20px;
    }

    .info-green {
      border-left-color: #10b981;
    }

    .info-blue {
      border-left-color: #3b82f6;
    }

    .info-content {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .info-content i {
      font-size: 20px;
      color: #b91c1c;
    }

    .info-green .info-content i {
      color: #10b981;
    }

    .info-blue .info-content i {
      color: #3b82f6;
    }

    .info-content p {
      margin: 0;
      color: #374151;
      font-size: 13px;
      font-weight: 500;
    }

    .info-content strong {
      font-weight: 700;
      color: #1f2937;
    }

    .btn-primary {
      padding: 8px 16px;
      background: #b91c1c;
      color: #ffffff;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 600;
      font-size: 13px;
      transition: all 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .btn-primary:hover {
      background: #991b1b;
      transform: translateY(-1px);
      box-shadow: 0 2px 8px rgba(185, 28, 28, 0.3);
    }

    /* ===== SCHEDULE WEEK GRID ===== */
    .schedule-week {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 15px;
    }

    .schedule-day {
      background: #ffffff;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      overflow: hidden;
    }

    .day-header {
      background: #f9fafb;
      padding: 12px 15px;
      border-bottom: 2px solid #e5e7eb;
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 14px;
      color: #374151;
    }

    .day-header.active {
      background: #b91c1c;
      color: #ffffff;
      border-bottom-color: #991b1b;
    }

    .day-header i {
      color: #b91c1c;
    }

    .day-header.active i {
      color: #ffffff;
    }

    .badge-count {
      margin-left: auto;
      background: #e5e7eb;
      color: #374151;
      padding: 2px 8px;
      border-radius: 10px;
      font-size: 11px;
      font-weight: 700;
    }

    .day-header.active .badge-count {
      background: rgba(255, 255, 255, 0.2);
      color: #ffffff;
    }

    .day-schedule {
      padding: 10px;
    }

    .schedule-item {
      background: #f9fafb;
      border: 1px solid #e5e7eb;
      border-radius: 6px;
      padding: 10px;
      margin-bottom: 8px;
    }

    .schedule-item:last-child {
      margin-bottom: 0;
    }

    .schedule-time {
      font-size: 11px;
      color: #6b7280;
      margin-bottom: 5px;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .schedule-time i {
      color: #b91c1c;
    }

    .schedule-info strong {
      display: block;
      font-size: 13px;
      color: #1f2937;
      margin-bottom: 3px;
    }

    .schedule-info span {
      font-size: 11px;
      color: #6b7280;
    }

    .day-empty {
      padding: 30px 15px;
      text-align: center;
      color: #9ca3af;
    }

    .day-empty i {
      font-size: 32px;
      margin-bottom: 8px;
      display: block;
      opacity: 0.5;
    }

    .day-empty span {
      font-size: 12px;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
      text-align: center;
      padding: 60px 20px;
      color: #9ca3af;
    }

    .empty-state i {
      font-size: 64px;
      margin-bottom: 15px;
      display: block;
      opacity: 0.3;
    }

    .empty-state p {
      font-size: 14px;
      margin: 0;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
      .chart-grid {
        grid-template-columns: 1fr;
      }

      .schedule-week {
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      }
    }

    @media (max-width: 768px) {
      .dashboard-container {
        padding: 15px;
      }

      .welcome-card {
        padding: 20px;
      }

      .stats-grid, .stats-3 {
        grid-template-columns: 1fr;
      }

      .stat-card {
        flex-direction: column;
        text-align: center;
      }

      .info-box {
        flex-direction: column;
        gap: 12px;
      }

      .info-content {
        flex-direction: column;
        text-align: center;
      }

      .schedule-week {
        grid-template-columns: 1fr;
      }
    }
  </style>

  {{-- CHART.JS SCRIPTS --}}
  @if(session('active_role') === 'superadmin' && isset($superadminData))
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <script>
    const chartColors = {
      blue: '#3b82f6',
      green: '#10b981',
      red: '#ef4444',
      yellow: '#f59e0b',
      purple: '#8b5cf6',
      pink: '#ec4899',
      indigo: '#6366f1',
      teal: '#14b8a6'
    };

    // 1. Pie Chart - Users per Role
    new Chart(document.getElementById('usersPerRoleChart'), {
      type: 'pie',
      data: {
        labels: @json($superadminData['roleLabels']),
        datasets: [{
          data: @json($superadminData['roleData']),
          backgroundColor: [chartColors.blue, chartColors.green, chartColors.red, chartColors.yellow, chartColors.purple],
          borderWidth: 2,
          borderColor: '#fff'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { position: 'bottom' }
        }
      }
    });

    // 2. Bar Chart - Permissions
    new Chart(document.getElementById('permissionsPerRoleChart'), {
      type: 'bar',
      data: {
        labels: @json($superadminData['permissionRoleLabels']),
        datasets: [{
          label: 'Permissions',
          data: @json($superadminData['permissionRoleData']),
          backgroundColor: chartColors.blue,
          borderRadius: 6
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
      }
    });

    // 3. Line Chart - User Growth
    new Chart(document.getElementById('userGrowthChart'), {
      type: 'line',
      data: {
        labels: @json($superadminData['monthLabels']),
        datasets: [{
          label: 'New Users',
          data: @json($superadminData['monthData']),
          borderColor: chartColors.green,
          backgroundColor: 'rgba(16, 185, 129, 0.1)',
          tension: 0.4,
          fill: true
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom' } },
        scales: { y: { beginAtZero: true } }
      }
    });
  </script>
  @endif

  {{-- CHART.JS SCRIPTS UNTUK KEPSEK - IMPROVED --}}
@if(session('active_role') === 'kepsek' && isset($kelulusanData))
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Debug: Log data
  console.log('=== KELULUSAN CHART DATA ===');
  console.log('Tahun Labels:', @json($kelulusanData['tahunLabels']));
  console.log('Tahun Data Lulus:', @json($kelulusanData['tahunDataLulus']));
  console.log('Jurusan Labels:', @json($kelulusanData['jurusanLabels']));
  console.log('Jurusan Data Lulus:', @json($kelulusanData['jurusanDataLulus']));
  
  const kColors = {
    green: '#10b981',
    red: '#ef4444',
    blue: '#3b82f6'
  };

  // 1. Status Chart (Pie)
  const statusCanvas = document.getElementById('statusChart');
  if (statusCanvas) {
    const statusData = @json($kelulusanData['statusData']);
    
    if (statusData && statusData.length > 0 && statusData.some(val => val > 0)) {
      new Chart(statusCanvas, {
        type: 'pie',
        data: {
          labels: @json($kelulusanData['statusLabels']),
          datasets: [{
            data: statusData,
            backgroundColor: [kColors.green, kColors.red],
            borderWidth: 2,
            borderColor: '#fff'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { position: 'bottom' },
            tooltip: {
              callbacks: {
                label: function(context) {
                  const label = context.label || '';
                  const value = context.parsed || 0;
                  const total = context.dataset.data.reduce((a, b) => a + b, 0);
                  const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                  return label + ': ' + value + ' (' + percentage + '%)';
                }
              }
            }
          }
        }
      });
    } else {
      statusCanvas.parentElement.innerHTML = '<div class="empty-state"><i class="fa-solid fa-chart-pie"></i><p>Belum ada data kelulusan</p></div>';
    }
  }

  // 2. Tren Tahun Chart (Line)
  const trenCanvas = document.getElementById('trenTahunChart');
  if (trenCanvas) {
    const tahunLabels = @json($kelulusanData['tahunLabels']);
    const tahunDataLulus = @json($kelulusanData['tahunDataLulus']);
    const tahunDataTidakLulus = @json($kelulusanData['tahunDataTidakLulus']);
    
    if (tahunLabels && tahunLabels.length > 0) {
      new Chart(trenCanvas, {
        type: 'line',
        data: {
          labels: tahunLabels,
          datasets: [
            {
              label: 'Lulus',
              data: tahunDataLulus,
              borderColor: kColors.green,
              backgroundColor: 'rgba(16, 185, 129, 0.1)',
              tension: 0.4,
              fill: true,
              borderWidth: 3,
              pointRadius: 5,
              pointHoverRadius: 7
            },
            {
              label: 'Tidak Lulus',
              data: tahunDataTidakLulus,
              borderColor: kColors.red,
              backgroundColor: 'rgba(239, 68, 68, 0.1)',
              tension: 0.4,
              fill: true,
              borderWidth: 3,
              pointRadius: 5,
              pointHoverRadius: 7
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom',
              labels: {
                usePointStyle: true,
                padding: 15
              }
            },
            tooltip: {
              mode: 'index',
              intersect: false,
              backgroundColor: 'rgba(0, 0, 0, 0.8)',
              padding: 12,
              titleFont: {
                size: 14,
                weight: 'bold'
              },
              bodyFont: {
                size: 13
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                precision: 0
              },
              grid: {
                color: 'rgba(0, 0, 0, 0.05)'
              }
            },
            x: {
              grid: {
                display: false
              }
            }
          },
          interaction: {
            mode: 'nearest',
            axis: 'x',
            intersect: false
          }
        }
      });
    } else {
      trenCanvas.parentElement.innerHTML = '<div class="empty-state"><i class="fa-solid fa-chart-line"></i><p>Belum ada data per tahun</p></div>';
    }
  }

  // 3. Jurusan Chart (Bar)
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
            {
              label: 'Lulus',
              data: jurusanDataLulus,
              backgroundColor: kColors.green,
              borderRadius: 6,
              borderWidth: 2,
              borderColor: 'rgba(16, 185, 129, 0.5)'
            },
            {
              label: 'Tidak Lulus',
              data: jurusanDataTidakLulus,
              backgroundColor: kColors.red,
              borderRadius: 6,
              borderWidth: 2,
              borderColor: 'rgba(239, 68, 68, 0.5)'
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom',
              labels: {
                usePointStyle: true,
                padding: 15
              }
            },
            tooltip: {
              backgroundColor: 'rgba(0, 0, 0, 0.8)',
              padding: 12,
              titleFont: {
                size: 14,
                weight: 'bold'
              },
              bodyFont: {
                size: 13
              },
              callbacks: {
                afterLabel: function(context) {
                  const datasetIndex = context.datasetIndex;
                  const dataIndex = context.dataIndex;
                  const lulus = jurusanDataLulus[dataIndex];
                  const tidakLulus = jurusanDataTidakLulus[dataIndex];
                  const total = lulus + tidakLulus;
                  const percentage = total > 0 ? ((lulus / total) * 100).toFixed(1) : 0;
                  return 'Tingkat Kelulusan: ' + percentage + '%';
                }
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                precision: 0
              },
              grid: {
                color: 'rgba(0, 0, 0, 0.05)'
              }
            },
            x: {
              grid: {
                display: false
              }
            }
          }
        }
      });
    } else {
      jurusanCanvas.parentElement.innerHTML = '<div class="empty-state"><i class="fa-solid fa-chart-bar"></i><p>Belum ada data per jurusan</p></div>';
    }
  }
  
  console.log('=== CHART RENDERING COMPLETE ===');
});
</script>

<style>
.empty-state {
  text-align: center;
  padding: 60px 20px;
  color: #9ca3af;
}

.empty-state i {
  font-size: 48px;
  margin-bottom: 10px;
  display: block;
  opacity: 0.3;
}

.empty-state p {
  font-size: 14px;
  margin: 0;
}
</style>
@endif

</x-app-layout>