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
  .cr-page {
    padding: 28px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── CARD ── */
  .cr-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    max-width: 820px;
    margin: 0 auto;
  }

  /* ── CARD HEADER ── */
  .cr-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 28px 20px;
    border-bottom: 1px solid rgba(59,130,246,0.12);
    background: linear-gradient(135deg, var(--n800) 0%, var(--n600) 100%);
    position: relative;
    overflow: hidden;
  }

  .cr-card-header::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(59,130,246,0.1);
    pointer-events: none;
  }

  .cr-card-header::after {
    content: '';
    position: absolute;
    bottom: -30px; right: 120px;
    width: 110px; height: 110px;
    border-radius: 50%;
    background: rgba(14,165,233,0.07);
    pointer-events: none;
  }

  .cr-header-icon {
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

  .cr-header-text {
    display: flex;
    flex-direction: column;
    position: relative; z-index: 1;
  }

  .cr-header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
  }

  .cr-header-sub {
    font-size: 12px;
    color: rgba(191,219,254,0.75);
    margin-top: 3px;
  }

  /* ── BODY ── */
  .cr-body {
    padding: 28px 32px 32px;
  }

  /* ── ALERTS ── */
  .cr-alert {
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

  .cr-alert i { font-size: 14px; flex-shrink: 0; margin-top: 1px; }
  .cr-alert-success { background: var(--green-bg); border-color: var(--green-bd); color: var(--green-tx); }
  .cr-alert-error   { background: var(--red-bg);   border-color: var(--red-bd);   color: var(--red-tx); }

  .cr-alert-error ul { margin: 6px 0 0 0; padding: 0; list-style: none; display: flex; flex-direction: column; gap: 3px; }
  .cr-alert-error ul li { font-size: 12.5px; display: flex; align-items: center; gap: 5px; }
  .cr-alert-error ul li::before { content: '•'; font-size: 16px; line-height: 1; }

  /* ── SECTION ── */
  .cr-section {
    margin-bottom: 24px;
  }

  .cr-section-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--gray-100);
  }

  .cr-section-label-icon {
    width: 26px; height: 26px;
    border-radius: 7px;
    background: var(--n50);
    border: 1px solid var(--n100);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px;
    color: var(--n400);
    flex-shrink: 0;
  }

  .cr-section-label span {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--gray-400);
  }

  /* ── FORM GROUP ── */
  .cr-form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
    margin-bottom: 0;
  }

  .cr-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--gray-700);
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .cr-label-required { color: #ef4444; font-size: 13px; line-height: 1; }

  /* ── INPUT ── */
  .cr-input-wrap { position: relative; }

  .cr-input-icon {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 13px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .cr-input {
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

  .cr-input:focus {
    outline: none;
    border-color: var(--n300);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
  }

  .cr-input-wrap:focus-within .cr-input-icon { color: var(--n300); }

  .cr-input.is-error {
    border-color: #f87171;
    background: #fff5f5;
  }

  /* ── ERROR MSG ── */
  .cr-error {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #dc2626;
    font-weight: 500;
    animation: cr-shake 0.3s ease;
  }

  .cr-error i { font-size: 10px; flex-shrink: 0; }

  @keyframes cr-shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-4px); }
    75% { transform: translateX(4px); }
  }

  /* ── PERMISSIONS HEADER (label + select all) ── */
  .cr-perm-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 12px;
  }

  .cr-select-all-wrap {
    display: flex;
    align-items: center;
    gap: 7px;
    cursor: pointer;
    user-select: none;
  }

  .cr-select-all-wrap input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    width: 0; height: 0;
  }

  .cr-select-all-chip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 13px;
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

  .cr-select-all-chip i { font-size: 10px; opacity: 0.6; transition: all 0.18s; }

  .cr-select-all-chip:hover {
    border-color: var(--n200);
    background: var(--n50);
    color: var(--n400);
    transform: translateY(-1px);
  }

  .cr-select-all-wrap input:checked + .cr-select-all-chip {
    border-color: var(--n300);
    background: linear-gradient(135deg, var(--n50), #dbeafe);
    color: var(--n700);
    box-shadow: 0 2px 8px rgba(59,130,246,0.18);
  }

  .cr-select-all-wrap input:checked + .cr-select-all-chip i { opacity: 1; color: var(--n400); }

  /* ── PERMISSIONS GRID ── */
  .cr-perm-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
    gap: 8px;
  }

  .cr-perm-item { position: relative; }

  .cr-perm-item input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    width: 0; height: 0;
  }

  .cr-perm-chip {
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

  .cr-perm-chip-icon {
    width: 22px; height: 22px;
    border-radius: 6px;
    background: var(--gray-200);
    display: flex; align-items: center; justify-content: center;
    font-size: 9px;
    color: var(--gray-400);
    flex-shrink: 0;
    transition: all 0.18s;
  }

  .cr-perm-chip-check {
    margin-left: auto;
    width: 16px; height: 16px;
    border-radius: 4px;
    border: 1.5px solid var(--gray-300);
    background: #fff;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    transition: all 0.18s;
  }

  .cr-perm-chip-check i { font-size: 8px; color: transparent; transition: all 0.18s; }

  .cr-perm-chip:hover {
    border-color: var(--n200);
    background: var(--n50);
    color: var(--n400);
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(59,130,246,0.1);
  }

  .cr-perm-chip:hover .cr-perm-chip-icon {
    background: var(--n100);
    color: var(--n400);
  }

  .cr-perm-item input:checked + .cr-perm-chip {
    border-color: var(--n300);
    background: linear-gradient(135deg, var(--n50), #dbeafe);
    color: var(--n700);
    box-shadow: 0 2px 8px rgba(59,130,246,0.18);
  }

  .cr-perm-item input:checked + .cr-perm-chip .cr-perm-chip-icon {
    background: var(--n400);
    color: #fff;
  }

  .cr-perm-item input:checked + .cr-perm-chip .cr-perm-chip-check {
    background: var(--n400);
    border-color: var(--n400);
  }

  .cr-perm-item input:checked + .cr-perm-chip .cr-perm-chip-check i {
    color: #fff;
  }

  /* ── EMPTY PERMISSIONS ── */
  .cr-perm-empty {
    padding: 32px 20px;
    text-align: center;
    color: var(--gray-400);
    font-size: 13px;
    background: var(--gray-50);
    border-radius: 10px;
    border: 1.5px dashed var(--gray-200);
  }

  .cr-perm-empty i { font-size: 28px; display: block; margin-bottom: 8px; color: var(--gray-200); }

  /* ── FOOTER BUTTONS ── */
  .cr-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px 32px 28px;
    border-top: 1px solid var(--gray-100);
    background: var(--gray-50);
  }

  .cr-btn {
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

  .cr-btn-back {
    background: #fff;
    border-color: var(--gray-200);
    color: var(--gray-700);
  }

  .cr-btn-back:hover {
    background: var(--gray-100);
    border-color: var(--gray-400);
    color: var(--gray-900);
    transform: translateY(-1px);
  }

  .cr-btn-submit {
    background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border-color: var(--n400);
    color: #fff;
    box-shadow: 0 3px 12px rgba(29,78,216,0.3);
  }

  .cr-btn-submit:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.4);
  }

  .cr-btn-submit:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(29,78,216,0.25);
  }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .cr-page { padding: 16px 12px; }
    .cr-body { padding: 20px 18px; }
    .cr-footer { padding: 16px 18px 20px; flex-direction: column-reverse; align-items: stretch; }
    .cr-btn { justify-content: center; }
    .cr-card-header { padding: 18px 20px; }
    .cr-perm-grid { grid-template-columns: 1fr 1fr; }
  }

  @media (max-width: 400px) {
    .cr-perm-grid { grid-template-columns: 1fr; }
  }
