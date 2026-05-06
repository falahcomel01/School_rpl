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
    --gray-50:  #f8fafc;
    --gray-100: #f1f5f9;
    --gray-200: #e2e8f0;
    --gray-400: #94a3b8;
    --gray-500: #64748b;
    --gray-700: #334155;
    --gray-900: #0f172a;
    --shadow-md: 0 4px 16px rgba(10,22,60,0.10);
  }

  .cpb-page { padding: 28px 20px; font-family: 'DM Sans', sans-serif; }

  .cpb-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    max-width: 760px;
    margin: 0 auto;
  }

  /* ── HEADER ── */
  .cpb-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 28px 20px;
    background: linear-gradient(135deg, var(--n800) 0%, var(--n600) 100%);
    border-bottom: 1px solid rgba(59,130,246,0.12);
    position: relative;
    overflow: hidden;
  }
  .cpb-card-header::before {
    content:''; position:absolute; top:-50px; right:-50px;
    width:180px; height:180px; border-radius:50%;
    background:rgba(59,130,246,0.1); pointer-events:none;
  }
  .cpb-card-header::after {
    content:''; position:absolute; bottom:-30px; right:120px;
    width:110px; height:110px; border-radius:50%;
    background:rgba(14,165,233,0.07); pointer-events:none;
  }
  .cpb-header-icon {
    width:44px; height:44px; border-radius:12px;
    background:rgba(255,255,255,0.12); border:1px solid rgba(255,255,255,0.2);
    display:flex; align-items:center; justify-content:center;
    font-size:18px; color:#fff; flex-shrink:0; position:relative; z-index:1;
  }
  .cpb-header-text { display:flex; flex-direction:column; position:relative; z-index:1; }
  .cpb-header-title {
    font-family:'Plus Jakarta Sans',sans-serif; font-size:18px;
    font-weight:800; color:#fff; line-height:1.2;
  }
  .cpb-header-sub { font-size:12px; color:rgba(191,219,254,0.75); margin-top:3px; }

  /* ── BODY ── */
  .cpb-body { padding: 28px 32px 32px; }

  /* ── ALERT ── */
  .cpb-alert {
    display:flex; align-items:flex-start; gap:10px;
    padding:12px 16px; border-radius:10px;
    font-size:13.5px; font-weight:500; margin-bottom:20px; border:1px solid;
  }
  .cpb-alert i { font-size:14px; flex-shrink:0; margin-top:1px; }
  .cpb-alert-success { background:#d1fae5; border-color:#6ee7b7; color:#065f46; }

  /* ── SECTION ── */
  .cpb-section { margin-bottom: 24px; }
  .cpb-section-label {
    display:flex; align-items:center; gap:8px;
    margin-bottom:16px; padding-bottom:10px;
    border-bottom:1px solid var(--gray-100);
  }
  .cpb-section-label-icon {
    width:26px; height:26px; border-radius:7px;
    background:var(--n50); border:1px solid var(--n100);
    display:flex; align-items:center; justify-content:center;
    font-size:11px; color:var(--n400); flex-shrink:0;
  }
  .cpb-section-label span {
    font-family:'Plus Jakarta Sans',sans-serif; font-size:11px;
    font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:var(--gray-400);
  }

  /* ── GRID ── */
  .cpb-grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:18px; }

  /* ── FORM GROUP ── */
  .cpb-form-group { display:flex; flex-direction:column; gap:6px; }
  .cpb-label {
    font-family:'Plus Jakarta Sans',sans-serif; font-size:12.5px;
    font-weight:700; color:var(--gray-700); display:flex; align-items:center; gap:5px;
  }
  .cpb-label-required { color:#ef4444; font-size:13px; line-height:1; }
  .cpb-label-opt { font-size:11px; color:var(--gray-400); font-weight:500; }

  /* ── INPUT ── */
  .cpb-input-wrap { position:relative; }
  .cpb-input-icon {
    position:absolute; left:12px; top:50%; transform:translateY(-50%);
    font-size:13px; color:var(--gray-400); pointer-events:none; transition:color 0.18s;
  }
  .cpb-input, .cpb-select {
    width:100%; padding:10px 14px 10px 36px;
    background:var(--gray-50); border:1.5px solid var(--gray-200);
    border-radius:10px; font-family:'DM Sans',sans-serif;
    font-size:13.5px; color:var(--gray-900);
    transition:all 0.2s ease; box-sizing:border-box;
    appearance:none; -webkit-appearance:none;
  }
  .cpb-input:focus, .cpb-select:focus {
    outline:none; border-color:var(--n300); background:#fff;
    box-shadow:0 0 0 3px rgba(59,130,246,0.1);
  }
  .cpb-input-wrap:focus-within .cpb-input-icon { color:var(--n300); }
  .cpb-input.is-error, .cpb-select.is-error { border-color:#f87171; background:#fff5f5; }

  .cpb-select-arrow {
    position:absolute; right:12px; top:50%; transform:translateY(-50%);
    font-size:11px; color:var(--gray-400); pointer-events:none; transition:color 0.18s;
  }
  .cpb-input-wrap:focus-within .cpb-select-arrow { color:var(--n300); }

  /* ── PASSWORD TOGGLE ── */
  .cpb-pw-toggle {
    position:absolute; right:12px; top:50%; transform:translateY(-50%);
    background:none; border:none; color:var(--gray-400);
    cursor:pointer; padding:2px 4px; font-size:13px; transition:color 0.18s;
  }
  .cpb-pw-toggle:hover { color:var(--n300); }

  /* ── HINT TEXT ── */
  .cpb-hint { font-size:11.5px; color:var(--gray-400); margin-top:1px; }

  /* ── ERROR MSG ── */
  .cpb-error {
    display:flex; align-items:center; gap:5px;
    font-size:12px; color:#dc2626; font-weight:500;
    animation:cpb-shake 0.3s ease;
  }
  .cpb-error i { font-size:10px; flex-shrink:0; }
  @keyframes cpb-shake {
    0%,100%{transform:translateX(0)} 25%{transform:translateX(-4px)} 75%{transform:translateX(4px)}
  }

  /* ── FOOTER ── */
  .cpb-footer {
    display:flex; align-items:center; justify-content:flex-end; gap:10px;
    padding:20px 32px 28px; border-top:1px solid var(--gray-100); background:var(--gray-50);
  }
  .cpb-btn {
    display:inline-flex; align-items:center; gap:8px; padding:10px 22px;
    border-radius:10px; font-family:'Plus Jakarta Sans',sans-serif; font-size:13px;
    font-weight:700; text-decoration:none; border:1.5px solid;
    cursor:pointer; transition:all 0.2s ease; white-space:nowrap;
  }
  .cpb-btn-back { background:#fff; border-color:var(--gray-200); color:var(--gray-700); }
  .cpb-btn-back:hover { background:var(--gray-100); border-color:var(--gray-400); color:var(--gray-900); transform:translateY(-1px); }
  .cpb-btn-submit {
    background:linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border-color:var(--n400); color:#fff; box-shadow:0 3px 12px rgba(29,78,216,0.3);
  }
  .cpb-btn-submit:hover {
    background:linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform:translateY(-1px); box-shadow:0 5px 18px rgba(29,78,216,0.4);
  }
  .cpb-btn-submit:active { transform:translateY(0); }

  /* ── RESPONSIVE ── */
  @media (max-width:640px) {
    .cpb-page { padding:16px 12px; }
    .cpb-body { padding:20px 18px; }
    .cpb-footer { padding:16px 18px 20px; flex-direction:column-reverse; align-items:stretch; }
    .cpb-btn { justify-content:center; }
    .cpb-grid-2 { grid-template-columns:1fr; }
    .cpb-card-header { padding:18px 20px; }
  }
</style>

<div class="cpb-page">
  <div class="cpb-card">

    {{-- ── HEADER ── --}}
    <div class="cpb-card-header">
      <div class="cpb-header-icon"><i class="fa-solid fa-person-chalkboard"></i></div>
      <div class="cpb-header-text">
        <span class="cpb-header-title">Tambah Pembina Ekstra</span>
        <span class="cpb-header-sub">Isi informasi akun dan data pembina ekstrakurikuler</span>
      </div>
    </div>

    {{-- ── FORM ── --}}
    <form action="{{ route('pembina.store') }}" method="POST" autocomplete="off">
      @csrf

      <div class="cpb-body">

        {{-- Alert sukses --}}
        @if(session('success'))
          <div class="cpb-alert cpb-alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
          </div>
        @endif

        {{-- ── SECTION: INFO AKUN ── --}}
        <div class="cpb-section">
          <div class="cpb-section-label">
            <div class="cpb-section-label-icon"><i class="fa-solid fa-circle-info"></i></div>
            <span>Informasi Akun</span>
          </div>

          <div class="cpb-grid-2">

            {{-- Nama --}}
            <div class="cpb-form-group">
              <label class="cpb-label">
                Nama Pembina <span class="cpb-label-required">*</span>
              </label>
              <div class="cpb-input-wrap">
                <i class="fa-solid fa-user cpb-input-icon"></i>
                <input type="text" name="name" value="{{ old('name') }}"
                  placeholder="Masukkan nama lengkap"
                  class="cpb-input {{ $errors->has('name') ? 'is-error' : '' }}" required>
              </div>
              @error('name')
                <div class="cpb-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Username --}}
            <div class="cpb-form-group">
              <label class="cpb-label">
                Username <span class="cpb-label-required">*</span>
              </label>
              <div class="cpb-input-wrap">
                <i class="fa-solid fa-at cpb-input-icon"></i>
                <input type="text" name="username" value="{{ old('username') }}"
                  placeholder="Masukkan username"
                  class="cpb-input {{ $errors->has('username') ? 'is-error' : '' }}"
                  autocomplete="off" required>
              </div>
              @error('username')
                <div class="cpb-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Email --}}
            <div class="cpb-form-group">
              <label class="cpb-label">
                Email <span class="cpb-label-opt">(opsional)</span>
              </label>
              <div class="cpb-input-wrap">
                <i class="fa-solid fa-envelope cpb-input-icon"></i>
                <input type="email" name="email" value="{{ old('email') }}"
                  placeholder="contoh@email.com"
                  class="cpb-input {{ $errors->has('email') ? 'is-error' : '' }}">
              </div>
              @error('email')
                <div class="cpb-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Password --}}
            <div class="cpb-form-group">
              <label class="cpb-label">
                Password <span class="cpb-label-required">*</span>
              </label>
              <div class="cpb-input-wrap">
                <i class="fa-solid fa-lock cpb-input-icon"></i>
                <input type="password" name="password" id="cpbPwField"
                  placeholder="Minimal 5 karakter"
                  class="cpb-input {{ $errors->has('password') ? 'is-error' : '' }}"
                  autocomplete="new-password" minlength="5" required>
                <button type="button" class="cpb-pw-toggle" id="cpbPwToggle" tabindex="-1">
                  <i class="fa-regular fa-eye" id="cpbPwEye"></i>
                </button>
              </div>
              @error('password')
                <div class="cpb-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
              <span class="cpb-hint"><i class="fa-solid fa-circle-info" style="font-size:10px;"></i> Minimal 5 karakter</span>
            </div>

          </div>{{-- /.cpb-grid-2 --}}
        </div>{{-- /.cpb-section --}}

        {{-- ── SECTION: DATA PEMBINA ── --}}
        <div class="cpb-section" style="margin-bottom:0;">
          <div class="cpb-section-label">
            <div class="cpb-section-label-icon"><i class="fa-solid fa-person-chalkboard"></i></div>
            <span>Data Pembina</span>
          </div>

          <div class="cpb-grid-2">

            {{-- Jenis Kelamin --}}
            <div class="cpb-form-group">
              <label class="cpb-label">
                Jenis Kelamin <span class="cpb-label-opt">(opsional)</span>
              </label>
              <div class="cpb-input-wrap">
                <i class="fa-solid fa-venus-mars cpb-input-icon"></i>
                <select name="jenis_kelamin"
                  class="cpb-select {{ $errors->has('jenis_kelamin') ? 'is-error' : '' }}">
                  <option value="">-- Pilih Jenis Kelamin --</option>
                  <option value="Laki-laki"  {{ old('jenis_kelamin') == 'Laki-laki'  ? 'selected' : '' }}>Laki-laki</option>
                  <option value="Perempuan"  {{ old('jenis_kelamin') == 'Perempuan'  ? 'selected' : '' }}>Perempuan</option>
                </select>
                <i class="fa-solid fa-chevron-down cpb-select-arrow"></i>
              </div>
              @error('jenis_kelamin')
                <div class="cpb-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

          </div>{{-- /.cpb-grid-2 --}}
        </div>{{-- /.cpb-section --}}

      </div>{{-- /.cpb-body --}}

      {{-- ── FOOTER ── --}}
      <div class="cpb-footer">
        <a href="{{ route('pembina.index') }}" class="cpb-btn cpb-btn-back">
          <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <button type="submit" class="cpb-btn cpb-btn-submit">
          <i class="fa-solid fa-floppy-disk"></i> Simpan Pembina
        </button>
      </div>

    </form>
  </div>
</div>

<script>
  const cpbPwField = document.getElementById('cpbPwField');
  const cpbPwToggle = document.getElementById('cpbPwToggle');
  const cpbPwEye = document.getElementById('cpbPwEye');
  cpbPwToggle && cpbPwToggle.addEventListener('click', function () {
    const hidden = cpbPwField.type === 'password';
    cpbPwField.type = hidden ? 'text' : 'password';
    cpbPwEye.className = hidden ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
  });
</script>

</x-app-layout>