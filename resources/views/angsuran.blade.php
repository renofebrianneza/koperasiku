
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Angsuran Koperasiku</title>

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
            border-radius: 10px;
            box-shadow: 0 2px 10px #ddd;
        }

        h1 {
            color: #166534;
        }

        a, button {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px 3px 15px 0;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            background: #15803d;
            cursor: pointer;
        }

        .kembali {
            background: #475569;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #166534;
            color: white;
        }

        tr:nth-child(even) {
            background: #f8fafc;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 5px;
        }

        .kosong {
            text-align: center;
            padding: 20px;
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Data Angsuran Koperasiku</h1>
    <p>Halaman untuk melihat data pembayaran angsuran pinjaman anggota.</p>

    <a href="/" class="kembali">Kembali ke Dashboard</a>
    <a href="/angsuran/tambah">+ Tambah Angsuran</a>

    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>No. Anggota</th>
                <th>Nama Anggota</th>
                <th>Angsuran Ke</th>
                <th>Jumlah Angsuran</th>
                <th>Jatuh Tempo</th>
                <th>Tanggal Bayar</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($angsuran as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nomor_anggota }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->angsuran_ke }}</td>
                    <td>Rp {{ number_format($item->jumlah_angsuran, 0, ',', '.') }}</td>
                    <td>{{ $item->tanggal_jatuh_tempo }}</td>
                    <td>{{ $item->tanggal_bayar ?? '-' }}</td>
                    <td>{{ str_replace('_', ' ', ucfirst($item->status)) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="kosong">
                        Belum ada data angsuran.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
</body>
</html>
