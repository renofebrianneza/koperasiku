
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Simpanan Koperasiku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f6fa;
            margin: 0;
            padding: 30px 15px;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }
        h1 { color: #176b45; }
        a, button {
            display: inline-block;
            padding: 10px 15px;
            background: #176b45;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            margin: 5px 5px 18px 0;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th { background: #176b45; color: white; }
        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Data Simpanan Koperasiku</h1>

    <a href="/">Kembali ke Dashboard</a>
    <a href="/simpanan/tambah">+ Tambah Simpanan</a>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nomor Anggota</th>
                <th>Nama Anggota</th>
                <th>Jenis Simpanan</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($simpanan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nomor_anggota }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis_simpanan }}</td>
                    <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    <td>{{ $item->tanggal_simpanan }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada data simpanan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
