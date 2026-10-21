<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = DB::table('anggota')
            ->orderByDesc('id')
            ->get();

        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor_anggota' => 'required|string|max:50|unique:anggota,nomor_anggota',
            'nama' => 'required|string|max:150',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        DB::table('anggota')->insert([
            'nomor_anggota' => $data['nomor_anggota'],
            'nama' => $data['nama'],
            'no_telepon' => $data['no_telepon'] ?? null,
            'alamat' => $data['alamat'] ?? null,
            'tanggal_bergabung' => now()->toDateString(),
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/anggota')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        DB::table('anggota')->where('id', $id)->delete();

        return redirect('/anggota')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
