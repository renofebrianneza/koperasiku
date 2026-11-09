<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $akun = [
            ['Administrator', 'admin@koperasi.test', 'admin'],
            ['Bendahara', 'bendahara@koperasi.test', 'bendahara'],
            ['Petugas', 'petugas@koperasi.test', 'petugas'],
        ];

        foreach ($akun as [$name, $email, $role]) {
            $user = User::firstOrNew(['email' => $email]);
            $user->forceFill([
                'name' => $name,
                'password' => bcrypt('password'),
                'role' => $role,
            ])->save();
        }

        $contoh = [
            ['A-0001', '1371010101900001', 'Budi Santoso', 'L', 'Payakumbuh'],
            ['A-0002', '1371010202920002', 'Siti Rahma', 'P', 'Padang'],
            ['A-0003', '1371010303880003', 'Andi Pratama', 'L', 'Bukittinggi'],
        ];

        foreach ($contoh as [$no, $nik, $nama, $jk, $tempat]) {
            Anggota::firstOrCreate(['no_anggota' => $no], [
                'nik' => $nik,
                'nama' => $nama,
                'jenis_kelamin' => $jk,
                'tempat_lahir' => $tempat,
                'alamat' => 'Alamat contoh ' . $nama,
                'no_hp' => '08123456789',
                'tanggal_bergabung' => now()->toDateString(),
                'status' => 'aktif',
            ]);
        }
    }
}
