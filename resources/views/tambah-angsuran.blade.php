
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Angsuran Koperasiku</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px #ddd;
        }

        h1 {
            color: #166534;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button, a {
            display: inline-block;
            margin-top: 20px;
            padding: 11px 16px;
            border: none;
            border-radius: 5px;
            background: #15803d;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        a {
            background: #475569;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Tambah Data Angsuran</h1>
    <p>Masukkan informasi pembayaran angsuran anggota koperasi.</p>

    @if ($errors->any())
        <div class="error">
            <strong>Periksa kembali data yang dimasukkan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/angsuran" method="POST">
        @csrf

        <label for="pinjaman_id">Pinjaman Anggota</label>
        <select name="pinjaman_id" id="pinjaman_id" required>
            <option value="">-- Pilih Pinjaman --</option>
            @foreach ($pinjaman as $item)
                <option value="{{ $item->id }}"
                    {{ old('pinjaman_id') == $item->id ? 'selected' : '' }}>
                    {{ $item->nomor_anggota }} - {{ $item->nama }}
                    (Rp {{ number_format($item->jumlah_pinjaman, 0, ',', '.') }})
                </option>
            @endforeach
        </select>

        @if ($pinjaman->isEmpty())
            <p class="error">
                Belum ada pinjaman berstatus disetujui.
                Tambahkan pinjaman dengan status disetujui terlebih dahulu.
            </p>
        @endif

        <label for="angsuran_ke">Angsuran Ke</label>
        <input type="number" name="angsuran_ke" id="angsuran_ke"
               min="1" value="{{ old('angsuran_ke', 1) }}" required>

        <label for="jumlah_angsuran">Jumlah Angsuran (Rp)</label>
        <input type="number" name="jumlah_angsuran" id="jumlah_angsuran"
               min="1" step="0.01" value="{{ old('jumlah_angsuran') }}" required>

        <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
        <input type="date" name="tanggal_jatuh_tempo"
               id="tanggal_jatuh_tempo"
               value="{{ old('tanggal_jatuh_tempo') }}" required>

        <label for="tanggal_bayar">Tanggal Bayar (Opsional)</label>
        <input type="date" name="tanggal_bayar" id="tanggal_bayar"
               value="{{ old('tanggal_bayar') }}">

        <label for="status">Status Angsuran</label>
        <select name="status" id="status" required>
            <option value="belum_bayar">Belum Bayar</option>
            <option value="dibayar">Dibayar</option>
            <option value="terlambat">Terlambat</option>
        </select>

        <label for="keterangan">Keterangan (Opsional)</label>
        <textarea name="keterangan" id="keterangan" rows="3">{{ old('keterangan') }}</textarea>

        <button type="submit" {{ $pinjaman->isEmpty() ? 'disabled' : '' }}>
            Simpan Angsuran
        </button>

        <a href="/angsuran">Kembali</a>
    </form>

</div>
</body>
</html>
