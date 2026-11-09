
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Simpanan - Koperasiku</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f6fa;
            margin: 0;
            padding: 30px 15px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        h1 {
            color: #176b45;
        }

        label {
            display: block;
            margin-top: 16px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 11px;
            margin-top: 7px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        textarea {
            min-height: 80px;
            resize: vertical;
        }

        button,
        .btn-kembali {
            display: inline-block;
            margin-top: 22px;
            padding: 11px 16px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        button {
            background: #176b45;
            color: white;
        }

        .btn-kembali {
            background: #e5e7eb;
            color: #222;
            margin-left: 5px;
        }

        .error-box {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Tambah Simpanan</h1>
        <p>Isi formulir berikut untuk mencatat simpanan anggota.</p>

        @if ($errors->any())
            <div class="error-box">
                <strong>Data belum valid:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/simpanan" method="POST">
            @csrf

            <label for="anggota_id">Nomor dan Nama Anggota</label>
            <select id="anggota_id" name="anggota_id" required>
                <option value="">-- Pilih Anggota --</option>

                @foreach ($anggota as $item)
                    <option value="{{ $item->id }}"
                        {{ old('anggota_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->nomor_anggota }} - {{ $item->nama }}
                    </option>
                @endforeach
            </select>

            <label for="jenis_simpanan">Jenis Simpanan</label>
            <select id="jenis_simpanan" name="jenis_simpanan" required>
                <option value="">-- Pilih Jenis Simpanan --</option>
                <option value="Pokok" {{ old('jenis_simpanan') == 'Pokok' ? 'selected' : '' }}>
                    Simpanan Pokok
                </option>
                <option value="Wajib" {{ old('jenis_simpanan') == 'Wajib' ? 'selected' : '' }}>
                    Simpanan Wajib
                </option>
                <option value="Sukarela" {{ old('jenis_simpanan') == 'Sukarela' ? 'selected' : '' }}>
                    Simpanan Sukarela
                </option>
            </select>

            <label for="jumlah">Jumlah Simpanan (Rp)</label>
            <input
                type="number"
                id="jumlah"
                name="jumlah"
                min="1"
                step="0.01"
                placeholder="Contoh: 50000"
                value="{{ old('jumlah') }}"
                required
            >

            <label for="tanggal_simpanan">Tanggal Simpanan</label>
            <input
                type="date"
                id="tanggal_simpanan"
                name="tanggal_simpanan"
                value="{{ old('tanggal_simpanan', date('Y-m-d')) }}"
                required
            >

            <label for="keterangan">Keterangan (Opsional)</label>
            <textarea
                id="keterangan"
                name="keterangan"
                placeholder="Contoh: Simpanan wajib bulan Oktober"
            >{{ old('keterangan') }}</textarea>

            <button type="submit">Simpan Simpanan</button>
            <a href="/simpanan" class="btn-kembali">Kembali</a>
        </form>
    </div>
</body>
</html>
