class Store {
    constructor() {

        this.store = document.querySelector("#store");
        this.cart = document.querySelector("#cart");
        this.total = document.querySelector("#total");
        this.search = document.querySelector("#search");
        this.dropArea = document.querySelector("#drop-area");

        this.cartItem = [];

        this.target = null;
        this.startPoint = [0, 0];
        this.keyword = "";

        this.init();
        this.event();
    }

    async init() {
        this.drow = await this.getStoreItem();
        this.storeUpdate();
    }

    async getStoreItem() {
        let data = await post("GET", "/common/js/store.json");
        return data.map(json => new Drow(this, json));
    }

    storeUpdate() {

        this.store.innerHTML = ``;

        let viewList = this.drow.map(item => item.init());

        if(this.keyword !== ""){
            let regex = new RegExp(this.keyword, "g");
            viewList = viewList.filter(item => regex.test(item.json.product_name) || regex.test(item.json.brand))
                .map(item => {
                    item.product_name = item.json.product_name.replace(regex, m1 => `<span class="bg-gold text-white">${m1}</span>`);
                    item.brand = item.json.brand.replace(regex, m1 => `<span class="bg-gold text-white">${m1}</span>`);
                    return item;
                })
        }

        if(viewList.length < 1) {
            this.store.innerHTML = `<div class="w-100 py-4 text-center text-muted fx-n2">일치하는 상품이 없습니다.</div>`;
        }

        viewList.forEach(item => {
            item.storeUpdate();
            $(this.store).append(item.domElem);
        });
    }

    cartUpdate() {
        this.cart.innerHTML = "";

        let viewList = this.cartItem.map(item => item.init());

        viewList.forEach(item => {
            item.cartUpdate();
            $(this.cart).append(item.domElem);
        });
        this.totalNumUpdate();
    }

    totalNumUpdate() {
        let total = 0;
        this.cartItem.forEach(item => {
            total += item.cnt * item.price;
        });

        console.log(total);
        this.total.innerHTML = total.toLocaleString();
    }