</style>

<div class="cr-page">
  <div class="cr-card">

    {{-- ── HEADER ── --}}
    <div class="cr-card-header">
      <div class="cr-header-icon">
        <i class="fa-solid fa-shield-halved"></i>
      </div>
      <div class="cr-header-text">
        <span class="cr-header-title">Tambah Role Baru</span>
        <span class="cr-header-sub">Buat role dan tentukan permission yang diberikan</span>
      </div>
    </div>

    {{-- ── FORM ── --}}
    <form action="{{ route('roles.store') }}" method="POST">
      @csrf

      <div class="cr-body">

        {{-- Alerts --}}
        @if(session('success'))
          <div class="cr-alert cr-alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
          </div>
        @endif

        @if($errors->any())
          <div class="cr-alert cr-alert-error">
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
        <div class="cr-section">
          <div class="cr-section-label">
            <div class="cr-section-label-icon"><i class="fa-solid fa-circle-info"></i></div>
            <span>Informasi Role</span>
          </div>

          <div class="cr-form-group">
            <label class="cr-label">
              Nama Role <span class="cr-label-required">*</span>
            </label>
            <div class="cr-input-wrap">
              <i class="fa-solid fa-shield-halved cr-input-icon"></i>
              <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name') }}"
                placeholder="Contoh: admin, editor, kasir"
                class="cr-input {{ $errors->has('name') ? 'is-error' : '' }}"
                required
              >
            </div>
            @error('name')
              <div class="cr-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
            @enderror
          </div>
        </div>

        {{-- ── SECTION: PERMISSIONS ── --}}
        <div class="cr-section" style="margin-bottom:0;">
          <div class="cr-section-label">
            <div class="cr-section-label-icon"><i class="fa-solid fa-key"></i></div>
            <span>Permissions</span>
          </div>

          {{-- Header: label + select all chip --}}
          <div class="cr-perm-header">
            <span class="cr-label">Pilih Hak Akses yang Diberikan</span>
            @if($permissions->isNotEmpty())
              <label class="cr-select-all-wrap">
                <input type="checkbox" id="selectAll">
                <span class="cr-select-all-chip">
                  <i class="fa-solid fa-check-double"></i>
                  Pilih Semua
                </span>
              </label>
            @endif
          </div>

          {{-- Permission chips grid --}}
          @if($permissions->isNotEmpty())
            <div class="cr-perm-grid">
              @foreach($permissions as $permission)
                <label class="cr-perm-item">
                  <input
                    type="checkbox"
                    id="permission-{{ $permission->id }}"
                    class="permItem"
                    name="permission[]"
                    value="{{ $permission->name }}"
                    {{ in_array($permission->name, old('permission', [])) ? 'checked' : '' }}
                  >
                  <span class="cr-perm-chip">
                    <span class="cr-perm-chip-icon">
                      <i class="fa-solid fa-key"></i>
                    </span>
                    <span style="flex:1; min-width:0; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                      {{ $permission->name }}
                    </span>
                    <span class="cr-perm-chip-check">
                      <i class="fa-solid fa-check"></i>
                    </span>
                  </span>
                </label>
              @endforeach
            </div>
          @else
            <div class="cr-perm-empty">
              <i class="fa-solid fa-key"></i>
              Belum ada permission yang tersedia.
            </div>
          @endif

        </div>

      </div>{{-- /.cr-body --}}

      {{-- ── FOOTER ── --}}
      <div class="cr-footer">
        <a href="{{ route('roles.index') }}" class="cr-btn cr-btn-back">
          <i class="fa-solid fa-arrow-left"></i>
          Batal
        </a>
        <button type="submit" class="cr-btn cr-btn-submit">
          <i class="fa-solid fa-floppy-disk"></i>
          Simpan Role
        </button>
      </div>

    </form>

  </div>{{-- /.cr-card --}}
</div>

<script>
  // Select All toggle
  const selectAll = document.getElementById('selectAll');
  const permItems = document.querySelectorAll('.permItem');

  selectAll?.addEventListener('change', function () {
    permItems.forEach(item => { item.checked = this.checked; });
  });

  // Sync selectAll state when individual items change
  permItems.forEach(item => {
    item.addEventListener('change', function () {
      const allChecked = [...permItems].every(i => i.checked);
      const someChecked = [...permItems].some(i => i.checked);
      selectAll.checked = allChecked;
      selectAll.indeterminate = someChecked && !allChecked;
    });
  });
</script>

</x-app-layout>