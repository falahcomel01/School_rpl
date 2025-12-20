<x-app-layout>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1dada;
      padding: 20px;
      transition: 0.3s ease;
    }

    .header-title {
      font-size: 1.6rem;
      font-weight: 700;
      color: #b91c1c;
      border-bottom: 3px solid #b91c1c;
      padding-bottom: 8px;
      margin-bottom: 20px;
    }

    .header-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .summary-cards {
      display: flex;
      gap: 20px;
      margin-bottom: 25px;
    }

    .summary-card {
      flex: 1;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1dada;
      padding: 20px;
      text-align: center;
    }

    .summary-icon {
      font-size: 2.5rem;
      margin-bottom: 10px;
    }

    .summary-count {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 5px;
    }

    .summary-label {
      color: #6b7280;
      font-size: 0.9rem;
    }

    .charts-row {
      display: flex;
      gap: 20px;
      margin-bottom: 25px;
    }

    .chart-card {
      flex: 1;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1dada;
      padding: 20px;
    }

    .chart-title {
      font-weight: 600;
      color: #374151;
      margin-bottom: 15px;
      padding-bottom: 8px;
      border-bottom: 1px solid #f1dada;
    }

    .chart-container {
      height: 200px;
      position: relative;
    }

    .table-card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1dada;
      padding: 20px;
      margin-bottom: 25px;
    }

    .table-title {
      font-weight: 600;
      color: #374151;
      margin-bottom: 15px;
      padding-bottom: 8px;
      border-bottom: 1px solid #f1dada;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead {
      background-color: #b91c1c;
      color: white;
    }

    th,
    td {
      border: 1px solid #f3c5c5;
      padding: 10px 12px;
      text-align: center;
    }

    th {
      text-transform: uppercase;
      font-size: 13px;
      letter-spacing: 0.5px;
    }

    tbody tr:hover {
      background-color: #fde8e8;
      transition: 0.2s;
    }

    .badge {
      display: inline-block;
      padding: 3px 8px;
      border-radius: 4px;
      font-size: 12px;
      font-weight: 600;
    }

    .badge-primary {
      background-color: #dc2626;
      color: white;
    }

    .badge-info {
      background-color: #dbeafe;
      color: #1e40af;
    }

    .badge-success {
      background-color: #d1fae5;
      color: #065f46;
    }

    .badge-warning {
      background-color: #fef3c7;
      color: #92400e;
    }

    .badge-secondary {
      background-color: #f3f4f6;
      color: #374151;
    }

    .badge-danger {
      background-color: #fee2e2;
      color: #b91c1c;
    }

    .badge-dark {
      background-color: #f9fafb;
      color: #111827;
    }

    .btn {
      display: inline-block;
      font-size: 14px;
      padding: 8px 16px;
      border-radius: 6px;
      text-decoration: none;
      transition: 0.2s;
      font-weight: 600;
      cursor: pointer;
      border: none;
    }

    .btn-primary {
      background-color: #dc2626;
      color: white;
    }

    .btn-primary:hover {
      background-color: #b91c1c;
    }

    .btn-secondary {
      background-color: #f3f4f6;
      color: #374151;
      border: 1px solid #d1d5db;
    }

    .btn-secondary:hover {
      background-color: #e5e7eb;
    }

    .btn-info {
      background-color: #0891b2;
      color: white;
    }

    .btn-info:hover {
      background-color: #0e7490;
    }

    .btn-sm {
      padding: 6px 12px;
      font-size: 13px;
    }

    .empty-state {
      text-align: center;
      padding: 30px 0;
      color: #6b7280;
    }

    .empty-state i {
      font-size: 3rem;
      margin-bottom: 15px;
      color: #9ca3af;
    }

    .empty-state p {
      margin: 0;
    }

    .table-responsive {
      overflow-x: auto;
    }
  </style>

  <div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="card">
        <div class="header-actions">
          <h3 class="header-title">
            <i class="fas fa-chart-bar me-2"></i>Statistik Prestasi - {{ $kelasInfo }}
          </h3>
          <a href="{{ route('prestasi.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i>Kembali
          </a>
        </div>

        <!-- Summary Cards -->
        <div class="summary-cards">
          <div class="summary-card">
            <div class="summary-icon text-primary">
              <i class="fas fa-trophy"></i>
            </div>
            <div class="summary-count">{{ $totalPrestasi }}</div>
            <div class="summary-label">Total Prestasi</div>
          </div>
          <div class="summary-card">
            <div class="summary-icon text-success">
              <i class="fas fa-book"></i>
            </div>
            <div class="summary-count">{{ $prestasiAkademik }}</div>
            <div class="summary-label">Prestasi Akademik</div>
          </div>
          <div class="summary-card">
            <div class="summary-icon text-warning">
              <i class="fas fa-star"></i>
            </div>
            <div class="summary-count">{{ $prestasiNonAkademik }}</div>
            <div class="summary-label">Prestasi Non-Akademik</div>
          </div>
        </div>

        <!-- Charts Row -->
        <div class="charts-row">
          <!-- Prestasi per Tingkat -->
          <div class="chart-card">
            <div class="chart-title">
              <i class="fas fa-chart-pie me-2"></i>Prestasi per Tingkat
            </div>
            <div class="chart-container">
              <canvas id="tingkatChart"></canvas>
            </div>
          </div>

          <!-- Prestasi per Jenis -->
          <div class="chart-card">
            <div class="chart-title">
              <i class="fas fa-chart-bar me-2"></i>Perbandingan Jenis Prestasi
            </div>
            <div class="chart-container">
              <canvas id="jenisChart"></canvas>
            </div>
          </div>
        </div>

        <!-- Top Siswa Berprestasi -->
        <div class="table-card">
          <div class="table-title">
            <i class="fas fa-star me-2"></i>Top 10 Siswa Berprestasi
          </div>
          
          @if($siswaBerprestasi->count() > 0)
            <div class="table-responsive">
              <table>
                <thead>
                  <tr>
                    <th width="10%">Peringkat</th>
                    <th width="20%">NIS</th>
                    <th width="30%">Nama Siswa</th>
                    <th width="15%">Kelas</th>
                    <th width="15%" class="text-center">Jumlah Prestasi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($siswaBerprestasi as $index => $siswa)
                    <tr>
                      <td>
                        @if($index == 0)
                          <span class="badge badge-warning">
                            <i class="fas fa-crown"></i> 1
                          </span>
                        @elseif($index == 1)
                          <span class="badge badge-secondary">
                            <i class="fas fa-medal"></i> 2
                          </span>
                        @elseif($index == 2)
                          <span class="badge badge-danger">
                            <i class="fas fa-medal"></i> 3
                          </span>
                        @else
                          <span class="badge badge-primary">{{ $index + 1 }}</span>
                        @endif
                      </td>
                      <td>{{ $siswa->user->username ?? '-' }}</td>
                      <td><strong>{{ $siswa->user->name ?? '-' }}</strong></td>
                      <td>
                        <span class="badge badge-info">
                          {{ $siswa->kelas->nama_kelas ?? '-' }}
                        </span>
                      </td>
                      <td class="text-center">
                        <span class="badge badge-success">
                          {{ $siswa->prestasis_count }} prestasi
                        </span>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="empty-state">
              <i class="fas fa-trophy"></i>
              <p>Belum ada siswa dengan prestasi</p>
            </div>
          @endif
        </div>

        <!-- Prestasi Terbaru -->
        <div class="table-card">
          <div class="table-title">
            <i class="fas fa-clock me-2"></i>Prestasi Terbaru
          </div>
          
          @if($prestasiTerbaru->count() > 0)
            <div class="table-responsive">
              <table>
                <thead>
                  <tr>
                    <th width="25%">Siswa</th>
                    <th width="10%">Kelas</th>
                    <th width="30%">Prestasi</th>
                    <th width="15%">Tingkat</th>
                    <th width="10%">Tanggal</th>
                    <th width="10%" class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($prestasiTerbaru as $prestasi)
                    <tr>
                      <td>
                        <strong>{{ $prestasi->siswa->user->name ?? '-' }}</strong><br>
                        <small class="text-muted">{{ $prestasi->siswa->user->username ?? '-' }}</small>
                      </td>
                      <td>
                        <span class="badge badge-info">
                          {{ $prestasi->siswa->kelas->nama_kelas ?? '-' }}
                        </span>
                      </td>
                      <td>{{ $prestasi->nama_prestasi }}</td>
                      <td>
                        @php
                          $colors = [
                            'sekolah' => 'badge-secondary',
                            'kecamatan' => 'badge-info',
                            'kabupaten' => 'badge-primary',
                            'provinsi' => 'badge-warning',
                            'nasional' => 'badge-danger',
                            'internasional' => 'badge-dark'
                          ];
                        @endphp
                        <span class="badge {{ $colors[$prestasi->tingkat] ?? 'badge-secondary' }}">
                          {{ ucfirst($prestasi->tingkat) }}
                        </span>
                      </td>
                      <td>
                        <small>{{ \Carbon\Carbon::parse($prestasi->tanggal)->format('d M Y') }}</small>
                      </td>
                      <td class="text-center">
                        <a href="{{ route('prestasi.show', $prestasi->id) }}" 
                           class="btn btn-sm btn-info">
                          <i class="fas fa-eye"></i>
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="empty-state">
              <i class="fas fa-trophy"></i>
              <p>Belum ada prestasi terbaru</p>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
  // Data untuk chart
  const tingkatData = @json($prestasiPerTingkat);
  const akademikCount = {{ $prestasiAkademik }};
  const nonAkademikCount = {{ $prestasiNonAkademik }};
  @if($prestasiPerKelas)
  const kelasData = @json($prestasiPerKelas);
  @endif

  // Chart Prestasi per Tingkat
  const tingkatCtx = document.getElementById('tingkatChart').getContext('2d');
  new Chart(tingkatCtx, {
      type: 'doughnut',
      data: {
          labels: tingkatData.map(item => item.tingkat.charAt(0).toUpperCase() + item.tingkat.slice(1)),
          datasets: [{
              label: 'Jumlah Prestasi',
              data: tingkatData.map(item => item.total),
              backgroundColor: [
                  'rgba(108, 117, 125, 0.8)',
                  'rgba(13, 202, 240, 0.8)',
                  'rgba(13, 110, 253, 0.8)',
                  'rgba(255, 193, 7, 0.8)',
                  'rgba(220, 53, 69, 0.8)',
                  'rgba(33, 37, 41, 0.8)'
              ],
              borderWidth: 2,
              borderColor: '#fff'
          }]
      },
      options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
              legend: {
                  position: 'bottom',
                  labels: {
                      boxWidth: 12,
                      font: {
                          size: 11
                      }
                  }
              }
          }
      }
  });

  // Chart Jenis Prestasi
  const jenisCtx = document.getElementById('jenisChart').getContext('2d');
  new Chart(jenisCtx, {
      type: 'bar',
      data: {
          labels: ['Akademik', 'Non-Akademik'],
          datasets: [{
              label: 'Jumlah Prestasi',
              data: [akademikCount, nonAkademikCount],
              backgroundColor: [
                  'rgba(25, 135, 84, 0.8)',
                  'rgba(255, 193, 7, 0.8)'
              ],
              borderColor: [
                  'rgb(25, 135, 84)',
                  'rgb(255, 193, 7)'
              ],
              borderWidth: 2
          }]
      },
      options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
              y: {
                  beginAtZero: true,
                  ticks: {
                      stepSize: 1
                  }
              }
          },
          plugins: {
              legend: {
                  display: false
              }
          }
      }
  });

  // Chart Prestasi per Kelas (untuk superadmin/tus/kepsek)
  @if($prestasiPerKelas)
  const kelasCtx = document.getElementById('kelasChart').getContext('2d');
  new Chart(kelasCtx, {
      type: 'bar',
      data: {
          labels: kelasData.map(item => item.nama_kelas),
          datasets: [{
              label: 'Jumlah Prestasi',
              data: kelasData.map(item => item.total),
              backgroundColor: 'rgba(13, 110, 253, 0.8)',
              borderColor: 'rgb(13, 110, 253)',
              borderWidth: 2
          }]
      },
      options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
              y: {
                  beginAtZero: true,
                  ticks: {
                      stepSize: 1
                  }
              }
          },
          plugins: {
              legend: {
                  display: false
              }
          }
      }
  });
  @endif
  </script>
  @endpush
</x-app-layout>