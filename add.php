<?php
include 'config.php';


$event_result = $conn->query("SELECT * FROM event");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pembeli = $_POST['nama_pembeli'];
    $event_id = $_POST['event_id'];
    $jumlah_tiket = $_POST['jumlah_tiket'];

    $stmt = $conn->prepare("INSERT INTO pembelian (nama_pembeli, event_id, jumlah_tiket) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $nama_pembeli, $event_id, $jumlah_tiket);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pembelian</title>
</head>
<body>
    <h2>Tambah Pembelian Tiket</h2>
    <form method="post" action="">
        <label>Nama Pembeli:</label><br>
        <input type="text" name="nama_pembeli" required><br><br>

        <label>Event:</label><br>
        <select name="event_id" required>
            <option value="">-- Pilih Event --</option>
            <?php while ($event = $event_result->fetch_assoc()): ?>
                <option value="<?= $event['id']; ?>">
                    <?= $event['nama_event']; ?> - Rp<?= number_format($event['harga'], 0, ',', '.'); ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Jumlah Tiket:</label><br>
        <input type="number" name="jumlah_tiket" min="1" required><br><br>

        <button type="submit">Simpan</button>
    </form>
    <br>
    <a href="index.php">Kembali</a>
</body>
</html>
