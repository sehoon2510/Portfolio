<div class="container padding mt-5">
    <div class="border-bottom border-2 border-blue d-flex align-items-end justify-content-between">
        <div class="mb-3">
            <div class="d-flex align-items-center gap-3">
                <div class="mb-0 title">FESTIVAL NOTICES</div>
                <small class="text-muted mt-1">축제 공지사항</small>
            </div>
        </div>
    </div>
</div>
<div class="container padding mb-5">
    <div class="col-12" id="review-list">
        <div class="py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="mb-2">
                    <p class="mb-0 fx-2 text-blue"><?= $data->title ?></p>
                    <p class="mb-0 fx-n2"><?= date("Y-m-d", strtotime($data->date)); ?></p>
                </div>
                <div class="d-flex align-items-center gap-1">
                    <p class="mb-0">조회수 <?= (int)$data->hit + 1 ?></p>
                </div>
            </div>
            <p class="pl-3 py-5"><?= $data->content ?></p>
            <div> 
                <?php foreach(json_decode($data->files) as $key => $value) : ?>
                    <a href="/images/<?= $value ?>" download class="d-block">
                        <i class="fa-solid fa-file"></i>
                        <?= explode("/", $value)[1] ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>