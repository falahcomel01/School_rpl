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
  .em-page {
    padding: 28px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── CARD ── */
  .em-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    max-width: 760px;
    margin: 0 auto;
  }

  /* ── CARD HEADER ── */
  .em-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 28px 20px;
    border-bottom: 1px solid rgba(59,130,246,0.12);
    background: linear-gradient(135deg, var(--n800) 0%, var(--n600) 100%);
    position: relative;
    overflow: hidden;
  }

  .em-card-header::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(59,130,246,0.1);
    pointer-events: none;
  }

  .em-card-header::after {
    content: '';
    position: absolute;
    bottom: -30px; right: 120px;
    width: 110px; height: 110px;
    border-radius: 50%;
    background: rgba(14,165,233,0.07);
    pointer-events: none;
  }

  .em-header-icon {
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

  .em-header-text {
    flex: 1;
    display: flex;
    flex-direction: column;
    position: relative; z-index: 1;
  }

  .em-header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
  }

  .em-header-sub {
    font-size: 12px;
    color: rgba(191,219,254,0.75);
    margin-top: 3px;
  }

  /* Badge mapel di header */
  .em-header-badge {
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

  .em-header-badge-avatar {
    width: 32px; height: 32px;
    border-radius: 9px;
    background: linear-gradient(135deg, var(--n400), var(--n200));
    display: flex; align-items: center; justify-content: center;
    font-size: 13px;
    color: #fff;
    flex-shrink: 0;
  }

  .em-header-badge-info { display: flex; flex-direction: column; }
  .em-header-badge-name { font-size: 12.5px; font-weight: 700; color: #fff; line-height: 1.2; }
  .em-header-badge-label { font-size: 10.5px; color: rgba(191,219,254,0.7); margin-top: 1px; }

  /* ── BODY ── */
  .em-body {
    padding: 28px 32px 32px;
  }

  /* ── ALERT ── */
  .em-alert {
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

  .em-alert i { font-size: 14px; flex-shrink: 0; margin-top: 1px; }
  .em-alert-success { background: var(--green-bg); border-color: var(--green-bd); color: var(--green-tx); }
  .em-alert-error   { background: var(--red-bg);   border-color: var(--red-bd);   color: var(--red-tx); }

  .em-alert-error ul {
    margin: 6px 0 0 0; padding: 0; list-style: none;
    display: flex; flex-direction: column; gap: 3px;
  }

  .em-alert-error ul li {
    font-size: 12.5px;
    display: flex; align-items: center; gap: 5px;
  }

  .em-alert-error ul li::before { content: '•'; font-size: 16px; line-height: 1; }

  /* ── SECTION ── */
  .em-section { margin-bottom: 24px; }

  .em-section-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--gray-100);
  }

  .em-section-label-icon {
    width: 26px; height: 26px;
    border-radius: 7px;
    background: var(--n50);
    border: 1px solid var(--n100);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px;
    color: var(--n400);
    flex-shrink: 0;
  }

  .em-section-label span {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--gray-400);
  }

  /* ── GRID ── */
  .em-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
  }

  /* ── FORM GROUP ── */
  .em-form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .em-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--gray-700);
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .em-label-required { color: #ef4444; font-size: 13px; line-height: 1; }

  /* ── INPUT WRAPPER ── */
  .em-input-wrap { position: relative; }

  .em-input-icon {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 13px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .em-input {
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

  .em-input:focus {
    outline: none;
    border-color: var(--n300);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
  }

  .em-input-wrap:focus-within .em-input-icon { color: var(--n300); }

  .em-input.is-error {
    border-color: #f87171;
    background: #fff5f5;
  }

  /* Select arrow */
  .em-select-arrow {
    position: absolute;
    right: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 11px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .em-input-wrap:focus-within .em-select-arrow { color: var(--n300); }

  select.em-input { padding-right: 36px; cursor: pointer; }

  /* ── ERROR MSG ── */
  .em-error {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #dc2626;
    font-weight: 500;
    animation: em-shake 0.3s ease;
  }

  .em-error i { font-size: 10px; flex-shrink: 0; }

  @keyframes em-shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-4px); }
    75% { transform: translateX(4px); }
  }

  /* ── FOOTER ── */
  .em-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px 32px 28px;
    border-top: 1px solid var(--gray-100);
    background: var(--gray-50);
  }

  .em-btn {
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

  .em-btn-back {
    background: #fff;
    border-color: var(--gray-200);
    color: var(--gray-700);
  }

  .em-btn-back:hover {
    background: var(--gray-100);
    border-color: var(--gray-400);
    color: var(--gray-900);
    transform: translateY(-1px);
  }

  .em-btn-submit {
    background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border-color: var(--n400);
    color: #fff;
    box-shadow: 0 3px 12px rgba(29,78,216,0.3);
  }

  .em-btn-submit:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.4);
  }

  .em-btn-submit:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(29,78,216,0.25);
  }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .em-page { padding: 16px 12px; }
    .em-body { padding: 20px 18px 24px; }
    .em-footer { padding: 16px 18px 20px; flex-direction: column-reverse; align-items: stretch; }
    .em-btn { justify-content: center; }
    .em-grid-2 { grid-template-columns: 1fr; }
    .em-card-header { padding: 18px 20px; flex-wrap: wrap; gap: 10px; }
    .em-header-badge { display: none; }
  }
