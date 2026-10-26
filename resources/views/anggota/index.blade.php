
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota Koperasiku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 30px;
        }
        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
        }
        h1 { color: #166534; }
        .tombol {
            display: inline-block;
            padding: 9px 13px;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            margin: 2px;
        }
        .dashboard { background: #475569; }
        .tambah { background: #15803d; }
        .edit { background: #2563eb; }
        .hapus { background: #dc2626; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th { background: #166534; color: white; }
        .pesan { background: #dcfce7; padding: 12px; }
        .form-hapus { display: inline; }
    </style>
</head>
<body>
<div class="container">
    <h1>Data Anggota Koperasiku</h1>

    <a href="/" class="tombol dashboard">Kembali ke Dashboard</a>
    <a href="/anggota/tambah" class="tombol tambah">+ Tambah Anggota</a>

    @if(session('success'))
        <p class="pesan">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nomor Anggota</th>
                <th>Nama</th>
                <th>No. Telepon</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($anggota as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nomor_anggota }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->no_telepon ?? '-' }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <a href="{{ url('/anggota/' . $item->id . '/edit') }}"
                           class="tombol edit">Edit</a>

                        <form action="{{ url('/anggota/' . $item->id) }}"
                              method="POST"
                              class="form-hapus"
                              onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="tombol hapus">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data anggota.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
