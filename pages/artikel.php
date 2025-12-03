<?php
if (!isset($_GET['id'])) {
    echo "<div class='alert alert-warning'>ID artikel tidak ditemukan.</div>";
    exit;
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$query = mysqli_query($koneksi, "SELECT * FROM articles WHERE id='$id'");
$data = mysqli_fetch_array($query);

if ($data) {
    $img_art = "assets/img/setir_mobil_article.png";
    
    if ($data['gambar'] != '') {
        if (file_exists("uploads/" . $data['gambar'])) {
            $img_art = "uploads/" . $data['gambar'];
        } elseif (file_exists("assets/img/" . $data['gambar'])) {
            $img_art = "assets/img/" . $data['gambar'];
        }
    }
?>
    <h2 class="mb-2"><?= $data['judul']; ?></h2>
    <span class="badge bg-secondary mb-4"><i class="far fa-calendar-alt"></i> <?= date('d M Y', strtotime($data['tanggal'])); ?></span>
    <img src="<?= $img_art; ?>" class="img-fluid rounded mb-4 w-100" style="max-height: 400px; object-fit: cover;">
    <div class="article-content">
        <p><?= nl2br($data['isi']); ?></p>
    </div>
    <hr>
    <a href="index.php" class="btn btn-outline-dark">&laquo; Kembali ke Home</a>
<?php
} else {
    echo "<div class='alert alert-warning'>Artikel tidak ditemukan.</div>";
}
?>