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

    .info-box {
      background-color: #eff6ff;
      border-left: 4px solid #3b82f6;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 20px;
      display: flex;
      gap: 15px;
      align-items: flex-start;
    }

    .info-icon {
      font-size: 24px;
      color: #3b82f6;
    }

    .info-box h4 {
      margin: 0 0 8px 0;
      color: #1e40af;
      font-size: 16px;
    }

    .info-box p {
      margin: 0;
      color: #1e3a8a;
      font-size: 14px;
    }

    .ekstra-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
      gap: 20px;
    }

    .ekstra-card {
      background-color: #fff;
      border: 1px solid #f1dada;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      transition: 0.3s ease;
      position: relative;
    }

    .ekstra-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .ekstra-card.terpilih {
      border-color: #10b981;
      background-color: #f0fdf4;
    }

    .ekstra-card.penuh {
      opacity: 0.7;
    }

    .badge {
      position: absolute;
      top: 16px;
      right: 16px;
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
    }

    .badge-terpilih {
      background-color: #d1fae5;
      color: #065f46;
    }

    .badge-penuh {
      background-color: #fee2e2;
      color: #991b1b;
    }

    .badge-tersedia {
      background-color: #dbeafe;
      color: #1e40af;
    }

    .ekstra-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 20px;
      padding-right: 80px;
    }

    .ekstra-title {
      font-size: 20px;
      font-weight: 700;
      color: #b91c1c;
      margin: 0;
    }

    .kuota-info {
      display: flex;
      flex-direction: column;
      align-items: center;
      background-color: #fef2f2;
      padding: 8px 12px;
      border-radius: 8px;
    }

    .kuota-angka {
      font-size: 16px;
      font-weight: 700;
      color: #b91c1c;
    }

    .kuota-label {
      font-size: 11px;
      color: #991b1b;
    }

    .ekstra-details {
      display: flex;
      flex-direction: column;
      gap: 12px;
      margin-bottom: 16px;
    }

    .detail-item {
      display: flex;
      gap: 12px;
      align-items: flex-start;
    }

    .detail-icon {
      font-size: 18px;
      color: #6b7280;
    }

    .detail-label {
      font-size: 12px;
      color: #6b7280;
      font-weight: 600;
    }

    .detail-value {
      font-size: 14px;
      color: #111827;
      font-weight: 500;
    }

    .sisa-tempat {
      background-color: #fef3c7;
      border: 1px dashed #f59e0b;
      border-radius: 8px;
      padding: 8px 12px;
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      color: #92400e;
      font-weight: 600;
      margin-top: 8px;
    }

    .sisa-icon {
      font-size: 16px;
    }

    .ekstra-deskripsi {
      background-color: #f9fafb;
      border-radius: 8px;
      padding: 12px;
      margin-bottom: 16px;
    }

    .ekstra-deskripsi p {
      margin: 0;
      font-size: 13px;
      color: #4b5563;
      line-height: 1.6;
    }

    .ekstra-action {
      margin-top: 20px;
    }

    .btn-pilih {
      display: block;
      background-color: #dc2626;
      color: white;
      text-align: center;
      padding: 12px 20px;
      border-radius: 8px;
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s ease;
    }

    .btn-pilih:hover {
      background-color: #b91c1c;
      transform: scale(1.02);
      box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }

    .btn-disabled {
      display: block;
      background-color: #e5e7eb;
      color: #9ca3af;
      text-align: center;
      padding: 12px 20px;
      border-radius: 8px;
      font-weight: 600;
      border: none;
      cursor: not-allowed;
      width: 100%;
    }

    .empty-state {
      text-align: center;
      padding: 60px 20px;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    .empty-icon {
      font-size: 48px;
      margin-bottom: 20px;
      color: #9ca3af;
    }

    .empty-state h3 {
      font-size: 20px;
      color: #374151;
      margin-bottom: 10px;
    }

    .empty-state p {
      color: #6b7280;
      font-size: 16px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .ekstra-grid {
        grid-template-columns: 1fr;
      }

      .ekstra-header {
        flex-direction: column;
        gap: 10px;
        padding-right: 0;
      }

      .badge {
        position: static;
        display: inline-block;
        margin-bottom: 10px;
      }
    }
  </style>

  <div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="card">
        <h3 class="header-title">
          <i class="fas fa-list me-2"></i>Pilihan Ekstrakurikuler
        </h3>

        <!-- Header Info -->
        <div class="info-box">
          <div class="info-icon">
            <i class="fas fa-info-circle"></i>
          </div>
          <div>
            <h4>Informasi Pendaftaran</h4>
            <p>Pilih ekstrakurikuler yang sesuai dengan minat Anda. Periode pendaftaran yang sedang dibuka akan ditampilkan di bawah.</p>
          </div>
        </div>

        @if($ekstrakurikulers->count())
          <div class="ekstra-grid">
            @foreach($ekstrakurikulers as $extra)
              @php
                $siswa = auth()->user()->siswa ?? null;
                $sudahDaftar = $siswa ? $extra->peserta->contains($siswa->id) : false;
                $kuotaPenuh = $extra->peserta_count >= $extra->kuota;
                $sisaTempat = $extra->kuota - $extra->peserta_count;
              @endphp

              <div class="ekstra-card {{ $sudahDaftar ? 'terpilih' : '' }} {{ $kuotaPenuh ? 'penuh' : '' }}">
                <!-- Badge Status -->
                @if($sudahDaftar)
                  <div class="badge badge-terpilih">
                    <i class="fas fa-check me-1"></i>Terpilih
                  </div>
                @elseif($kuotaPenuh)
                  <div class="badge badge-penuh">Penuh</div>
                @else
                  <div class="badge badge-tersedia">Tersedia</div>
                @endif

                <!-- Header Card -->
                <div class="ekstra-header">
                  <h3 class="ekstra-title">{{ $extra->nama_extra }}</h3>
                  <div class="kuota-info">
                    <span class="kuota-angka">{{ $extra->peserta_count }}/{{ $extra->kuota }}</span>
                    <span class="kuota-label">peserta</span>
                  </div>
                </div>

                <!-- Detail Info -->
                <div class="ekstra-details">
                  <div class="detail-item">
                    <span class="detail-icon">
                      <i class="fas fa-user-tie"></i>
                    </span>
                    <div>
                      <div class="detail-label">Pembina</div>
                      <div class="detail-value">{{ $extra->pembina->user->name ?? '-' }}</div>
                    </div>
                  </div>

                  <div class="detail-item">
                    <span class="detail-icon">
                      <i class="fas fa-calendar-alt"></i>
                    </span>
                    <div>
                      <div class="detail-label">Jadwal</div>
                      <div class="detail-value">{{ $extra->jadwal }}</div>
                    </div>
                  </div>

                  <div class="detail-item">
                    <span class="detail-icon">
                      <i class="fas fa-map-marker-alt"></i>
                    </span>
                    <div>
                      <div class="detail-label">Tempat</div>
                      <div class="detail-value">{{ $extra->tempat }}</div>
                    </div>
                  </div>

                  @if(!$kuotaPenuh && !$sudahDaftar)
                    <div class="sisa-tempat">
                      <span class="sisa-icon">
                        <i class="fas fa-fire"></i>
                      </span>
                      <span>Sisa {{ $sisaTempat }} tempat lagi!</span>
                    </div>
                  @endif
                </div>

                <!-- Deskripsi -->
                @if($extra->deskripsi)
                  <div class="ekstra-deskripsi">
                    <p>{{ Str::limit($extra->deskripsi, 120) }}</p>
                  </div>
                @endif

                <!-- Action Button -->
                <div class="ekstra-action">
                  @if($sudahDaftar)
                    <button class="btn-disabled" disabled>
                      <i class="fas fa-check me-1"></i>Sudah Terpilih
                    </button>
                  @elseif($kuotaPenuh)
                    <button class="btn-disabled" disabled>
                      <i class="fas fa-lock me-1"></i>Kuota Penuh
                    </button>
                  @else
                    <a href="{{ route('ekstrakurikulers.show', $extra) }}" class="btn-pilih">
                      <i class="fas fa-check me-1"></i>Pilih Ekstrakurikuler Ini
                    </a>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="empty-state">
            <div class="empty-icon">
              <i class="fas fa-book-open"></i>
            </div>
            <h3>Belum Ada Pendaftaran Dibuka</h3>
            <p>Saat ini belum ada ekstrakurikuler yang membuka pendaftaran. Silakan cek kembali nanti.</p>
          </div>
        @endif
      </div>
    </div>
  </div>
</x-app-layout>