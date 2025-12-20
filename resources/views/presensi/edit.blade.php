<x-app-layout>

  <style>
    .card {
      background: #ffffff;
      border-radius: 12px;
      padding: 24px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      border: 1px solid #f3c5c5;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-radius: 8px;
      overflow: hidden;
      border: 1px solid #f4dede;
    }

    thead {
      background: #fff1f1;
      color: #7f1d1d;
      font-weight: bold;
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid #f8eaea;
      vertical-align: middle;
    }

    select, input[type="text"] {
      width: 100%;
      padding: 8px;
      border-radius: 8px;
      border: 1px solid #f3c5c5;
    }

    .btn-save {
      background: #dc2626;
      color: white;
      font-weight: 600;
      padding: 10px 18px;
      border-radius: 8px;
    }

    .btn-cancel {
      background: #e5e7eb;
      padding: 10px 16px;
      border-radius: 8px;
      color: #374151;
      font-weight: 600;
    }
  </style>

  <div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <div class="card">
        <h3 class="text-lg font-bold text-red-700 mb-4">Formulir Edit Presensi</h3>

        <form action="{{ route('presensi.update', $jadwal->id) }}" method="POST">
          @csrf
          @method('PUT')

          <input type="hidden" name="tanggal" value="{{ $tanggal }}">

          <div class="mb-4">
            <label class="font-semibold">Tanggal Presensi</label>
            <input type="text" value="{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}"
                   readonly class="bg-gray-100 cursor-not-allowed">
          </div>

          {{-- STATUS GURU --}}
          <div class="mb-6">
            <label class="font-semibold">Status Guru</label>
            @php
              $guruUserId = $jadwal->guru->user_id ?? null;
              $statusGuru = $presensis[$guruUserId]->status ?? 'hadir';
            @endphp
            <select name="status_guru" required>
              <option value="hadir" {{ $statusGuru == 'hadir' ? 'selected' : '' }}>Hadir</option>
              <option value="izin"  {{ $statusGuru == 'izin'  ? 'selected' : '' }}>Izin</option>
              <option value="sakit" {{ $statusGuru == 'sakit' ? 'selected' : '' }}>Sakit</option>
              <option value="alpa"  {{ $statusGuru == 'alpa'  ? 'selected' : '' }}>Alpa</option>
            </select>
          </div>

          {{-- TABEL SISWA --}}
          <div class="overflow-x-auto">
            <table>
              <thead>
                <tr>
                  <th>Nama</th>
                  <th style="width:160px;">Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($siswas as $s)
                  @php
                    $userId = $s->user_id;
                    $ps = $presensis[$userId]->status ?? ($s->status_default ?? 'hadir');
                  @endphp

                  <tr @if($s->izin_aktif) style="background:#f8fafc;" @endif>
                    <td>{{ $s->user->name }}</td>

                    <td>
                      <select name="status_siswa[{{ $userId }}]">
                        <option value="hadir" {{ $ps == 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="izin"  {{ $ps == 'izin'  ? 'selected' : '' }}>Izin</option>
                        <option value="sakit" {{ $ps == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="alpa"  {{ $ps == 'alpa'  ? 'selected' : '' }}>Alpa</option>
                      </select>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="2" class="text-center text-gray-500 py-2">Tidak ada siswa</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="flex justify-end mt-6">
            <a href="{{ route('presensi.show', $jadwal->id) }}" class="btn-cancel mr-2">Batal</a>
            <button type="submit" class="btn-save">Simpan Perubahan</button>
          </div>

        </form>
      </div>
    </div>
  </div>

</x-app-layout>
