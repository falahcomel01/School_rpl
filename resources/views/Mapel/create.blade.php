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
  .cm-page {
    padding: 28px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── CARD ── */
  .cm-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    max-width: 760px;
    margin: 0 auto;
  }

  /* ── CARD HEADER ── */
  .cm-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 28px 20px;
    border-bottom: 1px solid rgba(59,130,246,0.12);
    background: linear-gradient(135deg, var(--n800) 0%, var(--n600) 100%);
    position: relative;
    overflow: hidden;
  }

  .cm-card-header::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(59,130,246,0.1);
    pointer-events: none;
  }

  .cm-card-header::after {
    content: '';
    position: absolute;
    bottom: -30px; right: 120px;
    width: 110px; height: 110px;
    border-radius: 50%;
    background: rgba(14,165,233,0.07);
    pointer-events: none;
  }

  .cm-header-icon {
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

  .cm-header-text {
    display: flex;
    flex-direction: column;
    position: relative; z-index: 1;
  }

  .cm-header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
  }

  .cm-header-sub {
    font-size: 12px;
    color: rgba(191,219,254,0.75);
    margin-top: 3px;
  }

  /* ── BODY ── */
  .cm-body {
    padding: 28px 32px 32px;
  }

  /* ── ALERT ── */
  .cm-alert {
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

  .cm-alert i { font-size: 14px; flex-shrink: 0; margin-top: 1px; }

  .cm-alert-success { background: var(--green-bg); border-color: var(--green-bd); color: var(--green-tx); }
  .cm-alert-error   { background: var(--red-bg);   border-color: var(--red-bd);   color: var(--red-tx); }

  .cm-alert-error ul {
    margin: 6px 0 0 0; padding: 0; list-style: none;
    display: flex; flex-direction: column; gap: 3px;
  }

  .cm-alert-error ul li {
    font-size: 12.5px;
    display: flex; align-items: center; gap: 5px;
  }

  .cm-alert-error ul li::before { content: '•'; font-size: 16px; line-height: 1; }

  /* ── SECTION ── */
  .cm-section { margin-bottom: 24px; }

  .cm-section-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--gray-100);
  }

  .cm-section-label-icon {
    width: 26px; height: 26px;
    border-radius: 7px;
    background: var(--n50);
    border: 1px solid var(--n100);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px;
    color: var(--n400);
    flex-shrink: 0;
  }

  .cm-section-label span {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--gray-400);
  }

  /* ── GRID ── */
  .cm-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
  }

  /* ── FORM GROUP ── */
  .cm-form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .cm-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--gray-700);
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .cm-label-required { color: #ef4444; font-size: 13px; line-height: 1; }

  /* ── INPUT WRAPPER ── */
  .cm-input-wrap { position: relative; }

  .cm-input-icon {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 13px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .cm-input {
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

  .cm-input:focus {
    outline: none;
    border-color: var(--n300);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
  }

  .cm-input-wrap:focus-within .cm-input-icon { color: var(--n300); }

  .cm-input.is-error {
    border-color: #f87171;
    background: #fff5f5;
  }

  /* Select arrow */
  .cm-select-arrow {
    position: absolute;
    right: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 11px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .cm-input-wrap:focus-within .cm-select-arrow { color: var(--n300); }

  select.cm-input { padding-right: 36px; cursor: pointer; }

  /* ── ERROR MSG ── */
  .cm-error {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #dc2626;
    font-weight: 500;
    animation: cm-shake 0.3s ease;
  }

  .cm-error i { font-size: 10px; flex-shrink: 0; }

  @keyframes cm-shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-4px); }
    75% { transform: translateX(4px); }
  }

  /* ── FOOTER ── */
  .cm-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px 32px 28px;
    border-top: 1px solid var(--gray-100);
    background: var(--gray-50);
  }

  .cm-btn {
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

  .cm-btn-back {
    background: #fff;
    border-color: var(--gray-200);
    color: var(--gray-700);
  }

  .cm-btn-back:hover {
    background: var(--gray-100);
    border-color: var(--gray-400);
    color: var(--gray-900);
    transform: translateY(-1px);
  }

  .cm-btn-submit {
    background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border-color: var(--n400);
    color: #fff;
    box-shadow: 0 3px 12px rgba(29,78,216,0.3);
  }

  .cm-btn-submit:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.4);
  }

  .cm-btn-submit:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(29,78,216,0.25);
  }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .cm-page { padding: 16px 12px; }
    .cm-body { padding: 20px 18px 24px; }
    .cm-footer { padding: 16px 18px 20px; flex-direction: column-reverse; align-items: stretch; }
    .cm-btn { justify-content: center; }
    .cm-grid-2 { grid-template-columns: 1fr; }
    .cm-card-header { padding: 18px 20px; }
  }
