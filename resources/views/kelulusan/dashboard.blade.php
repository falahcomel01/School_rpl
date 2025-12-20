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

    .stats-grid {
      display: flex;
      gap: 20px;
      margin-bottom: 25px;
    }

    .stat-box {
      flex: 1;
      background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
      color: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(220, 38, 38, 0.3);
      text-align: center;
    }

    .stat-box.success {
      background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
      box-shadow: 0 4px 10px rgba(22, 163, 74, 0.3);
    }

    .stat-box.danger {
      background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
      box-shadow: 0 4px 10px rgba(220, 38, 38, 0.3);
    }

    .stat-box h3 {
      font-size: 2rem;
      font-weight: 700;
      margin: 0;
    }

    .stat-box p {
      font-size: 0.9rem;
      margin: 5px 0 0 0;
      opacity: 0.9;
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

    .filter-box {
      background-color: #fef2f2;
      border: 1px solid #fca5a5;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    .filter-box label {
      font-size: 14px;
      font-weight: 600;
      color: #7f1d1d;
      margin-right: 10px;
    }

    .filter-box select {
      border: 1px solid #f3c5c5;
      border-radius: 6px;
      padding: 6px 12px;
      font-size: 14px;
      min-width: 150px;
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

    th, td {
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

    .btn-back {
      background-color: #dc2626;
      color: #fff;
    }

    .btn-back:hover {
      background-color: #b91c1c;
      color: #fff;
    }

    .btn-secondary {
      background-color: #f3f4f6;
      color: #374151;
      border: 1px solid #d1d5db;
    }

    .btn-secondary:hover {
      background-color: #e5e7eb;
    }

    .btn-sm {
      padding: 6px 12px;
      font-size: 13px;
    }

    .table-responsive {
      overflow-x: auto;
    }
  </style>

  <div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="card">
        
        {{-- HEADER --}}
        <div class="header-actions">
          <h2 class="header-title">
            <i class="fas fa-graduation-cap me-2"></i>Dashboard Kelulusan
          </h2>
          <a href="{{ route('kelulusan.index') }}" class="btn-back">
            <i class="fas fa-arrow-left me-1"></i>Kembali
          </a>
        </div>

        {{-- FILTER ANGKATAN --}}
        <form method="GET" class="filter-box">
          <label for="tahun">
            <i class="fas fa-filter"></i> Filter Angkatan:
          </label>
          <select name="tahun" id="tahun" onchange="this.form.submit()">
            <option value="">Semua Angkatan</option>
            @foreach($tahunList as $tahun)
              <option value="{{ $tahun }}" {{ $tahunFilter == $tahun ? 'selected' : '' }}>
                Angkatan {{ $tahun }}
              </option>
            @endforeach
          </select>
          @if($tahunFilter)
            <a href="{{ route('kelulusan.dashboard') }}" class="btn btn-secondary btn-sm" style="margin-left: 10px;">
              Reset Filter
            </a>
          @endif
        </form>

        {{-- STATISTIK CARDS --}}
        <div class="stats-grid">
          <div class="stat-box success">
            <div style="font-size: 2rem; margin-bottom: 10px;">
              <i class="fas fa-check-circle"></i>
            </div>
            <h3>{{ $totalLulus }}</h3>
            <p>Siswa Lulus</p>
          </div>
          <div class="stat-box danger">
            <div style="font-size: 2rem; margin-bottom: 10px;">
              <i class="fas fa-times-circle"></i>
            </div>
            <h3>{{ $totalTidakLulus }}</h3>
            <p>Siswa Tidak Lulus</p>
          </div>
          <div class="stat-box">
            <div style="font-size: 2rem; margin-bottom: 10px;">
              <i class="fas fa-users"></i>
            </div>
            <h3>{{ $totalLulus + $totalTidakLulus }}</h3>
            <p>Total Siswa</p>
          </div>
        </div>

        {{-- CHARTS ROW --}}
        <div class="charts-row">
          {{-- PIE CHART KELULUSAN PER JURUSAN --}}
          <div class="chart-card">
            <div class="chart-title">
              <i class="fas fa-chart-pie me-2"></i>Kelulusan Per Jurusan
            </div>
            <div class="chart-container">
              <canvas id="jurusanChart"></canvas>
            </div>
          </div>

          {{-- BAR CHART PERBANDINGAN LULUS VS TIDAK LULUS --}}
          <div class="chart-card">
            <div class="chart-title">
              <i class="fas fa-chart-bar me-2"></i>Perbandingan Status Kelulusan
            </div>
            <div class="chart-container">
              <canvas id="statusChart"></canvas>
            </div>
          </div>
        </div>

        {{-- TABEL PERSENTASE KELULUSAN PER ANGKATAN --}}
        <div class="table-card">
          <div class="table-title">
            <i class="fas fa-table me-2"></i>Persentase Kelulusan Per Angkatan
          </div>
        
        @if($statsPerAngkatan->count() > 0)
          <div class="overflow-x-auto">
            <table>
              <thead>
                <tr>
                  <th>Tahun Lulus</th>
                  <th>Total Siswa</th>
                  <th>Lulus</th>
                  <th>Tidak Lulus</th>
                  <th>Persentase Kelulusan</th>
                </tr>
              </thead>
              <tbody>
                @foreach($statsPerAngkatan as $item)
                  <tr>
                    <td><strong>{{ $item->tahun_lulus }}</strong></td>
                    <td>{{ $item->total }}</td>
                    <td style="color: #16a34a; font-weight: 600;">{{ $item->lulus }}</td>
                    <td style="color: #dc2626; font-weight: 600;">{{ $item->tidak_lulus }}</td>
                    <td>
                      <strong style="color: {{ $item->persentase_lulus >= 75 ? '#16a34a' : '#dc2626' }};">
                        {{ $item->persentase_lulus }}%
                      </strong>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        @else
          <p style="text-align: center; color: #9ca3af; font-style: italic; padding: 20px;">
            Belum ada data kelulusan
          </p>
        @endif
        </div>

      </div>
    </div>
  </div>

  @push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <script>
    // Data untuk Pie Chart Per Jurusan
    const jurusanData = @json($statsPerJurusan);
    const jurusanLabels = jurusanData.map(item => item.jurusan || 'Tidak Diketahui');
    const jurusanLulus = jurusanData.map(item => item.lulus);
    const jurusanTidakLulus = jurusanData.map(item => item.tidak_lulus);

    // Pie Chart: Kelulusan Per Jurusan
    const jurusanCtx = document.getElementById('jurusanChart').getContext('2d');
    new Chart(jurusanCtx, {
      type: 'pie',
      data: {
        labels: jurusanLabels,
        datasets: [{
          label: 'Jumlah Siswa',
          data: jurusanData.map(item => item.total),
          backgroundColor: [
            '#dc2626',
            '#16a34a',
            '#3b82f6',
            '#f59e0b',
            '#8b5cf6',
            '#ec4899',
            '#14b8a6',
            '#f97316'
          ],
          borderColor: '#fff',
          borderWidth: 2
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
          },
          title: {
            display: false
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                const index = context.dataIndex;
                const total = context.parsed;
                const lulus = jurusanLulus[index];
                const tidakLulus = jurusanTidakLulus[index];
                const percentage = ((total / {{ $totalLulus + $totalTidakLulus }}) * 100).toFixed(1);
                return [
                  `Total: ${total} (${percentage}%)`,
                  `Lulus: ${lulus}`,
                  `Tidak Lulus: ${tidakLulus}`
                ];
              }
            }
          }
        }
      }
    });

    // Bar Chart: Perbandingan Status Kelulusan
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
      type: 'bar',
      data: {
        labels: ['Lulus', 'Tidak Lulus'],
        datasets: [{
          label: 'Jumlah Siswa',
          data: [{{ $totalLulus }}, {{ $totalTidakLulus }}],
          backgroundColor: [
            'rgba(22, 163, 74, 0.8)',
            'rgba(220, 38, 38, 0.8)'
          ],
          borderColor: [
            'rgb(22, 163, 74)',
            'rgb(220, 38, 38)'
          ],
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1
            }
          }
        }
      }
    });
  </script>
  @endpush

</x-app-layout>
