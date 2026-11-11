<?php session_start(); require '../config/Database.php'; $db = new Database(); $koneksi = $db->koneksi;
if($_SESSION['level'] != 2) { header("Location: ../index.php"); exit; } ?>
<!DOCTYPE html>
<html>
<head>
    <title>Pengembalian Operator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light">
    <?php include '../template/sidebar_operator.php'; ?>
    <div class="main-content">
        <?php include '../template/header.php'; ?>
        <div class="card-custom">
            <h5 class="mb-4">Pengembalian Barang</h5>
            <div class="table-responsive">
                <table class="table table-custom">
                    <thead><tr><th>Tanggal</th><th>Peminjam</th><th>Barang</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <?php
                        $q = $koneksi->query("SELECT p.*, pg.nama_pegawai, i.nama, d.jumlah FROM peminjaman p JOIN pegawai pg ON p.id_pegawai = pg.id_pegawai JOIN detail_pinjam d ON p.id_peminjaman = d.id_peminjaman JOIN inventaris i ON d.id_inventaris = i.id_inventaris WHERE p.status_peminjaman = 'Dipinjam'");
                        while($row = $q->fetch()) {
                            echo "<tr>
                                <td>".date('d M Y', strtotime($row['tanggal_pinjam']))."</td>
                                <td><div class='d-flex align-items-center gap-2'><img src='https://ui-avatars.com/api/?name=".urlencode($row['nama_pegawai'])."&background=f1f5f9&color=334155' class='rounded-circle' width='30'><b>".$row['nama_pegawai']."</b></div></td>
                                <td>".$row['nama']." (".$row['jumlah'].")</td>
                                <td><span class='badge-soft-primary'>Dipinjam</span></td>
                                <td><a href='../proses/update_kembali.php?id=".$row['id_peminjaman']."' class='btn btn-sm btn-success rounded-pill px-3'>Kembalikan</a></td>
                            </tr>";
                        } if($q->rowCount() == 0) echo "<tr><td colspan='5' class='text-center text-muted py-4'>Tidak ada barang yang sedang dipinjam.</td></tr>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>