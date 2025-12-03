<h2 class="border-start border-5 border-primary ps-3 mb-4">Tentang Perusahaan</h2>

<div class="row align-items-center mb-5">
    <div class="col-md-6">
        <img src="assets/img/kantor.png" class="img-fluid rounded shadow-lg mb-3" alt="Office">
    </div>
    <div class="col-md-6">
        <h4 class="fw-bold mb-3">Sejarah Singkat</h4>
        <div>
            <?= nl2br(get_content('about_history', 'Nusantara Rent Car didirikan pada tahun 2015 di Jakarta.')); ?>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-12">
        <h4 class="fw-bold mb-3">Statistik Kami</h4>
        <div class="mb-3">
            <div class="d-flex justify-content-between"><label>Kepuasan Pelanggan</label> <span>98%</span></div>
            <div class="progress">
                <div class="progress-bar bg-success" style="width: 98%"></div>
            </div>
        </div>
        <div class="mb-3">
            <div class="d-flex justify-content-between"><label>Kondisi Armada Prima</label> <span>100%</span></div>
            <div class="progress">
                <div class="progress-bar bg-primary" style="width: 100%"></div>
            </div>
        </div>
    </div>
</div>