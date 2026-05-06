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
    --green-bg: #d1fae5;
    --green-tx: #065f46;
    --green-bd: #6ee7b7;
    --red-bg:   #fee2e2;
    --red-tx:   #991b1b;
    --red-bd:   #fca5a5;
    --shadow-md: 0 4px 16px rgba(10,22,60,0.10);
  }

  /* ── PAGE ── */
  .ej-page {
    padding: 28px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── CARD ── */
  .ej-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    max-width: 760px;
    margin: 0 auto;
  }

  /* ── CARD HEADER ── */
  .ej-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 28px 20px;
    border-bottom: 1px solid rgba(59,130,246,0.12);
    background: linear-gradient(135deg, var(--n800) 0%, var(--n600) 100%);
    position: relative;
    overflow: hidden;
  }

  .ej-card-header::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(59,130,246,0.1);
    pointer-events: none;
  }

  .ej-card-header::after {
    content: '';
    position: absolute;
    bottom: -30px; right: 120px;
    width: 110px; height: 110px;
    border-radius: 50%;
    background: rgba(14,165,233,0.07);
    pointer-events: none;
  }

  .ej-header-icon {
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

  .ej-header-text {
    flex: 1;
    display: flex;
    flex-direction: column;
    position: relative; z-index: 1;
  }

  .ej-header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
  }

  .ej-header-sub {
    font-size: 12px;
    color: rgba(191,219,254,0.75);
    margin-top: 3px;
  }

  /* Badge jurusan di header */
  .ej-header-badge {
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

  .ej-header-badge-avatar {
    width: 32px; height: 32px;
    border-radius: 9px;
    background: linear-gradient(135deg, var(--n400), var(--n200));
    display: flex; align-items: center; justify-content: center;
    font-size: 13px;
    color: #fff;
    flex-shrink: 0;
  }

  .ej-header-badge-info { display: flex; flex-direction: column; }
  .ej-header-badge-name { font-size: 12.5px; font-weight: 700; color: #fff; line-height: 1.2; }
  .ej-header-badge-label { font-size: 10.5px; color: rgba(191,219,254,0.7); margin-top: 1px; }

  /* ── BODY ── */
  .ej-body {
    padding: 28px 32px 32px;
  }

  /* ── ALERT ── */
  .ej-alert {
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

  .ej-alert i { font-size: 14px; flex-shrink: 0; margin-top: 1px; }

  .ej-alert-success { background: var(--green-bg); border-color: var(--green-bd); color: var(--green-tx); }
  .ej-alert-error   { background: var(--red-bg);   border-color: var(--red-bd);   color: var(--red-tx); }

  .ej-alert-error ul {
    margin: 6px 0 0 0; padding: 0; list-style: none;
    display: flex; flex-direction: column; gap: 3px;
  }

  .ej-alert-error ul li {
    font-size: 12.5px;
    display: flex; align-items: center; gap: 5px;
  }

  .ej-alert-error ul li::before { content: '•'; font-size: 16px; line-height: 1; }

  /* ── SECTION ── */
  .ej-section { margin-bottom: 24px; }

  .ej-section-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--gray-100);
  }

  .ej-section-label-icon {
    width: 26px; height: 26px;
    border-radius: 7px;
    background: var(--n50);
    border: 1px solid var(--n100);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px;
    color: var(--n400);
    flex-shrink: 0;
  }

  .ej-section-label span {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--gray-400);
  }

  /* ── FORM GROUP ── */
  .ej-form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .ej-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--gray-700);
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .ej-label-required { color: #ef4444; font-size: 13px; line-height: 1; }

  /* ── INPUT WRAPPER ── */
  .ej-input-wrap { position: relative; }

  .ej-input-icon {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 13px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .ej-input {
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

  .ej-input:focus {
    outline: none;
    border-color: var(--n300);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
  }

  .ej-input-wrap:focus-within .ej-input-icon { color: var(--n300); }

  .ej-input.is-error {
    border-color: #f87171;
    background: #fff5f5;
  }

  /* ── ERROR MSG ── */
  .ej-error {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #dc2626;
    font-weight: 500;
    animation: ej-shake 0.3s ease;
  }

  .ej-error i { font-size: 10px; flex-shrink: 0; }

  @keyframes ej-shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-4px); }
    75% { transform: translateX(4px); }
  }

  /* ── FOOTER ── */
  .ej-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px 32px 28px;
    border-top: 1px solid var(--gray-100);
    background: var(--gray-50);
  }

  .ej-btn {
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

  .ej-btn-back {
    background: #fff;
    border-color: var(--gray-200);
    color: var(--gray-700);
  }

  .ej-btn-back:hover {
    background: var(--gray-100);
    border-color: var(--gray-400);
    color: var(--gray-900);
    transform: translateY(-1px);
  }

  .ej-btn-submit {
    background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border-color: var(--n400);
    color: #fff;
    box-shadow: 0 3px 12px rgba(29,78,216,0.3);
  }

  .ej-btn-submit:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.4);
  }

  .ej-btn-submit:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(29,78,216,0.25);
  }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .ej-page { padding: 16px 12px; }
    .ej-body { padding: 20px 18px 24px; }
    .ej-footer { padding: 16px 18px 20px; flex-direction: column-reverse; align-items: stretch; }
    .ej-btn { justify-content: center; }
    .ej-card-header { padding: 18px 20px; flex-wrap: wrap; gap: 10px; }
    .ej-header-badge { display: none; }
  }
