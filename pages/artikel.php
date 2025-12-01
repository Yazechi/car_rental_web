<?php
if (!isset($_GET['id'])) {
    echo "<div class='alert alert-warning'>ID artikel tidak ditemukan.</div>";
    exit;
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$query = mysqli_query($koneksi, "SELECT * FROM articles WHERE id='$id'");
$data = mysqli_fetch_array($query);

if ($data) {
?>
    <h2 class="mb-2"><?= $data['judul']; ?></h2>
    <span class="badge bg-secondary mb-4"><i class="far fa-calendar-alt"></i> <?= $data['tanggal']; ?></span>
    <img src="assets/img/setir_mobil_article.png" class="img-fluid rounded mb-4 w-100">
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