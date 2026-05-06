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
    --shadow-sm: 0 1px 3px rgba(10,22,60,0.07);
    --shadow-md: 0 4px 16px rgba(10,22,60,0.10);
    --shadow-lg: 0 8px 32px rgba(10,22,60,0.15);
  }

  /* ── PAGE ── */
  .ek-page {
    padding: 28px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── CARD ── */
  .ek-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    max-width: 760px;
    margin: 0 auto;
  }

  /* ── CARD HEADER ── */
  .ek-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 28px 20px;
    border-bottom: 1px solid rgba(59,130,246,0.12);
    background: linear-gradient(135deg, var(--n800) 0%, var(--n600) 100%);
    position: relative;
    overflow: hidden;
  }

  .ek-card-header::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(59,130,246,0.1);
    pointer-events: none;
  }

  .ek-card-header::after {
    content: '';
    position: absolute;
    bottom: -30px; right: 120px;
    width: 110px; height: 110px;
    border-radius: 50%;
    background: rgba(14,165,233,0.07);
    pointer-events: none;
  }

  .ek-header-icon {
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

  .ek-header-text {
    flex: 1;
    display: flex;
    flex-direction: column;
    position: relative; z-index: 1;
  }

  .ek-header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
  }

  .ek-header-sub {
    font-size: 12px;
    color: rgba(191,219,254,0.75);
    margin-top: 3px;
  }

  /* Kelas badge in header */
  .ek-header-badge {
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

  .ek-header-badge-avatar {
    width: 32px; height: 32px;
    border-radius: 9px;
    background: linear-gradient(135deg, var(--n400), var(--n200));
    display: flex; align-items: center; justify-content: center;
    font-size: 13px;
    color: #fff;
    flex-shrink: 0;
  }

  .ek-header-badge-info { display: flex; flex-direction: column; }
  .ek-header-badge-name { font-size: 12.5px; font-weight: 700; color: #fff; line-height: 1.2; }
  .ek-header-badge-label { font-size: 10.5px; color: rgba(191,219,254,0.7); margin-top: 1px; }

  /* ── BODY ── */
  .ek-body {
    padding: 28px 32px;
  }

  /* ── ALERT ── */
  .ek-alert {
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

  .ek-alert i { font-size: 14px; flex-shrink: 0; margin-top: 1px; }
  .ek-alert-success { background: var(--green-bg); border-color: var(--green-bd); color: var(--green-tx); }
  .ek-alert-error   { background: var(--red-bg);   border-color: var(--red-bd);   color: var(--red-tx); }

  .ek-alert-error ul {
    margin: 6px 0 0 0; padding: 0; list-style: none;
    display: flex; flex-direction: column; gap: 3px;
  }

  .ek-alert-error ul li {
    font-size: 12.5px;
    display: flex; align-items: center; gap: 5px;
  }

  .ek-alert-error ul li::before { content: '•'; font-size: 16px; line-height: 1; }

  /* ── SECTION ── */
  .ek-section { margin-bottom: 24px; }

  .ek-section-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--gray-100);
  }

  .ek-section-label-icon {
    width: 26px; height: 26px;
    border-radius: 7px;
    background: var(--n50);
    border: 1px solid var(--n100);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px;
    color: var(--n400);
    flex-shrink: 0;
  }

  .ek-section-label span {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--gray-400);
  }

  /* ── GRID ── */
  .ek-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
  }

  .ek-grid-1 {
    display: grid;
    grid-template-columns: 1fr;
    gap: 18px;
  }

  /* ── FORM GROUP ── */
  .ek-form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .ek-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--gray-700);
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .ek-label-required {
    color: #ef4444;
    font-size: 13px;
    line-height: 1;
  }

  /* ── INPUT WRAPPER ── */
  .ek-input-wrap { position: relative; }

  .ek-input-icon {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 13px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .ek-input {
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

  .ek-input:focus {
    outline: none;
    border-color: var(--n300);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
  }

  .ek-input-wrap:focus-within .ek-input-icon { color: var(--n300); }

  .ek-input.is-error {
    border-color: #f87171;
    background: #fff5f5;
  }

  /* Select arrow */
  .ek-select-arrow {
    position: absolute;
    right: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 11px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .ek-input-wrap:focus-within .ek-select-arrow { color: var(--n300); }

  select.ek-input { padding-right: 36px; cursor: pointer; }

  /* ── ERROR MSG ── */
  .ek-error {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #dc2626;
    font-weight: 500;
    animation: ek-shake 0.3s ease;
  }

  .ek-error i { font-size: 10px; flex-shrink: 0; }

  @keyframes ek-shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-4px); }
    75% { transform: translateX(4px); }
  }

  /* ── FOOTER ── */
  .ek-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px 32px 28px;
    border-top: 1px solid var(--gray-100);
    background: var(--gray-50);
  }

  .ek-btn {
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
    background: none;
  }

  .ek-btn-back {
    background: #fff;
    border-color: var(--gray-200);
    color: var(--gray-700);
  }

  .ek-btn-back:hover {
    background: var(--gray-100);
    border-color: var(--gray-400);
    color: var(--gray-900);
    transform: translateY(-1px);
  }

  .ek-btn-submit {
    background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border-color: var(--n400);
    color: #fff;
    box-shadow: 0 3px 12px rgba(29,78,216,0.3);
  }

  .ek-btn-submit:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.4);
  }

  .ek-btn-submit:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(29,78,216,0.25);
  }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .ek-page { padding: 16px 12px; }
    .ek-body { padding: 20px 18px; }
    .ek-footer { padding: 16px 18px 20px; flex-direction: column-reverse; align-items: stretch; }
    .ek-btn { justify-content: center; }
    .ek-grid-2 { grid-template-columns: 1fr; }
    .ek-card-header { padding: 18px 20px; flex-wrap: wrap; gap: 10px; }
    .ek-header-badge { display: none; }
  }
