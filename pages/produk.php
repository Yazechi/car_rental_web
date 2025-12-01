<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <h2 class="fw-bold" style="color: #667eea;">Armada & Harga Sewa</h2>
    <span class="badge bg-warning text-dark">Update: <?= date('F Y'); ?></span>
</div>

<div class="alert alert-info d-flex align-items-center" role="alert">
    <i class="fas fa-info-circle fa-2x me-3"></i>
    <div>
        <strong>Catatan:</strong> Harga dibawah ini adalah untuk pemakaian Dalam Kota (12 Jam). Untuk Luar Kota atau Drop Off, silahkan hubungi CS kami.
    </div>
</div>

<div class="row g-4">
    <?php
    $query_mobil = mysqli_query($koneksi, "SELECT * FROM cars");
    $car_images = ['avanza.png', 'brio.png', 'alphard.png'];
    $img_index = 0;
    
    while ($mobil = mysqli_fetch_array($query_mobil)) {
        $car_img = isset($car_images[$img_index]) ? $car_images[$img_index] : 'avanza.png';
        $img_index++;
    ?>
        <div class="col-lg-6">
            <div class="card h-100 shadow-sm border-0 car-card">
                <div class="position-relative">
                    <img src="assets/img/<?= $car_img; ?>" class="card-img-top" alt="<?= $mobil['nama_mobil']; ?>">
                    <span class="position-absolute top-0 end-0 bg-danger text-white px-3 py-1 m-2 rounded-pill fw-bold">Best Seller</span>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="card-title fw-bold mb-0"><?= $mobil['nama_mobil']; ?></h4>
                        <span class="badge bg-secondary"><?= $mobil['jenis']; ?></span>
                    </div>

                    <h3 class="text-primary fw-bold my-3">Rp <?= number_format($mobil['harga'], 0, ',', '.'); ?> <small class="text-muted fs-6 fw-normal">/ 12 jam</small></h3>

                    <p class="card-text text-muted small"><?= $mobil['deskripsi']; ?></p>

                    <div class="row text-center text-muted mb-3 small bg-light py-2 rounded mx-1">
                        <div class="col-4 border-end"><i class="fas fa-gas-pump"></i> Bensin</div>
                        <div class="col-4 border-end"><i class="fas fa-chair"></i> 7 Seat</div>
                        <div class="col-4"><i class="fas fa-cog"></i> Auto/Man</div>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="https://wa.me/628123456789?text=Halo%20saya%20booking%20<?= $mobil['nama_mobil']; ?>" class="btn btn-success fw-bold"><i class="fab fa-whatsapp"></i> Booking WhatsApp</a>
                        <a href="index.php?page=kontak" class="btn btn-outline-dark">Hubungi Kantor</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div class="mt-5">
    <h4 class="mb-3">Syarat & Ketentuan Sewa</h4>
    <div class="accordion" id="accordionSyarat">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                    Syarat Lepas Kunci (Self Drive)
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionSyarat">
                <div class="accordion-body">
                    <ul>
                        <li>E-KTP Asli dan KK (Kartu Keluarga).</li>
                        <li>SIM A yang masih berlaku.</li>
                        <li>Bersedia disurvei tempat tinggal (domisili).</li>
                        <li>Deposit jaminan (dikembalikan saat selesai sewa).</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                    Sewa Dengan Supir (All In)
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionSyarat">
                <div class="accordion-body">
                    Harga sudah termasuk Supir dan BBM (Dalam Kota). Belum termasuk Parkir, Tol, Tiket Wisata, dan Makan Supir. Overtime dikenakan biaya 10% per jam.
                </div>
            </div>
        </div>
    </div>
</div>