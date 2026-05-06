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
    --red-50:   #fff1f2;
    --red-100:  #fee2e2;
    --red-400:  #f87171;
    --red-500:  #ef4444;
    --red-600:  #dc2626;
    --red-700:  #b91c1c;
    --shadow-sm: 0 1px 3px rgba(10,22,60,0.07);
    --shadow-md: 0 4px 16px rgba(10,22,60,0.10);
    --shadow-lg: 0 8px 32px rgba(10,22,60,0.15);
  }

  /* ── PAGE ── */
  .cg-page {
    padding: 28px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── CARD ── */
  .cg-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    max-width: 760px;
    margin: 0 auto;
  }

  /* ── CARD HEADER ── */
  .cg-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 28px 20px;
    border-bottom: 1px solid rgba(59,130,246,0.12);
    background: linear-gradient(135deg, var(--n800) 0%, var(--n600) 100%);
    position: relative;
    overflow: hidden;
  }

  .cg-card-header::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(59,130,246,0.1);
    pointer-events: none;
  }
  .cg-card-header::after {
    content: '';
    position: absolute;
    bottom: -30px; right: 120px;
    width: 110px; height: 110px;
    border-radius: 50%;
    background: rgba(14,165,233,0.07);
    pointer-events: none;
  }

  .cg-header-icon {
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

  .cg-header-text {
    display: flex;
    flex-direction: column;
    position: relative; z-index: 1;
  }

  .cg-header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
  }

  .cg-header-sub {
    font-size: 12px;
    color: rgba(191,219,254,0.75);
    margin-top: 3px;
  }

  /* ── BODY ── */
  .cg-body {
    padding: 28px 32px 32px;
  }

  /* ── ALERT ── */
  .cg-alert {
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

  .cg-alert i { font-size: 14px; flex-shrink: 0; margin-top: 1px; }

  .cg-alert-success {
    background: #d1fae5;
    border-color: #6ee7b7;
    color: #065f46;
  }

  /* ── SECTION ── */
  .cg-section {
    margin-bottom: 24px;
  }

  .cg-section-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--gray-100);
  }

  .cg-section-label-icon {
    width: 26px; height: 26px;
    border-radius: 7px;
    background: var(--n50);
    border: 1px solid var(--n100);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px;
    color: var(--n400);
    flex-shrink: 0;
  }

  .cg-section-label span {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--gray-400);
  }

  /* ── GRID ── */
  .cg-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
  }

  /* ── FORM GROUP ── */
  .cg-form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .cg-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--gray-700);
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .cg-label-required {
    color: #ef4444;
    font-size: 13px;
    line-height: 1;
  }

  /* ── INPUT WRAPPER ── */
  .cg-input-wrap {
    position: relative;
  }

  .cg-input-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 13px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .cg-input,
  .cg-select {
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
    appearance: none;
    -webkit-appearance: none;
  }

  .cg-input:focus,
  .cg-select:focus {
    outline: none;
    border-color: var(--n300);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
  }

  .cg-input-wrap:focus-within .cg-input-icon {
    color: var(--n300);
  }

  .cg-input.is-error,
  .cg-select.is-error {
    border-color: #f87171;
    background: #fff5f5;
  }

  /* Select arrow */
  .cg-select-wrap .cg-select-arrow {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 11px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .cg-select-wrap:focus-within .cg-select-arrow {
    color: var(--n300);
  }

  /* ── PASSWORD TOGGLE ── */
  .cg-pw-toggle {
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

  .cg-pw-toggle:hover { color: var(--n300); }

  /* ── ERROR MSG ── */
  .cg-error {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #dc2626;
    font-weight: 500;
    animation: cg-shake 0.3s ease;
  }

  .cg-error i { font-size: 10px; flex-shrink: 0; }

  @keyframes cg-shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-4px); }
    75% { transform: translateX(4px); }
  }

  /* ── FOOTER ── */
  .cg-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px 32px 28px;
    border-top: 1px solid var(--gray-100);
    background: var(--gray-50);
  }

  .cg-btn {
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

  .cg-btn-back {
    background: #fff;
    border-color: var(--gray-200);
    color: var(--gray-700);
  }

  .cg-btn-back:hover {
    background: var(--gray-100);
    border-color: var(--gray-400);
    color: var(--gray-900);
    transform: translateY(-1px);
  }

  .cg-btn-submit {
    background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border-color: var(--n400);
    color: #fff;
    box-shadow: 0 3px 12px rgba(29,78,216,0.3);
  }

  .cg-btn-submit:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.4);
  }

  .cg-btn-submit:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(29,78,216,0.25);
  }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .cg-page { padding: 16px 12px; }
    .cg-body { padding: 20px 18px; }
    .cg-footer { padding: 16px 18px 20px; flex-direction: column-reverse; align-items: stretch; }
    .cg-btn { justify-content: center; }
    .cg-grid-2 { grid-template-columns: 1fr; }
    .cg-card-header { padding: 18px 20px; }
  }
