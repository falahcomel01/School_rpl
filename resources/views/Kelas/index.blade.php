<x-app-layout>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap');

  :root {
    --n800: #0a1628;
    --n700: #0e1e3d;
    --n600: #112554;
    --n400: #1d4ed8;
    --n300: #3b82f6;
    --n200: #60a5fa;
    --n100: #bfdbfe;
    --n50:  #eff6ff;
    --green-bg: #d1fae5;
    --green-tx: #065f46;
    --green-bd: #6ee7b7;
    --red-bg:   #fee2e2;
    --red-tx:   #991b1b;
    --red-bd:   #fca5a5;
    --gray-50:  #f8fafc;
    --gray-100: #f1f5f9;
    --gray-200: #e2e8f0;
    --gray-400: #94a3b8;
    --gray-500: #64748b;
    --gray-700: #334155;
    --gray-900: #0f172a;
    --shadow-md: 0 4px 16px rgba(10,22,60,0.10);
  }

  /* ── PAGE ── */
  .pk-page {
    padding: 24px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── TOOLBAR ── */
  .pk-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 16px;
    flex-wrap: wrap;
  }

  .pk-toolbar-left { display: flex; flex-direction: column; gap: 2px; }

  .pk-toolbar-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 16px;
    font-weight: 800;
    color: var(--gray-900);
  }

  .pk-toolbar-sub { font-size: 12px; color: var(--gray-400); }

  .pk-btn-add {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 18px;
    background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border: none;
    border-radius: 10px;
    color: #fff;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s ease;
    box-shadow: 0 3px 12px rgba(29,78,216,0.28);
    white-space: nowrap;
  }

  .pk-btn-add:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.38);
  }

  /* ── CARD ── */
  .pk-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
  }

  /* ── ALERT ── */
  .pk-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 20px;
    font-size: 13.5px;
    font-weight: 500;
    border-bottom: 1px solid;
    border-radius: 0;
  }

  .pk-alert i { font-size: 15px; flex-shrink: 0; margin-top: 1px; }
  .pk-alert-success { background: var(--green-bg); border-color: var(--green-bd); color: var(--green-tx); }
  .pk-alert-error   { background: var(--red-bg);   border-color: var(--red-bd);   color: var(--red-tx); }

  /* ── TABLE ── */
  .pk-table-wrap { overflow-x: auto; }

  .pk-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
    min-width: 480px;
  }

  .pk-table thead tr {
    background: linear-gradient(90deg, var(--n800), var(--n600));
  }

  .pk-table th {
    padding: 13px 16px;
    text-align: left;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 10.5px;
    font-weight: 700;
    color: rgba(255,255,255,0.8);
    text-transform: uppercase;
    letter-spacing: 0.8px;
    white-space: nowrap;
    border: none;
  }

  .pk-table th.text-c { text-align: center; }

  .pk-table tbody tr {
    border-bottom: 1px solid var(--gray-100);
    transition: background 0.15s;
  }

  .pk-table tbody tr:last-child { border-bottom: none; }
  .pk-table tbody tr:hover { background: var(--n50); }

  .pk-table td {
    padding: 13px 16px;
    color: var(--gray-700);
    vertical-align: middle;
    border: none;
  }

  .pk-table td.text-c { text-align: center; }

  /* ── ROW NUMBER ── */
  .pk-row-num {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px; height: 28px;
    border-radius: 7px;
    background: var(--gray-100);
    color: var(--gray-500);
    font-size: 12px;
    font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
  }

  /* ── KELAS CELL ── */
  .pk-kelas-cell {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .pk-kelas-avatar {
    width: 34px; height: 34px;
    border-radius: 10px;
    background: linear-gradient(135deg, var(--n700), var(--n300));
    color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 800;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(29,78,216,0.2);
  }

  .pk-kelas-name {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 700;
    color: var(--gray-900);
    font-size: 13.5px;
  }

  /* ── JURUSAN BADGE ── */
  .pk-jurusan-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 11px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--n50);
    color: var(--n400);
    border: 1px solid var(--n100);
    white-space: nowrap;
  }

  .pk-jurusan-badge i { font-size: 9px; }

  .pk-jurusan-empty {
    font-size: 12px;
    color: var(--gray-400);
    font-style: italic;
  }

  /* ── ACTION BUTTONS ── */
  .pk-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
  }

  .pk-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 13px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    text-decoration: none;
    border: 1px solid;
    cursor: pointer;
    transition: all 0.18s;
    white-space: nowrap;
    background: none;
  }

  .pk-btn-edit { background: var(--n50); border-color: var(--n100); color: var(--n400); }
  .pk-btn-edit:hover {
    background: #dbeafe; border-color: var(--n200); color: var(--n700);
    transform: translateY(-1px); box-shadow: 0 2px 8px rgba(59,130,246,0.15);
  }

  .pk-btn-delete { background: var(--red-bg); border-color: var(--red-bd); color: #b91c1c; }
  .pk-btn-delete:hover {
    background: #fecaca; border-color: #f87171;
    transform: translateY(-1px); box-shadow: 0 2px 8px rgba(220,38,38,0.15);
  }

  /* ── EMPTY STATE ── */
  .pk-empty { text-align: center; padding: 56px 20px; }
  .pk-empty-icon { font-size: 48px; color: var(--gray-200); margin-bottom: 12px; display: block; }
  .pk-empty p { font-size: 14px; color: var(--gray-400); margin: 0 0 16px; }

  /* ── PAGINATION ── */
  .pk-pagination {
    padding: 16px 20px;
    border-top: 1px solid var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    background: var(--gray-50);
  }

  .pk-pagination-info { font-size: 12.5px; color: var(--gray-400); }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .pk-page { padding: 14px 12px; }
    .pk-toolbar-title { font-size: 14px; }
    .pk-btn-add span { display: none; }
  }
