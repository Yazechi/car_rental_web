<?php
session_start();

include '../config/database.php';

if(isset($_POST['btn_login'])){
    $user = mysqli_real_escape_string($koneksi, $_POST['username']);
    $pass = md5($_POST['password']);

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$user' AND password='$pass'");

    if (mysqli_num_rows($query) > 0){
        $data = mysqli_fetch_assoc($query);

        $_SESSION['user_id'] = $data['id'];
        $_SESSION['user'] = $data['username'];
        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
        $_SESSION['role'] = $data['role'];

        // Simpan log login
        $uid = $data['id'];
        $username = $data['username'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $user_agent = mysqli_real_escape_string($koneksi, $_SERVER['HTTP_USER_AGENT']);
        
        mysqli_query($koneksi, "INSERT INTO login_logs (user_id, username, ip_address, user_agent) 
                                VALUES ('$uid', '$username', '$ip', '$user_agent')");

        echo "<script>alert('Login berhasil sebagai ".$data['role']."!'); window.location='../index.php';</script>";
    } else {
        echo "<script>alert('Username atau Password Salah!'); window.location='../index.php';</script>";
    }
}
?>