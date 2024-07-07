<div class="container padding mt-5">
    <div class="border-bottom border-2 border-blue d-flex align-items-end justify-content-between">
        <div class="mb-3">
            <div class="d-flex align-items-center gap-3">
                <div class="mb-0 title">MESSAGES</div>
                <small class="text-muted mt-1">알림 리스트</small>
            </div>
        </div>
    </div>
</div>
<div class="container padding mb-5">
    <div class="col-12" id="review-list">
        <?php foreach($messages as $key => $value) : ?>
            <div class="py-3 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-end gap-2 mb-2">
                        <p class="mb-0 fx-2 text-blue">[<?= $value->name ?>]<?= $value->comment ?></p>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <p class="mb-0 fx-n2"><?= date("Y-m-d", strtotime($value->date)); ?></p>
                </div>
                <form action="/messageAction" method="POST">
                    <input type="hidden" value="<?= $value->id ?>" name="id">
                    <?php if($value->msgType == "축제 공지") : ?>
                        <input type="hidden" value="/festivalNoticeData/<?= $value->target ?>" name="path">
                    <?php else : ?>
                        <input type="hidden" value="/festivalData/<?= $value->target ?>" name="path">
                    <?php endif; ?>
                    <button class="bg-blue text-light px-3 py-1">보기</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>