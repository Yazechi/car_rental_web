<div id="heroCarousel" class="carousel slide mb-5 shadow rounded overflow-hidden" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/img/slider1.png" class="d-block w-100" alt="Slide 1">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                <h5>Perjalanan Bisnis Lebih Berkelas</h5>
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/img/slider2.png" class="d-block w-100" alt="Slide 2">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                <h5>Liburan Keluarga Tanpa Cemas</h5>
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/img/slider3.png" class="d-block w-100" alt="Slide 3">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                <h5>Harga Terbaik di Kelasnya</h5>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<div class="text-center mb-5">
    <h2 class="display-6 fw-bold">
        <?= get_content('home_welcome_title', 'Selamat Datang di Nusantara Rent Car'); ?>
    </h2>
    <p class="lead text-muted">
        <?= get_content('home_welcome_subtitle', 'Partner Transportasi Terpercaya Sejak 2015'); ?>
    </p>
    <div class="d-flex justify-content-center mb-3">
        <hr class="w-25 border-3 border-primary">
    </div>
    <p class="px-md-5">
        <?= get_content('home_welcome_desc', 'Kami hadir untuk memberikan solusi transportasi yang aman, nyaman, dan terjangkau.'); ?>
    </p>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm text-center py-4 hover-effect">
            <div class="card-body">
                <div class="mb-3 text-primary"><i class="fas fa-car-side fa-3x"></i></div>
                <h5 class="card-title fw-bold">Unit Terbaru</h5>
                <p class="card-text text-muted">Seluruh armada kami berusia kurang dari 3 tahun dan terawat.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm text-center py-4 hover-effect">
            <div class="card-body">
                <div class="mb-3 text-success"><i class="fas fa-user-shield fa-3x"></i></div>
                <h5 class="card-title fw-bold">Supir Profesional</h5>
                <p class="card-text text-muted">Supir kami terlatih, memiliki lisensi resmi, dan ramah.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm text-center py-4 hover-effect">
            <div class="card-body">
                <div class="mb-3 text-warning"><i class="fas fa-headset fa-3x"></i></div>
                <h5 class="card-title fw-bold">Layanan 24 Jam</h5>
                <p class="card-text text-muted">Customer service kami siap membantu pemesanan Anda kapan saja.</p>
            </div>
        </div>
    </div>
</div>