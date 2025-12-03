<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'rental_db2';

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}

mysqli_set_charset($koneksi, 'utf8');

function getContent($koneksi, $page, $section){
    $q = mysqli_query($koneksi, "SELECT content_text FROM page_contents WHERE page_name='$page' AND section_name='$section'");
    if(mysqli_num_rows($q) > 0){
        $d = mysqli_fetch_assoc($q);
        return $d['content_text'];
    }
    return "Konten belum diisi admin.";
}
?>