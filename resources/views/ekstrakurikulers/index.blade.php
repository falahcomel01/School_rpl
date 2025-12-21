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
      font-size: 14px;
      padding: 8px 16px;
      border-radius: 6px;
      font-weight: 600;
      border: none;
      cursor: pointer;
      text-decoration: none;
    }

    .btn-primary { background: #dc2626; color: #fff; }
    .btn-primary:hover { background: #b91c1c; }

    .btn-view { background: #0891b2; color: #fff; }
    .btn-edit { background: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; }
    .btn-delete { background: #dc2626; color: #fff; }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    thead { background: #b91c1c; color: white; }
    th, td {
      border: 1px solid #f3c5c5;
      padding: 10px;
      text-align: center;
    }

    .badge-success { background: #d1fae5; color: #065f46; padding: 4px 8px; }
    .badge-danger { background: #fee2e2; color: #991b1b; padding: 4px 8px; }

    .action-buttons {
      display: flex;
      gap: 8px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .pagination { margin-top: 20px; text-align: center; }
  </style>

  <div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="card">

        {{-- HEADER --}}
        <div class="header-actions">
          <h3 class="header-title">Daftar Ekstrakurikuler</h3>

          {{-- SUPERADMIN: TAMBAH --}}
          @if(auth()->user()->hasRole('superadmin'))
            <a href="{{ route('ekstrakurikulers.create') }}" class="btn btn-primary">
              + Tambah Ekstrakurikuler
            </a>
          @endif
        </div>

        {{-- ALERT --}}
        @if(session('success'))
          <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- TABLE --}}
        @if($ekstrakurikulers->count())
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Pembina</th>
                <th>Kuota</th>
                <th>Jadwal</th>
                <th>Tempat</th>
                <th>Pendaftaran</th>

                @if(
                  auth()->user()->hasRole('superadmin') ||
                  auth()->user()->hasRole('pembina') ||
                  auth()->user()->can('pilihan extra')
                )
                  <th>Aksi</th>
                @endif
              </tr>
            </thead>

            <tbody>
              @foreach($ekstrakurikulers as $i => $ekstra)
                <tr>
                  <td>{{ $ekstrakurikulers->firstItem() + $i }}</td>
                  <td>{{ $ekstra->nama_extra }}</td>
                  <td>{{ $ekstra->pembina->user->name ?? '-' }}</td>
                  <td>
                    <span class="{{ $ekstra->peserta_count >= $ekstra->kuota ? 'badge-danger' : 'badge-success' }}">
                      {{ $ekstra->peserta_count }} / {{ $ekstra->kuota }}
                    </span>
                  </td>
                  <td>{{ $ekstra->jadwal }}</td>
                  <td>{{ $ekstra->tempat }}</td>
                  <td>
                    {{ \Carbon\Carbon::parse($ekstra->pendaftaran_mulai)->format('d M Y') }}
                    <br> s/d <br>
                    {{ \Carbon\Carbon::parse($ekstra->pendaftaran_selesai)->format('d M Y') }}
                  </td>

                  {{-- AKSI --}}
                  @if(
                    auth()->user()->hasRole('superadmin') ||
                    auth()->user()->hasRole('pembina') ||
                    auth()->user()->can('pilihan extra')
                  )
                  <td>
                    <div class="action-buttons">

                      {{-- SUPERADMIN --}}
                      @if(auth()->user()->hasRole('superadmin'))
                        <a href="{{ route('ekstrakurikulers.peserta', $ekstra) }}" class="btn btn-view">Peserta</a>
                        <a href="{{ route('ekstrakurikulers.edit', $ekstra) }}" class="btn btn-edit">Edit</a>

                        <form action="{{ route('ekstrakurikulers.destroy', $ekstra) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin hapus?')">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-delete">Hapus</button>
                        </form>
                      @endif

                      {{-- PEMBINA --}}
                     @can('view peserta')
                        <a href="{{ route('ekstrakurikulers.peserta', $ekstra) }}" class="btn btn-view">
                          Peserta
                        </a>
                  @endcan

                      {{-- SISWA --}}
                      @can('pilihan extra')
                        <a href="{{ route('ekstrakurikulers.show', $ekstra) }}" class="btn btn-primary">
                          Pilih
                        </a>
                      @endcan

                    </div>
                  </td>
                  @endif
                </tr>
              @endforeach
            </tbody>
          </table>

          <div class="pagination">
            {{ $ekstrakurikulers->links() }}
          </div>
        @else
          <p class="text-center text-gray-500">Belum ada data ekstrakurikuler.</p>
        @endif

      </div>
    </div>
  </div>
</x-app-layout>
