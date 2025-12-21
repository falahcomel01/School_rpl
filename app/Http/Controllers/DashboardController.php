<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelulusan;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    public function index()
    {
        $activeRole = session('active_role');

        // Data hanya untuk superadmin
        $usersCount = null;
        $rolesCount = null;
        $permissionsCount = null;
        $superadminData = null;
        
        // Data untuk Kepsek (Grafik Kelulusan)
        $kelulusanData = null;
        
        // Data untuk Guru & Siswa (Jadwal)
        $jadwalData = null;

        if ($activeRole === 'superadmin') {
            $usersCount = User::count();
            $rolesCount = Role::count();
            $permissionsCount = Permission::count();
            $superadminData = $this->getSuperadminData();
        }
        
        // Dashboard khusus untuk Kepsek
        if ($activeRole === 'kepsek') {
            $kelulusanData = $this->getKelulusanData();
        }
        
        // Dashboard untuk Guru
        if ($activeRole === 'guru') {
            $jadwalData = $this->getJadwalGuru();
        }
        
        // Dashboard untuk Siswa
        if ($activeRole === 'siswa') {
            $jadwalData = $this->getJadwalSiswa();
        }

        return view('dashboard', compact(
            'usersCount',
            'rolesCount',
            'permissionsCount',
            'superadminData',
            'kelulusanData',
            'jadwalData'
        ));
    }

    /**
     * Get data untuk dashboard Superadmin
     */
    protected function getSuperadminData()
    {
        // Total User, Role, Permission
        $totalUsers = User::count();
        $totalRoles = Role::count();
        $totalPermissions = Permission::count();

        // User per Role (untuk Pie Chart)
        $usersPerRole = DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('roles.name', DB::raw('COUNT(*) as total'))
            ->groupBy('roles.name')
            ->orderBy('total', 'desc')
            ->get();

        $roleLabels = $usersPerRole->pluck('name')->toArray();
        $roleData = $usersPerRole->pluck('total')->toArray();
        
        // Warna untuk setiap role
        $roleColors = [
            '#667eea', // purple
            '#10b981', // green
            '#f59e0b', // yellow
            '#ef4444', // red
            '#3b82f6', // blue
            '#8b5cf6', // violet
            '#ec4899', // pink
            '#06b6d4', // cyan
        ];

        // Permission per Role (untuk Bar Chart)
        $permissionsPerRole = DB::table('role_has_permissions')
            ->join('roles', 'role_has_permissions.role_id', '=', 'roles.id')
            ->select('roles.name', DB::raw('COUNT(*) as total'))
            ->groupBy('roles.name')
            ->orderBy('total', 'desc')
            ->get();

        $permissionRoleLabels = $permissionsPerRole->pluck('name')->toArray();
        $permissionRoleData = $permissionsPerRole->pluck('total')->toArray();

        // User Growth per bulan (6 bulan terakhir)
        $userGrowth = User::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $monthLabels = $userGrowth->pluck('month')->map(function($month) {
            return date('M Y', strtotime($month . '-01'));
        })->toArray();
        $monthData = $userGrowth->pluck('total')->toArray();

        // Top 5 Role dengan User Terbanyak
        $topRoles = $usersPerRole->take(5);

        // Role Dominan
        $dominantRole = $usersPerRole->first();

        // Statistik Permission
        $assignedPermissions = DB::table('role_has_permissions')
            ->distinct('permission_id')
            ->count('permission_id');
        $unassignedPermissions = $totalPermissions - $assignedPermissions;

        return [
            // Totals
            'totalUsers' => $totalUsers,
            'totalRoles' => $totalRoles,
            'totalPermissions' => $totalPermissions,
            
            // Pie Chart - Users per Role
            'roleLabels' => $roleLabels,
            'roleData' => $roleData,
            'roleColors' => array_slice($roleColors, 0, count($roleLabels)),
            
            // Bar Chart - Permissions per Role
            'permissionRoleLabels' => $permissionRoleLabels,
            'permissionRoleData' => $permissionRoleData,
            
            // Line Chart - User Growth
            'monthLabels' => $monthLabels,
            'monthData' => $monthData,
            
            // Statistics
            'topRoles' => $topRoles,
            'dominantRole' => $dominantRole,
            'assignedPermissions' => $assignedPermissions,
            'unassignedPermissions' => $unassignedPermissions,
            'usersPerRole' => $usersPerRole,
        ];
    }

    /**
     * Get data kelulusan untuk grafik Kepsek
     * FIXED: Better data handling and null safety
     */
    protected function getKelulusanData()
    {
        try {
            // Statistik Total
            $totalLulus = Kelulusan::where('status', 'lulus')->count();
            $totalTidakLulus = Kelulusan::where('status', 'tidak_lulus')->count();
            $totalKeseluruhan = $totalLulus + $totalTidakLulus;
            
            $persentaseLulus = $totalKeseluruhan > 0 
                ? round(($totalLulus / $totalKeseluruhan) * 100, 2) 
                : 0;

            // Statistik per Tahun (5 tahun terakhir)
            $statsPerTahun = Kelulusan::select(
                    'tahun_lulus',
                    DB::raw('COUNT(*) as total'),
                    DB::raw('SUM(CASE WHEN status = "lulus" THEN 1 ELSE 0 END) as lulus'),
                    DB::raw('SUM(CASE WHEN status = "tidak_lulus" THEN 1 ELSE 0 END) as tidak_lulus'),
                    DB::raw('ROUND((SUM(CASE WHEN status = "lulus" THEN 1 ELSE 0 END) * 100.0 / COUNT(*)), 2) as persentase_lulus')
                )
                ->groupBy('tahun_lulus')
                ->orderBy('tahun_lulus', 'asc') // CHANGED: asc untuk urutan chronological
                ->limit(5)
                ->get();

            // Statistik per Jurusan
            $statsPerJurusan = DB::table('kelulusans')
                ->select(
                    DB::raw('COALESCE(jurusans.nama_jurusan, kelulusans.jurusan_legacy, "Tidak Diketahui") as jurusan'),
                    DB::raw('COUNT(*) as total'),
                    DB::raw('SUM(CASE WHEN kelulusans.status = "lulus" THEN 1 ELSE 0 END) as lulus'),
                    DB::raw('SUM(CASE WHEN kelulusans.status = "tidak_lulus" THEN 1 ELSE 0 END) as tidak_lulus'),
                    DB::raw('ROUND((SUM(CASE WHEN kelulusans.status = "lulus" THEN 1 ELSE 0 END) * 100.0 / COUNT(*)), 2) as persentase_lulus')
                )
                ->leftJoin('siswas', 'kelulusans.siswa_id', '=', 'siswas.id')
                ->leftJoin('kelas', 'siswas.kelas_id', '=', 'kelas.id')
                ->leftJoin('jurusans', 'kelas.jurusan_id', '=', 'jurusans.id')
                ->groupBy('jurusan')
                ->get();

            // Format data untuk Chart.js - Grafik Status Kelulusan (Pie Chart)
            $statusLabels = ['Lulus', 'Tidak Lulus'];
            $statusData = [$totalLulus, $totalTidakLulus];
            $statusColors = ['#10b981', '#ef4444']; // green, red

            // Format data untuk Chart.js - Grafik Per Tahun (Line Chart)
            $tahunLabels = $statsPerTahun->pluck('tahun_lulus')->toArray();
            $tahunDataLulus = $statsPerTahun->pluck('lulus')->map(function($val) {
                return (int) $val; // Convert to integer
            })->toArray();
            $tahunDataTidakLulus = $statsPerTahun->pluck('tidak_lulus')->map(function($val) {
                return (int) $val; // Convert to integer
            })->toArray();

            // Format data untuk Chart.js - Grafik Per Jurusan (Bar Chart)
            $jurusanLabels = $statsPerJurusan->pluck('jurusan')->toArray();
            $jurusanDataLulus = $statsPerJurusan->pluck('lulus')->map(function($val) {
                return (int) $val; // Convert to integer
            })->toArray();
            $jurusanDataTidakLulus = $statsPerJurusan->pluck('tidak_lulus')->map(function($val) {
                return (int) $val; // Convert to integer
            })->toArray();

            // Debug logging
            Log::info('Kelulusan Data for Charts', [
                'tahunLabels' => $tahunLabels,
                'tahunDataLulus' => $tahunDataLulus,
                'jurusanLabels' => $jurusanLabels,
                'jurusanDataLulus' => $jurusanDataLulus,
            ]);

            return [
                // Data Statistik
                'totalLulus' => $totalLulus,
                'totalTidakLulus' => $totalTidakLulus,
                'totalKeseluruhan' => $totalKeseluruhan,
                'persentaseLulus' => $persentaseLulus,
                
                // Data untuk Grafik Status (Pie Chart)
                'statusLabels' => $statusLabels,
                'statusData' => $statusData,
                'statusColors' => $statusColors,
                
                // Data untuk Grafik Per Tahun (Line Chart)
                'tahunLabels' => $tahunLabels,
                'tahunDataLulus' => $tahunDataLulus,
                'tahunDataTidakLulus' => $tahunDataTidakLulus,
                
                // Data untuk Grafik Per Jurusan (Bar Chart)
                'jurusanLabels' => $jurusanLabels,
                'jurusanDataLulus' => $jurusanDataLulus,
                'jurusanDataTidakLulus' => $jurusanDataTidakLulus,
                
                // Data Raw untuk Tabel
                'statsPerTahun' => $statsPerTahun,
                'statsPerJurusan' => $statsPerJurusan,
            ];
        } catch (\Exception $e) {
            Log::error('Error getting kelulusan data: ' . $e->getMessage());
            
            // Return empty data structure
            return [
                'totalLulus' => 0,
                'totalTidakLulus' => 0,
                'totalKeseluruhan' => 0,
                'persentaseLulus' => 0,
                'statusLabels' => [],
                'statusData' => [],
                'statusColors' => [],
                'tahunLabels' => [],
                'tahunDataLulus' => [],
                'tahunDataTidakLulus' => [],
                'jurusanLabels' => [],
                'jurusanDataLulus' => [],
                'jurusanDataTidakLulus' => [],
                'statsPerTahun' => collect(),
                'statsPerJurusan' => collect(),
            ];
        }
    }

    /**
     * Get jadwal untuk Guru
     */
    protected function getJadwalGuru()
    {
        $user = auth()->user();
        
        // Cek apakah guru memiliki relasi
        if (!$user->guru) {
            return [
                'jadwalHariIni' => collect(),
                'jadwalMingguIni' => collect(),
                'totalJadwalMingguIni' => 0,
                'hariIni' => now()->locale('id')->isoFormat('dddd'),
            ];
        }

        $hariIni = $this->getNamaHari(now()->dayOfWeek);
        
        // Jadwal hari ini
        $jadwalHariIni = Jadwal::with(['mapel', 'kelas.jurusan'])
            ->where('guru_id', $user->guru->id)
            ->where('hari', $hariIni)
            ->orderBy('jam_mulai')
            ->get();

        // Jadwal seminggu
        $jadwalMingguIni = Jadwal::with(['mapel', 'kelas.jurusan'])
            ->where('guru_id', $user->guru->id)
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get()
            ->groupBy('hari');

        $totalJadwalMingguIni = Jadwal::where('guru_id', $user->guru->id)->count();

        return [
            'jadwalHariIni' => $jadwalHariIni,
            'jadwalMingguIni' => $jadwalMingguIni,
            'totalJadwalMingguIni' => $totalJadwalMingguIni,
            'hariIni' => now()->locale('id')->isoFormat('dddd'),
        ];
    }

    /**
     * Get jadwal untuk Siswa
     */
    protected function getJadwalSiswa()
    {
        $user = auth()->user();
        
        // Cek apakah siswa memiliki relasi dan kelas
        if (!$user->siswa || !$user->siswa->kelas_id) {
            return [
                'jadwalHariIni' => collect(),
                'jadwalMingguIni' => collect(),
                'totalJadwalMingguIni' => 0,
                'hariIni' => now()->locale('id')->isoFormat('dddd'),
                'namaKelas' => '-',
            ];
        }

        $hariIni = $this->getNamaHari(now()->dayOfWeek);
        
        // Jadwal hari ini
        $jadwalHariIni = Jadwal::with(['guru.user', 'mapel'])
            ->where('kelas_id', $user->siswa->kelas_id)
            ->where('hari', $hariIni)
            ->orderBy('jam_mulai')
            ->get();

        // Jadwal seminggu
        $jadwalMingguIni = Jadwal::with(['guru.user', 'mapel'])
            ->where('kelas_id', $user->siswa->kelas_id)
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get()
            ->groupBy('hari');

        $totalJadwalMingguIni = Jadwal::where('kelas_id', $user->siswa->kelas_id)->count();
        
        $namaKelas = $user->siswa->kelas->nama_kelas ?? '-';

        return [
            'jadwalHariIni' => $jadwalHariIni,
            'jadwalMingguIni' => $jadwalMingguIni,
            'totalJadwalMingguIni' => $totalJadwalMingguIni,
            'hariIni' => now()->locale('id')->isoFormat('dddd'),
            'namaKelas' => $namaKelas,
        ];
    }

    /**
     * Helper: Convert day of week ke nama hari dalam bahasa Indonesia
     */
    protected function getNamaHari($dayOfWeek)
    {
        $hari = [
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];

        return $hari[$dayOfWeek] ?? 'Senin';
    }
}