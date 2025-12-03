<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses ditolak!'); window.location='../index.php';</script>";
    exit;
}

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $status = mysqli_real_escape_string($koneksi, $_GET['status']);
    
    $allowed_status = ['disetujui', 'ditolak', 'selesai', 'dibatalkan'];
    
    if (in_array($status, $allowed_status)) {
        $sql = "UPDATE bookings SET status='$status' WHERE id='$id'";
        
        if (mysqli_query($koneksi, $sql)) {
            echo "<script>alert('Status booking berhasil diupdate!'); window.location='../index.php?page=admin';</script>";
        } else {
            echo "<script>alert('Gagal mengupdate status!'); window.location='../index.php?page=admin';</script>";
        }
    }
}
?>
