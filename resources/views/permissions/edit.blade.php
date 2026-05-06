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
    --gray-300: #cbd5e1;
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
  .ep-page {
    padding: 28px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── CARD ── */
  .ep-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    max-width: 620px;
    margin: 0 auto;
  }

  /* ── CARD HEADER ── */
  .ep-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 28px 20px;
    border-bottom: 1px solid rgba(59,130,246,0.12);
    background: linear-gradient(135deg, var(--n800) 0%, var(--n600) 100%);
    position: relative;
    overflow: hidden;
  }

  .ep-card-header::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(59,130,246,0.1);
    pointer-events: none;
  }

  .ep-card-header::after {
    content: '';
    position: absolute;
    bottom: -30px; right: 120px;
    width: 110px; height: 110px;
    border-radius: 50%;
    background: rgba(14,165,233,0.07);
    pointer-events: none;
  }

  .ep-header-icon {
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

  .ep-header-text {
    flex: 1;
    display: flex;
    flex-direction: column;
    position: relative; z-index: 1;
  }

  .ep-header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
  }

  .ep-header-sub {
    font-size: 12px;
    color: rgba(191,219,254,0.75);
    margin-top: 3px;
  }

  /* Permission badge in header */
  .ep-header-badge {
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

  .ep-header-badge-avatar {
    width: 32px; height: 32px;
    border-radius: 9px;
    background: linear-gradient(135deg, var(--n400), var(--n200));
    display: flex; align-items: center; justify-content: center;
    font-size: 13px;
    color: #fff;
    flex-shrink: 0;
  }

  .ep-header-badge-info { display: flex; flex-direction: column; }
  .ep-header-badge-name {
    font-size: 12px;
    font-weight: 700;
    color: #fff;
    line-height: 1.2;
    max-width: 140px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .ep-header-badge-label { font-size: 10.5px; color: rgba(191,219,254,0.7); margin-top: 1px; }

  /* ── BODY ── */
  .ep-body {
    padding: 28px 32px 32px;
  }

  /* ── ALERTS ── */
  .ep-alert {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 12px 16px;
    border-radius: 10px;
    font-size: 13.5px;
    font-weight: 500;
    margin-bottom: 22px;
    border: 1px solid;
  }

  .ep-alert i { font-size: 14px; flex-shrink: 0; margin-top: 1px; }
  .ep-alert-success { background: var(--green-bg); border-color: var(--green-bd); color: var(--green-tx); }
  .ep-alert-error   { background: var(--red-bg);   border-color: var(--red-bd);   color: var(--red-tx); }

  .ep-alert-error ul { margin: 6px 0 0 0; padding: 0; list-style: none; display: flex; flex-direction: column; gap: 3px; }
  .ep-alert-error ul li { font-size: 12.5px; display: flex; align-items: center; gap: 5px; }
  .ep-alert-error ul li::before { content: '•'; font-size: 16px; line-height: 1; }

  /* ── SECTION LABEL ── */
  .ep-section-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--gray-100);
  }

  .ep-section-label-icon {
    width: 26px; height: 26px;
    border-radius: 7px;
    background: var(--n50);
    border: 1px solid var(--n100);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px;
    color: var(--n400);
    flex-shrink: 0;
  }

  .ep-section-label span {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--gray-400);
  }

  /* ── INFO GRID (ID + Dibuat pada) ── */
  .ep-info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 22px;
  }

  .ep-info-item {
    display: flex;
    flex-direction: column;
    gap: 5px;
  }

  .ep-info-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    color: var(--gray-400);
  }

  .ep-info-value {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 8px 12px;
    background: var(--gray-100);
    border: 1.5px solid var(--gray-200);
    border-radius: 9px;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    color: var(--gray-500);
  }

  .ep-info-value i { font-size: 11px; color: var(--gray-400); flex-shrink: 0; }

  /* ── FORM GROUP ── */
  .ep-form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .ep-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--gray-700);
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .ep-label-required { color: #ef4444; font-size: 13px; line-height: 1; }

  /* ── INPUT ── */
  .ep-input-wrap { position: relative; }

  .ep-input-icon {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 13px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .ep-input {
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

  .ep-input:focus {
    outline: none;
    border-color: var(--n300);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
  }

  .ep-input-wrap:focus-within .ep-input-icon { color: var(--n300); }

  .ep-input.is-error { border-color: #f87171; background: #fff5f5; }
  .ep-input.is-error:focus { box-shadow: 0 0 0 3px rgba(239,68,68,0.1); }

  /* ── ERROR MSG ── */
  .ep-error {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #dc2626;
    font-weight: 500;
    animation: ep-shake 0.3s ease;
  }

  .ep-error i { font-size: 10px; flex-shrink: 0; }

  @keyframes ep-shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-4px); }
    75% { transform: translateX(4px); }
  }

  /* ── HINT TEXT ── */
  .ep-hint {
    font-size: 12px;
    color: var(--gray-400);
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .ep-hint i { font-size: 10px; }

  /* ── FOOTER ── */
  .ep-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px 32px 28px;
    border-top: 1px solid var(--gray-100);
    background: var(--gray-50);
  }

  .ep-btn {
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

  .ep-btn-back {
    background: #fff;
    border-color: var(--gray-200);
    color: var(--gray-700);
  }

  .ep-btn-back:hover {
    background: var(--gray-100);
    border-color: var(--gray-400);
    color: var(--gray-900);
    transform: translateY(-1px);
  }

  .ep-btn-submit {
    background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border-color: var(--n400);
    color: #fff;
    box-shadow: 0 3px 12px rgba(29,78,216,0.3);
  }

  .ep-btn-submit:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.4);
  }

  .ep-btn-submit:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(29,78,216,0.25);
  }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .ep-page { padding: 16px 12px; }
    .ep-body { padding: 20px 18px; }
    .ep-footer { padding: 16px 18px 20px; flex-direction: column-reverse; align-items: stretch; }
    .ep-btn { justify-content: center; }
    .ep-card-header { padding: 18px 20px; flex-wrap: wrap; gap: 10px; }
    .ep-header-badge { display: none; }
    .ep-info-grid { grid-template-columns: 1fr; }
  }
