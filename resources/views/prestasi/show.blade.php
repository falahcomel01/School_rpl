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

    .header-card {
      background-color: #b91c1c;
      color: white;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 20px;
    }

    .header-card h3 {
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .info-card {
      background-color: #fff;
      border: 1px solid #f1dada;
      border-radius: 12px;
      padding: 20px;
      height: 100%;
    }

    .info-card-header {
      font-weight: 600;
      color: #374151;
      margin-bottom: 15px;
      padding-bottom: 8px;
      border-bottom: 1px solid #f1dada;
    }

    .info-table {
      width: 100%;
    }

    .info-table td {
      padding: 8px 0;
    }

    .info-table td:first-child {
      width: 40%;
      color: #6b7280;
      font-size: 14px;
    }

    .info-table td:last-child {
      font-weight: 500;
    }

    .badge {
      display: inline-block;
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 13px;
      font-weight: 600;
    }

    .badge-primary {
      background-color: #dc2626;
      color: white;
    }

    .badge-info {
      background-color: #dbeafe;
      color: #1e40af;
    }

    .badge-success {
      background-color: #d1fae5;
      color: #065f46;
    }

    .badge-warning {
      background-color: #fef3c7;
      color: #92400e;
    }

    .badge-secondary {
      background-color: #f3f4f6;
      color: #374151;
    }

    .badge-danger {
      background-color: #fee2e2;
      color: #b91c1c;
    }

    .badge-dark {
      background-color: #f9fafb;
      color: #111827;
    }

    .btn {
      display: inline-block;
      font-size: 14px;
      padding: 8px 16px;
      border-radius: 6px;
      text-decoration: none;
      transition: 0.2s;
      font-weight: 600;
      cursor: pointer;
      border: none;
    }

    .btn-primary {
      background-color: #dc2626;
      color: white;
    }

    .btn-primary:hover {
      background-color: #b91c1c;
    }

    .btn-secondary {
      background-color: #f3f4f6;
      color: #374151;
      border: 1px solid #d1d5db;
    }

    .btn-secondary:hover {
      background-color: #e5e7eb;
    }

    .btn-warning {
      background-color: #fef3c7;
      color: #92400e;
      border: 1px solid #fcd34d;
    }

    .btn-warning:hover {
      background-color: #fde68a;
    }

    .btn-danger {
      background-color: #dc2626;
      color: white;
    }

    .btn-danger:hover {
      background-color: #b91c1c;
    }

    .btn-sm {
      padding: 6px 12px;
      font-size: 13px;
    }

    .file-info {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 0;
    }

    .file-name {
      display: flex;
      align-items: center;
    }

    .file-icon {
      font-size: 24px;
      margin-right: 12px;
    }

    .file-preview {
      text-align: center;
      margin-top: 15px;
    }

    .file-preview img {
      max-height: 500px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      cursor: pointer;
      transition: transform 0.2s;
    }

    .file-preview img:hover {
      transform: scale(1.02);
    }

    .file-preview-caption {
      color: #6b7280;
      font-size: 13px;
      margin-top: 8px;
    }

    .actions {
      display: flex;
      justify-content: flex-start;
      align-items: center;
      margin-top: 25px;
    }

    .action-group {
      display: flex;
      gap: 10px;
    }

    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.8);
      z-index: 1000;
      overflow: auto;
    }

    .modal-content {
      background-color: white;
      margin: 5% auto;
      padding: 20px;
      border-radius: 8px;
      width: 90%;
      max-width: 800px;
      position: relative;
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
      padding-bottom: 10px;
      border-bottom: 1px solid #e5e7eb;
    }

    .modal-title {
      font-size: 18px;
      font-weight: 600;
    }

    .modal-close {
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
      color: #6b7280;
    }

    .modal-body {
      text-align: center;
    }

    .modal-body img {
      max-width: 100%;
      border-radius: 8px;
    }

    .info-row {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }

    .info-col {
      flex: 1;
    }

    .description-card {
      background-color: #fff;
      border: 1px solid #f1dada;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 20px;
    }

    .description-header {
      font-weight: 600;
      color: #374151;
      margin-bottom: 15px;
      padding-bottom: 8px;
      border-bottom: 1px solid #f1dada;
    }

    .description-content {
      line-height: 1.6;
    }

    .file-card {
      background-color: #fff;
      border: 1px solid #f1dada;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 20px;
    }

    .file-header {
      font-weight: 600;
      color: #374151;
      margin-bottom: 15px;
      padding-bottom: 8px;
      border-bottom: 1px solid #f1dada;
    }

    .text-muted {
      color: #6b7280;
    }

    .header-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
  </style>

  <div class="py-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <div class="card">
        <div class="header-actions">
          <h3 class="header-title">
            <i class="fas fa-trophy me-2"></i>Detail Prestasi
          </h3>
          <a href="{{ route('prestasi.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i>Kembali
          </a>
        </div>

        <!-- Header Card -->
        <div class="header-card">
          <div class="d-flex justify-content-between align-items-start">
            <div>
              <h3>{{ $prestasi->nama_prestasi }}</h3>
              <p style="opacity: 0.8; margin-top: 8px;">
                <i class="fas fa-calendar me-2"></i>
                {{ \Carbon\Carbon::parse($prestasi->tanggal)->format('d F Y') }}
              </p>
            </div>
            <div class="text-end">
              @if($prestasi->jenis === 'akademik')
                <span class="badge badge-primary">
                  <i class="fas fa-book"></i> Akademik
                </span>
              @else
                <span class="badge badge-warning">
                  <i class="fas fa-star"></i> Non-Akademik
                </span>
              @endif
            </div>
          </div>
        </div>

        <!-- Info Cards -->
        <div class="info-row">
          <!-- Info Siswa -->
          <div class="info-col">
            <div class="info-card">
              <div class="info-card-header">
                <i class="fas fa-user me-2"></i>Informasi Siswa
              </div>
              <table class="info-table">
                <tr>
                  <td>Nama</td>
                  <td><strong>{{ $prestasi->siswa->user->name ?? '-' }}</strong></td>
                </tr>
                <tr>
                  <td>NIS</td>
                  <td>{{ $prestasi->siswa->user->username ?? '-' }}</td>
                </tr>
                <tr>
                  <td>Kelas</td>
                  <td>
                    <span class="badge badge-info">
                      {{ $prestasi->siswa->kelas->nama_kelas ?? '-' }}-{{ $prestasi->siswa->kelas->jurusan->nama_jurusan ?? '-' }}
                    </span>
                  </td>
                </tr>
              </table>
            </div>
          </div>

          <!-- Detail Prestasi -->
          <div class="info-col">
            <div class="info-card">
              <div class="info-card-header">
                <i class="fas fa-award me-2"></i>Detail Prestasi
              </div>
              <table class="info-table">
                <tr>
                  <td>Tingkat</td>
                  <td>
                    @php
                      $colors = [
                        'sekolah' => 'badge-secondary',
                        'kecamatan' => 'badge-info',
                        'kabupaten' => 'badge-primary',
                        'provinsi' => 'badge-warning',
                        'nasional' => 'badge-danger',
                        'internasional' => 'badge-dark'
                      ];
                    @endphp
                    <span class="badge {{ $colors[$prestasi->tingkat] ?? 'badge-secondary' }}">
                      {{ ucfirst($prestasi->tingkat) }}
                    </span>
                  </td>
                </tr>
                <tr>
                  <td>Peringkat</td>
                  <td>
                    @if($prestasi->peringkat)
                      <span class="badge badge-primary">{{ $prestasi->peringkat }}</span>
                    @else
                      <span class="text-muted">-</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <td>Tanggal</td>
                  <td>{{ \Carbon\Carbon::parse($prestasi->tanggal)->format('d F Y') }}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>

        <!-- Keterangan -->
        @if($prestasi->keterangan)
          <div class="description-card">
            <div class="description-header">
              <i class="fas fa-comment-alt me-2"></i>Keterangan
            </div>
            <div class="description-content">
              {{ $prestasi->keterangan }}
            </div>
          </div>
        @endif

        <!-- File Bukti -->
        @if($prestasi->file_bukti)
          <div class="file-card">
            <div class="file-header">
              <i class="fas fa-file me-2"></i>File Bukti
            </div>
            <div class="file-info">
              <div class="file-name">
                @php
                  $ext = pathinfo($prestasi->file_bukti, PATHINFO_EXTENSION);
                  $iconClass = 'fa-file';
                  $iconColor = 'text-secondary';
                  
                  if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                    $iconClass = 'fa-file-image';
                    $iconColor = 'text-primary';
                  } elseif ($ext === 'pdf') {
                    $iconClass = 'fa-file-pdf';
                    $iconColor = 'text-danger';
                  }
                @endphp
                <i class="fas {{ $iconClass }} file-icon {{ $iconColor }}"></i>
                <span>{{ basename($prestasi->file_bukti) }}</span>
              </div>
              <a href="{{ route('prestasi.download', $prestasi->id) }}" 
                 class="btn btn-primary btn-sm" 
                 target="_blank">
                <i class="fas fa-download me-1"></i>Download
              </a>
            </div>
            
            @if(in_array($ext, ['jpg', 'jpeg', 'png']))
              <div class="file-preview">
                <img src="{{ asset('storage/' . $prestasi->file_bukti) }}" 
                     alt="Bukti Prestasi" 
                     onclick="viewImage(this.src)">
                <p class="file-preview-caption">Klik gambar untuk memperbesar</p>
              </div>
            @endif
          </div>
        @endif
      </div>
    </div>
  </div>

  <!-- Modal untuk view image -->
  <div id="imageModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bukti Prestasi</h5>
        <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
      </div>
      <div class="modal-body">
        <img id="modalImage" src="" alt="Bukti Prestasi">
      </div>
    </div>
  </div>

  @push('scripts')
  <script>
  function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus prestasi ini?\n\nData yang dihapus tidak dapat dikembalikan.')) {
      document.getElementById('delete-form').submit();
    }
  }

  function viewImage(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').style.display = 'block';
  }

  function closeModal() {
    document.getElementById('imageModal').style.display = 'none';
  }

  // Close modal when clicking outside of it
  window.onclick = function(event) {
    const modal = document.getElementById('imageModal');
    if (event.target == modal) {
      modal.style.display = 'none';
    }
  }
  </script>
  @endpush
</x-app-layout>