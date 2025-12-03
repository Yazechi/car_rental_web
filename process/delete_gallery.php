<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses ditolak!'); window.location='../index.php';</script>";
    exit;
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    $q = mysqli_query($koneksi, "SELECT image FROM gallery_images WHERE id='$id'");
    $data = mysqli_fetch_array($q);
    
    if ($data && file_exists('../uploads/' . $data['image'])) {
        unlink('../uploads/' . $data['image']);
    }
    
    $sql = "DELETE FROM gallery_images WHERE id='$id'";
    
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Gambar berhasil dihapus!'); window.location='../index.php?page=content_manager';</script>";
    } else {
        echo "<script>alert('Gagal menghapus gambar!'); window.location='../index.php?page=content_manager';</script>";
    }
}
?>
