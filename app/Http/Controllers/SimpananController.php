<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SimpananController extends Controller
{
    // Menampilkan daftar simpanan
    public function index()
    {
        $simpanan = DB::table('simpanan')
            ->join('anggota', 'simpanan.anggota_id', '=', 'anggota.id')
            ->select(
                'simpanan.*',
                'anggota.nomor_anggota',
                'anggota.nama'
            )
            ->orderByDesc('simpanan.id')
            ->get();

        return view('simpanan', compact('simpanan'));
    }

    // Menampilkan formulir tambah simpanan
    public function create()
    {
        $anggota = DB::table('anggota')
            ->where('status', 'aktif')
            ->orderBy('nama')
            ->get();

        return view('tambah-simpanan', compact('anggota'));
    }

    // Menyimpan data simpanan
    public function store(Request $request)
    {
        $data = $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'jenis_simpanan' => 'required|in:Pokok,Wajib,Sukarela',
            'jumlah' => 'required|numeric|min:1',
            'tanggal_simpanan' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        DB::table('simpanan')->insert([
            'anggota_id' => $data['anggota_id'],
            'jenis_simpanan' => $data['jenis_simpanan'],
            'jumlah' => $data['jumlah'],
            'tanggal_simpanan' => $data['tanggal_simpanan'],
            'keterangan' => $data['keterangan'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/simpanan')
            ->with('success', 'Simpanan berhasil ditambahkan.');
    }
}
