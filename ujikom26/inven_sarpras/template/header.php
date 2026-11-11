<div class="navbar-top">
    <div>
        <h4 class="fw-bold mb-1 text-dark">Good Morning, <?= $_SESSION['nama'] ?>! 👋</h4>
        <p class="text-muted mb-0" style="font-size: 0.9rem;">Welcome back to Inventory System.</p>
    </div>
    <div class="d-flex align-items-center gap-3">
        <div class="bg-white rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; border: 1px solid #e2e8f0;">
            <i class="bi bi-search text-muted"></i>
        </div>
        <div class="d-flex align-items-center bg-white px-2 py-2 rounded-pill shadow-sm border">
            <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['nama']) ?>&background=0ea5e9&color=fff" class="rounded-circle me-2" width="35">
            <span class="fw-bold pe-3" style="font-size: 0.9rem;"><?= $_SESSION['nama'] ?></span>
        </div>
    </div>
</div>