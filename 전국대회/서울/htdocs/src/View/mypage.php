<div class="container mt-5">
    <div class="border-bottom border-2 border-blue">
        <div class="d-flex align-items-center gap-3">
            <div class="mb-0 title">FESTIVALS</div>
            <small class="text-muted mt-1">축제 리스트</small>
        </div>
        <div class="d-flex align-items-center py-3 mt-3">
            <?php if(admin()) : ?>
                <div class="col-1 text-center">
                    <p class="mb-0">이미지</p>
                </div>
                <div class="col-4 text-center gap-2">
                    <p class="mb-0">축제 이름/도시</p>
                </div>
                <div class="col-2 text-center gap-2">
                    <p class="mb-0">좋아요 수</p>
                </div>
                <div class="col-1 text-center gap-2">
                    <p class="mb-0">티켓 판매 수</p>
                </div>
                <div class="col-2 text-center gap-2">
                    <p class="mb-0">티켓 판매 금액</p>
                </div>
                <div class="col-1 text-center gap-2">
                    <p class="mb-0">총 리뷰 수</p>
                </div>
                <div class="col-1 text-center gap-2">
                    <p class="mb-0">평균 별점</p>
                </div>
            <?php else : ?>
                <div class="col-1 text-center">
                    <p class="mb-0">이미지</p>
                </div>
                <div class="col-4 text-center gap-2">
                    <p class="mb-0">축제 이름/도시</p>
                </div>
                <div class="col-1 text-center gap-2">
                    <p class="mb-0">시작, 끝 날짜</p>
                </div>
                <div class="col-1 text-center gap-2">
                    <p class="mb-0">시작, 끝 시간</p>
                </div>
                <div class="col-1 text-center gap-2">
                    <p class="mb-0">티켓 개수</p>
                </div>
                <div class="col-2 text-center gap-2">
                    <p class="mb-0">
                        총 가격
                    </p>
                </div>
                <div class="col-2 text-center gap-2">
                    <p class="mb-0">-</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="container mb-5">
    <div class="col-12" id="festival-list">
        <?php if(admin()) : ?>
            <?php foreach($data as $key => $value) : ?>
            <div class="py-3">
                <div class="d-flex align-items-center">
                    <div class="col-1">
                        <img src="/images/<?=$value->img ?>" class="fit-cover">
                    </div>
                    <div class="col-4 d-flex align-items-center gap-2">
                        <a href="/festivalData/<?= $value->id ?>" class="mb-0 ml-2 text-dark"><?= $value->name ?></a>
                        <small class="mb-0 text-muted"><?= $value->city ?></small>
                    </div>
                    <div class="col-2 text-center gap-2">
                        <p class="mb-0"><?= $value->good ?><?= $value->good != "좋아요 없음" ? "개" : "" ?></p>
                    </div>
                    <div class="col-1 text-center gap-2">
                        <p class="mb-0"><?= $value->buy ?><?= $value->buy != "판매 없음" ? "개" : "" ?></p>
                    </div>
                    <div class="col-2 text-center gap-2">
                        <p class="mb-0">
                            <span class="text-gold font-bold fx-2"><?= $value->buy != "판매 없음" ? $value->buy * $value->ticketPrice : 0 ?></span>
                            <small class="text-muted">원</small>
                        </p>
                    </div>
                    <div class="col-1 text-center gap-2">
                        <p class="mb-0"><?= $value->review ?><?= $value->review != "리뷰 없음" ? "개" : "" ?></p>
                    </div>
                    <div class="col-1 text-center gap-2">
                        <?php if($value->score == "리뷰 없음") : ?>
                            <p class="mb-0"><?= $value->score ?></p>
                        <?php else : ?>
                            <p class="mb-0"><?= stripos($value->score, ".") !== false ? round($value->score, 2) : $value->score ?>점</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        <?php else : ?>
            <?php foreach($data as $key => $value) : ?>
            <div class="py-3" data-start="<?= $value->startDate ?>" data-end="<?= $value->endDate ?>">
                <div class="d-flex align-items-center">
                    <div class="col-1">
                        <img src="/images/<?=$value->img?>" class="fit-cover">
                    </div>
                    <div class="col-4 d-flex align-items-center gap-2">
                        <a href="/festivalData/<?= $value->id ?>" class="mb-0 ml-2 text-dark"><?= $value->name ?></a>
                        <small class="mb-0 text-muted"><?= $value->city ?></small>
                    </div>
                    <div class="col-1 text-center gap-2">
                        <p class="mb-0"><?= date("Y-m-d", strtotime($value->startDate)); ?></p>
                        <p class="mb-0"><?= date("Y-m-d", strtotime($value->endDate)); ?></p>
                    </div>
                    <div class="col-1 text-center gap-2">
                        <p class="mb-0"><?= date("h:i", strtotime($value->startDate)); ?></p>
                        <p class="mb-0"><?= date("h:i", strtotime($value->endDate)); ?></p>
                    </div>
                    <div class="col-1 text-center gap-2">
                        <p class="mb-0"><?= $value->count ?>개</p>
                    </div>
                    <div class="col-2 text-center gap-2">
                        <p class="mb-0">
                            <span class="text-gold font-bold fx-2"><?= $value->price ?></span>
                            <small class="text-muted">원</small>
                        </p>
                    </div>
                    <?php if($value->type == 1) : ?>
                        <form action="/festivalAttend" method="post" class="col-2 text-center gap-2">
                            <input type="hidden" value="<?= $value->tid ?>" name="id">
                            <button class="btn btn-success">축제 참여</button>
                        </form>
                    <?php else : ?>
                        <div class="col-2 text-center">
                            <button class="btn bg-darkblue text-light">참여함</button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach;?>
        <?php endif; ?>
    </div>
</div>
<script>
    const nowDate = new Date();

    document.querySelectorAll("#festival-list > div").forEach(item => {
        const startDate = new Date(item.dataset.start);
        const endDate = new Date(item.dataset.end);
        if(!(startDate < nowDate)) {
            item.querySelector("button").disabled = true;
        }
    })
</script>