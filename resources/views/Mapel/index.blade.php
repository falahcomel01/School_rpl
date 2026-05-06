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
  .pm-page {
    padding: 24px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── TOOLBAR ── */
  .pm-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 16px;
    flex-wrap: wrap;
  }

  .pm-toolbar-left { display: flex; flex-direction: column; gap: 2px; }

  .pm-toolbar-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 16px;
    font-weight: 800;
    color: var(--gray-900);
  }

  .pm-toolbar-sub { font-size: 12px; color: var(--gray-400); }

  .pm-btn-add {
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

  .pm-btn-add:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.38);
  }

  /* ── CARD ── */
  .pm-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
  }

  /* ── ALERT ── */
  .pm-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 20px;
    font-size: 13.5px;
    font-weight: 500;
    border-bottom: 1px solid;
    border-radius: 0;
  }

  .pm-alert i { font-size: 15px; flex-shrink: 0; margin-top: 1px; }

  .pm-alert-success {
    background: var(--green-bg);
    border-color: var(--green-bd);
    color: var(--green-tx);
  }

  .pm-alert-error {
    background: var(--red-bg);
    border-color: var(--red-bd);
    color: var(--red-tx);
  }

  /* ── TABLE ── */
  .pm-table-wrap { overflow-x: auto; }

  .pm-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
    min-width: 560px;
  }

  .pm-table thead tr {
    background: linear-gradient(90deg, var(--n800), var(--n600));
  }

  .pm-table th {
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

  .pm-table th.text-c { text-align: center; }

  .pm-table tbody tr {
    border-bottom: 1px solid var(--gray-100);
    transition: background 0.15s;
  }

  .pm-table tbody tr:last-child { border-bottom: none; }
  .pm-table tbody tr:hover { background: var(--n50); }

  .pm-table td {
    padding: 13px 16px;
    color: var(--gray-700);
    vertical-align: middle;
    border: none;
  }

  .pm-table td.text-c { text-align: center; }

  /* Row number badge */
  .pm-row-num {
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

  /* Mapel cell */
  .pm-mapel-cell {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .pm-mapel-icon {
    width: 34px; height: 34px;
    border-radius: 10px;
    background: linear-gradient(135deg, var(--n700), var(--n300));
    color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(29,78,216,0.2);
  }

  .pm-mapel-name {
    font-weight: 600;
    color: var(--gray-900);
    font-size: 13.5px;
  }

  /* Jurusan badge */
  .pm-jurusan-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--n50);
    color: var(--n400);
    border: 1px solid var(--n100);
    white-space: nowrap;
  }

  .pm-jurusan-badge i { font-size: 9px; }

  .pm-jurusan-wajib {
    background: var(--gray-100);
    color: var(--gray-500);
    border-color: var(--gray-200);
  }

  /* Actions */
  .pm-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
  }

  .pm-btn {
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

  .pm-btn-edit {
    background: var(--n50);
    border-color: var(--n100);
    color: var(--n400);
  }

  .pm-btn-edit:hover {
    background: #dbeafe;
    border-color: var(--n200);
    color: var(--n700);
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(59,130,246,0.15);
  }

  .pm-btn-delete {
    background: var(--red-bg);
    border-color: var(--red-bd);
    color: #b91c1c;
  }

  .pm-btn-delete:hover {
    background: #fecaca;
    border-color: #f87171;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(220,38,38,0.15);
  }

  /* Empty state */
  .pm-empty { text-align: center; padding: 56px 20px; }
  .pm-empty-icon { font-size: 48px; color: var(--gray-200); margin-bottom: 12px; display: block; }
  .pm-empty p { font-size: 14px; color: var(--gray-400); margin: 0; }

  /* Pagination */
  .pm-pagination {
    padding: 16px 20px;
    border-top: 1px solid var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    background: var(--gray-50);
  }

  .pm-pagination-info { font-size: 12.5px; color: var(--gray-400); }

  @media (max-width: 640px) {
    .pm-page { padding: 14px 12px; }
    .pm-toolbar-title { font-size: 14px; }
    .pm-btn-add span { display: none; }
  }
</style>

<div class="pm-page">
  <div class="max-w-6xl mx-auto">

    {{-- TOOLBAR --}}
    <div class="pm-toolbar">
      <div class="pm-toolbar-left">
        <span class="pm-toolbar-title">Daftar Mata Pelajaran</span>
        <span class="pm-toolbar-sub">Kelola data mata pelajaran yang tersedia di sistem</span>
      </div>
      <a href="{{ route('mapel.create') }}" class="pm-btn-add">
        <i class="fa-solid fa-plus"></i>
        <span>Tambah Mapel</span>
      </a>
    </div>

    {{-- CARD --}}
    <div class="pm-card">

      {{-- Alert sukses --}}
      @if(session('success'))
        <div class="pm-alert pm-alert-success">
          <i class="fa-solid fa-circle-check"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      {{-- Alert error --}}
      @if(session('error'))
        <div class="pm-alert pm-alert-error">
          <i class="fa-solid fa-circle-exclamation"></i>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      {{-- TABLE --}}
      <div class="pm-table-wrap">
        <table class="pm-table">
          <thead>
            <tr>
              <th class="text-c" style="width:52px;">#</th>
              <th>Nama Mapel</th>
              <th>Jurusan</th>
              <th class="text-c" style="width:160px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($mapels as $m)
              <tr>
                <td class="text-c">
                  <span class="pm-row-num">{{ $loop->iteration }}</span>
                </td>

                <td>
                  <div class="pm-mapel-cell">
                    <div class="pm-mapel-icon">
                      <i class="fa-solid fa-book-open"></i>
                    </div>
                    <span class="pm-mapel-name">{{ $m->nama_mapel }}</span>
                  </div>
                </td>

                <td>
                  @if($m->jurusan)
                    <span class="pm-jurusan-badge">
                      <i class="fa-solid fa-graduation-cap"></i>
                      {{ $m->jurusan->nama_jurusan }}
                    </span>
                  @else
                    <span class="pm-jurusan-badge pm-jurusan-wajib">
                      <i class="fa-solid fa-circle-check"></i>
                      Wajib Diampu
                    </span>
                  @endif
                </td>

                <td class="text-c">
                  <div class="pm-actions">
                    <a href="{{ route('mapel.edit', $m->id) }}" class="pm-btn pm-btn-edit">
                      <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                    <form action="{{ route('mapel.destroy', $m->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus mapel ini?')"
                          style="margin:0;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="pm-btn pm-btn-delete">
                        <i class="fa-solid fa-trash-can"></i> Hapus
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4">
                  <div class="pm-empty">
                    <i class="fa-solid fa-book-open pm-empty-icon"></i>
                    <p>Belum ada data mata pelajaran.</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Pagination --}}
      @if($mapels->hasPages())
        <div class="pm-pagination">
          <span class="pm-pagination-info">
            Menampilkan {{ $mapels->firstItem() }}–{{ $mapels->lastItem() }} dari {{ $mapels->total() }} mapel
          </span>
          <div>{{ $mapels->links() }}</div>
        </div>
      @endif

    </div>{{-- /.pm-card --}}
  </div>
</div>

</x-app-layout>