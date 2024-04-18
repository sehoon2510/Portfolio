class Slide
{
    constructor(selector)
    {
        this.idx = 0;
        this.setNext = -1; //다음에 가야할 걸 설정한 경우
        this.slideStatus = "play"; //슬라이드 상태

        this.container = document.querySelector(selector);
        this.images = this.container.querySelectorAll(".img-container");

        this.images[0].style.left = 0;
        
        this.interval;
        this.timer;

        this.slideInAnim = [
            { left: "100%" },
            { left: "0%" }
        ];

        this.slideOutAnim = [
            { left: "0" },
            { left: "-100%"}
        ];

        this.slideTiming = {
            duration: 1000,
            easing:"ease-in",
            fill:"forwards"
        }

        this.animation = [];
        this.startSlide(); //슬라이드 시작

        //버튼 이벤트 리스너
        document.querySelector("#btnStart").addEventListener("click", e => this.pause(true));
        document.querySelector("#btnPause").addEventListener("click", e => this.pause(false));

        $('#icon-list')[0].querySelectorAll(".pin-btn").forEach(pin => {
            pin.addEventListener("click", e => this.numberSlide(pin.dataset.idx));
        });
    }

    //시작 또는 일시정지버튼 눌렀을 때 코드
    pause = async (value) =>{
        console.log(this.slideStatus);
        if(value)
        {
            if(this.slideStatus === "play") return;
            this.slideStatus = "play";
            $('#btnPause')[0].style.display = "block";
            $('#btnStart')[0].style.display = "none";
            this.animation.forEach(a => a.play());
            Promise.all(this.animation.map(a => a.finished)).then( ()=>{
                if(this.slideStatus === "play") //여전히 플레이 상태를 유지했을 경우에만 스타트
                    this.startSlide();
            });
        }else {
            if(this.slideStatus === "pause") return;
            this.slideStatus = "pause";
            $('#btnPause')[0].style.display = "none";
            $('#btnStart')[0].style.display = "block";
            clearTimeout(this.timer);
            clearInterval(this.interval); //인터벌 지우고
            this.animation.forEach(a => a.pause());
        }
    }

    numberSlide = (num)=> {
        if(num == this.idx) return; //같은 번호로 이동하려면 중지
        this.slideStatus = "play";
        clearInterval(this.interval);
        clearTimeout(this.timer);
        this.animation.forEach(a => a.finish()); //즉시 모든 애니메인 종료
        this.setNext = num; //다음에 가야할 번호 설정
        this.startSlide(true);
    }
    
    startSlide(immediate = false)
    {
        if(immediate)
        {
            this.slide(); //즉시일 경우 한번하고 끝나면 인터벌
            this.timer = setTimeout(()=>{
                this.interval = setInterval(()=>this.slide(), 2000); //2초에 한번씩
            }, 1000);
        }else{
            //즉시가 아니면 그냥 인터벌
            this.interval = setInterval(()=>this.slide(), 2000); //2초에 한번씩
        }
        
    }

    slide()
    {
        let nextIdx = (this.idx + 1) % this.images.length; //다음 슬라이드의 인덱스
        if(this.setNext >= 0)
        {
            nextIdx = this.setNext;
            this.setNext = -1;
        }
        
        let nextImage = this.images[nextIdx];
        let currentImage = this.images[this.idx];

        nextImage.style.left = "100%";
        this.animation = []; //비우고

        setTimeout(()=> {
            this.animation.push(nextImage.animate(this.slideInAnim, this.slideTiming));
            this.animation.push(currentImage.animate(this.slideOutAnim, this.slideTiming));
        }, 0); //다음 프레임에 애니메이션 시작

        this.idx = nextIdx;
    }

    ElementActive(length, id, type, active)
    {

        for(let i = 0; i < length; i++){
            
            if(type == 'add'){

                document.querySelector(`${id}${i}`).classList.add(`${active}`);
                
            } else if(type == 'remove'){

                document.querySelector(`${id}${i}`).classList.remove(`${active}`);

            }
        }
    }

}

