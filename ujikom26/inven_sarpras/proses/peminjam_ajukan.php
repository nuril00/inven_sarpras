<?php
require '../config/Database.php'; 
$db = new Database(); 
$koneksi = $db->koneksi;

if(isset($_POST['ajukan'])) {
    $nama_peminjam = trim($_POST['nama_peminjam']);
    $id_inventaris = $_POST['id_inventaris'];
    $jumlah = $_POST['jumlah'];

    // 1. CEK SISA STOK DI DATABASE
    $stmt_stok = $koneksi->prepare("SELECT jumlah FROM inventaris WHERE id_inventaris = ?");
    $stmt_stok->execute([$id_inventaris]);
    $stok_sekarang = $stmt_stok->fetchColumn();

    if($jumlah > $stok_sekarang) {
        echo "<script>
                alert('GAGAL: Jumlah yang Anda minta ($jumlah) melebihi sisa stok ($stok_sekarang)!');
                window.location = '../peminjam/peminjaman.php';
              </script>";
        exit;
    }

    // 2. CEK APAKAH NAMA INI SUDAH ADA
    $stmt_cek = $koneksi->prepare("SELECT id_pegawai FROM pegawai WHERE nama_pegawai = ?");
    $stmt_cek->execute([$nama_peminjam]);
    $pg = $stmt_cek->fetch();

    if($pg) {
        $id_pegawai = $pg['id_pegawai'];
    } else {
        $stmt_insert_pg = $koneksi->prepare("INSERT INTO pegawai (nama_pegawai, nip) VALUES (?, '000')");
        $stmt_insert_pg->execute([$nama_peminjam]);
        $id_pegawai = $koneksi->lastInsertId();
    }

    // 3. SIMPAN TRANSAKSI
    $koneksi->beginTransaction();
    try {
        $stmt1 = $koneksi->prepare("INSERT INTO peminjaman (tanggal_pinjam, status_peminjaman, id_pegawai) VALUES (CURDATE(), 'Menunggu', ?)");
        $stmt1->execute([$id_pegawai]);
        $id_peminjaman = $koneksi->lastInsertId();

        $stmt2 = $koneksi->prepare("INSERT INTO detail_pinjam (id_inventaris, jumlah, id_peminjaman) VALUES (?, ?, ?)");
        $stmt2->execute([$id_inventaris, $jumlah, $id_peminjaman]);
        
        $koneksi->commit();
        echo "<script>
                alert('Pengajuan Berhasil!');
                window.location = '../peminjam/peminjaman.php';
              </script>";
    } catch (Exception $e) {
        $koneksi->rollBack();
        echo "<script>alert('Gagal: " . $e->getMessage() . "'); window.location = '../peminjam/peminjaman.php';</script>";
    }
}
?>