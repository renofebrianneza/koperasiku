
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pinjaman Koperasiku</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f6fa;
            margin: 0;
            padding: 30px 15px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        h1 { color: #176b45; }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            background: #176b45;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px 5px 18px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #176b45;
            color: white;
        }

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
    <h1>Data Pinjaman Koperasiku</h1>

    <a href="/" class="btn">Kembali ke Dashboard</a>
    <a href="/pinjaman/tambah" class="btn">+ Tambah Pinjaman</a>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nomor Anggota</th>
                <th>Nama Anggota</th>
                <th>Jumlah Pinjaman</th>
                <th>Bunga (%)</th>
                <th>Lama Angsuran</th>
                <th>Tanggal Pinjaman</th>
                <th>Jatuh Tempo</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pinjaman as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nomor_anggota }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>Rp {{ number_format($item->jumlah_pinjaman, 0, ',', '.') }}</td>
                    <td>{{ $item->bunga_persen }}%</td>
                    <td>{{ $item->lama_angsuran }} bulan</td>
                    <td>{{ $item->tanggal_pinjaman }}</td>
                    <td>{{ $item->tanggal_jatuh_tempo ?? '-' }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">Belum ada data pinjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