</style>

<div class="cg-page">
  <div class="cg-card">

    {{-- ── HEADER ── --}}
    <div class="cg-card-header">
      <div class="cg-header-icon">
        <i class="fa-solid fa-chalkboard-user"></i>
      </div>
      <div class="cg-header-text">
        <span class="cg-header-title">Tambah Data Guru</span>
        <span class="cg-header-sub">Isi informasi akun dan data lengkap guru</span>
      </div>
    </div>

    {{-- ── FORM ── --}}
    <form action="{{ route('guru.store') }}" method="POST" autocomplete="off">
      @csrf

      <div class="cg-body">

        {{-- Alert sukses --}}
        @if(session('success'))
          <div class="cg-alert cg-alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
          </div>
        @endif

        {{-- ── SECTION: INFO AKUN ── --}}
        <div class="cg-section">
          <div class="cg-section-label">
            <div class="cg-section-label-icon"><i class="fa-solid fa-circle-info"></i></div>
            <span>Informasi Akun</span>
          </div>

          <div class="cg-grid-2">

            {{-- Nama --}}
            <div class="cg-form-group">
              <label class="cg-label">
                Nama Lengkap <span class="cg-label-required">*</span>
              </label>
              <div class="cg-input-wrap">
                <i class="fa-solid fa-user cg-input-icon"></i>
                <input
                  type="text"
                  name="name"
                  value="{{ old('name') }}"
                  placeholder="Masukkan nama lengkap"
                  class="cg-input {{ $errors->has('name') ? 'is-error' : '' }}"
                  required
                >
              </div>
              @error('name')
                <div class="cg-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Username / NIP --}}
            <div class="cg-form-group">
              <label class="cg-label">
                Username / NIP <span class="cg-label-required">*</span>
              </label>
              <div class="cg-input-wrap">
                <i class="fa-solid fa-id-badge cg-input-icon"></i>
                <input
                  type="text"
                  name="username"
                  value="{{ old('username') }}"
                  placeholder="Masukkan NIP atau username"
                  class="cg-input {{ $errors->has('username') ? 'is-error' : '' }}"
                  autocomplete="off"
                  required
                >
              </div>
              @error('username')
                <div class="cg-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Email --}}
            <div class="cg-form-group">
              <label class="cg-label">
                Email
              </label>
              <div class="cg-input-wrap">
                <i class="fa-solid fa-envelope cg-input-icon"></i>
                <input
                  type="email"
                  name="email"
                  value="{{ old('email') }}"
                  placeholder="contoh@email.com"
                  class="cg-input {{ $errors->has('email') ? 'is-error' : '' }}"
                >
              </div>
              @error('email')
                <div class="cg-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Password --}}
            <div class="cg-form-group">
              <label class="cg-label">
                Password <span class="cg-label-required">*</span>
              </label>
              <div class="cg-input-wrap">
                <i class="fa-solid fa-lock cg-input-icon"></i>
                <input
                  type="password"
                  name="password"
                  id="cgPwField"
                  placeholder="Minimal 8 karakter"
                  class="cg-input {{ $errors->has('password') ? 'is-error' : '' }}"
                  autocomplete="new-password"
                  required
                >
                <button type="button" class="cg-pw-toggle" id="cgPwToggle" tabindex="-1" title="Tampilkan/Sembunyikan">
                  <i class="fa-regular fa-eye" id="cgPwEyeIcon"></i>
                </button>
              </div>
              @error('password')
                <div class="cg-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

          </div>{{-- /.cg-grid-2 --}}
        </div>{{-- /.cg-section --}}

        {{-- ── SECTION: DATA GURU ── --}}
        <div class="cg-section" style="margin-bottom:0;">
          <div class="cg-section-label">
            <div class="cg-section-label-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
            <span>Data Guru</span>
          </div>

          <div class="cg-grid-2">

            {{-- Jenis Kelamin --}}
            <div class="cg-form-group">
              <label class="cg-label">Jenis Kelamin</label>
              <div class="cg-input-wrap cg-select-wrap">
                <i class="fa-solid fa-venus-mars cg-input-icon"></i>
                <select
                  name="jenis_kelamin"
                  class="cg-select {{ $errors->has('jenis_kelamin') ? 'is-error' : '' }}"
                >
                  <option value="">-- Pilih Jenis Kelamin --</option>
                  <option value="Laki-laki"  {{ old('jenis_kelamin') == 'Laki-laki'  ? 'selected' : '' }}>Laki-laki</option>
                  <option value="Perempuan"  {{ old('jenis_kelamin') == 'Perempuan'  ? 'selected' : '' }}>Perempuan</option>
                </select>
                <i class="fa-solid fa-chevron-down cg-select-arrow"></i>
              </div>
              @error('jenis_kelamin')
                <div class="cg-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Mata Pelajaran --}}
            <div class="cg-form-group">
              <label class="cg-label">Mata Pelajaran</label>
              <div class="cg-input-wrap cg-select-wrap">
                <i class="fa-solid fa-book-open cg-input-icon"></i>
                <select
                  name="mapel_id"
                  class="cg-select {{ $errors->has('mapel_id') ? 'is-error' : '' }}"
                >
                  <option value="">-- Pilih Mata Pelajaran --</option>
                  @foreach ($mapels as $m)
                    <option value="{{ $m->id }}" {{ old('mapel_id') == $m->id ? 'selected' : '' }}>
                      {{ $m->nama_mapel }}
                    </option>
                  @endforeach
                </select>
                <i class="fa-solid fa-chevron-down cg-select-arrow"></i>
              </div>
              @error('mapel_id')
                <div class="cg-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

          </div>{{-- /.cg-grid-2 --}}
        </div>{{-- /.cg-section --}}

      </div>{{-- /.cg-body --}}

      {{-- ── FOOTER ── --}}
      <div class="cg-footer">
        <a href="{{ route('guru.index') }}" class="cg-btn cg-btn-back">
          <i class="fa-solid fa-arrow-left"></i>
          Kembali
        </a>
        <button type="submit" class="cg-btn cg-btn-submit">
          <i class="fa-solid fa-floppy-disk"></i>
          Simpan Data Guru
        </button>
      </div>

    </form>
  </div>{{-- /.cg-card --}}
</div>

<script>
  const cgPwField   = document.getElementById('cgPwField');
  const cgPwToggle  = document.getElementById('cgPwToggle');
  const cgPwEyeIcon = document.getElementById('cgPwEyeIcon');

  cgPwToggle && cgPwToggle.addEventListener('click', function () {
    const isHidden = cgPwField.type === 'password';
    cgPwField.type = isHidden ? 'text' : 'password';
    cgPwEyeIcon.className = isHidden ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
  });
</script>

</x-app-layout>