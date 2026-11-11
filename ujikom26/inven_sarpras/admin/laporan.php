<?php session_start(); require '../config/Database.php'; $db = new Database(); $koneksi = $db->koneksi;
if($_SESSION['level'] != 1) { header("Location: ../index.php"); exit; } ?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light">
    <?php include '../template/sidebar_admin.php'; ?>
    <div class="main-content">
        <?php include '../template/header.php'; ?>
        <div class="card-custom">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">Laporan Data Inventaris</h5>
                <button onclick="window.print()" class="btn btn-outline-primary rounded-pill px-4"><i class="bi bi-printer me-2"></i> Cetak PDF</button>
            </div>
            <div class="table-responsive">
                <table class="table table-custom">
                    <thead><tr><th>No</th><th>Kode</th><th>Nama</th><th>Jenis</th><th>Ruang</th><th>Jumlah</th><th>Kondisi</th></tr></thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $stmt = $koneksi->query("CALL SP_Laporan_Inventaris()");
                        while($row = $stmt->fetch()) {
                            echo "<tr>
                                <td>".$no++."</td>
                                <td><span class='badge-soft-primary'>".$row['kode_inventaris']."</span></td>
                                <td><b>".$row['nama']."</b></td><td>".$row['nama_jenis']."</td><td>".$row['nama_ruang']."</td><td>".$row['jumlah']."</td>
                                <td><span class='badge-soft-success'>".$row['kondisi']."</span></td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>