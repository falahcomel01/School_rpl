php

<x-app-layout>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap');

  :root {
    --n800: #0a1628; --n700: #0e1e3d; --n600: #112554;
    --n400: #1d4ed8; --n300: #3b82f6; --n200: #60a5fa;
    --n100: #bfdbfe; --n50:  #eff6ff;
    --gray-50: #f8fafc; --gray-100: #f1f5f9; --gray-200: #e2e8f0;
    --gray-400: #94a3b8; --gray-500: #64748b; --gray-700: #334155; --gray-900: #0f172a;
    --amber-bg: #fffbeb; --amber-bd: #fcd34d; --amber-tx: #92400e;
    --shadow-md: 0 4px 16px rgba(10,22,60,0.10);
  }

  .cot-page { padding: 28px 20px; font-family: 'DM Sans', sans-serif; }

  .cot-card {
    background: #fff; border-radius: 16px; border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md); overflow: hidden; max-width: 680px; margin: 0 auto;
  }

  /* ── HEADER ── */
  .cot-card-header {
    display: flex; align-items: center; gap: 14px; padding: 22px 28px 20px;
    background: linear-gradient(135deg, var(--n800) 0%, var(--n600) 100%);
    border-bottom: 1px solid rgba(59,130,246,0.12);
    position: relative; overflow: hidden;
  }
  .cot-card-header::before {
    content:''; position:absolute; top:-50px; right:-50px; width:180px; height:180px;
    border-radius:50%; background:rgba(59,130,246,0.1); pointer-events:none;
  }
  .cot-card-header::after {
    content:''; position:absolute; bottom:-30px; right:120px; width:110px; height:110px;
    border-radius:50%; background:rgba(14,165,233,0.07); pointer-events:none;
  }
  .cot-header-icon {
    width:44px; height:44px; border-radius:12px;
    background:rgba(255,255,255,0.12); border:1px solid rgba(255,255,255,0.2);
    display:flex; align-items:center; justify-content:center;
    font-size:18px; color:#fff; flex-shrink:0; position:relative; z-index:1;
  }
  .cot-header-text { display:flex; flex-direction:column; position:relative; z-index:1; }
  .cot-header-title {
    font-family:'Plus Jakarta Sans',sans-serif; font-size:18px;
    font-weight:800; color:#fff; line-height:1.2;
  }
  .cot-header-sub { font-size:12px; color:rgba(191,219,254,0.75); margin-top:3px; }

  /* ── BODY ── */
  .cot-body { padding: 28px 32px 8px; }

  /* ── ALERT WARNING ── */
  .cot-alert-warning {
    display: flex; align-items: flex-start; gap: 12px;
    padding: 14px 16px; border-radius: 10px; border: 1px solid var(--amber-bd);
    background: var(--amber-bg); color: var(--amber-tx);
    font-size: 13.5px; font-weight: 500; margin-bottom: 24px;
  }
  .cot-alert-warning i { font-size: 16px; flex-shrink: 0; margin-top: 1px; }
  .cot-alert-warning strong { font-weight: 700; display: block; margin-bottom: 3px; }

  /* ── SECTION ── */
  .cot-section { margin-bottom: 24px; }
  .cot-section-label {
    display:flex; align-items:center; gap:8px;
    margin-bottom:16px; padding-bottom:10px; border-bottom:1px solid var(--gray-100);
  }
  .cot-section-label-icon {
    width:26px; height:26px; border-radius:7px;
    background:var(--n50); border:1px solid var(--n100);
    display:flex; align-items:center; justify-content:center;
    font-size:11px; color:var(--n400); flex-shrink:0;
  }
  .cot-section-label span {
    font-family:'Plus Jakarta Sans',sans-serif; font-size:11px;
    font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:var(--gray-400);
  }

  /* ── FORM GROUP ── */
  .cot-form-group { display:flex; flex-direction:column; gap:6px; margin-bottom:18px; }
  .cot-label {
    font-family:'Plus Jakarta Sans',sans-serif; font-size:12.5px;
    font-weight:700; color:var(--gray-700); display:flex; align-items:center; gap:5px;
  }
  .cot-label-required { color:#ef4444; font-size:13px; line-height:1; }

  /* ── SELECT ── */
  .cot-input-wrap { position: relative; }
  .cot-input-icon {
    position:absolute; left:12px; top:50%; transform:translateY(-50%);
    font-size:13px; color:var(--gray-400); pointer-events:none; transition:color 0.18s;
  }
  .cot-select-arrow {
    position:absolute; right:12px; top:50%; transform:translateY(-50%);
    font-size:11px; color:var(--gray-400); pointer-events:none; transition:color 0.18s;
  }
  .cot-select {
    width:100%; padding:10px 36px 10px 36px;
    background:var(--gray-50); border:1.5px solid var(--gray-200);
    border-radius:10px; font-family:'DM Sans',sans-serif;
    font-size:13.5px; color:var(--gray-900);
    transition:all 0.2s ease; box-sizing:border-box;
    appearance:none; -webkit-appearance:none;
  }
  .cot-select:focus {
    outline:none; border-color:var(--n300); background:#fff;
    box-shadow:0 0 0 3px rgba(59,130,246,0.1);
  }
  .cot-input-wrap:focus-within .cot-input-icon { color:var(--n300); }
  .cot-input-wrap:focus-within .cot-select-arrow { color:var(--n300); }
  .cot-select.is-error { border-color:#f87171; background:#fff5f5; }

  /* ── ERROR ── */
  .cot-error {
    display:flex; align-items:center; gap:5px;
    font-size:12px; color:#dc2626; font-weight:500;
    animation:cot-shake 0.3s ease;
  }
  .cot-error i { font-size:10px; }
  @keyframes cot-shake {
    0%,100%{transform:translateX(0)} 25%{transform:translateX(-4px)} 75%{transform:translateX(4px)}
  }

  /* ── INFO BOX ── */
  .cot-info-box {
    display: flex; align-items: flex-start; gap: 12px;
    padding: 14px 16px; border-radius: 10px;
    background: var(--n50); border: 1px solid var(--n100);
    margin-bottom: 8px;
  }
  .cot-info-box-icon {
    width: 28px; height: 28px; border-radius: 8px;
    background: var(--n100); border: 1px solid var(--n200);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px; color: var(--n400); flex-shrink: 0; margin-top: 1px;
  }
  .cot-info-list {
    list-style: none; margin: 0; padding: 0;
    display: flex; flex-direction: column; gap: 5px;
  }
  .cot-info-list li {
    font-size: 12.5px; color: var(--n700); font-weight: 500;
    display: flex; align-items: flex-start; gap: 7px;
  }
  .cot-info-list li::before {
    content: ''; width: 5px; height: 5px; border-radius: 50%;
    background: var(--n300); flex-shrink: 0; margin-top: 5px;
  }

  /* ── FOOTER ── */
  .cot-footer {
    display:flex; align-items:center; justify-content:flex-end; gap:10px;
    padding:20px 32px 28px; border-top:1px solid var(--gray-100); background:var(--gray-50);
  }
  .cot-btn {
    display:inline-flex; align-items:center; gap:8px; padding:10px 22px;
    border-radius:10px; font-family:'Plus Jakarta Sans',sans-serif; font-size:13px;
    font-weight:700; text-decoration:none; border:1.5px solid;
    cursor:pointer; transition:all 0.2s ease; white-space:nowrap;
  }
  .cot-btn-back { background:#fff; border-color:var(--gray-200); color:var(--gray-700); }
  .cot-btn-back:hover { background:var(--gray-100); border-color:var(--gray-400); color:var(--gray-900); transform:translateY(-1px); }
  .cot-btn-submit {
    background:linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border-color:var(--n400); color:#fff; box-shadow:0 3px 12px rgba(29,78,216,0.3);
  }
  .cot-btn-submit:hover {
    background:linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform:translateY(-1px); box-shadow:0 5px 18px rgba(29,78,216,0.4);
  }
  .cot-btn-submit:active { transform:translateY(0); }

  /* ── UNAVAILABLE STATE ── */
  .cot-unavailable {
    text-align: center; padding: 48px 24px 32px;
  }
  .cot-unavailable-icon {
    font-size: 52px; color: var(--gray-200); display: block; margin-bottom: 16px;
  }
  .cot-unavailable p {
    font-size: 14px; color: var(--gray-400); margin: 0 0 20px;
  }

  /* ── RESPONSIVE ── */
  @media (max-width:640px) {
    .cot-page { padding:16px 12px; }
    .cot-body { padding:20px 18px 8px; }
    .cot-footer { padding:16px 18px 20px; flex-direction:column-reverse; align-items:stretch; }
    .cot-btn { justify-content:center; }
    .cot-card-header { padding:18px 20px; }
  }
</style>

<div class="cot-page">
  <div class="cot-card">

    {{-- ── HEADER ── --}}
    <div class="cot-card-header">
      <div class="cot-header-icon"><i class="fa-solid fa-link"></i></div>
      <div class="cot-header-text">
        <span class="cot-header-title">Hubungkan Orang Tua & Siswa</span>
        <span class="cot-header-sub">Tentukan relasi orang tua dengan siswa yang terdaftar</span>
      </div>
    </div>

    {{-- ── KONTEN ── --}}
    @if($noOrangtuaAvailable || $noSiswaAvailable)

      {{-- State: data tidak tersedia --}}
      <div class="cot-unavailable">
        <i class="fa-solid fa-triangle-exclamation cot-unavailable-icon"></i>
        <p>
          @if($noOrangtuaAvailable && $noSiswaAvailable)
            Tidak ada orang tua maupun siswa yang tersedia untuk dihubungkan.
          @elseif($noOrangtuaAvailable)
            Tidak ada orang tua yang tersedia untuk dihubungkan.
          @else
            Tidak ada siswa yang tersedia untuk dihubungkan.
          @endif
        </p>
        <a href="{{ route('orangtua.index') }}" class="cot-btn cot-btn-back" style="display:inline-flex;">
          <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
      </div>

    @else

      <form action="{{ route('orangtua.store') }}" method="POST" autocomplete="off">
        @csrf

        <div class="cot-body">

          {{-- ── SECTION: RELASI ── --}}
          <div class="cot-section">
            <div class="cot-section-label">
              <div class="cot-section-label-icon"><i class="fa-solid fa-people-arrows"></i></div>
              <span>Pilih Relasi</span>
            </div>

            {{-- Orang Tua --}}
            <div class="cot-form-group">
              <label class="cot-label">
                Orang Tua <span class="cot-label-required">*</span>
              </label>
              <div class="cot-input-wrap">
                <i class="fa-solid fa-user-tie cot-input-icon"></i>
                <select name="user_id" required
                  class="cot-select {{ $errors->has('user_id') ? 'is-error' : '' }}">
                  <option value="">-- Pilih Orang Tua --</option>
                  @foreach($orangtuaUsers as $ortu)
                    <option value="{{ $ortu->id }}" {{ old('user_id') == $ortu->id ? 'selected' : '' }}>
                      {{ $ortu->name }} ({{ $ortu->username }})
                    </option>
                  @endforeach
                </select>
                <i class="fa-solid fa-chevron-down cot-select-arrow"></i>
              </div>
              @error('user_id')
                <div class="cot-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

            {{-- Siswa --}}
            <div class="cot-form-group" style="margin-bottom:0;">
              <label class="cot-label">
                Siswa <span class="cot-label-required">*</span>
              </label>
              <div class="cot-input-wrap">
                <i class="fa-solid fa-child cot-input-icon"></i>
                <select name="siswa_id" required
                  class="cot-select {{ $errors->has('siswa_id') ? 'is-error' : '' }}">
                  <option value="">-- Pilih Siswa --</option>
                  @foreach($siswas as $siswa)
                    <option value="{{ $siswa->id }}" {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}>
                      {{ $siswa->user->name }} – {{ $siswa->kelas->nama_kelas ?? 'Belum ada kelas' }}
                    </option>
                  @endforeach
                </select>
                <i class="fa-solid fa-chevron-down cot-select-arrow"></i>
              </div>
              @error('siswa_id')
                <div class="cot-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
              @enderror
            </div>

          </div>{{-- /.cot-section --}}

          {{-- ── INFO BOX ── --}}
          <div class="cot-info-box">
            <div class="cot-info-box-icon"><i class="fa-solid fa-circle-info"></i></div>
            <ul class="cot-info-list">
              <li>1 orang tua hanya bisa terhubung dengan 1 siswa</li>
              <li>1 siswa hanya bisa terhubung dengan 1 orang tua</li>
              <li>Data yang sudah terhubung tidak akan muncul kembali</li>
            </ul>
          </div>

        </div>{{-- /.cot-body --}}

        {{-- ── FOOTER ── --}}
        <div class="cot-footer">
          <a href="{{ route('orangtua.index') }}" class="cot-btn cot-btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali
          </a>
          <button type="submit" class="cot-btn cot-btn-submit">
            <i class="fa-solid fa-link"></i> Hubungkan
          </button>
        </div>

      </form>

    @endif

  </div>
</div>

</x-app-layout>