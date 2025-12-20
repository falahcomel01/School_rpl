<x-app-layout>
  <style>
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    .card { 
      background-color: #fff; 
      border-radius: 12px; 
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); 
      border: 1px solid #f1dada; 
      padding: 25px; 
    }
    .header-title { 
      font-size: 1.6rem; 
      font-weight: 700; 
      color: #b91c1c; 
      border-bottom: 3px solid #b91c1c; 
      padding-bottom: 8px; 
      margin-bottom: 20px; 
    }
    .btn { 
      display: inline-block; 
      font-size: 14px; 
      padding: 8px 16px; 
      border-radius: 6px; 
      text-decoration: none; 
      transition: 0.2s; 
      font-weight: 600; 
      border: none; 
      cursor: pointer;
      background-color: #0891b2;
      color: white;
    }
    .btn:hover { 
      background-color: #0e7490; 
      transform: translateY(-1px);
    }
    .btn-primary { 
      background-color: #dc2626; 
      color: white;
    }
    .btn-primary:hover { 
      background-color: #b91c1c; 
    }
    .table-container { 
      overflow-x: auto; 
      margin-bottom: 20px;
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
      text-align: left; 
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
    .empty-state { 
      text-align: center; 
      padding: 40px 20px; 
      color: #9ca3af; 
    }
    .date-picker-form { 
      background-color: #f9fafb; 
      border: 1px solid #e5e7eb; 
      border-radius: 8px; 
      padding: 15px; 
      margin-bottom: 20px; 
    }
    .date-picker-form h4 { 
      margin: 0 0 10px 0; 
      color: #374151; 
      font-size: 16px; 
    }
    .date-picker-form .form-group { 
      display: flex; 
      gap: 10px; 
      align-items: center; 
    }
    .form-input { 
      flex: 1; 
      padding: 8px 12px; 
      border: 1px solid #d1d5db; 
      border-radius: 6px; 
      font-size: 14px; 
    }
    .form-input:focus { 
      outline: none; 
      border-color: #b91c1c; 
      box-shadow: 0 0 0 2px rgba(185, 28, 28, 0.1); 
    }
    .alert-danger { 
      background-color: #fee2e2; 
      border-left: 4px solid #dc2626; 
      color: #7f1d1d; 
      padding: 10px 15px; 
      border-radius: 6px; 
      margin-bottom: 20px; 
    }
  </style>

  <div class="py-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <div class="card">
        <h3 class="header-title">
          <i class="fas fa-calendar-alt me-2"></i>Daftar Presensi - {{ $ekstra->nama_extra }}
        </h3>

        {{-- Form Pemilih Tanggal --}}
        <div class="date-picker-form">
          <h4><i class="fas fa-calendar-day me-2"></i>Lihat Detail untuk Tanggal Tertentu</h4>
          <form action="/presensi_ekstra/{{ $ekstra->id }}/detail" method="GET">
            <div class="form-group">
              <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="form-input" placeholder="Pilih tanggal">
              <button type="submit" class="btn">
                <i class="fas fa-search me-1"></i>Lihat Detail
              </button>
            </div>
          </form>
        </div>

        @if(session('error'))
          <div class="alert-danger">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
          </div>
        @endif

        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal Presensi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($tanggalList as $index => $tanggal)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</td>
                  <td>
                    {{-- Menggunakan URL langsung untuk menghindari masalah route --}}
                    <a href="/presensi_ekstra/{{ $ekstra->id }}/detail?tanggal={{ $tanggal }}" class="btn">
                      <i class="fas fa-eye me-1"></i>Lihat Detail
                    </a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="3" class="empty-state">
                    <i class="fas fa-clipboard-list fa-2x mb-2 d-block"></i>
                    Belum ada data presensi untuk ekstrakurikuler ini.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>