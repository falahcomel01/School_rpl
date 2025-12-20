<x-app-layout>
  <div class="container mx-auto p-4">

    @if ($errors->any())
      <div class="alert-error mb-4">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="card">
      <h3 class="form-title">Form Edit Jadwal</h3>

      <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">

          {{-- Hari --}}
          <div class="form-group">
            <label>Hari <span class="text-red-500">*</span></label>
            <select name="hari" required>
              <option value="">-- Pilih Hari --</option>
              @foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                <option value="{{ $hari }}" {{ old('hari', $jadwal->hari) == $hari ? 'selected' : '' }}>
                  {{ $hari }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Kelas --}}
          <div class="form-group">
            <label>Kelas <span class="text-red-500">*</span></label>
            <select name="kelas_id" id="kelas_id" required>
              <option value="">-- Pilih Kelas --</option>
              @foreach ($kelasList as $s)
                <option value="{{ $s->id }}" {{ old('kelas_id', $jadwal->kelas_id) == $s->id ? 'selected' : '' }}>
                  {{ $s->nama_kelas }} ({{ $s->jurusan->nama_jurusan ?? 'Umum' }})
                </option>
              @endforeach
            </select>
          </div>

          {{-- Jam Mulai --}}
          <div class="form-group">
            <label>Jam Mulai <span class="text-red-500">*</span></label>
            <input type="time" name="jam_mulai" id="jam_mulai"
                   value="{{ old('jam_mulai', $jadwal->jam_mulai) }}" required>
          </div>

          {{-- Jam Selesai --}}
          <div class="form-group">
            <label>Jam Selesai <span class="text-red-500">*</span></label>
            <input type="time" name="jam_selesai" id="jam_selesai"
                   value="{{ old('jam_selesai', $jadwal->jam_selesai) }}" required>
            <p class="note">Minimal 30 menit dari jam mulai</p>
          </div>

          {{-- Mapel --}}
          <div class="form-group">
            <label>Mata Pelajaran <span class="text-red-500">*</span></label>
            <select name="mapel_id" id="mapel_id" required>
              <option value="">-- Pilih kelas dulu --</option>
            </select>
          </div>

          {{-- Guru --}}
          <div class="form-group">
            <label>Guru <span class="text-red-500">*</span></label>
            <select name="guru_id" id="guru_id" required>
              <option value="">-- Pilih Mapel dulu --</option>
            </select>
          </div>

        </div>

        <div class="form-footer">
          <a href="{{ route('jadwal.index') }}" class="btn-cancel">Batal</a>
          <button type="submit" class="btn-submit">Update</button>
        </div>

      </form>
    </div>
  </div>
  {{-- === CSS === --}}
  <style>
    body { font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; background-color: #f9fafb; }
    .card { background: #fff; border-radius: .75rem; box-shadow: 0 3px 8px rgba(0,0,0,.08); border: 1px solid #f3caca; padding: 1.75rem; }
    .form-title { font-size: 1.3rem; font-weight: 700; color: #b91c1c; border-bottom: 2px solid #b91c1c; margin-bottom: 1.25rem; padding-bottom: .3rem; }
    .alert-error { background: #fee2e2; border: 1px solid #f87171; color: #991b1b; padding: .75rem 1rem; border-radius: .5rem; }
    .form-group label { font-weight: 600; font-size: .9rem; display: block; color: #374151; margin-bottom: .35rem; }
    .form-group select, .form-group input { width: 100%; border: 1px solid #d1d5db; border-radius: .5rem; padding: .55rem .75rem; font-size: .9rem; color: #111827; }
    .form-footer { display: flex; justify-content: flex-end; margin-top: 1.75rem; gap: .5rem; }
    .btn-submit { background-color: #b91c1c; color: white; padding: .55rem 1rem; border-radius: .5rem; font-weight: 600; }
    .btn-cancel { background-color: #9ca3af; color: white; padding: .55rem 1rem; border-radius: .5rem; font-weight: 600; }
  </style>

  {{-- === Script === --}}
  <script>
     // --------------------------
    // 1. LOAD MAPEL BY KELAS
    // --------------------------
    const kelasSelect = document.getElementById('kelas_id');
    const mapelSelect = document.getElementById('mapel_id');
    const guruSelect = document.getElementById('guru_id');

    kelasSelect.addEventListener('change', function () {
        const id = this.value;
        mapelSelect.innerHTML = '<option>Loading...</option>';
        guruSelect.innerHTML = '<option>-- Pilih Mapel dulu --</option>';

        fetch(`/jadwal/get-mapel-kelas/${id}`)
          .then(r => r.json())
          .then(data => {
            mapelSelect.innerHTML = '<option value="">-- Pilih Mapel --</option>';
            data.forEach(m => {
              mapelSelect.innerHTML += `<option value="${m.id}">${m.nama_mapel}</option>`;
            });

            // Auto select saat edit
            mapelSelect.value = "{{ old('mapel_id', $jadwal->mapel_id) }}";
            mapelSelect.dispatchEvent(new Event('change'));
          });
    });

    // Auto load saat edit
    kelasSelect.dispatchEvent(new Event('change'));


    // --------------------------
    // 2. LOAD GURU BY MAPEL
    // --------------------------
    mapelSelect.addEventListener('change', function () {
        const mapelId = this.value;
        guruSelect.innerHTML = '<option>Loading...</option>';

        fetch(`/jadwal/get-guru-by-mapel/${mapelId}`)
          .then(r => r.json())
          .then(data => {
            guruSelect.innerHTML = '<option value="">-- Pilih Guru --</option>';

            data.forEach(g => {
              guruSelect.innerHTML += `<option value="${g.id}">${g.nama}</option>`;
            });

            // Auto-select guru saat edit
            guruSelect.value = "{{ old('guru_id', $jadwal->guru_id) }}";
          });
    });


    // --------------------------
    // 3. MINIMAL 30 MENIT
    // --------------------------
    const jamMulai = document.getElementById('jam_mulai');
    const jamSelesai = document.getElementById('jam_selesai');

    jamMulai.addEventListener('change', () => {
      const [h, m] = jamMulai.value.split(':').map(Number);
      const minSelesai = new Date(0, 0, 0, h, m + 30);
      jamSelesai.min = minSelesai.toTimeString().slice(0,5);
    });
  </script>
</x-app-layout>
