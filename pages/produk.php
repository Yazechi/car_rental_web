<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <h2 class="fw-bold" style="color: #667eea;">Armada & Harga Sewa</h2>
    <span class="badge bg-warning text-dark">Update: <?= date('F Y'); ?></span>
</div>

<div class="row g-4">
    <?php
    $query_mobil = mysqli_query($koneksi, "SELECT * FROM cars");
    
    if (!$query_mobil) {
        echo '<div class="col-12"><div class="alert alert-danger">Error: ' . mysqli_error($koneksi) . '</div></div>';
    } elseif (mysqli_num_rows($query_mobil) == 0) {
        echo '<div class="col-12"><div class="alert alert-info">Belum ada data mobil tersedia.</div></div>';
    }
    
    while ($mobil = mysqli_fetch_array($query_mobil)) {
        // Logika Gambar dengan 3 tier fallback
        $img_src = "assets/img/avanza.png"; // Default fallback
        
        // Tier 1: Cek gambar dari folder uploads (untuk mobil baru yang diupload)
        if (!empty($mobil['gambar']) && file_exists("uploads/" . $mobil['gambar'])) {
            $img_src = "uploads/" . $mobil['gambar'];
        }
        // Tier 2: Cek gambar dari folder assets/img (untuk gambar default/existing)
        elseif (!empty($mobil['gambar']) && file_exists("assets/img/" . $mobil['gambar'])) {
            $img_src = "assets/img/" . $mobil['gambar'];
        }
        // Tier 3: Gunakan gambar default berdasarkan nama mobil
        else {
            $nama_lower = strtolower($mobil['nama_mobil']);
            if (strpos($nama_lower, 'avanza') !== false) {
                $img_src = "assets/img/avanza.png";
            } elseif (strpos($nama_lower, 'brio') !== false) {
                $img_src = "assets/img/brio.png";
            } elseif (strpos($nama_lower, 'alphard') !== false) {
                $img_src = "assets/img/alphard.png";
            } elseif (strpos($nama_lower, 'fortuner') !== false) {
                $img_src = "assets/img/fortuner.png";
            } elseif (strpos($nama_lower, 'lexus') !== false) {
                $img_src = "assets/img/lexus.jpeg";
            }
        }
    ?>
        <div class="col-lg-6">
            <div class="card h-100 shadow-sm border-0 car-card">
                <div class="position-relative">
                    <img src="<?= $img_src; ?>" class="card-img-top" alt="<?= $mobil['nama_mobil']; ?>" style="height: 250px; object-fit: cover;">
                    <span class="position-absolute top-0 end-0 bg-danger text-white px-3 py-1 m-2 rounded-pill fw-bold">Ready</span>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="card-title fw-bold mb-0"><?= $mobil['nama_mobil']; ?></h4>
                        <span class="badge bg-secondary"><?= $mobil['jenis']; ?></span>
                    </div>

                    <h3 class="text-primary fw-bold my-3">Rp <?= number_format($mobil['harga'], 0, ',', '.'); ?> <small class="text-muted fs-6 fw-normal">/ 12 jam</small></h3>
                    <p class="card-text text-muted small"><?= $mobil['deskripsi']; ?></p>

                    <div class="d-grid gap-2">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="process/booking_process.php?car_id=<?= $mobil['id']; ?>&car_name=<?= urlencode($mobil['nama_mobil']); ?>" class="btn btn-success fw-bold">
                                <i class="fab fa-whatsapp"></i> Booking Sekarang
                            </a>
                            <a href="index.php?page=booking&car_id=<?= $mobil['id']; ?>" class="btn btn-primary fw-bold">
                                <i class="fas fa-calendar-check"></i> Booking Online
                            </a>
                        <?php else: ?>
                            <button onclick="alert('Silahkan Login atau Daftar akun terlebih dahulu untuk memesan!')" class="btn btn-secondary fw-bold">
                                <i class="fas fa-lock"></i> Login untuk Memesan
                            </button>
                        <?php endif; ?>

                        <a href="index.php?page=kontak" class="btn btn-outline-dark">Hubungi Kantor</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>