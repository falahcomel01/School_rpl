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
      padding: 25px;
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

    .btn-add {
      background-color: #dc2626;
      color: #fff;
      padding: 8px 16px;
      border-radius: 6px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      transition: 0.2s;
      border: none;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .btn-add:hover {
      background-color: #b91c1c;
    }

    .btn-info {
      background-color: #0891b2;
    }

    .btn-info:hover {
      background-color: #0e7490;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
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

    .btn {
      display: inline-block;
      font-size: 13px;
      padding: 6px 10px;
      border-radius: 6px;
      text-decoration: none;
      transition: 0.2s;
      font-weight: 600;
    }

    .btn-edit {
      background-color: #fee2e2;
      border: 1px solid #fca5a5;
      color: #b91c1c;
    }

    .btn-edit:hover {
      background-color: #fecaca;
    }

    .btn-delete {
      background-color: #dc2626;
      color: white;
      border: none;
      cursor: pointer;
    }

    .btn-delete:hover {
      background-color: #991b1b;
    }

    .btn-view {
      background-color: #dbeafe;
      border: 1px solid #93c5fd;
      color: #1e40af;
    }

    .btn-view:hover {
      background-color: #bfdbfe;
    }

    .alert-success {
      background-color: #d1fae5;
      border-left: 4px solid #10b981;
      color: #065f46;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
    }

    .alert-error {
      background-color: #fee2e2;
      border-left: 4px solid #dc2626;
      color: #7f1d1d;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
    }

    .filter-container {
      display: flex;
      gap: 10px;
      margin-bottom: 15px;
      flex-wrap: wrap;
    }

    .filter-select {
      border: 1px solid #f3c5c5;
      border-radius: 6px;
      padding: 6px 10px;
      min-width: 150px;
    }

    .search-input {
      border: 1px solid #f3c5c5;
      border-radius: 6px;
      padding: 6px 10px;
      width: 250px;
    }

    .search-btn {
      background-color: #dc2626;
      color: #fff;
      border: none;
      border-radius: 6px;
      padding: 6px 14px;
      cursor: pointer;
      transition: 0.2s;
      font-weight: 600;
    }

    .search-btn:hover {
      background-color: #b91c1c;
    }

    .empty {
      text-align: center;
      color: #9ca3af;
      font-style: italic;
      padding: 15px 0;
    }

    .top-actions {
      display: flex;
      gap: 10px;
      align-items: center;
    }

    .badge {
      display: inline-block;
      padding: 3px 8px;
      border-radius: 4px;
      font-size: 12px;
      font-weight: 600;
    }

    .badge-success {
      background-color: #d1fae5;
      color: #065f46;
    }

    .badge-warning {
      background-color: #fef3c7;
      color: #92400e;
    }

    .badge-info {
      background-color: #dbeafe;
      color: #1e40af;
    }

    .badge-primary {
      background-color: #e0e7ff;
      color: #3730a3;
    }

    .pagination-info {
      color: #6b7280;
      font-size: 14px;
      margin-top: 10px;
    }

    .filter-section {
      background-color: #f9fafb;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 20px;
    }

    .filter-title {
      font-weight: 600;
      margin-bottom: 10px;
      color: #374151;
    }

    .filter-row {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      align-items: end;
    }

    .filter-group {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .filter-label {
      font-size: 12px;
      color: #6b7280;
    }
  </style>

  <div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="card">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-3">
          <h3 class="header-title">Data Prestasi Siswa
            @if(session('active_role') === 'walikelas')
              <span class="badge bg-primary">{{ Auth::user()->walikelas->kelas->nama_kelas ?? '' }}</span>
            @endif
          </h3>

          <div class="top-actions">
            @php
              $canViewStats = in_array(session('active_role'), ['superadmin', 'tus', 'kepsek', 'walikelas']);
            @endphp
             @can('view statistik')
              <a href="{{ route('prestasi.statistik') }}" class="btn-add btn-info">
                <i class="fas fa-chart-bar"></i> Statistik
              </a>
              @endcan
            @can('create prestasi')
            <a href="{{ route('prestasi.create') }}" class="btn-add">
              <i class="fas fa-plus"></i> Tambah Prestasi
            </a>
            @endcan
          </div>
        </div>

        {{-- Notifikasi --}}
        @if(session('success'))
          <div class="alert-success">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
          </div>
        @endif

        @if(session('error'))
          <div class="alert-error">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
          </div>
        @endif

        {{-- Filter Section --}}
        <div class="filter-section">
          <div class="filter-title">
            <i class="fas fa-filter me-2"></i>Filter & Pencarian
          </div>
          <div class="filter-row">
            <div class="filter-group">
              <label class="filter-label">Jenis Prestasi</label>
              <select class="filter-select" id="filterJenis">
                <option value="">Semua Jenis</option>
                <option value="akademik">Akademik</option>
                <option value="non-akademik">Non-Akademik</option>
              </select>
            </div>
            <div class="filter-group">
              <label class="filter-label">Tingkat</label>
              <select class="filter-select" id="filterTingkat">
                <option value="">Semua Tingkat</option>
                <option value="sekolah">Sekolah</option>
                <option value="kecamatan">Kecamatan</option>
                <option value="kabupaten">Kabupaten</option>
                <option value="provinsi">Provinsi</option>
                <option value="nasional">Nasional</option>
                <option value="internasional">Internasional</option>
              </select>
            </div>
            <div class="filter-group">
              <label class="filter-label">Tahun</label>
              <select class="filter-select" id="filterTahun">
                <option value="">Semua Tahun</option>
                @php
                  $currentYear = date('Y');
                @endphp
                @for($year = $currentYear; $year >= $currentYear - 5; $year--)
                  <option value="{{ $year }}">{{ $year }}</option>
                @endfor
              </select>
            </div>
            <div class="filter-group">
              <label class="filter-label">Cari</label>
              <div style="display: flex;">
                <input type="text" class="search-input" id="searchPrestasi" placeholder="Nama prestasi/siswa...">
              </div>
            </div>
            <button type="button" class="btn btn-edit" onclick="resetFilter()">
              <i class="fas fa-redo me-1"></i>Reset Filter
            </button>
          </div>
        </div>

        {{-- Tabel --}}
        <div class="overflow-x-auto">
          <table id="prestasiTable">
            <thead>
              <tr>
                <th width="5%">No</th>
                <th width="15%">Siswa</th>
                @if(session('active_role') !== 'siswa')
                  <th width="10%">Kelas</th>
                @endif
                <th width="20%">Nama Prestasi</th>
                <th width="10%">Jenis</th>
                <th width="10%">Tingkat</th>
                <th width="10%">Peringkat</th>
                <th width="10%">Tanggal</th>
                <th width="10%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($prestasis as $index => $prestasi)
                <tr>
                  <td>{{ $prestasis->firstItem() + $index }}</td>
                  <td>
                    <div>
                      <strong class="d-block">{{ $prestasi->siswa->user->name }}</strong>
                      <small class="text-muted">{{ $prestasi->siswa->user->username }}</small>
                    </div>
                  </td>
                  @if(session('active_role') !== 'siswa')
                    <td>
                      <span class="badge badge-info">
                        {{ $prestasi->siswa->kelas->nama_kelas ?? '-' }}
                      </span>
                    </td>
                  @endif
                  <td>
                    <strong>{{ $prestasi->nama_prestasi }}</strong>
                    @if($prestasi->file_bukti)
                      <br><small class="text-muted">
                        <i class="fas fa-paperclip"></i> Ada bukti
                      </small>
                    @endif
                  </td>
                  <td>
                    @if($prestasi->jenis === 'akademik')
                      <span class="badge badge-success">
                        <i class="fas fa-book"></i> Akademik
                      </span>
                    @else
                      <span class="badge badge-warning">
                        <i class="fas fa-star"></i> Non-Akademik
                      </span>
                    @endif
                  </td>
                  <td>
                    @php
                      $colors = [
                        'sekolah' => 'badge-primary',
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
                    @if($prestasi->peringkat)
                      <span class="badge badge-primary">{{ $prestasi->peringkat }}</span>
                    @else
                      <span class="text-muted">-</span>
                    @endif
                  </td>
                  <td>
                    <small>{{ \Carbon\Carbon::parse($prestasi->tanggal)->format('d M Y') }}</small>
                  </td>
                  <td>
                    <div class="flex justify-center gap-2">
                      <a href="{{ route('prestasi.show', $prestasi->id) }}" 
                         class="btn btn-view" 
                         title="Detail">
                        <i class="fas fa-eye"></i>
                      </a>
                       @can('create prestasi')
                      <a href="{{ route('prestasi.edit', $prestasi->id) }}" 
                         class="btn btn-edit" 
                         title="Edit">
                        <i class="fas fa-edit"></i>
                      </a>
                      <button type="button" 
                              class="btn btn-delete" 
                              onclick="confirmDelete({{ $prestasi->id }})" 
                              title="Hapus">
                        <i class="fas fa-trash"></i>
                      </button>
                      @endcan
                    </div>
                    
                    <form id="delete-form-{{ $prestasi->id }}" 
                          action="{{ route('prestasi.destroy', $prestasi->id) }}" 
                          method="POST" 
                          class="d-none">
                      @csrf
                      @method('DELETE')
                    </form>
                  </td>
                </tr>
              @empty
                <tr id="emptyRow">
                  <td colspan="{{ session('active_role') !== 'siswa' ? '9' : '8' }}" class="empty">
                    <div>
                      <i class="fas fa-trophy fa-3x text-muted mb-3 d-block"></i>
                      <h5 class="text-muted">Belum ada data prestasi</h5>
                      <p class="text-muted">Klik tombol "Tambah Prestasi" untuk menambahkan data</p>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        {{-- Pagination Info --}}
        @if($prestasis->total() > 0)
          <div class="pagination-info">
            Menampilkan <strong>{{ $prestasis->firstItem() }}</strong> 
            sampai <strong>{{ $prestasis->lastItem() }}</strong> 
            dari <strong>{{ $prestasis->total() }}</strong> data
          </div>
        @endif

        {{-- Pagination --}}
        <div class="mt-4">
          {{ $prestasis->links() }}
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
  <script>
  function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus prestasi ini?\n\nData yang dihapus tidak dapat dikembalikan.')) {
      document.getElementById('delete-form-' + id).submit();
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    const filterJenis = document.getElementById('filterJenis');
    const filterTingkat = document.getElementById('filterTingkat');
    const filterTahun = document.getElementById('filterTahun');
    const searchInput = document.getElementById('searchPrestasi');
    const table = document.getElementById('prestasiTable');
    const tbody = table.getElementsByTagName('tbody')[0];
    const rows = tbody.getElementsByTagName('tr');

    function filterTable() {
      const jenisValue = filterJenis.value.toLowerCase();
      const tingkatValue = filterTingkat.value.toLowerCase();
      const tahunValue = filterTahun.value;
      const searchValue = searchInput.value.toLowerCase();
      
      let visibleCount = 0;
      const isSiswaRole = {{ session('active_role') === 'siswa' ? 'true' : 'false' }};

      for (let row of rows) {
        const cells = row.getElementsByTagName('td');
        
        if (cells.length === 0 || cells[0].colSpan > 1) {
          row.style.display = 'none';
          continue;
        }

        const siswaCell = cells[1].textContent.toLowerCase();
        const prestasiIdx = isSiswaRole ? 2 : 3;
        const jenisIdx = isSiswaRole ? 3 : 4;
        const tingkatIdx = isSiswaRole ? 4 : 5;
        const tanggalIdx = isSiswaRole ? 6 : 7;
        
        const prestasi = cells[prestasiIdx].textContent.toLowerCase();
        const jenis = cells[jenisIdx].textContent.toLowerCase();
        const tingkat = cells[tingkatIdx].textContent.toLowerCase();
        const tanggal = cells[tanggalIdx].textContent;

        const matchJenis = !jenisValue || jenis.includes(jenisValue);
        const matchTingkat = !tingkatValue || tingkat.includes(tingkatValue);
        const matchTahun = !tahunValue || tanggal.includes(tahunValue);
        const matchSearch = !searchValue || siswaCell.includes(searchValue) || prestasi.includes(searchValue);

        if (matchJenis && matchTingkat && matchTahun && matchSearch) {
          row.style.display = '';
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      }

      const emptyRow = document.getElementById('emptyRow');
      if (emptyRow) {
        emptyRow.style.display = visibleCount === 0 ? '' : 'none';
      }
    }

    filterJenis.addEventListener('change', filterTable);
    filterTingkat.addEventListener('change', filterTable);
    filterTahun.addEventListener('change', filterTable);
    searchInput.addEventListener('keyup', filterTable);
  });

  function resetFilter() {
    document.getElementById('filterJenis').value = '';
    document.getElementById('filterTingkat').value = '';
    document.getElementById('filterTahun').value = '';
    document.getElementById('searchPrestasi').value = '';
    
    const event = new Event('change');
    document.getElementById('filterJenis').dispatchEvent(event);
  }
  </script>
  @endpush
</x-app-layout>