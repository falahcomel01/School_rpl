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
    'view users', 'view roles', 'view permissions',
    'create users', 'show users', 'edit users', 'delete users',
    'create roles', 'show roles', 'edit roles', 'delete roles',
    'create permissions', 'show permissions', 'edit permissions', 'delete permissions',
    'view total', 'view siswa', 'edit siswa', 'view guru',
    'view jadwal', 'create jadwal', 'edit jadwal',
    'edit presensisiswa', 'create presensisiswa', 'delete presensisiswa', 'view presensisiswa', 'show presensisiswa',
    'create presensiguru', 'show presensiguru', 'view presensiguru', 'delete presensiguru',

    'create walikelas', 'delete walikelas', 'edit walikelas', 'view walikelas',

    'view perizinan', 'edit perizinan', 'delete perizinan', 'create perizinan',
    'view all perizinan', 'view siswa perizinan', 'view own perizinan',

    'view all jadwal', 'view guru jadwal', 'view kelas jadwal',

    'view all presensisiswa', 'view kelas presensisiswa', 'view guru presensisiswa',

    'view presensi siswa',
    'delete siswa',

    // Catatan Perkembangan
    'view catatan_perkembangan', 'create catatan_perkembangan', 'edit catatan_perkembangan', 'delete catatan_perkembangan',
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
            'edit presensisiswa',
            'create presensisiswa',
            'view presensisiswa',
            'show presensisiswa',
            'view walikelas',
            'view perizinan',
            'create perizinan',
            'view siswa perizinan',
            'view guru jadwal',
            'view presensi siswa',
        ]);

        // Siswa
        $roleSiswa->givePermissionTo([
            'view jadwal',
            'view presensisiswa',
            'show presensisiswa',
            'view perizinan',
            'create perizinan',
            'view own perizinan',
            'view catatan_perkembangan', // lihat catatan perkembangan sendiri
        ]);

        // 🧑‍🎓 **Orang Tua**
        $roleOrangTua->givePermissionTo([
            'view jadwal',              // lihat jadwal anak
            'view presensisiswa',       // lihat presensi anak
            'show presensisiswa',
            'view siswa',               // lihat data anak
            'view perizinan',           // lihat izin anak
            'view catatan_perkembangan', // lihat catatan perkembangan anak
        ]);

        // 👨‍🏫 **Wali Kelas**
        $roleWaliKelas->givePermissionTo([
            'view kelas jadwal',        // hanya jadwal kelasnya
            'view kelas presensisiswa', // hanya presensi kelasnya
            'view siswa',               // lihat siswa kelasnya
            'edit siswa',               // jika perlu edit
            'view walikelas',
            'view perizinan',
            'view siswa perizinan',
            // Catatan Perkembangan
            'view catatan_perkembangan',
            'create catatan_perkembangan',
            'edit catatan_perkembangan',
            'delete catatan_perkembangan',
        ]);

        // 🎓 **Kepala Sekolah**
        $roleKepsek->givePermissionTo([
            'view all presensisiswa',
            'view all jadwal',
            'view all perizinan',
            'view guru',
            'view siswa',
            'view walikelas',
            'view total',
            'view catatan_perkembangan', // lihat semua catatan perkembangan
        ]);
    }
}