</style>

<div class="cm-page">
  <div class="cm-card">

    {{-- ── HEADER ── --}}
    <div class="cm-card-header">
      <div class="cm-header-icon">
        <i class="fa-solid fa-book-open"></i>
      </div>
      <div class="cm-header-text">
        <span class="cm-header-title">Tambah Mata Pelajaran</span>
        <span class="cm-header-sub">Isi informasi untuk menambahkan mapel baru ke sistem</span>
      </div>
    </div>

    {{-- ── FORM ── --}}
    <form action="{{ route('mapel.store') }}" method="POST" autocomplete="off">
      @csrf

      <div class="cm-body">

        {{-- Alert sukses --}}
        @if(session('success'))
          <div class="cm-alert cm-alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
          </div>
        @endif

        {{-- Alert block errors --}}
        @if ($errors->any())
          <div class="cm-alert cm-alert-error">
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

        {{-- ── SECTION: INFO MAPEL ── --}}
        <div class="cm-section" style="margin-bottom:0;">
          <div class="cm-section-label">
            <div class="cm-section-label-icon"><i class="fa-solid fa-circle-info"></i></div>
            <span>Informasi Mata Pelajaran</span>
          </div>

          <div class="cm-grid-2">

            {{-- Jurusan --}}
            <div class="cm-form-group">
              <label class="cm-label">
                Jurusan
              </label>
              <div class="cm-input-wrap">
                <i class="fa-solid fa-graduation-cap cm-input-icon"></i>
                <select
                  name="jurusan_id"
                  class="cm-input {{ $errors->has('jurusan_id') ? 'is-error' : '' }}"
                >
                  <option value="">Wajib Diampu</option>
                  @foreach ($jurusan as $j)
                    <option value="{{ $j->id }}" {{ old('jurusan_id') == $j->id ? 'selected' : '' }}>
                      {{ $j->nama_jurusan }}
                    </option>
                  @endforeach
                </select>
                <i class="fa-solid fa-chevron-down cm-select-arrow"></i>
              </div>
              @error('jurusan_id')
                <div class="cm-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Nama Mapel --}}
            <div class="cm-form-group">
              <label class="cm-label">
                Nama Mapel <span class="cm-label-required">*</span>
              </label>
              <div class="cm-input-wrap">
                <i class="fa-solid fa-book-open cm-input-icon"></i>
                <input
                  type="text"
                  name="nama_mapel"
                  value="{{ old('nama_mapel') }}"
                  placeholder="Masukkan nama mata pelajaran"
                  class="cm-input {{ $errors->has('nama_mapel') ? 'is-error' : '' }}"
                  required
                >
              </div>
              @error('nama_mapel')
                <div class="cm-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

          </div>{{-- /.cm-grid-2 --}}
        </div>{{-- /.cm-section --}}

      </div>{{-- /.cm-body --}}

      {{-- ── FOOTER ── --}}
      <div class="cm-footer">
        <a href="{{ route('mapel.index') }}" class="cm-btn cm-btn-back">
          <i class="fa-solid fa-arrow-left"></i>
          Kembali
        </a>
        <button type="submit" class="cm-btn cm-btn-submit">
          <i class="fa-solid fa-floppy-disk"></i>
          Simpan Mapel
        </button>
      </div>

    </form>
  </div>{{-- /.cm-card --}}
</div>

</x-app-layout>