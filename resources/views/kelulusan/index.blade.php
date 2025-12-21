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
    }

    .btn-add:hover {
      background-color: #b91c1c;
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

    th, td {
      border: 1px solid #f3c5c5;
      padding: 10px 12px;
      text-align: center;
    }

    tbody tr:hover {
      background-color: #fde8e8;
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

    .alert-error {
      background-color: #fee2e2;
      border-left: 4px solid #dc2626;
      color: #7f1d1d;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
    }

    .auto-box {
      background-color: #fef2f2;
      border: 1px dashed #fca5a5;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    .auto-grid {
      display: grid;
      grid-template-columns: 1fr 1fr auto;
      gap: 10px;
      align-items: end;
    }

    .auto-grid label {
      font-size: 13px;
      font-weight: 600;
      color: #7f1d1d;
    }

    select, input {
      border: 1px solid #f3c5c5;
      border-radius: 6px;
      padding: 6px 10px;
      width: 100%;
    }

    .badge-success {
      background-color: #16a34a;
      color: white;
      padding: 4px 8px;
      border-radius: 6px;
      font-size: 12px;
    }

    .badge-danger {
      background-color: #dc2626;
      color: white;
      padding: 4px 8px;
      border-radius: 6px;
      font-size: 12px;
    }

    .empty {
      text-align: center;
      color: #9ca3af;
      font-style: italic;
      padding: 15px 0;
    }
  </style>

  <div class="py-10">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
      <div class="card">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-3">
          <h3 class="header-title">Data Kelulusan Siswa</h3>
          <div style="display: flex; gap: 10px;">
            @can('view daskelulusan')
            <a href="{{ route('kelulusan.dashboard') }}" class="btn-add" style="background-color: #3b82f6;">
              Dashboard Kelulusan
            </a> @endcan
            @can('create kelulusan')
            <a href="{{ route('kelulusan.create') }}" class="btn-add">
              + Tambah Kelulusan
            </a> @endcan
          </div>
        </div>

        {{-- NOTIFIKASI --}}
        @if(session('success'))
          <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
          <div class="alert-error">{{ session('error') }}</div>
        @endif

        {{-- FILTER JURUSAN --}}
        <form method="GET" class="auto-box" style="margin-bottom: 10px;">
          <div class="auto-grid" style="grid-template-columns: 1fr auto;">
            <div>
              <label>Filter Jurusan</label>
              <select name="jurusan" onchange="this.form.submit()">
                <option value="">Semua Jurusan</option>
                @foreach($jurusans as $jurusan)
                  <option value="{{ $jurusan->id }}" {{ request('jurusan') == $jurusan->id ? 'selected' : '' }}>
                    {{ $jurusan->nama_jurusan }}
                  </option>
                @endforeach
              </select>
            </div>
            @if(request('jurusan'))
              <a href="{{ route('kelulusan.index') }}" class="btn-add" style="align-self: end;">Reset Filter</a>
            @endif
          </div>
        </form>

        {{-- AUTO GENERATE --}}
        <form action="{{ route('kelulusan.auto-generate') }}" method="POST" class="auto-box">
          @csrf
          <div class="auto-grid">
            <div>
              <label>Aturan Kelulusan</label>
              <select name="aturan_kelulusan_id" required>
                @foreach($aturans as $aturan)
                  <option value="{{ $aturan->id }}">
                    Tahun {{ $aturan->tahun }} (≥ {{ $aturan->nilai_minimal }})
                  </option>
                @endforeach
              </select>
            </div>

            <div>
              <label>Tahun Lulus</label>
              <input type="number" name="tahun_lulus" placeholder="Contoh: 2025" required>
            </div>
 @can('create kelulusan')
            <button class="btn-add"> Auto Generate</button>@endcan
          </div>
        </form>

        {{-- TABEL --}}
        <div class="overflow-x-auto">
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Jurusan</th>
                <th>Tahun</th>
                <th>Nilai Akhir</th>
                <th>Status</th>
                <th>Aturan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($kelulusans as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                    @if($item->is_legacy)
                      {{ $item->nama_siswa_legacy }}
                      <span style="font-size: 11px; color: #9ca3af;"></span>
                    @else
                      {{ $item->siswa->user->name ?? '-' }}
                    @endif
                  </td>
                  <td>
                    @if($item->is_legacy)
                      {{ $item->jurusan_legacy }}
                    @else
                      {{ $item->siswa->kelas->jurusan->nama_jurusan ?? '-' }}
                    @endif
                  </td>
                  <td>{{ $item->tahun_lulus }}</td>
                  <td>{{ $item->nilai_akhir ?? '-' }}</td>
                  <td>
                    <span class="{{ $item->status === 'lulus' ? 'badge-success' : 'badge-danger' }}">
                      {{ strtoupper(str_replace('_',' ', $item->status)) }}
                    </span>
                  </td>
                  <td>
                    {{ $item->aturanKelulusan->tahun ?? '-' }}
                    (≥ {{ $item->aturanKelulusan->nilai_minimal ?? '-' }})
                  </td>
                  <td>
  <div class="flex justify-center gap-2">

    {{-- DETAIL --}}
    <a href="{{ route('kelulusan.show', $item->id) }}" class="btn btn-edit">
      Detail
    </a>

  @can('create kelulusan')
    <a href="{{ route('kelulusan.edit', $item->id) }}" class="btn btn-edit">
      Edit
    </a>
    {{-- HAPUS --}}
    <form action="{{ route('kelulusan.destroy', $item->id) }}"
          method="POST"
          onsubmit="return confirm('Yakin hapus data kelulusan ini?')">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-delete">
        Hapus
      </button>
    </form>
    @endcan
  </div>
</td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="empty">Data kelulusan belum tersedia</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</x-app-layout>
