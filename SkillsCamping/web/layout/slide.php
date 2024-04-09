<?php if($_SERVER['REQUEST_URI'] == '/index' || $_SERVER['REQUEST_URI'] == '/') : ?>
    <div id="slide-box" class="slide dis-row">
        <div id="slide-ul" class="d-flex"> <!-- 1275w 725h -->
            <span class="img-container" id="image1" data-id="1"><img src="./image/image_01 (14).jpg" alt=""></span>
            <span class="img-container" id="image2" data-id="2"><img src="./image/image_01 (21).jpg" alt=""></span>
            <span class="img-container" id="image3" data-id="3"><img src="./image/image_01 (12).jpg" alt=""></span>
        </div>
        <div id="icon-list" class="d-flex justify-content-center">
            <div class="dis-row dis-center">
                <i class="fa-solid fa-pause" id="btnPause"></i>
                <i class="fa-solid fa-play" style="display: none;" id="btnStart"></i>
            </div>
            <ul id="icon-list" class="d-flex justify-content-between align-items-center">
                <li class="img-icon slide-img-white pin-btn" data-idx="0"></li>
                <li class="img-icon slide-img-white pin-btn" data-idx="1"></li>
                <li class="img-icon slide-img-white pin-btn" data-idx="2"></li>
            </ul>
        </div>
        <div>
            <p>즐거움과 낭만이 공존하는 편안한 쉼터</p>
            <p class="font-times-bold">CAMPING<br>ENJOY</p>
        </div>
        <div></div>
        <div></div>
        <div class="back-img">
            <img src="./image/image_01 (6)-흑백.jpg" alt="">
        </div>
    </div>
<?php else : ?>
    <div id="slide-box" class="slide dis-row">
        <div id="slide-ul" class="slide-box dis-col dis-wrap"> <!-- 1275w 725h -->
            <span class="" id="image1" data-id="1"><img src="./image/image_01 (21).jpg" alt=""></span>
            <span class="" id="image2" data-id="2"><img src="./image/image_01 (21).jpg" alt=""></span>
            <span class="" id="image3" data-id="3"><img src="./image/image_01 (12).jpg" alt=""></span>
        </div>
        <div class="dis-row aling-center sub-bar">
            <div class="dis-row dis-center">
                <i class="fa-solid fa-house"></i>
            </div>
            <ul class="d-flex">
            </ul>
        </div>
        <div class="text">
            <p>푸른자연과<br>어우러진 낭만가득 힐링스팟</p>
            <p class="font-tahoma-bold">INTRODUCTION<br>CAMPING SITE</p>
        </div>
        <div></div>
        <div></div>
        <div class="back-img">
            <img src="./image/image_01 (7).jpg" alt="">
        </div>
    </div>
<?php endif; ?>