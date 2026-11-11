<?php session_start(); if(isset($_SESSION['id_petugas'])) { header("Location: proses/auth_login.php?redirect=1"); exit; } ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - SMK Bakti 666</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light d-flex align-items-center" style="height:100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card-custom shadow-lg border-0 p-4">
                    <div class="text-center mb-4">
                        <i class="bi bi-box-seam-fill fs-1 text-primary"></i>
                        <h4 class="fw-bold mt-2">SMK BAKTI 666</h4>
                        <p class="text-muted small">Login Admin & Operator</p>
                    </div>
                    
                    <?php if(isset($_GET['error'])) echo "<div class='alert alert-danger py-2 text-center small border-0'>Username atau Password Salah!</div>"; ?>
                    
                    <form action="proses/auth_login.php" method="POST">
                        <div class="mb-3">
                            <label class="text-muted fw-semibold">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="text-muted fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">Masuk Sistem</button>
                    </form>

                    <hr class="my-4 text-muted">
                    
                    <div class="text-center">
                        <p class="text-muted small mb-2">Siswa / Peminjam?</p>
                        <a href="peminjam/peminjaman.php" class="btn btn-outline-primary w-100 py-2">
                            <i class="bi bi-person-walking me-2"></i> Masuk Kios Peminjaman
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>