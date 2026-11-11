<?php
session_start();
require '../config/Database.php';
$db = new Database(); 
$koneksi = $db->koneksi;

if(isset($_POST['username'])) {
    // Gunakan trim() untuk menghapus spasi tidak sengaja di awal/akhir
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $koneksi->prepare("SELECT * FROM petugas WHERE username = ?");
    $stmt->execute([$username]);
    $data = $stmt->fetch();

    // Jika user ditemukan dan password cocok
    if($data && $password == $data['password']) {
        
        // Simpan data ke session
        $_SESSION['id_petugas'] = $data['id_petugas'];
        $_SESSION['nama'] = $data['nama_petugas'];
        $_SESSION['level'] = $data['id_level'];
        
        // Arahkan sesuai role (1=Admin, 2=Operator, 3=Peminjam)
        if($data['id_level'] == 1) {
            header("Location: ../admin/index.php");
            exit;
        } elseif($data['id_level'] == 2) {
            header("Location: ../operator/index.php");
            exit;
        } else {
            header("Location: ../peminjam/index.php");
            exit;
        }

    } else {
        // Jika gagal, kembalikan ke halaman login dengan pesan error
        echo "<script>
                alert('Username atau Password Salah! Pastikan huruf besar/kecilnya sesuai.');
                window.location='../index.php';
              </script>";
    }
} else {
    header("Location: ../index.php");
}
?>