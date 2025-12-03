<?php
if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses Ditolak! Halaman ini khusus Admin.'); window.location='index.php';</script>";
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="fas fa-user-shield"></i> Administrator Dashboard</h3>
    <span class="badge bg-danger">Mode: Super Admin</span>
</div>

<div class="alert alert-warning">
    <i class="fas fa-tools"></i> <strong>Quick Access:</strong> 
    <a href="index.php?page=content_manager" class="btn btn-sm btn-primary ms-2"><i class="fas fa-edit"></i> Kelola Konten Website</a>
</div>

<ul class="nav nav-tabs" id="adminTab" role="tablist">
    <li class="nav-item">
        <button class="nav-link active" id="booking-tab" data-bs-toggle="tab" data-bs-target="#booking" type="button"><i class="fas fa-clipboard-list"></i> Kelola Pesanan</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="list-tab" data-bs-toggle="tab" data-bs-target="#list" type="button"><i class="fas fa-list"></i> Data Mobil</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="add-mobil-tab" data-bs-toggle="tab" data-bs-target="#add-mobil" type="button"><i class="fas fa-plus-circle"></i> Tambah Mobil</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="list-artikel-tab" data-bs-toggle="tab" data-bs-target="#list-artikel" type="button"><i class="fas fa-newspaper"></i> Data Artikel</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="add-artikel-tab" data-bs-toggle="tab" data-bs-target="#add-artikel" type="button"><i class="fas fa-plus-circle"></i> Tambah Artikel</button>
    </li>
</ul>

