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
    --shadow-md: 0 4px 16px rgba(10,22,60,0.10);
  }

  /* ── PAGE ── */
  .eu-page {
    padding: 28px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── CARD ── */
  .eu-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    max-width: 760px;
    margin: 0 auto;
  }

  /* ── CARD HEADER ── */
  .eu-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 28px 20px;
    border-bottom: 1px solid rgba(59,130,246,0.12);
    background: linear-gradient(135deg, var(--n800) 0%, var(--n600) 100%);
    position: relative;
    overflow: hidden;
  }

  .eu-card-header::before {
    content:'';
    position:absolute;
    top:-50px; right:-50px;
    width:180px; height:180px;
    border-radius:50%;
    background:rgba(59,130,246,0.1);
    pointer-events:none;
  }
  .eu-card-header::after {
    content:'';
    position:absolute;
    bottom:-30px; right:120px;
    width:110px; height:110px;
    border-radius:50%;
    background:rgba(14,165,233,0.07);
    pointer-events:none;
  }

  .eu-header-icon {
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

  .eu-header-text {
    flex: 1;
    display: flex;
    flex-direction: column;
    position: relative; z-index: 1;
  }

  .eu-header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
  }

  .eu-header-sub {
    font-size: 12px;
    color: rgba(191,219,254,0.75);
    margin-top: 3px;
  }

  /* User badge in header */
  .eu-header-badge {
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

  .eu-header-badge-avatar {
    width: 32px; height: 32px;
    border-radius: 9px;
    background: linear-gradient(135deg, var(--n400), var(--n200));
    display: flex; align-items: center; justify-content: center;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 800;
    color: #fff;
    flex-shrink: 0;
  }

  .eu-header-badge-info { display: flex; flex-direction: column; }
  .eu-header-badge-name { font-size: 12.5px; font-weight: 700; color: #fff; line-height: 1.2; }
  .eu-header-badge-label { font-size: 10.5px; color: rgba(191,219,254,0.7); margin-top: 1px; }

  /* ── ALERTS ── */
  .eu-body {
    padding: 28px 32px;
  }

  .eu-alert {
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

  .eu-alert i { font-size: 14px; flex-shrink: 0; margin-top: 1px; }

  .eu-alert-success { background: var(--green-bg); border-color: var(--green-bd); color: var(--green-tx); }
  .eu-alert-error   { background: var(--red-bg);   border-color: var(--red-bd);   color: var(--red-tx); }

  .eu-alert-error ul { margin: 6px 0 0 0; padding: 0; list-style: none; display: flex; flex-direction: column; gap: 3px; }
  .eu-alert-error ul li { font-size: 12.5px; display: flex; align-items: center; gap: 5px; }
  .eu-alert-error ul li::before { content: '•'; font-size: 16px; line-height: 1; }

  /* ── SECTION ── */
  .eu-section { margin-bottom: 24px; }

  .eu-section-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--gray-100);
  }

  .eu-section-label-icon {
    width: 26px; height: 26px;
    border-radius: 7px;
    background: var(--n50);
    border: 1px solid var(--n100);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px;
    color: var(--n400);
    flex-shrink: 0;
  }

  .eu-section-label span {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--gray-400);
  }

  /* ── GRID ── */
  .eu-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
  }

  /* ── FORM GROUP ── */
  .eu-form-group { display: flex; flex-direction: column; gap: 6px; }

  .eu-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--gray-700);
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .eu-label-required { color: #ef4444; font-size: 13px; line-height: 1; }

  /* ── INPUT ── */
  .eu-input-wrap { position: relative; }

  .eu-input-icon {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 13px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .eu-input {
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

  .eu-input:focus {
    outline: none;
    border-color: var(--n300);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
  }

  .eu-input-wrap:focus-within .eu-input-icon { color: var(--n300); }

  .eu-input.is-error {
    border-color: #f87171;
    background: #fff5f5;
  }

  /* ── ERROR MSG ── */
  .eu-error {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #dc2626;
    font-weight: 500;
    animation: eu-shake 0.3s ease;
  }

  .eu-error i { font-size: 10px; flex-shrink: 0; }

  @keyframes eu-shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-4px); }
    75% { transform: translateX(4px); }
  }

  /* ── ROLE CHIPS ── */
  .eu-roles-grid { display: flex; flex-wrap: wrap; gap: 8px; }

  .eu-role-item { position: relative; }

  .eu-role-item input[type="checkbox"] {
    position: absolute;
    opacity: 0; width: 0; height: 0;
  }

  .eu-role-chip {
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

  .eu-role-chip i { font-size: 10px; opacity: 0.5; transition: all 0.18s; }

  .eu-role-chip:hover {
    border-color: var(--n200);
    background: var(--n50);
    color: var(--n400);
    transform: translateY(-1px);
  }

  .eu-role-chip:hover i { opacity: 1; color: var(--n300); }

  .eu-role-item input:checked + .eu-role-chip {
    border-color: var(--n300);
    background: linear-gradient(135deg, var(--n50), #dbeafe);
    color: var(--n700);
    box-shadow: 0 2px 8px rgba(59,130,246,0.18);
  }

  .eu-role-item input:checked + .eu-role-chip i { opacity: 1; color: var(--n400); }

  /* ── FOOTER ── */
  .eu-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px 32px 28px;
    border-top: 1px solid var(--gray-100);
    background: var(--gray-50);
  }

  .eu-btn {
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

  .eu-btn-back {
    background: #fff;
    border-color: var(--gray-200);
    color: var(--gray-700);
  }

  .eu-btn-back:hover {
    background: var(--gray-100);
    border-color: var(--gray-400);
    color: var(--gray-900);
    transform: translateY(-1px);
  }

  .eu-btn-submit {
    background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border-color: var(--n400);
    color: #fff;
    box-shadow: 0 3px 12px rgba(29,78,216,0.3);
  }

  .eu-btn-submit:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.4);
  }

  .eu-btn-submit:active { transform: translateY(0); }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .eu-page { padding: 16px 12px; }
    .eu-body { padding: 20px 18px; }
    .eu-footer { padding: 16px 18px 20px; flex-direction: column-reverse; align-items: stretch; }
    .eu-btn { justify-content: center; }
    .eu-grid-2 { grid-template-columns: 1fr; }
    .eu-card-header { padding: 18px 20px; flex-wrap: wrap; gap: 10px; }
    .eu-header-badge { display: none; }
  }
