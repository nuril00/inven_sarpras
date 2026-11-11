<?php
session_start(); require '../config/Database.php'; $db = new Database(); $koneksi = $db->koneksi;
if($_SESSION['level'] != 1) exit; // Hanya admin yang bisa hapus
$stmt = $koneksi->prepare("DELETE FROM inventaris WHERE id_inventaris = ?");
$stmt->execute([$_GET['id']]);
header("Location: ../admin/inventaris.php");
?>