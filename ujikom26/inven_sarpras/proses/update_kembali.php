<?php
session_start(); 
require '../config/Database.php'; 
$db = new Database(); 
$koneksi = $db->koneksi;

if($_SESSION['level'] != 1 && $_SESSION['level'] != 2) exit;

$id_peminjaman = $_GET['id'];

// Cari tahu barang apa dan berapa jumlah yang dikembalikan
$stmt = $koneksi->prepare("SELECT id_inventaris, jumlah FROM detail_pinjam WHERE id_peminjaman = ?");
$stmt->execute([$id_peminjaman]);
$detail = $stmt->fetch();

if($detail) {
    $koneksi->beginTransaction();
    try {
        // 1. Kembalikan stok ke tabel inventaris
        $stmt_stok = $koneksi->prepare("UPDATE inventaris SET jumlah = jumlah + ? WHERE id_inventaris = ?");
        $stmt_stok->execute([$detail['jumlah'], $detail['id_inventaris']]);

        // 2. Ubah status jadi Dikembalikan & catat tanggalnya
        $stmt_status = $koneksi->prepare("UPDATE peminjaman SET status_peminjaman = 'Dikembalikan', tanggal_kembali = CURDATE() WHERE id_peminjaman = ?");
        $stmt_status->execute([$id_peminjaman]);

        $koneksi->commit();
    } catch(Exception $e) {
        $koneksi->rollBack();
        die("Error: " . $e->getMessage());
    }
}

header("Location: ../" . ($_SESSION['level'] == 1 ? "admin" : "operator") . "/pengembalian.php");
?>