class TalbeDrow
{
    constructor(list)
    {
        this.table = $('#table')[0];
        this.tableHeader = $('#table-header')[0];

        this.list = list.reservition;
        this.TextHistory = '';
        this.PhoneHistory = '';

        this.init(list.today);
        this.Drow(this.list);

    }

    init(nowStr)
    {
        this.now = new Date(nowStr);

        this.lastDayOfMonth = new Date(this.year, this.month, 0).getDate();

    
        for(let i = 0; i < 14; i++){
            console.log(this.DateFromet(this.now, i));
        }
    }

    Drow(data)
    {
        this.table.innerHTML = '';
        this.tableHeader.innerHTML = '<div class=""></div>';

        this.lastDayOfMonth = new Date(this.year, this.month, 0).getDate();

        for(let i = 0; i < data[0]['D+0'].length; i++){
            this.tableHeader.innerHTML += `<div class="check item dis-row dis-center">${data[0]['D+0'][i].loc_num}</div>`;
        }

        let protoDay = this.DateFromet(this.now).day;
        let protoMonth = this.DateFromet(this.now).month;
        let protoyear = this.DateFromet(this.now).year;

        let protoNowDay = `${protoyear}-${protoMonth}-${protoDay}`;               

        for(let i = 0; i < data.length; i++){
            
            let day = this.DateFromet(this.now, i).day;

            let Datemonth = this.DateFromet(this.now, i).month;

            let Dateyear = this.DateFromet(this.now, i).year;

            let nowDay = `${Dateyear}-${Datemonth}-${day}`;

            if(nowDay == protoNowDay){
                this.table.innerHTML += this.makeTemplate(['item', 'dis-row dis-center'], `day${nowDay}`, '오늘', 'div', '');
            } else {
                this.table.innerHTML += this.makeTemplate(['item', 'dis-row dis-center'], `day${nowDay}`, `${nowDay}`, 'div', '');
            }

            for(let z = 0; z < data[i][`D+${i}`].length; z++){
            
                if(data[i][`D+${i}`][z].status == 'W'){
                    $(`#day${nowDay}`)[0].innerHTML += 
                        this.makeTemplate(
                            ['item check dis-row dis-center', 'tent-line icon'],
                            '', '', 'img',
                            `src="./image/tent-line.svg" data-day="${new Date(`${nowDay}`).getDay()}" data-seat="${data[i][`D+${i}`][z].loc_num}" data-now="${nowDay}"`
                        );
                } else if(data[i][`D+${i}`][z].status == 'C'){
                    $(`#day${nowDay}`)[0].innerHTML += 
                        this.makeTemplate(
                            ['item check dis-row dis-center', 'fa-solid fa-tent icon'],
                            '', '', 'i',
                            `data-day="${new Date(`${nowDay}`).getDay()}" data-seat="${data[i][`D+${i}`][z].loc_num}" data-now="${nowDay}"`
                        );
                } else if(data[i][`D+${i}`][z].status == 'R'){
                    $(`#day${nowDay}`)[0].innerHTML += 
                        this.makeTemplate(
                            ['item check dis-row dis-center', `fa-solid fa-clock-rotate-left icon ${i}-${z}`],
                            '', '', 'i',
                            `data-day="${new Date(`${nowDay}`).getDay()}" data-seat="${data[i][`D+${i}`][z].loc_num}" data-now="${nowDay}"`
                        );
                }
            }
        }
    }

    DateFromet(dateItem, num)
    {

        if(num == undefined){
            num = 0;
        }

        let year = dateItem.getFullYear();

        let month = dateItem.getMonth() + 1;

        let day = dateItem.getDate();

        let lastday = new Date(year, month, 0).getDate();
        
        if((day * 1) + num < 10){
            day = `0${(day * 1) + num}`;
        } else {

            if(lastday < (day * 1) + num) {
                day = (day + num) - lastday;
                if(day < 10){
                    day = `0${day}`;
                }
                month++;
            } else {
                day = day + num;
            }

        }

        if((month * 1) < 10){
            month = `0${month}`;
        } else {

            if(12 < (month * 1)) {
                month = '01';
                year++;
            }

        }

        return {'year':year, 'month':month, 'day':day};

    }

