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
    /* =========================================================
     | INDEX
     ========================================================= */
    public function index()
    {
        $user = auth()->user();

        if ($user->hasAnyRole(['superadmin', 'walikelas'])) {
            $ekstras = Ekstrakurikuler::with('pembina')->orderBy('nama_extra')->get();
        }
        elseif ($user->hasRole('pembina')) {
            $ekstras = Ekstrakurikuler::with('pembina')
                ->whereHas('pembina', fn ($q) => $q->where('user_id', $user->id))
                ->orderBy('nama_extra')
                ->get();
        }
        elseif ($user->hasRole('siswa')) {
            $siswa = Siswa::where('user_id', $user->id)->firstOrFail();

            $ekstras = Ekstrakurikuler::with('pembina')
                ->whereHas('peserta', fn ($q) => $q->where('siswa_id', $siswa->id))
                ->orderBy('nama_extra')
                ->get();
        }
        elseif ($user->hasRole('orangtua')) {
            $orangtua = $user->orangtua;
            if (!$orangtua || !$orangtua->siswa) abort(403);

            $siswa = $orangtua->siswa;

            $ekstras = Ekstrakurikuler::with('pembina')
                ->whereHas('peserta', fn ($q) => $q->where('siswa_id', $siswa->id))
                ->orderBy('nama_extra')
                ->get();
        }
        else {
            abort(403);
        }

        return view('presensi_ekstra.index', compact('ekstras'));
    }
