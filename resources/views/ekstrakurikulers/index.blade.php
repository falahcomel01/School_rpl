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

    .header-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
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

    .btn-view {
      background-color: #0891b2;
      color: white;
    }

    .btn-view:hover {
      background-color: #0e7490;
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

    .alert-success {
      background-color: #d1fae5;
      border-left: 4px solid #10b981;
      color: #065f46;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
    }

    .table-container {
      overflow-x: auto;
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

    .text-center {
      text-align: center;
    }

    .font-semibold {
      font-weight: 600;
    }

    .text-gray-500 {
      color: #6b7280;
      font-size: 12px;
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

    .badge-danger {
      background-color: #fee2e2;
      color: #991b1b;
    }

    .action-buttons {
      display: flex;
      gap: 8px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .empty-state {
      text-align: center;
      padding: 40px 20px;
      color: #9ca3af;
    }

    .empty-icon {
      font-size: 48px;
      margin-bottom: 15px;
    }

    .empty-state p {
      font-size: 16px;
      font-style: italic;
    }

    .pagination {
      margin-top: 20px;
      text-align: center;
    }

    .pagination a, .pagination span {
      display: inline-block;
      padding: 8px 12px;
      margin: 0 4px;
      border-radius: 4px;
      text-decoration: none;
      transition: all 0.2s;
    }

    .pagination a {
      background: #f3f4f6;
      color: #374151;
      border: 1px solid #d1d5db;
    }

    .pagination a:hover {
      background: #e5e7eb;
    }

    .pagination span.active {
      background: #dc2626;
      color: white;
      border: 1px solid #dc2626;
    }
  </style>

  <div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="card">
        <div class="header-actions">
          <h3 class="header-title">Daftar Ekstrakurikuler</h3>

          @if(auth()->user()->hasRole('superadmin'))
            <a href="{{ route('ekstrakurikulers.create') }}" class="btn btn-primary">
              <i class="fas fa-plus me-1"></i>Tambah Ekstrakurikuler
            </a>
          @endif
        </div>

        {{-- Alert Success --}}
        @if(session('success'))
          <div class="alert-success">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
          </div>
        @endif

        {{-- Table --}}
        @if($ekstrakurikulers->count())
          <div class="table-container">
            <table>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Pembina</th>
                  <th>Kuota</th>
                  <th>Jadwal</th>
                  <th>Tempat</th>
                  <th>Periode Pendaftaran</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                @foreach($ekstrakurikulers as $index => $ekstra)
                  <tr>
                    <td class="text-center">{{ $ekstrakurikulers->firstItem() + $index }}</td>
                    <td class="font-semibold">{{ $ekstra->nama_extra }}</td>
                    <td>{{ $ekstra->pembina->user->name ?? '-' }}</td>
                    <td class="text-center">
                      <span class="badge {{ $ekstra->peserta_count >= $ekstra->kuota ? 'badge-danger' : 'badge-success' }}">
                        {{ $ekstra->peserta_count ?? 0 }} / {{ $ekstra->kuota }}
                      </span>
                    </td>
                    <td>{{ $ekstra->jadwal }}</td>
                    <td>{{ $ekstra->tempat }}</td>
                    <td class="text-center">
                      <div class="text-sm">
                        <div>{{ \Carbon\Carbon::parse($ekstra->pendaftaran_mulai)->format('d M Y') }}</div>
                        <div class="text-gray-500">s/d</div>
                        <div>{{ \Carbon\Carbon::parse($ekstra->pendaftaran_selesai)->format('d M Y') }}</div>
                      </div>
                    </td>

                    {{-- AKSI --}}
                    <td>
                      <div class="action-buttons">
                        @if(auth()->user()->hasRole('superadmin'))
                          <a href="{{ route('ekstrakurikulers.peserta', $ekstra) }}" 
                             class="btn btn-view" 
                             title="Lihat Peserta">
                            <i class="fas fa-users me-1"></i>Peserta
                          </a>

                          <a href="{{ route('ekstrakurikulers.edit', $ekstra) }}" 
                             class="btn btn-edit">
                            <i class="fas fa-edit"></i>
                          </a>

                          <form action="{{ route('ekstrakurikulers.destroy', $ekstra) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin hapus ekstrakurikuler ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">
                              <i class="fas fa-trash"></i>
                            </button>
                          </form>
                        @endif

                        @if(auth()->user()->hasRole('siswa'))
                          <a href="{{ route('ekstrakurikulers.show', $ekstra) }}" 
                             class="btn btn-primary">
                            <i class="fas fa-check me-1"></i>Pilih
                          </a>
                        @endif
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="pagination">
            {{ $ekstrakurikulers->links() }}
          </div>
        @else
          <div class="empty-state">
            <div class="empty-icon">
              <i class="fas fa-book-open"></i>
            </div>
            <p>Belum ada data ekstrakurikuler.</p>
          </div>
        @endif
      </div>
    </div>
  </div>
</x-app-layout>