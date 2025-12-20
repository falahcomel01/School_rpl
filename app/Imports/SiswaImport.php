<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SiswaImport implements 
    ToModel, 
    WithHeadingRow, 
    WithValidation, 
    SkipsOnFailure
{
    public $duplicates = [];
    public $imported = 0;
    public $failed = 0;

    protected $processedUsernames = [];

    public function rules(): array
    {
        return [
            'nama'          => 'required',
            'username'      => 'required|numeric|unique:users,username',
            'email'         => 'nullable|email|unique:users,email',
            'kelas'         => 'required',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'username.required' => 'NIS / Username wajib diisi.',
            'username.numeric' => 'NIS harus berupa angka.',
            'username.unique' => 'NIS sudah terdaftar.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'kelas.required' => 'Kelas wajib diisi.',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $failure) {
            $row = $failure->row();
            $values = $failure->values();
            $errors = $failure->errors();

            $username = $values['username'] ?? null;
            $email = $values['email'] ?? null;

            $isDuplicate = false;
            foreach ($errors as $err) {
                if (str_contains($err, 'unique') || str_contains($err, 'sudah terdaftar')) {
                    $isDuplicate = true;
                    break;
                }
            }

            if ($isDuplicate) {
                if (!in_array($username, $this->processedUsernames)) {
                    $this->duplicates[] = [
                        'row' => $row,
                        'nama' => $values['nama'] ?? 'N/A',
                        'username' => $username,
                        'email' => $email,
                        'errors' => $errors,
                    ];
                    $this->processedUsernames[] = $username;
                }
            } else {
                $this->failed++;
            }
        }
    }

    /**
     * Normalize kelas string and find matching Kelas model.
     * Accepts "12A IPS", "12 A", "12A-IPA", "12a ips", etc.
     */
    protected function findKelasByString($kelasRaw)
    {
        if (!$kelasRaw) return null;

        // make uppercase, trim, replace multiple spaces/dashes
        $k = strtoupper(trim($kelasRaw));
        $k = preg_replace('/\s+/', ' ', $k);
        $k = str_replace(['-', '_'], ' ', $k);

        // try to extract first token that looks like "12A" or "10B"
        if (preg_match('/\b(\d{1,2}\s*[A-Z])\b/', $k, $m)) {
            $base = str_replace(' ', '', $m[1]); // "12 A" -> "12A"
        } else {
            // fallback: if first token exists, use it (remove non-alnum)
            $first = explode(' ', $k)[0];
            $base = preg_replace('/[^A-Z0-9]/', '', $first);
        }

        if (!$base) return null;

        // Try exact match ignoring whitespace and case
        $normalized = strtolower(preg_replace('/\s+/', '', $base)); // e.g. "12a"
        return Kelas::whereRaw("LOWER(REPLACE(nama_kelas, ' ', '')) = ?", [$normalized])->first();
    }

    public function model(array $row)
    {
        // Normalize kelas field & find kelas
        $kelasRaw = $row['kelas'] ?? null;
        $kelasModel = $this->findKelasByString($kelasRaw);

        if (!$kelasModel) {
            // log or count failure, skip quietly
            $this->failed++;
            return null;
        }

        // skip if username/email already exist
        if (User::where('username', $row['username'])->exists()) return null;
        if (!empty($row['email']) && User::where('email', $row['email'])->exists()) return null;

        // Create user: default password "12345678"
        // NOTE: your User model already hashes password in mutator? If NOT and you want hashed, replace with Hash::make('12345678')
        $user = User::create([
            'name'     => $row['nama'],
            'username' => $row['username'],
            'email'    => $row['email'] ?? null,
            'password' => "12345678",   // default un-hashed password per your system
        ]);

        $user->assignRole('siswa');

        $this->imported++;

        return new Siswa([
            'user_id'       => $user->id,
            'kelas_id'      => $kelasModel->id,
            'jenis_kelamin' => $row['jenis_kelamin'] ?? null
        ]);
    }
}
