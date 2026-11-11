<?php
session_start(); require '../config/Database.php'; $db = new Database(); $koneksi = $db->koneksi;
if($_SESSION['level'] != 1 && $_SESSION['level'] != 2) exit;

if(isset($_POST['update'])) {
    $stmt = $koneksi->prepare("UPDATE inventaris SET nama=?, kondisi=?, jumlah=?, id_jenis=?, id_ruang=? WHERE id_inventaris=?");
    $stmt->execute([$_POST['nama'], $_POST['kondisi'], $_POST['jumlah'], $_POST['id_jenis'], $_POST['id_ruang'], $_POST['id']]);
    header("Location: ../" . ($_SESSION['level'] == 1 ? "admin" : "operator") . "/inventaris.php");
}
?>