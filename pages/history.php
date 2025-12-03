<?php
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Harap Login!'); window.location='index.php';</script>";
    exit;
}
$uid = $_SESSION['user_id'];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="fas fa-history"></i> Aktivitas Saya</h3>
    <a href="index.php?page=produk" class="btn btn-primary btn-sm">Booking Lagi</a>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <i class="fas fa-car"></i> Riwayat Pemesanan (Booking)
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <?php
                    // Join table bookings dan cars
                    $q_book = mysqli_query($koneksi, "SELECT b.*, c.nama_mobil 
                                                      FROM bookings b 
                                                      JOIN cars c ON b.car_id = c.id 
                                                      WHERE b.user_id='$uid' 
                                                      ORDER BY b.id DESC");

                    if (mysqli_num_rows($q_book) > 0) {
                        while ($b = mysqli_fetch_array($q_book)) {
                            // Badge status
                            $badge_class = [
                                'pending' => 'bg-warning text-dark',
                                'disetujui' => 'bg-success',
                                'ditolak' => 'bg-danger',
                                'selesai' => 'bg-info',
                                'dibatalkan' => 'bg-secondary'
                            ];
                            $badge = $badge_class[$b['status']] ?? 'bg-secondary';
                    ?>
                            <li class="list-group-item">
                                <div class="d-flex w-100 justify-content-between align-items-start">
                                    <div>
                                        <h5 class="mb-1 text-primary"><?= $b['nama_mobil']; ?></h5>
                                        <p class="mb-1">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar"></i> <?= date('d/m/Y', strtotime($b['tanggal_mulai'])); ?> 
                                                - <?= date('d/m/Y', strtotime($b['tanggal_selesai'])); ?>
                                                (<?= $b['durasi_hari']; ?> hari)
                                            </small>
                                        </p>
                                        <p class="mb-1">
                                            <strong>Total:</strong> Rp <?= number_format($b['total_harga'], 0, ',', '.'); ?>
                                        </p>
                                        <?php if (!empty($b['keperluan'])): ?>
                                            <small class="text-muted"><i class="fas fa-info-circle"></i> <?= $b['keperluan']; ?></small>
                                        <?php endif; ?>
                                    </div>
                                    <span class="badge <?= $badge; ?>"><?= ucfirst($b['status']); ?></span>
                                </div>
                                <hr class="my-2">
                                <small class="text-muted">
                                    <i class="fas fa-clock"></i> Dibuat: <?= date('d/m/Y H:i', strtotime($b['created_at'])); ?>
                                </small>
                            </li>
                    <?php
                        }
                    } else {
                        echo "<li class='list-group-item text-center text-muted'><i class='fas fa-inbox'></i><br>Belum ada pemesanan.</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <i class="fas fa-key"></i> Log Keamanan Login
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0 text-small">
                    <thead>
                        <tr>
                            <th>Waktu Login</th>
                            <th>IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_log = mysqli_query($koneksi, "SELECT * FROM login_logs WHERE user_id='$uid' ORDER BY id DESC LIMIT 10");
                        if (mysqli_num_rows($q_log) > 0) {
                            while ($l = mysqli_fetch_array($q_log)) {
                                echo "<tr><td><small>{$l['login_time']}</small></td><td><small>{$l['ip_address']}</small></td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2' class='text-center text-muted'>Belum ada log login</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>