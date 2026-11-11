<?php session_start(); require '../config/Database.php'; $db = new Database(); $koneksi = $db->koneksi;
if($_SESSION['level'] != 1) { header("Location: ../index.php"); exit; } 
$total_barang = $koneksi->query("SELECT SUM(jumlah) FROM inventaris")->fetchColumn() ?? 0;
$total_pinjam = $koneksi->query("SELECT COUNT(*) FROM peminjaman WHERE status_peminjaman = 'Dipinjam'")->fetchColumn() ?? 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light">
    <?php include '../template/sidebar_admin.php'; ?>
    <div class="main-content">
        <?php include '../template/header.php'; ?>
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card-custom">
                    <h6 class="text-muted fw-bold">Total Inventaris</h6>
                    <h2 class="fw-bold text-dark"><?= $total_barang ?> <span class="fs-6 fw-normal">Unit</span></h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-custom">
                    <h6 class="text-muted fw-bold">Barang Dipinjam</h6>
                    <h2 class="fw-bold text-primary"><?= $total_pinjam ?> <span class="fs-6 fw-normal">Transaksi</span></h2>
                </div>
            </div>
        </div>
    </div>
</body>
</html>