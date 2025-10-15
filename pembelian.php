<?php
include 'config.php';


$sql = "SELECT pembelian.*, event.nama_event, event.harga 
        FROM pembelian
        JOIN event ON pembelian.event_id = event.id
        ORDER BY tanggal_pembelian DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pembelian Tiket</title>
</head>
<body>
    <h2> Data Pembelian Tiket</h2>
    <a href="index.php">Kembali ke Daftar Event</a> | 
    <a href="add.php">+ Tambah Pembelian</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama Pembeli</th>
            <th>Event</th>
            <th>Harga Tiket</th>
            <th>Jumlah Tiket</th>
            <th>Total Harga</th>
            <th>Tanggal Pembelian</th>
            <th>Aksi</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['nama_pembeli']); ?></td>
                    <td><?= htmlspecialchars($row['nama_event']); ?></td>
                    <td>Rp<?= number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td><?= $row['jumlah_tiket']; ?></td>
                    <td>Rp<?= number_format($row['harga'] * $row['jumlah_tiket'], 0, ',', '.'); ?></td>
                    <td><?= $row['tanggal_pembelian']; ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>">Edit</a> |
                        <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Hapus pembelian ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="8">Belum ada data pembelian.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
