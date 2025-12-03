<?php
session_start();
include '../config/database.php';

if (isset($_POST['btn_register'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $user = mysqli_real_escape_string($koneksi, $_POST['username']);
    $pass = $_POST['password'];
    $konf = $_POST['konfirmasi_password'];

    if ($pass !== $konf) {
        echo "<script>alert('Konfirmasi Password tidak cocok!'); window.history.back();</script>";
        exit;
    }

    $cek_user = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$user'");
    if (mysqli_num_rows($cek_user) > 0) {
        echo "<script>alert('Username sudah digunakan, pilih yang lain!'); window.history.back();</script>";
        exit;
    }

    $pass_hash = md5($pass); 

    $query_simpan = mysqli_query($koneksi, "INSERT INTO users (username, password, nama_lengkap) VALUES ('$user', '$pass_hash', '$nama')");

    if ($query_simpan) {
        echo "<script>alert('Registrasi Berhasil! Silahkan Login.'); window.location='../index.php';</script>";
    } else {
        echo "<script>alert('Gagal Mendaftar: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
    }
}
