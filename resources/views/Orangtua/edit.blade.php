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
    --red-50:   #fef2f2;
    --red-100:  #fee2e2;
    --red-200:  #fecaca;
    --red-400:  #f87171;
    --red-600:  #dc2626;
    --red-700:  #b91c1c;
    --red-800:  #991b1b;
    --red-900:  #7f1d1d;
    --green-bg: #d1fae5;
    --green-tx: #065f46;
    --green-bd: #6ee7b7;
    --shadow-sm: 0 1px 3px rgba(10,22,60,0.07);
    --shadow-md: 0 4px 16px rgba(10,22,60,0.10);
    --shadow-lg: 0 8px 32px rgba(10,22,60,0.15);
  }

  /* ── PAGE ── */
  .eo-page {
    padding: 28px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── CARD ── */
  .eo-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    max-width: 760px;
    margin: 0 auto;
  }

  /* ── CARD HEADER ── */
  .eo-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 28px 20px;
    border-bottom: 1px solid rgba(59,130,246,0.12);
    background: linear-gradient(135deg, var(--n800) 0%, var(--n600) 100%);
    position: relative;
    overflow: hidden;
  }

  .eo-card-header::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(59,130,246,0.1);
    pointer-events: none;
  }

  .eo-card-header::after {
    content: '';
    position: absolute;
    bottom: -30px; right: 120px;
    width: 110px; height: 110px;
    border-radius: 50%;
    background: rgba(14,165,233,0.07);
    pointer-events: none;
  }

  .eo-header-icon {
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

  .eo-header-text {
    flex: 1;
    display: flex;
    flex-direction: column;
    position: relative; z-index: 1;
  }

  .eo-header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
  }

  .eo-header-sub {
    font-size: 12px;
    color: rgba(191,219,254,0.75);
    margin-top: 3px;
  }

  /* Badge di header */
  .eo-header-badge {
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

  .eo-header-badge-avatar {
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

  .eo-header-badge-info { display: flex; flex-direction: column; }
  .eo-header-badge-name { font-size: 12.5px; font-weight: 700; color: #fff; line-height: 1.2; }
  .eo-header-badge-label { font-size: 10.5px; color: rgba(191,219,254,0.7); margin-top: 1px; }

  /* ── BODY ── */
  .eo-body {
    padding: 28px 32px;
  }

  /* ── ALERT ── */
  .eo-alert {
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

  .eo-alert i { font-size: 14px; flex-shrink: 0; margin-top: 1px; }
  .eo-alert-success { background: var(--green-bg); border-color: var(--green-bd); color: var(--green-tx); }
  .eo-alert-error   { background: var(--red-100);  border-color: var(--red-400);  color: var(--red-800); }

  /* ── SECTION ── */
  .eo-section { margin-bottom: 24px; }

  .eo-section-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--gray-100);
  }

  .eo-section-label-icon {
    width: 26px; height: 26px;
    border-radius: 7px;
    background: var(--n50);
    border: 1px solid var(--n100);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px;
    color: var(--n400);
    flex-shrink: 0;
  }

  .eo-section-label span {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--gray-400);
  }

  /* ── GRID ── */
  .eo-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
  }

  /* ── FORM GROUP ── */
  .eo-form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .eo-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--gray-700);
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .eo-label-required { color: #ef4444; font-size: 13px; line-height: 1; }

  /* ── INPUT / SELECT WRAPPER ── */
  .eo-input-wrap { position: relative; }

  .eo-input-icon {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 13px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
    z-index: 1;
  }

  .eo-input,
  .eo-select {
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

  .eo-input:focus,
  .eo-select:focus {
    outline: none;
    border-color: var(--n300);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
  }

  .eo-input-wrap:focus-within .eo-input-icon { color: var(--n300); }

  .eo-input.is-error,
  .eo-select.is-error {
    border-color: #f87171;
    background: #fff5f5;
  }

  /* Chevron untuk select */
  .eo-select-chevron {
    position: absolute;
    right: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 11px;
    color: var(--gray-400);
    pointer-events: none;
  }

  /* ── ERROR MSG ── */
  .eo-error {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: var(--red-600);
    font-weight: 500;
    animation: eo-shake 0.3s ease;
  }

  .eo-error i { font-size: 10px; flex-shrink: 0; }

  @keyframes eo-shake {
    0%, 100% { transform: translateX(0); }
    25%       { transform: translateX(-4px); }
    75%       { transform: translateX(4px); }
  }

  /* ── INFO BOX ── */
  .eo-info-box {
    display: flex;
    gap: 12px;
    padding: 14px 16px;
    background: var(--n50);
    border: 1px solid var(--n100);
    border-left: 4px solid var(--n400);
    border-radius: 10px;
    margin-top: 4px;
  }

  .eo-info-box-icon {
    font-size: 15px;
    color: var(--n400);
    flex-shrink: 0;
    margin-top: 1px;
  }

  .eo-info-box-content {
    font-size: 13px;
    color: var(--n700);
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .eo-info-box-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: var(--n400);
    margin-bottom: 4px;
  }

  .eo-info-item {
    display: flex;
    align-items: flex-start;
    gap: 7px;
    font-size: 13px;
    line-height: 1.4;
  }

  .eo-info-item i {
    font-size: 9px;
    color: var(--n300);
    margin-top: 4px;
    flex-shrink: 0;
  }

  /* ── FOOTER BUTTONS ── */
  .eo-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px 32px 28px;
    border-top: 1px solid var(--gray-100);
    background: var(--gray-50);
  }

  .eo-btn {
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

  .eo-btn-back {
    background: #fff;
    border-color: var(--gray-200);
    color: var(--gray-700);
  }

  .eo-btn-back:hover {
    background: var(--gray-100);
    border-color: var(--gray-400);
    color: var(--gray-900);
    transform: translateY(-1px);
  }

  .eo-btn-submit {
    background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border-color: var(--n400);
    color: #fff;
    box-shadow: 0 3px 12px rgba(29,78,216,0.3);
  }

  .eo-btn-submit:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.4);
  }

  .eo-btn-submit:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(29,78,216,0.25);
  }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .eo-page { padding: 16px 12px; }
    .eo-body { padding: 20px 18px; }
    .eo-footer { padding: 16px 18px 20px; flex-direction: column-reverse; align-items: stretch; }
    .eo-btn { justify-content: center; }
    .eo-grid-2 { grid-template-columns: 1fr; }
    .eo-card-header { padding: 18px 20px; flex-wrap: wrap; gap: 10px; }
    .eo-header-badge { display: none; }
  }
