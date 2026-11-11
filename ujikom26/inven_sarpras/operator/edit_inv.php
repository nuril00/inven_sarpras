<?php session_start(); require '../config/Database.php'; $db = new Database(); $koneksi = $db->koneksi;
if($_SESSION['level'] != 2) { header("Location: ../index.php"); exit; }
$stmt = $koneksi->prepare("SELECT * FROM inventaris WHERE id_inventaris = ?"); $stmt->execute([$_GET['id']]); $d = $stmt->fetch();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light">
    <?php include '../template/sidebar_operator.php'; ?>
    <div class="main-content">
        <?php include '../template/header.php'; ?>
        <div class="card-custom">
            <h5 class="mb-4">Edit Barang</h5>
            <form method="POST" action="../proses/admin_update_inv.php"> <!-- Pakai proses admin -->
                <input type="hidden" name="id" value="<?= $d['id_inventaris'] ?>">
                <div class="mb-3"><label class="text-muted fw-semibold">Nama Barang</label><input type="text" name="nama" class="form-control" value="<?= $d['nama'] ?>" required></div>
                <div class="mb-3"><label class="text-muted fw-semibold">Jumlah</label><input type="number" name="jumlah" class="form-control" value="<?= $d['jumlah'] ?>" required></div>
                <div class="mb-3"><label class="text-muted fw-semibold">Kondisi</label><input type="text" name="kondisi" class="form-control" value="<?= $d['kondisi'] ?>" required></div>
                <div class="mb-3"><label class="text-muted fw-semibold">Jenis</label><select name="id_jenis" class="form-select"><option value="1" <?= $d['id_jenis']==1?'selected':'' ?>>Elektronik</option><option value="2" <?= $d['id_jenis']==2?'selected':'' ?>>ATK</option></select></div>
                <div class="mb-4"><label class="text-muted fw-semibold">Ruang</label><select name="id_ruang" class="form-select"><option value="1" <?= $d['id_ruang']==1?'selected':'' ?>>Lab RPL</option><option value="2" <?= $d['id_ruang']==2?'selected':'' ?>>Ruang Guru</option></select></div>
                <button type="submit" name="update" class="btn btn-primary">Update Data</button>
                <a href="inventaris.php" class="btn btn-light ms-2">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>