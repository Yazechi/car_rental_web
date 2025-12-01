<?php
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Akses Ditolak! Silahkan Login.'); window.location='index.php';</script>";
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="fas fa-tachometer-alt"></i> Dashboard Admin</h3>
    <span class="badge bg-success p-2">Status: Online</span>
</div>

<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="upload-tab" data-bs-toggle="tab" data-bs-target="#upload" type="button">Upload File</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type="button">Data Mobil</button>
            </li>
        </ul>

        <div class="tab-content bg-white border border-top-0 p-4" id="myTabContent">
            <div class="tab-pane fade show active" id="upload">
                <h5 class="mb-3">Form Upload Informasi</h5>
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Judul Artikel / Nama File</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori" class="form-select">
                                <option>Artikel Berita</option>
                                <option>Promo Terbaru</option>
                                <option>Dokumen Perusahaan</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File Gambar/PDF</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Singkat</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-cloud-upload-alt"></i> Simpan Data</button>
                </form>
            </div>

            <div class="tab-pane fade" id="data">
                <h5 class="mb-3">Database Armada</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Mobil</th>
                                <th>Jenis</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Toyota Avanza</td>
                                <td>MPV</td>
                                <td>Rp 350.000</td>
                                <td><a href="#" class="btn btn-sm btn-warning">Edit</a> <a href="#" class="btn btn-sm btn-danger">Hapus</a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Honda Brio</td>
                                <td>City Car</td>
                                <td>Rp 300.000</td>
                                <td><a href="#" class="btn btn-sm btn-warning">Edit</a> <a href="#" class="btn btn-sm btn-danger">Hapus</a></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Toyota Alphard</td>
                                <td>Luxury</td>
                                <td>Rp 2.500.000</td>
                                <td><a href="#" class="btn btn-sm btn-warning">Edit</a> <a href="#" class="btn btn-sm btn-danger">Hapus</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>