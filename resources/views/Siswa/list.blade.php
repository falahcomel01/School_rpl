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
    --teal-bg:  #ccfbf1;
    --teal-tx:  #134e4a;
    --teal-bd:  #5eead4;
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
  .ps-page {
    padding: 24px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── TOOLBAR ── */
  .ps-toolbar {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 16px;
    flex-wrap: wrap;
  }

  .ps-toolbar-left { display: flex; flex-direction: column; gap: 2px; }

  .ps-toolbar-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 16px;
    font-weight: 800;
    color: var(--gray-900);
  }

  .ps-toolbar-sub { font-size: 12px; color: var(--gray-400); }

  .ps-toolbar-right {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
  }

  /* ── BUTTONS ── */
  .ps-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 16px;
    border-radius: 10px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    text-decoration: none;
    border: 1.5px solid transparent;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
  }

  .ps-btn i { font-size: 11px; }

  .ps-btn-primary {
    background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border-color: var(--n400);
    color: #fff;
    box-shadow: 0 3px 12px rgba(29,78,216,0.28);
  }

  .ps-btn-primary:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.38);
  }

  .ps-btn-export {
    background: linear-gradient(135deg, #065f46, #10b981);
    border-color: #10b981;
    color: #fff;
    box-shadow: 0 3px 12px rgba(16,185,129,0.25);
  }

  .ps-btn-export:hover {
    background: linear-gradient(135deg, #064e3b, #059669);
    transform: translateY(-1px);
    box-shadow: 0 5px 16px rgba(16,185,129,0.35);
  }

  .ps-btn-import {
    background: #fff;
    border-color: var(--gray-200);
    color: var(--gray-700);
  }

  .ps-btn-import:hover {
    background: var(--gray-100);
    border-color: var(--gray-400);
    transform: translateY(-1px);
  }

  /* ── IMPORT FORM ── */
  .ps-import-wrap {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 7px 12px;
    background: var(--gray-50);
    border: 1.5px solid var(--gray-200);
    border-radius: 10px;
  }

  .ps-file-input {
    font-family: 'DM Sans', sans-serif;
    font-size: 12.5px;
    color: var(--gray-500);
    border: none;
    background: transparent;
    outline: none;
    max-width: 180px;
  }

  .ps-file-input::file-selector-button {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11.5px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 6px;
    border: 1.5px solid var(--n100);
    background: var(--n50);
    color: var(--n400);
    cursor: pointer;
    margin-right: 8px;
    transition: all 0.18s;
  }

  .ps-file-input::file-selector-button:hover {
    background: #dbeafe;
    border-color: var(--n200);
  }

  /* ── CARD ── */
  .ps-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
  }

  /* ── SEARCH BAR (inside card) ── */
  .ps-search-bar {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 14px 20px;
    border-bottom: 1px solid var(--gray-100);
    background: var(--gray-50);
  }

  .ps-search-wrap {
    position: relative;
    flex: 1;
    max-width: 320px;
  }

  .ps-search-icon {
    position: absolute;
    left: 11px; top: 50%;
    transform: translateY(-50%);
    font-size: 12px;
    color: var(--gray-400);
    pointer-events: none;
  }

  .ps-search-input {
    width: 100%;
    padding: 8px 12px 8px 32px;
    border: 1.5px solid var(--gray-200);
    border-radius: 9px;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    color: var(--gray-900);
    background: #fff;
    transition: all 0.2s;
    box-sizing: border-box;
  }

  .ps-search-input:focus {
    outline: none;
    border-color: var(--n300);
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
  }

  .ps-search-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 9px;
    background: linear-gradient(135deg, var(--n700), var(--n400));
    border: none;
    color: #fff;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
  }

  .ps-search-btn:hover {
    background: linear-gradient(135deg, var(--n600), var(--n300));
    transform: translateY(-1px);
  }

  /* ── ALERT ── */
  .ps-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 20px;
    font-size: 13.5px;
    font-weight: 500;
    border-bottom: 1px solid;
  }

  .ps-alert i { font-size: 15px; flex-shrink: 0; margin-top: 1px; }
  .ps-alert-success { background: var(--green-bg); border-color: var(--green-bd); color: var(--green-tx); }
  .ps-alert-error   { background: var(--red-bg);   border-color: var(--red-bd);   color: var(--red-tx); }

  /* ── TABLE ── */
  .ps-table-wrap { overflow-x: auto; }

  .ps-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
    min-width: 780px;
  }

  .ps-table thead tr {
    background: linear-gradient(90deg, var(--n800), var(--n600));
  }

  .ps-table th {
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

  .ps-table th.text-c { text-align: center; }

  .ps-table tbody tr {
    border-bottom: 1px solid var(--gray-100);
    transition: background 0.15s;
  }

  .ps-table tbody tr:last-child { border-bottom: none; }
  .ps-table tbody tr:hover { background: var(--n50); }

  .ps-table td {
    padding: 12px 16px;
    color: var(--gray-700);
    vertical-align: middle;
    border: none;
  }

  .ps-table td.text-c { text-align: center; }

  /* Row number */
  .ps-row-num {
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
  .ps-user-cell { display: flex; align-items: center; gap: 10px; }

  .ps-avatar {
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

  .ps-avatar-f {
    background: linear-gradient(135deg, #7c3aed, #a78bfa);
    box-shadow: 0 2px 8px rgba(124,58,237,0.2);
  }

  .ps-user-name { font-weight: 600; color: var(--gray-900); font-size: 13.5px; }

  /* Mono / badges */
  .ps-mono {
    font-size: 12.5px;
    color: var(--gray-500);
    font-family: 'DM Mono', 'Courier New', monospace;
    background: var(--gray-100);
    padding: 3px 8px;
    border-radius: 6px;
    display: inline-block;
  }

  .ps-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11.5px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    white-space: nowrap;
  }

  .ps-badge-kelas {
    background: var(--n50);
    color: var(--n400);
    border: 1px solid var(--n100);
  }

  .ps-badge-jurusan {
    background: var(--teal-bg);
    color: var(--teal-tx);
    border: 1px solid var(--teal-bd);
  }

  .ps-badge-lk {
    background: #eff6ff;
    color: #1d4ed8;
    border: 1px solid #bfdbfe;
  }

  .ps-badge-pr {
    background: #fdf2f8;
    color: #9d174d;
    border: 1px solid #fbcfe8;
  }

  /* Actions */
  .ps-actions { display: flex; align-items: center; justify-content: center; gap: 6px; }

  .ps-act-btn {
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

  .ps-act-edit { background: var(--n50); border-color: var(--n100); color: var(--n400); }
  .ps-act-edit:hover {
    background: #dbeafe; border-color: var(--n200); color: var(--n700);
    transform: translateY(-1px); box-shadow: 0 2px 8px rgba(59,130,246,0.15);
  }

  .ps-act-delete { background: var(--red-bg); border-color: var(--red-bd); color: #b91c1c; }
  .ps-act-delete:hover {
    background: #fecaca; border-color: #f87171;
    transform: translateY(-1px); box-shadow: 0 2px 8px rgba(220,38,38,0.15);
  }

  /* Empty state */
  .ps-empty { text-align: center; padding: 56px 20px; }
  .ps-empty-icon { font-size: 48px; color: var(--gray-200); margin-bottom: 12px; display: block; }
  .ps-empty p { font-size: 14px; color: var(--gray-400); margin: 0; }

  /* Pagination */
  .ps-pagination {
    padding: 16px 20px;
    border-top: 1px solid var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    background: var(--gray-50);
  }

  .ps-pagination-info { font-size: 12.5px; color: var(--gray-400); }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .ps-page { padding: 14px 12px; }
    .ps-toolbar { flex-direction: column; }
    .ps-toolbar-right { width: 100%; }
    .ps-import-wrap { flex-wrap: wrap; }
    .ps-file-input { max-width: 100%; }
  }
</style>

<div class="ps-page">
  <div class="max-w-6xl mx-auto">

    {{-- ── TOOLBAR ── --}}
    <div class="ps-toolbar">
      <div class="ps-toolbar-left">
        <span class="ps-toolbar-title">Daftar Siswa</span>
        <span class="ps-toolbar-sub">Kelola data siswa, kelas, dan jurusan</span>
      </div>

      <div class="ps-toolbar-right">

        {{-- Export --}}
        <a href="{{ route('siswa.export') }}" class="ps-btn ps-btn-export">
          <i class="fa-solid fa-file-arrow-down"></i>
          Export
        </a>

        {{-- Import --}}
        <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data"
              style="display:flex; align-items:center; gap:0;">
          @csrf
          <div class="ps-import-wrap">
            <i class="fa-solid fa-file-arrow-up" style="font-size:12px; color:var(--gray-400);"></i>
            <input type="file" name="file" required class="ps-file-input">
            <button type="submit" class="ps-btn ps-btn-import" style="padding:6px 12px;">
              <i class="fa-solid fa-upload"></i>
              Import
            </button>
          </div>
        </form>

        {{-- Tambah --}}
        @can('create siswa')
          <a href="{{ route('siswa.create') }}" class="ps-btn ps-btn-primary">
            <i class="fa-solid fa-user-plus"></i>
            Tambah Siswa
          </a>
        @endcan

      </div>
    </div>

    {{-- ── CARD ── --}}
    <div class="ps-card">

      {{-- Alert sukses --}}
      @if(session('success'))
        <div class="ps-alert ps-alert-success">
          <i class="fa-solid fa-circle-check"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      {{-- Alert error --}}
      @if(session('error'))
        <div class="ps-alert ps-alert-error">
          <i class="fa-solid fa-circle-exclamation"></i>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      {{-- Search bar --}}
      <form method="GET" class="ps-search-bar">
        <div class="ps-search-wrap">
          <i class="fa-solid fa-magnifying-glass ps-search-icon"></i>
          <input
            type="text"
            name="search"
            value="{{ $search }}"
            placeholder="Cari nama atau NIS..."
            class="ps-search-input"
          >
        </div>
        <button type="submit" class="ps-search-btn">
          <i class="fa-solid fa-magnifying-glass"></i>
          Cari
        </button>
      </form>

      {{-- Tabel --}}
      <div class="ps-table-wrap">
        <table class="ps-table">
          <thead>
            <tr>
              <th class="text-c" style="width:52px;">#</th>
              <th>Nama</th>
              <th>NIS</th>
              <th>Email</th>
              <th class="text-c">Kelas</th>
              <th class="text-c">Jurusan</th>
              <th class="text-c">Jenis Kelamin</th>
              @can('edit siswa')
                <th class="text-c" style="width:160px;">Aksi</th>
              @endcan
            </tr>
          </thead>
          <tbody>
            @forelse ($siswa as $index => $user)
              <tr>
                <td class="text-c">
                  <span class="ps-row-num">{{ $siswa->firstItem() + $index }}</span>
                </td>

                <td>
                  <div class="ps-user-cell">
                    <div class="ps-avatar {{ ($user->siswa?->jenis_kelamin === 'Perempuan') ? 'ps-avatar-f' : '' }}">
                      {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <span class="ps-user-name">{{ $user->name }}</span>
                  </div>
                </td>

                <td><span class="ps-mono">{{ $user->username }}</span></td>

                <td><span class="ps-mono">{{ $user->email ?? '-' }}</span></td>

                <td class="text-c">
                  @if($user->siswa?->kelas?->nama_kelas)
                    <span class="ps-badge ps-badge-kelas">
                      <i class="fa-solid fa-door-open" style="font-size:9px;"></i>
                      {{ $user->siswa->kelas->nama_kelas }}
                    </span>
                  @else
                    <span style="font-size:12px; color:var(--gray-400); font-style:italic;">-</span>
                  @endif
                </td>

                <td class="text-c">
                  @if($user->siswa?->kelas?->jurusan?->nama_jurusan)
                    <span class="ps-badge ps-badge-jurusan">
                      {{ $user->siswa->kelas->jurusan->nama_jurusan }}
                    </span>
                  @else
                    <span style="font-size:12px; color:var(--gray-400); font-style:italic;">-</span>
                  @endif
                </td>

                <td class="text-c">
                  @php $jk = $user->siswa?->jenis_kelamin; @endphp
                  @if($jk)
                    <span class="ps-badge {{ $jk === 'Perempuan' ? 'ps-badge-pr' : 'ps-badge-lk' }}">
                      <i class="fa-solid {{ $jk === 'Perempuan' ? 'fa-venus' : 'fa-mars' }}" style="font-size:9px;"></i>
                      {{ $jk }}
                    </span>
                  @else
                    <span style="font-size:12px; color:var(--gray-400); font-style:italic;">-</span>
                  @endif
                </td>

                @can('edit siswa')
                  <td class="text-c">
                    <div class="ps-actions">
                      <a href="{{ route('siswa.edit', $user->id) }}" class="ps-act-btn ps-act-edit">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                      </a>
                      @can('delete siswa')
                        <form action="{{ route('siswa.destroy', $user->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus siswa ini? Data tidak bisa dipulihkan!')"
                              style="margin:0;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="ps-act-btn ps-act-delete">
                            <i class="fa-solid fa-trash-can"></i> Hapus
                          </button>
                        </form>
                      @endcan
                    </div>
                  </td>
                @endcan

              </tr>
            @empty
              <tr>
                <td colspan="8">
                  <div class="ps-empty">
                    <i class="fa-solid fa-user-slash ps-empty-icon"></i>
                    <p>Tidak ada data siswa.</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Pagination --}}
      @if($siswa->hasPages())
        <div class="ps-pagination">
          <span class="ps-pagination-info">
            Menampilkan {{ $siswa->firstItem() }}–{{ $siswa->lastItem() }} dari {{ $siswa->total() }} siswa
          </span>
          <div>{{ $siswa->links() }}</div>
        </div>
      @endif

    </div>{{-- /.ps-card --}}
  </div>
</div>

</x-app-layout>