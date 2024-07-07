<div class="container padding mt-5">
    <div class="mb-3 border-bottom border-2 border-blue">
        <div class="d-flex align-items-center gap-3">
            <div class="mb-0 title">FESTIVAL</div>
            <small class="text-muted mt-1">축제 정보</small>
        </div>
    </div>
</div>
<div class="container padding mb-5">
    <div class="row">
        <div class="col-4">
            <img src="/images/<?= $data->img ?>" class="fit-cover">
        </div>
        <div class="col-8">
            <p class="fx-3 font-bold"><?= $data->name ?></p>
            <div class="border-bottom">
                <div class="my-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <p class="mb-0 text-blue font-bold">도시/주최</p>
                        <span><?= $data->city ?></span>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <p class="mb-0 text-blue font-bold">주관/기업명</p>
                        <span><?= $data->company ?></span>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <p class="mb-0 text-blue font-bold">전화번호</p>
                        <span><?= $data->phone ?></span>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <p class="mb-0 text-blue font-bold">주소</p>
                        <span><?= $data->address ?></span>
                    </div>
                </div>
                <div class="my-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <p class="mb-0 text-blue font-bold">시작 날짜</p>
                            <span><?= date("Y-m-d", strtotime($data->startDate)) ?></span>
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <p class="mb-0 text-blue font-bold">끝 날짜</p>
                            <span><?= date("Y-m-d", strtotime($data->endDate)) ?></span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <p class="mb-0 text-blue font-bold">시작 시간</p>
                            <span><?= date("h:i", strtotime($data->startDate)) ?></span>
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <p class="mb-0 text-blue font-bold">끝 시간</p>
                            <span><?= date("h:i", strtotime($data->endDate)) ?></span>
                        </div>
                    </div>
                    <div class="d-flex align-items-end gap-2">
                        <p class="mb-0 text-blue font-bold">티켓가격</p>
                        <div>
                            <span class="text-gold font-bold"><?= $data->ticketPrice ?></span>
                            <small>원</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <p><?= $data->description ?></p>
            </div>
            <div class="d-flex gap-3 align-items-center">
                <p class="mb-0 text-gold">
                    <i class="fa-solid fa-star"></i>
                    <span class="font-bold"><?= stripos($data->score, ".") !== false ? round($data->score) : $data->score ?></span>
                </p>
                <p class="mb-0 text-blue">
                    <i class="fa-solid fa-message"></i>
                    <span class="font-bold">0</span>
                </p>
                <p class="mb-0 text-blue">
                    <i class="fa-solid fa-thumbs-up"></i>
                    <span class="font-bold" id="good"><?= $goods->good ?></span>
                </p>
            </div>
            <div class="d-flex aling-items-center gap-2 mt-3">
                <?php if(admin()) : ?>
                    <?php if($data->uid == admin()->id) : ?>
                        <a href="/festivalEdit/<?= $data->id ?>" class="px-2 py-2 bg-gold text-light">축제 수정</a>
                        <a href="/festivalNoticeWrtie/<?= $data->id ?>" class="px-2 py-2 bg-gold text-light">공지하기</a>
                    <?php endif; ?>
                <?php else : ?>
                    <?php if(user()) : ?>
                        <button class="px-2 py-2 <?= $goods && $goods->goodCheck ? "bg-blue" : "bg-darkblue" ?> text-light" id="goodAdd">좋아요</button>
                        <button class="px-2 py-2 <?= $message && $message->acceptCheck ? "bg-blue" : "bg-darkblue" ?> text-light" id="messageAccept">알람 받기</button>
                    <?php else : ?>
                        <button disabled class="px-2 py-2 bg-gray" id="goodAdd">좋아요</button>
                        <button disabled class="px-2 py-2 bg-gray" id="messageAccept">알람 받기</button>
                    <?php endif; ?>
                    <button <?= user() ? "" : "disabled" ?> class="px-2 py-2 <?= user() ? "bg-gold text-light" : "bg-gray" ?>" data-bs-toggle="modal" data-bs-target="#Ticketing-modal">티켓 예매</button>
                <?php endif; ?>
                <a href="/festivalNotice/<?= $data->id ?>" class="px-2 py-2 bg-blue text-light">축제 공지사항</a>
            </div>
        </div>
    </div>
    <div class="row flex-wrap mt-3">
        <?php if(count($list) == 0) : ?>
            <div class="col-12 text-center">
                <p class="mb-0">주변 축제 없음</p>
            </div>
        <?php endif; ?>
        <?php foreach($list as $key => $value) : ?>
        <div class="col-6 py-3 d-flex align-items-center gap-2">
            <div class="image_box" style="height: 100px;">
                <img src="/images/<?=$value->img?>" class="fit-cover">
            </div>
            <a href="/festivalData/<?= $value->id ?>"><?= $value->name ?></a>
        </div>
        <?php endforeach;?>
    </div>