</style>

<div class="eu-page">
  <div class="eu-card">

    {{-- ── HEADER ── --}}
    <div class="eu-card-header">
      <div class="eu-header-icon">
        <i class="fa-solid fa-user-pen"></i>
      </div>
      <div class="eu-header-text">
        <span class="eu-header-title">Edit Pengguna</span>
        <span class="eu-header-sub">Perbarui informasi akun dan hak akses pengguna</span>
      </div>
      {{-- User badge --}}
      <div class="eu-header-badge">
        <div class="eu-header-badge-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
        <div class="eu-header-badge-info">
          <span class="eu-header-badge-name">{{ Str::limit($user->name, 20) }}</span>
          <span class="eu-header-badge-label">ID #{{ $user->id }}</span>
        </div>
      </div>
    </div>

    {{-- ── FORM ── --}}
    <form action="{{ route('users.update', $user->id) }}" method="POST" autocomplete="off">
      @csrf
      @method('PUT')

      <div class="eu-body">

        {{-- Alerts --}}
        @if(session('berhasil'))
          <div class="eu-alert eu-alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('berhasil') }}</span>
          </div>
        @endif

        @if ($errors->any())
          <div class="eu-alert eu-alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>
              <div style="font-weight:700; margin-bottom:4px;">Terdapat kesalahan pada form:</div>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        @endif

        {{-- ── SECTION: INFO AKUN ── --}}
        <div class="eu-section">
          <div class="eu-section-label">
            <div class="eu-section-label-icon"><i class="fa-solid fa-circle-info"></i></div>
            <span>Informasi Akun</span>
          </div>

          <div class="eu-grid-2">

            {{-- Nama --}}
            <div class="eu-form-group">
              <label class="eu-label">
                Nama Lengkap <span class="eu-label-required">*</span>
              </label>
              <div class="eu-input-wrap">
                <i class="fa-solid fa-user eu-input-icon"></i>
                <input
                  type="text"
                  name="name"
                  id="name"
                  value="{{ old('name', $user->name) }}"
                  placeholder="Masukkan nama lengkap"
                  class="eu-input {{ $errors->has('name') ? 'is-error' : '' }}"
                  required
                >
              </div>
              @error('name')
                <div class="eu-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Username --}}
            <div class="eu-form-group">
              <label class="eu-label">
                Username <span class="eu-label-required">*</span>
              </label>
              <div class="eu-input-wrap">
                <i class="fa-solid fa-at eu-input-icon"></i>
                <input
                  type="text"
                  name="username"
                  id="username"
                  value="{{ old('username', $user->username) }}"
                  placeholder="Masukkan username"
                  class="eu-input {{ $errors->has('username') ? 'is-error' : '' }}"
                  required
                  autocomplete="off"
                >
              </div>
              @error('username')
                <div class="eu-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Email --}}
            <div class="eu-form-group" style="grid-column: 1 / -1;">
              <label class="eu-label">
                Email <span class="eu-label-required">*</span>
              </label>
              <div class="eu-input-wrap">
                <i class="fa-solid fa-envelope eu-input-icon"></i>
                <input
                  type="email"
                  name="email"
                  id="email"
                  value="{{ old('email', $user->email) }}"
                  placeholder="contoh@email.com"
                  class="eu-input {{ $errors->has('email') ? 'is-error' : '' }}"
                  required
                >
              </div>
              @error('email')
                <div class="eu-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

          </div>{{-- /.eu-grid-2 --}}
        </div>{{-- /.eu-section --}}

        {{-- ── SECTION: ROLE ── --}}
        <div class="eu-section" style="margin-bottom:0;">
          <div class="eu-section-label">
            <div class="eu-section-label-icon"><i class="fa-solid fa-shield-halved"></i></div>
            <span>Hak Akses / Role</span>
          </div>

          <div class="eu-form-group">
            <div class="eu-roles-grid">
              @foreach ($roles as $role)
                <label class="eu-role-item">
                  <input
                    type="checkbox"
                    name="role[]"
                    value="{{ $role->name }}"
                    {{ in_array($role->id, $hasRole) ? 'checked' : '' }}
                  >
                  <span class="eu-role-chip">
                    <i class="fa-solid fa-shield-halved"></i>
                    {{ $role->name }}
                  </span>
                </label>
              @endforeach
            </div>
          </div>
        </div>

      </div>{{-- /.eu-body --}}

      {{-- ── FOOTER ── --}}
      <div class="eu-footer">
        <a href="{{ route('users.index') }}" class="eu-btn eu-btn-back">
          <i class="fa-solid fa-arrow-left"></i>
          Kembali
        </a>
        <button type="submit" class="eu-btn eu-btn-submit">
          <i class="fa-solid fa-floppy-disk"></i>
          Simpan Perubahan
        </button>
      </div>

    </form>
  </div>{{-- /.eu-card --}}
</div>

</x-app-layout>