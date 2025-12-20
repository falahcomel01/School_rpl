<x-app-layout>

  <div class="elite-form-container">

    @if($errors->any())
      <div class="elite-alert elite-alert-error">
        <ul class="elite-error-list">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('rekap_nilai.update', $pembobotan->id) }}" method="POST">
      @csrf
      @method('PUT')

      <!-- Info Mapel -->
      <div class="elite-info-bar mb-5">
        <strong>📚 Mapel:</strong> {{ $mapel->nama_mapel ?? '-' }}
      </div>

      <div class="elite-grid">
        <div class="elite-form-group">
          <label class="elite-form-label">Kelas <span class="text-danger">*</span></label>
          <select name="kelas_id" class="elite-form-select {{ $errors->has('kelas_id') ? 'is-invalid' : '' }}" required>
            @foreach ($kelas as $k)
              <option value="{{ $k->id }}" {{ $pembobotan->kelas_id == $k->id ? 'selected' : '' }}>
                {{ $k->nama_kelas }}
              </option>
            @endforeach
          </select>
          @error('kelas_id') <small class="elite-form-error">{{ $message }}</small> @enderror
        </div>

        <div class="elite-form-group">
          <label class="elite-form-label">Semester <span class="text-danger">*</span></label>
          <select name="semester" class="elite-form-select {{ $errors->has('semester') ? 'is-invalid' : '' }}" required>
            <option value="Ganjil" {{ $pembobotan->semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
            <option value="Genap" {{ $pembobotan->semester == 'Genap' ? 'selected' : '' }}>Genap</option>
          </select>
          @error('semester') <small class="elite-form-error">{{ $message }}</small> @enderror
        </div>

        <div class="elite-form-group">
          <label class="elite-form-label">Tahun Ajaran <span class="text-danger">*</span></label>
          <input type="text" name="tahun_ajaran" class="elite-form-input {{ $errors->has('tahun_ajaran') ? 'is-invalid' : '' }}" 
                 value="{{ $pembobotan->tahun_ajaran }}" required>
          @error('tahun_ajaran') <small class="elite-form-error">{{ $message }}</small> @enderror
        </div>
      </div>

      <div class="elite-divider"></div>

      <h5 class="elite-section-title mb-4">⚖️ Set Bobot Penilaian (Total harus 100%)</h5>

      <div class="elite-grid">
        <div class="elite-form-group">
          <label class="elite-form-label">Bobot Tugas (%) <span class="text-danger">*</span></label>
          <input type="number" name="bobot_tugas" id="bobot_tugas" 
                 class="elite-form-input {{ $errors->has('bobot_tugas') ? 'is-invalid' : '' }}" 
                 value="{{ $pembobotan->bobot_tugas }}" required min="0" max="100">
          @error('bobot_tugas') <small class="elite-form-error">{{ $message }}</small> @enderror
        </div>

        <div class="elite-form-group">
          <label class="elite-form-label">Bobot UTS (%) <span class="text-danger">*</span></label>
          <input type="number" name="bobot_uts" id="bobot_uts" 
                 class="elite-form-input {{ $errors->has('bobot_uts') ? 'is-invalid' : '' }}" 
                 value="{{ $pembobotan->bobot_uts }}" required min="0" max="100">
          @error('bobot_uts') <small class="elite-form-error">{{ $message }}</small> @enderror
        </div>

        <div class="elite-form-group">
          <label class="elite-form-label">Bobot UAS (%) <span class="text-danger">*</span></label>
          <input type="number" name="bobot_uas" id="bobot_uas" 
                 class="elite-form-input {{ $errors->has('bobot_uas') ? 'is-invalid' : '' }}" 
                 value="{{ $pembobotan->bobot_uas }}" required min="0" max="100">
          @error('bobot_uas') <small class="elite-form-error">{{ $message }}</small> @enderror
        </div>
      </div>

      <!-- Total Bobot -->
      <div class="elite-total-card">
        <strong>Total Bobot:</strong> 
        <span id="total_bobot" class="elite-total-value">{{ $pembobotan->bobot_tugas + $pembobotan->bobot_uts + $pembobotan->bobot_uas }}</span>%
        <span id="status_bobot" class="elite-status-badge ms-2"></span>
      </div>

      <!-- Tombol -->
      <div class="elite-button-group mt-5">
        <button type="submit" class="elite-btn elite-btn-primary">
          <i class="fa-solid fa-save me-2"></i> Update Pembobotan
        </button>
        <a href="{{ route('rekap_nilai.index') }}" class="elite-btn elite-btn-secondary">
          <i class="fa-solid fa-arrow-left me-2"></i> Kembali
        </a>
      </div>

    </form>

  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const bobotTugas = document.getElementById('bobot_tugas');
      const bobotUts = document.getElementById('bobot_uts');
      const bobotUas = document.getElementById('bobot_uas');
      const totalBobot = document.getElementById('total_bobot');
      const statusBobot = document.getElementById('status_bobot');

      function hitungTotal() {
        const tugas = parseInt(bobotTugas.value) || 0;
        const uts = parseInt(bobotUts.value) || 0;
        const uas = parseInt(bobotUas.value) || 0;
        const total = tugas + uts + uas;

        totalBobot.textContent = total;

        if (total === 100) {
          statusBobot.innerHTML = '<span class="badge-valid"><i class="fa-solid fa-check"></i> Valid</span>';
        } else {
          statusBobot.innerHTML = '<span class="badge-invalid"><i class="fa-solid fa-times"></i> Harus 100%</span>';
        }
      }

      bobotTugas.addEventListener('input', hitungTotal);
      bobotUts.addEventListener('input', hitungTotal);
      bobotUas.addEventListener('input', hitungTotal);

      hitungTotal();
    });
  </script>

  <style>
    body {
      font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      color: #2d3748;
    }

    .elite-form-container {
      max-width: 800px;
      margin: 48px auto;
      background: white;
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
      border: 1px solid #eee;
      padding: 36px;
    }

    /* Alert Error */
    .elite-alert-error {
      background-color: #fce8e6;
      border-left: 4px solid #c5221f;
      color: #991b1b;
      padding: 14px 16px;
      border-radius: 8px;
      margin-bottom: 28px;
    }
    .elite-error-list {
      margin: 0;
      padding-left: 20px;
      font-size: 14px;
    }
    .elite-error-list li {
      margin-bottom: 4px;
    }

    /* Info Bar */
    .elite-info-bar {
      background-color: #e6f0ff;
      padding: 12px 16px;
      border-radius: 8px;
      border-left: 4px solid #1a73e8;
      color: #174ea6;
      font-size: 14px;
      margin-bottom: 24px;
    }

    /* Form Grid */
    .elite-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      margin-bottom: 24px;
    }

    /* Form Label */
    .elite-form-label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #333;
      font-size: 14px;
    }

    /* Form Input & Select */
    .elite-form-input,
    .elite-form-select {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 15px;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .elite-form-input:focus,
    .elite-form-select:focus {
      outline: none;
      border-color: #b91c1c;
      box-shadow: 0 0 0 3px rgba(185, 28, 28, 0.15);
    }

    /* Error */
    .elite-form-error {
      color: #b91c1c;
      font-size: 13px;
      margin-top: 4px;
      display: block;
    }

    /* Divider */
    .elite-divider {
      height: 1px;
      background-color: #eee;
      margin: 28px 0;
    }

    /* Section Title */
    .elite-section-title {
      color: #b91c1c;
      font-weight: 700;
      font-size: 1.25rem;
    }

    /* Total Card */
    .elite-total-card {
      background-color: #fdf2f2;
      padding: 16px;
      border-radius: 10px;
      border: 1px solid #fecaca;
      margin: 24px 0;
      font-size: 15px;
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: 8px;
    }
    .elite-total-value {
      font-weight: 700;
      color: #b91c1c;
      font-size: 16px;
    }

    /* Status Badge */
    .badge-valid {
      background-color: #dcfce7;
      color: #166534;
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 600;
    }
    .badge-invalid {
      background-color: #fee2e2;
      color: #b91c1c;
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 600;
    }

    /* Tombol */
    .elite-button-group {
      display: flex;
      gap: 16px;
      flex-wrap: wrap;
    }
    .elite-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 20px;
      border-radius: 8px;
      font-size: 15px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.2s ease;
      white-space: nowrap;
      border: none;
    }
    .elite-btn-primary {
      background-color: #b91c1c;
      color: white;
    }
    .elite-btn-primary:hover {
      background-color: #991b1b;
    }
    .elite-btn-secondary {
      background-color: #f1f5f9;
      color: #334155;
      border: 1px solid #e2e8f0;
    }
    .elite-btn-secondary:hover {
      background-color: #e2e8f0;
    }

    /* Utility */
    .text-danger { color: #b91c1c; }
    .mb-5 { margin-bottom: 32px; }
    .mb-4 { margin-bottom: 24px; }
    .mt-5 { margin-top: 32px; }
    .ms-2 { margin-left: 8px; }
    .me-2 { margin-right: 8px; }

    /* Responsif */
    @media (max-width: 600px) {
      .elite-form-container {
        padding: 24px;
        margin: 24px 12px;
      }
      .elite-grid {
        grid-template-columns: 1fr;
      }
      .elite-button-group {
        flex-direction: column;
      }
      .elite-btn {
        justify-content: center;
      }
    }
  </style>

</x-app-layout>