    event() {

        let timeout, droging = false;

        $(this.store).on("dragstart", ".image__area", e => {
            e.preventDefault();

            if(droging) return;

            droging = true;
            this.target = e.currentTarget;
            this.startPoint = [e.pageX, e.pageY];
            
            e.currentTarget.classList.add("drag");
        });

        $(window).on("mousemove", e => {

            if(!this.target || !this.startPoint || !droging) return;

            $(this.target).css({
                left: e.pageX - this.startPoint[0] + "px",
                top: e.pageY - this.startPoint[1] + "px",
            });
        });

        $(window).on("mouseup", e => {
            if(!this.target || !this.startPoint || e.which !== 1 || !droging) return;

            droging = false;

            let {left, top} = $(this.dropArea).offset();
            let width = $(this.dropArea).width();
            let height = $(this.dropArea).height();

            if(left <= e.pageX && e.pageX <= left + width && top <= e.pageY && e.pageY <= top + height) {

                if(timeout){
                    clearTimeout(timeout);
                }
                this.dropArea.classList.remove("error");
                this.dropArea.classList.remove("success");

                let target = this.target;
                let targetItem = new Drow(this, {...this.drow.find(item => item.id == this.target.dataset.id), cnt: 1});

                if(!this.cartItem.find(cart => cart.id == targetItem.id)) {
                    this.cartItem.push(targetItem);
                } else {
                    this.dropArea.classList.add("error");

                    $(this.target).animate({
                        left: 0,
                        top: 0,
                    }, 350, () => {
                        this.target.classList.remove("drag");
                    });

                    timeout = setTimeout(() => {
                        this.dropArea.classList.remove("success");
                        this.dropArea.classList.remove("error");
                    }, 1500);
                    return;
                }

                this.dropArea.classList.add("success");

                $(target).css({
                    transform: "scale(0)",
                    transition: "transform 0.35s",
                });
                
                setTimeout(() => {
                    $(target).css({
                        transform: "scale(1)",
                        top: "0px",
                        left: "0px",
                    });             
                    target.classList.remove("drag");       
                }, 350);

                timeout = setTimeout(() => {
                    this.dropArea.classList.remove("success");
                    this.dropArea.classList.remove("error");
                }, 1500);
                
            } else {
                this.startPoint = [0, 0];
            
                $(this.target).animate({
                    left: 0,
                    top: 0,
                }, 350, () => {
                    this.target.classList.remove("drag");
                });
            }

            this.cartUpdate();
        });

        $(this.cart).on("click", ".delete", e => {
            this.cartItem = this.cartItem.filter((item) => item.id != e.target.dataset.id);
            this.cartUpdate();
        });

        $(this.search).on("input", e => {
            console.log("test");
            this.keyword = e.target.value
                .replace(/([\^$\.+*?\[\]\(\)\\\\\\/])/g, "\\$1")
                .replace(/(ㄱ)/g, "[가-깋]")
                .replace(/(ㄴ)/g, "[나-닣]")
                .replace(/(ㄷ)/g, "[다-딯]")
                .replace(/(ㄹ)/g, "[라-맇]")
                .replace(/(ㅁ)/g, "[마-밓]")
                .replace(/(ㅂ)/g, "[바-빟]")
                .replace(/(ㅅ)/g, "[사-싷]")
                .replace(/(ㅇ)/g, "[아-잏]")
                .replace(/(ㅈ)/g, "[자-짛]")
                .replace(/(ㅊ)/g, "[차-칳]")
                .replace(/(ㅋ)/g, "[카-킿]")
                .replace(/(ㅌ)/g, "[타-팋]")
                .replace(/(ㅍ)/g, "[파-핗]")
                .replace(/(ㅎ)/g, "[하-힣]")
                .replace(/([aA])/g, "[aA]")
                .replace(/([bB])/g, "[bB]")
                .replace(/([cC])/g, "[cC]")
                .replace(/([dD])/g, "[dD]")
                .replace(/([eE])/g, "[eE]")
                .replace(/([fF])/g, "[fF]")
                .replace(/([gG])/g, "[gG]")
                .replace(/([hH])/g, "[hH]")
                .replace(/([iI])/g, "[iI]")
                .replace(/([jJ])/g, "[jJ]")
                .replace(/([kK])/g, "[kK]")
                .replace(/([lL])/g, "[lL]")
                .replace(/([mM])/g, "[mM]")
                .replace(/([nN])/g, "[nN]")
                .replace(/([oO])/g, "[oO]")
                .replace(/([pP])/g, "[pP]")
                .replace(/([qQ])/g, "[qQ]")
                .replace(/([rR])/g, "[rR]")
                .replace(/([sS])/g, "[sS]")
                .replace(/([tT])/g, "[tT]")
                .replace(/([uU])/g, "[uU]")
                .replace(/([vV])/g, "[vV]")
                .replace(/([wW])/g, "[wW]")
                .replace(/([xX])/g, "[xX]")
                .replace(/([yY])/g, "[yY]")
                .replace(/([zZ])/g, "[zZ]");

            this.storeUpdate();
        });

        $(this.cart).on("input", e => {
            if(e.target.value < 1) {
                e.target.value = 1;
                this.totalNumUpdate();
                return;
            }
            this.cartItem = this.cartItem.map(item => { if(item.id == e.target.dataset.id) {return new Drow(this, {...item, cnt:(e.target.value * 1)} )} else return item } );
            let target = this.cart.querySelector(`.item[data-id="${e.target.dataset.id}"]`);
            target.querySelector(".numArea span").innerHTML = (e.target.value * this.cartItem.find(item => item.id == e.target.dataset.id).price).toLocaleString();

            this.totalNumUpdate();
        });

        $("#buy-modal").on("submit", e => {
            e.preventDefault();

            const PADDING = 30;
            const TEXT_SIZE = 18;
            const TEXT_YGAP = 20;
            const TEXT_XGAP = 50;

            let canvas = document.createElement("canvas");
            let ctx = canvas.getContext("2d");
            ctx.font = `${TEXT_SIZE}px`;

            let now = new Date();
            let text_time = `구매일시: ${now.getFullYear()}-${now.getMonth() + 1}-${now.getDate()} ${now.getHours()}:${now.getMinutes()}:${now.getSeconds()}`;
            let text_price = `총합계: ${this.total.innerHTML.toLocaleString()}원`;

            let viewList = [
                ["상품명", "가격", "수량", "합계"],
                ...this.cartItem.map(item => [item.json.product_name, item.price.toLocaleString() + "원", item.cnt.toLocaleString() + "개", (item.cnt * item.price).toLocaleString() + "원"]),
            ];
            let widthList = viewList.map(row => row.map(text => ctx.measureText(text).width + TEXT_XGAP))
                .reduce((p, c) => c.map((width, i) => Math.max(width, p[i])));
            
            canvas.width = PADDING * 2 + widthList.reduce((p, c) => p + c);
            canvas.height = PADDING * 2 + (TEXT_SIZE + TEXT_YGAP) * (viewList.length + 2);

            ctx.fillStyle = "#fff";
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            
            ctx.fillStyle = "#ddd";
            ctx.fillRect(PADDING, PADDING + TEXT_SIZE + TEXT_YGAP / 2, canvas.width - PADDING * 2, 2);

            ctx.fillStyle = "#333";
            ctx.font = `${TEXT_SIZE}px 나눔스퀘어, sans-serif`;

            viewList.forEach((row, y) => {
                let acc = 0;
                row.forEach((text, i) => {
                    let text_x = PADDING + acc + widthList[i] / 2 - ctx.measureText(text).width / 2;
                    let text_y = PADDING + TEXT_SIZE * (y + 1) + TEXT_YGAP * y;
                    acc += widthList[i];
                    ctx.fillText(text, text_x, text_y);
                });
            });

            ctx.fillText(text_price, PADDING, canvas.height - PADDING - TEXT_SIZE - TEXT_YGAP);
            ctx.fillText(text_time, PADDING, canvas.height - PADDING);

            let src = canvas.toDataURL("image/jpeg");
            $("#view-modal img").attr("src", src);
            $("#view-modal").modal("show");
            $("#buy-modal").modal("hide");
            $("#buy-modal input").val("");
        })
    }
}