</div>
<div class="container padding mt-5">
    <div class="mb-3 border-bottom border-2 border-blue">
        <div class="d-flex align-items-center gap-3">
            <div class="mb-0 title">FESTIVAL QnA</div>
            <small class="text-muted mt-1">축제 질의 응답</small>
        </div>
    </div>
</div>
<div class="container padding mb-5">
    <div class="row">
        <?php if(!admin()) : ?>
        <div class="col-5">
            <form action="/questionAdd" method="POST" class="pb-3">
                <input type="hidden" value="<?= $data->id ?>" name="id">
                <div class="form-group mb-3">
                    <label for="question" class="form-label">QUESTION</label>
                    <textarea rows="10" style="resize: none;" id="question" name="content" class="form-control" placeholder="질문"></textarea>
                </div>
                <div class="form-group mb-3">
                    <button <?= user() ? "" : "disabled" ?> class="w-100 py-2 <?= user() ? "bg-darkblue text-light" : "bg-gray" ?>">질문하기</button>
                </div>
            </form>
        </div>
        <?php endif; ?>
        <div class="<?= admin() ? "col-12" : "col-7" ?>">
            <?php foreach($questions as $key => $value) : ?>
                <div class="py-3 border-bottom">
                    <div class="d-flex align-items-end gap-2 mb-2">
                        <p class="mb-0 fx-2 text-blue"><?= $value["q"]->name ?></p>
                        <small class="text-muted"><?= $value["q"]->userID ?></small>
                    </div>
                    <p class="pl-3"><?= $value["q"]->content ?></p>
                    <div class="d-flex justify-content-end">
                        <p class="mb-0 fx-n2"><?= $value["q"]->date ?></p>
                    </div>
                </div>
                <?php if($value["a"]) : ?>
                    <div class="ml-5 py-2 border-bottom">
                        <div class="d-flex align-items-end gap-2 mb-2">
                            <p class="mb-0 text-blue"><?= $value["a"]->name ?></p>
                            <small class="text-muted"><?= $value["a"]->userID ?></small>
                        </div>
                        <p class="pl-3"><?= $value["a"]->content ?></p>
                        <div class="d-flex justify-content-end">
                            <p class="mb-0 fx-n2"><?= $value["a"]->date ?></p>
                        </div>
                    </div>
                <?php elseif(admin() && admin()->id == $data->uid) : ?>
                    <form action="/answerAdd" method="POST" class="py-3 ml-5 border-bottom">
                        <input type="hidden" name="fid" value="<?= $data->id ?>">
                        <input type="hidden" name="qid" value="<?= $value["q"]->id ?>">
                        <div class="d-flex align-items-end gap-2 mb-2">
                            <p class="mb-0 fx-2 text-blue">답변하기</p>
                        </div>
                        <textarea rows="3" style="resize: none;" id="answer" name="content" class="form-control" placeholder="답변"></textarea>
                        <div class="d-flex justify-content-end mt-2">
                            <button class="bg-blue px-3 py-1 text-light">답변</button>
                        </div>
                    </form>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="container padding mt-5">
    <div class="border-bottom border-2 border-blue d-flex align-items-end justify-content-between">
        <div class="mb-3">
            <div class="d-flex align-items-center gap-3">
                <div class="mb-0 title">FESTIVAL REVIEW</div>
                <small class="text-muted mt-1">축제 리뷰</small>
            </div>
            <div class="d-flex gap-3">
                <div>
                    <select name="sort" id="sort" class="form-select fx-n2">
                        <option value="DESC">최신</option>
                        <option value="ASC">오래된 순</option>
                    </select>
                </div>
                <div>
                    <select name="star" id="star" class="form-select fx-n2">
                        <option value="null">전체</option>
                        <option value="1">1점</option>
                        <option value="2">2점</option>
                        <option value="3">3점</option>
                        <option value="4">4점</option>
                        <option value="5">5점</option>
                    </select>
                </div>
            </div>
        </div>
        <?php if(user() && !admin()) : ?>
            <button class="btn-label text-light bg-darkblue" data-bs-toggle="modal" data-bs-target="#review-modal">리뷰 작성</button>
        <?php endif; ?>
    </div>
