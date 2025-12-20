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

    .form-group {
      margin-bottom: 15px;
    }

    .form-label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #374151;
      font-size: 14px;
    }

    .form-control {
      width: 100%;
      border: 1px solid #f3c5c5;
      border-radius: 6px;
      padding: 8px 12px;
      font-size: 14px;
      transition: border-color 0.2s;
    }

    .form-control:focus {
      outline: none;
      border-color: #b91c1c;
      box-shadow: 0 0 0 2px rgba(185, 28, 28, 0.1);
    }

    .form-select {
      width: 100%;
      border: 1px solid #f3c5c5;
      border-radius: 6px;
      padding: 8px 12px;
      font-size: 14px;
      background-color: white;
      transition: border-color 0.2s;
    }

    .form-select:focus {
      outline: none;
      border-color: #b91c1c;
      box-shadow: 0 0 0 2px rgba(185, 28, 28, 0.1);
    }

    .form-row {
      display: flex;
      gap: 15px;
    }

    .form-col {
      flex: 1;
    }

    .required {
      color: #dc2626;
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

    .alert-error {
      background-color: #fee2e2;
      border-left: 4px solid #dc2626;
      color: #7f1d1d;
      padding: 10px 15px;
      border-radius: 6px;
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .alert-info {
      background-color: #eff6ff;
      border-left: 4px solid #3b82f6;
      color: #1e40af;
      padding: 10px 15px;
      border-radius: 6px;
      margin-bottom: 15px;
    }

    .alert-success {
      background-color: #ecfdf5;
      border-left: 4px solid #10b981;
      color: #065f46;
      padding: 10px 15px;
      border-radius: 6px;
      margin-top: 10px;
    }

    .alert-link {
      color: #1e40af;
      text-decoration: underline;
    }

    .close-btn {
      background: none;
      border: none;
      color: #7f1d1d;
      font-size: 18px;
      cursor: pointer;
    }

    .invalid-feedback {
      color: #dc2626;
      font-size: 13px;
      margin-top: 5px;
    }

    .text-muted {
      color: #6b7280;
      font-size: 13px;
      margin-top: 5px;
      display: block;
    }

    .file-preview {
      background-color: #f9fafb;
      border: 1px solid #e5e7eb;
      border-radius: 6px;
      padding: 10px;
      margin-top: 10px;
      display: none;
    }

    .actions {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 25px;
    }
  </style>

  <div class="py-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <div class="card">
        <h3 class="header-title">
          <i class="fas fa-edit me-2"></i>Edit Prestasi Siswa
        </h3>

        @if(session('error'))
          <div class="alert-error">
            <div>
              <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
            <button type="button" class="close-btn" onclick="this.parentElement.style.display='none'">&times;</button>
          </div>
        @endif

        <form action="{{ route('prestasi.update', $prestasi->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <!-- Siswa -->
          <div class="form-group">
            <label for="siswa_id" class="form-label">
              Siswa <span class="required">*</span>
            </label>
            @if(session('active_role') === 'siswa')
              <input type="hidden" name="siswa_id" value="{{ $prestasi->siswa_id }}">
              <input type="text" class="form-control" value="{{ $prestasi->siswa->nama }} ({{ $prestasi->siswa->nis }})" readonly>
            @else
              <select name="siswa_id" id="siswa_id" class="form-select @error('siswa_id') is-invalid @enderror" required>
                <option value="">-- Pilih Siswa --</option>
                @foreach($siswas as $siswa)
                  <option value="{{ $siswa->id }}" {{ (old('siswa_id') ?? $prestasi->siswa_id) == $siswa->id ? 'selected' : '' }}>
                    {{ $siswa->user->name }} ({{ $siswa->user->username }})
                    @if($siswa->kelas)
                      - {{ $siswa->kelas->nama_kelas }}
                    @endif
                  </option>
                @endforeach
              </select>
              @error('siswa_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            @endif
          </div>

          <!-- Nama Prestasi -->
          <div class="form-group">
            <label for="nama_prestasi" class="form-label">
              Nama Prestasi <span class="required">*</span>
            </label>
            <input type="text" 
                   name="nama_prestasi" 
                   id="nama_prestasi" 
                   class="form-control @error('nama_prestasi') is-invalid @enderror" 
                   value="{{ old('nama_prestasi') ?? $prestasi->nama_prestasi }}"
                   placeholder="Contoh: Juara 1 Olimpiade Matematika"
                   required>
            @error('nama_prestasi')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-row">
            <!-- Jenis Prestasi -->
            <div class="form-col">
              <div class="form-group">
                <label for="jenis" class="form-label">
                  Jenis Prestasi <span class="required">*</span>
                </label>
                <select name="jenis" id="jenis" class="form-select @error('jenis') is-invalid @enderror" required>
                  <option value="">-- Pilih Jenis --</option>
                  <option value="akademik" {{ (old('jenis') ?? $prestasi->jenis) == 'akademik' ? 'selected' : '' }}>
                    Akademik
                  </option>
                  <option value="non-akademik" {{ (old('jenis') ?? $prestasi->jenis) == 'non-akademik' ? 'selected' : '' }}>
                    Non-Akademik
                  </option>
                </select>
                @error('jenis')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Tingkat -->
            <div class="form-col">
              <div class="form-group">
                <label for="tingkat" class="form-label">
                  Tingkat <span class="required">*</span>
                </label>
                <select name="tingkat" id="tingkat" class="form-select @error('tingkat') is-invalid @enderror" required>
                  <option value="">-- Pilih Tingkat --</option>
                  <option value="sekolah" {{ (old('tingkat') ?? $prestasi->tingkat) == 'sekolah' ? 'selected' : '' }}>Sekolah</option>
                  <option value="kecamatan" {{ (old('tingkat') ?? $prestasi->tingkat) == 'kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                  <option value="kabupaten" {{ (old('tingkat') ?? $prestasi->tingkat) == 'kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                  <option value="provinsi" {{ (old('tingkat') ?? $prestasi->tingkat) == 'provinsi' ? 'selected' : '' }}>Provinsi</option>
                  <option value="nasional" {{ (old('tingkat') ?? $prestasi->tingkat) == 'nasional' ? 'selected' : '' }}>Nasional</option>
                  <option value="internasional" {{ (old('tingkat') ?? $prestasi->tingkat) == 'internasional' ? 'selected' : '' }}>Internasional</option>
                </select>
                @error('tingkat')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="form-row">
            <!-- Peringkat -->
            <div class="form-col">
              <div class="form-group">
                <label for="peringkat" class="form-label">
                  Peringkat/Pencapaian
                </label>
                <input type="text" 
                       name="peringkat" 
                       id="peringkat" 
                       class="form-control @error('peringkat') is-invalid @enderror" 
                       value="{{ old('peringkat') ?? $prestasi->peringkat }}"
                       placeholder="Contoh: Juara 1, Medali Emas, dsb">
                @error('peringkat')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Opsional</small>
              </div>
            </div>

            <!-- Tanggal -->
            <div class="form-col">
              <div class="form-group">
                <label for="tanggal" class="form-label">
                  Tanggal <span class="required">*</span>
                </label>
                <input type="date" 
                       name="tanggal" 
                       id="tanggal" 
                       class="form-control @error('tanggal') is-invalid @enderror" 
                       value="{{ old('tanggal') ?? $prestasi->tanggal }}"
                       max="{{ date('Y-m-d') }}"
                       required>
                @error('tanggal')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <!-- File Bukti -->
          <div class="form-group">
            <label for="file_bukti" class="form-label">
              File Bukti Prestasi
            </label>
            
            @if($prestasi->file_bukti)
              <div class="alert-info">
                <i class="fas fa-file me-2"></i>
                File saat ini: 
                <a href="{{ route('prestasi.download', $prestasi->id) }}" class="alert-link" target="_blank">
                  {{ basename($prestasi->file_bukti) }}
                </a>
              </div>
            @endif
            
            <input type="file" 
                   name="file_bukti" 
                   id="file_bukti" 
                   class="form-control @error('file_bukti') is-invalid @enderror"
                   accept=".pdf,.jpg,.jpeg,.png"
                   onchange="previewFile()">
            @error('file_bukti')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="text-muted">Format: PDF, JPG, JPEG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah.</small>
            
            <!-- Preview -->
            <div id="filePreview" class="file-preview">
              <div class="alert-success">
                <i class="fas fa-file me-2"></i>
                File baru: <span id="fileName"></span>
                <span id="fileSize" class="text-muted"></span>
              </div>
            </div>
          </div>

          <!-- Keterangan -->
          <div class="form-group">
            <label for="keterangan" class="form-label">
              Keterangan
            </label>
            <textarea name="keterangan" 
                      id="keterangan" 
                      rows="3" 
                      class="form-control @error('keterangan') is-invalid @enderror"
                      placeholder="Keterangan tambahan tentang prestasi (opsional)">{{ old('keterangan') ?? $prestasi->keterangan }}</textarea>
            @error('keterangan')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Buttons -->
          <div class="actions">
            <a href="{{ route('prestasi.index') }}" class="btn btn-secondary">
              <i class="fas fa-times me-1"></i>Batal
            </a>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save me-1"></i>Update
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @push('scripts')
  <script>
  function previewFile() {
    const fileInput = document.getElementById('file_bukti');
    const preview = document.getElementById('filePreview');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    
    if (fileInput.files && fileInput.files[0]) {
      const file = fileInput.files[0];
      const size = (file.size / 1024).toFixed(2);
      
      fileName.textContent = file.name;
      fileSize.textContent = `(${size} KB)`;
      preview.style.display = 'block';
    } else {
      preview.style.display = 'none';
    }
  }
  </script>
  @endpush
</x-app-layout>