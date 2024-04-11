<div class="container padding pb-5 mt-5 mb-5">
    <div class="d-flex justify-content-center align-items-center">
        <div class="text-center">
            <span class="text-muted">전문가 소개</span>
            <div class="title blue">EXPERTS</div>
        </div>
    </div>
</div>
<div class="w-100 my-5 pb-5">
    <div class="experts w-100 my-5 bg-gold">
        <div class="content container">
            <div class="row">
                <?php foreach($users as $user) : ?>
                    <div class="card__item d-flex justify-content-center align-items-center col-lg-3 col-6 mt-4 mt-md-0">
                        <div class="rotate__card">
                            <div class="back d-flex align-items-center justify-content-center">
                                <img src="./uploads/user/<?= $user->image ?>" alt="image1">
                            </div>
                            <div class="on bg-white px-3 py-5 d-flex flex-column-reverse">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="fx-2"><?= $user->name ?></div>
                                    <div class="fx-n2 text-gold">(<?= $user->user_id ?>)</div>
                                    <div class="my-3 text-gold">
                                        <i class="fa fa-star"></i>
                                        <?= $user->score ?>
                                    </div>
                                    <hr style="width: 50px;">
                                    <button class="hover-opacity bg-gold text-white fx-n2 px-4 py-2" data-target="#review-modal" data-toggle="modal" data-id="<?= $user->id ?>">후기 작성하기</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<div class="w-100 bg-gray mt-5 py-5">
    <div class="container sticky-top mt-5">
        <div class="border-bottom align-items-end">
            <div class="pb-3">
                <span class="text-muted">전문가 리뷰</span>
                <div class="title">RIVEWS</div>
            </div>
            <div class="pb-3 w-100 d-flex align-items-center">
                <div class="px-2 text-nowrap text-center text-muted">전문가 정보</div>
                <div class="col-6 text-nowrap text-center text-muted">내용</div>
                <div class="px-1 text-nowrap text-center text-muted">작성자</div>
                <div class="px-1 text-nowrap text-center text-muted">비용</div>
                <div class="px-1 text-nowrap text-center text-muted">평점</div>
            </div>
        </div>
    </div>
    <div class="container">
        <?php foreach($reviews as $review) : ?>
        <div class="w-100 py-3 d-flex align-items-center border-bottom">
            <div class="px-2 text-nowrap text-center">
                <?= $review->name ?>
                <small class="text-muted">(<?= $review->user_id ?>)</small>
            </div>
            <div class="col-6 text-nowrap text-center"><?= $review->comment ?></div>
            <div class="px-1 text-nowrap text-center">
                <?= $review->write_name ?>
                <small class="text-muted">(<?= $review->write_id ?>)</small>
            </div>
            <div class="px-1 text-nowrap text-center"><?= $review->price ?></div>
            <div class="px-1 text-nowrap text-center text-gold">
                <i class="fa fa-star"></i>
                <?= $review->score ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<form action="/experts/reviews" id="review-modal" class="modal fade" method="post">
    <input type="hidden" id="eid" name="eid">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body px-4 pt-4 pb-3">
                <div class="title text-center">
                    REVIEW
                </div>
                <div class="mt-4">
                    <div class="form-group">
                        <label for="price">비용</label>
                        <input type="number" id="price" class="form-control" min="0" value="10000" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="score">평점</label>
                        <select name="score" id="score" class="form-control" required>
                            <option value="1">1점</option>
                            <option value="2">2점</option>
                            <option value="3">3점</option>
                            <option value="4">4점</option>
                            <option value="5">5점</option>
                        </select>
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
<script>

    document.querySelectorAll(`[data-target="#review-modal"]`).forEach(item => {
        item.addEventListener("click", e => {
            document.querySelector("#eid").value = e.target.dataset.id;
        });
    })
</script>