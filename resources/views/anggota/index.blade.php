
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
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
        }
        h1 { color: #166534; }
        .tombol {
            display: inline-block;
            padding: 10px 15px;
            background: #15803d;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }
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
        .hapus { background: #dc2626; }
        .pesan { background: #dcfce7; padding: 12px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Data Anggota Koperasiku</h1>

    <a href="/" class="tombol">Kembali ke Dashboard</a>
    <a href="/anggota/tambah" class="tombol">+ Tambah Anggota</a>

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
                        <form action="/anggota/{{ $item->id }}"
                              method="POST"
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
