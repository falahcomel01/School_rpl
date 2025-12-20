<x-app-layout>
  <div class="elite-container">
    <div class="elite-wrapper">

      {{-- ==== WELCOME ==== --}}
      <div class="elite-welcome elite-card-big">
        <h2 class="elite-w-title">
          Selamat Datang, <span>{{ Auth::user()->name ?? 'User' }}</span> 👋
        </h2>

        @if(session('active_role') === 'superadmin')
          <p class="elite-w-text">Anda masuk ke halaman manajemen utama.</p>
        @else
          <p class="elite-w-text">Semoga hari Anda menyenangkan dan penuh semangat belajar! ✨</p>
        @endif

        {{-- ==== ROLE BADGE ==== --}}
        <div class="elite-role-badge">
          Anda login sebagai:
          <span>{{ session('active_role') }}</span>
        </div>
      </div>
      @php
  $roles = Auth::user()->getRoleNames();
@endphp

@if($roles->count() > 1)
  <div class="elite-section">
    <h3 class="elite-title">
      <i class="fa-solid fa-user-switch"></i> Pilih Role Aktif
    </h3>

    <div class="elite-role-select">
      @foreach($roles as $role)
        <form method="POST" action="{{ route('set-role') }}">
          @csrf
          <input type="hidden" name="role" value="{{ $role }}">

          <button
            type="submit"
            class="elite-role-btn {{ session('active_role') === $role ? 'active' : '' }}">
            {{ ucfirst($role) }}
          </button>
        </form>
      @endforeach
    </div>
  </div>
@endif

      {{-- ==== STATISTIK SUPERADMIN ==== --}}
      @if(session('active_role') === 'superadmin')
      <div class="elite-section">
        <h3 class="elite-title">
          <i class="fa-solid fa-chart-line"></i> Statistik Sistem
        </h3>

        <div class="elite-cards">
          <div class="elite-card elite-blue">
            <div class="elite-icon"><i class="fa-solid fa-user-shield"></i></div>
            <h4>Role</h4>
            <p class="elite-count">{{ number_format($rolesCount ?? 0) }}</p>
          </div>

          <div class="elite-card elite-green">
            <div class="elite-icon"><i class="fa-solid fa-users"></i></div>
            <h4>User</h4>
            <p class="elite-count">{{ number_format($usersCount ?? 0) }}</p>
          </div>

          <div class="elite-card elite-red">
            <div class="elite-icon"><i class="fa-solid fa-key"></i></div>
            <h4>Permission</h4>
            <p class="elite-count">{{ number_format($permissionsCount ?? 0) }}</p>
          </div>
        </div>
      </div>
      @endif

    </div>
  </div>

  {{-- ================= FULL CSS PREMIUM ================= --}}
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-attachment: fixed;
    }

    .elite-container {
      padding: 32px 20px;
      display: flex;
      justify-content: center;
    }

    .elite-wrapper {
      width: 100%;
      max-width: 1000px;
      animation: fadeIn .7s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* ================= WELCOME CARD ================= */
    .elite-card-big {
      background: rgba(255,255,255,0.6);
      backdrop-filter: blur(16px);
      border-radius: 22px;
      padding: 30px 30px;
      margin-bottom: 32px;
      border: 1px solid rgba(255,255,255,0.75);
      box-shadow: 0 10px 30px rgba(0,0,0,0.06);
      position: relative;
      overflow: hidden;
    }

    /* ==== BLUR TANPA WARNA MERAH ==== */
    .elite-card-big::before {
      content: "";
      position: absolute;
      width: 260px;
      height: 260px;
      border-radius: 50%;
      top: -90px;
      right: -40px;
      background: transparent;     /* warna merah DIHAPUS */
      filter: blur(70px);
      opacity: 0;                  /* agar benar-benar hilang */
      z-index: -1;
    }

    .elite-w-title {
      font-size: 24px;
      font-weight: 700;
      color: #1e3a8a;
      line-height: 1.3;
    }

    .elite-w-title span {
      background: linear-gradient(90deg, #1e40af, #2563eb);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-weight: 800;
    }

    .elite-w-text {
      margin-top: 6px;
      font-size: 14px;
      color: #4b5563;
    }

    /* ===== ROLE BADGE ===== */
    .elite-role-badge {
      margin-top: 15px;
      display: inline-block;
      padding: 6px 14px;
      border-radius: 999px;
      border: 1px solid rgba(0,0,0,0.15);
      background: rgba(0,0,0,0.05);
      font-size: 13px;
      font-weight: 500;
      color: #374151;
    }

    .elite-role-badge span {
      font-weight: 700;
      margin-left: 4px;
      background: linear-gradient(90deg, #1e40af, #2563eb);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    /* ================= STATISTIK SECTION ================= */
    .elite-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 18px;
      color: #2c344a;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .elite-cards {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 22px;
    }

    .elite-card {
      padding: 28px 0;
      border-radius: 20px;
      color: white;
      text-align: center;
      transition: .25s ease;
      position: relative;
      overflow: hidden;
      backdrop-filter: blur(10px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.12);
      border: 1px solid rgba(255,255,255,0.3);
    }

    .elite-card::after {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(255,255,255,0.12);
      transform: rotate(35deg) translate(-60%, -40%);
      width: 180%;
      height: 180%;
      transition: .5s;
    }

    .elite-card:hover::after {
      transform: rotate(35deg) translate(-40%, -50%);
    }

    .elite-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 16px 40px rgba(0,0,0,0.18);
    }

    .elite-icon {
      font-size: 34px;
      margin-bottom: 10px;
    }

    .elite-card h4 {
      font-size: 15px;
      margin-bottom: 6px;
    }

    .elite-count {
      font-size: 30px;
      font-weight: 800;
      letter-spacing: -1px;
    }

    .elite-blue {
      background: linear-gradient(145deg, #1e3a8a, #2563eb);
    }

    .elite-green {
      background: linear-gradient(145deg, #065f46, #10b981);
    }

    .elite-red {
      background: linear-gradient(145deg, #b91c1c, #ef4444);
    }

  </style>

</x-app-layout>