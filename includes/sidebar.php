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
    <h5 class="border-bottom pb-2"><i class="fas fa-user-lock"></i> Area Staff</h5>

    <?php if (isset($_SESSION['user'])): ?>
        <div class="text-center">
            <div class="alert alert-success py-2">
                <small>Selamat Datang,</small><br>
                <strong><?= $_SESSION['nama_lengkap']; ?></strong>
            </div>
            <a href="index.php?page=admin" class="btn btn-primary w-100 mb-2"><i class="fas fa-cloud-upload-alt"></i> Upload Data</a>
            <a href="process/logout.php" class="btn btn-danger w-100" onclick="return confirm('Yakin ingin keluar?')">Sign Out</a>
        </div>
    <?php else: ?>
        <form action="process/login.php" method="POST">
            <div class="mb-2">
                <label class="form-label small">Username</label>
                <input type="text" name="username" class="form-control form-control-sm" required>
            </div>
            <div class="mb-2">
                <label class="form-label small">Password</label>
                <input type="password" name="password" class="form-control form-control-sm" required>
            </div>
            <div class="d-grid">
                <button type="submit" name="btn_login" class="btn btn-dark btn-sm">Sign In</button>
            </div>
        </form>
    <?php endif; ?>
</div>