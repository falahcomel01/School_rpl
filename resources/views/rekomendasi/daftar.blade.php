<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ALERT --}}
            @if(session('success'))
                <div class="alert alert-success mb-4">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger mb-4">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                </div>
            @endif

            <div class="card shadow-lg border-0">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-users-cog me-2"></i>Daftar Rekomendasi Jurusan Siswa
                    </h5>
                </div>

                <div class="card-body">

                    @if($rekomendasi->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-inbox fa-4x mb-3"></i>
                            <p>Belum ada data rekomendasi</p>
                        </div>
                    @else

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-danger">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Siswa</th>
                                    <th>Pilihan Siswa</th>
                                    <th>Hasil Jurusan (Final)</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($rekomendasi as $i => $item)
                                <tr>
                                    <td class="text-center">{{ $i+1 }}</td>

                                    {{-- NAMA SISWA --}}
                                    <td>
                                        <strong>{{ $item->siswa->user->name }}</strong><br>
                                        <small class="text-muted">{{ $item->siswa->user->username }}</small>
                                    </td>

                                    {{-- PILIHAN SISWA --}}
                                    <td>
                                        @if($item->validasi !== 'disetujui')
                                            @if($item->jurusan)
                                                <span class="badge bg-secondary">
                                                    {{ $item->jurusan->nama_jurusan }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        @else
                                            <span class="text-muted fst-italic">
                                                Tidak berlaku
                                            </span>
                                        @endif
                                    </td>

                                    {{-- HASIL FINAL --}}
                                    <td>
                                        @if($item->validasi === 'disetujui' && $item->jurusanRekomendasi)
                                            <span class="badge bg-success fs-6">
                                                <i class="fas fa-graduation-cap me-1"></i>
                                                {{ $item->jurusanRekomendasi->nama_jurusan }}
                                            </span>
                                            <div class="small text-success mt-1">
                                                <i class="fas fa-check-circle"></i> Final
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    {{-- STATUS --}}
                                    <td class="text-center">
                                        @if($item->validasi === 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($item->validasi === 'disetujui')
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-secondary">Ditolak</span>
                                        @endif
                                    </td>

                                    {{-- AKSI --}}
                                    <td class="text-center">
                                        @if($item->validasi !== 'disetujui')
                                            <a href="{{ route('rekomendasi.validasi', $item->id) }}"
                                               class="btn btn-sm btn-danger">
                                                <i class="fas fa-check-double"></i>
                                            </a>
                                        @endif

                                        <form action="{{ route('rekomendasi.batal', $item->id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-warning"
                                                onclick="return confirm('Yakin ingin membatalkan?')">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
