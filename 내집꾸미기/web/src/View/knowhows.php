<div class="container padding pt-5 pb-5 px-0">
    <div class="d-flex justify-content-between border-bottom align-items-end">
        <div class="pb-3">
            <span class="text-muted">온라인 집들이</span>
            <div class="title">KNOWHOWS</div>
        </div>
        <?php if(user()) : ?>
            <button class="btn-label bg-blue text-white px-4" data-toggle="modal" data-target="#write-modal">
                글쓰기
                <i class="fa fa-pencil ml-3"></i>
            </button>
        <?php endif; ?>
    </div>
    <div class="content knowhow row" id="content">
        <?php foreach($knowhows as $item) : ?>
            <div class="col-lg-4 col-md-6 mt-4">
                <div class="content__item card__item border">
                    <div class="imageItem d-flex align-items-center justify-content-center">
                        <img src="./uploads/<?= $item->before_img ?>" alt="homeImage1">
                        <img src="./uploads/<?= $item->after_img ?>" alt="homeImage2">
                    </div>
                    <div class="textItem pt-3 pb-3 px-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span><?= $item->name ?></span>
                                <small class="text-muted">(<?= $item->user_id ?>)</small>
                                <small class="text-muted ml-2"><?= $item->date ?></small>
                            </div>
                            <div class="text-gold">
                                <i class="fa fa-star"></i>
                                <?= round($item->cnt) ?>
                            </div>
                        </div>
                        <div class="mt-3">
                            <p class="fx-n2 text-muted"><?= $item->comment ?></p>
                        </div>
                        <div class="mt-3 align-items-center justify-content-between <?= (user() && !$item->write && $item->user_id !== user()->user_id) ? "d-flex" : "d-none" ?>">
                            <small class="text-muted">이 글이 마음에 드시나요?</small>
                            <button class="bg-blue fx-n3 py-2 px-3 text-white" data-id="<?= $item->id ?>" data-toggle="modal" data-target="#score-modal">평점 주기</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- 글쓰기 모달 -->
<form action="/knowhows/write" method="post" id="write-modal" class="modal fade" enctype="multipart/form-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body px-4 pt-4 pb-3">
                <div class="title text-center">
                    KNOWHOW 
                </div>
                <div class="mt-4">
                    <div class="form-group">
                        <label for="before_img">Before 사진</label>
                        <div class="custom-file">
                            <input type="file" id="before_img" class="custom-file-input" name="before_img" >
                            <label for="before_img" class="custom-file-label">파일을 업로드 하세요</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="after_img">After 사진</label>
                        <div class="custom-file">
                            <input type="file" id="after_img" class="custom-file-input" name="after_img" >
                            <label for="after_img" class="custom-file-label">파일을 업로드 하세요</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contents">노하우</label>
                        <textarea name="contents" id="contents" cols="30" rows="10" class="form-control" placeholder="노하우을(를) 입력하세요" required></textarea>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="w-100 py-3 bg-blue text-white">작성 완료</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- /글쓰기 모달 -->

<!-- 평점 모달 -->
<div id="score-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body py-5">
                <div class="text-center text-muted">이 게시글의 평점을 매겨주세요!</div>
                <div class="mt-3 d-flex justify-content-center">
                    <button class="GiveScore mx-3 px-2 py-1 border bg-white text-gold" data-value="1"><i class="fa fa-star"></i>1</button>
                    <button class="GiveScore mx-3 px-2 py-1 border bg-white text-gold" data-value="2"><i class="fa fa-star"></i>2</button>
                    <button class="GiveScore mx-3 px-2 py-1 border bg-white text-gold" data-value="3"><i class="fa fa-star"></i>3</button>
                    <button class="GiveScore mx-3 px-2 py-1 border bg-white text-gold" data-value="4"><i class="fa fa-star"></i>4</button>
                    <button class="GiveScore mx-3 px-2 py-1 border bg-white text-gold" data-value="5"><i class="fa fa-star"></i>5</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 평점 모달 -->

<script>
    window.app = new Knowhows(<?= json_encode(user(), JSON_UNESCAPED_UNICODE); ?>);
</script>