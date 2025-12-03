<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Akses Ditolak!'); window.location='../index.php';</script>";
    exit;
}

if (isset($_POST['edit_mobil'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_mobil']);
    $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $desk = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    
    $gambar_lama = $_POST['gambar_lama'];
    $gambar_baru = $gambar_lama;
    
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $rand = rand();
        $filename = $_FILES['gambar']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        if (in_array($ext, ['png', 'jpg', 'jpeg', 'webp'])) {
            $gambar_baru = $rand . '_' . $filename;
            move_uploaded_file($_FILES['gambar']['tmp_name'], '../uploads/' . $gambar_baru);
            
            if ($gambar_lama != '' && file_exists('../uploads/' . $gambar_lama)) {
                unlink('../uploads/' . $gambar_lama);
            }
        }
    }
    
    $query = mysqli_query($koneksi, "UPDATE cars SET nama_mobil='$nama', jenis='$jenis', harga='$harga', deskripsi='$desk', gambar='$gambar_baru' WHERE id='$id'");
    
    if ($query) {
        echo "<script>alert('Data mobil berhasil diupdate!'); window.location='../index.php?page=admin';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data!'); window.location='../index.php?page=admin';</script>";
    }
}
?>
