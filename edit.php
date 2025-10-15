<?php
include 'config.php';


if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM pembelian WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Data tidak ditemukan.";
    exit;
}

$data = $result->fetch_assoc();

$events = $conn->query("SELECT * FROM event");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pembeli = $_POST['nama_pembeli'];
    $event_id = $_POST['event_id'];
    $jumlah_tiket = $_POST['jumlah_tiket'];

    $stmt = $conn->prepare("UPDATE pembelian SET nama_pembeli = ?, event_id = ?, jumlah_tiket = ? WHERE id = ?");
    $stmt->bind_param("siii", $nama_pembeli, $event_id, $jumlah_tiket, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal update data: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pembelian Tiket</title>
</head>
<body>
    <h2>Edit Pembelian Tiket</h2>
    <form method="post" action="">
        <label>Nama Pembeli:</label><br>
        <input type="text" name="nama_pembeli" value="<?= htmlspecialchars($data['nama_pembeli']); ?>" required><br><br>

        <label>Event:</label><br>
        <select name="event_id" required>
            <option value="">-- Pilih Event --</option>
            <?php while ($event = $events->fetch_assoc()): ?>
                <option value="<?= $event['id']; ?>" <?= ($event['id'] == $data['event_id']) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($event['nama_event']); ?> - Rp<?= number_format($event['harga'], 0, ',', '.'); ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Jumlah Tiket:</label><br>
        <input type="number" name="jumlah_tiket" value="<?= $data['jumlah_tiket']; ?>" min="1" required><br><br>

        <button type="submit">Update</button>
    </form>
    <br>
    <a href="index.php">Kembali</a>
</body>
</html>
