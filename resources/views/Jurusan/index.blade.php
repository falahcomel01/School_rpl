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
  .pj-page {
    padding: 24px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── TOOLBAR ── */
  .pj-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 16px;
    flex-wrap: wrap;
  }

  .pj-toolbar-left { display: flex; flex-direction: column; gap: 2px; }

  .pj-toolbar-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 16px;
    font-weight: 800;
    color: var(--gray-900);
  }

  .pj-toolbar-sub { font-size: 12px; color: var(--gray-400); }

  .pj-btn-add {
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

  .pj-btn-add:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.38);
  }

  /* ── CARD ── */
  .pj-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
  }

  /* ── ALERT ── */
  .pj-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 20px;
    font-size: 13.5px;
    font-weight: 500;
    border-bottom: 1px solid;
    border-radius: 0;
  }

  .pj-alert i { font-size: 15px; flex-shrink: 0; margin-top: 1px; }

  .pj-alert-success {
    background: var(--green-bg);
    border-color: var(--green-bd);
    color: var(--green-tx);
  }

  .pj-alert-error {
    background: var(--red-bg);
    border-color: var(--red-bd);
    color: var(--red-tx);
  }

  /* ── TABLE ── */
  .pj-table-wrap { overflow-x: auto; }

  .pj-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
    min-width: 480px;
  }

  .pj-table thead tr {
    background: linear-gradient(90deg, var(--n800), var(--n600));
  }

  .pj-table th {
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

  .pj-table th.text-c { text-align: center; }

  .pj-table tbody tr {
    border-bottom: 1px solid var(--gray-100);
    transition: background 0.15s;
  }

  .pj-table tbody tr:last-child { border-bottom: none; }
  .pj-table tbody tr:hover { background: var(--n50); }

  .pj-table td {
    padding: 13px 16px;
    color: var(--gray-700);
    vertical-align: middle;
    border: none;
  }

  .pj-table td.text-c { text-align: center; }

  /* Row number badge */
  .pj-row-num {
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

  /* Jurusan cell */
  .pj-jurusan-cell {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .pj-jurusan-icon {
    width: 34px; height: 34px;
    border-radius: 10px;
    background: linear-gradient(135deg, var(--n700), var(--n300));
    color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(29,78,216,0.2);
  }

  .pj-jurusan-name {
    font-weight: 600;
    color: var(--gray-900);
    font-size: 13.5px;
  }

  /* Actions */
  .pj-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
  }

  .pj-btn {
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

  .pj-btn-edit {
    background: var(--n50);
    border-color: var(--n100);
    color: var(--n400);
  }

  .pj-btn-edit:hover {
    background: #dbeafe;
    border-color: var(--n200);
    color: var(--n700);
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(59,130,246,0.15);
  }

  .pj-btn-delete {
    background: var(--red-bg);
    border-color: var(--red-bd);
    color: #b91c1c;
  }

  .pj-btn-delete:hover {
    background: #fecaca;
    border-color: #f87171;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(220,38,38,0.15);
  }

  /* Empty state */
  .pj-empty { text-align: center; padding: 56px 20px; }
  .pj-empty-icon { font-size: 48px; color: var(--gray-200); margin-bottom: 12px; display: block; }
  .pj-empty p { font-size: 14px; color: var(--gray-400); margin: 0; }

  /* Pagination */
  .pj-pagination {
    padding: 16px 20px;
    border-top: 1px solid var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    background: var(--gray-50);
  }

  .pj-pagination-info { font-size: 12.5px; color: var(--gray-400); }

  @media (max-width: 640px) {
    .pj-page { padding: 14px 12px; }
    .pj-toolbar-title { font-size: 14px; }
    .pj-btn-add span { display: none; }
  }
</style>

<div class="pj-page">
  <div class="max-w-6xl mx-auto">

    {{-- TOOLBAR --}}
    <div class="pj-toolbar">
      <div class="pj-toolbar-left">
        <span class="pj-toolbar-title">Daftar Jurusan</span>
        <span class="pj-toolbar-sub">Kelola data jurusan yang tersedia di sistem</span>
      </div>
      <a href="{{ route('jurusan.create') }}" class="pj-btn-add">
        <i class="fa-solid fa-plus"></i>
        <span>Tambah Jurusan</span>
      </a>
    </div>

    {{-- CARD --}}
    <div class="pj-card">

      {{-- Alert sukses --}}
      @if(session('success'))
        <div class="pj-alert pj-alert-success">
          <i class="fa-solid fa-circle-check"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      {{-- Alert error --}}
      @if(session('error'))
        <div class="pj-alert pj-alert-error">
          <i class="fa-solid fa-circle-exclamation"></i>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      {{-- TABLE --}}
      <div class="pj-table-wrap">
        <table class="pj-table">
          <thead>
            <tr>
              <th class="text-c" style="width:52px;">#</th>
              <th>Nama Jurusan</th>
              <th class="text-c" style="width:160px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($jurusan as $i => $j)
              <tr>
                <td class="text-c">
                  <span class="pj-row-num">{{ $loop->iteration }}</span>
                </td>

                <td>
                  <div class="pj-jurusan-cell">
                    <div class="pj-jurusan-icon">
                      <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <span class="pj-jurusan-name">{{ $j->nama_jurusan }}</span>
                  </div>
                </td>

                <td class="text-c">
                  <div class="pj-actions">
                    <a href="{{ route('jurusan.edit', $j->id) }}" class="pj-btn pj-btn-edit">
                      <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                    <form action="{{ route('jurusan.destroy', $j->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus jurusan ini?')"
                          style="margin:0;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="pj-btn pj-btn-delete">
                        <i class="fa-solid fa-trash-can"></i> Hapus
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="3">
                  <div class="pj-empty">
                    <i class="fa-solid fa-folder-open pj-empty-icon"></i>
                    <p>Belum ada data jurusan.</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Pagination --}}
      @if(method_exists($jurusan, 'hasPages') && $jurusan->hasPages())
        <div class="pj-pagination">
          <span class="pj-pagination-info">
            Menampilkan {{ $jurusan->firstItem() }}–{{ $jurusan->lastItem() }} dari {{ $jurusan->total() }} jurusan
          </span>
          <div>{{ $jurusan->links() }}</div>
        </div>
      @elseif(method_exists($jurusan, 'links') && !method_exists($jurusan, 'hasPages'))
        <div class="pj-pagination">
          <div>{{ $jurusan->links() }}</div>
        </div>
      @endif

    </div>{{-- /.pj-card --}}
  </div>
</div>

</x-app-layout>