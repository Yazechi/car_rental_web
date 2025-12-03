<?php
if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses ditolak! Hanya admin yang bisa mengakses halaman ini.'); window.location='index.php';</script>";
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="fas fa-edit"></i> Kelola Konten Website</h3>
    <a href="index.php?page=admin" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<div class="alert alert-info">
    <i class="fas fa-info-circle"></i> <strong>Info:</strong> Kelola semua konten website dari halaman ini tanpa perlu edit source code.
</div>

<ul class="nav nav-tabs mb-4" id="contentTab" role="tablist">
    <li class="nav-item">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-content" type="button">Home</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="about-tab" data-bs-toggle="tab" data-bs-target="#about-content" type="button">About</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="visi-tab" data-bs-toggle="tab" data-bs-target="#visi-content" type="button">Visi & Misi</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-content" type="button">Kontak</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery-content" type="button">Gallery</button>
    </li>
</ul>

<div class="tab-content" id="contentTabContent">
    <div class="tab-pane fade show active" id="home-content">
        <form action="process/update_content.php" method="POST">
            <input type="hidden" name="section" value="home">
            <?php
            $home_keys = ['home_welcome_title', 'home_welcome_subtitle', 'home_welcome_desc'];
            foreach ($home_keys as $key) {
                $q = mysqli_query($koneksi, "SELECT * FROM content_pages WHERE page_key='$key'");
                $data = mysqli_fetch_array($q);
            ?>
                <div class="mb-3">
                    <label class="form-label fw-bold"><?= $data['page_title']; ?></label>
                    <?php if ($key == 'home_welcome_desc'): ?>
                        <textarea name="<?= $key; ?>" class="form-control" rows="4"><?= $data['content']; ?></textarea>
                    <?php else: ?>
                        <input type="text" name="<?= $key; ?>" class="form-control" value="<?= $data['content']; ?>">
                    <?php endif; ?>
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan Home</button>
        </form>
    </div>

    <div class="tab-pane fade" id="about-content">
        <form action="process/update_content.php" method="POST">
            <input type="hidden" name="section" value="about">
            <?php
            $q = mysqli_query($koneksi, "SELECT * FROM content_pages WHERE page_key='about_history'");
            $data = mysqli_fetch_array($q);
            ?>
            <div class="mb-3">
                <label class="form-label fw-bold"><?= $data['page_title']; ?></label>
                <textarea name="about_history" class="form-control" rows="8"><?= $data['content']; ?></textarea>
                <small class="text-muted">Tips: Gunakan &lt;strong&gt;teks&lt;/strong&gt; untuk bold, \n untuk baris baru</small>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan About</button>
        </form>
    </div>

    <div class="tab-pane fade" id="visi-content">
        <form action="process/update_content.php" method="POST">
            <input type="hidden" name="section" value="visi">
            <?php
            $q_visi = mysqli_query($koneksi, "SELECT * FROM content_pages WHERE page_key='visi_text'");
            $visi = mysqli_fetch_array($q_visi);
            $q_misi = mysqli_query($koneksi, "SELECT * FROM content_pages WHERE page_key='misi_text'");
            $misi = mysqli_fetch_array($q_misi);
            ?>
            <div class="mb-3">
                <label class="form-label fw-bold"><?= $visi['page_title']; ?></label>
                <textarea name="visi_text" class="form-control" rows="4"><?= $visi['content']; ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold"><?= $misi['page_title']; ?></label>
                <textarea name="misi_text" class="form-control" rows="8"><?= $misi['content']; ?></textarea>
                <small class="text-muted">Pisahkan setiap poin dengan simbol | (pipe)</small>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan Visi & Misi</button>
        </form>
    </div>

    <div class="tab-pane fade" id="contact-content">
        <form action="process/update_content.php" method="POST">
            <input type="hidden" name="section" value="contact">
            <?php
            $contact_keys = ['contact_office', 'contact_phone', 'contact_whatsapp', 'contact_email'];
            foreach ($contact_keys as $key) {
                $q = mysqli_query($koneksi, "SELECT * FROM content_pages WHERE page_key='$key'");
                $data = mysqli_fetch_array($q);
            ?>
                <div class="mb-3">
                    <label class="form-label fw-bold"><?= $data['page_title']; ?></label>
                    <?php if ($key == 'contact_office'): ?>
                        <textarea name="<?= $key; ?>" class="form-control" rows="3"><?= $data['content']; ?></textarea>
                    <?php else: ?>
                        <input type="text" name="<?= $key; ?>" class="form-control" value="<?= $data['content']; ?>">
                    <?php endif; ?>
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan Kontak</button>
        </form>
    </div>

    <div class="tab-pane fade" id="gallery-content">
        <h5 class="mb-3">Kelola Gambar Gallery</h5>
        <form action="process/add_gallery.php" method="POST" enctype="multipart/form-data" class="mb-4 p-3 bg-light rounded">
            <h6>Tambah Gambar Baru</h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">File Gambar</label>
                    <input type="file" name="image" class="form-control" required accept="image/*">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <input type="text" name="description" class="form-control">
            </div>
            <button type="submit" name="add_gallery" class="btn btn-success"><i class="fas fa-plus"></i> Tambah</button>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q_gal = mysqli_query($koneksi, "SELECT * FROM gallery_images ORDER BY urutan ASC");
                    while ($gal = mysqli_fetch_array($q_gal)) {
                        $img_path = file_exists("assets/img/" . $gal['image']) ? "assets/img/" . $gal['image'] : "uploads/" . $gal['image'];
                    ?>
                        <tr>
                            <td><img src="<?= $img_path; ?>" width="80" class="img-thumbnail"></td>
                            <td><?= $gal['title']; ?></td>
                            <td><?= $gal['description']; ?></td>
                            <td>
                                <a href="process/delete_gallery.php?id=<?= $gal['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus gambar ini?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
