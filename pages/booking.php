<?php
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location='index.php';</script>";
    exit;
}

if (isset($_GET['car_id'])) {
    $car_id = mysqli_real_escape_string($koneksi, $_GET['car_id']);
    $q_car = mysqli_query($koneksi, "SELECT * FROM cars WHERE id='$car_id'");
    $car = mysqli_fetch_array($q_car);
    
    if (!$car) {
        echo "<script>alert('Mobil tidak ditemukan!'); window.location='index.php?page=produk';</script>";
        exit;
    }
} else {
    echo "<script>alert('Pilih mobil terlebih dahulu!'); window.location='index.php?page=produk';</script>";
    exit;
}
?>

<h3 class="mb-4"><i class="fas fa-clipboard-list"></i> Form Pemesanan Mobil</h3>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card">
            <img src="<?php 
                $img = 'https://placehold.co/400x250?text=No+Image';
                if ($car['gambar'] != '') {
                    if (file_exists("uploads/" . $car['gambar'])) $img = "uploads/" . $car['gambar'];
                    elseif (file_exists("assets/img/" . $car['gambar'])) $img = "assets/img/" . $car['gambar'];
                }
                echo $img;
            ?>" class="card-img-top" alt="<?= $car['nama_mobil']; ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $car['nama_mobil']; ?></h5>
                <p class="card-text"><span class="badge bg-secondary"><?= $car['jenis']; ?></span></p>
                <h4 class="text-primary">Rp <?= number_format($car['harga']); ?> / hari</h4>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="process/booking_process.php" method="POST" id="bookingForm">
                    <input type="hidden" name="car_id" value="<?= $car['id']; ?>">
                    <input type="hidden" name="harga_per_hari" value="<?= $car['harga']; ?>">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Mulai Sewa</label>
                            <input type="date" name="tanggal_mulai" id="tgl_mulai" class="form-control" required min="<?= date('Y-m-d'); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Selesai Sewa</label>
                            <input type="date" name="tanggal_selesai" id="tgl_selesai" class="form-control" required min="<?= date('Y-m-d'); ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Dengan Supir?</label>
                        <select name="dengan_supir" class="form-select">
                            <option value="tidak">Tidak (Lepas Kunci)</option>
                            <option value="ya">Ya (All In + Supir)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keperluan</label>
                        <select name="keperluan" class="form-select">
                            <option value="Wisata">Wisata</option>
                            <option value="Bisnis">Bisnis / Dinas</option>
                            <option value="Pernikahan">Pernikahan</option>
                            <option value="Antar Jemput">Antar Jemput Bandara</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan Tambahan (Opsional)</label>
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Contoh: Tolong diantar ke alamat..."></textarea>
                    </div>

                    <div class="alert alert-info">
                        <strong>Estimasi Durasi:</strong> <span id="durasi">-</span> hari<br>
                        <strong>Estimasi Total:</strong> Rp <span id="total">0</span>
                    </div>

                    <button type="submit" name="submit_booking" class="btn btn-primary btn-lg w-100"><i class="fas fa-check"></i> Pesan Sekarang</button>
                    <a href="index.php?page=produk" class="btn btn-secondary w-100 mt-2">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tglMulai = document.getElementById('tgl_mulai');
    const tglSelesai = document.getElementById('tgl_selesai');
    const hargaPerHari = <?= $car['harga']; ?>;
    
    function hitungTotal() {
        if (tglMulai.value && tglSelesai.value) {
            const start = new Date(tglMulai.value);
            const end = new Date(tglSelesai.value);
            const durasi = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
            
            if (durasi > 0) {
                const total = durasi * hargaPerHari;
                document.getElementById('durasi').textContent = durasi;
                document.getElementById('total').textContent = total.toLocaleString('id-ID');
            }
        }
    }
    
    tglMulai.addEventListener('change', function() {
        tglSelesai.min = this.value;
        hitungTotal();
    });
    
    tglSelesai.addEventListener('change', hitungTotal);
});
</script>
