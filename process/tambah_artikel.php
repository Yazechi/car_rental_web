<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Akses Ditolak!'); window.location='../index.php';</script>";
    exit;
}

if (isset($_POST['submit_artikel'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $isi = mysqli_real_escape_string($koneksi, $_POST['isi']);
    $tanggal = date('Y-m-d');

    $rand = rand();
    $filename = $_FILES['gambar']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($ext, ['png', 'jpg', 'jpeg', 'webp'])) {
        echo "<script>alert('Format file harus PNG, JPG, atau JPEG'); window.history.back();</script>";
        exit;
    }

    $xx = $rand . '_' . $filename;
    move_uploaded_file($_FILES['gambar']['tmp_name'], '../uploads/' . $xx);

    $query = mysqli_query($koneksi, "INSERT INTO articles (judul, isi, gambar, tanggal) VALUES ('$judul', '$isi', '$xx', '$tanggal')");

    if ($query) {
        echo "<script>alert('Artikel berhasil ditambahkan!'); window.location='../index.php?page=admin';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan artikel!'); window.location='../index.php?page=admin';</script>";
    }
}
?>