</style>

<div class="ek-page">
  <div class="ek-card">

    {{-- ── HEADER ── --}}
    <div class="ek-card-header">
      <div class="ek-header-icon">
        <i class="fa-solid fa-chalkboard-user"></i>
      </div>
      <div class="ek-header-text">
        <span class="ek-header-title">Edit Kelas</span>
        <span class="ek-header-sub">Perbarui informasi jurusan dan nama kelas</span>
      </div>
      {{-- Kelas badge --}}
      <div class="ek-header-badge">
        <div class="ek-header-badge-avatar">
          <i class="fa-solid fa-door-open" style="font-size:13px;"></i>
        </div>
        <div class="ek-header-badge-info">
          <span class="ek-header-badge-name">{{ Str::limit($kelas->nama_kelas, 20) }}</span>
          <span class="ek-header-badge-label">ID #{{ $kelas->id }}</span>
        </div>
      </div>
    </div>

    {{-- ── FORM ── --}}
    <form action="{{ route('kelas.update', $kelas->id) }}" method="POST" autocomplete="off">
      @csrf
      @method('PUT')

      <div class="ek-body">

        {{-- Alerts --}}
        @if(session('berhasil'))
          <div class="ek-alert ek-alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('berhasil') }}</span>
          </div>
        @endif

        @if ($errors->any())
          <div class="ek-alert ek-alert-error">
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

        {{-- ── SECTION: INFO KELAS ── --}}
        <div class="ek-section" style="margin-bottom:0;">
          <div class="ek-section-label">
            <div class="ek-section-label-icon"><i class="fa-solid fa-circle-info"></i></div>
            <span>Informasi Kelas</span>
          </div>

          <div class="ek-grid-2">

            {{-- Jurusan --}}
            <div class="ek-form-group">
              <label class="ek-label">
                Jurusan
              </label>
              <div class="ek-input-wrap">
                <i class="fa-solid fa-layer-group ek-input-icon"></i>
                <select
                  name="jurusan_id"
                  class="ek-input {{ $errors->has('jurusan_id') ? 'is-error' : '' }}"
                >
                  <option value="" {{ $kelas->jurusan_id == null ? 'selected' : '' }}>
                    Tidak Ada Jurusan
                  </option>
                  @foreach ($jurusan as $j)
                    <option value="{{ $j->id }}" {{ $kelas->jurusan_id == $j->id ? 'selected' : '' }}>
                      {{ $j->nama_jurusan }}
                    </option>
                  @endforeach
                </select>
                <i class="fa-solid fa-chevron-down ek-select-arrow"></i>
              </div>
              @error('jurusan_id')
                <div class="ek-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Nama Kelas --}}
            <div class="ek-form-group">
              <label class="ek-label">
                Nama Kelas <span class="ek-label-required">*</span>
              </label>
              <div class="ek-input-wrap">
                <i class="fa-solid fa-door-open ek-input-icon"></i>
                <input
                  type="text"
                  name="nama_kelas"
                  value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                  placeholder="Masukkan nama kelas"
                  class="ek-input {{ $errors->has('nama_kelas') ? 'is-error' : '' }}"
                  required
                >
              </div>
              @error('nama_kelas')
                <div class="ek-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

          </div>{{-- /.ek-grid-2 --}}
        </div>{{-- /.ek-section --}}

      </div>{{-- /.ek-body --}}

      {{-- ── FOOTER ── --}}
      <div class="ek-footer">
        <a href="{{ route('kelas.index') }}" class="ek-btn ek-btn-back">
          <i class="fa-solid fa-arrow-left"></i>
          Kembali
        </a>
        <button type="submit" class="ek-btn ek-btn-submit">
          <i class="fa-solid fa-floppy-disk"></i>
          Simpan Perubahan
        </button>
      </div>

    </form>
  </div>{{-- /.ek-card --}}
</div>

</x-app-layout>