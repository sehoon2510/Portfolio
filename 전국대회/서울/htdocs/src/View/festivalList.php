<div class="container mt-5">
    <div class="border-bottom border-2 border-blue d-flex align-items-end justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <div class="mb-0 title">FESTIVALS</div>
            <small class="text-muted mt-1">축제 리스트</small>
        </div>
        <?php if(admin()) : ?>
            <a href="/festivalAdd" class="btn-label bg-darkblue text-light">축제 등록</a>
        <?php endif; ?>
    </div>
</div>
<div class="container mb-5">
    <div class="row flex-wrap align-content-start">
        <?php foreach($data as $key => $value) : ?>
        <div class="col-4 py-3">
            <div class="image_box mb-2" style="height: 250px;">
                <img src="/images/<?=$value->img?>" class="fit-cover">
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="mb-0"><?= $value->name ?></p>
                    <small class="mb-0 text-muted"><?= $value->city ?></small>
                </div>
                <a href="/festivalData/<?= $value->id ?>" class="bg-darkblue fx-n3 text-light px-3 py-1">더보기</a>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>