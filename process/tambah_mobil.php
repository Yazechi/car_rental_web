<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Akses Ditolak!'); window.location='../index.php';</script>";
    exit;
}

if (isset($_POST['submit_mobil'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_mobil']);
    $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $desk = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    $rand = rand();
    $filename = $_FILES['gambar']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($ext, ['png', 'jpg', 'jpeg', 'webp'])) {
        echo "<script>alert('Format file harus PNG, JPG, atau JPEG'); window.history.back();</script>";
        exit;
    }

    $xx = $rand . '_' . $filename;
    move_uploaded_file($_FILES['gambar']['tmp_name'], '../uploads/' . $xx);

    $query = mysqli_query($koneksi, "INSERT INTO cars (nama_mobil, jenis, harga, deskripsi, gambar) VALUES ('$nama', '$jenis', '$harga', '$desk', '$xx')");
    
    if ($query) {
        echo "<script>alert('Data mobil berhasil ditambahkan!'); window.location='../index.php?page=admin';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data mobil!'); window.location='../index.php?page=admin';</script>";
    }
}
?>