</div>
<div class="container padding mb-5">
    <div class="col-12" id="review-list">
        <?php foreach($reviews as $key => $value) : ?>
            <div class="py-3 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-end gap-2 mb-2">
                        <p class="mb-0 fx-2 text-blue"><?= $value->name ?></p>
                        <small class="text-muted"><?= $value->userID ?></small>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <i class="fa-solid fa-star text-gold fx-n2"></i>
                        <p class="mb-0 fx-n2"><?= $value->score ?></p>
                    </div>
                </div>
                <p class="pl-3"><?= $value->content ?></p>
                <div class="col-12 d-flex justify-content-between align-items-end mb-2">
                    <div class="images col-8 d-flex">
                        <?php foreach(json_decode($value->images) as $img) : ?>
                            <div style="width: 100px; height: 100px;">
                                <img src="/images/<?= $img ?>" class="fit-cover">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if(count(json_decode($value->images))) : ?>
                    <button class="bg-darkblue text-light px-3 py-2" data-idx="<?= $value->id ?>" data-bs-toggle="modal" data-bs-target="#images-modal">이미지 보기</button>
                    <?php endif; ?>
                </div>
                <div class="d-flex justify-content-end">
                    <p class="mb-0 fx-n2"><?= date("Y-m-d", strtotime($value->date)); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<form action="/festivalTicket" method="post" class="modal fade" id="Ticketing-modal">
    <input type="hidden" value="<?= $data->id ?>" name="id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body px-4 pt-4 pb-3">
                <div class="title text-center">TICKETING</div>
                <div class="mt-4">
                    <div class="form-group mb-3">
                        <label class="mb-1" for="count">인원수</label>
                        <input type="number" id="count" min="1" class="form-control" name="count" placeholder="인원 수">
                    </div>
                    <div class="form-group mb-3">
                        <p class="mb-0 text-blue font-bold">티켓가격</p>
                        <div>
                            <input type="hidden" value="<?= $data->ticketPrice ?>" name="price">
                            <span class="text-gold font-bold fx-3" id="price"><?= $data->ticketPrice ?></span>
                            <small>원</small>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <button id="submit" class="bg-blue text-white w-100 py-3">예매하기</button>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="/festivalReview" method="post" enctype="multipart/form-data" class="modal fade" id="review-modal">
    <input type="hidden" value="<?= $data->id ?>" name="id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body px-4 pt-4 pb-3">
                <div class="title text-center">REVIEW WRITE</div>
                <div class="mt-4">
                    <div class="form-group mb-3">
                        <label class="mb-1" for="files">첨부 이미지</label>
                        <input type="file" multiple accept="image/png, image/jpeg" id="files" class="form-control" name="files[]">
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-1" for="score">별점</label>
                        <input type="range" id="score" class="form-range" name="score">
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-1" for="reviewContent">리뷰</label>
                        <textarea rows="6" style="resize: none;" id="reviewContent" name="content" class="form-control" placeholder="리뷰"></textarea>
                    </div>
                </div>
                <div class="mt-3">
                    <button id="submit" class="bg-blue text-white w-100 py-3">작성</button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="modal fade" id="images-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body px-4 pt-4 pb-3">
                <div class="title text-center">IMAGES</div>
                <div class="mt-4">
                    <div class="form-group mb-3">
                        <div class="image_box main" style="height: 300px;">
                            <img src="/images/" class="fit-cover">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="pl-2 py-1 d-flex align-items-center gap-2 sub">
                            
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <button id="submit" class="bg-blue text-white w-100 py-3" data-bs-dismiss="modal">닫기</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let datas = JSON.parse('<?= json_encode($reviews, JSON_UNESCAPED_UNICODE); ?>'.replaceAll(`"[`, "[").replaceAll(`]"`, "]"));
    
    function sort() {
        let listDom = document.querySelector("#review-list");
        listDom.innerHTML = "";

        let dataSort = document.querySelector("#sort").value;
        let dataStar = document.querySelector("#star").value;

        let printData = [...datas];

        if(dataSort == "DESC") {
            printData.sort((a, b) => new Date(b.date) - new Date(a.date));
        } else {
            printData.sort((a, b) => new Date(a.date) - new Date(b.date));
        }

        if(dataStar !== "null") {
            console.log(dataStar);
            printData = printData.filter(item => item.score == dataStar);
        }

        printData.forEach(item => {
            let images = '';
            item.images.forEach(img => {
                images += `
                    <div style="width: 100px; height: 100px;">
                        <img src="/images/${img}" class="fit-cover">
                    </div>
                `
            })
            listDom.innerHTML += `
                <div class="py-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-end gap-2 mb-2">
                            <p class="mb-0 fx-2 text-blue">${item.name}</p>
                            <small class="text-muted">${item.userID}</small>
                        </div>
                        <div class="d-flex align-items-center gap-1">
                            <i class="fa-solid fa-star text-gold fx-n2"></i>
                            <p class="mb-0 fx-n2">${item.score}</p>
                        </div>
                    </div>
                    <p class="pl-3">${item.content}</p>
                    <div class="col-12 d-flex justify-content-between align-items-end mb-2">
                        <div class="images col-8 d-flex">
                            ${images}
                        </div>
                        <button class="bg-darkblue text-light px-3 py-2" data-idx="${item.id}" data-bs-toggle="modal" data-bs-target="#images-modal">이미지 보기</button>
                    </div>
                    <div class="d-flex justify-content-end">
                        <p class="mb-0 fx-n2">
                            ${new Date(`${item.date}`).getFullYear()}-${String(new Date(`${item.date}`).getMonth() + 1).padStart(2, "0")}-${String(new Date(`${item.date}`).getDate()).padStart(2, "0")}
                        </p>
                    </div>
                </div>
            `
        })
    }

    $("#sort").on("change", sort);
    $("#star").on("change", sort);

    $("#count").on("input", e => {
        document.querySelector("#price").innerHTML = `${ parseInt(e.currentTarget.value) * parseInt(<?= $data->ticketPrice ?>) }`;
    })

    $("#goodAdd").on("click", async e => {
        let formData = new FormData();
        formData.append("id", "<?= $data->id ?>");
        formData.append("good", "<?= $goods->good ?>");

        let result = await post("POST", "/festivalGood", formData);
        if(result.type == "add") {
            e.currentTarget.classList.remove("bg-darkblue");
            e.currentTarget.classList.add("bg-blue");
            document.querySelector("#good").innerHTML = parseInt(document.querySelector("#good").innerHTML) + 1;
        } else {
            e.currentTarget.classList.remove("bg-blue");
            e.currentTarget.classList.add("bg-darkblue");
            document.querySelector("#good").innerHTML = parseInt(document.querySelector("#good").innerHTML) - 1;
        }
    })

    $("#messageAccept").on("click", async e => {
        let formData = new FormData();
        formData.append("id", "<?= $data->id ?>");

        let result = await post("POST", "/messageAccept", formData);
        if(result.type == "accept") {
            e.currentTarget.classList.remove("bg-darkblue");
            e.currentTarget.classList.add("bg-blue");
        } else {
            e.currentTarget.classList.remove("bg-blue");
            e.currentTarget.classList.add("bg-darkblue");
        }
    })

    $("#submit").on("click", e => {
        const EndDate = new Date("<?= $data->startDate ?>");
        const NowDate = new Date();

        if(EndDate < NowDate) {
            e.preventDefault();
            return alert("티켓 예매는 해당 축제 진행 전 혹은 중에만 가능합니다");
        }
    })

    $("#review-modal").on("submit", e => {
        const files = document.querySelector("#files").files;
        if(files.length > 4) {
            e.preventDefault();
            return alert("png 혹은 jpg파일 4개 이하만 첨부 가능합니다");
        }

        for(let i = 0; i < files.length; i++) {
            if(!["jpg", "png"].includes(files[i].name.split(".").pop().toLowerCase())) {
                e.preventDefault();
                return alert("png 혹은 jpg파일 4개 이하만 첨부 가능합니다");
            }
        }
    })

    $('[data-bs-target="#images-modal"]').on("click", e => {
        const targetIdx = e.currentTarget.dataset.idx;
        const targetData = [...datas].find(item => item.id == targetIdx);
        document.querySelector("#images-modal .main > img").src = `/images/${targetData.images[0]}`;

        document.querySelector("#images-modal .sub").innerHTML = "";
        targetData.images.forEach((item, i) => {
            document.querySelector("#images-modal .sub").innerHTML += `
                <div style="width: 100px; height: 100px;">
                    <img src="/images/${item}" class="fit-cover" data-url="/images/${item}">
                </div>
            `
        })
    })

    $("#images-modal .sub").on("click", "img", e => {
        console.log(e.currentTarget);
        document.querySelector("#images-modal .main > img").src = e.currentTarget.dataset.url;
    })
</script>