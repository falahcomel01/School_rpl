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
    --shadow-md: 0 4px 16px rgba(10,22,60,0.10);
  }

  /* ── PAGE ── */
  .ck-page {
    padding: 28px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── CARD ── */
  .ck-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    max-width: 620px;
    margin: 0 auto;
  }

  /* ── CARD HEADER ── */
  .ck-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 28px 20px;
    border-bottom: 1px solid rgba(59,130,246,0.12);
    background: linear-gradient(135deg, var(--n800) 0%, var(--n600) 100%);
    position: relative;
    overflow: hidden;
  }

  .ck-card-header::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(59,130,246,0.1);
    pointer-events: none;
  }

  .ck-card-header::after {
    content: '';
    position: absolute;
    bottom: -30px; right: 120px;
    width: 110px; height: 110px;
    border-radius: 50%;
    background: rgba(14,165,233,0.07);
    pointer-events: none;
  }

  .ck-header-icon {
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

  .ck-header-text {
    flex: 1;
    display: flex;
    flex-direction: column;
    position: relative; z-index: 1;
  }

  .ck-header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
  }

  .ck-header-sub {
    font-size: 12px;
    color: rgba(191,219,254,0.75);
    margin-top: 3px;
  }

  /* ── BODY ── */
  .ck-body {
    padding: 28px 32px 32px;
  }

  /* ── ALERT ── */
  .ck-alert {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 12px 16px;
    border-radius: 10px;
    font-size: 13.5px;
    font-weight: 500;
    margin-bottom: 22px;
    border: 1px solid;
    background: var(--red-bg);
    border-color: var(--red-bd);
    color: var(--red-tx);
  }

  .ck-alert i { font-size: 14px; flex-shrink: 0; margin-top: 1px; }
  .ck-alert ul { margin: 6px 0 0 0; padding: 0; list-style: none; display: flex; flex-direction: column; gap: 3px; }
  .ck-alert ul li { font-size: 12.5px; display: flex; align-items: center; gap: 5px; }
  .ck-alert ul li::before { content: '•'; font-size: 16px; line-height: 1; }

  /* ── SECTION LABEL ── */
  .ck-section-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--gray-100);
  }

  .ck-section-label-icon {
    width: 26px; height: 26px;
    border-radius: 7px;
    background: var(--n50);
    border: 1px solid var(--n100);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px;
    color: var(--n400);
    flex-shrink: 0;
  }

  .ck-section-label span {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--gray-400);
  }

  /* ── FORM GROUP ── */
  .ck-form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
    margin-bottom: 18px;
  }

  .ck-form-group:last-of-type { margin-bottom: 0; }

  .ck-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--gray-700);
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .ck-label-required { color: #ef4444; font-size: 13px; line-height: 1; }

  /* ── INPUT & SELECT ── */
  .ck-input-wrap { position: relative; }

  .ck-input-icon {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 13px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .ck-input,
  .ck-select {
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

  .ck-input:focus,
  .ck-select:focus {
    outline: none;
    border-color: var(--n300);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
  }

  .ck-input-wrap:focus-within .ck-input-icon { color: var(--n300); }

  .ck-input.is-error,
  .ck-select.is-error { border-color: #f87171; background: #fff5f5; }

  /* Select chevron */
  .ck-select-wrap { position: relative; }

  .ck-select-wrap::after {
    content: '\f107';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    position: absolute;
    right: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 12px;
    color: var(--gray-400);
    pointer-events: none;
  }

  .ck-select-wrap:focus-within::after { color: var(--n300); }

  /* ── ERROR MSG ── */
  .ck-error {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #dc2626;
    font-weight: 500;
    animation: ck-shake 0.3s ease;
  }

  .ck-error i { font-size: 10px; flex-shrink: 0; }

  @keyframes ck-shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-4px); }
    75% { transform: translateX(4px); }
  }

  /* ── FOOTER ── */
  .ck-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px 32px 28px;
    border-top: 1px solid var(--gray-100);
    background: var(--gray-50);
  }

  .ck-btn {
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

  .ck-btn-back {
    background: #fff;
    border-color: var(--gray-200);
    color: var(--gray-700);
  }

  .ck-btn-back:hover {
    background: var(--gray-100);
    border-color: var(--gray-400);
    color: var(--gray-900);
    transform: translateY(-1px);
  }

  .ck-btn-submit {
    background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border-color: var(--n400);
    color: #fff;
    box-shadow: 0 3px 12px rgba(29,78,216,0.3);
  }

  .ck-btn-submit:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.4);
  }

  .ck-btn-submit:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(29,78,216,0.25);
  }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .ck-page { padding: 16px 12px; }
    .ck-body { padding: 20px 18px; }
    .ck-footer { padding: 16px 18px 20px; flex-direction: column-reverse; align-items: stretch; }
    .ck-btn { justify-content: center; }
    .ck-card-header { padding: 18px 20px; }
  }
