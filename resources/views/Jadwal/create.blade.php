<x-app-layout>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f9fafb;
    }

    .card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1dada;
      padding: 30px;
      transition: 0.3s ease;
    }

    .card:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
    }

    .header-title {
      font-size: 1.6rem;
      font-weight: 700;
      color: #b91c1c;
      border-bottom: 3px solid #b91c1c;
      padding-bottom: 8px;
      margin-bottom: 25px;
    }

    .alert-error {
      background-color: #fee2e2;
      border-left: 4px solid #dc2626;
      color: #7f1d1d;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
    }

    label {
      font-weight: 600;
      font-size: 14px;
      color: #374151;
      margin-bottom: 5px;
      display: block;
    }

    select,
    input[type="time"],
    textarea {
      width: 100%;
      border: 1px solid #f3c5c5;
      border-radius: 8px;
      padding: 9px 10px;
      font-size: 14px;
      transition: 0.25s ease;
      color: #111;
      background-color: #fff;
    }

    select:focus,
    input:focus,
    textarea:focus {
      border-color: #b91c1c;
      box-shadow: 0 0 0 2px rgba(185, 28, 28, 0.15);
      outline: none;
    }

    .btn-primary {
      background-color: #dc2626;
      color: #fff;
      padding: 10px 18px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
      border: none;
      cursor: pointer;
      transition: 0.25s ease;
    }

    .btn-primary:hover {
      background-color: #b91c1c;
    }

    .btn-secondary {
      background-color: #e5e7eb;
      color: #111827;
      padding: 10px 18px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
      border: none;
      cursor: pointer;
      transition: 0.25s ease;
    }

    .btn-secondary:hover {
      background-color: #d1d5db;
    }

    .form-footer {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 25px;
    }

    @media (max-width: 640px) {
      .card {
        padding: 20px;
      }

      .grid-cols-2 {
        grid-template-columns: 1fr;
      }

      .form-footer {
        flex-direction: column;
        align-items: stretch;
      }
    }
  </style>

  <div class="py-10">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
      <div class="card">
        <h3 class="header-title">Form Tambah Jadwal</h3>

        {{-- ⚠️ Pesan error --}}
        @if ($errors->any())
          <div class="alert-error">
            <ul class="list-disc list-inside">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('jadwal.store') }}" method="POST">
          @csrf

          <div class="grid grid-cols-2 gap-4">
            {{-- Hari --}}
            <div>
              <label>Hari <span class="text-red-600">*</span></label>
              <select name="hari" required>
                <option value="">-- Pilih Hari --</option>
                @foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                  <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                @endforeach
              </select>
            </div>

            {{-- Subkelas --}}
            <div>
              <label>Kelas <span class="text-red-600">*</span></label>
              <select name="kelas_id" id="kelas_id" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelasList as $s)
                  <option value="{{ $s->id }}" {{ old('kelas_id') == $s->id ? 'selected' : '' }}>
                    {{ $s->nama_kelas }}-({{ $s->jurusan->nama_jurusan ?? 'Umum' }})
                  </option>
                @endforeach
              </select>
            </div>

            {{-- Jam Mulai --}}
            <div>
              <label>Jam Mulai <span class="text-red-600">*</span></label>
              <input type="time" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai') }}" min="07:00" max="15:00" required>
            </div>

            {{-- Jam Selesai --}}
            <div>
              <label>Jam Selesai <span class="text-red-600">*</span></label>
              <input type="time" name="jam_selesai" id="jam_selesai" value="{{ old('jam_selesai') }}" min="07:00" max="15:00" required>
              <p class="text-gray-500 text-xs mt-1">Minimal 30 menit dari jam mulai</p>
            </div>

            {{-- Mapel --}}
            <div>
              <label>Mata Pelajaran <span class="text-red-600">*</span></label>
              <select name="mapel_id" id="mapel_id" required>
                <option value="">-- Pilih kelas Dulu --</option>
              </select>
            </div>

            {{-- Guru --}}
          <div>
              <label>Guru <span class="text-red-600">*</span></label>
                    <select name="guru_id" id="guru_id" required>
    <option value="">-- Pilih Mapel Dulu --</option>
</select>
            </div>


          <div class="form-footer">
            <a href="{{ route('jadwal.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Script --}}
  <script>
    const kelasSelect = document.getElementById('kelas_id');
    const mapelSelect = document.getElementById('mapel_id');

    kelasSelect.addEventListener('change', function() {
      const id = this.value;
      mapelSelect.innerHTML = '<option>-- Loading... --</option>';

      if (!id) {
        mapelSelect.innerHTML = '<option>-- Pilih kelas Dulu --</option>';
        return;
      }

      fetch(`/jadwal/get-mapel-kelas/${id}`)
        .then(res => res.ok ? res.json() : Promise.reject(res))
        .then(data => {
          mapelSelect.innerHTML = '<option value="">-- Pilih Mapel --</option>';
          data.forEach(m => {
            const opt = document.createElement('option');
            opt.value = m.id;
            opt.textContent = m.nama_mapel;
            if ("{{ old('mapel_id') }}" == m.id) opt.selected = true;
            mapelSelect.appendChild(opt);
          });
        })
        .catch(() => mapelSelect.innerHTML = '<option>-- Gagal Memuat Mapel --</option>');
    });

  
    @if (old('kelas_id'))
      kelasSelect.dispatchEvent(new Event('change'));
    @endif

  
    const jamMulai = document.getElementById('jam_mulai');
    const jamSelesai = document.getElementById('jam_selesai');
    jamMulai.addEventListener('change', () => {
      const [h, m] = jamMulai.value.split(':').map(Number);
      const minSelesai = new Date(0, 0, 0, h, m + 30);
      jamSelesai.min = minSelesai.toTimeString().slice(0, 5);
    });
    const guruSelect = document.getElementById('guru_id');
const mapelSelectElement = document.getElementById('mapel_id');

mapelSelectElement.addEventListener('change', function() {
    const id = this.value;
    guruSelect.innerHTML = '<option>-- Loading... --</option>';

    if (!id) {
        guruSelect.innerHTML = '<option>-- Pilih Mapel Dulu --</option>';
        return;
    }

    fetch(`/jadwal/get-guru-by-mapel/${id}`)
        .then(res => res.ok ? res.json() : Promise.reject(res))
        .then(data => {
            guruSelect.innerHTML = '<option value="">-- Pilih Guru --</option>';
            data.forEach(g => {
                const opt = document.createElement('option');
                opt.value = g.id;
                opt.textContent = g.nama;
                
                if ("{{ old('guru_id') }}" == g.id) opt.selected = true;

                guruSelect.appendChild(opt);
            });
        })
        .catch(() => {
            guruSelect.innerHTML = '<option>-- Gagal Memuat Guru --</option>';
        });
});

  </script>
</x-app-layout>
