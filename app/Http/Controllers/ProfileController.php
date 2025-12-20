<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Tu;
use App\Models\Orangtua;
use App\Models\Kepsek;
use App\Models\Superadmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    protected function mapModel($role)
    {
        return [
            'siswa' => Siswa::class,
            'guru' => Guru::class,
            'kepsek' => Kepsek::class,
            'tus' => Tu::class,
            'orangtua' => Orangtua::class,
            'superadmin' => Superadmin::class,
        ][$role] ?? null;
    }

    protected function idLabel($role)
    {
        return [
            'siswa' => 'NISN',
            'guru' => 'NIP',
            'kepsek' => 'NIP',
            'tus' => 'NIP',
            'orangtua' => 'No HP',
            'superadmin' => 'Username',
        ][$role] ?? 'Username';
    }

    public function index()
    {
        $user = Auth::user();
        $role = strtolower(str_replace('_', ' ', $user->roles->pluck('name')->first()));

        $model = $this->mapModel($role);
        abort_if(!$model, 403, 'Role tidak dikenali');

        $profile = $model::with($role === 'siswa' ? 'kelas' : [])->firstOrCreate(['user_id' => $user->id]);

        $label = $this->idLabel($role);

        return view('profile.index', compact('profile', 'role', 'user', 'label'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $role = strtolower(str_replace('_', ' ', $user->roles->pluck('name')->first()));
        $model = $this->mapModel($role);

        abort_if(!$model, 403, 'Role tidak dikenali');

        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i', 'unique:users,email,' . $user->id],
            'alamat' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date|before_or_equal:2015-12-31',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'agama' => 'nullable|string|max:50',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $isSuperAdmin = ($role === 'superadmin');
        if ($isSuperAdmin) {
            if (in_array($role, ['siswa', 'guru', 'kepsek', 'tus', 'orangtua'])) {
                $rules['username'] = ['required', 'numeric', 'digits_between:10,18', 'unique:users,username,' . $user->id];
            } else {
                $rules['username'] = ['required', 'string', 'max:255', 'unique:users,username,' . $user->id];
            }
        }

        $validated = $request->validate($rules);

        // Update user
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $isSuperAdmin ? $validated['username'] : $user->username,
        ]);

        // Ambil atau buat profil
        $profile = $model::firstOrCreate(['user_id' => $user->id]);

        // Update data profil
        $profile->fill([
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
        ]);

        // Handle upload foto profil
        if ($request->hasFile('foto_profile')) {
            // Hapus foto lama jika ada
            if ($profile->foto_profile) {
                Storage::disk('public')->delete($profile->foto_profile);
                // Hapus juga dari public/storage (untuk Windows)
                $oldPublicPath = public_path('storage/' . $profile->foto_profile);
                if (file_exists($oldPublicPath)) {
                    unlink($oldPublicPath);
                }
            }

            // Simpan ke storage/app/public
            $filePath = $request->file('foto_profile')->store('foto_profiles', 'public');

            // Simpan path ke model
            $profile->foto_profile = $filePath;

            // 🔥 Salin ke public/storage agar bisa diakses di Windows + Laragon
            $source = storage_path('app/public/' . $filePath);
            $dest = public_path('storage/' . $filePath);

            // Buat folder jika belum ada
            if (!file_exists(dirname($dest))) {
                mkdir(dirname($dest), 0755, true);
            }

            copy($source, $dest);
        }

        $profile->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}