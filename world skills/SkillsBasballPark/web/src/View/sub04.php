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