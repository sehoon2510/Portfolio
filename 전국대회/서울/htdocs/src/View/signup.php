<div class="container padding mt-5">
    <div class="mb-3 border-bottom border-2 border-blue">
        <div class="d-flex align-items-center gap-3">
            <div class="mb-0 title">SIGN UP</div>
            <small class="text-muted mt-1">회원가입</small>
        </div>
    </div>
</div>
<form action="/signup" method="POST" class="container padding mb-5">
    <div class="form-group mb-3">
        <label for="user_id" class="form-label">ID</label>
        <input type="text" id="user_id" name="userID" class="form-control" placeholder="아이디">
    </div>
    <div class="form-group mb-3">
        <label for="user_id" class="form-label">NAME</label>
        <input type="text" id="user_name" name="name" class="form-control" placeholder="이름">
    </div>
    <div class="form-group mb-3">
        <label for="user_pass" class="form-label">PASSWORD</label>
        <input type="password" id="user_pass" name="pass" class="form-control" placeholder="비밀번호">
    </div>
    <div class="form-group mb-3">
        <label for="user_pass_check" class="form-label">PASSWORD-CHECK</label>
        <input type="password" id="user_pass_check" class="form-control" placeholder="비밀번호 확인">
    </div>
    <div class="form-group mb-3">
        <label for="user-type" class="form-label">TYPE</label>
        <select name="type" id="user-type" class="form-select">
            <option value="일반회원">일반회원</option>
            <option value="운영자">기업회원</option>
        </select>
    </div>
    <div class="form-group mb-3" id="company-form">
        <label for="company" class="form-label">COMPANY</label>
        <input type="text" id="company" name="company" class="form-control" value="" placeholder="기업명">
    </div>
    <div class="form-group mb-3">
        <button class="w-100 py-2 bg-darkblue text-light">회원가입</button>
    </div>
</form>
<script>
    if(document.querySelector('[name="type"]') == "운영지") $("#company-form").show();
    else $("#company-form").hide();

    $('[name="type"]').on("change", e => {
        if(e.currentTarget.value == "운영지") $("#company-form").show();
        else $("#company-form").hide();
    })

    $("form").on("submit", e => {
        
        if(!/[0-9a-z]{8,}/.test(document.querySelector('[name="userID"]').value)) {
            e.preventDefault();
            return alert("아이디을 확인해주세요");
        }
        
        if(/[0-9]{8,}/.test(document.querySelector('[name="userID"]').value)) {
            e.preventDefault();
            return alert("아이디을 확인해주세요");
        }
        
        if(!/[ㄱ-ㅎㅏ-ㅣ가-힣]{2,6}/.test(document.querySelector('[name="name"]').value)) {
            e.preventDefault();
            return alert("이름을 확인해주세요");
        }
        
        if(!/[0-9a-z]{8,}/.test(document.querySelector('[name="pass"]').value)) {
            e.preventDefault();
            return alert("비밀번호을 확인해주세요");
        }

        if(/[0-9a-z]{8,}/.test(document.querySelector('[name="pass"]').value))
            if(!/[0-9]/.test(document.querySelector('[name="pass"]').value) || !/[0-9]/.test(document.querySelector('[name="pass"]').value)) {
                e.preventDefault();  
                return alert("비밀번호을 확인해주세요");
            }

        if(document.querySelector('[name="pass"]').value != document.querySelector("#user_pass_check").value) {
            e.preventDefault();
            return alert("비밀번호 확인을 확인해주세요");
        }

        if(document.querySelector('[name="type"]').value === "운영지" && document.querySelector('[name="company"]').value.trim() == "") {
            e.preventDefault();
            return alert("기업명을 확인해주세요");
        }
    })
</script>