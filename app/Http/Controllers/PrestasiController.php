<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $user = Auth::user();
    $activeRole = session('active_role');

    // ===============================
    // WALI KELAS
    // ===============================
    if ($activeRole === 'walikelas') {
        $walikelas = $user->walikelas;

        if (!$walikelas) {
            return redirect()->back()->with('error', 'Anda belum ditugaskan sebagai wali kelas');
        }

        $prestasis = Prestasi::whereHas('siswa', function ($query) use ($walikelas) {
                $query->where('kelas_id', $walikelas->kelas_id);
            })
            ->with(['siswa.kelas'])
            ->latest()
            ->paginate(15);

        $siswas = Siswa::where('kelas_id', $walikelas->kelas_id)->get();
    }

    // ===============================
    // SISWA
    // ===============================
    elseif ($activeRole === 'siswa') {
        $siswa = $user->siswa;

        if (!$siswa) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan');
        }

        $prestasis = Prestasi::where('siswa_id', $siswa->id)
            ->latest()
            ->paginate(15);

        $siswas = collect([$siswa]);
    }

    // ===============================
    // ORANG TUA
    // ===============================
    elseif ($activeRole === 'orangtua') {
        $orangtua = $user->orangtua;

        if (!$orangtua || !$orangtua->siswa) {
            return redirect()->back()->with('error', 'Data anak tidak ditemukan');
        }

        $siswa = $orangtua->siswa;

        $prestasis = Prestasi::where('siswa_id', $siswa->id)
            ->latest()
            ->paginate(15);

        $siswas = collect([$siswa]);
    }

    // ===============================
    // ADMIN / SUPERADMIN
    // ===============================
    else {
        $prestasis = Prestasi::with(['siswa.kelas'])
            ->latest()
            ->paginate(15);

        $siswas = Siswa::all();
    }

    return view('prestasi.index', compact('prestasis', 'siswas'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $activeRole = session('active_role');
        
        if ($activeRole === 'walikelas') {
            $walikelas = $user->walikelas;
            
            if (!$walikelas) {
                return redirect()->back()->with('error', 'Anda belum ditugaskan sebagai wali kelas');
            }
            
            // Hanya siswa dari kelas yang diampu
            $siswas = Siswa::where('kelas_id', $walikelas->kelas_id)
                ->with('user')
                ->get()
                ->sortBy('user.name');
        }
        elseif ($activeRole === 'siswa') {
            // Siswa hanya bisa input untuk dirinya sendiri
            $siswas = collect([Auth::user()->siswa]);
        }
        else {
            // Superadmin/Admin bisa pilih semua siswa
            $siswas = Siswa::with('user')->get()->sortBy('user.name');
        }
        
        return view('prestasi.create', compact('siswas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $activeRole = session('active_role');
        
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'nama_prestasi' => 'required|string|max:255',
            'jenis' => 'required|in:akademik,non-akademik',
            'tingkat' => 'required|in:sekolah,kecamatan,kabupaten,provinsi,nasional,internasional',
            'peringkat' => 'nullable|string|max:50',
            'tanggal' => 'required|date',
            'file_bukti' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string',
        ], [
            'siswa_id.required' => 'Siswa harus dipilih',
            'siswa_id.exists' => 'Siswa tidak valid',
            'nama_prestasi.required' => 'Nama prestasi harus diisi',
            'jenis.required' => 'Jenis prestasi harus dipilih',
            'tingkat.required' => 'Tingkat prestasi harus dipilih',
            'tanggal.required' => 'Tanggal harus diisi',
            'file_bukti.mimes' => 'File bukti harus berformat PDF, JPG, JPEG, atau PNG',
            'file_bukti.max' => 'Ukuran file maksimal 2MB',
        ]);
        
        // Validasi akses untuk walikelas
        if ($activeRole === 'walikelas') {
            $walikelas = $user->walikelas;
            $siswa = Siswa::find($validated['siswa_id']);
            
            if ($siswa->kelas_id !== $walikelas->kelas_id) {
                return redirect()->back()
                    ->with('error', 'Anda hanya bisa menambahkan prestasi untuk siswa di kelas Anda')
                    ->withInput();
            }
        }
        
        // Validasi akses untuk siswa
        if ($activeRole === 'siswa') {
            if ($validated['siswa_id'] != $user->siswa->id) {
                return redirect()->back()
                    ->with('error', 'Anda hanya bisa menambahkan prestasi untuk diri sendiri')
                    ->withInput();
            }
        }
        
        // Upload file bukti jika ada
        if ($request->hasFile('file_bukti')) {
            $file = $request->file('file_bukti');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('prestasi', $filename, 'public');
            $validated['file_bukti'] = $path;
        }
        
        Prestasi::create($validated);
        
        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestasi $prestasi)
    {
        $user = Auth::user();
        $activeRole = session('active_role');
        
        // Validasi akses untuk walikelas
        if ($activeRole === 'walikelas') {
            $walikelas = $user->walikelas;
            
            if ($prestasi->siswa->kelas_id !== $walikelas->kelas_id) {
                abort(403, 'Anda tidak memiliki akses ke prestasi ini');
            }
        }
        
        // Validasi akses untuk siswa
        if ($activeRole === 'siswa') {
            if ($prestasi->siswa_id !== $user->siswa->id) {
                abort(403, 'Anda tidak memiliki akses ke prestasi ini');
            }
        }
        
        $prestasi->load(['siswa.kelas']);
        
        return view('prestasi.show', compact('prestasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestasi $prestasi)
    {
        $user = Auth::user();
        $activeRole = session('active_role');
        
        // Validasi akses untuk walikelas
        if ($activeRole === 'walikelas') {
            $walikelas = $user->walikelas;
            
            if ($prestasi->siswa->kelas_id !== $walikelas->kelas_id) {
                abort(403, 'Anda tidak memiliki akses untuk mengedit prestasi ini');
            }
            
            $siswas = Siswa::where('kelas_id', $walikelas->kelas_id)
                ->with('user')
                ->get()
                ->sortBy('user.name');
        }
        elseif ($activeRole === 'siswa') {
            if ($prestasi->siswa_id !== $user->siswa->id) {
                abort(403, 'Anda tidak memiliki akses untuk mengedit prestasi ini');
            }
            
            $siswas = collect([Auth::user()->siswa]);
        }
        else {
            $siswas = Siswa::with('user')->get()->sortBy('user.name');
        }
        
        return view('prestasi.edit', compact('prestasi', 'siswas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestasi $prestasi)
    {
        $user = Auth::user();
        $activeRole = session('active_role');
        
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'nama_prestasi' => 'required|string|max:255',
            'jenis' => 'required|in:akademik,non-akademik',
            'tingkat' => 'required|in:sekolah,kecamatan,kabupaten,provinsi,nasional,internasional',
            'peringkat' => 'nullable|string|max:50',
            'tanggal' => 'required|date',
            'file_bukti' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string',
        ], [
            'siswa_id.required' => 'Siswa harus dipilih',
            'siswa_id.exists' => 'Siswa tidak valid',
            'nama_prestasi.required' => 'Nama prestasi harus diisi',
            'jenis.required' => 'Jenis prestasi harus dipilih',
            'tingkat.required' => 'Tingkat prestasi harus dipilih',
            'tanggal.required' => 'Tanggal harus diisi',
            'file_bukti.mimes' => 'File bukti harus berformat PDF, JPG, JPEG, atau PNG',
            'file_bukti.max' => 'Ukuran file maksimal 2MB',
        ]);
        
        // Validasi akses untuk walikelas
        if ($activeRole === 'walikelas') {
            $walikelas = $user->walikelas;
            $siswa = Siswa::find($validated['siswa_id']);
            
            if ($prestasi->siswa->kelas_id !== $walikelas->kelas_id || 
                $siswa->kelas_id !== $walikelas->kelas_id) {
                return redirect()->back()
                    ->with('error', 'Anda hanya bisa mengedit prestasi siswa di kelas Anda')
                    ->withInput();
            }
        }
        
        // Validasi akses untuk siswa
        if ($activeRole === 'siswa') {
            if ($prestasi->siswa_id !== $user->siswa->id || 
                $validated['siswa_id'] != $user->siswa->id) {
                return redirect()->back()
                    ->with('error', 'Anda hanya bisa mengedit prestasi Anda sendiri')
                    ->withInput();
            }
        }
        
        // Upload file bukti baru jika ada
        if ($request->hasFile('file_bukti')) {
            // Hapus file lama jika ada
            if ($prestasi->file_bukti && Storage::disk('public')->exists($prestasi->file_bukti)) {
                Storage::disk('public')->delete($prestasi->file_bukti);
            }
            
            $file = $request->file('file_bukti');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('prestasi', $filename, 'public');
            $validated['file_bukti'] = $path;
        }
        
        $prestasi->update($validated);
        
        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestasi $prestasi)
    {
        $user = Auth::user();
        $activeRole = session('active_role');
        
        // Validasi akses untuk walikelas
        if ($activeRole === 'walikelas') {
            $walikelas = $user->walikelas;
            
            if ($prestasi->siswa->kelas_id !== $walikelas->kelas_id) {
                return redirect()->back()
                    ->with('error', 'Anda tidak memiliki akses untuk menghapus prestasi ini');
            }
        }
        
        // Validasi akses untuk siswa
        if ($activeRole === 'siswa') {
            if ($prestasi->siswa_id !== $user->siswa->id) {
                return redirect()->back()
                    ->with('error', 'Anda tidak memiliki akses untuk menghapus prestasi ini');
            }
        }
        
        // Hapus file bukti jika ada
        if ($prestasi->file_bukti && Storage::disk('public')->exists($prestasi->file_bukti)) {
            Storage::disk('public')->delete($prestasi->file_bukti);
        }
        
        $prestasi->delete();
        
        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil dihapus');
    }
    
    /**
     * Download file bukti prestasi
     */
    public function downloadBukti(Prestasi $prestasi)
    {
        $user = Auth::user();
        $activeRole = session('active_role');
        
        // Validasi akses
        if ($activeRole === 'walikelas') {
            $walikelas = $user->walikelas;
            
            if ($prestasi->siswa->kelas_id !== $walikelas->kelas_id) {
                abort(403, 'Anda tidak memiliki akses untuk mengunduh file ini');
            }
        }
        
        if ($activeRole === 'siswa') {
            if ($prestasi->siswa_id !== $user->siswa->id) {
                abort(403, 'Anda tidak memiliki akses untuk mengunduh file ini');
            }
        }
        
        if (!$prestasi->file_bukti || !Storage::disk('public')->exists($prestasi->file_bukti)) {
            return redirect()->back()->with('error', 'File bukti tidak ditemukan');
        }
        
        return Storage::disk('public')->download($prestasi->file_bukti);
    }
    
    /**
     * Statistik prestasi (untuk dashboard walikelas dan admin)
     */
    public function statistik()
    {
        $user = Auth::user();
        $activeRole = session('active_role');
        
        // Tentukan filter kelas
        $kelasFilter = null;
        $kelasInfo = 'Semua Kelas';
        
        if ($activeRole === 'walikelas') {
            $walikelas = $user->walikelas;
            
            if (!$walikelas) {
                return redirect()->back()->with('error', 'Anda belum ditugaskan sebagai wali kelas');
            }
            
            $kelasFilter = $walikelas->kelas_id;
            $kelasInfo = $walikelas->kelas->nama_kelas ?? 'Kelas';
        }
        
        // Query builder untuk prestasi
        $prestasiQuery = Prestasi::query();
        
        if ($kelasFilter) {
            $prestasiQuery->whereHas('siswa', function($query) use ($kelasFilter) {
                $query->where('kelas_id', $kelasFilter);
            });
        }
        
        // Statistik prestasi
        $totalPrestasi = (clone $prestasiQuery)->count();
        
        $prestasiAkademik = (clone $prestasiQuery)->where('jenis', 'akademik')->count();
        
        $prestasiNonAkademik = (clone $prestasiQuery)->where('jenis', 'non-akademik')->count();
        
        // Prestasi per tingkat
        $prestasiPerTingkat = (clone $prestasiQuery)
            ->selectRaw('tingkat, COUNT(*) as total')
            ->groupBy('tingkat')
            ->get();
        
        // Siswa berprestasi (siswa dengan prestasi terbanyak)
        $siswaQuery = Siswa::query();
        
        if ($kelasFilter) {
            $siswaQuery->where('kelas_id', $kelasFilter);
        }
        
        $siswaBerprestasi = $siswaQuery
            ->withCount('prestasis')
            ->having('prestasis_count', '>', 0)
            ->orderBy('prestasis_count', 'desc')
            ->take(10)
            ->get();
        
        // Prestasi terbaru (10 terakhir)
        $prestasiTerbaru = (clone $prestasiQuery)
            ->with(['siswa.user', 'siswa.kelas'])
            ->latest()
            ->take(10)
            ->get();
        
        // Prestasi per kelas (untuk superadmin/tus/kepsek)
        $prestasiPerKelas = null;
        if (!$kelasFilter) {
            $prestasiPerKelas = \DB::table('prestasis')
                ->join('siswas', 'prestasis.siswa_id', '=', 'siswas.id')
                ->join('kelas', 'siswas.kelas_id', '=', 'kelas.id')
                ->select('kelas.nama_kelas', \DB::raw('COUNT(*) as total'))
                ->groupBy('kelas.id', 'kelas.nama_kelas')
                ->orderBy('total', 'desc')
                ->get();
        }
        
        return view('prestasi.statistik', compact(
            'totalPrestasi',
            'prestasiAkademik',
            'prestasiNonAkademik',
            'prestasiPerTingkat',
            'siswaBerprestasi',
            'prestasiTerbaru',
            'prestasiPerKelas',
            'kelasInfo',
            'activeRole'
        ));
    }
}