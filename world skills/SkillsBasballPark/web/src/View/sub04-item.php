<div class="w-100 bg-blue sub-wrap">    
    <img src="/images/25.jpg" alt="" class="fit-cover filter">
    <div class="w-100">
        <div class="container padding py-3">
            <a href="/" class="text-white">홈</a>
            <i class="fa-solid fa-angle-right mx-3 text-white"></i>
            <a href="/goods" class="text-white">goods</a>
        </div>
    </div>
</div>
<div class="container padding pt-5">
    <div class="mb-4 border-bottom border-2 border-blue">
        <div class="pb-2 d-flex align-items-center gap-2">
            <div class="title">PRODUCT DATA</div>
            <small class="mt-1 text-blue font-bold">상품 상세정보</small>
        </div>
    </div>
</div>  
<div class="container padding pb-5">
    <div class="row">
        <div class="col-8 info-wrap">
            <img src="/images/<?= $data->image ?>" alt="" class="fit-cover">
        </div>
        <form class="col-4" action="/goods/page" method="GET">
            <input type="hidden" value="<?= $data->id ?>" name="id">
            <div class="title fx-3 font-bold mb-2"><?= $data->name ?></div>
            <div class="pt-1 pb-5">
                <span class="fx-2 text-gold font-bold"><?= $data->price ?></span>
                <small class="fx-n2 text-muted">원</small>
            </div>
            <input type="number" class="form-control" placeholder="수량을 입력하세요" name="cnt">
            <div class="row py-3">
                <div class="col-6">
                    <a href="/goods/user?id=<?= $data->id ?>" class="d-block text-center w-100 bg-blue text-white py-2 fx-n2">관심goods등록</a>
                </div>
                <div class="col-6">
                    <a href="/goods/cart?id=<?= $data->id ?>" class="d-block text-center fx-n2 w-100 bg-blue text-white py-2 text-white">장바구니</a>
                </div>
            </div>
            <button class="w-100 py-2 text-white bg-blue">바로구매</button>
            <div class="pt-3 w-100 overflow-hidden">
                <span class="w-100" style="white-space: normal; word-wrap: break-word;"><?= $data->comment ?></span>
            </div>
        </form>
        <div class="col-4">
            
        </div>
    </div>
</div>