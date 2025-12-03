<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-lg border-0 rounded-lg mt-4">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="font-weight-light my-2">Buat Akun Baru</h3>
            </div>
            <div class="card-body">
                <form action="process/register_process.php" method="POST">

                    <div class="form-floating mb-3">
                        <input type="text" name="nama_lengkap" class="form-control" id="inputNama" placeholder="Nama Lengkap" required>
                        <label for="inputNama">Nama Lengkap</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="username" class="form-control" id="inputUser" placeholder="Username" required>
                        <label for="inputUser">Username</label>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input type="password" name="password" class="form-control" id="inputPass" placeholder="Password" required>
                                <label for="inputPass">Password</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input type="password" name="konfirmasi_password" class="form-control" id="inputKonfirmasi" placeholder="Konfirmasi Password" required>
                                <label for="inputKonfirmasi">Ulangi Password</label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 mb-0">
                        <div class="d-grid">
                            <button type="submit" name="btn_register" class="btn btn-primary btn-block">Daftar Sekarang</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <div class="small"><a href="index.php">Sudah punya akun? Login disini</a></div>
            </div>
        </div>
    </div>
</div>