<?php
session_start();
include 'config/database.php';
include 'includes/functions.php';
include 'includes/header.php';
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <?php include 'includes/sidebar.php'; ?>
        </div>

        <div class="col-md-9">
            <div class="content-box">
                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 'home';
                $allowed_pages = ['home', 'about', 'visi', 'produk', 'gallery', 'kontak', 'klien', 'artikel', 'admin', 'register', 'history', 'user_dashboard', 'booking', 'content_manager'];
                
                if (in_array($page, $allowed_pages)) {
                    $file = "pages/" . $page . ".php";
                    if (file_exists($file)) {
                        include $file;
                    } else {
                        echo "<div class='alert alert-danger'><h3>404</h3><p>Halaman tidak ditemukan.</p></div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'><h3>403</h3><p>Akses ditolak.</p></div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>