    makeTemplate(classNmae, id, text, element, event)
    {
        if(classNmae.length >= 2){

            return `<div class="${classNmae[0]}" id="${id}">
                        <${element} class="${classNmae[1]}" ${event}>${text}</${element}>
                    </div>`;

        } else {
            return `<div class="${classNmae}" id="${id}">
                        <${element} ${event}>${text}</${element}>
                    </div>`;
        }
        
    }
}

class Reservation
{
    constructor()
    {
        this.table = $('#table')[0];
        this.tableHeader = $('#table-header')[0];
        this.phoneInput = $('#phone')[0];
        this.nameInput = $('#name')[0];
        this.cfionBtn = $('#certification')[0];
        this.cfionInput = $('#certification-check')[0];
        this.reservation = $('#reservation')[0];
        this.popup = $('.input')[0];
        this.Msg = $('#msg-Ul')[0];

        this.cfionInput.disabled = true;

        // this.EventAdd();

        this.TextHistory = '';
        this.PhoneHistory = '';

        this.ReservationAdd();

        
    }

    ReservationAdd()
    {
        var Phonereg = /^\d{3}-\d{4}-\d{4}$/;
        var Cfionreg = /^\d{1,4}$/;

        // if(this.phoneInput.value == '' || !Phonereg.test(this.phoneInput.value) || this.cfionInput.value == '' || !Cfionreg.test(this.cfionInput.value) || this.cfionInput.value != '1234'){
            if(this.phoneInput.value == ''){
                new Msg(
                    '전화번호 입력란이 비었습니다.',
                    'err', 'fa-triangle-exclamation'
                );
                this.test = false;
            } else if(this.nameInput.value == ''){
                new Msg(
                    '이름 입력란이 비었습니다.',
                    'err', 'fa-triangle-exclamation'
                );
                this.test = false;
            } else if(this.cfionInput.value == '' && this.cfionInput.disabled){
                new Msg(
                    '먼저 인증번호를 받으세요',
                    'err', 'fa-triangle-exclamation'
                );
                this.test = false;
            } else if(this.cfionInput.value == '' && !this.cfionInput.disabled){
                new Msg(
                    '인증번호 입력란이 비었습니다.',
                    'err', 'fa-triangle-exclamation'
                );
                this.test = false;
            } else if(!Phonereg.test(this.phoneInput.value)){
                new Msg(
                    '휴대폰번호를 확인해주세요',
                    'err', 'fa-triangle-exclamation'
                );
                this.test = false;
            } else if(!Cfionreg.test(this.cfionInput.value)){
                new Msg(
                    '인증번호를 확인해주세요',
                    'err', 'fa-triangle-exclamation'
                );
                this.test = false;
            } else if(this.cfionInput.value != '1234'){
                new Msg(
                    '인증번호가 틀렸습니다.',
                    'err', 'fa-triangle-exclamation'
                );
                this.test = false;
            } else {
                console.log("?");
                this.test = true;
            }
            this.cfionInput.value = '';
            this.nameInput.value == '';
            this.phoneInput.value == '';
        }
    }


