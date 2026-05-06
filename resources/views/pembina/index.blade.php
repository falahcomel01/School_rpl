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
  .pb-page {
    padding: 24px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── TOOLBAR ── */
  .pb-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 16px;
    flex-wrap: wrap;
  }

  .pb-toolbar-left {
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .pb-toolbar-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 16px;
    font-weight: 800;
    color: var(--gray-900);
  }

  .pb-toolbar-sub {
    font-size: 12px;
    color: var(--gray-400);
  }

  .pb-btn-add {
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

  .pb-btn-add:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.38);
  }

  /* ── CARD ── */
  .pb-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
  }

  /* ── ALERT ── */
  .pb-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 20px;
    font-size: 13.5px;
    font-weight: 500;
    border-bottom: 1px solid;
    border-radius: 0;
  }

  .pb-alert i { font-size: 15px; flex-shrink: 0; margin-top: 1px; }

  .pb-alert-success {
    background: var(--green-bg);
    border-color: var(--green-bd);
    color: var(--green-tx);
  }

  .pb-alert-error {
    background: var(--red-bg);
    border-color: var(--red-bd);
    color: var(--red-tx);
  }

  /* ── SEARCH BAR ── */
  .pb-search-bar {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 16px 20px;
    border-bottom: 1px solid var(--gray-100);
    background: var(--gray-50);
    flex-wrap: wrap;
  }

  .pb-search-wrap {
    position: relative;
    flex: 1;
    min-width: 200px;
    max-width: 400px;
  }

  .pb-search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 12px;
    color: var(--gray-400);
    pointer-events: none;
  }

  .pb-search-input {
    width: 100%;
    padding: 9px 14px 9px 34px;
    background: #fff;
    border: 1.5px solid var(--gray-200);
    border-radius: 9px;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    color: var(--gray-900);
    transition: all 0.2s ease;
    box-sizing: border-box;
  }

  .pb-search-input:focus {
    outline: none;
    border-color: var(--n300);
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
  }

  .pb-search-input::placeholder { color: var(--gray-400); }

  .pb-btn-search {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 9px 16px;
    background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border: none;
    border-radius: 9px;
    color: #fff;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
  }

  .pb-btn-search:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
  }

  .pb-btn-reset {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 9px 14px;
    background: #fff;
    border: 1.5px solid var(--gray-200);
    border-radius: 9px;
    color: var(--gray-500);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
  }

  .pb-btn-reset:hover {
    background: var(--gray-100);
    border-color: var(--gray-400);
    color: var(--gray-700);
  }

  /* ── TABLE ── */
  .pb-table-wrap { overflow-x: auto; }

  .pb-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
    min-width: 640px;
  }

  .pb-table thead tr {
    background: linear-gradient(90deg, var(--n800), var(--n600));
  }

  .pb-table th {
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

  .pb-table th.text-c { text-align: center; }

  .pb-table tbody tr {
    border-bottom: 1px solid var(--gray-100);
    transition: background 0.15s;
  }

  .pb-table tbody tr:last-child { border-bottom: none; }
  .pb-table tbody tr:hover { background: var(--n50); }

  .pb-table td {
    padding: 13px 16px;
    color: var(--gray-700);
    vertical-align: middle;
    border: none;
  }

  .pb-table td.text-c { text-align: center; }

  /* Row number */
  .pb-row-num {
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

  /* User cell */
  .pb-user-cell { display: flex; align-items: center; gap: 10px; }

  .pb-avatar {
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

  .pb-user-name {
    font-weight: 600;
    color: var(--gray-900);
    font-size: 13.5px;
  }

  /* Mono badge */
  .pb-mono {
    font-size: 12.5px;
    color: var(--gray-500);
    font-family: 'DM Mono', 'Courier New', monospace;
    background: var(--gray-100);
    padding: 3px 8px;
    border-radius: 6px;
    display: inline-block;
  }

  /* Gender badge */
  .pb-gender-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    white-space: nowrap;
  }

  .pb-gender-badge.laki {
    background: #dbeafe;
    color: #1e40af;
    border: 1px solid #bfdbfe;
  }

  .pb-gender-badge.perempuan {
    background: #fce7f3;
    color: #9d174d;
    border: 1px solid #fbcfe8;
  }

  .pb-gender-badge.unknown {
    background: var(--gray-100);
    color: var(--gray-400);
    border: 1px solid var(--gray-200);
    font-style: italic;
  }

  /* Action buttons */
  .pb-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
  }

  .pb-btn {
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

  .pb-btn-edit {
    background: var(--n50);
    border-color: var(--n100);
    color: var(--n400);
  }

  .pb-btn-edit:hover {
    background: #dbeafe;
    border-color: var(--n200);
    color: var(--n700);
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(59,130,246,0.15);
  }

  .pb-btn-delete {
    background: var(--red-bg);
    border-color: var(--red-bd);
    color: #b91c1c;
  }

  .pb-btn-delete:hover {
    background: #fecaca;
    border-color: #f87171;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(220,38,38,0.15);
  }

  /* Empty state */
  .pb-empty { text-align: center; padding: 56px 20px; }
  .pb-empty-icon { font-size: 48px; color: var(--gray-200); margin-bottom: 12px; display: block; }
  .pb-empty p { font-size: 14px; color: var(--gray-400); margin: 0; }
  .pb-empty-keyword {
    font-style: italic;
    color: var(--n400);
    font-weight: 600;
  }

  /* Pagination */
  .pb-pagination {
    padding: 16px 20px;
    border-top: 1px solid var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    background: var(--gray-50);
  }

  .pb-pagination-info { font-size: 12.5px; color: var(--gray-400); }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .pb-page { padding: 14px 12px; }
    .pb-toolbar-title { font-size: 14px; }
    .pb-btn-add span { display: none; }
    .pb-search-bar { flex-direction: column; align-items: stretch; }
    .pb-search-wrap { max-width: 100%; }
  }
</style>

<div class="pb-page">
  <div class="max-w-6xl mx-auto">

    {{-- ── TOOLBAR ── --}}
    <div class="pb-toolbar">
      <div class="pb-toolbar-left">
        <span class="pb-toolbar-title">Daftar Pembina Ekstra</span>
        <span class="pb-toolbar-sub">Kelola data dan informasi pembina ekstrakurikuler</span>
      </div>
      <a href="{{ route('pembina.create') }}" class="pb-btn-add">
        <i class="fa-solid fa-user-plus"></i>
        <span>Tambah Pembina</span>
      </a>
    </div>

    {{-- ── CARD ── --}}
    <div class="pb-card">

      {{-- Alert sukses --}}
      @if(session('success'))
        <div class="pb-alert pb-alert-success">
          <i class="fa-solid fa-circle-check"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      {{-- Alert error --}}
      @if(session('error'))
        <div class="pb-alert pb-alert-error">
          <i class="fa-solid fa-circle-exclamation"></i>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      {{-- ── SEARCH BAR ── --}}
      <div class="pb-search-bar">
        <form method="GET" action="{{ route('pembina.index') }}" style="display:flex; align-items:center; gap:8px; flex-wrap:wrap; width:100%;">
          <div class="pb-search-wrap">
            <i class="fa-solid fa-magnifying-glass pb-search-icon"></i>
            <input
              type="text"
              name="search"
              value="{{ request('search') }}"
              placeholder="Cari nama, username, atau email..."
              class="pb-search-input"
            >
          </div>
          <button type="submit" class="pb-btn-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            Cari
          </button>
          @if(request('search'))
            <a href="{{ route('pembina.index') }}" class="pb-btn-reset">
              <i class="fa-solid fa-xmark"></i>
              Reset
            </a>
          @endif
        </form>
      </div>

      {{-- ── TABLE ── --}}
      <div class="pb-table-wrap">
        <table class="pb-table">
          <thead>
            <tr>
              <th class="text-c" style="width:52px;">#</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Email</th>
              <th class="text-c">Jenis Kelamin</th>
              <th class="text-c" style="width:160px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($pembina as $index => $item)
              <tr>
                <td class="text-c">
                  <span class="pb-row-num">{{ $pembina->firstItem() + $index }}</span>
                </td>

                <td>
                  <div class="pb-user-cell">
                    <div class="pb-avatar">{{ strtoupper(substr($item->name, 0, 1)) }}</div>
                    <span class="pb-user-name">{{ $item->name }}</span>
                  </div>
                </td>

                <td><span class="pb-mono">{{ $item->username }}</span></td>

                <td>
                  @if($item->email)
                    <span class="pb-mono">{{ $item->email }}</span>
                  @else
                    <span style="font-size:12px; color:var(--gray-400); font-style:italic;">—</span>
                  @endif
                </td>

                <td class="text-c">
                  @php $jk = $item->pembina->jenis_kelamin ?? null; @endphp
                  @if($jk === 'Laki-laki')
                    <span class="pb-gender-badge laki">
                      <i class="fa-solid fa-mars"></i> Laki-laki
                    </span>
                  @elseif($jk === 'Perempuan')
                    <span class="pb-gender-badge perempuan">
                      <i class="fa-solid fa-venus"></i> Perempuan
                    </span>
                  @else
                    <span class="pb-gender-badge unknown">—</span>
                  @endif
                </td>

                <td class="text-c">
                  <div class="pb-actions">
                    <a href="{{ route('pembina.edit', $item->id) }}" class="pb-btn pb-btn-edit">
                      <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                    <form action="{{ route('pembina.destroy', $item->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus pembina ini?')" style="margin:0;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="pb-btn pb-btn-delete">
                        <i class="fa-solid fa-trash-can"></i> Hapus
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6">
                  <div class="pb-empty">
                    <i class="fa-solid fa-user-slash pb-empty-icon"></i>
                    @if(request('search'))
                      <p>Tidak ada pembina ditemukan dengan kata kunci
                        <span class="pb-empty-keyword">"{{ request('search') }}"</span>.
                      </p>
                    @else
                      <p>Belum ada data pembina.</p>
                    @endif
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- ── PAGINATION ── --}}
      @if($pembina->hasPages())
        <div class="pb-pagination">
          <span class="pb-pagination-info">
            Menampilkan {{ $pembina->firstItem() }}–{{ $pembina->lastItem() }}
            dari {{ $pembina->total() }} pembina
          </span>
          <div>{{ $pembina->appends(['search' => request('search')])->links() }}</div>
        </div>
      @endif

    </div>{{-- /.pb-card --}}
  </div>
</div>

</x-app-layout>