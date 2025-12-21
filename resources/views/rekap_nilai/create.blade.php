<x-app-layout>
    <div class="card shadow-sm p-4">

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('rekap_nilai.store') }}" method="POST">
            @csrf

            <!-- Info Mapel -->
            <div class="alert alert-info mb-3">
                <strong>📚 Mapel:</strong> {{ $mapel->nama_mapel ?? '-' }}
                <small class="d-block text-muted">Pembobotan akan dibuat untuk mapel yang Anda ampu</small>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Kelas <span class="text-danger">*</span></label>
                    <select name="kelas_id" class="form-select @error('kelas_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}- {{ $k->jurusan->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelas_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">Semester <span class="text-danger">*</span></label>
                    <select name="semester" class="form-select @error('semester') is-invalid @enderror" required>
                        <option value="Ganjil" {{ old('semester') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                        <option value="Genap" {{ old('semester') == 'Genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                    @error('semester') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">Tahun Ajaran <span class="text-danger">*</span></label>
                    <input type="text" name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" 
                           value="{{ old('tahun_ajaran', '2024/2025') }}" required placeholder="Contoh: 2024/2025">
                    @error('tahun_ajaran') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <hr>

            <h5 class="mb-3 text-danger">⚖️ Set Bobot Penilaian (Total harus 100%)</h5>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Bobot Tugas (%) <span class="text-danger">*</span></label>
                    <input type="number" name="bobot_tugas" id="bobot_tugas" 
                           class="form-control @error('bobot_tugas') is-invalid @enderror" 
                           value="{{ old('bobot_tugas', 20) }}" required min="0" max="100">
                    @error('bobot_tugas') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Bobot UTS (%) <span class="text-danger">*</span></label>
                    <input type="number" name="bobot_uts" id="bobot_uts" 
                           class="form-control @error('bobot_uts') is-invalid @enderror" 
                           value="{{ old('bobot_uts', 30) }}" required min="0" max="100">
                    @error('bobot_uts') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Bobot UAS (%) <span class="text-danger">*</span></label>
                    <input type="number" name="bobot_uas" id="bobot_uas" 
                           class="form-control @error('bobot_uas') is-invalid @enderror" 
                           value="{{ old('bobot_uas', 50) }}" required min="0" max="100">
                    @error('bobot_uas') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <!-- Total Bobot -->
            <div class="alert alert-secondary">
                <strong>Total Bobot:</strong> <span id="total_bobot" class="fw-bold">100</span>%
                <span id="status_bobot" class="ms-2"></span>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-danger px-4 py-2 fw-semibold">
                    <i class="fa-solid fa-save me-2"></i> Simpan Pembobotan
                </button>
                <a href="{{ route('rekap_nilai.index') }}" class="btn btn-secondary px-4 py-2">
                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                </a>
            </div>

        </form>
    </div>

    <script>
        // Hitung total bobot secara real-time
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
                    statusBobot.innerHTML = '<span class="badge bg-success"><i class="fa-solid fa-check"></i> Valid</span>';
                } else {
                    statusBobot.innerHTML = '<span class="badge bg-danger"><i class="fa-solid fa-times"></i> Harus 100%</span>';
                }
            }

            bobotTugas.addEventListener('input', hitungTotal);
            bobotUts.addEventListener('input', hitungTotal);
            bobotUas.addEventListener('input', hitungTotal);

            // Hitung saat load
            hitungTotal();
        });
    </script>
</x-app-layout>