class Msg
{
    constructor(html, type, Typeclass)
    {
        this.Msg = $('#msg-Ul')[0];

        let msgDom = document.createElement("div");
        msgDom.innerHTML = 
        `<li class="${type} active d-flex justify-content-start align-items-center pt-3 pb-3 px-1 mb-3">
            <div class="d-flex justify-content-center align-items-center mx-4">
                <i class="fa-solid ${Typeclass}"></i>
            </div>
            <div class="d-flex flex-column justify-content-center align-items-start px-1">
                <p class="font-malgun mb-0">${html}</p>
            </div>
        </li>`;
        msgDom = msgDom.firstElementChild;
        
        

        clearTimeout(this.beforeMsgId);
        [...this.Msg.children].forEach(c => {
            
            c.animate({
                opacity: [1, 0],
            }, {
                duration: 500,
                iterations: 1,
                fill:"forwards"
            });

            setTimeout(function() {
                c.remove();
            }, 500);   
        });

        this.Msg.appendChild(msgDom);

        msgDom.animate({
            opacity: [0, 1]
        }, {
            duration: 200,
            iterations: 1,
            fill:"forwards"
        });

        this.beforeMsgId = setTimeout(function() {
            msgDom.animate({
                opacity: [1, 0],
            }, {
                duration: 500,
                iterations: 1,
                fill:"forwards"
            });

            setTimeout(function() {
                if($('#msg-Ul')[0].firstElementChild != null)
                $('#msg-Ul')[0].firstElementChild.remove();
            }, 500);   
        }, 2000);
    }
}

class Sub
{
    constructor()
    {
        this.table = $('#table')[0];
        this.tableHeader = $('#table-header')[0];
        this.phoneInput = $('#phone')[0];
        this.nameInput = $('#name')[0];
        this.cfionBtn = $('#certification')[0];
        this.cfionInput = $('#certification-check')[0];
        this.reservation = $('#reservation')[0];
        this.popup = $('.input')[0];
        this.Msg = $('#msg-Ul')[0];

        this.cfionInput.disabled = true;

        this.EventAdd();

        this.TextHistory = '';
        this.PhoneHistory = '';

    }

    init(nowStr)
    {
        this.now = new Date(nowStr);

        this.lastDayOfMonth = new Date(this.year, this.month, 0).getDate();

    
        for(let i = 0; i < 14; i++){
            console.log(this.DateFromet(this.now, i));
        }
    }

    


    makeTemplate(classNmae, id, text, element, event)
    {
        if(classNmae.length >= 2){

            return `<div class="${classNmae[0]}" id="${id}">
                        <${element} class="${classNmae[1]}" ${event}>${text}</${element}>
                    </div>`;

        } else {
            return `<div class="${classNmae}" id="${id}">
                        <${element} ${event}>${text}</${element}>
                    </div>`;
        }
        
    }

    EventAdd()
    {

        this.phoneInput.addEventListener('input', e => {
            if(e.target.value.length >= 14){

                e.target.value = this.PhoneHistory;

            } else if(e.target.value.length >= 11){
                // 전화번호에서 숫자만 추출
                const phoneNumberOnlyDigits = e.target.value.replace(/\D/g, '');

                // 숫자를 하이픈으로 구분하여 문자열 생성
                const phoneNumberFormatted = phoneNumberOnlyDigits.replace(/(\d{3})(\d{4})(\d{4})/, '$1-$2-$3');
                
                e.target.value = phoneNumberFormatted;

                this.PhoneHistory = e.target.value;

            }
            
        });

        this.cfionBtn.addEventListener('click', e => {
            new Msg(
                '인증번호가 요청되었습니다.',
                'msg', 'fa-envelope'
            );
            this.cfionInput.disabled = false;
        });

        $('#back').on('click', e => {
            console.log(e);
            this.phoneInput.value = '';
            this.cfionInput.value = '';

            this.cfionInput.disabled = true;

            this.popup.classList.remove("active");
        });

    }

