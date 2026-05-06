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
    --gray-50:  #f8fafc;
    --gray-100: #f1f5f9;
    --gray-200: #e2e8f0;
    --gray-300: #cbd5e1;
    --gray-400: #94a3b8;
    --gray-500: #64748b;
    --gray-700: #334155;
    --gray-900: #0f172a;
    --green-bg: #d1fae5;
    --green-tx: #065f46;
    --green-bd: #6ee7b7;
    --red-bg:   #fee2e2;
    --red-tx:   #991b1b;
    --red-bd:   #fca5a5;
    --shadow-sm: 0 1px 3px rgba(10,22,60,0.07);
    --shadow-md: 0 4px 16px rgba(10,22,60,0.10);
    --shadow-lg: 0 8px 32px rgba(10,22,60,0.15);
  }

  /* ── PAGE ── */
  .er-page {
    padding: 28px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── CARD ── */
  .er-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    max-width: 820px;
    margin: 0 auto;
  }

  /* ── CARD HEADER ── */
  .er-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 28px 20px;
    border-bottom: 1px solid rgba(59,130,246,0.12);
    background: linear-gradient(135deg, var(--n800) 0%, var(--n600) 100%);
    position: relative;
    overflow: hidden;
  }

  .er-card-header::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(59,130,246,0.1);
    pointer-events: none;
  }

  .er-card-header::after {
    content: '';
    position: absolute;
    bottom: -30px; right: 120px;
    width: 110px; height: 110px;
    border-radius: 50%;
    background: rgba(14,165,233,0.07);
    pointer-events: none;
  }

  .er-header-icon {
    width: 44px; height: 44px;
    border-radius: 12px;
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.2);
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
    color: #fff;
    flex-shrink: 0;
    position: relative; z-index: 1;
  }

  .er-header-text {
    flex: 1;
    display: flex;
    flex-direction: column;
    position: relative; z-index: 1;
  }

  .er-header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
  }

  .er-header-sub {
    font-size: 12px;
    color: rgba(191,219,254,0.75);
    margin-top: 3px;
  }

  /* Role badge in header */
  .er-header-badge {
    position: relative; z-index: 1;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 14px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.18);
    border-radius: 10px;
    backdrop-filter: blur(4px);
  }

  .er-header-badge-avatar {
    width: 32px; height: 32px;
    border-radius: 9px;
    background: linear-gradient(135deg, var(--n400), var(--n200));
    display: flex; align-items: center; justify-content: center;
    font-size: 14px;
    color: #fff;
    flex-shrink: 0;
  }

  .er-header-badge-info { display: flex; flex-direction: column; }
  .er-header-badge-name { font-size: 12.5px; font-weight: 700; color: #fff; line-height: 1.2; }
  .er-header-badge-label { font-size: 10.5px; color: rgba(191,219,254,0.7); margin-top: 1px; }

  /* ── BODY ── */
  .er-body {
    padding: 28px 32px 32px;
  }

  /* ── ALERTS ── */
  .er-alert {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 12px 16px;
    border-radius: 10px;
    font-size: 13.5px;
    font-weight: 500;
    margin-bottom: 20px;
    border: 1px solid;
  }

  .er-alert i { font-size: 14px; flex-shrink: 0; margin-top: 1px; }
  .er-alert-success { background: var(--green-bg); border-color: var(--green-bd); color: var(--green-tx); }
  .er-alert-error   { background: var(--red-bg);   border-color: var(--red-bd);   color: var(--red-tx); }

  .er-alert-error ul { margin: 6px 0 0 0; padding: 0; list-style: none; display: flex; flex-direction: column; gap: 3px; }
  .er-alert-error ul li { font-size: 12.5px; display: flex; align-items: center; gap: 5px; }
  .er-alert-error ul li::before { content: '•'; font-size: 16px; line-height: 1; }

  /* ── SECTION ── */
  .er-section { margin-bottom: 24px; }

  .er-section-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--gray-100);
  }

  .er-section-label-icon {
    width: 26px; height: 26px;
    border-radius: 7px;
    background: var(--n50);
    border: 1px solid var(--n100);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px;
    color: var(--n400);
    flex-shrink: 0;
  }

  .er-section-label span {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--gray-400);
  }

  /* ── FORM GROUP ── */
  .er-form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 0; }

  .er-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--gray-700);
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .er-label-required { color: #ef4444; font-size: 13px; line-height: 1; }

  /* ── INPUT ── */
  .er-input-wrap { position: relative; }

  .er-input-icon {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 13px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .er-input {
    width: 100%;
    padding: 10px 14px 10px 36px;
    background: var(--gray-50);
    border: 1.5px solid var(--gray-200);
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-size: 13.5px;
    color: var(--gray-900);
    transition: all 0.2s ease;
    box-sizing: border-box;
  }

  .er-input:focus {
    outline: none;
    border-color: var(--n300);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
  }

  .er-input-wrap:focus-within .er-input-icon { color: var(--n300); }

  .er-input.is-error { border-color: #f87171; background: #fff5f5; }

  /* ── ERROR MSG ── */
  .er-error {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #dc2626;
    font-weight: 500;
    animation: er-shake 0.3s ease;
  }

  .er-error i { font-size: 10px; flex-shrink: 0; }

  @keyframes er-shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-4px); }
    75% { transform: translateX(4px); }
  }

  /* ── PERMISSIONS TOOLBAR ── */
  .er-perm-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 12px;
  }

  .er-perm-actions { display: flex; align-items: center; gap: 6px; }

  .er-perm-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 12px;
    border-radius: 20px;
    border: 1.5px solid var(--gray-200);
    background: var(--gray-50);
    color: var(--gray-500);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11.5px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.18s ease;
  }

  .er-perm-btn i { font-size: 9px; }

  .er-perm-btn-select:hover {
    border-color: var(--n200);
    background: var(--n50);
    color: var(--n400);
    transform: translateY(-1px);
  }

  .er-perm-btn-clear:hover {
    border-color: var(--red-bd);
    background: var(--red-bg);
    color: var(--red-tx);
    transform: translateY(-1px);
  }

  /* ── SEARCH BOX ── */
  .er-search-wrap {
    position: relative;
    margin-bottom: 10px;
  }

  .er-search-icon {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 12px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .er-search-input {
    width: 100%;
    padding: 9px 14px 9px 34px;
    background: var(--gray-50);
    border: 1.5px solid var(--gray-200);
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    color: var(--gray-900);
    transition: all 0.2s ease;
    box-sizing: border-box;
  }

  .er-search-input:focus {
    outline: none;
    border-color: var(--n300);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
  }

  .er-search-wrap:focus-within .er-search-icon { color: var(--n300); }

  /* ── PERMISSIONS GRID ── */
  .er-perm-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
    gap: 8px;
    max-height: 280px;
    overflow-y: auto;
    padding: 2px;
  }

  /* Scrollbar styling */
  .er-perm-grid::-webkit-scrollbar { width: 5px; }
  .er-perm-grid::-webkit-scrollbar-track { background: var(--gray-100); border-radius: 10px; }
  .er-perm-grid::-webkit-scrollbar-thumb { background: var(--gray-300); border-radius: 10px; }
  .er-perm-grid::-webkit-scrollbar-thumb:hover { background: var(--gray-400); }

  .er-perm-item { position: relative; }

  .er-perm-item input[type="checkbox"] {
    position: absolute;
    opacity: 0; width: 0; height: 0;
  }

  .er-perm-chip {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    border-radius: 10px;
    border: 1.5px solid var(--gray-200);
    background: var(--gray-50);
    color: var(--gray-500);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.18s ease;
    user-select: none;
  }

  .er-perm-chip-icon {
    width: 22px; height: 22px;
    border-radius: 6px;
    background: var(--gray-200);
    display: flex; align-items: center; justify-content: center;
    font-size: 9px;
    color: var(--gray-400);
    flex-shrink: 0;
    transition: all 0.18s;
  }

  .er-perm-chip-check {
    margin-left: auto;
    width: 16px; height: 16px;
    border-radius: 4px;
    border: 1.5px solid var(--gray-300);
    background: #fff;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    transition: all 0.18s;
  }

  .er-perm-chip-check i { font-size: 8px; color: transparent; transition: all 0.18s; }

  .er-perm-chip:hover {
    border-color: var(--n200);
    background: var(--n50);
    color: var(--n400);
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(59,130,246,0.1);
  }

  .er-perm-chip:hover .er-perm-chip-icon {
    background: var(--n100);
    color: var(--n400);
  }

  .er-perm-item input:checked + .er-perm-chip {
    border-color: var(--n300);
    background: linear-gradient(135deg, var(--n50), #dbeafe);
    color: var(--n700);
    box-shadow: 0 2px 8px rgba(59,130,246,0.18);
  }

  .er-perm-item input:checked + .er-perm-chip .er-perm-chip-icon {
    background: var(--n400);
    color: #fff;
  }

  .er-perm-item input:checked + .er-perm-chip .er-perm-chip-check {
    background: var(--n400);
    border-color: var(--n400);
  }

  .er-perm-item input:checked + .er-perm-chip .er-perm-chip-check i {
    color: #fff;
  }

  /* ── HIDDEN (search filter) ── */
  .er-perm-item.hidden { display: none; }

  /* ── NO RESULT ── */
  .er-perm-empty {
    padding: 32px 20px;
    text-align: center;
    color: var(--gray-400);
    font-size: 13px;
    background: var(--gray-50);
    border-radius: 10px;
    border: 1.5px dashed var(--gray-200);
  }

  .er-perm-empty i { font-size: 28px; display: block; margin-bottom: 8px; color: var(--gray-200); }

  #er-no-result {
    display: none;
    grid-column: 1 / -1;
    text-align: center;
    padding: 24px 0;
    color: var(--gray-400);
    font-size: 13px;
  }

  #er-no-result i { display: block; font-size: 24px; color: var(--gray-200); margin-bottom: 6px; }

  /* ── FOOTER ── */
  .er-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px 32px 28px;
    border-top: 1px solid var(--gray-100);
    background: var(--gray-50);
  }

  .er-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 22px;
    border-radius: 10px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    border: 1.5px solid;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
  }

  .er-btn-back {
    background: #fff;
    border-color: var(--gray-200);
    color: var(--gray-700);
  }

  .er-btn-back:hover {
    background: var(--gray-100);
    border-color: var(--gray-400);
    color: var(--gray-900);
    transform: translateY(-1px);
  }

  .er-btn-submit {
    background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border-color: var(--n400);
    color: #fff;
    box-shadow: 0 3px 12px rgba(29,78,216,0.3);
  }

  .er-btn-submit:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.4);
  }

  .er-btn-submit:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(29,78,216,0.25);
  }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .er-page { padding: 16px 12px; }
    .er-body { padding: 20px 18px; }
    .er-footer { padding: 16px 18px 20px; flex-direction: column-reverse; align-items: stretch; }
    .er-btn { justify-content: center; }
    .er-card-header { padding: 18px 20px; flex-wrap: wrap; gap: 10px; }
    .er-header-badge { display: none; }
    .er-perm-grid { grid-template-columns: 1fr 1fr; }
  }

  @media (max-width: 400px) {
    .er-perm-grid { grid-template-columns: 1fr; }
  }
