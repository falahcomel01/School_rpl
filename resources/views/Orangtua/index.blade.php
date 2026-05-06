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
  .ot-page {
    padding: 24px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── TOOLBAR ── */
  .ot-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 16px;
    flex-wrap: wrap;
  }

  .ot-toolbar-left { display: flex; flex-direction: column; gap: 2px; }

  .ot-toolbar-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 16px;
    font-weight: 800;
    color: var(--gray-900);
  }

  .ot-toolbar-sub { font-size: 12px; color: var(--gray-400); }

  .ot-btn-add {
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

  .ot-btn-add:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.38);
  }

  /* ── CARD ── */
  .ot-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
  }

  /* ── ALERT ── */
  .ot-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 20px;
    font-size: 13.5px;
    font-weight: 500;
    border-bottom: 1px solid;
  }

  .ot-alert i { font-size: 15px; flex-shrink: 0; margin-top: 1px; }

  .ot-alert-success {
    background: var(--green-bg);
    border-color: var(--green-bd);
    color: var(--green-tx);
  }

  /* ── TABLE ── */
  .ot-table-wrap { overflow-x: auto; }

  .ot-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
    min-width: 680px;
  }

  .ot-table thead tr {
    background: linear-gradient(90deg, var(--n800), var(--n600));
  }

  .ot-table th {
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

  .ot-table th.text-c { text-align: center; }

  .ot-table tbody tr {
    border-bottom: 1px solid var(--gray-100);
    transition: background 0.15s;
  }

  .ot-table tbody tr:last-child { border-bottom: none; }
  .ot-table tbody tr:hover { background: var(--n50); }

  .ot-table td {
    padding: 13px 16px;
    color: var(--gray-700);
    vertical-align: middle;
    border: none;
  }

  .ot-table td.text-c { text-align: center; }

  /* Row number */
  .ot-row-num {
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
  .ot-user-cell { display: flex; align-items: center; gap: 10px; }

  .ot-avatar {
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

  .ot-user-name {
    font-weight: 600;
    color: var(--gray-900);
    font-size: 13.5px;
  }

  /* Mono badge */
  .ot-mono {
    font-size: 12.5px;
    color: var(--gray-500);
    font-family: 'DM Mono', 'Courier New', monospace;
    background: var(--gray-100);
    padding: 3px 8px;
    border-radius: 6px;
    display: inline-block;
  }

  /* Info badge (anak / kelas) */
  .ot-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11.5px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    white-space: nowrap;
  }

  .ot-badge-anak {
    background: #f0fdf4;
    color: #166534;
    border: 1px solid #bbf7d0;
  }

  .ot-badge-kelas {
    background: var(--n50);
    color: var(--n400);
    border: 1px solid var(--n100);
  }

  .ot-badge i { font-size: 9px; }

  /* Dash placeholder */
  .ot-dash { font-size: 12px; color: var(--gray-400); font-style: italic; }

  /* Action buttons */
  .ot-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
  }

  .ot-btn {
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

  .ot-btn-edit {
    background: var(--n50);
    border-color: var(--n100);
    color: var(--n400);
  }

  .ot-btn-edit:hover {
    background: #dbeafe;
    border-color: var(--n200);
    color: var(--n700);
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(59,130,246,0.15);
  }

  .ot-btn-delete {
    background: var(--red-bg);
    border-color: var(--red-bd);
    color: #b91c1c;
  }

  .ot-btn-delete:hover {
    background: #fecaca;
    border-color: #f87171;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(220,38,38,0.15);
  }

  /* Empty state */
  .ot-empty { text-align: center; padding: 56px 20px; }
  .ot-empty-icon { font-size: 48px; color: var(--gray-200); margin-bottom: 12px; display: block; }
  .ot-empty p { font-size: 14px; color: var(--gray-400); margin: 0; }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .ot-page { padding: 14px 12px; }
    .ot-toolbar-title { font-size: 14px; }
    .ot-btn-add span { display: none; }
  }
</style>

<div class="ot-page">
  <div class="max-w-6xl mx-auto">

    {{-- ── TOOLBAR ── --}}
    <div class="ot-toolbar">
      <div class="ot-toolbar-left">
        <span class="ot-toolbar-title">Data Orang Tua</span>
        <span class="ot-toolbar-sub">Kelola data orang tua dan relasi siswa</span>
      </div>
      <a href="{{ route('orangtua.create') }}" class="ot-btn-add">
        <i class="fa-solid fa-user-plus"></i>
        <span>Tambah Orang Tua</span>
      </a>
    </div>

    {{-- ── CARD ── --}}
    <div class="ot-card">

      {{-- Alert sukses --}}
      @if(session('success'))
        <div class="ot-alert ot-alert-success">
          <i class="fa-solid fa-circle-check"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      {{-- ── TABLE ── --}}
      <div class="ot-table-wrap">
        <table class="ot-table">
          <thead>
            <tr>
              <th class="text-c" style="width:52px;">#</th>
              <th>Nama Orang Tua</th>
              <th>Email</th>
              <th class="text-c">Anak</th>
              <th class="text-c">Kelas</th>
              <th class="text-c" style="width:160px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($orangtua as $ortu)
              <tr>
                <td class="text-c">
                  <span class="ot-row-num">{{ $loop->iteration }}</span>
                </td>

                <td>
                  @php $nama = $ortu->user->name ?? null; @endphp
                  @if($nama)
                    <div class="ot-user-cell">
                      <div class="ot-avatar">{{ strtoupper(substr($nama, 0, 1)) }}</div>
                      <span class="ot-user-name">{{ $nama }}</span>
                    </div>
                  @else
                    <span class="ot-dash">—</span>
                  @endif
                </td>

                <td>
                  @if($ortu->user->email ?? null)
                    <span class="ot-mono">{{ $ortu->user->email }}</span>
                  @else
                    <span class="ot-dash">—</span>
                  @endif
                </td>

                <td class="text-c">
                  @if($ortu->siswa->user->name ?? null)
                    <span class="ot-badge ot-badge-anak">
                      <i class="fa-solid fa-child"></i>
                      {{ $ortu->siswa->user->name }}
                    </span>
                  @else
                    <span class="ot-dash">—</span>
                  @endif
                </td>

                <td class="text-c">
                  @if($ortu->siswa->kelas->nama_kelas ?? null)
                    <span class="ot-badge ot-badge-kelas">
                      <i class="fa-solid fa-door-open"></i>
                      {{ $ortu->siswa->kelas->nama_kelas }}
                    </span>
                  @else
                    <span class="ot-dash">—</span>
                  @endif
                </td>

                <td class="text-c">
                  <div class="ot-actions">
                    <a href="{{ route('orangtua.edit', $ortu->id) }}" class="ot-btn ot-btn-edit">
                      <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                    <form action="{{ route('orangtua.destroy', $ortu->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus data ini?')" style="margin:0;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="ot-btn ot-btn-delete">
                        <i class="fa-solid fa-trash-can"></i> Hapus
                      </button>
                    </form>
                  </div>
                </td>

              </tr>
            @empty
              <tr>
                <td colspan="6">
                  <div class="ot-empty">
                    <i class="fa-solid fa-users-slash ot-empty-icon"></i>
                    <p>Belum ada data orang tua.</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>{{-- /.ot-card --}}
  </div>
</div>

</x-app-layout>