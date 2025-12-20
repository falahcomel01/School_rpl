<x-app-layout>

  <div class="container">

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
      <div class="alert-success">
        {{ session('success') }}
      </div>
    @endif

    {{-- Judul --}}
    <h3 class="section-title mb-20">Tambah Soal Baru</h3>

    {{-- Form --}}
    <form action="{{ route('soal.store', $jenisUjian->id) }}" method="POST">
      @csrf

      <!-- Soal -->
      <div class="form-group">
        <label class="form-label">Teks Soal</label>
        <textarea name="soal_text" class="form-input" required>{{ old('soal_text') }}</textarea>
        @error('soal_text')
          <div class="form-error">{{ $message }}</div>
        @enderror
      </div>

      <!-- Tipe Soal -->
      <div class="form-group">
        <label class="form-label">Tipe Soal</label>
        <select name="tipe_soal" class="form-select" id="tipe" required>
          <option value="pg" {{ old('tipe_soal') == 'pg' ? 'selected' : '' }}>Pilihan Ganda</option>
          <option value="essay" {{ old('tipe_soal') == 'essay' ? 'selected' : '' }}>Essay</option>
        </select>
        @error('tipe_soal')
          <div class="form-error">{{ $message }}</div>
        @enderror
      </div>

      <!-- Opsi PG -->
      <div id="opsi_pg" class="pg-section">
        <label class="form-label mb-2">Opsi Jawaban</label>

        @for ($i = 0; $i < 4; $i++)
          <div class="input-row">
            <div class="input-option-letter">{{ chr(65 + $i) }}</div>
            <input 
              type="text" 
              name="opsi[]" 
              class="form-input" 
              placeholder="Opsi {{ chr(65 + $i) }}"
              {{ old('tipe_soal') == 'pg' ? 'required' : '' }}>

            <div class="radio-benar">
              <input 
                type="radio" 
                name="jawaban_benar" 
                value="{{ $i }}"
                {{ old('tipe_soal') == 'pg' ? 'required' : '' }}>
              <span>Benar</span>
            </div>
          </div>
        @endfor

        @error('opsi')
          <div class="form-error">{{ $message }}</div>
        @enderror
        @error('jawaban_benar')
          <div class="form-error">{{ $message }}</div>
        @enderror
      </div>

      <!-- Tombol Simpan -->
      <button type="submit" class="btn btn-primary w-full mt-4">Simpan Soal</button>

    </form>

  </div>

  {{-- Script PG toggle --}}
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const tipe = document.getElementById('tipe');
      const opsiPg = document.getElementById('opsi_pg');

      const opsiInputs = opsiPg.querySelectorAll('input[name="opsi[]"]');
      const jawabanBenarInput = opsiPg.querySelector('input[name="jawaban_benar"]');

      function aturForm(isPilihanGanda) {
        if (isPilihanGanda) {
          opsiPg.style.display = 'block';
          opsiInputs.forEach(input => input.setAttribute('required', ''));
          jawabanBenarInput.setAttribute('required', '');
        } else {
          opsiPg.style.display = 'none';
          opsiInputs.forEach(input => input.removeAttribute('required'));
          jawabanBenarInput.removeAttribute('required');
        }
      }

      tipe.addEventListener('change', function() {
        aturForm(this.value === 'pg');
      });

      aturForm(tipe.value === 'pg');
    });
  </script>

  {{-- CSS Styling --}}
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #fafafa;
    }

    .container {
      max-width: 800px;
      margin: 40px auto;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1dada;
      padding: 30px;
    }

    .section-title {
      font-size: 1.4rem;
      font-weight: 700;
      color: #b91c1c;
      margin-bottom: 24px;
      padding-bottom: 8px;
      border-bottom: 2px solid #b91c1c;
    }

    /* Notifikasi */
    .alert-success {
      background-color: #d1fae5;
      border-left: 4px solid #10b981;
      color: #065f46;
      padding: 10px 14px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    /* Form */
    .form-group {
      margin-bottom: 20px;
    }

    .form-label {
      display: block;
      font-weight: 600;
      margin-bottom: 6px;
      color: #333;
    }

    .form-input,
    .form-select {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 15px;
      transition: border-color 0.2s;
    }

    .form-input:focus,
    .form-select:focus {
      outline: none;
      border-color: #b91c1c;
      box-shadow: 0 0 0 3px rgba(185, 28, 28, 0.1);
    }

    .form-error {
      color: #dc2626;
      font-size: 13px;
      margin-top: 4px;
    }

    /* Opsi PG */
    .pg-section {
      display: block;
      margin-top: 16px;
      padding-top: 16px;
      border-top: 1px dashed #eee;
    }

    .input-row {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 10px;
    }

    .input-option-letter {
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f1f1f1;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-weight: bold;
      color: #555;
    }

    .radio-benar {
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 0 12px;
      background-color: #fef2f2;
      border: 1px solid #f87171;
      border-radius: 6px;
      color: #dc2626;
      font-size: 13px;
    }

    .radio-benar input[type="radio"] {
      margin: 0;
    }

    /* Tombol Simpan */
    .btn-primary {
      background-color: #b91c1c;
      color: white;
      font-weight: 600;
      padding: 10px 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.2s;
    }

    .btn-primary:hover {
      background-color: #991b1b;
    }

    .w-full {
      width: 100%;
    }

    .mb-20 {
      margin-bottom: 20px;
    }

    /* Responsif kecil */
    @media (max-width: 600px) {
      .input-row {
        flex-direction: column;
        align-items: flex-start;
      }
      .radio-benar {
        align-self: flex-end;
        margin-top: 4px;
      }
    }
  </style>

</x-app-layout>
