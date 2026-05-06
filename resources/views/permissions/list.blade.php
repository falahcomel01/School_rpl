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
    --gray-300: #cbd5e1;
    --gray-400: #94a3b8;
    --gray-500: #64748b;
    --gray-700: #334155;
    --gray-900: #0f172a;
    --shadow-md: 0 4px 16px rgba(10,22,60,0.10);
  }

  /* ── PAGE ── */
  .pp-page {
    padding: 24px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── TOOLBAR ── */
  .pp-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 16px;
    flex-wrap: wrap;
  }

  .pp-toolbar-left { display: flex; flex-direction: column; gap: 2px; }

  .pp-toolbar-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 16px;
    font-weight: 800;
    color: var(--gray-900);
  }

  .pp-toolbar-sub { font-size: 12px; color: var(--gray-400); }

  .pp-btn-add {
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

  .pp-btn-add:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.38);
  }

  /* ── CARD ── */
  .pp-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
  }

  /* ── ALERTS ── */
  .pp-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 20px;
    font-size: 13.5px;
    font-weight: 500;
    border-bottom: 1px solid;
    border-radius: 0;
  }

  .pp-alert i { font-size: 15px; flex-shrink: 0; margin-top: 1px; }
  .pp-alert-success { background: var(--green-bg); border-color: var(--green-bd); color: var(--green-tx); }
  .pp-alert-error   { background: var(--red-bg);   border-color: var(--red-bd);   color: var(--red-tx); }

  /* ── SEARCH BAR ── */
  .pp-search-wrap {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 20px;
    border-bottom: 1px solid var(--gray-100);
    background: var(--gray-50);
  }

  .pp-search-inner {
    position: relative;
    flex: 1;
    max-width: 340px;
  }

  .pp-search-icon {
    position: absolute;
    left: 11px; top: 50%;
    transform: translateY(-50%);
    font-size: 12px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .pp-search-input {
    width: 100%;
    padding: 8px 12px 8px 32px;
    background: #fff;
    border: 1.5px solid var(--gray-200);
    border-radius: 9px;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    color: var(--gray-900);
    transition: all 0.2s ease;
    box-sizing: border-box;
  }

  .pp-search-input:focus {
    outline: none;
    border-color: var(--n300);
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
  }

  .pp-search-inner:focus-within .pp-search-icon { color: var(--n300); }

  .pp-search-count {
    font-size: 12px;
    color: var(--gray-400);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 600;
    white-space: nowrap;
  }

  /* ── TABLE ── */
  .pp-table-wrap { overflow-x: auto; }

  .pp-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
    min-width: 520px;
  }

  .pp-table thead tr {
    background: linear-gradient(90deg, var(--n800), var(--n600));
  }

  .pp-table th {
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

  .pp-table th.text-c { text-align: center; }

  .pp-table tbody tr {
    border-bottom: 1px solid var(--gray-100);
    transition: background 0.15s;
  }

  .pp-table tbody tr:last-child { border-bottom: none; }
  .pp-table tbody tr:hover { background: var(--n50); }
  .pp-table tbody tr.pp-row-hidden { display: none; }

  .pp-table td {
    padding: 13px 16px;
    color: var(--gray-700);
    vertical-align: middle;
    border: none;
  }

  .pp-table td.text-c { text-align: center; }

  /* ── ROW NUMBER ── */
  .pp-row-num {
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

  /* ── PERMISSION NAME CELL ── */
  .pp-perm-cell {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .pp-perm-icon {
    width: 32px; height: 32px;
    border-radius: 9px;
    background: var(--n50);
    border: 1px solid var(--n100);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px;
    color: var(--n400);
    flex-shrink: 0;
  }

  .pp-perm-name {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 700;
    color: var(--gray-900);
    font-size: 13px;
  }

  /* ── DATE BADGE ── */
  .pp-date {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 12.5px;
    color: var(--gray-500);
    font-family: 'DM Sans', sans-serif;
  }

  .pp-date i { font-size: 11px; color: var(--gray-400); }

  /* ── ACTION BUTTONS ── */
  .pp-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
  }

  .pp-btn {
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

  .pp-btn-edit { background: var(--n50); border-color: var(--n100); color: var(--n400); }
  .pp-btn-edit:hover {
    background: #dbeafe; border-color: var(--n200); color: var(--n700);
    transform: translateY(-1px); box-shadow: 0 2px 8px rgba(59,130,246,0.15);
  }

  .pp-btn-delete { background: var(--red-bg); border-color: var(--red-bd); color: #b91c1c; }
  .pp-btn-delete:hover {
    background: #fecaca; border-color: #f87171;
    transform: translateY(-1px); box-shadow: 0 2px 8px rgba(220,38,38,0.15);
  }

  /* ── EMPTY STATE ── */
  .pp-empty { text-align: center; padding: 56px 20px; }
  .pp-empty-icon { font-size: 48px; color: var(--gray-200); margin-bottom: 12px; display: block; }
  .pp-empty p { font-size: 14px; color: var(--gray-400); margin: 0 0 16px; }

  /* ── NO SEARCH RESULT ── */
  .pp-no-result {
    display: none;
    text-align: center;
    padding: 40px 20px;
  }

  .pp-no-result i { font-size: 32px; color: var(--gray-200); display: block; margin-bottom: 10px; }
  .pp-no-result p { font-size: 13.5px; color: var(--gray-400); margin: 0; }

  /* ── PAGINATION ── */
  .pp-pagination {
    padding: 16px 20px;
    border-top: 1px solid var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    background: var(--gray-50);
  }

  .pp-pagination-info { font-size: 12.5px; color: var(--gray-400); }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .pp-page { padding: 14px 12px; }
    .pp-toolbar-title { font-size: 14px; }
    .pp-btn-add span { display: none; }
    .pp-search-wrap { flex-direction: column; align-items: stretch; }
    .pp-search-inner { max-width: 100%; }
  }
</style>

<div class="pp-page">
  <div class="max-w-6xl mx-auto">

    {{-- ── TOOLBAR ── --}}
    <div class="pp-toolbar">
      <div class="pp-toolbar-left">
        <span class="pp-toolbar-title">Daftar Permission</span>
        <span class="pp-toolbar-sub">Kelola hak akses yang tersedia dalam sistem</span>
      </div>
      <a href="{{ route('permissions.create') }}" class="pp-btn-add">
        <i class="fa-solid fa-key"></i>
        <span>Tambah Permission</span>
      </a>
    </div>

    {{-- ── CARD ── --}}
    <div class="pp-card">

      {{-- Alerts --}}
      @if(session('success'))
        <div class="pp-alert pp-alert-success">
          <i class="fa-solid fa-circle-check"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      @if(session('error'))
        <div class="pp-alert pp-alert-error">
          <i class="fa-solid fa-circle-exclamation"></i>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      @if($permissions->count())

        {{-- ── SEARCH BAR ── --}}
        <div class="pp-search-wrap">
          <div class="pp-search-inner">
            <i class="fa-solid fa-magnifying-glass pp-search-icon"></i>
            <input
              type="text"
              id="permission-search"
              placeholder="Cari permission..."
              class="pp-search-input"
              autocomplete="off"
            >
          </div>
          <span class="pp-search-count" id="pp-count">
            {{ $permissions->total() }} permission
          </span>
        </div>

        {{-- ── TABLE ── --}}
        <div class="pp-table-wrap">
          <table class="pp-table">
            <thead>
              <tr>
                <th class="text-c" style="width:52px;">#</th>
                <th>Nama Permission</th>
                <th>Dibuat Pada</th>
                <th class="text-c" style="width:150px;">Aksi</th>
              </tr>
            </thead>
            <tbody id="permission-table-body">
              @foreach($permissions as $permission)
                <tr data-name="{{ $permission->name }}">
                  <td class="text-c">
                    <span class="pp-row-num">{{ $permissions->firstItem() + $loop->index }}</span>
                  </td>

                  <td>
                    <div class="pp-perm-cell">
                      <div class="pp-perm-icon">
                        <i class="fa-solid fa-key"></i>
                      </div>
                      <span class="pp-perm-name">{{ $permission->name }}</span>
                    </div>
                  </td>

                  <td>
                    <span class="pp-date">
                      <i class="fa-regular fa-calendar"></i>
                      {{ optional($permission->created_at)->format('d M Y, H:i') }}
                    </span>
                  </td>

                  <td class="text-c">
                    <div class="pp-actions">
                      <a href="{{ route('permissions.edit', $permission->id) }}" class="pp-btn pp-btn-edit">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                      </a>
                      <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus permission ini?')" style="margin:0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="pp-btn pp-btn-delete">
                          <i class="fa-solid fa-trash-can"></i> Hapus
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          {{-- No search result row --}}
          <div class="pp-no-result" id="pp-no-result">
            <i class="fa-solid fa-magnifying-glass"></i>
            <p>Tidak ada permission yang cocok dengan pencarian.</p>
          </div>
        </div>

        {{-- ── PAGINATION ── --}}
        @if($permissions->hasPages())
          <div class="pp-pagination">
            <span class="pp-pagination-info">
              Menampilkan {{ $permissions->firstItem() }}–{{ $permissions->lastItem() }} dari {{ $permissions->total() }} permission
            </span>
            <div>{{ $permissions->links() }}</div>
          </div>
        @endif

      @else

        {{-- ── EMPTY STATE ── --}}
        <div class="pp-empty">
          <i class="fa-solid fa-key pp-empty-icon"></i>
          <p>Belum ada data permission.</p>
          <a href="{{ route('permissions.create') }}" class="pp-btn-add">
            <i class="fa-solid fa-plus"></i>
            Tambah Permission
          </a>
        </div>

      @endif

    </div>{{-- /.pp-card --}}
  </div>
</div>

<script>
  // ── Pencarian Permission ──
  const searchInput = document.getElementById('permission-search');
  const tableBody   = document.getElementById('permission-table-body');
  const noResult    = document.getElementById('pp-no-result');
  const countEl     = document.getElementById('pp-count');
  const totalCount  = {{ $permissions->total() }};

  searchInput?.addEventListener('input', function () {
    const query = this.value.toLowerCase().trim();
    const rows  = tableBody?.querySelectorAll('tr') ?? [];
    let visible = 0;

    rows.forEach(row => {
      const name = (row.getAttribute('data-name') ?? '').toLowerCase();
      const match = name.includes(query);
      row.classList.toggle('pp-row-hidden', !match);
      if (match) visible++;
    });

    // Update count label
    if (countEl) {
      countEl.textContent = query
        ? `${visible} dari ${totalCount} permission`
        : `${totalCount} permission`;
    }

    // No result state
    if (noResult) {
      noResult.style.display = visible === 0 ? 'block' : 'none';
    }
  });
</script>

</x-app-layout>