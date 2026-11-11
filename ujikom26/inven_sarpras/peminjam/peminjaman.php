<?php 
require '../config/Database.php'; 
$db = new Database(); 
$koneksi = $db->koneksi; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kios Peminjaman - SMK Bakti 666</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#"><i class="bi bi-box-seam-fill me-2"></i> Kios Peminjaman SMK BAKTI 666</a>
            <a href="../index.php" class="btn btn-sm btn-outline-secondary rounded-pill">Login Petugas</a>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card-custom">
                    <h5 class="mb-4">Form Peminjaman</h5>
                    <form method="POST" action="../proses/peminjam_ajukan.php">
                        <div class="mb-3">
                            <label class="text-muted fw-semibold">Nama Lengkap Siswa</label>
                            <input type="text" name="nama_peminjam" class="form-control" placeholder="Ketik nama Anda..." required>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted fw-semibold">Pilih Barang</label>
                            <!-- Tambahkan id="id_inventaris" dan onchange="updateMax()" -->
                            <select name="id_inventaris" id="id_inventaris" class="form-select" required onchange="updateMax()">
                                <?php 
                                $b = $koneksi->query("SELECT * FROM inventaris"); 
                                while($br = $b->fetch()) {
                                    // Simpan sisa stok di atribut data-stok
                                    echo "<option value='{$br['id_inventaris']}' data-stok='{$br['jumlah']}'>{$br['nama']} (Sisa: {$br['jumlah']})</option>"; 
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="text-muted fw-semibold">Jumlah Pinjam</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" required min="1" value="1">
                        </div>
                        <small id="info_stok" class="text-danger fw-semibold d-block mb-4"></small>
                        
                        <button type="submit" name="ajukan" class="btn btn-primary w-100 py-2">
                            <i class="bi bi-send me-2"></i> Kirim Pengajuan
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card-custom">
                    <h5 class="mb-4">Status Peminjaman Terbaru</h5>
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr><th>Tanggal</th><th>Nama Peminjam</th><th>Barang</th><th>Jumlah</th><th>Status</th></tr>
                            </thead>
                            <tbody>
                                <?php
                                $q = $koneksi->query("SELECT p.*, pg.nama_pegawai, i.nama, d.jumlah FROM peminjaman p JOIN pegawai pg ON p.id_pegawai = pg.id_pegawai JOIN detail_pinjam d ON p.id_peminjaman = d.id_peminjaman JOIN inventaris i ON d.id_inventaris = i.id_inventaris ORDER BY p.id_peminjaman DESC LIMIT 10");
                                while($row = $q->fetch()) {
                                    $badge = $row['status_peminjaman'] == 'Menunggu' ? 'badge-soft-warning' : ($row['status_peminjaman'] == 'Dipinjam' ? 'badge-soft-primary' : 'badge-soft-success');
                                    echo "<tr>
                                        <td>".date('d M Y', strtotime($row['tanggal_pinjam']))."</td>
                                        <td><b>".$row['nama_pegawai']."</b></td>
                                        <td>".$row['nama']."</td>
                                        <td>".$row['jumlah']."</td>
                                        <td><span class='$badge'>".$row['status_peminjaman']."</span></td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SCRIPT JS UNTUK MEMBATASI INPUT -->
    <script>
        function updateMax() {
            var select = document.getElementById('id_inventaris');
            var stok = select.options[select.selectedIndex].getAttribute('data-stok');
            var inputJumlah = document.getElementById('jumlah');
            var infoStok = document.getElementById('info_stok');
            
            // Set nilai maksimal yang bisa diketik
            inputJumlah.max = stok;
            infoStok.innerText = "Maksimal yang bisa dipinjam: " + stok + " unit";
            
            // Jika angka saat ini lebih besar dari stok, reset ke stok
            if(parseInt(inputJumlah.value) > parseInt(stok)) {
                inputJumlah.value = stok;
            }
        }
        // Jalankan saat halaman pertama kali dibuka
        window.onload = updateMax;
    </script>
</body>
</html>