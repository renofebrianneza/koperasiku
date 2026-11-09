<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pinjaman - Koperasiku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f6fa;
            margin: 0;
            padding: 30px 15px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
        }
        h1 { color: #176b45; }
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
        button, .back {
            display: inline-block;
            margin-top: 20px;
            padding: 11px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        button { background: #176b45; color: white; }
        .back { background: #e5e7eb; color: #222; }
        .errors { color: #991b1b; background: #fee2e2; padding: 12px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Tambah Pinjaman</h1>
    <p>Masukkan informasi pinjaman anggota.</p>

    @if ($errors->any())
        <div class="errors">
            <strong>Periksa kembali data:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/pinjaman" method="POST">
        @csrf

        <label for="anggota_id">Anggota</label>
        <select id="anggota_id" name="anggota_id" required>
            <option value="">-- Pilih Anggota --</option>
            @foreach ($anggota as $item)
                <option value="{{ $item->id }}"
                    {{ old('anggota_id') == $item->id ? 'selected' : '' }}>
                    {{ $item->nomor_anggota }} - {{ $item->nama }}
                </option>
            @endforeach
        </select>

        <label for="jumlah_pinjaman">Jumlah Pinjaman (Rp)</label>
        <input type="number" id="jumlah_pinjaman" name="jumlah_pinjaman"
            min="1" step="0.01" value="{{ old('jumlah_pinjaman') }}" required>

        <label for="bunga_persen">Bunga (%)</label>
        <input type="number" id="bunga_persen" name="bunga_persen"
            min="0" max="100" step="0.01"
            value="{{ old('bunga_persen', '0') }}" required>

        <label for="lama_angsuran">Lama Angsuran (bulan)</label>
        <input type="number" id="lama_angsuran" name="lama_angsuran"
            min="1" value="{{ old('lama_angsuran', '12') }}" required>

        <label for="tanggal_pinjaman">Tanggal Pinjaman</label>
        <input type="date" id="tanggal_pinjaman" name="tanggal_pinjaman"
            value="{{ old('tanggal_pinjaman', date('Y-m-d')) }}" required>

        <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo (opsional)</label>
        <input type="date" id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo"
            value="{{ old('tanggal_jatuh_tempo') }}">

        <label for="status">Status Pinjaman</label>
        <select id="status" name="status" required>
            <option value="menunggu">Menunggu</option>
            <option value="disetujui">Disetujui</option>
            <option value="ditolak">Ditolak</option>
            <option value="lunas">Lunas</option>
        </select>

        <label for="keterangan">Keterangan (opsional)</label>
        <textarea id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>

        <button type="submit">Simpan Pinjaman</button>
        <a href="/pinjaman" class="back">Kembali</a>
    </form>
</div>
</body>
</html>
