<?php
require 'config/Database.php';
$db = new Database();
$koneksi = $db->koneksi;

try {
    // Hapus user lama agar tidak bentrok
    $koneksi->exec("DELETE FROM petugas");
    
    // Buat ulang password hash yang PASTI BENAR
    $pass_admin = password_hash('admin', PASSWORD_DEFAULT);
    $pass_op = password_hash('operator', PASSWORD_DEFAULT);
    $pass_pmj = password_hash('peminjam', PASSWORD_DEFAULT);

    $stmt = $koneksi->prepare("INSERT INTO petugas (username, password, nama_petugas, id_level) VALUES (?, ?, ?, ?)");
    
    // Masukkan 3 Akun
    $stmt->execute(['admin', $pass_admin, 'Admin Utama', 1]);
    $stmt->execute(['operator', $pass_op, 'Operator Sekolah', 2]);
    $stmt->execute(['peminjam', $pass_pmj, 'Siswa Peminjam', 3]);

    echo "<h2 style='color:green;'>✅ Password Berhasil Diperbaiki!</h2>";
    echo "<p>Silakan <a href='index.php'>Klik Disini untuk Login</a></p>";

} catch(PDOException $e) {
    die("Gagal: " . $e->getMessage());
}
?>