</style>

<div class="em-page">
  <div class="em-card">

    {{-- ── HEADER ── --}}
    <div class="em-card-header">
      <div class="em-header-icon">
        <i class="fa-solid fa-book-open"></i>
      </div>
      <div class="em-header-text">
        <span class="em-header-title">Edit Mata Pelajaran</span>
        <span class="em-header-sub">Perbarui informasi jurusan dan nama mata pelajaran</span>
      </div>
      {{-- Badge mapel --}}
      <div class="em-header-badge">
        <div class="em-header-badge-avatar">
          <i class="fa-solid fa-book-open" style="font-size:13px;"></i>
        </div>
        <div class="em-header-badge-info">
          <span class="em-header-badge-name">{{ Str::limit($mapel->nama_mapel, 20) }}</span>
          <span class="em-header-badge-label">ID #{{ $mapel->id }}</span>
        </div>
      </div>
    </div>

    {{-- ── FORM ── --}}
    <form action="{{ route('mapel.update', $mapel->id) }}" method="POST" autocomplete="off">
      @csrf
      @method('PUT')

      <div class="em-body">

        {{-- Alert sukses --}}
        @if(session('success'))
          <div class="em-alert em-alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
          </div>
        @endif

        {{-- Alert block errors --}}
        @if ($errors->any())
          <div class="em-alert em-alert-error">
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
        <div class="em-section" style="margin-bottom:0;">
          <div class="em-section-label">
            <div class="em-section-label-icon"><i class="fa-solid fa-circle-info"></i></div>
            <span>Informasi Mata Pelajaran</span>
          </div>

          <div class="em-grid-2">

            {{-- Jurusan --}}
            <div class="em-form-group">
              <label class="em-label">Jurusan</label>
              <div class="em-input-wrap">
                <i class="fa-solid fa-graduation-cap em-input-icon"></i>
                <select
                  name="jurusan_id"
                  class="em-input {{ $errors->has('jurusan_id') ? 'is-error' : '' }}"
                >
                  <option value="">Wajib Diampu</option>
                  @foreach ($jurusan as $j)
                    <option value="{{ $j->id }}"
                      {{ old('jurusan_id', $mapel->jurusan_id) == $j->id ? 'selected' : '' }}>
                      {{ $j->nama_jurusan }}
                    </option>
                  @endforeach
                </select>
                <i class="fa-solid fa-chevron-down em-select-arrow"></i>
              </div>
              @error('jurusan_id')
                <div class="em-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Nama Mapel --}}
            <div class="em-form-group">
              <label class="em-label">
                Nama Mapel <span class="em-label-required">*</span>
              </label>
              <div class="em-input-wrap">
                <i class="fa-solid fa-book-open em-input-icon"></i>
                <input
                  type="text"
                  name="nama_mapel"
                  value="{{ old('nama_mapel', $mapel->nama_mapel) }}"
                  placeholder="Masukkan nama mata pelajaran"
                  class="em-input {{ $errors->has('nama_mapel') ? 'is-error' : '' }}"
                  required
                >
              </div>
              @error('nama_mapel')
                <div class="em-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

          </div>{{-- /.em-grid-2 --}}
        </div>{{-- /.em-section --}}

      </div>{{-- /.em-body --}}

      {{-- ── FOOTER ── --}}
      <div class="em-footer">
        <a href="{{ route('mapel.index') }}" class="em-btn em-btn-back">
          <i class="fa-solid fa-arrow-left"></i>
          Kembali
        </a>
        <button type="submit" class="em-btn em-btn-submit">
          <i class="fa-solid fa-floppy-disk"></i>
          Simpan Perubahan
        </button>
      </div>

    </form>
  </div>{{-- /.em-card --}}
</div>

</x-app-layout>