private function getNextTanggalEkstra(Ekstrakurikuler $ekstra)
{
    // Ambil hari dari jadwal (contoh: "Senin, 15:00 - 17:00")
    $hari = strtolower(trim(explode(',', $ekstra->jadwal)[0] ?? ''));

    $mapHari = [
        'minggu' => Carbon::SUNDAY,
        'senin'  => Carbon::MONDAY,
        'selasa' => Carbon::TUESDAY,
        'rabu'   => Carbon::WEDNESDAY,
        'kamis'  => Carbon::THURSDAY,
        'jumat'  => Carbon::FRIDAY,
        'sabtu'  => Carbon::SATURDAY,
    ];

    if (!isset($mapHari[$hari])) {
        return Carbon::today()->format('Y-m-d');
    }

    // Ambil presensi terakhir
    $last = PresensiEkstra::whereHas('extraPeserta', function ($q) use ($ekstra) {
        $q->where('ekstrakurikuler_id', $ekstra->id);
    })
    ->latest('tanggal')
    ->first();

    // Kalau sudah pernah presensi → lompat 7 hari
    if ($last) {
        return Carbon::parse($last->tanggal)->addWeek()->format('Y-m-d');
    }

    // Kalau belum pernah → cari hari terdekat
    return Carbon::now()->next($mapHari[$hari])->format('Y-m-d');
}

    /* =========================================================
     | CREATE
     ========================================================= */
    public function create(Request $request)
    {
        Carbon::setLocale('id');
        $user = auth()->user();

        if (!$user->hasAnyRole(['superadmin', 'walikelas', 'pembina'])) {
            abort(403);
        }

        $ekstra = Ekstrakurikuler::with('pembina.user')
            ->findOrFail($request->ekstrakurikuler_id);

        if ($user->hasRole('pembina')) {
            if (!$ekstra->pembina || $ekstra->pembina->user_id !== $user->id) {
                abort(403);
            }
        }

      $tanggal = $request->tanggal
    ?? $this->getNextTanggalEkstra($ekstra);


        $pesertas = ExtraPeserta::with('siswa.user')
            ->where('ekstrakurikuler_id', $ekstra->id)
            ->get();

        foreach ($pesertas as $p) {
            $izin = Perizinan::where('user_id', $p->siswa->user_id)
                ->whereDate('tanggal_mulai', '<=', $tanggal)
                ->whereDate('tanggal_selesai', '>=', $tanggal)
                ->first();

            $p->status_default = $izin && $izin->validasi === 'disetujui'
                ? $izin->status
                : 'hadir';
        }

        return view('presensi_ekstra.create', compact('ekstra', 'pesertas', 'tanggal'));
    }

    /* =========================================================
     | STORE
     ========================================================= */
    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'ekstrakurikuler_id' => 'required',
            'tanggal' => 'required|date',
            'status.*' => 'required|in:hadir,izin,sakit,alpa',
        ]);

        $ekstra = Ekstrakurikuler::findOrFail($request->ekstrakurikuler_id);

        if ($user->hasRole('pembina')) {
            if (!$ekstra->pembina || $ekstra->pembina->user_id !== $user->id) {
                abort(403);
            }
        }

        foreach ($request->status as $extraPesertaId => $status) {
            PresensiEkstra::updateOrCreate(
                [
                    'extra_peserta_id' => $extraPesertaId,
                    'tanggal' => $request->tanggal,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect()
            ->route('presensi_ekstra.show', $ekstra->id)
            ->with('success', 'Presensi berhasil disimpan');
    }

    /* =========================================================
     | SHOW
     ========================================================= */
    public function show($id)
    {
        $user = auth()->user();
        $ekstra = Ekstrakurikuler::findOrFail($id);

        if ($user->hasRole('pembina')) {
            if (!$ekstra->pembina || $ekstra->pembina->user_id !== $user->id) {
                abort(403);
            }
        }

        $tanggalList = PresensiEkstra::whereHas('extraPeserta', fn ($q) =>
            $q->where('ekstrakurikuler_id', $ekstra->id)
        )
        ->distinct()
        ->orderByDesc('tanggal')
        ->pluck('tanggal');

        return view('presensi_ekstra.show', compact('ekstra', 'tanggalList'));
    }

    /* =========================================================
     | DETAIL
     ========================================================= */
    public function detail(Request $request, $ekstrakurikuler_id)
{
    $user = auth()->user();
    $tanggal = $request->tanggal;

    if (!$tanggal) {
        abort(404, 'Tanggal presensi tidak valid');
    }

    $ekstra = Ekstrakurikuler::with('pembina')->findOrFail($ekstrakurikuler_id);

    // Validasi pembina
    if ($user->hasRole('pembina')) {
        if (!$ekstra->pembina || $ekstra->pembina->user_id !== $user->id) {
            abort(403);
        }
    }

    /* =========================
     | Ambil peserta sesuai role
     ========================= */
    if ($user->hasRole('siswa')) {
        $siswa = Siswa::where('user_id', $user->id)->firstOrFail();

        $pesertas = ExtraPeserta::with('siswa.user')
            ->where('ekstrakurikuler_id', $ekstra->id)
            ->where('siswa_id', $siswa->id)
            ->get();
    }
    elseif ($user->hasRole('orangtua')) {
        $orangtua = $user->orangtua;
        if (!$orangtua || !$orangtua->siswa) abort(403);

        $pesertas = ExtraPeserta::with('siswa.user')
            ->where('ekstrakurikuler_id', $ekstra->id)
            ->where('siswa_id', $orangtua->siswa->id)
            ->get();
    }
    else {
        // superadmin, walikelas, pembina
        $pesertas = ExtraPeserta::with('siswa.user')
            ->where('ekstrakurikuler_id', $ekstra->id)
            ->get();
    }

    /* =========================
     | Ambil data presensi
     ========================= */
    $presensis = PresensiEkstra::with(['extraPeserta.siswa.user'])
        ->whereDate('tanggal', $tanggal)
        ->whereHas('extraPeserta', function ($q) use ($ekstra) {
            $q->where('ekstrakurikuler_id', $ekstra->id);
        })
        ->get()
        ->keyBy('extra_peserta_id');

    /* =========================
     | Sinkronkan presensi & peserta
     ========================= */
    $finalPresensis = collect();

    foreach ($pesertas as $peserta) {
        if ($presensis->has($peserta->id)) {
            $finalPresensis->push($presensis[$peserta->id]);
        } else {
            $temp = new \stdClass();
            $temp->id = null;
            $temp->created_at = now();
            $temp->extraPeserta = $peserta;
            $temp->status = 'hadir';
            $finalPresensis->push($temp);
        }
    }

    return view('presensi_ekstra.detail', [
        'ekstra'    => $ekstra,
        'tanggal'   => $tanggal,
        'presensis' => $finalPresensis,
    ]);
}
}