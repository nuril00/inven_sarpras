<?php session_start(); require '../config/Database.php'; $db = new Database(); $koneksi = $db->koneksi;
if($_SESSION['level'] != 3) { header("Location: ../index.php"); exit; } ?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Peminjam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light">
    <?php include '../template/sidebar_peminjam.php'; ?>
    <div class="main-content">
        <?php include '../template/header.php'; ?>
        <div class="card-custom text-center py-5">
            <h4 class="fw-bold text-dark">Halo, <?= $_SESSION['nama'] ?>! 👋</h4>
            <p class="text-muted">Selamat datang di sistem peminjaman sarana sekolah.</p>
            <a href="peminjaman.php" class="btn btn-primary mt-3 rounded-pill px-4">Lihat / Ajukan Peminjaman</a>
        </div>
    </div>
</body>
</html>