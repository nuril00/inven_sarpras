<?php $page = basename($_SERVER['PHP_SELF']); ?>
<div class="sidebar">
    <div class="sidebar-brand">
        <i class="bi bi-box-seam-fill fs-4 text-primary"></i> <span>SMK BAKTI 666</span>
    </div>
    <ul class="sidebar-menu">
        <li><a href="index.php" class="<?= ($page == 'index.php') ? 'active' : '' ?>"><i class="bi bi-grid-1x2"></i> Dashboard</a></li>
        <li><a href="inventaris.php" class="<?= ($page == 'inventaris.php' || $page == 'edit_inv.php') ? 'active' : '' ?>"><i class="bi bi-box"></i> Inventaris</a></li>
        <li><a href="peminjaman.php" class="<?= ($page == 'peminjaman.php') ? 'active' : '' ?>"><i class="bi bi-arrow-left-right"></i> Peminjaman</a></li>
        <li><a href="pengembalian.php" class="<?= ($page == 'pengembalian.php') ? 'active' : '' ?>"><i class="bi bi-check2-circle"></i> Pengembalian</a></li>
        <li><a href="laporan.php" class="<?= ($page == 'laporan.php') ? 'active' : '' ?>"><i class="bi bi-file-earmark-bar-graph"></i> Laporan</a></li>
    </ul>
    <div style="position: absolute; bottom: 20px; width: calc(100% - 40px);">
        <a href="../logout.php" class="text-danger fw-bold text-decoration-none d-flex align-items-center p-3" style="background: #fef2f2; border-radius: 12px;">
            <i class="bi bi-box-arrow-right me-2 fs-5"></i> Logout
        </a>
    </div>
</div>