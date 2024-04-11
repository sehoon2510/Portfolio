<?php require_once "./core/head.php"; ?>
<?php require_once "./core/header.php"; ?>
        <section class="col-12">
            <div class="col-12 d-flex align-items-center">
                <div class="col-10 offset-1 d-flex align-items-center justify-content-between game__page">
                    <div class="d-flex flex-column gap-3 justify-content-center align-items-end">
                        <div class="content__card__item d-flex">
                            <div class="image__area d-flex flex-wrap">
                                <div class="image__item d-flex align-items-center justify-content-center">
                                    <img src="./image/photo (14).jpg" alt="ItemImage1">
                                </div>
                                <div class="image__item d-flex align-items-center justify-content-center">
                                    <img src="./image/photo (15).jpg" alt="ItemImage2">
                                </div>
                                <div class="image__item d-flex align-items-center justify-content-center">
                                    <img src="./image/photo (2).jpg" alt="ItemImage3">
                                </div>
                                <div class="image__item d-flex align-items-center justify-content-center">
                                    <img src="./image/photo (6).jpg" alt="ItemImage4">
                                </div>
                            </div>
                            <div class="text__area">
                                <div class="card__item__title d-flex align-items-center justify-content-center">
                                    <p class="mb-0 text-light">경상남도 특산품을 기억하라!</p>
                                </div>
                                <div class="card__item__content d-flex flex-column align-items-center justify-content-center">
                                    <p class="mb-0 text-light">경상남도 특산품을 기억하라!</p>
                                    <p class="mb-0 text-light">같은 카드 찾기 게임에 3일 연속 이벤트에 참여해 주신 분 중</p>
                                    <p class="mb-0 text-light"> 100분을 추첨하여 전통시장 및 상점에서 사용 가능한</p>
                                    <p class="mb-0 text-light">“온누리 상품권 5,000원권”을 보내 드립니다.</p>
                                    <p class="mb-0 text-light">경상남도 특산품도 알아보고 재미있는 게임도</p>
                                    <p class="mb-0 text-light">즐길 수 있는 이번 이벤트에 많은 참여 바랍니다.</p>
                                    <br>
                                    <p class="mb-0 text-light">○ 이벤트 참여 및 경품 안내</p>
                                    <p class="mb-0 text-light">- 참여방법 : 3일 연속으로 아래의 같은 카드 찾기 게임 참여하기</p>
                                    <p class="mb-0 text-light">- 경품안내 : 온누리 상품권 5,000원권</p>
                                    <p class="mb-0 text-light">- 당첨대상 : 3일 연속 게임 이벤트에 참여한 분 중 100명 추첨</p>
                                </div>
                            </div>
                        </div>
                        <div class="stampe__container">
                            <div class="stampe__content col-12 d-flex align-items-center justify-content-center gap-3 px-3">
                                <div class="stampe__area">
                                    <div class="area d-flex align-items-center justify-content-center col-12">
                                        <div class="text__area col-12 pt-2 pb-2 d-flex align-items-center justify-content-center">
                                            <p class="mb-0">스템프</p>
                                        </div>
                                    </div>
                                    <div class="stampe d-flex align-items-center justify-content-center col-12">
                                        <div class="text__area col-12 pt-2 pb-2 d-flex align-items-center justify-content-center">
                                            <p class="mb-0">2024-02-03</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="stampe__area">
                                    <div class="area d-flex align-items-center justify-content-center col-12">
                                        <div class="text__area col-12 pt-2 pb-2 d-flex align-items-center justify-content-center">
                                            <p class="mb-0">스템프</p>
                                        </div>
                                    </div>
                                    <div class="stampe d-flex align-items-center justify-content-center col-12">
                                        <div class="text__area col-12 pt-2 pb-2 d-flex align-items-center justify-content-center">
                                            <p class="mb-0">2024-02-03</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="stampe__area">
                                    <div class="area d-flex align-items-center justify-content-center col-12">
                                        <div class="text__area col-12 pt-2 pb-2 d-flex align-items-center justify-content-center">
                                            <p class="mb-0">스템프</p>
                                        </div>
                                    </div>
                                    <div class="stampe d-flex align-items-center justify-content-center col-12">
                                        <div class="text__area col-12 pt-2 pb-2 d-flex align-items-center justify-content-center">
                                            <p class="mb-0">2024-02-03</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="game__container col-5 d-flex flex-column align-items-center">
                        <div class="game__header col-12 d-flex align-items-center justify-content-between mb-2">
                            <div class="btn__list d-flex align-items-center gap-2">
                                <button class="btn btn-dark" id="startBtn">게임시작</button>
                                <button class="btn btn-dark" id="hintBtn">힌트보기</button>
                            </div>
                            <div class="status">
                                <p class="mb-0 text-light" id="timeZone">남은 시간 : 00:05</p>
                                <p class="mb-0 text-light" id="scoreZone">찾은 카드 수 : 0개</p>
                            </div>
                        </div>
                        <div class="game__area px-2 pt-2 pb-2 d-flex flex-wrap gap-2 align-items-center justify-content-center align-content-start" id="content">
                            <div class="game__card__item">
                                <div class="game__card">
                                    <div class="back d-flex align-items-center justify-content-center clickCard">
                                        <p class="mb-0 text-light clickCard">힘내라 경남!</p>
                                    </div>
                                    <div class="on">
                                        <div class="image__area d-flex align-items-center justify-content-center">
                                            <img src="./image/합천군_돼지고기.jpg" alt="gameImage1">
                                        </div>
                                        <div class="text__area d-flex justify-content-center align-items-center">
                                            <p class="mb-0 text-light">합천군</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="game__card__item">
                                <div class="game__card">
                                    <div class="back d-flex align-items-center justify-content-center clickCard">
                                        <p class="mb-0 text-light clickCard">힘내라 경남!</p>
                                    </div>
                                    <div class="on">
                                        <div class="image__area d-flex align-items-center justify-content-center">
                                            <img src="./image/합천군_돼지고기.jpg" alt="gameImage1">
                                        </div>
                                        <div class="text__area d-flex justify-content-center align-items-center">
                                            <p class="mb-0 text-light">합천군</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="game__card__item">
                                <div class="game__card">
                                    <div class="back d-flex align-items-center justify-content-center clickCard">
                                        <p class="mb-0 text-light clickCard">힘내라 경남!</p>
                                    </div>
                                    <div class="on">
                                        <div class="image__area d-flex align-items-center justify-content-center">
                                            <img src="./image/합천군_돼지고기.jpg" alt="gameImage1">
                                        </div>
                                        <div class="text__area d-flex justify-content-center align-items-center">
                                            <p class="mb-0 text-light">합천군</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="game__card__item">
                                <div class="game__card">
                                    <div class="back d-flex align-items-center justify-content-center clickCard">
                                        <p class="mb-0 text-light clickCard">힘내라 경남!</p>
                                    </div>
                                    <div class="on">
                                        <div class="image__area d-flex align-items-center justify-content-center">
                                            <img src="./image/합천군_돼지고기.jpg" alt="gameImage1">
                                        </div>
                                        <div class="text__area d-flex justify-content-center align-items-center">
                                            <p class="mb-0 text-light">합천군</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="game__card__item">
                                <div class="game__card">
                                    <div class="back d-flex align-items-center justify-content-center clickCard">
                                        <p class="mb-0 text-light clickCard">힘내라 경남!</p>
                                    </div>
                                    <div class="on">
                                        <div class="image__area d-flex align-items-center justify-content-center">
                                            <img src="./image/합천군_돼지고기.jpg" alt="gameImage1">
                                        </div>
                                        <div class="text__area d-flex justify-content-center align-items-center">
                                            <p class="mb-0 text-light">합천군</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="game__card__item">
                                <div class="game__card">
                                    <div class="back d-flex align-items-center justify-content-center clickCard">
                                        <p class="mb-0 text-light clickCard">힘내라 경남!</p>
                                    </div>
                                    <div class="on">
                                        <div class="image__area d-flex align-items-center justify-content-center">
                                            <img src="./image/합천군_돼지고기.jpg" alt="gameImage1">
                                        </div>
                                        <div class="text__area d-flex justify-content-center align-items-center">
                                            <p class="mb-0 text-light">합천군</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="game__card__item">
                                <div class="game__card">
                                    <div class="back d-flex align-items-center justify-content-center clickCard">
                                        <p class="mb-0 text-light clickCard">힘내라 경남!</p>
                                    </div>
                                    <div class="on">
                                        <div class="image__area d-flex align-items-center justify-content-center">
                                            <img src="./image/합천군_돼지고기.jpg" alt="gameImage1">
                                        </div>
                                        <div class="text__area d-flex justify-content-center align-items-center">
                                            <p class="mb-0 text-light">합천군</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="game__card__item">
                                <div class="game__card">
                                    <div class="back d-flex align-items-center justify-content-center clickCard">
                                        <p class="mb-0 text-light clickCard">힘내라 경남!</p>
                                    </div>
                                    <div class="on">
                                        <div class="image__area d-flex align-items-center justify-content-center">
                                            <img src="./image/합천군_돼지고기.jpg" alt="gameImage1">
                                        </div>
                                        <div class="text__area d-flex justify-content-center align-items-center">
                                            <p class="mb-0 text-light">합천군</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="game__card__item">
                                <div class="game__card">
                                    <div class="back d-flex align-items-center justify-content-center clickCard">
                                        <p class="mb-0 text-light clickCard">힘내라 경남!</p>
                                    </div>
                                    <div class="on">
                                        <div class="image__area d-flex align-items-center justify-content-center">
                                            <img src="./image/합천군_돼지고기.jpg" alt="gameImage1">
                                        </div>
                                        <div class="text__area d-flex justify-content-center align-items-center">
                                            <p class="mb-0 text-light">합천군</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="game__card__item">
                                <div class="game__card">
                                    <div class="back d-flex align-items-center justify-content-center clickCard">
                                        <p class="mb-0 text-light clickCard">힘내라 경남!</p>
                                    </div>
                                    <div class="on">
                                        <div class="image__area d-flex align-items-center justify-content-center">
                                            <img src="./image/합천군_돼지고기.jpg" alt="gameImage1">
                                        </div>
                                        <div class="text__area d-flex justify-content-center align-items-center">
                                            <p class="mb-0 text-light">합천군</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="game__card__item">
                                <div class="game__card">
                                    <div class="back d-flex align-items-center justify-content-center clickCard">
                                        <p class="mb-0 text-light clickCard">힘내라 경남!</p>
                                    </div>
                                    <div class="on">
                                        <div class="image__area d-flex align-items-center justify-content-center">
                                            <img src="./image/합천군_돼지고기.jpg" alt="gameImage1">
                                        </div>
                                        <div class="text__area d-flex justify-content-center align-items-center">
                                            <p class="mb-0 text-light">합천군</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="game__card__item">
                                <div class="game__card">
                                    <div class="back d-flex align-items-center justify-content-center clickCard">
                                        <p class="mb-0 text-light clickCard">힘내라 경남!</p>
                                    </div>
                                    <div class="on">
                                        <div class="image__area d-flex align-items-center justify-content-center">
                                            <img src="./image/합천군_돼지고기.jpg" alt="gameImage1">
                                        </div>
                                        <div class="text__area d-flex justify-content-center align-items-center">
                                            <p class="mb-0 text-light">합천군</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="game__card__item">
                                <div class="game__card">
                                    <div class="back d-flex align-items-center justify-content-center clickCard">
                                        <p class="mb-0 text-light clickCard">힘내라 경남!</p>
                                    </div>
                                    <div class="on">
                                        <div class="image__area d-flex align-items-center justify-content-center">
                                            <img src="./image/합천군_돼지고기.jpg" alt="gameImage1">
                                        </div>
                                        <div class="text__area d-flex justify-content-center align-items-center">
                                            <p class="mb-0 text-light">합천군</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="game__card__item">
                                <div class="game__card">
                                    <div class="back d-flex align-items-center justify-content-center clickCard">
                                        <p class="mb-0 text-light clickCard">힘내라 경남!</p>
                                    </div>
                                    <div class="on">
                                        <div class="image__area d-flex align-items-center justify-content-center">
                                            <img src="./image/합천군_돼지고기.jpg" alt="gameImage1">
                                        </div>
                                        <div class="text__area d-flex justify-content-center align-items-center">
                                            <p class="mb-0 text-light">합천군</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="game__card__item">
                                <div class="game__card">
                                    <div class="back d-flex align-items-center justify-content-center clickCard">
                                        <p class="mb-0 text-light clickCard">힘내라 경남!</p>
                                    </div>
                                    <div class="on">
                                        <div class="image__area d-flex align-items-center justify-content-center">
                                            <img src="./image/합천군_돼지고기.jpg" alt="gameImage1">
                                        </div>
                                        <div class="text__area d-flex justify-content-center align-items-center">
                                            <p class="mb-0 text-light">합천군</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="game__card__item">
                                <div class="game__card">
                                    <div class="back d-flex align-items-center justify-content-center clickCard">
                                        <p class="mb-0 text-light clickCard">힘내라 경남!</p>
                                    </div>
                                    <div class="on">
                                        <div class="image__area d-flex align-items-center justify-content-center">
                                            <img src="./image/합천군_돼지고기.jpg" alt="gameImage1">
                                        </div>
                                        <div class="text__area d-flex justify-content-center align-items-center">
                                            <p class="mb-0 text-light">합천군</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="form" id="form">
            <div class="form-content col-3">
                <div class="form-header px-3 d-flex align-items-center justify-content-center">
                    <p class="mb-0">참여정보 등록</p>
                </div>
                <div class="form-section px-3">
                    <div class="mb-3">
                        <label for="name" class="form-label">이름</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">전화번호</label>
                        <input type="text" class="form-control" id="phone">
                    </div>
                </div>
                <div class="form-footer px-3">
                    <button class="btn btn-primary" id="saveBtn">등록</button>
                </div>
            </div>
        </div>
        <script>
            window.app = new Game();
        </script>
    <?php require_once "./core/footer.php"; ?>