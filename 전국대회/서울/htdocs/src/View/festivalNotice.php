<div class="container padding mt-5">
    <div class="border-bottom border-2 border-blue d-flex align-items-end justify-content-between">
        <div class="mb-3">
            <div class="d-flex gap-3">
                <a href="/festivalData/<?= $festival->id ?>" class="mb-0 fx-2 font-bold text-blue"><?= $festival->name ?></a>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="mb-0 title">FESTIVAL NOTICES</div>
                <small class="text-muted mt-1">축제 공지사항</small>
            </div>
        </div>
    </div>
</div>
<div class="container padding mb-5">
    <div class="col-12" id="review-list">
        <?php foreach($notices as $key => $value) : ?>
            <div class="py-3 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-end gap-2 mb-2">
                        <a href="/festivalNoticeData/<?= $value->id ?>" class="mb-0 fx-2 text-blue"><?= $value->title ?></a>
                        <p class="mb-0"><?= $value->name ?></p>
                        <small class="text-muted"><?= $value->userID ?></small>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <p class="mb-0">조회수 <?= $value->hit ?></p>
                    </div>
                </div>
                <p class="pl-3"><?= $value->content ?></p>
                <div class="col-12 d-flex justify-content-between align-items-end mb-2">
                    <div class="images col-8 d-flex">

                    </div>
                    
                </div>
                <div class="d-flex justify-content-end">
                    <p class="mb-0 fx-n2"><?= date("Y-m-d", strtotime($value->date)); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>