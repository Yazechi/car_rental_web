<?php
function get_content($key, $default = '') {
    global $koneksi;
    $key = mysqli_real_escape_string($koneksi, $key);
    $q = mysqli_query($koneksi, "SELECT content FROM content_pages WHERE page_key='$key'");
    if ($q && mysqli_num_rows($q) > 0) {
        $data = mysqli_fetch_array($q);
        return $data['content'];
    }
    return $default;
}

function get_gallery_images() {
    global $koneksi;
    $images = [];
    $q = mysqli_query($koneksi, "SELECT * FROM gallery_images ORDER BY urutan ASC");
    while ($row = mysqli_fetch_array($q)) {
        $images[] = $row;
    }
    return $images;
}
?>
