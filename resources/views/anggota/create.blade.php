
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota - Koperasiku</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 25px;
            background: white;
            border-radius: 12px;
        }

        h1 {
            color: #166534;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .tombol {
            display: inline-block;
            margin-top: 20px;
            padding: 11px 16px;
            border: none;
            border-radius: 6px;
            background: #15803d;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .kembali {
            background: #64748b;
        }

        .error {
            color: #dc2626;
            margin-top: 5px;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>Tambah Anggota</h1>
    <p>Masukkan data anggota koperasi pada formulir berikut.</p>

    @if ($errors->any())
        <div class="error">
            <strong>Periksa kembali data berikut:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/anggota" method="POST">
        @csrf

        <label for="nomor_anggota">Nomor Anggota *</label>
        <input
            type="text"
            id="nomor_anggota"
            name="nomor_anggota"
            value="{{ old('nomor_anggota') }}"
            placeholder="Contoh: A001"
            required
        >

        <label for="nama">Nama Lengkap *</label>
        <input
            type="text"
            id="nama"
            name="nama"
            value="{{ old('nama') }}"
            placeholder="Masukkan nama anggota"
            required
        >

        <label for="no_telepon">Nomor Telepon</label>
        <input
            type="text"
            id="no_telepon"
            name="no_telepon"
            value="{{ old('no_telepon') }}"
            maxlength="20"
            placeholder="Masukkan nomor telepon"
        >

        <label for="alamat">Alamat</label>
        <textarea
            id="alamat"
            name="alamat"
            rows="4"
            placeholder="Masukkan alamat anggota"
        >{{ old('alamat') }}</textarea>

        <button type="submit" class="tombol">
            Simpan Anggota
        </button>

        <a href="/anggota" class="tombol kembali">
            Kembali
        </a>
    </form>
</div>
</body>
</html>
