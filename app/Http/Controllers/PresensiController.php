<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Presensi;
use App\Models\Jadwal;
use App\Models\Perizinan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasAnyRole(['superadmin', 'tus'])) {
            $jadwals = Jadwal::with(['mapel','kelas.jurusan', 'guru.user'])
                ->orderBy('hari')
                ->orderBy('jam_mulai')
                ->get();
        } elseif ($user->hasRole('guru')) {
            if (!$user->guru) abort(403, 'Akun ini tidak terhubung dengan data guru.');

            $jadwals = Jadwal::with(['mapel','kelas.jurusan', 'guru.user'])
                ->where('guru_id', $user->guru->id)
                ->orderBy('hari')
                ->orderBy('jam_mulai')
                ->get();
        } elseif ($user->hasRole('siswa')) {
            if (!$user->siswa) abort(403, 'Akun ini tidak terhubung dengan data siswa.');

            $jadwals = Jadwal::with(['mapel','kelas.jurusan', 'guru.user'])
                ->where('kelas_id', $user->siswa->kelas_id)
                ->orderBy('hari')
                ->orderBy('jam_mulai')
                ->get();
        } elseif ($user->hasRole('orangtua')) {
            if (!$user->orangtua || !$user->orangtua->siswa)
                abort(403, 'Akun ortu tidak terhubung dengan siswa.');

            $jadwals = Jadwal::with(['mapel','kelas.jurusan', 'guru.user'])
                ->where('kelas_id', $user->orangtua->siswa->kelas_id)
                ->orderBy('hari')
                ->orderBy('jam_mulai')
                ->get();
        } else {
            abort(403);
        }

        return view('presensi.list', compact('jadwals'));
    }

    private function dayNameToCarbon($day)
    {
        return [
            'senin' => 1, 'selasa' => 2, 'rabu' => 3,
            'kamis' => 4, 'jumat' => 5, 'sabtu' => 6,
            'minggu' => 0
        ][strtolower($day)] ?? null;
    }

    public function create(Request $request)
    {
        Carbon::setLocale('id');

        $jadwal = Jadwal::with(['mapel','kelas','guru.user'])
            ->findOrFail($request->jadwal_id);

        $dayCode = $this->dayNameToCarbon($jadwal->hari);

        // Tentukan tanggal
        $last = Presensi::where('jadwal_id', $jadwal->id)->latest('tanggal')->first();
        if ($request->tanggal)
            $tanggal = $request->tanggal;
        elseif ($last)
            $tanggal = Carbon::parse($last->tanggal)->addWeek()->format('Y-m-d');
        else {
            $today = Carbon::today();
            $diff = $dayCode - $today->dayOfWeek;
            if ($diff < 0) $diff += 7;
            $tanggal = $today->copy()->addDays($diff)->format('Y-m-d');
        }

        // Cek izin guru
        $guruIzin = null;
        if ($jadwal->guru) {
            $guruIzin = Perizinan::where('user_id', $jadwal->guru->user_id)
                ->whereDate('tanggal_mulai', '<=', $tanggal)
                ->whereDate('tanggal_selesai', '>=', $tanggal)
                ->first();
        }

        // Data siswa
        $siswas = Siswa::with('user')->where('kelas_id', $jadwal->kelas_id)->get();

        foreach ($siswas as $s) {
            $izin = Perizinan::where('user_id', $s->user_id)
                ->whereDate('tanggal_mulai', '<=', $tanggal)
                ->whereDate('tanggal_selesai', '>=', $tanggal)
                ->first();

            if ($izin) {
                if ($izin->validasi === 'disetujui') {
                    $s->status_default = $izin->status;   // izin/sakit
                } elseif ($izin->validasi === 'ditolak') {
                    $s->status_default = 'alpa';
                }
            } else {
                $s->status_default = 'hadir';
            }

            $s->izin_info = $izin;
        }

        return view('presensi.create', compact('jadwal','tanggal','siswas','guruIzin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required',
            'tanggal'   => 'required|date',
            'status_guru' => 'required|in:hadir,izin,sakit,alpa',
            'status_siswa.*' => 'in:hadir,izin,sakit,alpa'
        ]);

        $jadwal = Jadwal::with('guru')->findOrFail($request->jadwal_id);
        $tanggal = $request->tanggal;

        // === GURU ===
        if ($jadwal->guru) {
            $izinGuru = Perizinan::where('user_id', $jadwal->guru->user_id)
                ->whereDate('tanggal_mulai','<=',$tanggal)
                ->whereDate('tanggal_selesai','>=',$tanggal)
                ->first();

            // Status guru berdasarkan izin
            if ($izinGuru) {
                if ($izinGuru->validasi === 'disetujui')
                    $statusGuru = $izinGuru->status;
                elseif ($izinGuru->validasi === 'ditolak')
                    $statusGuru = 'alpa';
            } else {
                $statusGuru = $request->status_guru;
            }

            Presensi::updateOrCreate(
                ['user_id' => $jadwal->guru->user_id, 'jadwal_id' => $jadwal->id, 'tanggal' => $tanggal],
                ['status' => $statusGuru, 'perizinan_id' => $izinGuru->id ?? null]
            );
        }

        // === SISWA ===
        foreach ($request->status_siswa ?? [] as $user_id => $statusInput) {

            $izinSiswa = Perizinan::where('user_id', $user_id)
                ->whereDate('tanggal_mulai','<=',$tanggal)
                ->whereDate('tanggal_selesai','>=',$tanggal)
                ->first();

            if ($izinSiswa) {
                if ($izinSiswa->validasi === 'disetujui')
                    $status = $izinSiswa->status;
                elseif ($izinSiswa->validasi === 'ditolak')
                    $status = 'alpa';
            } else {
                $status = $statusInput;
            }

            Presensi::updateOrCreate(
                ['user_id'=>$user_id,'jadwal_id'=>$jadwal->id,'tanggal'=>$tanggal],
                ['status'=>$status,'perizinan_id'=>$izinSiswa->id ?? null]
            );
        }

        // Tentukan tanggal minggu depan
        $dayCode = $this->dayNameToCarbon($jadwal->hari);
        $diff = $dayCode - Carbon::parse($tanggal)->dayOfWeek;
        if ($diff <= 0) $diff += 7;

        return redirect()->route('presensi.show', [
            'jadwal_id'=>$jadwal->id,
            'tanggal'=>Carbon::parse($tanggal)->addDays($diff)->format('Y-m-d')
        ])->with('success','Presensi berhasil disimpan!');
    }

    public function show($jadwal_id)
    {
        $jadwal = Jadwal::with(['mapel','kelas','guru.user'])->findOrFail($jadwal_id);
        $tanggalList = Presensi::where('jadwal_id',$jadwal_id)->distinct()->orderBy('tanggal','desc')->pluck('tanggal');

        return view('presensi.show', compact('jadwal','tanggalList'));
    }

    public function detail(Request $request, $jadwal_id)
    {
        $tanggal = $request->tanggal;
        if (!$tanggal) return back()->with('error','Tanggal tidak ditemukan.');

        $user = auth()->user();
        $jadwal = Jadwal::with(['mapel','kelas','guru.user'])->findOrFail($jadwal_id);

        $guruId = optional($jadwal->guru)->user_id;
        $siswaIds = Siswa::where('kelas_id',$jadwal->kelas_id)->pluck('user_id')->toArray();

        if ($user->hasRole(['superadmin','tus','guru'])) {
            $allowed = array_values(array_filter(array_merge([$guruId], $siswaIds)));
        } elseif ($user->hasRole('siswa')) {
            $allowed = [$user->id];
        } elseif ($user->hasRole('orangtua')) {
            $anak = $user->orangtua->siswa;
            $allowed = [$anak->user_id];
        } else abort(403);

        $presensis = Presensi::with(['user','perizinan'])
            ->where('jadwal_id',$jadwal_id)
            ->whereDate('tanggal',$tanggal)
            ->whereIn('user_id',$allowed)
            ->get()
            ->keyBy('user_id');

        return view('presensi.detail', compact('jadwal','presensis','tanggal'));
    }

    public function edit(Request $request, $jadwal_id)
    {
        $tanggal = $request->tanggal;
        if (!$tanggal) return back()->with('error','Tanggal tidak ditemukan.');

        $jadwal = Jadwal::with(['mapel','kelas','guru.user'])->findOrFail($jadwal_id);

        $siswas = Siswa::with('user')->where('kelas_id',$jadwal->kelas_id)->get();
        $presensis = Presensi::where('jadwal_id',$jadwal_id)->whereDate('tanggal',$tanggal)->get()->keyBy('user_id');

        foreach ($siswas as $s) {
            $izin = Perizinan::where('user_id',$s->user_id)
                ->whereDate('tanggal_mulai','<=',$tanggal)
                ->whereDate('tanggal_selesai','>=',$tanggal)
                ->first();

            if ($izin) {
                if ($izin->validasi === 'disetujui')
                    $s->izin_status = $izin->status;
                elseif ($izin->validasi === 'ditolak')
                    $s->izin_status = 'alpa';
            } else {
                $s->izin_status = null;
            }
        }

        return view('presensi.edit', compact('jadwal','presensis','tanggal','siswas'));
    }

    public function update(Request $request, $jadwal_id)
    {
        $request->validate([
            'tanggal' => 'required',
            'status_guru' => 'required|in:hadir,izin,sakit,alpa',
            'status_siswa.*' => 'required|in:hadir,izin,sakit,alpa',
        ]);

        $jadwal = Jadwal::with('guru')->findOrFail($jadwal_id);
        $tanggal = $request->tanggal;

        // === GURU ===
        if ($jadwal->guru) {
            $izinGuru = Perizinan::where('user_id',$jadwal->guru->user_id)
                ->whereDate('tanggal_mulai','<=',$tanggal)
                ->whereDate('tanggal_selesai','>=',$tanggal)
                ->first();

            if ($izinGuru) {
                if ($izinGuru->validasi === 'disetujui')
                    $statusGuru = $izinGuru->status;
                elseif ($izinGuru->validasi === 'ditolak')
                    $statusGuru = 'alpa';
            } else {
                $statusGuru = $request->status_guru;
            }

            Presensi::updateOrCreate(
                ['user_id'=>$jadwal->guru->user_id,'jadwal_id'=>$jadwal_id,'tanggal'=>$tanggal],
                ['status'=>$statusGuru,'perizinan_id'=>$izinGuru->id ?? null]
            );
        }

        // === SISWA ===
        foreach ($request->status_siswa ?? [] as $user_id => $statusInput) {

            $izinSiswa = Perizinan::where('user_id',$user_id)
                ->whereDate('tanggal_mulai','<=',$tanggal)
                ->whereDate('tanggal_selesai','>=',$tanggal)
                ->first();

            if ($izinSiswa) {
                if ($izinSiswa->validasi === 'disetujui')
                    $status = $izinSiswa->status;
                elseif ($izinSiswa->validasi === 'ditolak')
                    $status = 'alpa';
            } else {
                $status = $statusInput;
            }

            Presensi::updateOrCreate(
                ['user_id'=>$user_id,'jadwal_id'=>$jadwal_id,'tanggal'=>$tanggal],
                ['status'=>$status,'perizinan_id'=>$izinSiswa->id ?? null]
            );
        }

        return redirect()->route('presensi.detail', ['jadwal'=>$jadwal_id,'tanggal'=>$tanggal])
            ->with('success','Presensi berhasil diperbarui!');
    }
 public function rekap(Request $request)
{
    $user = auth()->user();
    $start = $request->tanggal_mulai;
    $end   = $request->tanggal_selesai;

    // === SUPERADMIN / TUS ===
    if ($user->hasAnyRole(['superadmin', 'tus'])) {
        // Ambil daftar mapel dan kelas untuk dropdown (ini selalu dibutuhkan)
        $mapelList = \App\Models\Mapel::orderBy('nama_mapel')->get();
        $kelasList = \App\Models\Kelas::with('jurusan')->orderBy('nama_kelas')->get();

        // Cek apakah ini adalah request filter (ada parameter yang dikirim)
        if ($request->hasAny(['kelas_id', 'mapel_id', 'tanggal_mulai', 'tanggal_selesai'])) {
            // Jika iya, jalankan validasi
            $request->validate([
                'kelas_id' => 'required',
                'mapel_id' => 'required',
                'tanggal_mulai' => 'nullable|date',
                'tanggal_selesai' => 'nullable|date'
            ]);

            $kelas_id = $request->kelas_id;
            $mapel_id = $request->mapel_id;

            $presensiQuery = Presensi::with(['user','jadwal.mapel','jadwal.kelas']);

            // Filter berdasarkan kelas (selalu ada)
            $presensiQuery->whereHas('jadwal', function ($q) use ($kelas_id) {
                $q->where('kelas_id', $kelas_id);
            });

            // Filter berdasarkan mapel (selalu ada)
            $presensiQuery->whereHas('jadwal', function ($q) use ($mapel_id) {
                $q->where('mapel_id', $mapel_id);
            });

            if ($start)
                $presensiQuery->whereDate('tanggal', '>=', $start);

            if ($end)
                $presensiQuery->whereDate('tanggal', '<=', $end);

            $presensis = $presensiQuery->get();

            // Pisahkan rekap guru dan siswa
            $rekapGuru = [];
            $rekapSiswa = [];
            
            foreach ($presensis as $p) {
                $jadwal = $p->jadwal;
                
                // Skip jika jadwal atau mapel tidak ada
                if (!$jadwal || !$jadwal->mapel) continue;
                
                $userRole = $p->user->roles->first()?->name;

                // Data rekap
                $data = [
                    'nama'  => $p->user->name,
                    'kelas' => $jadwal->kelas->nama_kelas ?? '-',
                    'mapel' => $jadwal->mapel->nama_mapel,
                    'hadir' => 0,
                    'izin'  => 0,
                    'sakit' => 0,
                    'alpa'  => 0,
                ];

                $status = strtolower($p->status);

                // Pisahkan berdasarkan role
                if ($userRole === 'guru') {
                    $rekapGuru[$p->user_id] ??= $data;
                    if (isset($rekapGuru[$p->user_id][$status])) {
                        $rekapGuru[$p->user_id][$status]++;
                    }
                } else {
                    $rekapSiswa[$p->user_id] ??= $data;
                    if (isset($rekapSiswa[$p->user_id][$status])) {
                        $rekapSiswa[$p->user_id][$status]++;
                    }
                }
            }

            // Return view dengan data yang sudah difilter
            return view('presensi.rekap', compact(
                'mapelList','kelasList','rekapGuru','rekapSiswa','kelas_id','mapel_id','start','end'
            ));
        }

        // --- PERBAIKAN DIMULAI DI SINI ---
        // Jika bukan request filter, tampilkan form dengan data kosong
        return view('presensi.rekap', [
            'mapelList' => $mapelList,
            'kelasList' => $kelasList,
            'rekapGuru' => [], // Data kosong
            'rekapSiswa' => [], // Data kosong
            'kelas_id' => '',
            'mapel_id' => '',
            'start' => '',
            'end' => ''
        ]);
        // --- PERBAIKAN SELESAI DI SINI ---
    }

    // === GURU ===
    elseif ($user->hasRole('guru')) {
        if (!$user->guru) abort(403, 'Akun ini tidak terhubung dengan data guru.');

        // Ambil mapel yang diajar oleh guru ini (hanya satu)
        $mapelGuru = Jadwal::with('mapel')
            ->where('guru_id', $user->guru->id)
            ->distinct('mapel_id')
            ->first()
            ->mapel;
            
        // Ambil semua kelas untuk mapel yang diajar guru ini
        $kelasList = Jadwal::with('kelas')
            ->where('guru_id', $user->guru->id)
            ->distinct('kelas_id')
            ->get()
            ->pluck('kelas');

        // Cek apakah ini adalah request filter
        if ($request->hasAny(['kelas_id', 'tanggal_mulai', 'tanggal_selesai'])) {
            // Jika iya, jalankan validasi
            $request->validate([
                'kelas_id' => 'required',
                'tanggal_mulai' => 'nullable|date',
                'tanggal_selesai' => 'nullable|date'
            ]);

            $kelas_id = $request->kelas_id;

            $presensiQuery = Presensi::with(['user','jadwal.mapel','jadwal.kelas'])
                ->whereHas('jadwal', function ($q) use ($user) {
                    $q->where('guru_id', $user->guru->id);
                });

            // Filter berdasarkan kelas (selalu ada)
            $presensiQuery->whereHas('jadwal', function ($q) use ($kelas_id) {
                $q->where('kelas_id', $kelas_id);
            });

            if ($start)
                $presensiQuery->whereDate('tanggal', '>=', $start);

            if ($end)
                $presensiQuery->whereDate('tanggal', '<=', $end);

            $presensis = $presensiQuery->get();

            // Pisahkan rekap guru dan siswa
            $rekapGuru = [];
            $rekapSiswa = [];
            
            foreach ($presensis as $p) {
                $jadwal = $p->jadwal;
                
                // Skip jika jadwal atau mapel tidak ada
                if (!$jadwal || !$jadwal->mapel) continue;
                
                $userRole = $p->user->roles->first()?->name;

                // Data rekap
                $data = [
                    'nama'  => $p->user->name,
                    'kelas' => $jadwal->kelas->nama_kelas ?? '-',
                    'mapel' => $jadwal->mapel->nama_mapel,
                    'hadir' => 0,
                    'izin'  => 0,
                    'sakit' => 0,
                    'alpa'  => 0,
                ];

                $status = strtolower($p->status);

                // Pisahkan berdasarkan role
                if ($userRole === 'guru') {
                    $rekapGuru[$p->user_id] ??= $data;
                    if (isset($rekapGuru[$p->user_id][$status])) {
                        $rekapGuru[$p->user_id][$status]++;
                    }
                } else {
                    $rekapSiswa[$p->user_id] ??= $data;
                    if (isset($rekapSiswa[$p->user_id][$status])) {
                        $rekapSiswa[$p->user_id][$status]++;
                    }
                }
            }

            // Return view dengan data yang sudah difilter
            return view('presensi.rekap', compact(
                'mapelGuru','kelasList','rekapGuru','rekapSiswa','kelas_id','start','end'
            ));
        }

        // --- PERBAIKAN DIMULAI DI SINI ---
        // Jika bukan request filter, tampilkan form dengan data kosong
        return view('presensi.rekap', [
            'mapelGuru' => $mapelGuru,
            'kelasList' => $kelasList,
            'rekapGuru' => [], // Data kosong
            'rekapSiswa' => [], // Data kosong
            'kelas_id' => '',
            'start' => '',
            'end' => ''
        ]);
        // --- PERBAIKAN SELESAI DI SINI ---
    }

    // === SISWA ===
    elseif ($user->hasRole('siswa')) {
        if (!$user->siswa) abort(403, 'Akun ini tidak terhubung dengan data siswa.');

        $presensiQuery = Presensi::with(['user','jadwal.mapel','jadwal.kelas'])
            ->where('user_id', $user->id);

        if ($start)
            $presensiQuery->whereDate('tanggal', '>=', $start);

        if ($end)
            $presensiQuery->whereDate('tanggal', '<=', $end);

        $presensis = $presensiQuery->get();

        // Rekap per mapel
        $rekapPerMapel = [];
        foreach ($presensis as $p) {
            $jadwal = $p->jadwal;
            
            // Skip jika jadwal atau mapel tidak ada
            if (!$jadwal || !$jadwal->mapel) continue;
            
            $mapel_id = $jadwal->mapel_id;
            $mapel_nama = $jadwal->mapel->nama_mapel;

            $rekapPerMapel[$mapel_id] ??= [
                'mapel' => $mapel_nama,
                'hadir' => 0,
                'izin'  => 0,
                'sakit' => 0,
                'alpa'  => 0,
            ];

            $status = strtolower($p->status);
            if (isset($rekapPerMapel[$mapel_id][$status])) {
                $rekapPerMapel[$mapel_id][$status]++;
            }
        }

        return view('presensi.rekap', compact(
            'rekapPerMapel','start','end'
        ));
    }

    // === ORANGTUA ===
    elseif ($user->hasRole('orangtua')) {
        if (!$user->orangtua || !$user->orangtua->siswa)
            abort(403, 'Akun ortu tidak terhubung dengan siswa.');

        $siswa = $user->orangtua->siswa;

        $presensiQuery = Presensi::with(['user','jadwal.mapel','jadwal.kelas'])
            ->where('user_id', $siswa->user_id);

        if ($start)
            $presensiQuery->whereDate('tanggal', '>=', $start);

        if ($end)
            $presensiQuery->whereDate('tanggal', '<=', $end);

        $presensis = $presensiQuery->get();

        // Rekap per mapel
        $rekapPerMapel = [];
        foreach ($presensis as $p) {
            $jadwal = $p->jadwal;
            
            // Skip jika jadwal atau mapel tidak ada
            if (!$jadwal || !$jadwal->mapel) continue;
            
            $mapel_id = $jadwal->mapel_id;
            $mapel_nama = $jadwal->mapel->nama_mapel;

            $rekapPerMapel[$mapel_id] ??= [
                'mapel' => $mapel_nama,
                'hadir' => 0,
                'izin'  => 0,
                'sakit' => 0,
                'alpa'  => 0,
            ];

            $status = strtolower($p->status);
            if (isset($rekapPerMapel[$mapel_id][$status])) {
                $rekapPerMapel[$mapel_id][$status]++;
            }
        }

        return view('presensi.rekap', compact(
            'rekapPerMapel','start','end','siswa'
        ));
    }

    else {
        abort(403);
    }
}
}
