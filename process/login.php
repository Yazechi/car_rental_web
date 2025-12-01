<?php
session_start();
include '../config/database.php';

if (isset($_POST['btn_login'])) {
    $user = mysqli_real_escape_string($koneksi, $_POST['username']);
    $pass = md5($_POST['password']);

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$user' AND password='$pass'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['user'] = $user;
        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
        $_SESSION['status'] = 'login';
        echo "<script>alert('Login Berhasil!'); window.location='../index.php?page=admin';</script>";
    } else {
        echo "<script>alert('Username atau Password Salah!'); window.location='../index.php';</script>";
    }
}
?>