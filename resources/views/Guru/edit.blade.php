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
  .eg-page {
    padding: 28px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── CARD ── */
  .eg-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    max-width: 760px;
    margin: 0 auto;
  }

  /* ── CARD HEADER ── */
  .eg-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 28px 20px;
    border-bottom: 1px solid rgba(59,130,246,0.12);
    background: linear-gradient(135deg, var(--n800) 0%, var(--n600) 100%);
    position: relative;
    overflow: hidden;
  }

  .eg-card-header::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(59,130,246,0.1);
    pointer-events: none;
  }
  .eg-card-header::after {
    content: '';
    position: absolute;
    bottom: -30px; right: 120px;
    width: 110px; height: 110px;
    border-radius: 50%;
    background: rgba(14,165,233,0.07);
    pointer-events: none;
  }

  .eg-header-icon {
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

  .eg-header-text {
    flex: 1;
    display: flex;
    flex-direction: column;
    position: relative; z-index: 1;
  }

  .eg-header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
  }

  .eg-header-sub {
    font-size: 12px;
    color: rgba(191,219,254,0.75);
    margin-top: 3px;
  }

  /* ── USER BADGE IN HEADER ── */
  .eg-header-badge {
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

  .eg-header-badge-avatar {
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

  .eg-header-badge-info { display: flex; flex-direction: column; }
  .eg-header-badge-name { font-size: 12.5px; font-weight: 700; color: #fff; line-height: 1.2; }
  .eg-header-badge-label { font-size: 10.5px; color: rgba(191,219,254,0.7); margin-top: 1px; }

  /* ── BODY ── */
  .eg-body {
    padding: 28px 32px;
  }

  /* ── ALERT ── */
  .eg-alert {
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

  .eg-alert i { font-size: 14px; flex-shrink: 0; margin-top: 1px; }

  .eg-alert-success { background: var(--green-bg); border-color: var(--green-bd); color: var(--green-tx); }
  .eg-alert-error   { background: var(--red-bg);   border-color: var(--red-bd);   color: var(--red-tx); }

  .eg-alert-error ul { margin: 6px 0 0 0; padding: 0; list-style: none; display: flex; flex-direction: column; gap: 3px; }
  .eg-alert-error ul li { font-size: 12.5px; display: flex; align-items: center; gap: 5px; }
  .eg-alert-error ul li::before { content: '•'; font-size: 16px; line-height: 1; }

  /* ── SECTION ── */
  .eg-section { margin-bottom: 24px; }

  .eg-section-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--gray-100);
  }

  .eg-section-label-icon {
    width: 26px; height: 26px;
    border-radius: 7px;
    background: var(--n50);
    border: 1px solid var(--n100);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px;
    color: var(--n400);
    flex-shrink: 0;
  }

  .eg-section-label span {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--gray-400);
  }

  /* ── GRID ── */
  .eg-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
  }

  /* ── FORM GROUP ── */
  .eg-form-group { display: flex; flex-direction: column; gap: 6px; }

  .eg-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--gray-700);
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .eg-label-required { color: #ef4444; font-size: 13px; line-height: 1; }

  /* ── INPUT ── */
  .eg-input-wrap { position: relative; }

  .eg-input-icon {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 13px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .eg-input,
  .eg-select {
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

  .eg-input:focus,
  .eg-select:focus {
    outline: none;
    border-color: var(--n300);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
  }

  .eg-input-wrap:focus-within .eg-input-icon { color: var(--n300); }

  .eg-input.is-error,
  .eg-select.is-error {
    border-color: #f87171;
    background: #fff5f5;
  }

  /* Select arrow */
  .eg-select-wrap .eg-select-arrow {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 11px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .eg-select-wrap:focus-within .eg-select-arrow { color: var(--n300); }

  /* ── ERROR MSG ── */
  .eg-error {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #dc2626;
    font-weight: 500;
    animation: eg-shake 0.3s ease;
  }

  .eg-error i { font-size: 10px; flex-shrink: 0; }

  @keyframes eg-shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-4px); }
    75% { transform: translateX(4px); }
  }

  /* ── FOOTER ── */
  .eg-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px 32px 28px;
    border-top: 1px solid var(--gray-100);
    background: var(--gray-50);
  }

  .eg-btn {
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

  .eg-btn-back {
    background: #fff;
    border-color: var(--gray-200);
    color: var(--gray-700);
  }

  .eg-btn-back:hover {
    background: var(--gray-100);
    border-color: var(--gray-400);
    color: var(--gray-900);
    transform: translateY(-1px);
  }

  .eg-btn-submit {
    background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border-color: var(--n400);
    color: #fff;
    box-shadow: 0 3px 12px rgba(29,78,216,0.3);
  }

  .eg-btn-submit:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.4);
  }

  .eg-btn-submit:active { transform: translateY(0); }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .eg-page { padding: 16px 12px; }
    .eg-body { padding: 20px 18px; }
    .eg-footer { padding: 16px 18px 20px; flex-direction: column-reverse; align-items: stretch; }
    .eg-btn { justify-content: center; }
    .eg-grid-2 { grid-template-columns: 1fr; }
    .eg-card-header { padding: 18px 20px; flex-wrap: wrap; gap: 10px; }
    .eg-header-badge { display: none; }
  }
</style>

