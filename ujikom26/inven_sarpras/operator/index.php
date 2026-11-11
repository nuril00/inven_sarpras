<?php session_start(); require '../config/Database.php'; $db = new Database(); $koneksi = $db->koneksi;
if($_SESSION['level'] != 2) { header("Location: ../index.php"); exit; } ?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Operator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light">
    <?php include '../template/sidebar_operator.php'; ?>
    <div class="main-content">
        <?php include '../template/header.php'; ?>
        <div class="alert alert-primary border-0 shadow-sm rounded-4">Selamat datang di panel Operator.</div>
    </div>
</body>
</html>