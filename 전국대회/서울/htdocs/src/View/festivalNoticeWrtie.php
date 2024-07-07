<div class="container padding mt-5">
    <div class="mb-3 border-bottom border-2 border-blue">
        <div class="d-flex align-items-center gap-3">
            <div class="mb-0 title">NOTICE ADD</div>
            <small class="text-muted mt-1">공지 작성</small>
        </div>
    </div>
</div>
<form action="/festivalNoticeWrtie" method="POST" enctype="multipart/form-data" class="container padding mb-5">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="form-group mb-3">
        <label for="title" class="form-label">TITLE</label>
        <input type="text" id="title" name="title" class="form-control" placeholder="제목">
    </div>
    <div class="form-group mb-3">
        <label for="content" class="form-label">CONTENT</label>
        <textarea rows="7" style="resize: none;" id="content" name="content" class="form-control" placeholder="내용"></textarea>
    </div>
    <div class="form-group mb-3">
        <label for="files" class="form-label">FILES</label>
        <input type="file" multiple id="files" name="files[]" class="form-control" placeholder="첨부파일">
    </div>
    <div class="form-group mb-3">
        <button class="w-100 py-2 bg-darkblue text-light">등록</button>
    </div>
</form>
<script>
    $("form").on("submit", e => {
        const files = document.querySelector("#files").files;

        if(files.length > 3) {
            e.preventDefault();
            return alert("파일 3개 이하만 첨부 가능합니다");
        }
    })
</script>