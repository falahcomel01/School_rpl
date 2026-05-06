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
    --shadow-md: 0 4px 16px rgba(10,22,60,0.10);
  }

  .cs-page {
    padding: 28px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  .cs-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    max-width: 760px;
    margin: 0 auto;
  }

  /* ── HEADER ── */
  .cs-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 28px 20px;
    border-bottom: 1px solid rgba(59,130,246,0.12);
    background: linear-gradient(135deg, var(--n800) 0%, var(--n600) 100%);
    position: relative;
    overflow: hidden;
  }

  .cs-card-header::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(59,130,246,0.1);
    pointer-events: none;
  }

  .cs-card-header::after {
    content: '';
    position: absolute;
    bottom: -30px; right: 120px;
    width: 110px; height: 110px;
    border-radius: 50%;
    background: rgba(14,165,233,0.07);
    pointer-events: none;
  }

  .cs-header-icon {
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

  .cs-header-text {
    display: flex;
    flex-direction: column;
    position: relative; z-index: 1;
  }

  .cs-header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
  }

  .cs-header-sub {
    font-size: 12px;
    color: rgba(191,219,254,0.75);
    margin-top: 3px;
  }

  /* ── BODY ── */
  .cs-body { padding: 28px 32px; }

  /* ── ALERT ── */
  .cs-alert {
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

  .cs-alert i { font-size: 14px; flex-shrink: 0; margin-top: 1px; }
  .cs-alert-success { background: var(--green-bg); border-color: var(--green-bd); color: var(--green-tx); }

  /* ── SECTION ── */
  .cs-section { margin-bottom: 24px; }

  .cs-section-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--gray-100);
  }

  .cs-section-label-icon {
    width: 26px; height: 26px;
    border-radius: 7px;
    background: var(--n50);
    border: 1px solid var(--n100);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px;
    color: var(--n400);
    flex-shrink: 0;
  }

  .cs-section-label span {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--gray-400);
  }

  /* ── GRID ── */
  .cs-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }

  /* ── FORM GROUP ── */
  .cs-form-group { display: flex; flex-direction: column; gap: 6px; }

  .cs-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--gray-700);
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .cs-label-required { color: #ef4444; font-size: 13px; line-height: 1; }

  /* ── INPUT / SELECT ── */
  .cs-input-wrap { position: relative; }

  .cs-input-icon {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 13px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .cs-input,
  .cs-select {
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

  .cs-input:focus,
  .cs-select:focus {
    outline: none;
    border-color: var(--n300);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
  }

  .cs-input-wrap:focus-within .cs-input-icon { color: var(--n300); }

  .cs-select-chevron {
    position: absolute;
    right: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 11px;
    color: var(--gray-400);
    pointer-events: none;
  }

  /* Password toggle */
  .cs-pw-toggle {
    position: absolute;
    right: 12px; top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--gray-400);
    cursor: pointer;
    padding: 2px 4px;
    font-size: 13px;
    transition: color 0.18s;
  }

  .cs-pw-toggle:hover { color: var(--n300); }

  /* ── FOOTER ── */
  .cs-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px 32px 28px;
    border-top: 1px solid var(--gray-100);
    background: var(--gray-50);
  }

  .cs-btn {
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

  .cs-btn-back {
    background: #fff;
    border-color: var(--gray-200);
    color: var(--gray-700);
  }

  .cs-btn-back:hover {
    background: var(--gray-100);
    border-color: var(--gray-400);
    color: var(--gray-900);
    transform: translateY(-1px);
  }

  .cs-btn-submit {
    background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border-color: var(--n400);
    color: #fff;
    box-shadow: 0 3px 12px rgba(29,78,216,0.3);
  }

  .cs-btn-submit:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.4);
  }

  .cs-btn-submit:active { transform: translateY(0); }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .cs-page { padding: 16px 12px; }
    .cs-body { padding: 20px 18px; }
    .cs-footer { padding: 16px 18px 20px; flex-direction: column-reverse; align-items: stretch; }
    .cs-btn { justify-content: center; }
    .cs-grid-2 { grid-template-columns: 1fr; }
    .cs-card-header { padding: 18px 20px; }
  }
</style>

