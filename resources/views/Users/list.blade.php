<x-app-layout>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap');

  :root {
    --n900: #060f22;
    --n800: #0a1628;
    --n700: #0e1e3d;
    --n600: #112554;
    --n400: #1d4ed8;
    --n300: #3b82f6;
    --n200: #60a5fa;
    --n100: #bfdbfe;
    --n50:  #eff6ff;
    --teal: #0ea5e9;
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
    --shadow-sm: 0 1px 3px rgba(10,22,60,0.07);
    --shadow-md: 0 4px 16px rgba(10,22,60,0.10);
    --shadow-lg: 0 8px 32px rgba(10,22,60,0.15);
  }

  /* ── PAGE WRAPPER ── */
  .pu-page {
    padding: 28px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── CARD ── */
  .pu-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
  }

  /* ── CARD HEADER ── */
  .pu-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 22px 28px 20px;
    border-bottom: 1px solid var(--gray-100);
    background: linear-gradient(135deg, var(--n800) 0%, var(--n600) 100%);
    position: relative;
    overflow: hidden;
    gap: 16px;
    flex-wrap: wrap;
  }

  /* Decorative circles */
  .pu-card-header::before {
    content:'';
    position:absolute;
    top:-50px; right:-50px;
    width:180px; height:180px;
    border-radius:50%;
    background:rgba(59,130,246,0.1);
    pointer-events:none;
  }
  .pu-card-header::after {
    content:'';
    position:absolute;
    bottom:-30px; right:120px;
    width:110px; height:110px;
    border-radius:50%;
    background:rgba(14,165,233,0.07);
    pointer-events:none;
  }

  .pu-header-left {
    display: flex;
    align-items: center;
    gap: 14px;
    position: relative;
    z-index: 1;
  }

  .pu-header-icon {
    width: 44px; height: 44px;
    border-radius: 12px;
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.2);
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
    color: #fff;
    flex-shrink: 0;
  }

  .pu-header-text { display: flex; flex-direction: column; }

  .pu-header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
  }

  .pu-header-sub {
    font-size: 12px;
    color: rgba(191,219,254,0.75);
    margin-top: 3px;
  }

  .pu-btn-add {
    position: relative;
    z-index: 1;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 18px;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.3);
    border-radius: 10px;
    color: #fff;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s ease;
    backdrop-filter: blur(4px);
    white-space: nowrap;
  }

  .pu-btn-add:hover {
    background: rgba(255,255,255,0.25);
    border-color: rgba(255,255,255,0.5);
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(0,0,0,0.2);
  }

  .pu-btn-add i { font-size: 12px; }

  /* ── ALERTS ── */
  .pu-body { padding: 24px 28px; }

  .pu-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 13px 16px;
    border-radius: 10px;
    font-size: 13.5px;
    font-weight: 500;
    margin-bottom: 20px;
    border: 1px solid;
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

  /* ── TABLE WRAPPER ── */
  .pu-table-wrap {
    overflow-x: auto;
    border-radius: 12px;
    border: 1px solid var(--gray-200);
  }

  .pu-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
    min-width: 640px;
  }

  /* Head */
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

  /* Body rows */
  .pu-table tbody tr {
    border-bottom: 1px solid var(--gray-100);
    transition: background 0.15s;
  }

  .pu-table tbody tr:last-child { border-bottom: none; }
  .pu-table tbody tr:hover { background: var(--n50); }

  .pu-table td {
    padding: 14px 16px;
    color: var(--gray-700);
    vertical-align: middle;
    border: none;
  }

  .pu-table td.text-c { text-align: center; }

  /* Row number cell */
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

  /* User cell */
  .pu-user-cell {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .pu-avatar {
    width: 36px; height: 36px;
    border-radius: 10px;
    background: linear-gradient(135deg, var(--n700), var(--n300));
    color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px;
    font-weight: 800;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(29,78,216,0.22);
  }

  .pu-user-name {
    font-weight: 600;
    color: var(--gray-900);
    font-size: 13.5px;
  }

  /* Username / email */
  .pu-mono {
    font-size: 12.5px;
    color: var(--gray-500);
    font-family: 'DM Mono', 'Courier New', monospace;
    background: var(--gray-100);
    padding: 3px 8px;
    border-radius: 6px;
    display: inline-block;
  }

  /* Role badges */
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

  /* Action buttons */
  .pu-actions { display: flex; align-items: center; justify-content: center; gap: 7px; }

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
  }

  .pu-btn-edit {
    background: var(--n50);
    border-color: var(--n100);
    color: var(--n400);
  }

  .pu-btn-edit:hover {
    background: #dbeafe;
    border-color: var(--n200);
    color: var(--n700);
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(59,130,246,0.15);
  }

  .pu-btn-delete {
    background: var(--red-bg);
    border-color: var(--red-bd);
    color: #b91c1c;
  }

  .pu-btn-delete:hover {
    background: #fecaca;
    border-color: #f87171;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(220,38,38,0.15);
  }

  /* Empty state */
  .pu-empty {
    text-align: center;
    padding: 60px 20px;
  }

  .pu-empty-icon {
    font-size: 52px;
    color: var(--gray-200);
    margin-bottom: 14px;
    display: block;
  }

  .pu-empty p {
    font-size: 14px;
    color: var(--gray-400);
    margin: 0;
  }

  /* Pagination wrapper */
  .pu-pagination {
    padding: 18px 28px;
    border-top: 1px solid var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
  }

  .pu-pagination-info {
    font-size: 12.5px;
    color: var(--gray-400);
  }

  /* Override Laravel pagination to match theme */
  .pu-pagination nav { display: flex; align-items: center; }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .pu-page { padding: 16px 12px; }
    .pu-card-header, .pu-body { padding: 16px; }
    .pu-pagination { padding: 14px 16px; }
    .pu-header-title { font-size: 15px; }
    .pu-btn-add span { display: none; }
  }
</style>

<div class="pu-page">
  <div class="max-w-6xl mx-auto">
    <div class="pu-card">

      {{-- ── HEADER ── --}}
      <div class="pu-card-header">
        <div class="pu-header-left">
          <div class="pu-header-icon">
            <i class="fa-solid fa-users-gear"></i>
          </div>
          <div class="pu-header-text">
            <span class="pu-header-title">Daftar Pengguna</span>
            <span class="pu-header-sub">Kelola akun dan hak akses pengguna sistem</span>
          </div>
        </div>

        @can('create users')
          <a href="{{ route('users.create') }}" class="pu-btn-add">
            <i class="fa-solid fa-user-plus"></i>
            <span>Tambah User</span>
          </a>
        @endcan
      </div>

      {{-- ── BODY ── --}}
      <div class="pu-body">

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

        {{-- Table --}}
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
                  {{-- No --}}
                  <td class="text-c">
                    <span class="pu-row-num">{{ $users->firstItem() + $index }}</span>
                  </td>

                  {{-- Nama --}}
                  <td>
                    <div class="pu-user-cell">
                      <div class="pu-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                      <span class="pu-user-name">{{ $user->name }}</span>
                    </div>
                  </td>

                  {{-- Username --}}
                  <td><span class="pu-mono">{{ $user->username }}</span></td>

                  {{-- Email --}}
                  <td><span class="pu-mono">{{ $user->email }}</span></td>

                  {{-- Roles --}}
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

                  {{-- Aksi --}}
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

      </div>{{-- /.pu-body --}}

      {{-- ── PAGINATION ── --}}
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