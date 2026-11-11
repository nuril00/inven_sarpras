<?php session_start(); require '../config/Database.php'; $db = new Database(); $koneksi = $db->koneksi;
if($_SESSION['level'] != 1) { header("Location: ../index.php"); exit; } ?>
<!DOCTYPE html>
<html>
<head>
    <title>Inventaris</title>
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
                <h5 class="mb-0">Data Inventaris</h5>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="bi bi-plus-lg"></i> Tambah</button>
            </div>
            <div class="table-responsive">
                <table class="table table-custom">
                    <thead><tr><th>Kode</th><th>Nama</th><th>Jenis</th><th>Ruang</th><th>Jumlah</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <?php
                        $q = $koneksi->query("SELECT i.*, j.nama_jenis, r.nama_ruang FROM inventaris i JOIN jenis j ON i.id_jenis = j.id_jenis JOIN ruang r ON i.id_ruang = r.id_ruang");
                        while($row = $q->fetch()) {
                            echo "<tr>
                                <td><span class='badge-soft-primary'>{$row['kode_inventaris']}</span></td>
                                <td><b>{$row['nama']}</b></td><td>{$row['nama_jenis']}</td><td>{$row['nama_ruang']}</td><td>{$row['jumlah']}</td>
                                <td>
                                    <a href='edit_inv.php?id={$row['id_inventaris']}' class='btn btn-sm btn-light text-warning rounded-circle'><i class='bi bi-pencil-square'></i></a>
                                    <a href='../proses/admin_hapus_inv.php?id={$row['id_inventaris']}' class='btn btn-sm btn-light text-danger rounded-circle' onclick='return confirm(\"Hapus?\")'><i class='bi bi-trash'></i></a>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah"><div class="modal-dialog modal-dialog-centered"><div class="modal-content">
        <div class="modal-header"><h5 class="modal-title fw-bold">Tambah Barang</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <form method="POST" action="../proses/admin_tambah_inv.php">
            <div class="modal-body">
                <div class="mb-3"><label class="text-muted fw-semibold">Kode</label><input type="text" name="kode" class="form-control" required></div>
                <div class="mb-3"><label class="text-muted fw-semibold">Nama</label><input type="text" name="nama" class="form-control" required></div>
                <div class="mb-3"><label class="text-muted fw-semibold">Jumlah</label><input type="number" name="jumlah" class="form-control" required></div>
                <div class="mb-3"><label class="text-muted fw-semibold">Kondisi</label><select name="kondisi" class="form-select"><option>Baik</option><option>Rusak</option></select></div>
                <div class="mb-3"><label class="text-muted fw-semibold">Jenis</label><select name="id_jenis" class="form-select"><option value="1">Elektronik</option><option value="2">ATK</option></select></div>
                <div class="mb-3"><label class="text-muted fw-semibold">Ruang</label><select name="id_ruang" class="form-select"><option value="1">Lab RPL</option><option value="2">Ruang Guru</option></select></div>
            </div>
            <div class="modal-footer"><button type="submit" name="tambah" class="btn btn-primary w-100">Simpan Data</button></div>
        </form>
    </div></div></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>