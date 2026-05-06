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
  .pg-page {
    padding: 24px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── TOOLBAR ── */
  .pg-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 16px;
    flex-wrap: wrap;
  }

  .pg-toolbar-left { display: flex; flex-direction: column; gap: 2px; }

  .pg-toolbar-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 16px;
    font-weight: 800;
    color: var(--gray-900);
  }

  .pg-toolbar-sub { font-size: 12px; color: var(--gray-400); }

  .pg-btn-add {
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

  .pg-btn-add:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.38);
  }

  /* ── SEARCH BAR ── */
  .pg-search-wrap {
    display: flex;
    align-items: center;
    gap: 0;
    margin-bottom: 16px;
    max-width: 420px;
  }

  .pg-search-input-wrap {
    position: relative;
    flex: 1;
  }

  .pg-search-icon {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 13px;
    color: var(--gray-400);
    pointer-events: none;
  }

  .pg-search-input {
    width: 100%;
    padding: 10px 14px 10px 36px;
    background: #fff;
    border: 1.5px solid var(--gray-200);
    border-right: none;
    border-radius: 10px 0 0 10px;
    font-family: 'DM Sans', sans-serif;
    font-size: 13.5px;
    color: var(--gray-900);
    transition: all 0.2s ease;
    box-sizing: border-box;
    outline: none;
  }

  .pg-search-input:focus {
    border-color: var(--n300);
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
    z-index: 1;
    position: relative;
  }

  .pg-search-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 16px;
    background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border: none;
    border-radius: 0 10px 10px 0;
    color: #fff;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
  }

  .pg-search-btn:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
  }

  /* ── CARD ── */
  .pg-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
  }

  /* ── ALERT ── */
  .pg-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 20px;
    font-size: 13.5px;
    font-weight: 500;
    border-bottom: 1px solid;
    border-radius: 0;
  }

  .pg-alert i { font-size: 15px; flex-shrink: 0; margin-top: 1px; }

  .pg-alert-success {
    background: var(--green-bg);
    border-color: var(--green-bd);
    color: var(--green-tx);
  }

  .pg-alert-error {
    background: var(--red-bg);
    border-color: var(--red-bd);
    color: var(--red-tx);
  }

  /* ── TABLE ── */
  .pg-table-wrap { overflow-x: auto; }

  .pg-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
    min-width: 680px;
  }

  .pg-table thead tr {
    background: linear-gradient(90deg, var(--n800), var(--n600));
  }

  .pg-table th {
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

  .pg-table th.text-c { text-align: center; }

  .pg-table tbody tr {
    border-bottom: 1px solid var(--gray-100);
    transition: background 0.15s;
  }

  .pg-table tbody tr:last-child { border-bottom: none; }
  .pg-table tbody tr:hover { background: var(--n50); }

  .pg-table td {
    padding: 13px 16px;
    color: var(--gray-700);
    vertical-align: middle;
    border: none;
  }

  .pg-table td.text-c { text-align: center; }

  /* Row number */
  .pg-row-num {
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

  /* Guru cell (nama + avatar) */
  .pg-guru-cell {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .pg-avatar {
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

  .pg-guru-name {
    font-weight: 600;
    color: var(--gray-900);
    font-size: 13.5px;
  }

  /* NIP mono */
  .pg-mono {
    font-size: 12.5px;
    color: var(--gray-500);
    font-family: 'DM Mono', 'Courier New', monospace;
    background: var(--gray-100);
    padding: 3px 8px;
    border-radius: 6px;
    display: inline-block;
  }

  /* Mapel badge */
  .pg-mapel-badge {
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

  .pg-mapel-badge i { font-size: 9px; }

  .pg-mapel-empty {
    font-size: 12px;
    color: var(--gray-400);
    font-style: italic;
  }

  /* Gender badge */
  .pg-gender-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    white-space: nowrap;
  }

  .pg-gender-l {
    background: #eff6ff;
    color: #1d4ed8;
    border: 1px solid #bfdbfe;
  }

  .pg-gender-p {
    background: #fdf2f8;
    color: #9d174d;
    border: 1px solid #fbcfe8;
  }

  .pg-gender-badge i { font-size: 10px; }

  /* Actions */
  .pg-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
  }

  .pg-btn {
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

  .pg-btn-edit {
    background: var(--n50);
    border-color: var(--n100);
    color: var(--n400);
  }

  .pg-btn-edit:hover {
    background: #dbeafe;
    border-color: var(--n200);
    color: var(--n700);
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(59,130,246,0.15);
  }

  .pg-btn-delete {
    background: var(--red-bg);
    border-color: var(--red-bd);
    color: #b91c1c;
  }

  .pg-btn-delete:hover {
    background: #fecaca;
    border-color: #f87171;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(220,38,38,0.15);
  }

  /* Empty */
  .pg-empty { text-align: center; padding: 56px 20px; }
  .pg-empty-icon { font-size: 48px; color: var(--gray-200); margin-bottom: 12px; display: block; }
  .pg-empty p { font-size: 14px; color: var(--gray-400); margin: 0; }

  /* Pagination */
  .pg-pagination {
    padding: 16px 20px;
    border-top: 1px solid var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    background: var(--gray-50);
  }

  .pg-pagination-info { font-size: 12.5px; color: var(--gray-400); }

  @media (max-width: 640px) {
    .pg-page { padding: 14px 12px; }
    .pg-toolbar-title { font-size: 14px; }
    .pg-btn-add span { display: none; }
    .pg-search-wrap { max-width: 100%; }
  }
</style>

<div class="pg-page">
  <div class="max-w-6xl mx-auto">

    {{-- TOOLBAR --}}
    <div class="pg-toolbar">
      <div class="pg-toolbar-left">
        <span class="pg-toolbar-title">Daftar Guru</span>
        <span class="pg-toolbar-sub">Kelola data guru dan informasi pengajar di sistem</span>
      </div>
      <a href="{{ route('guru.create') }}" class="pg-btn-add">
        <i class="fa-solid fa-user-plus"></i>
        <span>Tambah Guru</span>
      </a>
    </div>

    {{-- SEARCH BAR --}}
    <form method="GET" action="{{ route('guru.index') }}">
      <div class="pg-search-wrap">
        <div class="pg-search-input-wrap">
          <i class="fa-solid fa-magnifying-glass pg-search-icon"></i>
          <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama atau NIP..."
            class="pg-search-input"
          >
        </div>
        <button type="submit" class="pg-search-btn">
          <i class="fa-solid fa-magnifying-glass"></i>
          Cari
        </button>
      </div>
    </form>

    {{-- CARD --}}
    <div class="pg-card">

      {{-- Alert sukses --}}
      @if(session('success'))
        <div class="pg-alert pg-alert-success">
          <i class="fa-solid fa-circle-check"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      {{-- Alert error --}}
      @if(session('error'))
        <div class="pg-alert pg-alert-error">
          <i class="fa-solid fa-circle-exclamation"></i>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      {{-- TABLE --}}
      <div class="pg-table-wrap">
        <table class="pg-table">
          <thead>
            <tr>
              <th class="text-c" style="width:52px;">#</th>
              <th>Nama</th>
              <th>NIP</th>
              <th>Mapel</th>
              <th class="text-c">Jenis Kelamin</th>
              <th class="text-c" style="width:160px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($guru as $index => $item)
              <tr>
                <td class="text-c">
                  <span class="pg-row-num">{{ $guru->firstItem() + $index }}</span>
                </td>

                <td>
                  <div class="pg-guru-cell">
                    <div class="pg-avatar">{{ strtoupper(substr($item->name, 0, 1)) }}</div>
                    <span class="pg-guru-name">{{ $item->name }}</span>
                  </div>
                </td>

                <td><span class="pg-mono">{{ $item->username }}</span></td>

                <td>
                  @if($item->guru?->mapel?->nama_mapel)
                    <span class="pg-mapel-badge">
                      <i class="fa-solid fa-book-open"></i>
                      {{ $item->guru->mapel->nama_mapel }}
                    </span>
                  @else
                    <span class="pg-mapel-empty">—</span>
                  @endif
                </td>

                <td class="text-c">
                  @php $jk = $item->guru->jenis_kelamin ?? null; @endphp
                  @if($jk === 'Laki-laki' || $jk === 'L')
                    <span class="pg-gender-badge pg-gender-l">
                      <i class="fa-solid fa-mars"></i> Laki-laki
                    </span>
                  @elseif($jk === 'Perempuan' || $jk === 'P')
                    <span class="pg-gender-badge pg-gender-p">
                      <i class="fa-solid fa-venus"></i> Perempuan
                    </span>
                  @else
                    <span class="pg-mapel-empty">—</span>
                  @endif
                </td>

                <td class="text-c">
                  <div class="pg-actions">
                    <a href="{{ route('guru.edit', $item->id) }}" class="pg-btn pg-btn-edit">
                      <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                    <form action="{{ route('guru.destroy', $item->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus data guru ini?')"
                          style="margin:0;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="pg-btn pg-btn-delete">
                        <i class="fa-solid fa-trash-can"></i> Hapus
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6">
                  <div class="pg-empty">
                    <i class="fa-solid fa-chalkboard-user pg-empty-icon"></i>
                    <p>Belum ada data guru.</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Pagination --}}
      @if($guru->hasPages())
        <div class="pg-pagination">
          <span class="pg-pagination-info">
            Menampilkan {{ $guru->firstItem() }}–{{ $guru->lastItem() }} dari {{ $guru->total() }} guru
          </span>
          <div>{{ $guru->links() }}</div>
        </div>
      @endif

    </div>{{-- /.pg-card --}}
  </div>
</div>

</x-app-layout>