</style>

<div class="ck-page">
  <div class="ck-card">

    {{-- ── HEADER ── --}}
    <div class="ck-card-header">
      <div class="ck-header-icon">
        <i class="fa-solid fa-school"></i>
      </div>
      <div class="ck-header-text">
        <span class="ck-header-title">Tambah Kelas Baru</span>
        <span class="ck-header-sub">Isi informasi kelas dan pilih jurusan yang sesuai</span>
      </div>
    </div>

    {{-- ── FORM ── --}}
    <form method="POST" action="{{ route('kelas.store') }}">
      @csrf

      <div class="ck-body">

        {{-- Alert Error --}}
        @if($errors->any())
          <div class="ck-alert">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>
              <div style="font-weight:700; margin-bottom:4px;">Terdapat kesalahan pada form:</div>
              <ul>
                @foreach($errors->all() as $e)
                  <li>{{ $e }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        @endif

        {{-- ── SECTION ── --}}
        <div class="ck-section-label">
          <div class="ck-section-label-icon"><i class="fa-solid fa-circle-info"></i></div>
          <span>Informasi Kelas</span>
        </div>

        {{-- Jurusan --}}
        <div class="ck-form-group">
          <label class="ck-label">
            Jurusan <span class="ck-label-required">*</span>
          </label>
          <div class="ck-input-wrap ck-select-wrap">
            <i class="fa-solid fa-building-columns ck-input-icon"></i>
            <select
              name="jurusan_id"
              class="ck-select {{ $errors->has('jurusan_id') ? 'is-error' : '' }}"
            >
              <option value="">-- Pilih Jurusan --</option>
              @foreach($jurusan as $j)
                <option value="{{ $j->id }}" {{ old('jurusan_id') == $j->id ? 'selected' : '' }}>
                  {{ $j->nama_jurusan }}
                </option>
              @endforeach
            </select>
          </div>
          @error('jurusan_id')
            <div class="ck-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
          @enderror
        </div>

        {{-- Nama Kelas --}}
        <div class="ck-form-group">
          <label class="ck-label">
            Nama Kelas <span class="ck-label-required">*</span>
          </label>
          <div class="ck-input-wrap">
            <i class="fa-solid fa-chalkboard ck-input-icon"></i>
            <input
              type="text"
              name="nama_kelas"
              value="{{ old('nama_kelas') }}"
              placeholder="Contoh: Kelas 10A"
              class="ck-input {{ $errors->has('nama_kelas') ? 'is-error' : '' }}"
              autocomplete="off"
            >
          </div>
          @error('nama_kelas')
            <div class="ck-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
          @enderror
        </div>

      </div>{{-- /.ck-body --}}

      {{-- ── FOOTER ── --}}
      <div class="ck-footer">
        <a href="{{ route('kelas.index') }}" class="ck-btn ck-btn-back">
          <i class="fa-solid fa-arrow-left"></i>
          Kembali
        </a>
        <button type="submit" class="ck-btn ck-btn-submit">
          <i class="fa-solid fa-floppy-disk"></i>
          Simpan Kelas
        </button>
      </div>

    </form>

  </div>{{-- /.ck-card --}}
</div>

</x-app-layout>