</style>

<div class="eo-page">
  <div class="eo-card">

    {{-- ── HEADER ── --}}
    <div class="eo-card-header">
      <div class="eo-header-icon">
        <i class="fa-solid fa-people-arrows"></i>
      </div>
      <div class="eo-header-text">
        <span class="eo-header-title">Edit Hubungan Orang Tua & Siswa</span>
        <span class="eo-header-sub">Perbarui data relasi orang tua dengan siswa</span>
      </div>
      {{-- Badge ID --}}
      <div class="eo-header-badge">
        <div class="eo-header-badge-avatar">
          <i class="fa-solid fa-link" style="font-size:13px;"></i>
        </div>
        <div class="eo-header-badge-info">
          <span class="eo-header-badge-name">Relasi #{{ $orangtua->id }}</span>
          <span class="eo-header-badge-label">Data Orang Tua</span>
        </div>
      </div>
    </div>

    {{-- ── FORM ── --}}
    <form action="{{ route('orangtua.update', $orangtua->id) }}" method="POST" autocomplete="off">
      @csrf
      @method('PUT')

      <div class="eo-body">

        {{-- Alerts --}}
        @if(session('berhasil'))
          <div class="eo-alert eo-alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('berhasil') }}</span>
          </div>
        @endif

        @if ($errors->any())
          <div class="eo-alert eo-alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>
              <div style="font-weight:700; margin-bottom:4px;">Terdapat kesalahan pada form:</div>
              @foreach ($errors->all() as $error)
                <div style="font-size:12.5px; margin-top:3px; display:flex; align-items:center; gap:5px;">
                  <i class="fa-solid fa-circle" style="font-size:5px;"></i> {{ $error }}
                </div>
              @endforeach
            </div>
          </div>
        @endif

        {{-- ── SECTION: PILIH RELASI ── --}}
        <div class="eo-section">
          <div class="eo-section-label">
            <div class="eo-section-label-icon"><i class="fa-solid fa-circle-info"></i></div>
            <span>Data Relasi</span>
          </div>

          <div class="eo-grid-2">

            {{-- Orang Tua --}}
            <div class="eo-form-group">
              <label class="eo-label">
                Pilih Orang Tua <span class="eo-label-required">*</span>
              </label>
              <div class="eo-input-wrap">
                <i class="fa-solid fa-user-tie eo-input-icon"></i>
                <select
                  name="user_id"
                  required
                  class="eo-select {{ $errors->has('user_id') ? 'is-error' : '' }}"
                >
                  <option value="">-- Pilih Orang Tua --</option>
                  @foreach($orangtuaUsers as $ortu)
                    <option value="{{ $ortu->id }}"
                      {{ old('user_id', $orangtua->user_id) == $ortu->id ? 'selected' : '' }}>
                      {{ $ortu->name }} ({{ $ortu->username }})
                    </option>
                  @endforeach
                </select>
                <i class="fa-solid fa-chevron-down eo-select-chevron"></i>
              </div>
              @error('user_id')
                <div class="eo-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Siswa --}}
            <div class="eo-form-group">
              <label class="eo-label">
                Pilih Siswa <span class="eo-label-required">*</span>
              </label>
              <div class="eo-input-wrap">
                <i class="fa-solid fa-user-graduate eo-input-icon"></i>
                <select
                  name="siswa_id"
                  required
                  class="eo-select {{ $errors->has('siswa_id') ? 'is-error' : '' }}"
                >
                  <option value="">-- Pilih Siswa --</option>
                  @foreach($siswas as $siswa)
                    <option value="{{ $siswa->id }}"
                      {{ old('siswa_id', $orangtua->siswa_id) == $siswa->id ? 'selected' : '' }}>
                      {{ $siswa->user->name }} - {{ $siswa->kelas->nama_kelas ?? 'Belum ada kelas' }}
                    </option>
                  @endforeach
                </select>
                <i class="fa-solid fa-chevron-down eo-select-chevron"></i>
              </div>
              @error('siswa_id')
                <div class="eo-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

          </div>{{-- /.eo-grid-2 --}}
        </div>{{-- /.eo-section --}}

        {{-- ── INFO BOX ── --}}
        <div class="eo-section" style="margin-bottom: 0;">
          <div class="eo-section-label">
            <div class="eo-section-label-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <span>Perhatian</span>
          </div>
          <div class="eo-info-box">
            <i class="fa-solid fa-circle-info eo-info-box-icon"></i>
            <div class="eo-info-box-content">
              <div class="eo-info-box-title">Ketentuan Relasi</div>
              <div class="eo-info-item">
                <i class="fa-solid fa-circle"></i>
                <span>1 orang tua hanya bisa terhubung dengan 1 siswa</span>
              </div>
              <div class="eo-info-item">
                <i class="fa-solid fa-circle"></i>
                <span>1 siswa hanya bisa terhubung dengan 1 orang tua</span>
              </div>
              <div class="eo-info-item">
                <i class="fa-solid fa-circle"></i>
                <span>Mengubah data akan memutus hubungan sebelumnya</span>
              </div>
            </div>
          </div>
        </div>

      </div>{{-- /.eo-body --}}

      {{-- ── FOOTER ── --}}
      <div class="eo-footer">
        <a href="{{ route('orangtua.index') }}" class="eo-btn eo-btn-back">
          <i class="fa-solid fa-arrow-left"></i>
          Kembali
        </a>
        <button type="submit" class="eo-btn eo-btn-submit">
          <i class="fa-solid fa-floppy-disk"></i>
          Simpan Perubahan
        </button>
      </div>

    </form>
  </div>{{-- /.eo-card --}}
</div>

</x-app-layout>