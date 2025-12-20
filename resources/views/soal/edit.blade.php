<x-app-layout>

    <div class="container mx-auto p-4">

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('soal.update', $soal->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Teks Soal</label>
                <textarea name="soal_text" class="form-control" required rows="4">{{ old('soal_text', $soal->soal_text) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipe Soal</label>
                <select name="tipe_soal" class="form-control" id="tipe">
                    <option value="pg" {{ old('tipe_soal', $soal->tipe_soal) == 'pg' ? 'selected' : '' }}>Pilihan Ganda</option>
                    <option value="essay" {{ old('tipe_soal', $soal->tipe_soal) == 'essay' ? 'selected' : '' }}>Essay</option>
                </select>
            </div>

            <!-- OPSI PG -->
            <div id="opsi_pg">

                <label class="form-label">Opsi Jawaban</label>

                @php
                    // Urutkan berdasarkan urutan (A,B,C,D)
                    $opsi = $soal->opsiJawaban->sortBy('urutan')->values();
                @endphp

                @for ($i = 0; $i < 4; $i++)
                    <div class="input-group mb-2">
                        <span class="input-group-text">{{ chr(65 + $i) }}</span>
                        <input 
                            type="text"
                            name="opsi[]"
                            class="form-control"
                            value="{{ old("opsi.$i", $opsi[$i]->opsi_text ?? '') }}"
                            placeholder="Opsi {{ chr(65 + $i) }}"
                        >
                        <span class="input-group-text">
                            <input
                                type="radio"
                                name="jawaban_benar"
                                value="{{ $i }}"
                                {{ (old('jawaban_benar') === (string) $i) || (isset($opsi[$i]) && $opsi[$i]->is_benar) ? 'checked' : '' }}
                            >
                            Benar
                        </span>
                    </div>
                @endfor

            </div>

            <button type="submit" class="btn btn-success w-100 mt-3">Update Soal</button>
          <a href="{{ route('soal.detail', $soal->jenis_ujian_id) }}" class="btn btn-secondary w-100 mt-2">Batal</a>

        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tipeSelect = document.getElementById('tipe');
            const opsiPg = document.getElementById('opsi_pg');

            function toggleOpsi() {
                opsiPg.style.display = (tipeSelect.value === 'pg') ? 'block' : 'none';
            }

            tipeSelect.addEventListener('change', toggleOpsi);
            toggleOpsi(); // Inisialisasi saat halaman dimuat
        });
    </script>

</x-app-layout>