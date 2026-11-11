<?php
$host = "localhost"; $user = "root"; $pass = "";
try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS db_uk_inventaris");
    $pdo->exec("USE db_uk_inventaris");

    $pdo->exec("CREATE TABLE IF NOT EXISTS level (id_level INT PRIMARY KEY AUTO_INCREMENT, nama_level VARCHAR(50))");
    $pdo->exec("CREATE TABLE IF NOT EXISTS petugas (id_petugas INT PRIMARY KEY AUTO_INCREMENT, username VARCHAR(50) UNIQUE, password VARCHAR(255), nama_petugas VARCHAR(100), id_level INT)");
    $pdo->exec("CREATE TABLE IF NOT EXISTS pegawai (id_pegawai INT PRIMARY KEY AUTO_INCREMENT, nama_pegawai VARCHAR(100), nip VARCHAR(20), alamat TEXT)");
    $pdo->exec("CREATE TABLE IF NOT EXISTS jenis (id_jenis INT PRIMARY KEY AUTO_INCREMENT, nama_jenis VARCHAR(50), kode_jenis VARCHAR(10), keterangan TEXT)");
    $pdo->exec("CREATE TABLE IF NOT EXISTS ruang (id_ruang INT PRIMARY KEY AUTO_INCREMENT, nama_ruang VARCHAR(50), kode_ruang VARCHAR(10), keterangan TEXT)");
    $pdo->exec("CREATE TABLE IF NOT EXISTS inventaris (id_inventaris INT PRIMARY KEY AUTO_INCREMENT, nama VARCHAR(100), kondisi VARCHAR(20), keterangan TEXT, jumlah INT, id_jenis INT, tanggal_register DATE, id_ruang INT, kode_inventaris VARCHAR(20), id_petugas INT)");
    $pdo->exec("CREATE TABLE IF NOT EXISTS peminjaman (id_peminjaman INT PRIMARY KEY AUTO_INCREMENT, tanggal_pinjam DATE, tanggal_kembali DATE, status_peminjaman VARCHAR(20), id_pegawai INT)");
    $pdo->exec("CREATE TABLE IF NOT EXISTS detail_pinjam (id_detail_pinjam INT PRIMARY KEY AUTO_INCREMENT, id_inventaris INT, jumlah INT, id_peminjaman INT)");

    $pdo->exec("DROP PROCEDURE IF EXISTS SP_Laporan_Inventaris");
    $pdo->exec("CREATE PROCEDURE SP_Laporan_Inventaris()
    BEGIN
        SELECT i.kode_inventaris, i.nama, i.kondisi, i.jumlah, j.nama_jenis, r.nama_ruang 
        FROM inventaris i JOIN jenis j ON i.id_jenis = j.id_jenis JOIN ruang r ON i.id_ruang = r.id_ruang;
    END");

    $cek = $pdo->query("SELECT COUNT(*) FROM level")->fetchColumn();
    if($cek == 0) {
        $pdo->exec("INSERT INTO level (nama_level) VALUES ('Administrator'), ('Operator'), ('Peminjam')");
        $stmt = $pdo->prepare("INSERT INTO petugas (username, password, nama_petugas, id_level) VALUES (?, ?, ?, ?)");
        $stmt->execute(['admin', password_hash('admin', PASSWORD_DEFAULT), 'Admin Utama', 1]);
        $stmt->execute(['operator', password_hash('operator', PASSWORD_DEFAULT), 'Operator Sekolah', 2]);
        $stmt->execute(['peminjam', password_hash('peminjam', PASSWORD_DEFAULT), 'Siswa Peminjam', 3]);

        $pdo->exec("INSERT INTO pegawai (nama_pegawai, nip) VALUES ('Siswa Peminjam', '12345')");
        $pdo->exec("INSERT INTO jenis (nama_jenis, kode_jenis) VALUES ('Elektronik', 'ELK'), ('ATK', 'ATK')");
        $pdo->exec("INSERT INTO ruang (nama_ruang, kode_ruang) VALUES ('Lab RPL', 'RPL'), ('Ruang Guru', 'RG')");
        $pdo->exec("INSERT INTO inventaris (nama, kondisi, jumlah, id_jenis, tanggal_register, id_ruang, kode_inventaris, id_petugas) VALUES ('Laptop Asus', 'Baik', 10, 1, '2026-01-01', 1, 'INV-001', 1)");
    }
    echo "<h2 style='color:green; text-align:center; margin-top:50px;'>✅ Setup Berhasil! <br><a href='index.php'>Ke Login</a></h2>";
} catch(PDOException $e) { die("Setup Gagal: " . $e->getMessage()); }
?>