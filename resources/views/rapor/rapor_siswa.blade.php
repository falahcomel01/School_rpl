<x-app-layout>
    <div class="card shadow-sm p-4">

        <!-- Info Siswa -->
        <div class="student-profile-card mb-4">
            <div class="d-flex align-items-center">
                <div class="student-avatar me-3">
                    <i class="fa-solid fa-user-graduate fa-3x text-danger"></i>
                </div>
                <div class="student-info">
                    <h5 class="mb-1">{{ $siswa->user->name ?? 'Siswa' }}</h5>
                    <p class="mb-1 text-muted"><strong>NIS:</strong> {{ $siswa->user->username }}</p>
                    <p class="mb-0"><strong>Kelas:</strong> {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
                </div>
            </div>
        </div>

        @if($rapors->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fa-solid fa-info-circle me-2"></i>
                Belum ada rekap nilai yang tersedia.
            </div>
        @else
            @foreach($rapors as $r)
                <div class="card mb-4 rapor-card">
                    <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fa-solid fa-file-alt me-2"></i>
                            Rapor Semester {{ $r->semester }} - {{ $r->tahun_ajaran }}
                        </h5>
                        <span class="badge bg-light text-danger">{{ $r->jumlah_mapel }} Mapel</span>
                    </div>
                    <div class="card-body">
                        
                        <!-- Rata-rata -->
                        <div class="rata-rata-display mb-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <strong>Rata-rata Keseluruhan:</strong>
                                </div>
                                <div class="col-md-6 text-end">
                                    <h3 class="mb-0 text-danger">{{ number_format($r->rata_rata, 2) }}</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Lihat Detail -->
                        <div class="text-center">
                          <a href="{{ route('rapor.detail_siswa', [$r->semester, str_replace('/', '-', $r->tahun_ajaran)]) }}" 
   class="btn btn-danger btn-detail">
    <i class="fa-solid fa-eye me-2"></i> Lihat Detail Rapor
</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>

    <style>
        /* General Card & Body */
        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        }

        /* Student Profile Section */
        .student-profile-card {
            background-color: #f8d7da; /* Light Red Background */
            border-radius: 12px;
            padding: 20px;
            border-left: 4px solid #b91c1c; /* Primary Red Border */
        }

        .student-avatar {
            background-color: #f8d7da; /* Light Red Background */
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .student-info h5 {
            color: #b91c1c; /* Primary Red Text */
            font-weight: 700;
        }

        /* Rapor Card Specifics */
        .rapor-card {
            border-left: 4px solid #b91c1c; /* Primary Red Border */
        }
        
        .rapor-card .card-header {
            border-radius: 12px 12px 0 0;
            border-bottom: none;
        }

        /* Rata-rata Display */
        .rata-rata-display {
            background-color: #f8d7da; /* Light Red Background */
            border-radius: 8px;
            padding: 15px;
            border-left: 4px solid #b91c1c; /* Primary Red Border */
        }

        .rata-rata-display h3 {
            font-weight: 700;
        }

        /* Button Styling */
        .btn-detail {
            background-color: #b91c1c; /* Primary Red */
            border-color: #b91c1c;
            padding: 8px 20px;
            font-weight: 600;
            border-radius: 8px;
            transition: background-color 0.2s;
        }

        .btn-detail:hover {
            background-color: #a00e1e; /* Darker Red for Hover */
            border-color: #a00e1e;
        }
        
        /* Utility */
        .me-2 { margin-right: 8px; }
        .me-3 { margin-right: 12px; }
        .mb-1 { margin-bottom: 8px; }
        .mb-0 { margin-bottom: 0; }
        .text-muted { color: #6c757d; }
    </style>
</x-app-layout>