<?php require 'config/Database.php'; $db = new Database(); $koneksi = $db->koneksi; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="height:100vh;">
    <div class="container"><div class="row justify-content-center"><div class="col-md-4">
        <div class="card shadow border-0 p-4">
            <h4 class="text-center fw-bold mb-3">Daftar Peminjam</h4>
            <form action="proses/auth_register.php" method="POST">
                <div class="mb-3"><label>Nama Lengkap</label><input type="text" name="nama" class="form-control" required></div>
                <div class="mb-3"><label>Username</label><input type="text" name="username" class="form-control" required></div>
                <div class="mb-4"><label>Password</label><input type="password" name="password" class="form-control" required></div>
                <button type="submit" class="btn btn-primary w-100">Daftar</button>
            </form>
        </div>
    </div></div></div>
</body>
</html>