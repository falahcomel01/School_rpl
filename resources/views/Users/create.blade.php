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
    --red-bg:   #fee2e2;
    --red-tx:   #991b1b;
    --red-bd:   #fca5a5;
    --shadow-sm: 0 1px 3px rgba(10,22,60,0.07);
    --shadow-md: 0 4px 16px rgba(10,22,60,0.10);
    --shadow-lg: 0 8px 32px rgba(10,22,60,0.15);
  }

  /* ── PAGE ── */
  .cu-page {
    padding: 28px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── CARD ── */
  .cu-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    max-width: 760px;
    margin: 0 auto;
  }

  /* ── CARD HEADER ── */
  .cu-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 28px 20px;
    border-bottom: 1px solid rgba(59,130,246,0.12);
    background: linear-gradient(135deg, var(--n800) 0%, var(--n600) 100%);
    position: relative;
    overflow: hidden;
  }

  .cu-card-header::before {
    content:'';
    position:absolute;
    top:-50px; right:-50px;
    width:180px; height:180px;
    border-radius:50%;
    background:rgba(59,130,246,0.1);
    pointer-events:none;
  }
  .cu-card-header::after {
    content:'';
    position:absolute;
    bottom:-30px; right:120px;
    width:110px; height:110px;
    border-radius:50%;
    background:rgba(14,165,233,0.07);
    pointer-events:none;
  }

  .cu-header-icon {
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

  .cu-header-text {
    display: flex;
    flex-direction: column;
    position: relative; z-index: 1;
  }

  .cu-header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
  }

  .cu-header-sub {
    font-size: 12px;
    color: rgba(191,219,254,0.75);
    margin-top: 3px;
  }

  /* ── BODY ── */
  .cu-body {
    padding: 28px 32px 32px;
  }

  /* ── SECTION DIVIDER ── */
  .cu-section {
    margin-bottom: 24px;
  }

  .cu-section-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--gray-100);
  }

  .cu-section-label-icon {
    width: 26px; height: 26px;
    border-radius: 7px;
    background: var(--n50);
    border: 1px solid var(--n100);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px;
    color: var(--n400);
    flex-shrink: 0;
  }

  .cu-section-label span {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--gray-400);
  }

  /* ── GRID ── */
  .cu-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
  }

  .cu-grid-1 {
    display: grid;
    grid-template-columns: 1fr;
    gap: 18px;
  }

  /* ── FORM GROUP ── */
  .cu-form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .cu-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--gray-700);
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .cu-label-required {
    color: #ef4444;
    font-size: 13px;
    line-height: 1;
  }

  /* ── INPUT WRAPPER ── */
  .cu-input-wrap {
    position: relative;
  }

  .cu-input-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 13px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .cu-input {
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

  .cu-input:focus {
    outline: none;
    border-color: var(--n300);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
  }

  .cu-input:focus ~ .cu-input-icon,
  .cu-input-wrap:focus-within .cu-input-icon {
    color: var(--n300);
  }

  .cu-input.is-error {
    border-color: #f87171;
    background: #fff5f5;
  }

  .cu-input.is-error:focus {
    box-shadow: 0 0 0 3px rgba(239,68,68,0.1);
  }

  /* ── PASSWORD TOGGLE ── */
  .cu-pw-toggle {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--gray-400);
    cursor: pointer;
    padding: 2px 4px;
    font-size: 13px;
    transition: color 0.18s;
  }

  .cu-pw-toggle:hover { color: var(--n300); }

  /* ── ERROR MSG ── */
  .cu-error {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #dc2626;
    font-weight: 500;
    animation: cu-shake 0.3s ease;
  }

  .cu-error i { font-size: 10px; flex-shrink: 0; }

  @keyframes cu-shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-4px); }
    75% { transform: translateX(4px); }
  }

  /* ── ROLE CHECKBOXES ── */
  .cu-roles-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
  }

  .cu-role-item {
    position: relative;
  }

  .cu-role-item input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    width: 0; height: 0;
  }

  .cu-role-chip {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 14px;
    border-radius: 20px;
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

  .cu-role-chip i {
    font-size: 10px;
    opacity: 0.5;
    transition: all 0.18s;
  }

  .cu-role-chip:hover {
    border-color: var(--n200);
    background: var(--n50);
    color: var(--n400);
    transform: translateY(-1px);
  }

  .cu-role-chip:hover i { opacity: 1; color: var(--n300); }

  .cu-role-item input:checked + .cu-role-chip {
    border-color: var(--n300);
    background: linear-gradient(135deg, var(--n50), #dbeafe);
    color: var(--n700);
    box-shadow: 0 2px 8px rgba(59,130,246,0.18);
  }

  .cu-role-item input:checked + .cu-role-chip i {
    opacity: 1;
    color: var(--n400);
  }

  /* ── FOOTER BUTTONS ── */
  .cu-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px 32px 28px;
    border-top: 1px solid var(--gray-100);
    background: var(--gray-50);
  }

  .cu-btn {
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

  .cu-btn-back {
    background: #fff;
    border-color: var(--gray-200);
    color: var(--gray-700);
  }

  .cu-btn-back:hover {
    background: var(--gray-100);
    border-color: var(--gray-400);
    color: var(--gray-900);
    transform: translateY(-1px);
  }

  .cu-btn-submit {
    background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border-color: var(--n400);
    color: #fff;
    box-shadow: 0 3px 12px rgba(29,78,216,0.3);
  }

  .cu-btn-submit:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.4);
  }

  .cu-btn-submit:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(29,78,216,0.25);
  }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .cu-page { padding: 16px 12px; }
    .cu-body { padding: 20px 18px; }
    .cu-footer { padding: 16px 18px 20px; flex-direction: column-reverse; align-items: stretch; }
    .cu-btn { justify-content: center; }
    .cu-grid-2 { grid-template-columns: 1fr; }
    .cu-card-header { padding: 18px 20px; }
  }