class Drow {
    constructor(app, json) {
        this.app = app;
        if(!/^\d+$/.test(json.price)) json.price = parseInt(json.price.replace(/[^0-9]/g, ""));
        this.json = json;

        this.init();    
    }   

    init(){
        const {id, product_name, brand, photo, price, cnt} = this.json;
        
        this.id = id;
        this.product_name = product_name;
        this.brand = brand;
        this.photo = photo;
        this.price = price;
        this.cnt = cnt;
        this.domElem = null;

        return this;
    }

    storeUpdate() {

        const {id, photo, price} = this.json;
        const {product_name, brand} = this;

        if(!this.domElem){
            this.domElem = $(`<div class="item col-lg-4 col-md-6 mb-5">
                                    <div class="image__area d-flex align-items-center justify-content-center" data-id="${id}">
                                        <img src="./image/상품사진/${photo}" alt="sopItem">
                                    </div>
                                    <div class="text__area d-flex justify-content-between align-items-center py-3 px-2">
                                        <div class="name">
                                            <small class="text-muted fx-n2 brand">${brand}</small>
                                            <p class="mb-0 fx-2 product_name">${product_name}</p>
                                        </div>
                                        <div class="price">
                                            <p class="mb-0">
                                                <span class="fx-3 text-gold">${price.toLocaleString()}</span>
                                                <small class="text-muted">원</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>`);
        } else {
            this.domElem.find(".brand").html(brand);
            this.domElem.find(".product_name").html(product_name);
        }
    }

