<div class="w-100 my-5 py-5">
    <div class="container">
        <div class="w-100 sticky-top mt-5 p-0">
            <div class="d-flex flex-wrap align-items-center justify-content-between border-bottom align-items-end">
                <div class="pb-3">
                    <span class="text-muted">시공 견적 요청</span>
                    <div class="title">REQUESTS</div>
                </div>
                <button class="btn-label bg-blue text-white px-4" data-target="#request-modal" data-toggle="modal">
                    견적 요청
                    <i class="fa fa-angle-right ml-3"></i>
                </button>
                <div class="py-3 w-100 d-flex align-items-center">
                    <div class="px-2 text-nowrap text-center text-muted">상태</div>
                    <div class="col-5 text-nowrap text-center text-muted">내용</div>
                    <div class="px-1 text-nowrap text-center text-muted">요청자</div>
                    <div class="px-1 text-nowrap text-center text-muted">시공일</div>
                    <div class="px-1 text-nowrap text-center text-muted">견적 개수</div>
                    <div class="px-1 text-nowrap text-center text-muted">+</div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <?php foreach($requests as $request) : ?>
            <div class="w-100 py-4 d-flex align-items-center">
                <div class="px-2 text-nowrap d-flex align-items-center justify-content-center">
                    <span class="rounded-pill bg-gold text-white fx-n3 py-2 px-3"><?= $request->status ?></span>
                </div>
                <div class="col-5 text-nowrap text-center"><?= $request->comment ?></div>
                <div class="px-1 text-nowrap text-center">
                    <?= $request->name ?>
                    <small class="text-muted">(<?= $request->user_id ?>)</small>
                </div>
                <div class="px-1 text-nowrap text-center"><?= $request->date ?></div>
                <div class="px-1 text-nowrap text-center"><?= $request->cnt ?></div>
                <div class="px-1 text-nowrap text-center">
                    <?php if(user() && (user()->grant == 1 && !$request->write || $request->uid == user()->id)) : ?>
                    <button class="p-2 fx-n3 bg-blue text-white <?= user() ? "" : "d-none" ?>" data-target="#<?= !$request->write && user()->grant == 1 && $request->status == "진행 중" ? "review-modal" : "show-modal" ?>" data-toggle="modal" data-id="<?= $request->id ?>">
                        <?php if(!$request->write && user()->grant == 1 && $request->status == "진행 중") : ?>
                            견적 보내기
                        <?php else : ?>
                            견적 보기
                        <?php endif; ?>
                    </button>
                    <?php else : ?>
                        -
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php if(user() && user()->grant == 1) : ?>
    <div class="w-100 my-5 py-5 bg-gray">
        <div class="container">
            <div class="w-100 sticky-top mt-5 p-0">
                <div class="border-bottom align-items-end">
                    <div class="pb-3">
                        <span class="text-muted">보낸 견적</span>
                        <div class="title">RESPONSES</div>
                    </div>
                    <div class="py-3 w-100 d-flex align-items-center">
                        <div class="px-2 text-nowrap text-center text-muted">선택 여부</div>
                        <div class="col-5 text-nowrap text-center text-muted">내용</div>
                        <div class="px-1 text-nowrap text-center text-muted">요청자</div>
                        <div class="px-1 text-nowrap text-center text-muted">시공일</div>
                        <div class="px-1 text-nowrap text-center text-muted">입력한 비용</div>
                        <div class="px-1 text-nowrap text-center text-muted">+</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <?php foreach($responses as $respons) : ?>
                <div class="w-100 py-4 d-flex align-items-center">
                    <div class="px-2 text-nowrap d-flex align-items-center justify-content-center">
                        <span class="rounded-pill bg-gold text-white fx-n3 py-2 px-3"><?= $respons->status ?></span>
                    </div>
                    <div class="col-5 text-nowrap text-center text-muted"><?= $respons->comment ?></div>
                    <div class="px-1 text-nowrap text-center">
                        <?= $respons->name ?>
                        <small class="text-muted">(<?= $respons->user_id ?>)</small>
                    </div>
                    <div class="px-1 text-nowrap text-center"><?= $respons->date ?></div>
                    <div class="px-1 text-nowrap text-center">
                        <?= $respons->price ?>
                        <small class="text-muted">원</small>
                    </div>
                    <div class="px-1 text-nowrap text-center">-</div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