</style>

<div class="ep-page">
  <div class="ep-card">

    {{-- ── HEADER ── --}}
    <div class="ep-card-header">
      <div class="ep-header-icon">
        <i class="fa-solid fa-key"></i>
      </div>
      <div class="ep-header-text">
        <span class="ep-header-title">Edit Permission</span>
        <span class="ep-header-sub">Perbarui nama hak akses yang sudah ada</span>
      </div>
      {{-- Permission badge --}}
      <div class="ep-header-badge">
        <div class="ep-header-badge-avatar">
          <i class="fa-solid fa-key" style="font-size:13px;"></i>
        </div>
        <div class="ep-header-badge-info">
          <span class="ep-header-badge-name">{{ $permissions->name }}</span>
          <span class="ep-header-badge-label">ID #{{ $permissions->id }}</span>
        </div>
      </div>
    </div>

    {{-- ── FORM ── --}}
    <form action="{{ route('permissions.update', $permissions->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="ep-body">

        {{-- Alerts --}}
        @if(session('success'))
          <div class="ep-alert ep-alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
          </div>
        @endif

        @if($errors->any())
          <div class="ep-alert ep-alert-error">
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

        {{-- ── SECTION: INFO PERMISSION ── --}}
        <div class="ep-section-label">
          <div class="ep-section-label-icon"><i class="fa-solid fa-circle-info"></i></div>
          <span>Informasi Permission</span>
        </div>

        {{-- Info Grid: ID + Dibuat pada (readonly) --}}
        <div class="ep-info-grid">
          <div class="ep-info-item">
            <span class="ep-info-label">ID Permission</span>
            <div class="ep-info-value">
              <i class="fa-solid fa-hashtag"></i>
              {{ $permissions->id }}
            </div>
          </div>
          <div class="ep-info-item">
            <span class="ep-info-label">Dibuat Pada</span>
            <div class="ep-info-value">
              <i class="fa-regular fa-calendar"></i>
              {{ optional($permissions->created_at)->format('d M Y, H:i') }}
            </div>
          </div>
        </div>

        {{-- Nama Permission --}}
        <div class="ep-form-group">
          <label class="ep-label">
            Nama Permission <span class="ep-label-required">*</span>
          </label>
          <div class="ep-input-wrap">
            <i class="fa-solid fa-key ep-input-icon"></i>
            <input
              type="text"
              name="name"
              id="name"
              value="{{ old('name', $permissions->name) }}"
              placeholder="Contoh: edit-posts, view-users"
              class="ep-input {{ $errors->has('name') ? 'is-error' : '' }}"
              required
              autocomplete="off"
            >
          </div>
          @error('name')
            <div class="ep-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
          @enderror
          <span class="ep-hint">
            <i class="fa-solid fa-circle-info"></i>
            Gunakan format <strong>kata-kerja-objek</strong>, contoh: <em>create-users</em>, <em>delete-posts</em>
          </span>
        </div>

      </div>{{-- /.ep-body --}}

      {{-- ── FOOTER ── --}}
      <div class="ep-footer">
        <a href="{{ route('permissions.index') }}" class="ep-btn ep-btn-back">
          <i class="fa-solid fa-arrow-left"></i>
          Batal
        </a>
        <button type="submit" class="ep-btn ep-btn-submit">
          <i class="fa-solid fa-floppy-disk"></i>
          Simpan Perubahan
        </button>
      </div>

    </form>

  </div>{{-- /.ep-card --}}
</div>

</x-app-layout>