<x-app-layout>

  <div class="container">

    {{-- Notifikasi --}}
    @if(session('success'))
      <div class="alert-success">
        {{ session('success') }}
      </div>
    @endif

    {{-- Header: Info Guru + Tombol Tambah --}}
    <div class="header-section">
      <div>
        <h3 class="guru-name">Guru: {{ $jenisUjian->guru->user->name }}</h3>
        <p class="mapel-name">Mapel: {{ $jenisUjian->guru->mapel->nama_mapel ?? '-' }}</p>
      </div>

      <a href="{{ route('soal.create', $jenisUjian->id) }}" class="btn-add">+ Tambah Soal</a>
    </div>

    {{-- Tabel Soal --}}
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Soal</th>
            <th>Tipe</th>
            <th>Opsi Jawaban</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($jenisUjian->soals as $s)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $s->soal_text }}</td>
              <td>{{ strtoupper($s->tipe_soal) }}</td>

              <td>
                @if ($s->tipe_soal == 'pg')
                  @foreach ($s->opsiJawaban as $o)
                    <div class="opsi-item">
                      <strong>{{ $o->urutan }}.</strong> {{ $o->opsi_text }}
                      @if ($o->is_benar)
                        <span class="badge-success">Benar</span>
                      @endif
                    </div>
                  @endforeach
                @else
                  <em class="text-gray-500">— Essay —</em>
                @endif
              </td>

              <td>
                <div class="action-buttons">
                  <a href="{{ route('soal.edit', $s->id) }}" class="btn btn-edit">Edit</a>

                  <form action="{{ route('soal.destroy', $s->id) }}" method="POST" class="inline-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin hapus soal?')">
                      Hapus
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr class="empty-row">
              <td colspan="5">Belum ada soal pada jenis ujian ini.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>

  {{-- CSS Styling --}}
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #fafafa;
    }

    .container {
      max-width: 1000px;
      margin: 40px auto;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1dada;
      padding: 30px;
    }

    /* Header Guru + Tombol */
    .header-section {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 24px;
      padding-bottom: 16px;
      border-bottom: 1px solid #eee;
    }

    .guru-name {
      font-size: 1.4rem;
      font-weight: 700;
      color: #b91c1c;
      margin: 0 0 6px;
    }

    .mapel-name {
      font-size: 1.05rem;
      color: #555;
      margin: 0;
      font-weight: 500;
    }

    .btn-add {
      background-color: #b91c1c;
      color: #fff;
      font-weight: 600;
      padding: 8px 18px;
      border-radius: 8px;
      text-decoration: none;
      transition: background-color 0.2s;
      white-space: nowrap;
      align-self: flex-end;
    }
    .btn-add:hover {
      background-color: #991b1b;
    }

    /* Notifikasi */
    .alert-success {
      background-color: #d1fae5;
      border-left: 4px solid #10b981;
      color: #065f46;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    /* Tabel */
    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
      color: #333;
    }

    thead {
      background-color: #b91c1c;
      color: white;
      text-transform: uppercase;
      font-size: 13px;
    }

    th, td {
      border: 1px solid #f3c5c5;
      padding: 12px 10px;
      text-align: center;
      vertical-align: top;
    }

    td {
      text-align: left;
    }

    tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tbody tr:hover {
      background-color: #fde8e8;
      transition: background-color 0.2s ease;
    }

    /* Opsi jawaban */
    .opsi-item {
      margin-bottom: 4px;
      font-size: 13px;
    }

    .badge-success {
      background-color: #dcfce7;
      color: #166534;
      padding: 2px 6px;
      border-radius: 4px;
      font-size: 11px;
      margin-left: 6px;
    }

    /* Tombol Aksi */
    .action-buttons {
      display: flex;
      justify-content: center;
      gap: 8px;
      flex-wrap: wrap;
    }

    .btn {
      display: inline-block;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      transition: 0.2s;
      border: none;
    }

    .btn-edit {
      background-color: #fff;
      border: 1px solid #b91c1c;
      color: #b91c1c;
    }

    .btn-edit:hover {
      background-color: #b91c1c;
      color: #fff;
    }

    .btn-delete {
      background-color: #dc2626;
      color: white;
    }

    .btn-delete:hover {
      background-color: #991b1b;
    }

    .inline-form {
      display: inline;
    }

    .empty-row td {
      text-align: center;
      padding: 20px;
      color: #9ca3af;
      background-color: #f9fafb;
      font-style: italic;
    }
  </style>

</x-app-layout>
