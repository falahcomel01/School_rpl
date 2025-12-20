<x-app-layout>

    <div class="exam-wrapper">

        {{-- ALERT --}}
        @foreach (['success', 'error', 'info'] as $msg)
            @if(session($msg))
                <div class="alert alert-{{ $msg }}">
                    {{ session($msg) }}
                </div>
            @endif
        @endforeach

        {{-- CARD SISWA --}}
        <div class="student-box">
            <h4>👤 {{ $siswa->nama ?? 'Siswa' }}</h4>
            <div class="class-box">
                <i class="fas fa-school me-2"></i>Kelas: {{ $siswa->kelas->nama_kelas ?? '-' }}
            </div>
        </div>

        {{-- TABEL --}}
        <div class="table-container">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mapel</th>
                        <th>Guru</th>
                        <th>Jenis</th>
                        <th>Durasi</th>
                        <th>Waktu</th>
                        <th>Status Ujian</th>
                        <th>Status Anda</th>
                        <th>Paket</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($ujians as $ujian)
                        <tr>
                            <td class="center">{{ $loop->iteration }}</td>
                            
                            <td>{{ $ujian->guru->mapel->nama_mapel ?? '-' }}</td>
                            <td>{{ $ujian->guru->user->name ?? '-' }}</td>

                            <td class="bold">{{ strtoupper($ujian->jenis_ujian) }}</td>
                            <td class="center">{{ $ujian->durasi_menit }} Menit</td>

                            <td>
                                <small>Mulai: {{ Carbon\Carbon::parse($ujian->tanggal_mulai)->format('d M Y, H:i') }}</small><br>
                                <small>Selesai: {{ Carbon\Carbon::parse($ujian->tanggal_selesai)->format('d M Y, H:i') }}</small>
                            </td>

                            {{-- STATUS UJIAN --}}
                            <td class="center">
                                <span class="badge badge-{{ $ujian->status_real }}">
                                    {{ ucfirst($ujian->status_real) }}
                                </span>
                            </td>

                            {{-- STATUS SISWA --}}
                            <td class="center">
                                <span class="badge badge-s-{{ $ujian->status_siswa }}">
                                    {{ str_replace('_', ' ', ucwords($ujian->status_siswa, '_')) }}
                                </span>
                            </td>

                            {{-- PAKET --}}
                            <td class="center">
                                {!! $ujian->paket_siswa ? "<span class='badge badge-neutral'>{$ujian->paket_siswa}</span>" : "<span class='text-muted'>-</span>" !!}
                            </td>

                            {{-- AKSI --}}
                            <td class="center">
                                @if($ujian->status_real === 'aktif')
                                    @if($ujian->status_siswa === 'belum_mulai')
                                        <form action="{{ route('ujian_siswa.mulai', $ujian->id) }}" method="POST" onsubmit="return confirm('Mulai ujian?')">
                                            @csrf
                                            <button class="btn green"><i class="fa-solid fa-play"></i> Mulai</button>
                                        </form>

                                    @elseif($ujian->status_siswa === 'sedang_dikerjakan')
                                        <a href="{{ route('ujian_siswa.kerjakan', $ujian->ujian_siswa_id) }}" class="btn yellow">
                                            <i class="fa-solid fa-arrow-right"></i> Lanjutkan
                                        </a>

                                    @elseif($ujian->status_siswa === 'selesai')
                                        <a href="{{ route('ujian_siswa.hasil', $ujian->ujian_siswa_id) }}" class="btn blue">
                                            <i class="fa-solid fa-eye"></i> Hasil
                                        </a>
                                    @endif

                                @elseif($ujian->status_real === 'selesai')
                                    <span class="text-muted"><i class="fa-solid fa-check"></i> Selesai</span>

                                @else
                                    <span class="text-muted">Tidak Tersedia</span>
                                @endif
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="10" class="empty-msg">
                                <i class="fa-solid fa-inbox"></i> Tidak ada ujian tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>


<style>
    .exam-wrapper{
        width: 100%;
        max-width: 1600px;
        margin: 25px auto;
        padding: 25px;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 5px 20px rgb(0 0 0 / 8%);
    }

    .alert{
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 12px;
        font-size: 14px;
    }
    .alert-success{ background:#dcfce7;border-left:6px solid #16a34a;color:#075e2b; }
    .alert-error{ background:#fee2e2;border-left:6px solid #dc2626;color:#991b1b; }
    .alert-info{ background:#e0f2fe;border-left:6px solid #0ea5e9;color:#075985; }

    .student-box{
        background:#fff0f0;
        padding:18px;
        border-radius:12px;
        margin-bottom:20px;
        border:1px solid #fecaca;
    }
    .class-box{color:#475569;font-size:15px;}

    .table-container{
        overflow-x:auto;
        border-radius:14px;
        border:1px solid #f4d3d3;
    }

    .styled-table{
        width:100%;
        border-collapse:collapse;
    }
    thead{
        background:#b91c1c;
        color:white;
        font-size:13px;
    }
    
    td,th{
        padding:14px;
        border:1px solid #f2cccc;
        font-size:14px;
    }

    tbody tr:hover{
        background:#fff7f7;
    }

    .center{text-align:center;}
    .bold{font-weight:600;}

    .badge{
        padding:6px 12px;
        border-radius:20px;
        font-size:11px;
        font-weight:600;
        display:inline-block;
    }

    /* Status Ujian */
    .badge-aktif{background:#dcfce7;color:#166534;}
    .badge-draft{background:#e5e7eb;color:#374151;}
    .badge-selesai{background:#eef2ff;color:#312e81;}
    .badge-nonaktif{background:#fee2e2;color:#b91c1c;}

    /* Status Siswa */
    .badge-s-belum_mulai{background:#dbeafe;color:#1d4ed8;}
    .badge-s-sedang_dikerjakan{background:#fef3c7;color:#b45309;}
    .badge-s-selesai{background:#bbf7d0;color:#065f46;}

    .badge-neutral{
        background:#f1f5f9;
        border:1px solid #cbd5e1;
        color:#334155;
    }

    .btn{
        padding:6px 12px;
        border-radius:8px;
        font-size:13px;
        border:none;
        cursor:pointer;
    }
    .green{background:#dcfce7;color:#166534;}
    .yellow{background:#fef9c3;color:#92400e;}
    .blue{background:#dbeafe;color:#1e40af;}

    .empty-msg{
        text-align:center;
        padding:25px;
        color:#a0aec0;
        font-style:italic;
    }
</style>

</x-app-layout>
