<div class="w-100 bg-blue sub-wrap">    
    <img src="./images/25.jpg" alt="" class="fit-cover filter">
    <div class="w-100">
        <div class="container padding py-3">
            <a href="/" class="text-white">홈</a>
            <i class="fa-solid fa-angle-right mx-3 text-white"></i>
            <a href="/goods" class="text-white">goods</a>
        </div>
    </div>
</div>
<div class="container padding pt-5">
    <div class="border-bottom border-2 border-blue mb-3">
        <div class="pb-3">
            <span class="text-muted">안내</span>
            <div class="title">INFORMATION</div>
        </div>
    </div>
</div>
<div class="container padding pb-5">
<form action="/goods/add" method="post" class="w-100" enctype="multipart/form-data">
    <div class="row">
        <div class="col-3">
            <div class="form-group mb-3">
                <label class="mb-1" for="">사진</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label class="mb-1" for="">상품명</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label class="mb-1" for="">가격</label>
                <input type="text" id="price" name="price" class="form-control">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group mb-3 h-50">
                <label class="mb-1" for="">goods상세설명</label>
                <textarea id="comment" name="comment" class="form-control" class="w-100"></textarea>
            </div>  
            <div class="form-group mb-3 h-50">
                <label class="mb-1" for="">goods상세설명</label>
                <textarea id="comment2" name="comment2" class="form-control" class="w-100"></textarea>
            </div>  
        </div>
        <div class="col-5">
            <button class="w-100 py-3 text-white bg-blue">goods등록</button>
        </div>
    </div>
</form>
</div>
<div class="container padding pt-5">
    <div class="border-bottom border-2 border-blue mb-4">
        <div class="d-flex align-items-end justify-content-between">
            <div class="pb-3">
                <span class="text-muted">안내</span>
                <div class="title">INFORMATION</div>
            </div>
        </div>
    </div>
</div>
<div class="container padding pb-5 goods-list">
    <div class="row" id="content">
        <?php foreach($data as $item) : ?>
            <a href="/goods/item?id=<?= $item->id ?>" class="col-4 mb-4">
                <div class="item">
                    <div class="image__area" data-id="<?= $item->id ?>">
                        <img src="./images/<?= $item->image ?>" alt="" class="fit-cover">
                    </div>
                    <div class="text px-2 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <div class="fx-2 text-blue"><?= $item->name ?></div>
                            </div>
                            <div class="text-end">
                                <div>
                                    <span class="fx-3 text-gold"><?= $item->price ?></span>
                                    <small class="text-muted">원</small>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="bg-blue text-white px-3 py-2">관심goods</button>
                            <button class="bg-blue text-white px-3 py-2">장바구니</button>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
<script>
    // window.app = new Goods();
</script>