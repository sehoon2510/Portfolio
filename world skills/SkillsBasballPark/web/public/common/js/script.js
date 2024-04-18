class Sign {
    constructor() {
        this.init();
    }

    init() {
        document.querySelector('[data-bs-target="#sign-up"]').addEventListener("click", e => {
            document.querySelector("#sign-up .signUp-btn").disabled = true;
            const canvas = document.querySelector("#cap_canvas");
            const ctx = canvas.getContext("2d");
            ctx.font = '50px 맑은 고딕';
            ctx.clearRect(0, 0, 450, 100);

            let text = Math.random().toString(36).substr(2, 5);
            let width = ctx.measureText(text).width;

            ctx.fillText(text, canvas.width / 2 - width / 2, canvas.height / 2 + 25);
            $("#cap_in").val(text);
            $("#cap_out").val("");
        });

        $("#login").on("click", e => {
            let id = document.querySelector("#sign-in #sign_id");
            let pass = document.querySelector("#sign-in #sign_pw");
            let grant = document.querySelector("#sign-in #userType");

            this.Login(id.value, pass.value, grant.value);
        })

        $("#sign-up .checkId").on("click", e => {
            let id = document.querySelector("#sign-up #join_id");
            if(id.value != "") this.getUserID();
        })

        $("#sign-up #join_id").on("input", e => {
            document.querySelector("#sign-up .signUp-btn").disabled = true;
        })
    }

    async getUserID() {
        let id = document.querySelector("#sign-up #join_id");
        let json = JSON.parse(await dataPost("GET", "/getUser"));
        
        if(json.data.find(item => item.user_id == id.value)) {
            alert("사용 중인 ID입니다.");
            document.querySelector("#sign-up .signUp-btn").disabled = true;
            return;
        }

        document.querySelector("#sign-up .signUp-btn").disabled = false;
    }
    
    async Login(id, pass, grant) {
        try {
            let json = JSON.parse(await dataPost("GET", `/sign-in?id=${id}&pass=${pass}&grant=${grant}`));

            console.log(json);

            $("#sign-list .signList").html(json.data.map((item, index) => `
                <div class="w-100 border-bottom py-3 d-flex">
                    <div class="col-4 text-center">${index + 1}</div>
                    <div class="col-8 text-center">${item.date}</div>
                </div>
            `));

            $("#login-in")[0].classList.remove("d-flex");
            $("#login-out")[0].classList.remove("d-none");
            $("#login-in")[0].classList.add("d-none");
            $("#login-out")[0].classList.add("d-flex");

            $("#sign-in").modal("hide");
            $("#sign-list").modal("show");
        } catch(e) {

        }

    }
}

class Goods {
    constructor() {
        this.goods = [];
        this.order = "sale-desc";
        this.category = null;
        this.best = [];

        this.init();
        this.event();
    }

    async init() {

        this.goods = await dataPost("GET", '/common/js/goods.json');
        this.goods = JSON.parse(this.goods.replace(/"idx": 0([0-9])/g, (match, m1) => `"idx": "0${m1}"`));
        this.goods.data.sort((a, b) => b.sale - a.sale);
        this.goods = this.goods.data.map((item, index) => {
            if(index < 3) {
                return {...item, best: true};
            } else {
                return item;
            }
        });

        const groups = Array.from(["전체", ...new Set(this.goods.map(good => good.group))]);
        
        $("#category").html(groups.map(group => `<option value="${group}">${group}</option>`));
        this.render();
    }