    cartUpdate() {
        const {id, photo, price, cnt} = this.json;
        const {product_name, brand} = this;

        if(!this.domElem){
            this.domElem = $(`<div class="item d-flex align-items-center border-bottom py-3" data-id="${id}">
                                <div class="dataArea col-6 p-0 d-flex align-items-center gap-3">
                                    <div class="image__area d-flex align-items-center justify-content-center">
                                        <img src="./image/상품사진/${photo}" alt="itemImage">
                                    </div>
                                    <p class="name d-flex flex-column mb-0">
                                        <span class="text-muted fx-n2">${brand}</span>
                                        <span class="fx-2">${product_name}</span>
                                    </p>
                                </div>
                                <div class="priceArea col-2 p-0 text-center">
                                    <p class="price mb-0">
                                        <span>${(price * 1).toLocaleString()}</span>
                                        <small class="text-muted">원</small>
                                    </p>
                                </div>
                                <div class="countArea col-1 p-0 d-flex align-items-center justify-content-center">
                                    <input type="number" class="col-9 pr-0 buy-count fx-n1" min="1" value="${cnt}" data-id="${id}">
                                </div>
                                <div class="numArea col-2 p-0 text-center">
                                    <p class="price mb-0">
                                        <span>${(cnt * price).toLocaleString()}</span>
                                        <small class="text-muted">원</small>
                                    </p>
                                </div>
                                <div class="btnArea col-1 p-0 d-flex align-items-center justify-content-center">
                                    <button class="delete bg-blue text-white py-1 px-2 fx-n3" data-id="${id}">X</button>
                                </div>
                            </div>`);
        } else {
            this.domElem.find(".brand").html(brand);
            this.domElem.find(".product_name").html(product_name);
        }
    }
}

class Knowhows {
    constructor(user = null) {
        this.datas = [];
        this.user = user;

        this.container = document.querySelector("#content");

        this.init();
    }

    async init() {
        await this.GetKnowhows();
        this.event();
    }

    async GetKnowhows() {
        let json = await post("GET", "/knowhows/data");
        this.datas = json[0];
        this.drow();
    }

    drow() {
        this.container.innerHTML = '';

        this.datas.forEach(item => {
            console.log(item.write, item.write != "undefined", item.write == null); // define이면 로그인이 없고, null이면 나와야하고
            this.container.innerHTML += `
                <div class="col-lg-4 col-md-6 mt-4">
                    <div class="content__item card__item border">
                        <div class="imageItem d-flex align-items-center justify-content-center">
                            <img src="./uploads/${item.before_img}" alt="homeImage1">
                            <img src="./uploads/${item.after_img}" alt="homeImage2">
                        </div>
                        <div class="textItem pt-3 pb-3 px-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <span>${item.name}</span>
                                    <small class="text-muted">(${item.user_id})</small>
                                    <small class="text-muted ml-2">${item.date}</small>
                                </div>
                                <div class="text-gold">
                                    <i class="fa fa-star"></i>
                                    ${Math.floor(item.cnt)}
                                </div>
                            </div>
                            <div class="mt-3">
                                <p class="fx-n2 text-muted">${item.comment}</p>
                            </div>
                            <div class="mt-3 align-items-center justify-content-between ${this.user && !item.write && item.uid != this.user.id ? "d-flex" : "d-none"}">
                                <small class="text-muted">이 글이 마음에 드시나요?</small>
                                <button class="bg-blue fx-n3 py-2 px-3 text-white" data-id="${item.id}" data-toggle="modal" data-target="#score-modal">평점 주기</button>
                            </div>
                        </div>
                    </div>
                </div>
            `
        })
    }

    event() {
        let kid;

        
        document.querySelectorAll("[data-target='#score-modal']").forEach(item => {
            console.log(item);
            item.addEventListener("click", e => {

                console.log("test");
                kid = e.target.dataset.id;

            });
        })
        
        document.querySelectorAll(".GiveScore").forEach(item => {
            item.addEventListener("click", e => {
                console.log(kid);
                $.post("/knowhows/rivew", {"kid": kid, "score": item.dataset.value}, function(res) {
                    $("#score-modal").modal("hide");
                    
                    window.app.GetKnowhows();
                });
            })
        })
    }
}