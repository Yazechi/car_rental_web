<div class="text-center mb-5">
    <h2 class="fw-bold">Arah & Tujuan Kami</h2>
</div>

<div class="row justify-content-center">
    <div class="col-md-10 mb-4">
        <div class="card border-primary mb-3 shadow">
            <div class="card-header bg-primary text-white text-center py-3">
                <h3 class="mb-0"><i class="fas fa-eye"></i> Visi</h3>
            </div>
            <div class="card-body text-center p-5">
                <blockquote class="blockquote mb-0">
                    <p class="fs-4 fst-italic">
                        "<?= get_content('visi_text', 'Menjadi perusahaan penyedia jasa transportasi terdepan di Indonesia'); ?>"
                    </p>
                </blockquote>
            </div>
        </div>
    </div>

    <div class="col-md-10">
        <div class="card border-dark shadow">
            <div class="card-header bg-dark text-white text-center py-3">
                <h3 class="mb-0"><i class="fas fa-rocket"></i> Misi</h3>
            </div>
            <div class="card-body p-4">
                <ul class="list-group list-group-flush list-group-numbered fs-5">
                    <?php
                    $misi_text = get_content('misi_text', '');
                    $misi_items = explode('|', $misi_text);
                    foreach ($misi_items as $item) {
                        if (trim($item)) {
                            echo "<li class='list-group-item'>" . trim(str_replace(['1.', '2.', '3.', '4.', '5.'], '', $item)) . "</li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>