<div class="tab-content bg-white border border-top-0 p-4 shadow-sm" id="adminTabContent">

    <div class="tab-pane fade show active" id="booking">
        <h5 class="mb-3">Kelola Pemesanan</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Mobil</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>Durasi</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q_book = mysqli_query($koneksi, "SELECT b.*, u.nama_lengkap, c.nama_mobil FROM bookings b 
                                                       JOIN users u ON b.user_id = u.id 
                                                       JOIN cars c ON b.car_id = c.id 
                                                       ORDER BY b.id DESC");
                    while ($book = mysqli_fetch_array($q_book)) {
                    ?>
                        <tr>
                            <td><?= $book['id']; ?></td>
                            <td><?= $book['nama_lengkap']; ?></td>
                            <td><?= $book['nama_mobil']; ?></td>
                            <td><?= date('d/m/Y', strtotime($book['tanggal_mulai'])); ?></td>
                            <td><?= date('d/m/Y', strtotime($book['tanggal_selesai'])); ?></td>
                            <td><?= $book['durasi_hari']; ?> hari</td>
                            <td>Rp <?= number_format($book['total_harga']); ?></td>
                            <td>
                                <?php
                                $badge_map = ['pending' => 'warning', 'disetujui' => 'success', 'ditolak' => 'danger', 'selesai' => 'info'];
                                $badge = $badge_map[$book['status']] ?? 'secondary';
                                ?>
                                <span class="badge bg-<?= $badge; ?>"><?= ucfirst($book['status']); ?></span>
                            </td>
                            <td>
                                <?php if ($book['status'] == 'pending'): ?>
                                    <a href="process/update_booking.php?id=<?= $book['id']; ?>&status=disetujui" class="btn btn-sm btn-success" onclick="return confirm('Setujui pesanan ini?')">Setujui</a>
                                    <a href="process/update_booking.php?id=<?= $book['id']; ?>&status=ditolak" class="btn btn-sm btn-danger" onclick="return confirm('Tolak pesanan ini?')">Tolak</a>
                                <?php elseif ($book['status'] == 'disetujui'): ?>
                                    <a href="process/update_booking.php?id=<?= $book['id']; ?>&status=selesai" class="btn btn-sm btn-info" onclick="return confirm('Tandai selesai?')">Selesai</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-pane fade" id="list">
        <h5 class="mb-3">Daftar Armada</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $q = mysqli_query($koneksi, "SELECT * FROM cars ORDER BY id DESC");
                    while ($row = mysqli_fetch_array($q)) {
                        // Cek gambar
                        $img_display = "assets/img/avanza.png";
                        if (!empty($row['gambar'])) {
                            if (file_exists("uploads/" . $row['gambar'])) {
                                $img_display = "uploads/" . $row['gambar'];
                            } elseif (file_exists("assets/img/" . $row['gambar'])) {
                                $img_display = "assets/img/" . $row['gambar'];
                            }
                        }
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><img src="<?= $img_display; ?>" width="60" class="img-thumbnail"></td>
                            <td><?= $row['nama_mobil']; ?> <br><small class="text-muted"><?= $row['jenis']; ?></small></td>
                            <td>Rp <?= number_format($row['harga']); ?> <br><small class="text-muted">/ 12 jam</small></td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id']; ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <a href="process/hapus_mobil.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus mobil <?= $row['nama_mobil']; ?>?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal<?= $row['id']; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="process/edit_mobil.php" method="POST" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Mobil: <?= $row['nama_mobil']; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                            <input type="hidden" name="gambar_lama" value="<?= $row['gambar']; ?>">
                                            
                                            <div class="mb-3">
                                                <label>Nama Mobil</label>
                                                <input type="text" name="nama_mobil" class="form-control" value="<?= $row['nama_mobil']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Jenis</label>
                                                <select name="jenis" class="form-select">
                                                    <option <?= $row['jenis'] == 'MPV' ? 'selected' : ''; ?>>MPV</option>
                                                    <option <?= $row['jenis'] == 'SUV' ? 'selected' : ''; ?>>SUV</option>
                                                    <option <?= $row['jenis'] == 'City Car' ? 'selected' : ''; ?>>City Car</option>
                                                    <option <?= $row['jenis'] == 'Luxury' ? 'selected' : ''; ?>>Luxury</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label>Harga (per 12 jam)</label>
                                                <input type="number" name="harga" class="form-control" value="<?= $row['harga']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Foto Saat Ini</label><br>
                                                <img src="<?= $img_display; ?>" width="150" class="img-thumbnail mb-2">
                                                <input type="file" name="gambar" class="form-control">
                                                <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
                                            </div>
                                            <div class="mb-3">
                                                <label>Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control" rows="3"><?= $row['deskripsi']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" name="submit_edit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-pane fade" id="add-mobil">
        <form action="process/tambah_mobil.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3"><label>Nama Mobil</label><input type="text" name="nama_mobil" class="form-control" required></div>
            <div class="mb-3"><label>Jenis</label><select name="jenis" class="form-select">
                    <option>MPV</option>
                    <option>SUV</option>
                    <option>City Car</option>
                    <option>Luxury</option>
                </select></div>
            <div class="mb-3"><label>Harga</label><input type="number" name="harga" class="form-control" required></div>
            <div class="mb-3"><label>Foto</label><input type="file" name="gambar" class="form-control" required></div>
            <div class="mb-3"><label>Deskripsi</label><textarea name="deskripsi" class="form-control"></textarea></div>
            <button type="submit" name="submit_mobil" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <div class="tab-pane fade" id="list-artikel">
        <h5 class="mb-3">Daftar Artikel</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $q_artikel = mysqli_query($koneksi, "SELECT * FROM articles ORDER BY id DESC");
                    while ($artikel = mysqli_fetch_array($q_artikel)) {
                        // Cek gambar artikel
                        $img_artikel = "assets/img/slider1.jpg";
                        if (!empty($artikel['gambar'])) {
                            if (file_exists("uploads/" . $artikel['gambar'])) {
                                $img_artikel = "uploads/" . $artikel['gambar'];
                            } elseif (file_exists("assets/img/" . $artikel['gambar'])) {
                                $img_artikel = "assets/img/" . $artikel['gambar'];
                            }
                        }
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><img src="<?= $img_artikel; ?>" width="80" class="img-thumbnail"></td>
                            <td><?= $artikel['judul']; ?></td>
                            <td><?= date('d/m/Y', strtotime($artikel['tanggal'])); ?></td>
                            <td>
                                <a href="process/hapus_artikel.php?id=<?= $artikel['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus artikel ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-pane fade" id="add-mobil">
        <h5 class="mb-4"><i class="fas fa-plus-circle"></i> Tambah Mobil Baru</h5>
        <form action="process/tambah_mobil.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Mobil</label>
                    <input type="text" name="nama_mobil" class="form-control" placeholder="Contoh: Toyota Avanza" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jenis</label>
                    <select name="jenis" class="form-select">
                        <option>MPV</option>
                        <option>SUV</option>
                        <option>City Car</option>
                        <option>Luxury</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga (per 12 jam)</label>
                    <input type="number" name="harga" class="form-control" placeholder="350000" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Foto Mobil</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" placeholder="Contoh: Kapasitas 7 orang, AC Double Blower, Irit BBM"></textarea>
            </div>
            <button type="submit" name="submit_mobil" class="btn btn-primary btn-lg">
                <i class="fas fa-save"></i> Simpan Data Mobil
            </button>
        </form>
    </div>

    <div class="tab-pane fade" id="add-artikel">
        <h5 class="mb-4"><i class="fas fa-newspaper"></i> Tambah Artikel Baru</h5>
        <form action="process/tambah_artikel.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Judul Artikel</label>
                <input type="text" name="judul" class="form-control" placeholder="Judul artikel..." required>
            </div>
            <div class="mb-3">
                <label class="form-label">Gambar Artikel</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Isi Artikel</label>
                <textarea name="isi" class="form-control" rows="8" placeholder="Tulis konten artikel di sini..."></textarea>
            </div>
            <button type="submit" name="submit_artikel" class="btn btn-success btn-lg">
                <i class="fas fa-paper-plane"></i> Terbitkan Artikel
            </button>
        </form>
    </div>
</div>