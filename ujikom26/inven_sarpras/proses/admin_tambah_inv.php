<?php
session_start(); require '../config/Database.php'; $db = new Database(); $koneksi = $db->koneksi;
if($_SESSION['level'] != 1 && $_SESSION['level'] != 2) exit;

if(isset($_POST['tambah'])) {
    $stmt = $koneksi->prepare("INSERT INTO inventaris (nama, kondisi, jumlah, id_jenis, id_ruang, tanggal_register, kode_inventaris, id_petugas) VALUES (?, ?, ?, ?, ?, CURDATE(), ?, ?)");
    $stmt->execute([$_POST['nama'], $_POST['kondisi'], $_POST['jumlah'], $_POST['id_jenis'], $_POST['id_ruang'], $_POST['kode'], $_SESSION['id_petugas']]);
    header("Location: ../" . ($_SESSION['level'] == 1 ? "admin" : "operator") . "/inventaris.php");
}
?>