</style>

<div class="pk-page">
  <div class="max-w-6xl mx-auto">

    {{-- ── TOOLBAR ── --}}
    <div class="pk-toolbar">
      <div class="pk-toolbar-left">
        <span class="pk-toolbar-title">Daftar Kelas</span>
        <span class="pk-toolbar-sub">Kelola data kelas dan jurusan yang tersedia</span>
      </div>
      <a href="{{ route('kelas.create') }}" class="pk-btn-add">
        <i class="fa-solid fa-plus"></i>
        <span>Tambah Kelas</span>
      </a>
    </div>

    {{-- ── CARD ── --}}
    <div class="pk-card">

      {{-- Alert --}}
      @if(session('success'))
        <div class="pk-alert pk-alert-success">
          <i class="fa-solid fa-circle-check"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      @if(session('error'))
        <div class="pk-alert pk-alert-error">
          <i class="fa-solid fa-circle-exclamation"></i>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      {{-- ── TABLE ── --}}
      <div class="pk-table-wrap">
        <table class="pk-table">
          <thead>
            <tr>
              <th class="text-c" style="width:52px;">#</th>
              <th>Nama Kelas</th>
              <th>Jurusan</th>
              <th class="text-c" style="width:150px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($kelas as $i => $k)
              <tr>
                <td class="text-c">
                  <span class="pk-row-num">{{ $i + 1 }}</span>
                </td>

                <td>
                  <div class="pk-kelas-cell">
                    <div class="pk-kelas-avatar">
                      {{ strtoupper(substr($k->nama_kelas, 0, 1)) }}
                    </div>
                    <span class="pk-kelas-name">{{ $k->nama_kelas }}</span>
                  </div>
                </td>

                <td>
                  @if($k->jurusan && $k->jurusan->nama_jurusan)
                    <span class="pk-jurusan-badge">
                      <i class="fa-solid fa-building-columns"></i>
                      {{ $k->jurusan->nama_jurusan }}
                    </span>
                  @else
                    <span class="pk-jurusan-empty">— Tidak ada jurusan</span>
                  @endif
                </td>

                <td class="text-c">
                  <div class="pk-actions">
                    <a href="{{ route('kelas.edit', $k->id) }}" class="pk-btn pk-btn-edit">
                      <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                    <form action="{{ route('kelas.destroy', $k->id) }}" method="POST"
                          onsubmit="return confirm('Yakin mau hapus?')" style="margin:0;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="pk-btn pk-btn-delete">
                        <i class="fa-solid fa-trash-can"></i> Hapus
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4">
                  <div class="pk-empty">
                    <i class="fa-solid fa-school-flag pk-empty-icon"></i>
                    <p>Belum ada data kelas.</p>
                    <a href="{{ route('kelas.create') }}" class="pk-btn-add">
                      <i class="fa-solid fa-plus"></i>
                      Tambah Kelas
                    </a>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- ── PAGINATION (jika ada) ── --}}
      @if(method_exists($kelas, 'hasPages') && $kelas->hasPages())
        <div class="pk-pagination">
          <span class="pk-pagination-info">
            Menampilkan {{ $kelas->firstItem() }}–{{ $kelas->lastItem() }} dari {{ $kelas->total() }} kelas
          </span>
          <div>{{ $kelas->links() }}</div>
        </div>
      @endif

    </div>{{-- /.pk-card --}}
  </div>
</div>

</x-app-layout>