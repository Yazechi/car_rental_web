<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses ditolak!'); window.location='../index.php';</script>";
    exit;
}

if (isset($_POST['add_gallery'])) {
    $title = mysqli_real_escape_string($koneksi, $_POST['title']);
    $desc = mysqli_real_escape_string($koneksi, $_POST['description']);
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $rand = rand();
        $filename = $_FILES['image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        if (in_array($ext, ['png', 'jpg', 'jpeg', 'webp'])) {
            $new_name = $rand . '_' . $filename;
            move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $new_name);
            
            $sql = "INSERT INTO gallery_images (title, image, description) VALUES ('$title', '$new_name', '$desc')";
            
            if (mysqli_query($koneksi, $sql)) {
                echo "<script>alert('Gambar berhasil ditambahkan!'); window.location='../index.php?page=content_manager';</script>";
            } else {
                echo "<script>alert('Gagal menambahkan gambar!'); window.location='../index.php?page=content_manager';</script>";
            }
        }
    }
}
?>