<!-- 견적 요청 -->
<form action="/estimates/write" id="request-modal" class="modal fade" method="post">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body px-4 pt-4 pb-3">
                <div class="title text-center">
                    REQUEST
                </div>
                <div class="mt-4">
                    <div class="form-group">
                        <label for="start_date">시공일</label>
                        <input type="date" id="start_date" class="form-control" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="contents">내용</label>
                        <textarea name="contents" id="contents" cols="30" rows="10" class="form-control" placeholder="내용을(를) 입력하세요" required></textarea>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="w-100 py-3 bg-blue text-white">작성 완료</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- /견적 요청 -->

<!-- 견적 보내기 -->
<form action="/estimates/review" id="review-modal" class="modal fade" method="post">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="eid" name="eid">
            <div class="modal-body px-4 pt-4 pb-3">
                <div class="title text-center">
                    RESPONSE
                </div>
                <div class="mt-4">
                    <div class="form-group">
                        <label for="price">비용</label>
                        <input type="number" id="price" class="form-control" min="0" value="10000" name="price" required>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="w-100 py-3 bg-blue text-white">입력 완료</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- /견적 보내기 -->

<!-- 견적 보기 -->
<div id="show-modal" class="modal fade">
    <input type="hidden" id="pick_qid" name="qid">
    <input type="hidden" id="pick_sid" name="sid">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body px-4 pt-4 pb-3">
                <div class="title text-center">
                    ESTIMATES
                </div>
                <div class="w-100 mt-3 py-3 d-flex justify-content-around align-items-center border-bottom">
                    <div class="col-3 px-3 text-center fx-n2">전문가 정보</div>
                    <div class="col-4 px-3 text-center fx-n2">비용</div>
                    <div class="col-3 px-3 text-center fx-n2">+</div>
                </div>
                <div class="list">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /견적 보기 -->

<script>
    document.querySelectorAll("[data-target='#review-modal']").forEach(item => {
        item.addEventListener("click", e => {
            document.querySelector("#review-modal #eid").value = e.target.dataset.id;
        })
    })
    
    document.querySelectorAll("[data-target='#show-modal']").forEach(item => {
        item.addEventListener("click", async e => {
            $.get(`/estimates/get?id=${e.target.dataset.id}`, function(res) {
                let json = JSON.parse(res);
                
                document.querySelector("#show-modal .list").innerHTML = '';
                json.forEach(item => {
                    document.querySelector("#show-modal .list").innerHTML += `
                        <div class="w-100 d-flex justify-content-around align-items-center py-3">
                            <div class="col-3 px-3 text-center">
                                <span>${item.name}</span>
                                <small class="text-muted">(${item.user_id})</small>
                            </div>
                            <div class="col-4 px-3 text-center">
                                <span>${item.price}</span>
                                <small class="text-muted">원</small>
                            </div>
                            <div class="col-3 px-3 text-center">
                                ${item.status != "진행 중" ? '-' : `<button class="fx-n3 bg-blue text-white py-2 px-2" data-id="${item.id}" data-eid="${item.eid}">선택</button>`}
                            </div>
                        </div>
                    `
                });

                document.querySelectorAll("#show-modal .list button").forEach(item => {
                    item.addEventListener("click", e => {
                        $.post("/estimates/check", {"id":e.target.dataset.id, "eid":e.target.dataset.eid}, res => {
                            alert(res);
                            location.href = "/estimates";
                        })
                    })
                })

            })
        })
    })
</script>