    NumberFormet(num){
        return (num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    FormMsg(msg, path, value, form)
    {
        let text = value;
        let formBox = $(`#${form} .err`)[0];
        if(!path.test(text)){
            if(formBox != undefined){
                formBox.remove();
            }
            let msgDom = document.createElement('div');
            msgDom.innerHTML = `<p class="err">${msg}</p>`;
            $(`#${form}`)[0].appendChild(msgDom);
        } else if(formBox != undefined){
            formBox.remove();
        }
    }
}

class MyPage
{
    constructor(datas)
    {
        this.barbecuePopup = $('#barbecue-popup')[0];
        this.reservationList = $('#reservation-list')[0];
        this.table = $('#order-list')[0];
        this.list = $('#menu-list')[0];
        this.orderPopup = $('#order-data')[0];
        this.orderList = $('#order')[0];

        this.dayInput = $('#day')[0];
        this.seatInput = $('#seat')[0];
        this.OrderComplete = $('#order-complete')[0];

        this.checkmenu = [];
        this.protomenu = datas;

        this.Drow();
        this.GiveEvent();


    }

    

    Drow()
    {
        this.table.innerHTML = '';
        this.list.innerHTML = '';
        for(let i = 0; i < this.protomenu.length; i++){
            let BtnText = '추가';
            let SubText = '';

            if(this.protomenu[i].menu == "바비큐 그릴 대여")
            BtnText = '대여';

            if(this.protomenu[i].special != null) {
                SubText = 
                `
                    <span class="d-flex align-items-center m-0 mt-2 icon-${this.protomenu[i].color}">
                        <i class="fa-solid ${this.protomenu[i].class}"></i>
                        <p class="font-malgun m-0 mx-2">${this.protomenu[i].text}</p>
                    </span>
                `;
            }

            this.list.innerHTML += 
            `
                <li class="d-flex align-items-center justify-content-between col-12 px-3 pb-2 pt-2 mb-3">
                    <div class="dis-col">
                        <p class="m-0 font-malgun">${this.protomenu[i].menu}</p>
                        <p class="m-0 mt-1 font-malgun">${this.NumberFormet(this.protomenu[i].buy)}원</p>
                        ${SubText}
                    </div>
                    <button class="MenuAdd font-malgun btn btn-primary" data-name="${this.protomenu[i].menu}" data-id="${i}">${BtnText}</button>
                </li>
            `;

        }

        for(let i = 0; i < this.checkmenu.length; i++) {
            let SubText = '';
            let inputtype = '';

            if(this.checkmenu[i].special != null) {
                SubText = 
                `
                    <span class="d-flex align-items-center m-0 mt-2 icon-${this.checkmenu[i].color}">
                        <i class="fa-solid ${this.checkmenu[i].class}"></i>
                        <p class="font-malgun m-0 mx-2">${this.checkmenu[i].text}</p>
                    </span>
                `;
            }

            if(this.checkmenu[i].unit != "대여") {
                inputtype = 
                `   
                    <div class="input-group mt-2 mb-1">
                        <input type="number" value="${this.checkmenu[i].cnt}" data-name="${this.checkmenu[i].menu}" data-num="${i}" data-id="AddMenuId${i}" class="form-control CntInput" aria-label="Amount (to the nearest dollar)">
                        <span class="input-group-text">${this.checkmenu[i].unit}</span>
                    </div>
                `;
            }   

            this.table.innerHTML += 
            `
                <li id="AddMenuId${i}" class="d-flex align-items-center justify-content-between col-12 px-3 pb-2 pt-2 mb-2">
                    <div>
                        <p class="mb-1 font-malgun">${this.checkmenu[i].menu}</p>
                        ${SubText}${inputtype}
                    </div>
                    <div class="dis-row just-end">
                        
                    </div>    
                    <div class="AddMenuId${i} d-flex flex-column align-items-end">
                        <p class="mb-1 font-malgun">${this.NumberFormet(this.checkmenu[i].buy)}원</p>
                        <button class="Delete btn btn-danger font-malgun" data-name="${this.checkmenu[i].menu}" data-id="${i}">삭제</button>
                    </div>
                </li>
            `;
        }

        this.Totlebuy();
    }

    GiveEvent()
    {
        // 수량 설정
        this.table.addEventListener('input', e => {
            console.log(document.querySelector(`.${e.target.dataset.id} p`));
            if(e.target.classList.contains("CntInput")){
                let data = this.protomenu[this.checkmenu[e.target.dataset.num].id - 1];
                console.log(data, this.checkmenu[e.target.dataset.num]);
                if(e.target.value <= 0 && e.target.value != ''){
                    e.target.value = 1;
                    new Msg("수량은 1보다 작을수 없습니다.", "err", "fa-triangle-exclamation");
                }
                e.target.value = e.target.value.replace(/[^0-9]/g, ''); // 숫자가 아닌 문자를 제거
                for(let i = 0; i < this.checkmenu.length; i++)
                {
                    if(this.checkmenu[i].id == data.id){
                        this.checkmenu[i].cnt = e.target.value;
                        this.checkmenu[i].buy = data.buy * e.target.value;
                        document.querySelector(`.${e.target.dataset.id} p`).innerText =
                        this.NumberFormet(data.buy * e.target.value) + '원';
                    }
                }
                this.Totlebuy();
            }
        });

        // 대여 취소
        this.table.addEventListener('click', e => {
            if(e.target.classList.contains("Delete")){
                console.log(e.target);
                let data = this.protomenu[e.target.dataset.id];
                for(let i = 0; i < this.checkmenu.length; i++) {
                    if(this.checkmenu[i].id == data.id) {
                        this.checkmenu.splice(i, 1);
                    }
                }
                this.Drow();
            }
        });

        // 대여하기
        this.list.addEventListener('click', e => {
            if(e.target.classList.contains("MenuAdd")){
                let data = this.protomenu[e.target.dataset.id];
                console.log(data);
                let history = true;
                for(let i = 0; i < this.checkmenu.length; i++) {
                    if(this.checkmenu[i].id == data.id) {
                        history = false;
                    }
                }
                if(history) {
                    
                    this.checkmenu.push({"id":data.id, "menu":data.menu, "unit":data.unit, "buy":data.buy, "special":data.special, "class":data.class, "text":data.text, "color":data.color, "cnt":1});

                } else {
                    if(data.unit != "대여") {
                        for(let i = 0; i < this.checkmenu.length; i++) {
                            if(this.checkmenu[i].id == data.id) {
                                this.checkmenu[i].cnt++;
                                this.checkmenu[i].buy = data.buy * this.checkmenu[i].cnt;
                            }
                        }
                    }
                }
            }

            this.Drow();
        });

        this.reservationList.addEventListener('click', e => {
            if(e.target.classList.contains("menu")){
                this.dayInput.value = e.target.dataset.day;
                this.seatInput.value = e.target.dataset.seat;

                this.barbecuePopup.classList.add("active");
                this.orderPopup.classList.remove("active");
            }
        });

        $('#exit').on('click', e => {
            this.orderPopup.classList.remove("active");
        });

        $('#back').on('click', e => {
            this.barbecuePopup.classList.remove("active");
        });

    }


    NumberFormet(num){
        return (num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }


    Totlebuy(){
        let totle = 0;
        this.checkmenu.forEach(value => {
            totle += value.buy;
        }); 

        $('#totlebuy')[0].innerHTML = `<p class="font-malgun mx-3"><span>${this.NumberFormet(totle)}</span>원</p>`;
    }


    SQLsave(){
        var PostData = {'date':this.dayInput.value,'seat':this.seatInput.value,'menuData':JSON.stringify(this.checkmenu)};

        this.checkmenu = [
            {'menu':'바비큐 그릴 대여', 'buy':'', 'unit':'미대여', 'special':{'class':'fa-circle-info', 'text':'도구 및 숯 등 포함', 'color':'black'}, 'Cnt':0},
            {'menu':'돼지고기 바비큐 세트', 'buy':12000, 'unit':'인분', 'special':null, 'Cnt':0},
            {'menu':'해산물 바비큐 세트', 'buy':15000, 'unit':'인분', 'special':null, 'Cnt':0},
            {'menu':'음료', 'buy':3000, 'unit':'병', 'special':null, 'Cnt':0},
            {'menu':'주류', 'buy':5000, 'unit':'병', 'special':{'class':'fa-triangle-exclamation', 'text':'만 19세 미만 구매 불가', 'color':'danger'}, 'Cnt':0},
            {'menu':'과자 세트(3종)', 'buy':4000, 'unit':'세트', 'special':null, 'Cnt':0},
        ]; 

        this.table.innerHTML = '';

        $.ajax({
            method:"post",
            url:`/C-Module/order_process.php`,
            data:PostData,
            success: res => {
                console.log(res);

            },
            error: err => {
                console.log(err);
            }
        });


    }

    Localsave(){
        var PostData = {'seat':this.seatInput.value,'menuData':this.checkmenu};

        localStorage.setItem(`${this.dayInput.value}`, JSON.stringify(PostData));
    }

    SQLload(getData)
    {
        $.ajax({
            method:"get",
            url:`/C-Module/Getorder.php?date=${getData.dataset.day}&seat=${getData.dataset.seat}`,
            success: res => {
                console.log(res);
                this.orderList.innerHTML = '';
                if(res.length < 1){
                    return alert('주문내역이 없습니다.');
                } else {
                    res.forEach(value => {
                        let list = JSON.parse(value.list);
                        let orderMenu = '';
                        let totle = 0;
                        list.forEach(menu => {
                            let spantype = 
                            `
                                <span class="dis-row just-end"><p>${menu.Cnt}${menu.unit}</p></span>
                                <span class="dis-row just-end"><p><span>${menu.buy}</span>원</p></span>
                            `;
                            if(menu.menu == '바비큐 그릴 대여'){
                                console.log(menu);  

                                spantype = 
                                `   
                                    <span class="dis-row just-end"><p>${menu.unit}</p></span>
                                    <span class="dis-row just-end"><p><span>${menu.buy}</span></p></span>
                                `;

                                if(menu.unit == "대여"){    
                                    totle += 10000;
                                }
                            }
                            
                            if(menu.Cnt > 0 || menu.menu == "바비큐 그릴 대여"){
                                console.log(menu);
                                orderMenu += 
                                `
                                    <li class="dis-row aling-center">
                                        <span class="dis-row just-start"><p>${menu.menu}</p></span>
                                        ${spantype}
                                    </li>
                                `;
                            }

                            if(menu.Cnt > 0 && menu.menu != "바비큐 그릴 대여"){
                                totle += menu.buy; 
                            }

                        });

                        let button = 
                        `
                            <a href="./order_delete.php?id=${value.id}&type=delete" class="btn-red dis-row dis-center"><p class="btn-text">주문취소</p></a>
                        `;   

                        if(value.type == "취소"){
                            button = '<a class="btn-red dis-row dis-center"><p class="btn-text">취소됨</p></a>';
                        } else if(value.type == "배달완료"){
                            button = '<a class="btn-blue dis-row dis-center"><p class="btn-text">배달완료됨</p></a>';
                        }

                        this.orderList.innerHTML += 
                        `
                            <li>
                                <p>${value.order_date} [${value.seat}] <span>${value.type}</span></p>
                                <div class="dis-row just-bet aling-center">
                                    ${button}
                                </div>
                                <p>주문시간 : ${value.date}</p>
                                <ul>
                                    ${orderMenu}
                                </ul>
                                <p><span>${this.NumberFormet(totle)}</span>원</p>
                            </li>
                        `;
                    });
                    this.orderPopup.classList.add("active");
                    this.barbecuePopup.classList.remove("active");
                }
            }
        })
    }
    
    Localload(getData)
    {
        const data = window.localStorage.getItem(`${getData.dataset.day}`);
        const list = JSON.parse(data);

        this.orderList.innerHTML = '';
        
        if(list != undefined && list.seat == getData.dataset.seat){
            console.log(list);

            let totle = 0;
            list.menuData.forEach(value => {
                if(value.Cnt > 0){
                    totle = totle + value.buy;
                    this.orderList.innerHTML += 
                    `
                        <li>
                            <p>${value.menu}</p>
                            <p>${value.Cnt}${value.unit}</p>
                            <p>${value.buy.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}원</p>
                        </li>
                    `;
                }
            });

            this.orderList.innerHTML += `<p>${this.NumberFormet(totle)}</p>`

            this.orderPopup.classList.add("active");

            
        }
    }
}

class MenuLoad
{
    constructor(menus, admin = true)
    {
        this.menus = menus;
        this.barbecuePopup = $('#barbecue-popup')[0];
        this.orderPopup = $('#order-data')[0];
        this.orderList = $('#order')[0];
        this.admin = admin;
        this.Drow();
    }

    Drow()
    {
        console.log(this.menus);
        this.orderList.innerHTML = '';
        if(this.menus.data.length < 1){
            return new Msg("주문내역이 없습니다.", "err", "fa-triangle-exclamation");
        } else {
            this.menus.data.forEach(value => {
                console.log(value);
                let orderMenu = '';
                let totle = 0;
                value.data.forEach(menu => {
                    let spantype = 
                    `
                        <span class="col-3 d-flex justify-content-center"><p class="mb-0 font-malgun">${menu.count}${menu.unit}</p></span>
                        <span class="col-4 d-flex justify-content-end"><p class="mb-0 font-malgun"><span>${menu.buy * menu.count}</span>원</p></span>
                    `;
                    if(menu.menu == '바비큐 그릴 대여'){
                        console.log(menu);  

                        spantype = 
                        `   
                            <span class="col-3 d-flex justify-content-center"><p class="mb-0 font-malgun">${menu.unit}</p></span>
                            <span class="col-4 d-flex justify-content-end"><p class="mb-0 font-malgun"><span>${menu.buy}</span>원</p></span>
                        `;
                        totle += 10000;
                    }
                    
                    console.log(menu);
                    orderMenu += 
                    `
                        <li class="col-12 d-flex mb-3">
                            <span class="col-5 d-flex justify-content-start"><p class="mb-0 font-malgun">${menu.menu}</p></span>
                            ${spantype}
                        </li>
                    `;

                    if(menu.menu != "바비큐 그릴 대여"){
                        totle += menu.buy * menu.count; 
                    }

                });

                console.log(value.rid);

                let button = 
                `
                    <button data-id="${value.rid}" data-date="${value.date}" class="btn btn-danger pt-1 pb-1 font-malgun refuse">주문취소</button>
                `;   

                if(!this.admin){
                    console.log(this.admin);
                    button = '';
                }
                
                if(value.state == "주문취소"){
                    button = '<button class="btn btn-danger font-malgun">취소됨</button>';
                } else if(value.state == "배달완료"){
                    button = '<button class="btn btn-primary font-malgun">배달완료됨</button>';
                }

                this.orderList.innerHTML += 
                `
                    <li class="px-3 pt-2 pb-2 mb-3">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <div class="col-8">
                                <p class="mb-0 font-malgun fs-5">${value.rdate} [${value.seat}] <span>${value.state}</span></p>
                                <p class="mb-0 font-malgun">주문시간 : ${value.date}</p>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                ${button}
                            </div>
                        </div>
                        <div class="title d-flex mt-3">
                            <div class="col-3 d-flex justify-content-center">
                                <p class="font-malgun">상품명</p>    
                            </div>
                            <div class="col-3 offset-2 d-flex justify-content-center">
                                <p class="font-malgun">수량</p>
                            </div>
                            <div class="col-1 offset-3 d-flex justify-content-center">
                                <p class="font-malgun">가격</p>
                            </div>
                        </div>
                        <ul class="p-0 col-12">
                            ${orderMenu}
                        </ul>
                        <div class="col-12 d-flex justify-content-end">
                            <p class="mb-0 font-malgun"><span>${this.NumberFormet(totle)}</span>원</p>
                        </div>
                    </li>
                `;
            });
            this.orderPopup.classList.add("active");
            if(this.admin)
            this.barbecuePopup.classList.remove("active");
        }
    }

    NumberFormet(num){
        return (num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
}



window.onload = function (){

    if(document.querySelector("#slide-box") != undefined){

        // var app = new Slide('#slide-ul');
        

    } else if(document.querySelector("#table") != undefined){
        
        // var app = new Sub();

    } else {

        // var app = new MyPage();

    }
}    