<div class="eg-page">
  <div class="eg-card">

    {{-- ── HEADER ── --}}
    <div class="eg-card-header">
      <div class="eg-header-icon">
        <i class="fa-solid fa-chalkboard-user"></i>
      </div>
      <div class="eg-header-text">
        <span class="eg-header-title">Edit Data Guru</span>
        <span class="eg-header-sub">Perbarui informasi akun dan data lengkap guru</span>
      </div>
      {{-- User badge --}}
      <div class="eg-header-badge">
        <div class="eg-header-badge-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
        <div class="eg-header-badge-info">
          <span class="eg-header-badge-name">{{ Str::limit($user->name, 20) }}</span>
          <span class="eg-header-badge-label">ID #{{ $user->id }}</span>
        </div>
      </div>
    </div>

    {{-- ── FORM ── --}}
    <form action="{{ route('guru.update', $user->id) }}" method="POST" autocomplete="off">
      @csrf
      @method('PUT')

      <div class="eg-body">

        {{-- Alerts --}}
        @if(session('success'))
          <div class="eg-alert eg-alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
          </div>
        @endif

        @if($errors->any())
          <div class="eg-alert eg-alert-error">
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

        {{-- ── SECTION: INFO AKUN ── --}}
        <div class="eg-section">
          <div class="eg-section-label">
            <div class="eg-section-label-icon"><i class="fa-solid fa-circle-info"></i></div>
            <span>Informasi Akun</span>
          </div>

          <div class="eg-grid-2">

            {{-- Nama --}}
            <div class="eg-form-group">
              <label class="eg-label">
                Nama Lengkap <span class="eg-label-required">*</span>
              </label>
              <div class="eg-input-wrap">
                <i class="fa-solid fa-user eg-input-icon"></i>
                <input
                  type="text"
                  name="name"
                  value="{{ old('name', $user->name) }}"
                  placeholder="Masukkan nama lengkap"
                  class="eg-input {{ $errors->has('name') ? 'is-error' : '' }}"
                  required
                >
              </div>
              @error('name')
                <div class="eg-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Username / NIP --}}
            <div class="eg-form-group">
              <label class="eg-label">
                Username / NIP <span class="eg-label-required">*</span>
              </label>
              <div class="eg-input-wrap">
                <i class="fa-solid fa-id-badge eg-input-icon"></i>
                <input
                  type="text"
                  name="username"
                  value="{{ old('username', $user->username) }}"
                  placeholder="Masukkan NIP atau username"
                  class="eg-input {{ $errors->has('username') ? 'is-error' : '' }}"
                  autocomplete="off"
                  required
                >
              </div>
              @error('username')
                <div class="eg-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Email --}}
            <div class="eg-form-group" style="grid-column: 1 / -1;">
              <label class="eg-label">
                Email <span class="eg-label-required">*</span>
              </label>
              <div class="eg-input-wrap">
                <i class="fa-solid fa-envelope eg-input-icon"></i>
                <input
                  type="email"
                  name="email"
                  value="{{ old('email', $user->email) }}"
                  placeholder="contoh@email.com"
                  class="eg-input {{ $errors->has('email') ? 'is-error' : '' }}"
                  required
                >
              </div>
              @error('email')
                <div class="eg-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

          </div>{{-- /.eg-grid-2 --}}
        </div>{{-- /.eg-section --}}

        {{-- ── SECTION: DATA GURU ── --}}
        <div class="eg-section" style="margin-bottom:0;">
          <div class="eg-section-label">
            <div class="eg-section-label-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
            <span>Data Guru</span>
          </div>

          <div class="eg-grid-2">

            {{-- Jenis Kelamin --}}
            <div class="eg-form-group">
              <label class="eg-label">Jenis Kelamin</label>
              <div class="eg-input-wrap eg-select-wrap">
                <i class="fa-solid fa-venus-mars eg-input-icon"></i>
                <select
                  name="jenis_kelamin"
                  class="eg-select {{ $errors->has('jenis_kelamin') ? 'is-error' : '' }}"
                >
                  <option value="">-- Pilih Jenis Kelamin --</option>
                  <option value="Laki-laki"
                    {{ old('jenis_kelamin', optional($user->guru)->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                    Laki-laki
                  </option>
                  <option value="Perempuan"
                    {{ old('jenis_kelamin', optional($user->guru)->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                    Perempuan
                  </option>
                </select>
                <i class="fa-solid fa-chevron-down eg-select-arrow"></i>
              </div>
              @error('jenis_kelamin')
                <div class="eg-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Mata Pelajaran --}}
            <div class="eg-form-group">
              <label class="eg-label">Mata Pelajaran</label>
              <div class="eg-input-wrap eg-select-wrap">
                <i class="fa-solid fa-book-open eg-input-icon"></i>
                <select
                  name="mapel_id"
                  class="eg-select {{ $errors->has('mapel_id') ? 'is-error' : '' }}"
                >
                  <option value="">-- Pilih Mata Pelajaran --</option>
                  @foreach($mapels as $mapel)
                    <option value="{{ $mapel->id }}"
                      {{ old('mapel_id', optional($user->guru)->mapel_id) == $mapel->id ? 'selected' : '' }}>
                      {{ $mapel->nama_mapel }}
                    </option>
                  @endforeach
                </select>
                <i class="fa-solid fa-chevron-down eg-select-arrow"></i>
              </div>
              @error('mapel_id')
                <div class="eg-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

          </div>{{-- /.eg-grid-2 --}}
        </div>{{-- /.eg-section --}}

      </div>{{-- /.eg-body --}}

      {{-- ── FOOTER ── --}}
      <div class="eg-footer">
        <a href="{{ route('guru.index') }}" class="eg-btn eg-btn-back">
          <i class="fa-solid fa-arrow-left"></i>
          Kembali
        </a>
        <button type="submit" class="eg-btn eg-btn-submit">
          <i class="fa-solid fa-floppy-disk"></i>
          Simpan Perubahan
        </button>
      </div>

    </form>
  </div>{{-- /.eg-card --}}
</div>

</x-app-layout>