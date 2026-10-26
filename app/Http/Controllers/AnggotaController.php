<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = DB::table('anggota')
            ->orderByDesc('id')
            ->paginate(10);

        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor_anggota' => 'required|string|max:255|unique:anggota,nomor_anggota',
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|string|size:16|unique:anggota,nik',
            'jenis_kelamin' => 'nullable|string|max:20',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        DB::table('anggota')->insert([
            'nomor_anggota' => $data['nomor_anggota'],
            'nama' => $data['nama'],
            'nik' => $data['nik'] ?? null,
            'jenis_kelamin' => $data['jenis_kelamin'] ?? null,
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

    public function edit($id)
    {
        $anggota = DB::table('anggota')->where('id', $id)->first();

        if (!$anggota) {
            abort(404);
        }

        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $anggota = DB::table('anggota')->where('id', $id)->first();

        if (!$anggota) {
            abort(404);
        }

        $data = $request->validate([
            'nomor_anggota' => [
                'required',
                'string',
                'max:255',
                Rule::unique('anggota', 'nomor_anggota')->ignore($id),
            ],
            'nama' => 'required|string|max:255',
            'nik' => [
                'nullable',
                'string',
                'size:16',
                Rule::unique('anggota', 'nik')->ignore($id),
            ],
            'jenis_kelamin' => 'nullable|string|max:20',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        DB::table('anggota')->where('id', $id)->update([
            'nomor_anggota' => $data['nomor_anggota'],
            'nama' => $data['nama'],
            'nik' => $data['nik'] ?? null,
            'jenis_kelamin' => $data['jenis_kelamin'] ?? null,
            'no_telepon' => $data['no_telepon'] ?? null,
            'alamat' => $data['alamat'] ?? null,
            'status' => $data['status'],
            'updated_at' => now(),
        ]);

        return redirect('/anggota')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $anggota = DB::table('anggota')->where('id', $id)->first();

        if (!$anggota) {
            abort(404);
        }

        foreach (['simpanan', 'pinjaman'] as $table) {
            if (
                Schema::hasTable($table) &&
                Schema::hasColumn($table, 'anggota_id') &&
                DB::table($table)->where('anggota_id', $id)->exists()
            ) {
                return redirect('/anggota')
                    ->with('error', 'Anggota tidak dapat dihapus karena masih memiliki data simpanan atau pinjaman.');
            }
        }

        DB::table('anggota')->where('id', $id)->delete();

        return redirect('/anggota')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