<div class="cs-page">
  <div class="cs-card">

    {{-- ── HEADER ── --}}
    <div class="cs-card-header">
      <div class="cs-header-icon">
        <i class="fa-solid fa-user-graduate"></i>
      </div>
      <div class="cs-header-text">
        <span class="cs-header-title">Tambah Data Siswa</span>
        <span class="cs-header-sub">Isi informasi akun dan data siswa baru</span>
      </div>
    </div>

    {{-- ── FORM ── --}}
    <form action="{{ route('siswa.store') }}" method="POST" autocomplete="off">
      @csrf

      <div class="cs-body">

        @if (session('success'))
          <div class="cs-alert cs-alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
          </div>
        @endif

        {{-- ── SECTION: INFO AKUN ── --}}
        <div class="cs-section">
          <div class="cs-section-label">
            <div class="cs-section-label-icon"><i class="fa-solid fa-circle-info"></i></div>
            <span>Informasi Akun</span>
          </div>

          <div class="cs-grid-2">

            {{-- Nama --}}
            <div class="cs-form-group">
              <label class="cs-label">Nama <span class="cs-label-required">*</span></label>
              <div class="cs-input-wrap">
                <i class="fa-solid fa-user cs-input-icon"></i>
                <input type="text" name="name" value="{{ old('name') }}" required
                  placeholder="Masukkan nama lengkap"
                  class="cs-input">
              </div>
            </div>

            {{-- NIS --}}
            <div class="cs-form-group">
              <label class="cs-label">NIS <span class="cs-label-required">*</span></label>
              <div class="cs-input-wrap">
                <i class="fa-solid fa-id-card cs-input-icon"></i>
                <input type="text" name="username" value="{{ old('username') }}" required
                  placeholder="Nomor Induk Siswa"
                  oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                  class="cs-input">
              </div>
            </div>

            {{-- Email --}}
            <div class="cs-form-group">
              <label class="cs-label">Email</label>
              <div class="cs-input-wrap">
                <i class="fa-solid fa-envelope cs-input-icon"></i>
                <input type="email" name="email" value="{{ old('email') }}"
                  placeholder="contoh@email.com"
                  class="cs-input">
              </div>
            </div>

            {{-- Password --}}
            <div class="cs-form-group">
              <label class="cs-label">Password <span class="cs-label-required">*</span></label>
              <div class="cs-input-wrap">
                <i class="fa-solid fa-lock cs-input-icon"></i>
                <input type="password" name="password" id="pwField" required
                  placeholder="Minimal 8 karakter"
                  class="cs-input" autocomplete="new-password">
                <button type="button" class="cs-pw-toggle" id="pwToggle" tabindex="-1">
                  <i class="fa-regular fa-eye" id="pwEyeIcon"></i>
                </button>
              </div>
            </div>

          </div>
        </div>

        {{-- ── SECTION: DATA SISWA ── --}}
        <div class="cs-section" style="margin-bottom:0;">
          <div class="cs-section-label">
            <div class="cs-section-label-icon"><i class="fa-solid fa-school"></i></div>
            <span>Data Siswa</span>
          </div>

          <div class="cs-grid-2">

            {{-- Kelas --}}
            <div class="cs-form-group">
              <label class="cs-label">Kelas <span class="cs-label-required">*</span></label>
              <div class="cs-input-wrap">
                <i class="fa-solid fa-door-open cs-input-icon"></i>
                <select name="kelas_id" required class="cs-select">
                  <option value="">-- Pilih Kelas --</option>
                  @foreach ($kelas as $k)
                    <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                      {{ $k->nama_kelas }} - {{ $k->jurusan?->nama_jurusan ?? '-' }}
                    </option>
                  @endforeach
                </select>
                <i class="fa-solid fa-chevron-down cs-select-chevron"></i>
              </div>
            </div>

            {{-- Jenis Kelamin --}}
            <div class="cs-form-group">
              <label class="cs-label">Jenis Kelamin</label>
              <div class="cs-input-wrap">
                <i class="fa-solid fa-venus-mars cs-input-icon"></i>
                <select name="jenis_kelamin" class="cs-select">
                  <option value="">-- Pilih Jenis Kelamin --</option>
                  <option value="Laki-laki"  {{ old('jenis_kelamin') == 'Laki-laki'  ? 'selected' : '' }}>Laki-laki</option>
                  <option value="Perempuan"  {{ old('jenis_kelamin') == 'Perempuan'  ? 'selected' : '' }}>Perempuan</option>
                </select>
                <i class="fa-solid fa-chevron-down cs-select-chevron"></i>
              </div>
            </div>

          </div>
        </div>

      </div>{{-- /.cs-body --}}

      {{-- ── FOOTER ── --}}
      <div class="cs-footer">
        <a href="{{ route('siswa.index') }}" class="cs-btn cs-btn-back">
          <i class="fa-solid fa-arrow-left"></i>
          Kembali
        </a>
        <button type="submit" class="cs-btn cs-btn-submit">
          <i class="fa-solid fa-floppy-disk"></i>
          Simpan Siswa
        </button>
      </div>

    </form>
  </div>
</div>

<script>
  const pwField   = document.getElementById('pwField');
  const pwToggle  = document.getElementById('pwToggle');
  const pwEyeIcon = document.getElementById('pwEyeIcon');

  pwToggle && pwToggle.addEventListener('click', function () {
    const isHidden = pwField.type === 'password';
    pwField.type = isHidden ? 'text' : 'password';
    pwEyeIcon.className = isHidden ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
  });
</script>

</x-app-layout>