    render() {
        $("#content").html(
            this.goods.filter(good => !this.category || this.category == '전체' || this.category == good.group).sort((a, b) => {
                    const [key, order] = this.order.split('-');
                    const aValue = key == "전체" ? a.sale : parseInt(String(a[key]).replace(',', ""));
                    const bValue = key == "전체" ? b.sale : parseInt(String(b[key]).replace(',', ""));

                    console.log(aValue, bValue);

                    if(order == 'asc') return aValue - bValue;
                    else return bValue - aValue;
            }).map(good => `
                <div class="col-4 mb-4">
                    <div class="item">
                        <div class="image__area ${good.best ? "best" : ""}" data-id="${good.idx}">
                            <img src="./images/${good.img}" alt="" class="fit-cover">
                        </div>
                        <div class="text px-2 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <div class="fx-2">${good.title} <span class="fx-n2 text-muted">[ ${good.group} ]</span></div>
                                    <div class="text-muted fx-n2">판매량 : ${good.sale}개</div>
                                    <small class="text-danger"></small>
                                </div>
                                <div class="text-end">
                                    <div>
                                        <span class="fx-3 text-gold">${good.price}</span>
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
                </div>
            `)
        )
    }

    event() {
        $("#order").on("change", e => {
            this.order = e.target.value;
            this.render();
        })
        
        $("#category").on("change", e => {
            this.category = e.target.value;
            this.render();
        })
    }
}

window.onload = () => {
    new Sign();
}

// class App {
//     constructor() {

//     }

//     init() {

//     }

//     event() {

//     }
// }

// window.onload = () => {
//     const wrap = document.querySelector(".canvas-wrap");
//     const canvas = document.querySelector(".canvas-wrap canvas");
//     const ctx = canvas.getContext('2d');

//     document.querySelector("#download").addEventListener("click", () => {
//         const textList = wrap.querySelectorAll(".text");
        
//         textList.forEach(text => {
            
//             const left = parseInt(text.style.left) + 5 - 10; // 9
//             const top = parseInt(text.style.top) + 5 + 18 + 2; // 3
//             const rotate = parseInt(text.style.transform.replace(
//                 /rotate\(([0-9]+)deg\)/,
//                 (matched, group1) => group1,
//             ));
//             const result = ctx.measureText(text.innerText);
            
//             const rotatedCanvas = document.createElement('canvas');
//             rotatedCanvas.width = canvas.width;
//             rotatedCanvas.height = canvas.height;
//             const rctx = rotatedCanvas.getContext('2d');
//             rctx.font = getComputedStyle(text).font;
//             const textWidth = rctx.measureText(text.innerText).width;
//             const textHeight = parseInt(getComputedStyle(text).fontSize);
//             const rotateX = left + textWidth / 2;
//             const rotateY = top - textHeight / 2;
    
//             rctx.translate(rotateX, rotateY);
//             rctx.rotate(rotate * Math.PI / 180);
//             rctx.fillText(text.innerText, -textWidth / 2, textHeight / 2);
            
//             // 회전된 캔버스를 원본 캔버스에 그림
//             ctx.drawImage(rotatedCanvas, 0, 0);
//         });

//     });
// }


// window.onload = () => {
//     const wrap = document.querySelector(".canvas-wrap");
//     const canvas = document.querySelector(".canvas-wrap canvas");

//     const ctx = canvas.getContext("2d");

//     document.querySelector("#download").addEventListener("click", () => {
//         const textList = wrap.querySelectorAll(".text");

//         console.log(textList);

//         textList.forEach(text => {
//             ctx.font = getComputedStyle(text).font;
//             const left = parseInt(text.style.left) + 5;
//             const top = parseInt(text.style.top) + 5 + 18;
//             const rotate = parseInt(text.style.transform.replace(/rotate\(([0-9]+)deg\)/, (matched, group) => group));
//             const result = ctx.measureText(text.innerHTML);

//             const rotateCanvas = document.createElement("canvas");
//             rotateCanvas.width = canvas.width;
//             rotateCanvas.height = canvas.height;
//             const rctx = rotateCanvas.getContext("2d");
//             rctx.font = getComputedStyle(text).font;
            
//             rctx.rotate((Math.PI/180)*70); 

//             rctx.fillText(text.innerHTML, left, top);
//             ctx.drawImage(rotateCanvas, 0, 0);
//             document.body.append(rotateCanvas);
//         });
//     })

// }




