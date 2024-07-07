<div class="container padding mt-5">
    <div class="mb-3 border-bottom border-2 border-blue">
        <div class="d-flex align-items-center gap-3">
            <div class="mb-0 title">LOGIN</div>
            <small class="text-muted mt-1">로그인</small>
        </div>
    </div>
</div>
<form action="/login" method="POST" class="container padding mb-5">
    <div class="form-group mb-3">
        <label for="user_id" class="form-label">ID</label>
        <input type="text" id="user_id" name="userID" class="form-control" placeholder="아이디">
    </div>
    <div class="form-group mb-3">
        <label for="user_pass" class="form-label">PASSWROD</label>
        <input type="passwrod" id="user_pass" name="pass" class="form-control" placeholder="비밀번호">
    </div>
    <div class="form-group mb-3">
        <button class="w-100 py-2 bg-darkblue text-light">로그인</button>
    </div>
</form>