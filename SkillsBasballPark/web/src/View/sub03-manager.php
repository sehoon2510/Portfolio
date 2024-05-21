<div class="w-100 bg-blue sub-wrap">    
    <img src="./images/25.jpg" alt="" class="fit-cover filter">
    <div class="w-100">
        <div class="container padding py-3">
            <a href="/" class="text-white">홈</a>
            <i class="fa-solid fa-angle-right mx-3 text-white"></i>
            <a href="/reservation" class="text-white">reservation</a>
        </div>
    </div>
</div>
<div class="container padding pt-5">
    <div class="mb-1">
        <div class="pb-2 d-flex align-items-center gap-2">
            <div class="title">TITLE</div>
            <small class="mt-1 text-blue font-bold">제목</small>
        </div>
        <div class="table-head d-flex align-items-ceenter">
            <div class="cell-10 text-center d-flex align-items-center justify-content-center"><input type="checkbox"></div>
            <div class="cell-10 text-center d-flex align-items-center justify-content-center">예약가능여부</div>
            <div class="cell-20 d-flex align-items-center justify-content-center">예약자 정보</div>
            <div class="cell-40 d-flex align-items-center justify-content-center">예약 정보</div>
            <div class="cell-20 text-center d-flex align-items-center justify-content-center">+</div>
        </div>
    </div>
</div>
<div class="container padding pb-5">
    <div class="w-100">
        <?php foreach($data as $item) : ?>
            <div class="d-flex align-items-center py-2 border-bottom">
                <div class="cell-10 text-center d-flex align-items-center justify-content-center">
                    <?php if($item->status <= 1) : ?>
                        <input type="checkbox">
                    <?php endif; ?>
                </div>
                <div class="cell-10 d-flex align-items-center justify-content-center">
                    <?php if($item->status >= 2) : ?>
                        <div class="rounded-pill bg-success text-white px-2 py-1 fx-n2">
                            승인완료
                        </div>
                    <?php elseif($item->status < 1) : ?>
                        <div class="rounded-pill bg-danger text-white px-2 py-1 fx-n2">
                            승인 불가
                        </div>
                    <?php else : ?>
                        <div class="rounded-pill bg-gold text-white px-2 py-1 fx-n2">
                            예약 가능
                        </div>
                    <?php endif; ?>
                </div>
                <div class="cell-20 d-flex justify-content-center">
                    <div>
                        <span><?= $item->user_name ?></span>
                        <small><?= $item->user_id ?></small>
                    </div>
                </div>
                <div class="cell-40 d-flex">
                    <div class="col-3 text-center"><?= $item->game ?></div>
                    <div class="col-3 text-center"><?= $item->date ?></div>
                    <div class="col-3 text-center"><?= $item->time ?>시</div>
                    <div class="col-3 text-center"><?= $item->count ?>명</div>
                </div>
                <div class="cell-20 text-center">
                    <a <?= $item->status == 1 ? "href='/reservation/pass?id=$item->id'" : "" ?> class="fx-n2 bg-blue text-white px-3 py-2">예약승인</a>
                    <a <?= $item->status < 1 ? "href='/reservation/delete?id=$item->id'" : "" ?> class="fx-n2 bg-danger text-white px-3 py-2">삭제</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>