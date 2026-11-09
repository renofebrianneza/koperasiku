
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }
        .container {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px #ddd;
        }
        h2 { margin-top: 0; }
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
            border-radius: 4px;
        }
        button, .back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            border: 0;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }
        button { background: #198754; color: white; }
        .back { background: #6c757d; color: white; }
        .error { color: #dc3545; }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Data Anggota</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/anggota/' . $anggota->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nomor Anggota</label>
        <input type="text" name="nomor_anggota"
               value="{{ old('nomor_anggota', $anggota->nomor_anggota) }}" required>

        <label>Nama Anggota</label>
        <input type="text" name="nama"
               value="{{ old('nama', $anggota->nama) }}" required>

        <label>NIK (16 digit)</label>
        <input type="text" name="nik" maxlength="16"
               value="{{ old('nik', $anggota->nik) }}">

        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin">
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="Laki-laki"
                {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                Laki-laki
            </option>
            <option value="Perempuan"
                {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                Perempuan
            </option>
        </select>

        <label>Nomor Telepon</label>
        <input type="text" name="no_telepon"
               value="{{ old('no_telepon', $anggota->no_telepon) }}">

        <label>Alamat</label>
        <textarea name="alamat" rows="3">{{ old('alamat', $anggota->alamat) }}</textarea>

        <label>Status</label>
        <select name="status" required>
            <option value="aktif"
                {{ old('status', $anggota->status) == 'aktif' ? 'selected' : '' }}>
                Aktif
            </option>
            <option value="nonaktif"
                {{ old('status', $anggota->status) == 'nonaktif' ? 'selected' : '' }}>
                Nonaktif
            </option>
        </select>

        <button type="submit">Simpan Perubahan</button>
        <a class="back" href="{{ url('/anggota') }}">Kembali</a>
    </form>
</div>
</body>
</html>
