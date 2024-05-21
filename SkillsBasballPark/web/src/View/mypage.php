<div class="w-100 bg-blue sub-wrap">    
    <img src="./images/25.jpg" alt="" class="fit-cover filter">
    <div class="w-100">
        <div class="container padding py-3">
            <a href="/" class="text-white">홈</a>
            <i class="fa-solid fa-angle-right mx-3 text-white"></i>
            <a href="/mypage" class="text-white">마이페이지</a>
        </div>
    </div>
</div>
<div class="container padding pt-5">
    <div class="mb-1">
        <div class="pb-2 d-flex align-items-center gap-2">
            <div class="title">RESERVATION</div>
            <small class="mt-1 text-blue font-bold">예약정보</small>
        </div>
        <div class="table-head d-flex align-items-ceenter">
            <div class="cell-20 text-center d-flex align-items-center justify-content-center">승인상태</div>
            <div class="cell-20 text-center d-flex align-items-center justify-content-center">리그</div>
            <div class="cell-10 text-center d-flex align-items-center justify-content-center">날짜</div>
            <div class="cell-10 text-center d-flex align-items-center justify-content-center">시간</div>
            <div class="cell-10 text-center d-flex align-items-center justify-content-center">최소인원</div>
            <div class="cell-30 text-center d-flex align-items-center justify-content-center">사용료</div>
        </div>
    </div>
</div>
<div class="container padding pb-5">
    <?php foreach($res as $item) : ?>
    <div class="d-flex align-items-center py-3 border-bottom">
        <div class="cell-20 d-flex justify-content-center">    
        <?php if($item->status == 4) : ?>
            <div class="rounded-pill fx-n2 px-3 py-1 bg-success text-white">결제완료</div>
        <?php elseif($item->status == 3) : ?>
            <div class="rounded-pill fx-n2 px-3 py-1 bg-darkblue text-white">결제승인전</div>
        <?php elseif($item->status == 2) : ?>
            <a href="/reservation/userBuy?id=<?= $item->id ?>" class="fx-n2 d-block px-4 py-1 bg-darkblue text-white">결제</a>
        <?php elseif($item->status >= 0) : ?>
            <div class="rounded-pill fx-n2 px-3 py-1 bg-gold text-white">예약신청</div>
        <?php elseif($item->status == -2) : ?>
            <div class="rounded-pill fx-n2 px-3 py-1 bg-danger text-white">결제취소</div>
        <?php elseif($item->status < 0) : ?>
            <div class="rounded-pill fx-n2 px-3 py-1 bg-danger text-white">승인불가</div>
        <?php else : ?>
        <?php endif; ?>
        </div>
        <div class="cell-20 text-center"><?= $item->game ?></div>
        <div class="cell-10 text-center"><?= $item->date ?></div>
        <div class="cell-10 text-center"><?= $item->time ?>시</div>
        <div class="cell-10 text-center"><?= $item->count ?>명</div>
        <div class="cell-30 text-center">
            <span class="text-gold font-bold"><?= $item->price ?></span>
            <small class="text-muted">원</small>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<div class="container padding pt-5">
    <div class="row">
        <div class="col-4">
            <div class="mb-1">
                <div class="pb-2 d-flex align-items-center gap-2">
                    <div class="title">GOODS</div>
                    <small class="mt-1 text-blue font-bold">관심 굿즈</small>
                </div>
                <div class="table-head d-flex align-items-ceenter">
                    <div class="cell-50 d-flex align-items-center justify-content-center">상품 정보</div>
                    <div class="cell-50 d-flex align-items-center justify-content-center">가격</div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="mb-1">
                <div class="pb-2 d-flex align-items-center gap-2">
                    <div class="title">CART</div>
                    <small class="mt-1 text-blue font-bold">장바구니</small>
                </div>
                <div class="table-head d-flex align-items-ceenter">
                    <div class="cell-50 d-flex align-items-center justify-content-center">상품 정보</div>
                    <div class="cell-20 d-flex align-items-center justify-content-center">가격</div>
                    <div class="cell-30 d-flex align-items-center justify-content-center">+</div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="mb-1">
                <div class="pb-2 d-flex align-items-center gap-2">
                    <div class="title">BUY LIST</div>
                    <small class="mt-1 text-blue font-bold">구매리스트</small>
                </div>
                <div class="table-head d-flex align-items-ceenter">
                    <div class="cell-50 d-flex align-items-center justify-content-center">상품 정보</div>
                    <div class="cell-50 d-flex align-items-center justify-content-center">가격</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container padding pb-5">
    <div class="row">
        <div class="col-4">
            <?php foreach($goods as $item) : ?>
                <div class="d-flex align-items-ceenter py-2 border-bottom">
                    <div class="cell-50 d-flex align-items-center gap-3">
                        <div class="image__area" style="width: 60px; height: 60px;">
                            <img src="/images/<?= $item->image ?>" alt="" class="fit-cover">
                        </div>    
                        <a href="/goods/item?id=<?= $item->id ?>" class="text-blue font-bold"><?= $item->name ?></a>
                    </div>
                    <div class="cell-50 d-flex align-items-center justify-content-center">
                        <div class="d-flex align-items-end gap-1">
                            <span class="fx-2 text-gold font-bold"><?= $item->price ?></span>
                            <small class="fx-n2 text-muted">원</small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-4">
            <?php foreach($cart as $item) : ?>
                <form action="/goods/buy" method="POST" class="d-flex align-items-ceenter py-2 border-bottom">
                    <input type="hidden" value="<?= $item->id ?>" name="id">
                    <div class="cell-50 d-flex align-items-center gap-3">
                        <div class="image__area" style="width: 60px; height: 60px;">
                            <img src="/images/<?= $item->image ?>" alt="" class="fit-cover">
                        </div>    
                        <a href="/goods/item?id=<?= $item->id ?>" class="text-blue font-bold"><?= $item->name ?></a>
                    </div>
                    <div class="cell-20 d-flex align-items-center justify-content-center">
                        <div class="d-flex align-items-end gap-1">
                            <span class="fx-2 text-gold font-bold"><?= $item->price ?></span>
                            <small class="fx-n2 text-muted">원</small>
                        </div>
                    </div>
                    <div class="cell-30 d-flex align-items-center justify-content-center">
                        <button class="bg-blue text-white px-4 py-1">구매</button>
                    </div>
                </form>
            <?php endforeach; ?>
        </div>
        <div class="col-4">
            <?php foreach($buy as $item) : ?>
                <div class="d-flex align-items-ceenter py-2 border-bottom">
                    <div class="cell-50 d-flex align-items-center gap-3">
                        <div class="image__area" style="width: 60px; height: 60px;">
                            <img src="/images/<?= $item->image ?>" alt="" class="fit-cover">
                        </div>    
                        <a href="/goods/item?id=<?= $item->id ?>" class="text-blue font-bold"><?= $item->name ?></a>
                    </div>
                    <div class="cell-50 d-flex align-items-center justify-content-center">
                        <div class="d-flex align-items-end gap-1">
                            <span class="fx-2 text-gold font-bold"><?= $item->cnt * $item->price ?></span>
                            <small class="fx-n2 text-muted">원</small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>