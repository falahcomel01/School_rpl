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
    --gray-50:  #f8fafc;
    --gray-100: #f1f5f9;
    --gray-200: #e2e8f0;
    --gray-400: #94a3b8;
    --gray-500: #64748b;
    --gray-700: #334155;
    --gray-900: #0f172a;
    --red-bg:   #fee2e2;
    --red-tx:   #991b1b;
    --red-bd:   #fca5a5;
    --shadow-md: 0 4px 16px rgba(10,22,60,0.10);
  }

  /* ── PAGE ── */
  .rl-page {
    padding: 24px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── TOOLBAR ── */
  .rl-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 16px;
    flex-wrap: wrap;
  }

  .rl-toolbar-left { display: flex; flex-direction: column; gap: 2px; }

  .rl-toolbar-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 16px;
    font-weight: 800;
    color: var(--gray-900);
  }

  .rl-toolbar-sub { font-size: 12px; color: var(--gray-400); }

  .rl-btn-add {
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

  .rl-btn-add:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.38);
  }

  /* ── CARD ── */
  .rl-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
  }

  /* ── ALERT flush ── */
  .rl-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 20px;
    font-size: 13.5px;
    font-weight: 500;
    border-bottom: 1px solid;
    border-radius: 0;
  }

  .rl-alert i { font-size: 15px; flex-shrink: 0; margin-top: 1px; }

  .rl-alert-success {
    background: var(--green-bg);
    border-color: var(--green-bd);
    color: var(--green-tx);
  }

  /* ── TABLE full width ── */
  .rl-table-wrap { overflow-x: auto; }

  .rl-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
    min-width: 640px;
  }

  .rl-table thead tr {
    background: linear-gradient(90deg, var(--n800), var(--n600));
  }

  .rl-table th {
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

  .rl-table th.text-c { text-align: center; }

  .rl-table tbody tr {
    border-bottom: 1px solid var(--gray-100);
    transition: background 0.15s;
  }

  .rl-table tbody tr:last-child { border-bottom: none; }
  .rl-table tbody tr:hover { background: var(--n50); }

  .rl-table td {
    padding: 13px 16px;
    color: var(--gray-700);
    vertical-align: middle;
    border: none;
  }

  .rl-table td.text-c { text-align: center; }

  /* Row number */
  .rl-row-num {
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

  /* Role name cell */
  .rl-name-cell { display: flex; align-items: center; gap: 10px; }

  .rl-role-icon {
    width: 34px; height: 34px;
    border-radius: 10px;
    background: linear-gradient(135deg, var(--n700), var(--n300));
    display: flex; align-items: center; justify-content: center;
    font-size: 13px;
    color: #fff;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(29,78,216,0.2);
  }

  .rl-name-text {
    font-weight: 600;
    color: var(--gray-900);
    font-size: 13.5px;
    font-family: 'Plus Jakarta Sans', sans-serif;
  }

  /* Permission badges */
  .rl-perms { display: flex; flex-wrap: wrap; gap: 5px; }

  .rl-perm-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 9px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--n50);
    color: var(--n400);
    border: 1px solid var(--n100);
    white-space: nowrap;
  }

  .rl-perm-badge i { font-size: 9px; opacity: 0.7; }

  .rl-perm-more {
    display: inline-flex;
    align-items: center;
    padding: 3px 9px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--gray-100);
    color: var(--gray-500);
    border: 1px solid var(--gray-200);
  }

  /* Date mono */
  .rl-date {
    font-size: 12.5px;
    color: var(--gray-500);
    font-family: 'DM Mono', 'Courier New', monospace;
    background: var(--gray-100);
    padding: 3px 8px;
    border-radius: 6px;
    display: inline-block;
    white-space: nowrap;
  }

  /* Actions */
  .rl-actions { display: flex; align-items: center; justify-content: center; gap: 6px; }

  .rl-btn {
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

  .rl-btn-edit { background: var(--n50); border-color: var(--n100); color: var(--n400); }
  .rl-btn-edit:hover {
    background: #dbeafe; border-color: var(--n200); color: var(--n700);
    transform: translateY(-1px); box-shadow: 0 2px 8px rgba(59,130,246,0.15);
  }

  .rl-btn-delete { background: var(--red-bg); border-color: var(--red-bd); color: #b91c1c; }
  .rl-btn-delete:hover {
    background: #fecaca; border-color: #f87171;
    transform: translateY(-1px); box-shadow: 0 2px 8px rgba(220,38,38,0.15);
  }

  /* Empty state */
  .rl-empty { text-align: center; padding: 56px 20px; }
  .rl-empty-icon { font-size: 48px; color: var(--gray-200); margin-bottom: 12px; display: block; }
  .rl-empty p { font-size: 14px; color: var(--gray-400); margin: 0; }

  /* Pagination */
  .rl-pagination {
    padding: 16px 20px;
    border-top: 1px solid var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    background: var(--gray-50);
  }

  .rl-pagination-info { font-size: 12.5px; color: var(--gray-400); }

  @media (max-width: 640px) {
    .rl-page { padding: 14px 12px; }
    .rl-toolbar-title { font-size: 14px; }
    .rl-btn-add span { display: none; }
  }
</style>

<div class="rl-page">
  <div class="max-w-6xl mx-auto">

    {{-- TOOLBAR --}}
    <div class="rl-toolbar">
      <div class="rl-toolbar-left">
        <span class="rl-toolbar-title">Daftar Roles</span>
        <span class="rl-toolbar-sub">Kelola peran dan hak akses dalam sistem</span>
      </div>
      @can('create roles')
        <a href="{{ route('roles.create') }}" class="rl-btn-add">
          <i class="fa-solid fa-plus"></i>
          <span>Tambah Role</span>
        </a>
      @endcan
    </div>

    {{-- CARD --}}
    <div class="rl-card">

      {{-- Alert --}}
      @if(session('success'))
        <div class="rl-alert rl-alert-success">
          <i class="fa-solid fa-circle-check"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      {{-- Tabel full width langsung di card --}}
      <div class="rl-table-wrap">
        <table class="rl-table">
          <thead>
            <tr>
              <th class="text-c" style="width:52px;">#</th>
              <th>Nama Role</th>
              <th>Permissions</th>
              <th>Dibuat Pada</th>
              @canany(['edit roles','delete roles'])
                <th class="text-c" style="width:160px;">Aksi</th>
              @endcanany
            </tr>
          </thead>
          <tbody>
            @forelse ($roles as $role)
              <tr>
                <td class="text-c">
                  <span class="rl-row-num">{{ $loop->iteration }}</span>
                </td>

                <td>
                  <div class="rl-name-cell">
                    <div class="rl-role-icon">
                      <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <span class="rl-name-text">{{ $role->name }}</span>
                  </div>
                </td>

                <td>
                  @if($role->permissions->count())
                    <div class="rl-perms">
                      @foreach($role->permissions->take(4) as $perm)
                        <span class="rl-perm-badge">
                          <i class="fa-solid fa-key"></i>
                          {{ $perm->name }}
                        </span>
                      @endforeach
                      @if($role->permissions->count() > 4)
                        <span class="rl-perm-more">+{{ $role->permissions->count() - 4 }} lainnya</span>
                      @endif
                    </div>
                  @else
                    <span style="font-size:12px; color:var(--gray-400); font-style:italic;">Tidak ada permission</span>
                  @endif
                </td>

                <td>
                  <span class="rl-date">{{ optional($role->created_at)->format('Y-m-d H:i') }}</span>
                </td>

                @canany(['edit roles','delete roles'])
                  <td class="text-c">
                    <div class="rl-actions">
                      @can('edit roles')
                        <a href="{{ route('roles.edit', $role->id) }}" class="rl-btn rl-btn-edit">
                          <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                      @endcan
                      @can('delete roles')
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                              onsubmit="return confirm('Yakin menghapus role ini?')" style="margin:0;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="rl-btn rl-btn-delete">
                            <i class="fa-solid fa-trash-can"></i> Hapus
                          </button>
                        </form>
                      @endcan
                    </div>
                  </td>
                @endcanany
              </tr>
            @empty
              <tr>
                <td colspan="5">
                  <div class="rl-empty">
                    <i class="fa-solid fa-user-tag rl-empty-icon"></i>
                    <p>Belum ada data role.</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>{{-- /.rl-card --}}
  </div>
</div>

</x-app-layout>