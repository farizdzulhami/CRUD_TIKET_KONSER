<?php
include 'config.php';


$event_result = $conn->query("SELECT * FROM event");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Event Konser</title>
</head>
<body>
    <h2> Daftar Event Konser</h2>
    <a href="pembelian.php">Lihat Data Pembelian</a>
    <br><br>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama Event</th>
            <th>Harga Tiket</th>
        </tr>
        <?php while ($event = $event_result->fetch_assoc()): ?>
            <tr>
                <td><?= $event['id']; ?></td>
                <td><?= htmlspecialchars($event['nama_event']); ?></td>
                <td>Rp<?= number_format($event['harga'], 0, ',', '.'); ?></td>
            </tr>
  
        <?php endwhile; ?>
    </table>
</body>
</html>
