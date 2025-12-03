<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Akses Ditolak!'); window.location='../index.php';</script>";
    exit;
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    $get_gambar = mysqli_query($koneksi, "SELECT gambar FROM cars WHERE id='$id'");
    $data = mysqli_fetch_array($get_gambar);
    
    if ($data && $data['gambar'] != '') {
        $file_path = '../uploads/' . $data['gambar'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }
    
    $query = mysqli_query($koneksi, "DELETE FROM cars WHERE id='$id'");
    
    if ($query) {
        echo "<script>alert('Data mobil berhasil dihapus!'); window.location='../index.php?page=admin';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location='../index.php?page=admin';</script>";
    }
} else {
    echo "<script>window.location='../index.php?page=admin';</script>";
}
?>