</style>

<div class="ej-page">
  <div class="ej-card">

    {{-- ── HEADER ── --}}
    <div class="ej-card-header">
      <div class="ej-header-icon">
        <i class="fa-solid fa-pen-to-square"></i>
      </div>
      <div class="ej-header-text">
        <span class="ej-header-title">Edit Jurusan</span>
        <span class="ej-header-sub">Perbarui informasi nama jurusan</span>
      </div>
      {{-- Badge jurusan --}}
      <div class="ej-header-badge">
        <div class="ej-header-badge-avatar">
          <i class="fa-solid fa-graduation-cap" style="font-size:13px;"></i>
        </div>
        <div class="ej-header-badge-info">
          <span class="ej-header-badge-name">{{ Str::limit($jurusan->nama_jurusan, 20) }}</span>
          <span class="ej-header-badge-label">ID #{{ $jurusan->id }}</span>
        </div>
      </div>
    </div>

    {{-- ── FORM ── --}}
    <form action="{{ route('jurusan.update', $jurusan->id) }}" method="POST" autocomplete="off">
      @csrf
      @method('PUT')

      <div class="ej-body">

        {{-- Alerts --}}
        @if(session('berhasil'))
          <div class="ej-alert ej-alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('berhasil') }}</span>
          </div>
        @endif

        @if ($errors->any())
          <div class="ej-alert ej-alert-error">
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

        {{-- ── SECTION: INFO JURUSAN ── --}}
        <div class="ej-section" style="margin-bottom:0;">
          <div class="ej-section-label">
            <div class="ej-section-label-icon"><i class="fa-solid fa-circle-info"></i></div>
            <span>Informasi Jurusan</span>
          </div>

          {{-- Nama Jurusan --}}
          <div class="ej-form-group">
            <label class="ej-label">
              Nama Jurusan <span class="ej-label-required">*</span>
            </label>
            <div class="ej-input-wrap">
              <i class="fa-solid fa-graduation-cap ej-input-icon"></i>
              <input
                type="text"
                name="nama_jurusan"
                value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}"
                placeholder="Masukkan nama jurusan"
                class="ej-input {{ $errors->has('nama_jurusan') ? 'is-error' : '' }}"
                required
              >
            </div>
            @error('nama_jurusan')
              <div class="ej-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
            @enderror
          </div>

        </div>{{-- /.ej-section --}}

      </div>{{-- /.ej-body --}}

      {{-- ── FOOTER ── --}}
      <div class="ej-footer">
        <a href="{{ route('jurusan.index') }}" class="ej-btn ej-btn-back">
          <i class="fa-solid fa-arrow-left"></i>
          Kembali
        </a>
        <button type="submit" class="ej-btn ej-btn-submit">
          <i class="fa-solid fa-floppy-disk"></i>
          Simpan Perubahan
        </button>
      </div>

    </form>
  </div>{{-- /.ej-card --}}
</div>

</x-app-layout>