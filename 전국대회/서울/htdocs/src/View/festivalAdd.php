<div class="container padding mt-5">
    <div class="mb-3 border-bottom border-2 border-blue">
        <div class="d-flex align-items-center gap-3">
            <div class="mb-0 title">FESTIVAL ADD</div>
            <small class="text-muted mt-1">축제 추가</small>
        </div>
    </div>
</div>
<form action="/festivalAdd" method="POST" enctype="multipart/form-data" class="container padding mb-5">
    <div class="form-group mb-3">
        <label for="fs-name" class="form-label">FESTIVAL NAME</label>
        <input type="text" id="fs-name" name="name" class="form-control" placeholder="축제명">
    </div>
    <div class="form-group mb-3">
        <label for="content" class="form-label">CONTENT</label>
        <textarea rows="7" style="resize: none;" id="content" name="content" class="form-control" placeholder="내용"></textarea>
    </div>
    <div class="form-group mb-3">
        <label for="image" class="form-label">IMAGE</label>
        <input type="file" accept="image/*" id="image" name="image" class="form-control" placeholder="이미지">
    </div>
    <div class="form-group mb-3">
        <label for="StartDate" class="form-label">START DATE & TIME</label>
        <div class="input-group">
            <input type="date" id="StartDate" name="StartDate" class="form-control" placeholder="시작 날짜">
            <span class="input-group-text">#</span>
            <input type="time" id="StartTiem" name="StartTime" class="form-control" placeholder="시작 시간">
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="EndDate" class="form-label">END DATE & TIME</label>
        <div class="input-group">
            <input type="date" id="EndDate" name="EndDate" class="form-control" placeholder="끝 날짜">
            <span class="input-group-text">#</span>
            <input type="time" id="EndTiem" name="EndTime" class="form-control" placeholder="끝 시간">
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="user_pass_check" class="form-label">HOST CITY</label>
        <select name="city" id="city" class="form-select">
            <option hidden value="null">주최/도시를 선택해 주세요.</option>
            <option value="안동 (Andong)">안동 (Andong)</option>
            <option value="구미 (Gumi)">구미 (Gumi)</option>
            <option value="경주 (Gyeongju)">경주 (Gyeongju)</option>
            <option value="경산 (Gyeongsan)">경산 (Gyeongsan)</option>
            <option value="상주 (Sangju)">상주 (Sangju)</option>
            <option value="김천 (Gimcheon)">김천 (Gimcheon)</option>
            <option value="영주 (Yeongju)">영주 (Yeongju)</option>
            <option value="영천 (Yeongcheon)">영천 (Yeongcheon)</option>
            <option value="문경 (Mungyeong)">문경 (Mungyeong)</option>
            <option value="경북 (Gyeongbuk)">경북 (Gyeongbuk)</option>
            <option value="울진 (Uljin)">울진 (Uljin)</option>
            <option value="포항 (Pohang)">포항 (Pohang)</option>
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="company" class="form-label">SUBJECTIVITY</label>
        <input type="text" id="company" name="company" value="<?= admin()->company ?>" class="form-control" placeholder="주관/기업명" readonly>
    </div>
    <div class="form-group mb-3">
        <label for="address" class="form-label">ADDRESS</label>
        <input type="text" id="address" name="address" class="form-control" placeholder="주소">
    </div>
    <div class="form-group mb-3">
        <label for="phone" class="form-label">PHONE</label>
        <input type="text" id="phone" name="phone" class="form-control" placeholder="전화번호">
    </div>
    <div class="form-group mb-3">
        <label for="price" class="form-label">TICKETPRICE</label>
        <div class="input-group">
            <input type="number" id="price" name="price" class="form-control" placeholder="티켓 가격">
            <span class="input-group-text">원</span>
        </div>
    </div>
    <div class="form-group mb-3">
        <button class="w-100 py-2 bg-darkblue text-light">등록</button>
    </div>
</form>
<script>
    $("form").on("submit", e => {
        if(document.querySelector("#city").value == "null") {
            e.preventDefault();
            return;
        }
    })
</script>