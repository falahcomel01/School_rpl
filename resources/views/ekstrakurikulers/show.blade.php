<x-app-layout>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1dada;
      padding: 25px;
      transition: 0.3s ease;
    }

    .header-title {
      font-size: 1.6rem;
      font-weight: 700;
      color: #b91c1c;
      border-bottom: 3px solid #b91c1c;
      padding-bottom: 8px;
      margin-bottom: 20px;
    }

    .detail-card {
      background-color: #fff;
      border: 1px solid #f1dada;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      position: relative;
    }

    /* Status Badge */
    .status-badge {
      position: absolute;
      top: 20px;
      right: 20px;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
    }

    .badge-success {
      background-color: #d1fae5;
      color: #065f46;
    }

    .badge-full {
      background-color: #fee2e2;
      color: #991b1b;
    }

    .badge-open {
      background-color: #dbeafe;
      color: #1e40af;
    }

    .badge-closed {
      background-color: #fef3c7;
      color: #92400e;
    }

    /* Header */
    .detail-header {
      display: flex;
      gap: 20px;
      align-items: center;
      margin-bottom: 20px;
    }

    .ekstra-icon {
      font-size: 48px;
      color: #b91c1c;
      background-color: #fef2f2;
      padding: 15px;
      border-radius: 12px;
    }

    .ekstra-title {
      font-size: 28px;
      font-weight: 700;
      color: #b91c1c;
      margin: 0 0 10px 0;
    }

    .kuota-inline {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 16px;
    }

    .kuota-text {
      color: #6b7280;
      font-weight: 500;
    }

    .kuota-number {
      color: #b91c1c;
      font-weight: 700;
    }

    .kuota-divider {
      color: #d1d5db;
    }

    .kuota-max {
      color: #9ca3af;
      font-weight: 600;
    }

    /* Progress Bar */
    .progress-container {
      height: 8px;
      background-color: #e5e7eb;
      border-radius: 4px;
      overflow: hidden;
      margin-bottom: 25px;
    }

    .progress-bar {
      height: 100%;
      background-color: #b91c1c;
      transition: width 0.5s ease;
    }

    /* Info Grid */
    .info-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
      margin-bottom: 25px;
    }

    .info-item {
      display: flex;
      gap: 15px;
      padding: 15px;
      background-color: #f9fafb;
      border-radius: 8px;
      border: 1px solid #e5e7eb;
    }

    .info-icon {
      font-size: 24px;
      color: #6b7280;
    }

    .info-label {
      font-size: 12px;
      color: #6b7280;
      font-weight: 600;
      margin-bottom: 4px;
    }

    .info-value {
      font-size: 14px;
      color: #111827;
      font-weight: 600;
    }

    /* Description */
    .description-section {
      margin-bottom: 25px;
    }

    .section-title {
      font-size: 16px;
      font-weight: 700;
      color: #374151;
      margin-bottom: 10px;
    }

    .description-content {
      background-color: #fef2f2;
      border-left: 4px solid #b91c1c;
      padding: 15px;
      border-radius: 8px;
      line-height: 1.6;
      color: #374151;
    }

    /* Action Section */
    .action-section {
      background-color: #f9fafb;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
    }

    .action-info {
      display: flex;
      gap: 15px;
      align-items: flex-start;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .action-info.success {
      background-color: #d1fae5;
      border: 1px solid #34d399;
    }

    .action-info.error {
      background-color: #fee2e2;
      border: 1px solid #f87171;
    }

    .action-info.warning {
      background-color: #fef3c7;
      border: 1px solid #fbbf24;
    }

    .action-info.primary {
      background-color: #dbeafe;
      border: 1px solid #60a5fa;
    }

    .action-icon {
      font-size: 24px;
    }

    .action-title {
      font-size: 16px;
      font-weight: 700;
      margin-bottom: 4px;
    }

    .action-text {
      font-size: 14px;
      color: #4b5563;
    }

    .action-info.success .action-title {
      color: #065f46;
    }

    .action-info.error .action-title {
      color: #991b1b;
    }

    .action-info.warning .action-title {
      color: #92400e;
    }

    .action-info.primary .action-title {
      color: #1e40af;
    }

    /* Buttons */
    .btn {
      display: inline-block;
      font-size: 14px;
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
      transition: 0.2s;
      font-weight: 600;
      cursor: pointer;
      border: none;
      width: 100%;
      text-align: center;
    }

    .btn-primary {
      background-color: #dc2626;
      color: white;
    }

    .btn-primary:hover {
      background-color: #b91c1c;
    }

    .btn-danger {
      background-color: #fff;
      color: #dc2626;
      border: 2px solid #dc2626;
    }

    .btn-danger:hover {
      background-color: #dc2626;
      color: white;
    }

    .btn-back {
      background-color: #f3f4f6;
      color: #374151;
      border: 1px solid #d1d5db;
    }

    .btn-back:hover {
      background-color: #e5e7eb;
    }

    .action-footer {
      padding-top: 20px;
      border-top: 1px solid #e5e7eb;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .detail-card {
        padding: 20px;
      }

      .status-badge {
        position: static;
        display: inline-block;
        margin-bottom: 15px;
      }

      .detail-header {
        flex-direction: column;
        text-align: center;
      }

      .ekstra-icon {
        font-size: 36px;
        padding: 12px;
      }

      .ekstra-title {
        font-size: 24px;
      }

      .info-grid {
        grid-template-columns: 1fr;
      }

      .action-section {
        padding: 15px;
      }
    }
  </style>

  <div class="py-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <div class="card">
        <h3 class="header-title">
          <i class="fas fa-info-circle me-2"></i>Detail Ekstrakurikuler
        </h3>

        <!-- Main Detail Card -->
        <div class="detail-card">
          <!-- Status Badge -->
          @php
            $siswa = auth()->user()->siswa;
            $sudahDaftar = $ekstrakurikuler->peserta->contains($siswa->id);
            $penuh = $ekstrakurikuler->peserta_count >= $ekstrakurikuler->kuota;
          @endphp

          @if($sudahDaftar)
            <div class="status-badge badge-success">
              <i class="fas fa-check me-1"></i>Anda Sudah Terdaftar
            </div>
          @elseif($penuh)
            <div class="status-badge badge-full">
              <i class="fas fa-lock me-1"></i>Kuota Penuh
            </div>
          @elseif($pendaftaranBuka)
            <div class="status-badge badge-open">
              <i class="fas fa-bullseye me-1"></i>Pendaftaran Dibuka
            </div>
          @else
            <div class="status-badge badge-closed">
              <i class="fas fa-clock me-1"></i>Pendaftaran Ditutup
            </div>
          @endif

          <!-- Header -->
          <div class="detail-header">
            <div class="ekstra-icon">
              <i class="fas fa-bullseye"></i>
            </div>
            <div>
              <h1 class="ekstra-title">{{ $ekstrakurikuler->nama_extra }}</h1>
              <div class="kuota-inline">
                <span class="kuota-text">Peserta:</span>
                <span class="kuota-number">{{ $ekstrakurikuler->peserta_count }}</span>
                <span class="kuota-divider">/</span>
                <span class="kuota-max">{{ $ekstrakurikuler->kuota }}</span>
              </div>
            </div>
          </div>

          <!-- Progress Bar -->
          <div class="progress-container">
            <div class="progress-bar" style="width: {{ ($ekstrakurikuler->peserta_count / $ekstrakurikuler->kuota) * 100 }}%"></div>
          </div>

          <!-- Info Grid -->
          <div class="info-grid">
            <div class="info-item">
              <div class="info-icon">
                <i class="fas fa-user-tie"></i>
              </div>
              <div>
                <div class="info-label">Pembina</div>
                <div class="info-value">{{ $ekstrakurikuler->pembina->user->name ?? '-' }}</div>
              </div>
            </div>

            <div class="info-item">
              <div class="info-icon">
                <i class="fas fa-calendar-alt"></i>
              </div>
              <div>
                <div class="info-label">Jadwal</div>
                <div class="info-value">{{ $ekstrakurikuler->jadwal }}</div>
              </div>
            </div>

            <div class="info-item">
              <div class="info-icon">
                <i class="fas fa-map-marker-alt"></i>
              </div>
              <div>
                <div class="info-label">Tempat</div>
                <div class="info-value">{{ $ekstrakurikuler->tempat }}</div>
              </div>
            </div>

            <div class="info-item">
              <div class="info-icon">
                <i class="fas fa-calendar"></i>
              </div>
              <div>
                <div class="info-label">Periode Pendaftaran</div>
                <div class="info-value">
                  {{ \Carbon\Carbon::parse($ekstrakurikuler->pendaftaran_mulai)->format('d M Y') }}
                  -
                  {{ \Carbon\Carbon::parse($ekstrakurikuler->pendaftaran_selesai)->format('d M Y') }}
                </div>
              </div>
            </div>
          </div>

          <!-- Deskripsi -->
          @if($ekstrakurikuler->deskripsi)
            <div class="description-section">
              <h3 class="section-title">Tentang Ekstrakurikuler</h3>
              <div class="description-content">
                {{ $ekstrakurikuler->deskripsi }}
              </div>
            </div>
          @endif

          <!-- Action Section -->
          @if(auth()->user()->hasRole('siswa'))
            <div class="action-section">
              @if($sudahDaftar)
                <div class="action-info success">
                  <div class="action-icon">
                    <i class="fas fa-check-circle"></i>
                  </div>
                  <div>
                    <div class="action-title">Anda Sudah Terdaftar</div>
                    <div class="action-text">Anda sudah terdaftar sebagai peserta ekstrakurikuler ini</div>
                  </div>
                </div>
                
                <form method="POST" action="{{ route('ekstrakurikulers.batal', $ekstrakurikuler) }}" 
                      onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pendaftaran?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">
                    <i class="fas fa-times me-1"></i>Batalkan Pendaftaran
                  </button>
                </form>

              @elseif(!$pendaftaranBuka)
                <div class="action-info warning">
                  <div class="action-icon">
                    <i class="fas fa-clock"></i>
                  </div>
                  <div>
                    <div class="action-title">Pendaftaran Ditutup</div>
                    <div class="action-text">
                      Periode pendaftaran untuk ekstrakurikuler ini sudah berakhir atau belum dimulai
                    </div>
                  </div>
                </div>

              @elseif($kuotaPenuh)
                <div class="action-info error">
                  <div class="action-icon">
                    <i class="fas fa-lock"></i>
                  </div>
                  <div>
                    <div class="action-title">Kuota Penuh</div>
                    <div class="action-text">Maaf, kuota peserta untuk ekstrakurikuler ini sudah penuh</div>
                  </div>
                </div>

              @else
                <div class="action-info primary">
                  <div class="action-icon">
                    <i class="fas fa-bullseye"></i>
                  </div>
                  <div>
                    <div class="action-title">Daftar Sekarang!</div>
                    <div class="action-text">Kesempatan masih terbuka! Daftarkan diri Anda sekarang</div>
                  </div>
                </div>

                <form method="POST" action="{{ route('ekstrakurikulers.daftar', $ekstrakurikuler) }}" 
                      onsubmit="return confirm('Apakah Anda yakin ingin mendaftar ekstrakurikuler ini?');">
                  @csrf
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check me-1"></i>Daftar Ekstrakurikuler
                  </button>
                </form>
              @endif
            </div>
          @endif

          <!-- Back Button -->
          <div class="action-footer">
            <a href="{{ route('ekstrakurikulers.index') }}" class="btn btn-back">
              <i class="fas fa-arrow-left me-1"></i>Kembali ke Daftar
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>