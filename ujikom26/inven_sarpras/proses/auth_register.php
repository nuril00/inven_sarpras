<?php
require '../config/Database.php';
$db = new Database(); $koneksi = $db->koneksi;
if(isset($_POST['username'])) {
    $stmt = $koneksi->prepare("INSERT INTO petugas (username, password, nama_petugas, id_level) VALUES (?, ?, ?, 3)");
    $stmt->execute([$_POST['username'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['nama']]);
    
    $stmt2 = $koneksi->prepare("INSERT INTO pegawai (nama_pegawai, nip) VALUES (?, '000')");
    $stmt2->execute([$_POST['nama']]);
    
    echo "<script>alert('Registrasi Berhasil!'); window.location='../index.php';</script>";
}
?>