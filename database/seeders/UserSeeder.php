<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $SuperAdmin = User::create([
            'name' => 'fufufalah',
            'username' => 'falah',
            'email' => 'falahsi@gmail.com',
          'password' => '12345678'

        ]);
        $SuperAdmin->assignRole('superadmin');
        
        $siswa = User::create([
            'name' => 'fufuah',
            'username' => '230609016',
            'email' => 'hama@gmail.com',
           'password' => '12345678'

        ]);
        $siswa->assignRole('siswa');
         
        $siswa = User::create([
            'name' => 'roni',
            'username' => '230609017',
            'email' => 'roni@gmail.com',
   'password' => '12345678'

        ]);
        $siswa->assignRole('siswa');

          $siswa = User::create([
            'name' => 'falah',
            'username' => '121211',
            'email' => 'falah@gmail.com',
        'password' => '12345678'



        ]);
        $siswa->assignRole('siswa');
          $siswa = User::create([
            'name' => 'daffa',
            'username' => '230609018',
            'email' => 'daffa@gmail.com',
         'password' => '12345678'

        ]);
        $siswa->assignRole('siswa');

          $siswa = User::create([
            'name' => 'ilham',
            'username' => '230609019',
            'email' => 'ilham@gmail.com',
        'password' => '12345678'

        ]);
        $siswa->assignRole('siswa');
        
          $siswa = User::create([
            'name' => 'ayu',
            'username' => '230609020',
            'email' => 'ayu@gmail.com',
         'password' => '12345678'

        ]);
        $siswa->assignRole('siswa');
        
          $siswa = User::create([
            'name' => 'vivi',
            'username' => '230609021',
            'email' => 'vivi@gmail.com',
         'password' => '12345678'

        ]);
        $siswa->assignRole('siswa');

          $siswa = User::create([
            'name' => 'damas',
            'username' => '230609022',
            'email' => 'damas@gmail.com',
           'password' => '12345678'

        ]);
        $siswa->assignRole('siswa');

         $siswa = User::create([
            'name' => 'rafi',
            'username' => '230609023',
            'email' => 'rafi@gmail.com',
          'password' => '12345678'

        ]);
        $siswa->assignRole('siswa');
        
         $siswa = User::create([
            'name' => 'reza',
            'username' => '230609024',
            'email' => 'reza@gmail.com',
          'password' => '12345678'

        ]);
        $siswa->assignRole('siswa');

         $siswa = User::create([
            'name' => 'alamsi',
            'username' => '230609025',
            'email' => 'alamsi@gmail.com',
           'password' => '12345678'

        ]);
        $siswa->assignRole('siswa');
        
        $guru = User::create([
            'name' => 'mahad',
            'username' => '240609001',
            'email' => 'mahasiswa@gmail.com',
           'password' => '12345678'

        ]);
        $guru->assignRole('guru');

        $guru = User::create([
            'name' => 'rifki',
            'username' => '240609002',
            'email' => 'rifki@gmail.com',
           'password' => '12345678'

        ]);
        $guru->assignRole('guru');

        $guru = User::create([
            'name' => 'cahyo',
            'username' => '240609003',
            'email' => 'cahyo@gmail.com',
          'password' => '12345678'

        ]);
        $guru->assignRole('guru');
        $guru = User::create([
            'name' => 'yono',
            'username' => '240609004',
            'email' => 'yono@gmail.com',
            'password' => '12345678'

        ]);
        $guru->assignRole('guru');
        
        $guru = User::create([
            'name' => 'susi',
            'username' => '240609005',
            'email' => 'susi@gmail.com',
            'password' => '12345678'

        ]);
        $guru->assignRole('guru');

        $guru = User::create([
            'name' => 'dedi',
            'username' => '240609007',
            'email' => 'dedi@gmail.com',
          'password' => '12345678'

        ]);
        $guru->assignRole('guru');

        $tu= User::create([
            'name' => 'sulastris',
            'username' => '12111',
            'email' => 'sulastris@gmail.com',
           'password' => '12345678']);
        $tu->assignRole('tus');
       
        // ORANGTUA
$ortu = User::create([
    'name' => 'Budi Santoso',
    'username' => '081234567890', 
    'email' => 'budiortu@gmail.com',
    'password' => '12345678'
]);
$ortu->assignRole('orangtua');

$ortu = User::create([
    'name' => 'Siti Aminah',
    'username' => '082233445566',
    'email' => 'sitiortu@gmail.com',
    'password' => '12345678'
]);
$ortu->assignRole('orangtua');

$ortu = User::create([
    'name' => 'Rudi Hartono',
    'username' => '083887766554', 
    'email' => 'rudiortu@gmail.com',
    'password' => '12345678'
]);
$ortu->assignRole('orangtua');

    }
}
    

