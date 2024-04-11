    <div class="container padding pt-5 pb-5 px-0">
        <div class="sticky-top bg-white pt-5">
            <div class="pb-3">
                <span class="text-muted">장바구니</span>
                <div class="title">CART</div>
            </div>
            <div class="cartList_header border-bottom d-flex align-items-center py-2">
                <div class="header__item text-center col-6 p-0 fx-n2 text-muted">상품정보</div>
                <div class="header__item text-center col-2 p-0 fx-n2 text-muted">가격</div>
                <div class="header__item text-center col-1 p-0 fx-n2 text-muted">수량</div>
                <div class="header__item text-center col-2 p-0 fx-n2 text-muted">합계</div>
                <div class="header__item text-center font-bold col-1 p-0 fx-n2 text-muted">+</div>
            </div>
        </div>
        <div class="cart mb-5">
            <div class="cartList__body border-top" id="cart">
                
            </div>
            <div class="mt-4 d-flex align-items-center justify-content-between">
                <p class="mb-0">
                    <span class="text-muted">총합계</span>
                    <span class="text-gold fx-3 ml-3" id="total">1,000,000,000,000</span>
                    <small class="text-muted">원</small>
                </p>
                <button class="btn-label bg-blue text-white fx-n3" data-toggle="modal" data-target="#buy-modal">
                    구매하기
                </button>
            </div>
        </div>
    </div>
    <div class="pt-5 pb-5 px-0 bg-gray">
        <div class="container padding p-0">
            <div class="sticky-top d-flex justify-content-between border-bottom align-items-end bg-gray pt-5">
                <div class="pb-3">
                    <span class="text-muted">인테리어 스토어</span>
                    <div class="title">STORE</div>
                </div>
                <div class="d-flex align-items-center justify-content-center gap-3 col-4 pb-3 px-0">
                    <input type="checkbox" id="open-cart" class="d-none" checked>
                    <div class="search col-8 d-flex buy-count pl-2 py-1">
                        <div class="icon">
                            <i class="fa fa-search text-muted"></i>
                        </div>
                        <input type="text" id="search" class="ml-3 fx-n1" placeholder="검색어를 입력하세요">
                    </div>
                    <label for="open-cart">
                        <i class="fa fa-shopping-cart fa-lg text-blue"></i>
                    </label>
                    <div id="drop-area" class="d-none">
                        <div class="text-center text-white">
                            <div class="success item-center">
                                <i class="fa fa-check fa-3x"></i>
                                <p class="mt-4 fx-n2 text-nowrap">상품이 장바구니에 담겼습니다!</p>
                            </div>
                            <div class="error item-center">
                                <i class="fa fa-times fa-3x"></i>
                                <p class="mt-4 fx-n2 text-nowrap">이미 장바구니에 담긴 상품입니다.</p>
                            </div>
                            <div class="normal item-center">
                                <i class="fa fa-shopping-cart fa-3x"></i>
                                <p class="mt-4 fx-n2 text-nowrap">이곳에 상품을 넣어주세요.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="store d-flex flex-wrap align-content-start pt-4" id="store">
                <div class="item">
                    <div class="image__area d-flex align-items-center justify-content-center">
                        <img src="./image/상품사진/product_1.jpg" alt="sopItem">
                    </div>
                    <div class="text__area d-flex justify-content-between align-items-center py-3 px-2">
                        <div class="name">
                            <small class="text-muted fx-n2">마틸라</small>
                            <p class="mb-0 fx-2">마틸라</p>
                        </div>
                        <div class="price">
                            <p class="mb-0">
                                <span class="fx-3 text-gold">10,000</span>
                                <small class="text-muted">원</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="view-modal" class="modal fade">
        <div class="modal-dialog"></div>
        <img alt="구매 내역" class="mw-100 item-center">
    </div>
    <form id="buy-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body px-4 pt-4 pb-3">
                    <div class="title text-center">BUY ITEM</div>
                    <div class="mt-4">
                        <div class="form-group">
                            <label for="user_name">구매자 이름</label>
                            <input type="text" id="user_name" class="form-control" name="user_name" placeholder="구매자 이름을(를) 입력하세요" required>
                        </div>
                        <div class="form-group">
                            <label for="address">주소</label>
                            <input type="text" id="address" class="form-control" name="address" placeholder="주소을(를) 입력하세요" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="w-100 py-3 bg-blue text-white" type="submit">구매 완료</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<script>
    window.app = new Store();
</script>