<x-app-layout>
  <div class="container">
    <div class="top-section">
      <h3 class="section-title">Aturan Kelulusan</h3>

      <a href="{{ route('aturan-kelulusan.create') }}" class="btn btn-add">
        + Tambah Aturan
      </a>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
      <div class="alert-error">{{ session('error') }}</div>
    @endif

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Tahun</th>
            <th>Nilai Minimal</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($aturan as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->tahun }}</td>
              <td>{{ $item->nilai_minimal }}</td>
              <td>
                <div class="action-buttons">
                  <a href="{{ route('aturan-kelulusan.show', $item->id) }}" class="btn btn-detail">
                    Detail
                  </a>

                  <a href="{{ route('aturan-kelulusan.edit', $item->id) }}" class="btn btn-edit">
                    Edit
                  </a>

                  <form action="{{ route('aturan-kelulusan.destroy', $item->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus aturan ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete">
                      Hapus
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr class="empty-row">
              <td colspan="4">Tidak ada aturan kelulusan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- ========================= STYLE ========================= --}}
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

    .top-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .section-title {
      font-size: 1.2rem;
      font-weight: 600;
      color: #b91c1c;
      border-bottom: 3px solid #b91c1c;
      padding-bottom: 6px;
    }

    .alert-success {
      background-color: #d1fae5;
      border-left: 4px solid #10b981;
      color: #065f46;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .alert-error {
      background-color: #fee2e2;
      border-left: 4px solid #dc2626;
      color: #991b1b;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .btn-add {
      background-color: #b91c1c;
      color: #fff;
      font-weight: 600;
      padding: 8px 16px;
      border-radius: 6px;
      text-decoration: none;
      transition: 0.2s;
    }
    .btn-add:hover { background-color: #991b1b; }

    .table-container { overflow-x: auto; }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
    }

    thead {
      background-color: #b91c1c;
      color: white;
    }

    th, td {
      border: 1px solid #f3c5c5;
      padding: 10px;
      text-align: center;
    }

    tbody tr:nth-child(even) { background-color: #f9f9f9; }
    tbody tr:hover { background-color: #fde8e8; }

    .action-buttons {
      display: flex;
      justify-content: center;
      gap: 8px;
      flex-wrap: wrap;
    }

    .btn {
      padding: 6px 12px;
      font-size: 12px;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      border: none;
      transition: 0.2s;
    }

    .btn-detail { background-color: #2563eb; color: white; }
    .btn-detail:hover { background-color: #1d4ed8; }

    .btn-edit {
      background-color: #fff;
      border: 1px solid #b91c1c;
      color: #b91c1c;
    }
    .btn-edit:hover {
      background-color: #b91c1c;
      color: white;
    }

    .btn-delete {
      background-color: #dc2626;
      color: white;
    }
    .btn-delete:hover { background-color: #991b1b; }

    .empty-row td {
      padding: 20px;
      color: #9ca3af;
      background-color: #f9fafb;
      font-style: italic;
    }
  </style>
</x-app-layout>
