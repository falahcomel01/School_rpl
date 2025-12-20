<x-app-layout>

    <div class="card shadow-sm p-4">

        <form action="{{ route('ujian.store') }}" method="POST">
            @csrf

            <!-- Info Mapel yang diampu -->
            <div class="alert alert-info mb-3">
                <strong>📚 Mapel:</strong> {{ $mapel->nama_mapel ?? '-' }}
                <small class="d-block text-muted">Ujian akan dibuat untuk mapel yang Anda ampu</small>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Kelas</label>
                    <select name="kelas_id" class="form-select @error('kelas_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kelas yang Anda Ampu --</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                    @error('kelas_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Jenis Ujian</label>
                    <input type="text" name="jenis_ujian" class="form-control @error('jenis_ujian') is-invalid @enderror" required placeholder="Contoh: UTS, UAS">
                    @error('jenis_ujian') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>


            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tipe Paket</label>
                    <select name="tipe_paket" id="tipe_paket" class="form-select @error('tipe_paket') is-invalid @enderror" required>
                        <option value="1_paket">1 Paket (Semua siswa soal sama)</option>
                        <option value="random">Random (Paket berbeda)</option>
                    </select>
                    @error('tipe_paket') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-3" id="jumlah_paket_wrapper" style="display: none;">
                    <label class="form-label fw-semibold">Jumlah Paket</label>
                    <input type="number" name="jumlah_paket" id="jumlah_paket" class="form-control @error('jumlah_paket') is-invalid @enderror" min="2" max="26" placeholder="Contoh: 2 (Paket A dan B)">
                    <small class="text-muted">Minimal 2 paket, maksimal 26 paket (A-Z)</small>
                    @error('jumlah_paket') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Jumlah Soal</label>
                    <input type="number" name="jumlah_soal" class="form-control @error('jumlah_soal') is-invalid @enderror" required>
                    @error('jumlah_soal') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>


            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Durasi (menit)</label>
                    <input type="number" name="durasi_menit" class="form-control" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">Tanggal Mulai</label>
                    <input type="datetime-local" name="tanggal_mulai" class="form-control" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">Tanggal Selesai</label>
                    <input type="datetime-local" name="tanggal_selesai" class="form-control" required>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-danger px-4 py-2 fw-semibold">
                    <i class="fa-solid fa-save me-2"></i> Simpan Ujian
                </button>
            </div>

        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tipePaket = document.getElementById('tipe_paket');
            const jumlahPaketWrapper = document.getElementById('jumlah_paket_wrapper');
            const jumlahPaketInput = document.getElementById('jumlah_paket');

            tipePaket.addEventListener('change', function() {
                if (this.value === 'random') {
                    jumlahPaketWrapper.style.display = 'block';
                    jumlahPaketInput.required = true;
                } else {
                    jumlahPaketWrapper.style.display = 'none';
                    jumlahPaketInput.required = false;
                    jumlahPaketInput.value = '';
                }
            });

            // Trigger on page load untuk set required attribute
            if (tipePaket.value === 'random') {
                jumlahPaketWrapper.style.display = 'block';
                jumlahPaketInput.required = true;
            } else {
                jumlahPaketWrapper.style.display = 'none';
                jumlahPaketInput.required = false;
            }
        });
    </script>

</x-app-layout>