</style>

<div class="er-page">
  <div class="er-card">

    {{-- ── HEADER ── --}}
    <div class="er-card-header">
      <div class="er-header-icon">
        <i class="fa-solid fa-shield-halved"></i>
      </div>
      <div class="er-header-text">
        <span class="er-header-title">Edit Role</span>
        <span class="er-header-sub">Perbarui nama role dan permission yang diberikan</span>
      </div>
      {{-- Role badge --}}
      <div class="er-header-badge">
        <div class="er-header-badge-avatar">
          <i class="fa-solid fa-shield-halved" style="font-size:13px;"></i>
        </div>
        <div class="er-header-badge-info">
          <span class="er-header-badge-name">{{ Str::limit($roles->name, 20) }}</span>
          <span class="er-header-badge-label">ID #{{ $roles->id }}</span>
        </div>
      </div>
    </div>

    {{-- ── FORM ── --}}
    <form action="{{ route('roles.update', $roles->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="er-body">

        {{-- Alerts --}}
        @if(session('success'))
          <div class="er-alert er-alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
          </div>
        @endif

        @if($errors->any())
          <div class="er-alert er-alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>
              <div style="font-weight:700; margin-bottom:4px;">Terdapat kesalahan pada form:</div>
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        @endif

        {{-- ── SECTION: INFO ROLE ── --}}
        <div class="er-section">
          <div class="er-section-label">
            <div class="er-section-label-icon"><i class="fa-solid fa-circle-info"></i></div>
            <span>Informasi Role</span>
          </div>

          <div class="er-form-group">
            <label class="er-label">
              Nama Role <span class="er-label-required">*</span>
            </label>
            <div class="er-input-wrap">
              <i class="fa-solid fa-shield-halved er-input-icon"></i>
              <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $roles->name) }}"
                placeholder="Contoh: admin, editor, kasir"
                class="er-input {{ $errors->has('name') ? 'is-error' : '' }}"
                required
              >
            </div>
            @error('name')
              <div class="er-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
            @enderror
          </div>
        </div>

        {{-- ── SECTION: PERMISSIONS ── --}}
        <div class="er-section" style="margin-bottom:0;">
          <div class="er-section-label">
            <div class="er-section-label-icon"><i class="fa-solid fa-key"></i></div>
            <span>Permissions</span>
          </div>

          {{-- Toolbar: label + action buttons --}}
          <div class="er-perm-toolbar">
            <span class="er-label">Pilih Hak Akses yang Diberikan</span>
            @if($permissions->isNotEmpty())
              <div class="er-perm-actions">
                <button type="button" id="btn-select-all" class="er-perm-btn er-perm-btn-select">
                  <i class="fa-solid fa-check-double"></i> Pilih Semua
                </button>
                <button type="button" id="btn-clear-all" class="er-perm-btn er-perm-btn-clear">
                  <i class="fa-solid fa-xmark"></i> Bersihkan
                </button>
              </div>
            @endif
          </div>

          {{-- Search box --}}
          @if($permissions->isNotEmpty())
            <div class="er-search-wrap">
              <i class="fa-solid fa-magnifying-glass er-search-icon"></i>
              <input
                type="text"
                id="permission-search"
                placeholder="Cari permission..."
                class="er-search-input"
                autocomplete="off"
              >
            </div>

            {{-- Permission chips grid --}}
            <div class="er-perm-grid" id="permissions-list">
              @foreach($permissions as $permission)
                <label class="er-perm-item" data-permission="{{ $permission->name }}">
                  <input
                    type="checkbox"
                    name="permission[]"
                    value="{{ $permission->name }}"
                    {{ collect(old('permission', $hasPermissions ?? []))->contains($permission->name) ? 'checked' : '' }}
                  >
                  <span class="er-perm-chip">
                    <span class="er-perm-chip-icon">
                      <i class="fa-solid fa-key"></i>
                    </span>
                    <span style="flex:1; min-width:0; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                      {{ $permission->name }}
                    </span>
                    <span class="er-perm-chip-check">
                      <i class="fa-solid fa-check"></i>
                    </span>
                  </span>
                </label>
              @endforeach

              {{-- No search result message --}}
              <div id="er-no-result">
                <i class="fa-solid fa-magnifying-glass"></i>
                Tidak ada permission yang cocok.
              </div>
            </div>
          @else
            <div class="er-perm-empty">
              <i class="fa-solid fa-key"></i>
              Belum ada permission yang tersedia.
            </div>
          @endif

        </div>

      </div>{{-- /.er-body --}}

      {{-- ── FOOTER ── --}}
      <div class="er-footer">
        <a href="{{ route('roles.index') }}" class="er-btn er-btn-back">
          <i class="fa-solid fa-arrow-left"></i>
          Batal
        </a>
        <button type="submit" class="er-btn er-btn-submit">
          <i class="fa-solid fa-floppy-disk"></i>
          Simpan Perubahan
        </button>
      </div>

    </form>

  </div>{{-- /.er-card --}}
</div>

<script>
  // ── Pilih Semua / Bersihkan ──
  document.getElementById('btn-select-all')?.addEventListener('click', () => {
    document.querySelectorAll('input[name="permission[]"]').forEach(cb => cb.checked = true);
  });

  document.getElementById('btn-clear-all')?.addEventListener('click', () => {
    document.querySelectorAll('input[name="permission[]"]').forEach(cb => cb.checked = false);
  });

  // ── Pencarian Permission ──
  document.getElementById('permission-search')?.addEventListener('input', function () {
    const query = this.value.toLowerCase().trim();
    const items = document.querySelectorAll('.er-perm-item[data-permission]');
    const noResult = document.getElementById('er-no-result');
    let visibleCount = 0;

    items.forEach(item => {
      const name = item.getAttribute('data-permission').toLowerCase();
      const match = name.includes(query);
      item.classList.toggle('hidden', !match);
      if (match) visibleCount++;
    });

    if (noResult) {
      noResult.style.display = visibleCount === 0 ? 'block' : 'none';
    }
  });
</script>

</x-app-layout>