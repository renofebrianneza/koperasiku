
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koperasiku - Dashboard</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        header {
            background: #166534;
            color: white;
            padding: 25px 20px;
            text-align: center;
        }

        header h1 {
            margin: 0 0 8px;
        }

        nav {
            background: #14532d;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
            padding: 12px;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 5px;
        }

        nav a:hover {
            background: #15803d;
        }

        main {
            max-width: 1000px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .welcome {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px #ddd;
            text-align: center;
        }

        .welcome h2 {
            color: #166534;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 18px;
            margin-top: 25px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 10px;
            border-top: 4px solid #16a34a;
            box-shadow: 0 2px 8px #ddd;
        }

        .card h3 {
            margin-top: 0;
            color: #166534;
        }

        .card a {
            display: inline-block;
            margin-top: 8px;
            color: #15803d;
            font-weight: bold;
            text-decoration: none;
        }

        footer {
            margin-top: 40px;
            padding: 20px;
            text-align: center;
            color: #64748b;
        }
    </style>
</head>

<body>

<header>
    <h1>Koperasiku</h1>
    <p>Sistem Informasi Manajemen Koperasi</p>
</header>

<nav>
    <a href="/">Dashboard</a>
    <a href="/anggota">Data Anggota</a>
    <a href="/simpanan">Data Simpanan</a>
    <a href="/pinjaman">Data Pinjaman</a>
    <a href="/angsuran">Data Angsuran</a>
</nav>

<main>
    <section class="welcome">
        <h2>Selamat Datang di Koperasiku</h2>
        <p>
            Aplikasi ini digunakan untuk mengelola data anggota,
            simpanan, pinjaman, dan angsuran koperasi.
        </p>
        <p>
            Pilih menu di atas untuk mulai mengelola data koperasi.
        </p>
    </section>

    <section class="cards">
        <div class="card">
            <h3>Data Anggota</h3>
            <p>Mengelola informasi anggota koperasi.</p>
            <a href="/anggota">Buka Data Anggota →</a>
        </div>

        <div class="card">
            <h3>Data Simpanan</h3>
            <p>Mencatat transaksi simpanan anggota.</p>
            <a href="/simpanan">Buka Data Simpanan →</a>
        </div>

        <div class="card">
            <h3>Data Pinjaman</h3>
            <p>Mengelola informasi pinjaman anggota.</p>
            <a href="/pinjaman">Buka Data Pinjaman →</a>
        </div>

        <div class="card">
            <h3>Data Angsuran</h3>
            <p>Memantau pembayaran angsuran pinjaman.</p>
            <a href="/angsuran">Buka Data Angsuran →</a>
        </div>
    </section>
</main>

<footer>
    <p>&copy; 2026 Koperasiku - Sistem Informasi Manajemen Koperasi</p>
</footer>

</body>
</html>
