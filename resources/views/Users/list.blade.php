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
  .pu-page {
    padding: 24px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── TOOLBAR ── */
  .pu-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 16px;
    flex-wrap: wrap;
  }

  .pu-toolbar-left { display: flex; flex-direction: column; gap: 2px; }

  .pu-toolbar-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 16px;
    font-weight: 800;
    color: var(--gray-900);
  }

  .pu-toolbar-sub { font-size: 12px; color: var(--gray-400); }

  .pu-btn-add {
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

  .pu-btn-add:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.38);
  }

  /* ── CARD ── */
  .pu-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
  }

  /* ── ALERT — flush di bagian atas card, tanpa padding samping ── */
  .pu-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 20px;
    font-size: 13.5px;
    font-weight: 500;
    border-bottom: 1px solid;
    border-radius: 0;
  }

  .pu-alert i { font-size: 15px; flex-shrink: 0; margin-top: 1px; }

  .pu-alert-success {
    background: var(--green-bg);
    border-color: var(--green-bd);
    color: var(--green-tx);
  }

  .pu-alert-error {
    background: var(--red-bg);
    border-color: var(--red-bd);
    color: var(--red-tx);
  }

  /* ── TABLE — langsung di dalam card, full width ── */
  .pu-table-wrap { overflow-x: auto; }

  .pu-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
    min-width: 640px;
  }

  .pu-table thead tr {
    background: linear-gradient(90deg, var(--n800), var(--n600));
  }

  .pu-table th {
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

  .pu-table th.text-c { text-align: center; }

  .pu-table tbody tr {
    border-bottom: 1px solid var(--gray-100);
    transition: background 0.15s;
  }

  .pu-table tbody tr:last-child { border-bottom: none; }
  .pu-table tbody tr:hover { background: var(--n50); }

  .pu-table td {
    padding: 13px 16px;
    color: var(--gray-700);
    vertical-align: middle;
    border: none;
  }

  .pu-table td.text-c { text-align: center; }

  .pu-row-num {
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

  .pu-user-cell { display: flex; align-items: center; gap: 10px; }

  .pu-avatar {
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

  .pu-user-name { font-weight: 600; color: var(--gray-900); font-size: 13.5px; }

  .pu-mono {
    font-size: 12.5px;
    color: var(--gray-500);
    font-family: 'DM Mono', 'Courier New', monospace;
    background: var(--gray-100);
    padding: 3px 8px;
    border-radius: 6px;
    display: inline-block;
  }

  .pu-roles { display: flex; flex-wrap: wrap; gap: 5px; justify-content: center; }

  .pu-role-badge {
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

  .pu-role-badge i { font-size: 9px; }

  .pu-actions { display: flex; align-items: center; justify-content: center; gap: 6px; }

  .pu-btn {
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

  .pu-btn-edit { background: var(--n50); border-color: var(--n100); color: var(--n400); }
  .pu-btn-edit:hover {
    background: #dbeafe; border-color: var(--n200); color: var(--n700);
    transform: translateY(-1px); box-shadow: 0 2px 8px rgba(59,130,246,0.15);
  }

  .pu-btn-delete { background: var(--red-bg); border-color: var(--red-bd); color: #b91c1c; }
  .pu-btn-delete:hover {
    background: #fecaca; border-color: #f87171;
    transform: translateY(-1px); box-shadow: 0 2px 8px rgba(220,38,38,0.15);
  }

  .pu-empty { text-align: center; padding: 56px 20px; }
  .pu-empty-icon { font-size: 48px; color: var(--gray-200); margin-bottom: 12px; display: block; }
  .pu-empty p { font-size: 14px; color: var(--gray-400); margin: 0; }

  .pu-pagination {
    padding: 16px 20px;
    border-top: 1px solid var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    background: var(--gray-50);
  }

  .pu-pagination-info { font-size: 12.5px; color: var(--gray-400); }

  @media (max-width: 640px) {
    .pu-page { padding: 14px 12px; }
    .pu-toolbar-title { font-size: 14px; }
    .pu-btn-add span { display: none; }
  }
</style>

<div class="pu-page">
  <div class="max-w-6xl mx-auto">

    {{-- TOOLBAR --}}
    <div class="pu-toolbar">
      <div class="pu-toolbar-left">
        <span class="pu-toolbar-title">Daftar Pengguna</span>
        <span class="pu-toolbar-sub">Kelola akun dan hak akses pengguna sistem</span>
      </div>
      @can('create users')
        <a href="{{ route('users.create') }}" class="pu-btn-add">
          <i class="fa-solid fa-user-plus"></i>
          <span>Tambah User</span>
        </a>
      @endcan
    </div>

    {{-- CARD --}}
    <div class="pu-card">

      {{-- Alert sukses --}}
      @if(session('berhasil'))
        <div class="pu-alert pu-alert-success">
          <i class="fa-solid fa-circle-check"></i>
          <span>{{ session('berhasil') }}</span>
        </div>
      @endif

      {{-- Alert error --}}
      @if(session('error'))
        <div class="pu-alert pu-alert-error">
          <i class="fa-solid fa-circle-exclamation"></i>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      {{-- Tabel full width, langsung di card --}}
      <div class="pu-table-wrap">
        <table class="pu-table">
          <thead>
            <tr>
              <th class="text-c" style="width:52px;">#</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Email</th>
              <th class="text-c">Role</th>
              <th class="text-c" style="width:160px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($users as $index => $user)
              <tr>
                <td class="text-c">
                  <span class="pu-row-num">{{ $users->firstItem() + $index }}</span>
                </td>

                <td>
                  <div class="pu-user-cell">
                    <div class="pu-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                    <span class="pu-user-name">{{ $user->name }}</span>
                  </div>
                </td>

                <td><span class="pu-mono">{{ $user->username }}</span></td>

                <td><span class="pu-mono">{{ $user->email }}</span></td>

                <td class="text-c">
                  <div class="pu-roles">
                    @forelse ($user->roles as $role)
                      <span class="pu-role-badge">
                        <i class="fa-solid fa-shield-halved"></i>
                        {{ $role->name }}
                      </span>
                    @empty
                      <span style="font-size:12px; color:var(--gray-400); font-style:italic;">Tidak ada role</span>
                    @endforelse
                  </div>
                </td>

                <td class="text-c">
                  <div class="pu-actions">
                    @can('edit users')
                      <a href="{{ route('users.edit', $user->id) }}" class="pu-btn pu-btn-edit">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                      </a>
                    @endcan
                    @can('delete users')
                      <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus user ini?')" style="margin:0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="pu-btn pu-btn-delete">
                          <i class="fa-solid fa-trash-can"></i> Hapus
                        </button>
                      </form>
                    @endcan
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6">
                  <div class="pu-empty">
                    <i class="fa-solid fa-users-slash pu-empty-icon"></i>
                    <p>Belum ada data pengguna.</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Pagination --}}
      @if($users->hasPages())
      <div class="pu-pagination">
        <span class="pu-pagination-info">
          Menampilkan {{ $users->firstItem() }}–{{ $users->lastItem() }} dari {{ $users->total() }} pengguna
        </span>
        <div>{{ $users->links() }}</div>
      </div>
      @endif

    </div>{{-- /.pu-card --}}
  </div>
</div>

</x-app-layout>