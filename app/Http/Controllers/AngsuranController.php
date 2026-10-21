<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AngsuranController extends Controller
{
    public function index()
    {
        $angsuran = DB::table('angsuran')
            ->join('pinjaman', 'angsuran.pinjaman_id', '=', 'pinjaman.id')
            ->join('anggota', 'pinjaman.anggota_id', '=', 'anggota.id')
            ->select(
                'angsuran.*',
                'anggota.nomor_anggota',
                'anggota.nama',
                'pinjaman.jumlah_pinjaman'
            )
            ->orderByDesc('angsuran.id')
            ->get();

        return view('angsuran', compact('angsuran'));
    }

    public function create()
    {
        $pinjaman = DB::table('pinjaman')
            ->join('anggota', 'pinjaman.anggota_id', '=', 'anggota.id')
            ->select(
                'pinjaman.id',
                'pinjaman.jumlah_pinjaman',
                'anggota.nomor_anggota',
                'anggota.nama'
            )
            ->where('pinjaman.status', 'disetujui')
            ->orderBy('anggota.nama')
            ->get();

        return view('tambah-angsuran', compact('pinjaman'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pinjaman_id' => 'required|exists:pinjaman,id',
            'angsuran_ke' => 'required|integer|min:1',
            'jumlah_angsuran' => 'required|numeric|min:1',
            'tanggal_jatuh_tempo' => 'required|date',
            'tanggal_bayar' => 'nullable|date',
            'status' => 'required|in:belum_bayar,dibayar,terlambat',
            'keterangan' => 'nullable|string',
        ]);

        DB::table('angsuran')->insert([
            'pinjaman_id' => $data['pinjaman_id'],
            'angsuran_ke' => $data['angsuran_ke'],
            'jumlah_angsuran' => $data['jumlah_angsuran'],
            'tanggal_jatuh_tempo' => $data['tanggal_jatuh_tempo'],
            'tanggal_bayar' => $data['tanggal_bayar'] ?? null,
            'status' => $data['status'],
            'keterangan' => $data['keterangan'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/angsuran')
            ->with('success', 'Data angsuran berhasil ditambahkan.');
    }
}
