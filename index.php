<?php
// Mulai session untuk menyimpan data sementara
session_start();

if (!isset($_SESSION['catatan'])) {
    $_SESSION['catatan'] = [];
}

// Menambahkan data baru
if (isset($_POST['tambah'])) {
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $kategori = $_POST['kategori'];
    $jumlah = $_POST['jumlah'];

    $_SESSION['catatan'][] = [
        'tanggal' => $tanggal,
        'keterangan' => $keterangan,
        'kategori' => $kategori,
        'jumlah' => $jumlah
    ];
}
    
// Reset data
if (isset($_POST['reset'])) {
    $_SESSION['catatan'] = [];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pencatatan Keuangan Pribadi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>💰 Aplikasi Keuangan Pribadi</h1>
</header>

<nav>
    <ul>
        <li><a href="#">Beranda</a></li>||
        <li><a href="#">Catatan</a></li>||
        <li><a href="#">Laporan</a></li>||
    </ul>
</nav>



    <main class="main-content">
        <h2>Tambah Catatan Keuangan</h2>
        <form method="POST">
            <div class="form-input">
                <label>Tanggal:</label>
                <input type="date" name="tanggal" required>

                <label>Keterangan:</label>
                <input type="text" name="keterangan" required>

                <label>Kategori:</label>
                <select name="kategori">
                    <option>Pemasukan</option>
                    <option>Pengeluaran</option>
                </select>

                <label>Jumlah (Rp):</label>
                <input type="number" name="jumlah" required>

                <button type="submit" name="tambah">💾 Simpan</button>
                <button type="submit" name="reset" class="reset">🗑 Reset</button>
            </div>
        </form>

        <h2>Riwayat Keuangan</h2>
        <table>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Kategori</th>
                <th>Jumlah (Rp)</th>
            </tr>
            <?php 
            $total = 0;
            foreach ($_SESSION['catatan'] as $item): 
                if ($item['kategori'] == 'Pemasukan') {
                    $total += $item['jumlah'];
                } else {
                    $total -= $item['jumlah'];
                }
            ?>
            <tr>
                <td><?= $item['tanggal'] ?></td>
                <td><?= $item['keterangan'] ?></td>
                <td><?= $item['kategori'] ?></td>
                <td><?= number_format($item['jumlah'], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <div class="summary">
            <h3>Total Saldo Saat Ini:</h3>
            <p><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></p>
        </div>
    </main>
</div>

<footer>
    <p>© <?= date("Y"); ?> Aplikasi Keuangan Pribadi | Dibuat dengan ❤️ oleh Kamu</p>
</footer>

</body>
</html>