</style>

<div class="cu-page">
  <div class="cu-card">

    {{-- ── HEADER ── --}}
    <div class="cu-card-header">
      <div class="cu-header-icon">
        <i class="fa-solid fa-user-plus"></i>
      </div>
      <div class="cu-header-text">
        <span class="cu-header-title">Tambah Pengguna Baru</span>
        <span class="cu-header-sub">Isi informasi akun dan tentukan hak akses pengguna</span>
      </div>
    </div>

    {{-- ── FORM ── --}}
    <form action="{{ route('users.store') }}" method="POST" autocomplete="off">
      @csrf

      <div class="cu-body">

        {{-- ── SECTION: INFO AKUN ── --}}
        <div class="cu-section">
          <div class="cu-section-label">
            <div class="cu-section-label-icon"><i class="fa-solid fa-circle-info"></i></div>
            <span>Informasi Akun</span>
          </div>

          <div class="cu-grid-2">

            {{-- Nama --}}
            <div class="cu-form-group">
              <label class="cu-label">
                Nama Lengkap <span class="cu-label-required">*</span>
              </label>
              <div class="cu-input-wrap">
                <i class="fa-solid fa-user cu-input-icon"></i>
                <input
                  type="text"
                  name="name"
                  value="{{ old('name') }}"
                  placeholder="Masukkan nama lengkap"
                  class="cu-input {{ $errors->has('name') ? 'is-error' : '' }}"
                >
              </div>
              @error('name')
                <div class="cu-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Username --}}
            <div class="cu-form-group">
              <label class="cu-label">
                Username <span class="cu-label-required">*</span>
              </label>
              <div class="cu-input-wrap">
                <i class="fa-solid fa-at cu-input-icon"></i>
                <input
                  type="text"
                  name="username"
                  value="{{ old('username') }}"
                  placeholder="Masukkan username"
                  class="cu-input {{ $errors->has('username') ? 'is-error' : '' }}"
                  autocomplete="off"
                >
              </div>
              @error('username')
                <div class="cu-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Email --}}
            <div class="cu-form-group">
              <label class="cu-label">
                Email <span class="cu-label-required">*</span>
              </label>
              <div class="cu-input-wrap">
                <i class="fa-solid fa-envelope cu-input-icon"></i>
                <input
                  type="email"
                  name="email"
                  value="{{ old('email') }}"
                  placeholder="contoh@email.com"
                  class="cu-input {{ $errors->has('email') ? 'is-error' : '' }}"
                >
              </div>
              @error('email')
                <div class="cu-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Password --}}
            <div class="cu-form-group">
              <label class="cu-label">
                Password <span class="cu-label-required">*</span>
              </label>
              <div class="cu-input-wrap">
                <i class="fa-solid fa-lock cu-input-icon"></i>
                <input
                  type="password"
                  name="password"
                  id="pwField"
                  placeholder="Minimal 8 karakter"
                  class="cu-input {{ $errors->has('password') ? 'is-error' : '' }}"
                  autocomplete="new-password"
                >
                <button type="button" class="cu-pw-toggle" id="pwToggle" tabindex="-1" title="Tampilkan/Sembunyikan">
                  <i class="fa-regular fa-eye" id="pwEyeIcon"></i>
                </button>
              </div>
              @error('password')
                <div class="cu-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

          </div>{{-- /.cu-grid-2 --}}
        </div>{{-- /.cu-section --}}

        {{-- ── SECTION: ROLE ── --}}
        <div class="cu-section" style="margin-bottom:0;">
          <div class="cu-section-label">
            <div class="cu-section-label-icon"><i class="fa-solid fa-shield-halved"></i></div>
            <span>Hak Akses / Role</span>
          </div>

          <div class="cu-form-group">
            <div class="cu-roles-grid">
              @foreach ($roles as $role)
                <label class="cu-role-item">
                  <input
                    type="checkbox"
                    name="roles[]"
                    value="{{ $role->name }}"
                    {{ in_array($role->name, old('roles', [])) ? 'checked' : '' }}
                  >
                  <span class="cu-role-chip">
                    <i class="fa-solid fa-shield-halved"></i>
                    {{ $role->name }}
                  </span>
                </label>
              @endforeach
            </div>
          </div>
        </div>

      </div>{{-- /.cu-body --}}

      {{-- ── FOOTER ── --}}
      <div class="cu-footer">
        <a href="{{ route('users.index') }}" class="cu-btn cu-btn-back">
          <i class="fa-solid fa-arrow-left"></i>
          Kembali
        </a>
        <button type="submit" class="cu-btn cu-btn-submit">
          <i class="fa-solid fa-floppy-disk"></i>
          Simpan Pengguna
        </button>
      </div>

    </form>

  </div>{{-- /.cu-card --}}
</div>

<script>
  // Password visibility toggle
  const pwField    = document.getElementById('pwField');
  const pwToggle   = document.getElementById('pwToggle');
  const pwEyeIcon  = document.getElementById('pwEyeIcon');

  pwToggle && pwToggle.addEventListener('click', function () {
    const isHidden = pwField.type === 'password';
    pwField.type = isHidden ? 'text' : 'password';
    pwEyeIcon.className = isHidden ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
  });
</script>

</x-app-layout>