<?php
include 'koneksi.php';

// Tambah data baru
if (isset($_POST['tambah'])) {
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $kategori = $_POST['kategori'];
    $jumlah = $_POST['jumlah'];

    $query = "INSERT INTO transaksi (Tanggal, Keterangan, Kategori, Jumlah)
              VALUES ('$tanggal', '$keterangan', '$kategori', '$jumlah')";
    mysqli_query($conn, $query);
}

// Reset semua data
if (isset($_POST['reset'])) {
    mysqli_query($conn, "TRUNCATE TABLE transaksi");
}

// Ambil semua data
$result = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY Tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Catatan Keuangan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>📘 Catatan Keuangan</h1>
</header>

<nav>
    <ul>
        <li><a href="index.php">Beranda</a></li>
        <li><a href="catatan.php">Catatan</a></li>
        <li><a href="#">Laporan</a></li>
    </ul>
</nav>

<main>
    <h2>Tambah Catatan Keuangan</h2>
    <form method="POST">
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
        <button type="submit" name="reset">🗑 Reset</button>
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
while ($row = mysqli_fetch_assoc($result)): 
    if ($row['Kategori'] == 'Pemasukan') {
        $total += $row['Jumlah'];
    } else {
        $total -= $row['Jumlah'];
    }
?>
<tr>
    <td><?= $row['Tanggal']; ?></td>
    <td><?= $row['Keterangan']; ?></td>
    <td><?= $row['Kategori']; ?></td>
    <td><?= number_format($row['Jumlah'], 0, ',', '.'); ?></td>
</tr>
<?php endwhile; ?>

    </table>

    <div class="summary">
        <h3>Total Saldo Saat Ini:</h3>
        <p><strong>Rp <?= number_format($total, 0, ',', '.'); ?></strong></p>
    </div>
</main>

<footer>
    <div class="footer-container">
        <p>💰 <strong>Aplikasi Keuangan Pribadi</strong></p>
        <p>© <?= date("Y"); ?> Dibuat dengan ❤️ oleh <strong>Padli</strong></p>
        <div class="social-links">
    <a href="https://wa.me/6281234567890" target="_blank">
        <img src="https://cdn-icons-png.flaticon.com/512/3670/3670051.png" alt="WhatsApp">
    </a>
    <a href="instagram.html" target="_blank">
        <img src="https://cdn-icons-png.flaticon.com/512/3670/3670125.png" alt="Instagram">
    </a>
    <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook">
    </a>
</div>

    </div>
</footer>

</body>
</html>
