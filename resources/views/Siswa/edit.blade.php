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

  .es-page {
    padding: 28px 20px;
    font-family: 'DM Sans', sans-serif;
  }

  .es-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    max-width: 760px;
    margin: 0 auto;
  }

  /* ── HEADER ── */
  .es-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 28px 20px;
    border-bottom: 1px solid rgba(59,130,246,0.12);
    background: linear-gradient(135deg, var(--n800) 0%, var(--n600) 100%);
    position: relative;
    overflow: hidden;
  }

  .es-card-header::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(59,130,246,0.1);
    pointer-events: none;
  }

  .es-card-header::after {
    content: '';
    position: absolute;
    bottom: -30px; right: 120px;
    width: 110px; height: 110px;
    border-radius: 50%;
    background: rgba(14,165,233,0.07);
    pointer-events: none;
  }

  .es-header-icon {
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

  .es-header-text {
    flex: 1;
    display: flex;
    flex-direction: column;
    position: relative; z-index: 1;
  }

  .es-header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
  }

  .es-header-sub {
    font-size: 12px;
    color: rgba(191,219,254,0.75);
    margin-top: 3px;
  }

  /* Badge header */
  .es-header-badge {
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

  .es-header-badge-avatar {
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

  .es-header-badge-info { display: flex; flex-direction: column; }
  .es-header-badge-name { font-size: 12.5px; font-weight: 700; color: #fff; line-height: 1.2; }
  .es-header-badge-label { font-size: 10.5px; color: rgba(191,219,254,0.7); margin-top: 1px; }

  /* ── BODY ── */
  .es-body { padding: 28px 32px; }

  /* ── ALERT ── */
  .es-alert {
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

  .es-alert i { font-size: 14px; flex-shrink: 0; margin-top: 1px; }
  .es-alert-success { background: var(--green-bg); border-color: var(--green-bd); color: var(--green-tx); }

  /* ── SECTION ── */
  .es-section { margin-bottom: 24px; }

  .es-section-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--gray-100);
  }

  .es-section-label-icon {
    width: 26px; height: 26px;
    border-radius: 7px;
    background: var(--n50);
    border: 1px solid var(--n100);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px;
    color: var(--n400);
    flex-shrink: 0;
  }

  .es-section-label span {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--gray-400);
  }

  /* ── GRID ── */
  .es-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }

  /* ── FORM GROUP ── */
  .es-form-group { display: flex; flex-direction: column; gap: 6px; }

  .es-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--gray-700);
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .es-label-required { color: #ef4444; font-size: 13px; line-height: 1; }

  /* ── INPUT / SELECT ── */
  .es-input-wrap { position: relative; }

  .es-input-icon {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 13px;
    color: var(--gray-400);
    pointer-events: none;
    transition: color 0.18s;
  }

  .es-input,
  .es-select {
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

  .es-input:focus,
  .es-select:focus {
    outline: none;
    border-color: var(--n300);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
  }

  .es-input-wrap:focus-within .es-input-icon { color: var(--n300); }

  .es-select-chevron {
    position: absolute;
    right: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 11px;
    color: var(--gray-400);
    pointer-events: none;
  }

  /* ── FOOTER ── */
  .es-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px 32px 28px;
    border-top: 1px solid var(--gray-100);
    background: var(--gray-50);
  }

  .es-btn {
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

  .es-btn-back {
    background: #fff;
    border-color: var(--gray-200);
    color: var(--gray-700);
  }

  .es-btn-back:hover {
    background: var(--gray-100);
    border-color: var(--gray-400);
    color: var(--gray-900);
    transform: translateY(-1px);
  }

  .es-btn-submit {
    background: linear-gradient(135deg, var(--n700) 0%, var(--n400) 100%);
    border-color: var(--n400);
    color: #fff;
    box-shadow: 0 3px 12px rgba(29,78,216,0.3);
  }

  .es-btn-submit:hover {
    background: linear-gradient(135deg, var(--n600) 0%, var(--n300) 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(29,78,216,0.4);
  }

  .es-btn-submit:active { transform: translateY(0); }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    .es-page { padding: 16px 12px; }
    .es-body { padding: 20px 18px; }
    .es-footer { padding: 16px 18px 20px; flex-direction: column-reverse; align-items: stretch; }
    .es-btn { justify-content: center; }
    .es-grid-2 { grid-template-columns: 1fr; }
    .es-card-header { padding: 18px 20px; flex-wrap: wrap; gap: 10px; }
    .es-header-badge { display: none; }
  }
</style>

<div class="es-page">
  <div class="es-card">

    {{-- ── HEADER ── --}}
    <div class="es-card-header">
      <div class="es-header-icon">
        <i class="fa-solid fa-user-pen"></i>
      </div>
      <div class="es-header-text">
        <span class="es-header-title">Edit Data Siswa</span>
        <span class="es-header-sub">Perbarui informasi akun dan data siswa</span>
      </div>
      <div class="es-header-badge">
        <div class="es-header-badge-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
        <div class="es-header-badge-info">
          <span class="es-header-badge-name">{{ Str::limit($user->name, 20) }}</span>
          <span class="es-header-badge-label">NIS {{ $user->username }}</span>
        </div>
      </div>
    </div>

    {{-- ── FORM ── --}}
    <form action="{{ route('siswa.update', $user->id) }}" method="POST" autocomplete="off">
      @csrf
      @method('PUT')

      <div class="es-body">

        @if (session('success'))
          <div class="es-alert es-alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
          </div>
        @endif

        {{-- ── SECTION: INFO AKUN ── --}}
        <div class="es-section">
          <div class="es-section-label">
            <div class="es-section-label-icon"><i class="fa-solid fa-circle-info"></i></div>
            <span>Informasi Akun</span>
          </div>

          <div class="es-grid-2">

            {{-- Nama --}}
            <div class="es-form-group">
              <label class="es-label">Nama <span class="es-label-required">*</span></label>
              <div class="es-input-wrap">
                <i class="fa-solid fa-user es-input-icon"></i>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                  placeholder="Masukkan nama lengkap"
                  class="es-input">
              </div>
            </div>

            {{-- NIS --}}
            <div class="es-form-group">
              <label class="es-label">NIS <span class="es-label-required">*</span></label>
              <div class="es-input-wrap">
                <i class="fa-solid fa-id-card es-input-icon"></i>
                <input type="number" name="username" min="1"
                  value="{{ old('username', $user->username) }}" required
                  placeholder="Nomor Induk Siswa"
                  class="es-input">
              </div>
            </div>

            {{-- Email --}}
            <div class="es-form-group" style="grid-column: 1 / -1;">
              <label class="es-label">Email</label>
              <div class="es-input-wrap">
                <i class="fa-solid fa-envelope es-input-icon"></i>
                <input type="email" name="email"
                  value="{{ old('email', $user->email) }}"
                  placeholder="contoh@email.com"
                  class="es-input">
              </div>
            </div>

          </div>
        </div>

        {{-- ── SECTION: DATA SISWA ── --}}
        <div class="es-section" style="margin-bottom:0;">
          <div class="es-section-label">
            <div class="es-section-label-icon"><i class="fa-solid fa-school"></i></div>
            <span>Data Siswa</span>
          </div>

          <div class="es-grid-2">

            {{-- Kelas --}}
            <div class="es-form-group">
              <label class="es-label">Kelas <span class="es-label-required">*</span></label>
              <div class="es-input-wrap">
                <i class="fa-solid fa-door-open es-input-icon"></i>
                <select name="kelas_id" required class="es-select">
                  <option value="">-- Pilih Kelas --</option>
                  @foreach ($kelas as $k)
                    <option value="{{ $k->id }}" {{ old('kelas_id', $user->siswa?->kelas_id) == $k->id ? 'selected' : '' }}>
                      {{ $k->nama_kelas }} - {{ $k->jurusan?->nama_jurusan ?? '-' }}
                    </option>
                  @endforeach
                </select>
                <i class="fa-solid fa-chevron-down es-select-chevron"></i>
              </div>
            </div>

            {{-- Jenis Kelamin --}}
            <div class="es-form-group">
              <label class="es-label">Jenis Kelamin</label>
              <div class="es-input-wrap">
                <i class="fa-solid fa-venus-mars es-input-icon"></i>
                <select name="jenis_kelamin" class="es-select">
                  <option value="">-- Pilih Jenis Kelamin --</option>
                  <option value="Laki-laki"  {{ old('jenis_kelamin', $user->siswa?->jenis_kelamin) == 'Laki-laki'  ? 'selected' : '' }}>Laki-laki</option>
                  <option value="Perempuan"  {{ old('jenis_kelamin', $user->siswa?->jenis_kelamin) == 'Perempuan'  ? 'selected' : '' }}>Perempuan</option>
                </select>
                <i class="fa-solid fa-chevron-down es-select-chevron"></i>
              </div>
            </div>

          </div>
        </div>

      </div>{{-- /.es-body --}}

      {{-- ── FOOTER ── --}}
      <div class="es-footer">
        <a href="{{ route('siswa.index') }}" class="es-btn es-btn-back">
          <i class="fa-solid fa-arrow-left"></i>
          Kembali
        </a>
        <button type="submit" class="es-btn es-btn-submit">
          <i class="fa-solid fa-floppy-disk"></i>
          Simpan Perubahan
        </button>
      </div>

    </form>
  </div>
</div>

</x-app-layout>