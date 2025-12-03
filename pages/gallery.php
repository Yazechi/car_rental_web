<h2 class="border-start border-5 ps-3 mb-4" style="border-color: #667eea !important;">Galeri & Dokumentasi</h2>
<p class="text-muted mb-4">Momen-momen terbaik bersama pelanggan kami. Dari perjalanan wisata hingga layanan VVIP.</p>

<div class="row g-3">
    <?php
    $gallery = get_gallery_images();
    foreach ($gallery as $img) {
        $img_path = file_exists("assets/img/" . $img['image']) ? "assets/img/" . $img['image'] : "uploads/" . $img['image'];
    ?>
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-sm">
                <img src="<?= $img_path; ?>" class="card-img-top" alt="<?= $img['title']; ?>">
                <div class="card-body">
                    <p class="card-text small text-center"><?= $img['description']; ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
</div>