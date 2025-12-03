<div class="sidebar-box">
    <h5 class="border-bottom pb-2"><i class="fas fa-user-circle"></i> Area User</h5>

    <?php if (isset($_SESSION['user'])): ?>
        <div class="text-center mb-3">
            <div class="alert alert-success py-2">
                Halo, <strong><?= $_SESSION['nama_lengkap']; ?></strong><br>
                <span class="badge bg-<?= $_SESSION['role'] == 'admin' ? 'danger' : 'primary'; ?>"><?= ucfirst($_SESSION['role']); ?></span>
            </div>

            <?php if ($_SESSION['role'] == 'admin'): ?>
                <a href="index.php?page=admin" class="btn btn-danger w-100 mb-2"><i class="fas fa-cogs"></i> Panel Admin</a>
                <a href="index.php?page=content_manager" class="btn btn-warning w-100 mb-2"><i class="fas fa-edit"></i> Edit Konten</a>
            <?php endif; ?>

            <a href="index.php?page=produk" class="btn btn-primary w-100 mb-2"><i class="fas fa-car"></i> Lihat Mobil</a>
            <a href="index.php?page=history" class="btn btn-info w-100 mb-2 text-white"><i class="fas fa-history"></i> Riwayat & Log</a>
            <a href="process/logout.php" class="btn btn-secondary w-100">Logout</a>
        </div>
    <?php else: ?>
    <?php endif; ?>
</div>

<div class="sidebar-box">
    <h5 class="border-bottom pb-2"><i class="fas fa-newspaper"></i> Artikel Terbaru</h5>

    <div class="accordion accordion-flush" id="accordionArtikel">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#listArtikel">
                    Baca Tips & Berita
                </button>
            </h2>
            <div id="listArtikel" class="accordion-collapse collapse" data-bs-parent="#accordionArtikel">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <?php
                        $sql_art = mysqli_query($koneksi, "SELECT * FROM articles ORDER BY id DESC LIMIT 5");
                        while ($art = mysqli_fetch_array($sql_art)) {
                            echo "<a href='index.php?page=artikel&id=" . $art['id'] . "' class='list-group-item list-group-item-action font-small'>" . $art['judul'] . "</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="sidebar-box">
    <h5 class="border-bottom pb-2"><i class="fas fa-images"></i> Menu Cepat</h5>
    <a href="index.php?page=klien" class="btn btn-outline-dark w-100 mb-2">Klien Kami</a>
    <a href="index.php?page=gallery" class="btn btn-outline-secondary w-100">Galeri Event</a>
</div>

<div class="sidebar-box">
    <h5 class="border-bottom pb-2"><i class="fas fa-user-lock"></i> Login / Daftar</h5>

    <?php if (!isset($_SESSION['user'])): ?>
        <form action="process/login.php" method="POST">
            <div class="mb-2">
                <label class="form-label small">Username</label>
                <input type="text" name="username" class="form-control form-control-sm" required>
            </div>
            <div class="mb-2">
                <label class="form-label small">Password</label>
                <input type="password" name="password" class="form-control form-control-sm" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" name="btn_login" class="btn btn-dark btn-sm">Sign In</button>
                <a href="index.php?page=register" class="btn btn-outline-primary btn-sm">Daftar</a>
            </div>
        </form>
    <?php endif; ?>
</div>