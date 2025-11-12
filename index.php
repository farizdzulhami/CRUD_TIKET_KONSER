<?php
include 'config.php';
$event_result = $conn->query("SELECT * FROM event");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Event Konser</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2> Daftar Event Konser</h2>
        <div style="text-align:center; margin-bottom:20px;">
            <a href="pembelian.php" class="btn"> Lihat Data Pembelian</a>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>Nama Event</th>
                <th>Harga Tiket</th>
            </tr>
            <?php if ($event_result->num_rows > 0): ?>
                <?php while ($event = $event_result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $event['id']; ?></td>
                        <td><?= htmlspecialchars($event['nama_event']); ?></td>
                        <td>Rp<?= number_format($event['harga'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="3">Belum ada event yang tersedia.</td></tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
