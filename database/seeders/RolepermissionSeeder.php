<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // ======================
        // 1. DAFTAR PERMISSION
        // ======================
       $permissions = [
     'view jadwal', 'view guru jadwal', 'view kelas jadwal', 'view all jadwal',

            // Presensi siswa
            'view presensisiswa', 'show presensisiswa', 'create presensisiswa',
            'edit presensisiswa', 'delete presensisiswa',
            'view all presensisiswa', 'view kelas presensisiswa',
            'view guru presensisiswa', 'view presensi siswa',

            // Presensi guru
            'create presensiguru', 'view presensiguru', 'show presensiguru', 'delete presensiguru',

            // Perizinan
            'view perizinan', 'create perizinan', 'edit perizinan',
            'delete perizinan', 'validasi izin',
            'view all perizinan', 'view siswa perizinan', 'view own perizinan',

            // Users & Role
            'view users', 'create users', 'show users', 'edit users', 'delete users',
            'view roles', 'create roles', 'show roles', 'edit roles', 'delete roles',
            'view permissions', 'create permissions', 'show permissions',
            'edit permissions', 'delete permissions',

            // Akademik
            'view siswa', 'edit siswa', 'delete siswa',
            'view guru', 'view walikelas', 'create walikelas',
            'edit walikelas', 'delete walikelas',

            // Prestasi
            'view prestasi', 'create prestasi',

            // Materi & tugas
            'view materi', 'view tugas',

            // Kelulusan
            'view aturankelulusan', 'create kelulusan', 'view daskelulusan',

            // Statistik & dashboard
            'view statistik', 'view total',

            // Catatan perkembangan
            'view catatan_perkembangan', 'create catatan_perkembangan',
            'edit catatan_perkembangan', 'delete catatan_perkembangan',

            // Ekstrakurikuler
            'view extra', 'view peserta', 'pilihan extra',

            // Perizinan typo yg kamu pakai
            'create prizinan',
];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // ======================
        // 2. ROLE
        // ======================

        $roleSuperAdmin = Role::firstOrCreate(['name' => 'superadmin']);
        $roleSiswa      = Role::firstOrCreate(['name' => 'siswa']);
        $roleGuru       = Role::firstOrCreate(['name' => 'guru']);
        $roleTu         = Role::firstOrCreate(['name' => 'tus']);

        // 🔥 Tambahan baru:
        $roleOrangTua   = Role::firstOrCreate(['name' => 'orangtua']);
        $roleKepsek     = Role::firstOrCreate(['name' => 'kepsek']);
        $roleWaliKelas  = Role::firstOrCreate(['name' => 'walikelas']);

        // ======================
        // 3. Permission per Role
        // ======================

        // Superadmin: semua
        $roleSuperAdmin->syncPermissions(Permission::all());

        // Guru
        $roleGuru->givePermissionTo([
           'view jadwal',
'view guru jadwal',
'view presensisiswa',
'show presensisiswa',
'create presensisiswa',
'edit presensisiswa',
'view presensi siswa',
'view perizinan',
'create perizinan',
'create prizinan',
'view siswa perizinan',
'view materi',
'view tugas',

        ]);

        // Siswa
        $roleSiswa->givePermissionTo([
            'view jadwal', 'view presensisiswa', 'show presensisiswa',
            'view walikelas', 'view perizinan', 'create perizinan',
            'view own perizinan', 'view extra', 'view prestasi',
            'view catatan_perkembangan', 'view tugas',
            'create prizinan', 'pilihan extra',
        ]);

        // 🧑‍🎓 **Orang Tua**
        $roleOrangTua->givePermissionTo([
            'view jadwal',              // lihat jadwal anak
            'view presensisiswa',       // lihat presensi anak
            'show presensisiswa',
            'view siswa',               // lihat data anak
            'view perizinan',           // lihat izin anak
            'view catatan_perkembangan','view prestasi', // lihat catatan perkembangan anak
        ]);

        // 👨‍🏫 **Wali Kelas**
        $roleWaliKelas->givePermissionTo([
            'view total', 'view siswa', 'view guru', 'view walikelas',
            'view perizinan', 'view all perizinan',
            'view all jadwal', 'view all presensisiswa',
            'validasi izin', 'view prestasi',
            'view statistik', 'view daskelulusan',
        ]);
    

        // 🎓 **Kepala Sekolah**
        $roleKepsek->givePermissionTo([
           'view total', 'view siswa', 'view guru', 'view walikelas',
            'view perizinan', 'view all perizinan',
            'view all jadwal', 'view all presensisiswa',
            'validasi izin', 'view prestasi',
            'view statistik', 'view daskelulusan',
        
        ]);
    }
}
