<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use App\Models\ExtraPeserta;
use App\Models\PresensiEkstra;
use App\Models\Perizinan;
use App\Models\Siswa;

class PresensiEkstraController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar ekstrakurikuler sesuai role user.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('superadmin') || $user->hasRole('walikelas')) {
            // Superadmin dan walikelas bisa lihat semua ekstra
            $ekstras = Ekstrakurikuler::with('pembina')->orderBy('nama_extra')->get();
        } 
        elseif ($user->hasRole('pembina')) {
            // Pembina hanya lihat ekstra yang dia ampu
            $ekstras = Ekstrakurikuler::with('pembina')
                ->whereHas('pembina', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->orderBy('nama_extra')
                ->get();
        }
        elseif ($user->hasRole('siswa')) {
            // Siswa lihat ekstra yang dia ikuti
            $siswa = Siswa::where('user_id', $user->id)->first();
            if (!$siswa) {
                abort(403, 'Data siswa tidak ditemukan');
            }
            
            $ekstras = Ekstrakurikuler::with('pembina')
                ->whereHas('peserta', function($q) use ($siswa) {
                    $q->where('siswa_id', $siswa->id);
                })
                ->orderBy('nama_extra')
                ->get();
        }
        elseif ($user->hasRole('orangtua')) {
            // Orangtua lihat ekstra yang diikuti anaknya
            $siswa = Siswa::where('orangtua_id', $user->id)->first();
            if (!$siswa) {
                abort(403, 'Data siswa tidak ditemukan');
            }
            
            $ekstras = Ekstrakurikuler::with('pembina')
                ->whereHas('peserta', function($q) use ($siswa) {
                    $q->where('siswa_id', $siswa->id);
                })
                ->orderBy('nama_extra')
                ->get();
        }
        else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini');
        }

        return view('presensi_ekstra.index', compact('ekstras'));
    }

    private function dayNameToCarbon($day)
    {
        return [
            'senin' => 1,
            'selasa' => 2,
            'rabu' => 3,
            'kamis' => 4,
            'jumat' => 5,
            'sabtu' => 6,
            'minggu' => 0
        ][strtolower($day)] ?? null;
    }

    /**
     * Show the form for creating attendance.
     * Hanya untuk superadmin, walikelas, dan pembina yang mengampu ekstra tersebut.
     */
    public function create(Request $request)
    {
        Carbon::setLocale('id');
        
        $user = auth()->user();
        
        if (!$user->hasAnyRole(['superadmin', 'walikelas', 'pembina'])) {
            abort(403, 'Anda tidak memiliki akses untuk membuat presensi');
        }

        $ekstra = Ekstrakurikuler::with('pembina.user')
            ->findOrFail($request->ekstrakurikuler_id);
        
        // Validasi pembina hanya bisa absensi ekstra yang dia ampu
        if ($user->hasRole('pembina')) {
            $isPembina = $ekstra->pembina->where('user_id', $user->id)->isNotEmpty();
            if (!$isPembina) {
                abort(403, 'Anda tidak memiliki akses untuk membuat presensi ekstrakurikuler ini');
            }
        }
        
        // Extract hari dari jadwal
        $jadwalParts = explode(',', $ekstra->jadwal ?? '');
        $hariEkstra = trim($jadwalParts[0] ?? '');
        $dayCode = $this->dayNameToCarbon($hariEkstra);

        // Tentukan tanggal presensi
        $last = PresensiEkstra::whereHas('extraPeserta', function ($q) use ($ekstra) {
            $q->where('ekstrakurikuler_id', $ekstra->id);
        })
        ->latest('tanggal')
        ->first();

        if ($request->tanggal) {
            $tanggal = $request->tanggal;
        } elseif ($last) {
            $tanggal = Carbon::parse($last->tanggal)->addWeek()->format('Y-m-d');
        } else {
            if ($dayCode !== null) {
                $today = Carbon::today();
                $diff = $dayCode - $today->dayOfWeek;
                if ($diff < 0) $diff += 7;
                $tanggal = $today->copy()->addDays($diff)->format('Y-m-d');
            } else {
                $tanggal = Carbon::today()->format('Y-m-d');
            }
        }

        // Ambil peserta ekstrakurikuler
        $pesertas = ExtraPeserta::with(['siswa.user'])
            ->where('ekstrakurikuler_id', $ekstra->id)
            ->get();

        // Cek perizinan untuk setiap peserta
        foreach ($pesertas as $p) {
            $izin = Perizinan::where('user_id', $p->siswa->user_id)
                ->whereDate('tanggal_mulai', '<=', $tanggal)
                ->whereDate('tanggal_selesai', '>=', $tanggal)
                ->first();

            if ($izin) {
                if ($izin->validasi === 'disetujui') {
                    $p->status_default = $izin->status;
                } elseif ($izin->validasi === 'ditolak') {
                    $p->status_default = 'alpa';
                } else {
                    $p->status_default = 'alpa';
                }
            } else {
                $p->status_default = 'hadir';
            }

            $p->izin_info = $izin;
        }

        return view('presensi_ekstra.create', compact(
            'ekstra',
            'pesertas',
            'tanggal'
        ));
    }

    /**
     * Store attendance data.
     * Hanya untuk superadmin, walikelas, dan pembina yang mengampu.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'ekstrakurikuler_id' => 'required',
            'tanggal' => 'required|date',
            'status.*' => 'required|in:hadir,izin,sakit,alpa',
        ]);

        $ekstra = Ekstrakurikuler::findOrFail($request->ekstrakurikuler_id);
        
        // Validasi pembina hanya bisa absensi ekstra yang dia ampu
        if ($user->hasRole('pembina')) {
            $isPembina = $ekstra->pembina->where('user_id', $user->id)->isNotEmpty();
            if (!$isPembina) {
                abort(403, 'Anda tidak memiliki akses untuk menyimpan presensi ekstrakurikuler ini');
            }
        }

        $tanggal = $request->tanggal;

        foreach ($request->status as $extraPesertaId => $statusInput) {
            $peserta = ExtraPeserta::with('siswa')->findOrFail($extraPesertaId);

            $izin = Perizinan::where('user_id', $peserta->siswa->user_id)
                ->whereDate('tanggal_mulai', '<=', $tanggal)
                ->whereDate('tanggal_selesai', '>=', $tanggal)
                ->first();

            if ($izin) {
                if ($izin->validasi === 'disetujui') {
                    $status = $izin->status;
                } else {
                    $status = 'alpa';
                }
            } else {
                $status = $statusInput;
            }

            PresensiEkstra::updateOrCreate(
                [
                    'extra_peserta_id' => $extraPesertaId,
                    'tanggal' => $tanggal,
                ],
                [
                    'status' => $status,
                    'perizinan_id' => $izin->id ?? null,
                ]
            );
        }

        return redirect()
            ->route('presensi_ekstra.show', $request->ekstrakurikuler_id)
            ->with('success', 'Presensi ekstrakurikuler berhasil disimpan!');
    }

    /**
     * Display attendance dates for one ekstrakurikuler.
     * Semua role bisa akses, tapi dengan filter sesuai hak akses.
     */
    public function show($ekstrakurikuler_id)
    {
        $user = auth()->user();
        $ekstra = Ekstrakurikuler::findOrFail($ekstrakurikuler_id);

        // Validasi akses berdasarkan role
        if ($user->hasRole('pembina')) {
            $isPembina = $ekstra->pembina->where('user_id', $user->id)->isNotEmpty();
            if (!$isPembina) {
                abort(403, 'Anda tidak memiliki akses ke ekstrakurikuler ini');
            }
        } 
        elseif ($user->hasRole('siswa')) {
            $siswa = Siswa::where('user_id', $user->id)->first();
            $isPeserta = ExtraPeserta::where('siswa_id', $siswa->id)
                ->where('ekstrakurikuler_id', $ekstra->id)
                ->exists();
            if (!$isPeserta) {
                abort(403, 'Anda tidak terdaftar dalam ekstrakurikuler ini');
            }
        }
        elseif ($user->hasRole('orangtua')) {
            $siswa = Siswa::where('orangtua_id', $user->id)->first();
            $isPeserta = ExtraPeserta::where('siswa_id', $siswa->id)
                ->where('ekstrakurikuler_id', $ekstra->id)
                ->exists();
            if (!$isPeserta) {
                abort(403, 'Anak Anda tidak terdaftar dalam ekstrakurikuler ini');
            }
        }

        $tanggalList = PresensiEkstra::whereHas('extraPeserta', function ($q) use ($ekstra) {
            $q->where('ekstrakurikuler_id', $ekstra->id);
        })
        ->distinct()
        ->orderBy('tanggal', 'desc')
        ->pluck('tanggal');

        return view('presensi_ekstra.show', compact('ekstra', 'tanggalList'));
    }

    /**
     * Show attendance detail by date.
     * Siswa dan orangtua hanya lihat presensi siswa terkait.
     */
    public function detail(Request $request, $ekstrakurikuler_id)
    {
        $user = auth()->user();
        $tanggal = $request->tanggal;
        
        if (!$tanggal) {
            return redirect()
                ->route('presensi_ekstra.show', $ekstrakurikuler_id)
                ->with('error', 'Silakan pilih tanggal presensi yang ingin dilihat detailnya.');
        }

        $ekstra = Ekstrakurikuler::findOrFail($ekstrakurikuler_id);

        // Validasi akses pembina
        if ($user->hasRole('pembina')) {
            $isPembina = $ekstra->pembina->where('user_id', $user->id)->isNotEmpty();
            if (!$isPembina) {
                abort(403, 'Anda tidak memiliki akses ke ekstrakurikuler ini');
            }
        }

        // Ambil peserta berdasarkan role
        if ($user->hasRole('siswa')) {
            // Siswa hanya lihat presensi dirinya sendiri
            $siswa = Siswa::where('user_id', $user->id)->first();
            $pesertas = ExtraPeserta::with(['siswa.user'])
                ->where('ekstrakurikuler_id', $ekstra->id)
                ->where('siswa_id', $siswa->id)
                ->get();
        } 
        elseif ($user->hasRole('orangtua')) {
            // Orangtua hanya lihat presensi anaknya
            $siswa = Siswa::where('orangtua_id', $user->id)->first();
            $pesertas = ExtraPeserta::with(['siswa.user'])
                ->where('ekstrakurikuler_id', $ekstra->id)
                ->where('siswa_id', $siswa->id)
                ->get();
        } 
        else {
            // Superadmin, walikelas, pembina lihat semua peserta
            $pesertas = ExtraPeserta::with(['siswa.user'])
                ->where('ekstrakurikuler_id', $ekstra->id)
                ->get();
        }

        if ($pesertas->isEmpty()) {
            return redirect()
                ->route('presensi_ekstra.show', $ekstrakurikuler_id)
                ->with('error', "Tidak ada data presensi yang dapat ditampilkan.");
        }

        // Ambil presensi yang sudah ada
        $existingPresensis = PresensiEkstra::with(['perizinan', 'extraPeserta.siswa.user'])
            ->whereDate('tanggal', $tanggal)
            ->whereHas('extraPeserta', function ($q) use ($ekstra) {
                $q->where('ekstrakurikuler_id', $ekstra->id);
            })
            ->get()
            ->keyBy('extra_peserta_id');

        // Siapkan data presensi
        $presensis = collect();
        foreach ($pesertas as $peserta) {
            $presensiRecord = $existingPresensis->get($peserta->id);

            if ($presensiRecord) {
                $presensis->push($presensiRecord);
            } else {
                $izin = Perizinan::where('user_id', $peserta->siswa->user_id)
                    ->whereDate('tanggal_mulai', '<=', $tanggal)
                    ->whereDate('tanggal_selesai', '>=', $tanggal)
                    ->first();

                $status = 'hadir';
                if ($izin) {
                    if ($izin->validasi === 'disetujui') {
                        $status = $izin->status;
                    } else {
                        $status = 'alpa';
                    }
                }

                $tempPresensi = new \stdClass();
                $tempPresensi->id = null;
                $tempPresensi->extra_peserta_id = $peserta->id;
                $tempPresensi->tanggal = $tanggal;
                $tempPresensi->status = $status;
                $tempPresensi->perizinan = $izin;
                $tempPresensi->extraPeserta = $peserta;

                $presensis->push($tempPresensi);
            }
        }

        return view('presensi_ekstra.detail', compact(
            'ekstra',
            'presensis',
            'tanggal'
        ));
    }

    /**
     * Update attendance data.
     * Hanya untuk superadmin, walikelas, dan pembina yang mengampu.
     */
    public function update(Request $request, $ekstrakurikuler_id)
    {
        $user = auth()->user();
        
        if (!$user->hasAnyRole(['superadmin', 'walikelas', 'pembina'])) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah presensi');
        }

        $ekstra = Ekstrakurikuler::findOrFail($ekstrakurikuler_id);
        
        // Validasi pembina
        if ($user->hasRole('pembina')) {
            $isPembina = $ekstra->pembina->where('user_id', $user->id)->isNotEmpty();
            if (!$isPembina) {
                abort(403, 'Anda tidak memiliki akses untuk mengubah presensi ekstrakurikuler ini');
            }
        }

        $request->validate([
            'tanggal' => 'required|date',
            'status.*' => 'required|in:hadir,izin,sakit,alpa',
        ]);

        $tanggal = $request->tanggal;

        foreach ($request->status as $extraPesertaId => $status) {
            PresensiEkstra::updateOrCreate(
                [
                    'extra_peserta_id' => $extraPesertaId,
                    'tanggal' => $tanggal,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect()
            ->route('presensi_ekstra.detail', [
                'ekstrakurikuler_id' => $ekstrakurikuler_id,
                'tanggal' => $tanggal
            ])
            ->with('success', 'Presensi ekstrakurikuler berhasil diperbarui');
    }

    public function destroy($id)
    {
        abort(404);
    }
}