<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses ditolak!'); window.location='../index.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $section = $_POST['section'];
    $user_id = $_SESSION['user_id'];
    
    unset($_POST['section']);
    
    $success = true;
    foreach ($_POST as $key => $value) {
        $key_safe = mysqli_real_escape_string($koneksi, $key);
        $value_safe = mysqli_real_escape_string($koneksi, $value);
        
        $sql = "UPDATE content_pages SET content='$value_safe', updated_by='$user_id' WHERE page_key='$key_safe'";
        if (!mysqli_query($koneksi, $sql)) {
            $success = false;
            break;
        }
    }
    
    if ($success) {
        echo "<script>alert('Konten berhasil diupdate!'); window.location='../index.php?page=content_manager';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate konten!'); window.location='../index.php?page=content_manager';</script>";
    }
}
?>
