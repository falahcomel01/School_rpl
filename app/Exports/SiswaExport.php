<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiswaExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::role('siswa')->with('siswa.kelas.jurusan')->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Username',
            'Email',
            'Kelas',
            'Jurusan',
            'Jenis Kelamin'
        ];
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->username,
            $user->email,
            $user->siswa->kelas->nama_kelas ?? '-',
            $user->siswa->kelas->jurusan->nama_jurusan ?? '-',
            $user->siswa->jenis_kelamin ?? '-',
        ];
    }
}
