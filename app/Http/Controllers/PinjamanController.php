<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PinjamanController extends Controller
{
    public function index()
    {
        $pinjaman = DB::table('pinjaman')
            ->join('anggota', 'pinjaman.anggota_id', '=', 'anggota.id')
            ->select('pinjaman.*', 'anggota.nomor_anggota', 'anggota.nama')
            ->orderByDesc('pinjaman.id')
            ->get();

        return view('pinjaman', compact('pinjaman'));
    }

    public function create()
    {
        $anggota = DB::table('anggota')
            ->where('status', 'aktif')
            ->orderBy('nama')
            ->get();

        return view('tambah-pinjaman', compact('anggota'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'jumlah_pinjaman' => 'required|numeric|min:1',
            'bunga_persen' => 'required|numeric|min:0|max:100',
            'lama_angsuran' => 'required|integer|min:1',
            'tanggal_pinjaman' => 'required|date',
            'tanggal_jatuh_tempo' => 'nullable|date|after_or_equal:tanggal_pinjaman',
            'status' => 'required|in:menunggu,disetujui,ditolak,lunas',
            'keterangan' => 'nullable|string',
        ]);

        DB::table('pinjaman')->insert([
            'anggota_id' => $data['anggota_id'],
            'jumlah_pinjaman' => $data['jumlah_pinjaman'],
            'bunga_persen' => $data['bunga_persen'],
            'lama_angsuran' => $data['lama_angsuran'],
            'tanggal_pinjaman' => $data['tanggal_pinjaman'],
            'tanggal_jatuh_tempo' => $data['tanggal_jatuh_tempo'] ?? null,
            'status' => $data['status'],
            'keterangan' => $data['keterangan'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/pinjaman')
            ->with('success', 'Pinjaman berhasil ditambahkan.');
    }
}
