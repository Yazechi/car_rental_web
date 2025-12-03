<?php
session_start();
include '../config/database.php';

if(!isset($_SESSION['user_id'])){
    echo "<script>alert('Silahkan login untuk memesan!'); window.location='../index.php';</script>";
    exit;
}

// Proses dari form booking online (POST)
if (isset($_POST['submit_booking'])) {
    $user_id = $_SESSION['user_id'];
    $car_id = mysqli_real_escape_string($koneksi, $_POST['car_id']);
    $tanggal_mulai = mysqli_real_escape_string($koneksi, $_POST['tanggal_mulai']);
    $tanggal_selesai = mysqli_real_escape_string($koneksi, $_POST['tanggal_selesai']);
    $dengan_supir = mysqli_real_escape_string($koneksi, $_POST['dengan_supir']);
    $keperluan = mysqli_real_escape_string($koneksi, $_POST['keperluan']);
    $catatan = mysqli_real_escape_string($koneksi, $_POST['catatan']);
    $harga_per_hari = mysqli_real_escape_string($koneksi, $_POST['harga_per_hari']);
    
    // Hitung durasi
    $start = strtotime($tanggal_mulai);
    $end = strtotime($tanggal_selesai);
    $durasi_hari = ceil(($end - $start) / (60 * 60 * 24));
    
    if ($durasi_hari < 1) {
        echo "<script>alert('Durasi sewa minimal 1 hari!'); window.history.back();</script>";
        exit;
    }
    
    // Hitung total harga
    $total_harga = $durasi_hari * $harga_per_hari;
    
    // Ambil nama mobil untuk WhatsApp
    $q_car = mysqli_query($koneksi, "SELECT nama_mobil FROM cars WHERE id='$car_id'");
    $car = mysqli_fetch_assoc($q_car);
    $car_name = $car['nama_mobil'];
    
    // Insert ke database
    $insert = mysqli_query($koneksi, "INSERT INTO bookings 
                                      (user_id, car_id, tanggal_mulai, tanggal_selesai, durasi_hari, total_harga, dengan_supir, keperluan, catatan, status) 
                                      VALUES 
                                      ('$user_id', '$car_id', '$tanggal_mulai', '$tanggal_selesai', '$durasi_hari', '$total_harga', '$dengan_supir', '$keperluan', '$catatan', 'pending')");
    
    if ($insert) {
        $booking_id = mysqli_insert_id($koneksi);
        
        // Format pesan WhatsApp
        $user_nama = $_SESSION['nama_lengkap'];
        $wa_text = "*BOOKING MOBIL RENTAL*%0A%0A";
        $wa_text .= "Nama: $user_nama%0A";
        $wa_text .= "Mobil: $car_name%0A";
        $wa_text .= "Tanggal Mulai: " . date('d/m/Y', strtotime($tanggal_mulai)) . "%0A";
        $wa_text .= "Tanggal Selesai: " . date('d/m/Y', strtotime($tanggal_selesai)) . "%0A";
        $wa_text .= "Durasi: $durasi_hari hari%0A";
        $wa_text .= "Dengan Supir: " . ucfirst($dengan_supir) . "%0A";
        $wa_text .= "Keperluan: $keperluan%0A";
        if (!empty($catatan)) {
            $wa_text .= "Catatan: $catatan%0A";
        }
        $wa_text .= "Total Estimasi: Rp " . number_format($total_harga, 0, ',', '.') . "%0A%0A";
        $wa_text .= "ID Booking: #$booking_id";
        
        $wa_url = "https://wa.me/6287812312632?text=$wa_text";
        header("Location: $wa_url");
    } else {
        echo "<script>alert('Gagal menyimpan data booking: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
    }
}
// Proses dari tombol WhatsApp langsung (GET) - untuk backward compatibility
elseif (isset($_GET['car_id']) && isset($_GET['car_name'])) {
    $user_id = $_SESSION['user_id'];
    $car_id = $_GET['car_id'];
    $car_name = $_GET['car_name'];
    $tanggal = date('Y-m-d');

    mysqli_query($koneksi, "INSERT INTO bookings (user_id, car_id, tanggal_mulai, tanggal_selesai, durasi_hari, total_harga, status) 
                            VALUES ('$user_id', '$car_id', '$tanggal', '$tanggal', 1, 0, 'pending')");

    $wa_url = "https://wa.me/6287812312632?text=Halo%20saya%20mau%20booking%20mobil%20$car_name";
    header("Location: $wa_url");
}
else {
    echo "<script>alert('Data tidak lengkap!'); window.location='../index.php?page=produk';</script>";
}
?>