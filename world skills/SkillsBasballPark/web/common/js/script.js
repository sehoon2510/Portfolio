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

            $("#sign-list .signList").html(json.data.map(item => `
                <div class="w-100 border-bottom py-3 d-flex">
                    <div class="col-12 text-center">${item.login_at}</div>
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

        this.goods = await dataPost("GET", '');
        // this.goods = JSON.parse(this.goods.replace(/"idx": 0([0-9])/g, (match, m1) => `"idx": "0${m1}"`));
        // this.goods.data.sort((a, b) => b.sale - a.sale);
        // this.goods = this.goods.data.map((item, index) => {
        //     if(index < 3) {
        //         return {...item, best: true};
        //     } else {
        //         return item;
        //     }
        // });

        // const groups = Array.from(["전체", ...new Set(this.goods.map(good => good.group))]);
        
        // $("#category").html(groups.map(group => `<option value="${group}">${group}</option>`));
        this.render();
    }

    render() {
        $("#content").html(
            this.goods.map(good => `
                <a href="/goods/item?id=${good.id}" class="col-4 mb-4">
                    <div class="item">
                        <div class="image__area" data-id="${good.id}">
                            <img src="./images/${good.img}" alt="" class="fit-cover">
                        </div>
                        <div class="text px-2 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <div class="fx-2 text-blue">${good.title}</div>
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
                </a>
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


class Reservation {
    constructor() {
        this.now = new Date();
        this.year = this.now.getFullYear();
        this.month = this.now.getMonth() + 1;
        this.date = this.now.getDate();

        this.cal = document.querySelector(".cal-wrap");
        this.table = document.querySelector(".table-wrap");

        this.times = ["04시", "07시", "09시", "13시", "15시", "19시", "23시"];
        this.gameData = [];

        this.checkDate = this.date;

        this.init();
    }

    async init() {
        await this.getGames();
        this.CalDrow();
        this.event();
        this.TableDrow();

        console.log(document.querySelector("#gameType"), document.querySelector("#gameType").value);
        setTimeout(() => {
            console.log(document.querySelector("#gameType"), document.querySelector("#gameType").value);
            let target = document.querySelector("#gameType");
            $("#res-modal #gameTime option:nth-child(1)").prop("selected", true);
            document.querySelectorAll("#res-modal #gameTime option").forEach(item => {
                let data = window.app.gameData.find(data => data.game == target.value 
                    && item.value == data.time
                    && data.date == `${window.app.year}-${String(window.app.month).padStart(2, "0")}-${String(window.app.checkDate).padStart(2, "0")}`);
                console.log(data);
                if(target.value == "새벽리그" && window.app.checkDate == 1 && item.value == 4 || !item.dataset.target || item.dataset.target != target.value || data) {
                    item.disabled = true;
                } else {
                    item.disabled = false;
                }
            })

            let nomalPrice = 0;

            if(target.value == "나이트리그") {
                nomalPrice = 50000;
            } else if(target.value == "주말리그") {
                nomalPrice = 100000;
            } else {
                nomalPrice = 30000;
            }
            $("#res-modal #price_viwe")[0].innerHTML = (nomalPrice).toLocaleString();
            $("#res-modal #price").val(nomalPrice);
        }, 1000);
    }

    async getGames() {
        try {
            let json = JSON.parse(await dataPost("GET", '/reservation/gamedata'));
            this.gameData = json.data;

        } catch(e) {
            alert(e.msg);
        }
    }

    CalDrow() {
        let NowlastDate = new Date(this.year, this.month, 0);
        let BacklastDate = new Date(this.year, this.month - 1, 0);
        let startDay = new Date(this.year, this.month - 1, 1);
        
        console.log(BacklastDate.getMonth() + 1);

        this.cal.querySelector(".cal-head").innerHTML = `${this.year}년 ${this.month}월`;

        this.cal.querySelector(".cal-body").innerHTML = ``;
        for(let i = startDay.getDay() - 1; i >= 0; i--) {
            this.cal.querySelector(".cal-body").innerHTML += `
                <div class="cell text-center">
                    <div class="fx-n1 rounded-pill py-3 font-bold text-gray">${BacklastDate.getDate() - i}</div>
                </div>
            `
        }
        for(let i = 1; i <= NowlastDate.getDate(); i++) {
            this.cal.querySelector(".cal-body").innerHTML += `
                <div class="cell text-center">
                    <div class="fx-n1 rounded-pill py-3 font-bold ok ${
                        this.now.getFullYear() == this.year
                        && this.now.getMonth() + 1 == this.month
                        && i == this.date ? "bg-darkblue text-white" : ""
                    }">${i}</div>
                </div>
            `;
        }
        if(NowlastDate.getDay() != 6) {
            for(let i = 1; i <= 6 - NowlastDate.getDay(); i++) {
                this.cal.querySelector(".cal-body").innerHTML += `
                    <div class="cell text-center">
                        <div class="fx-n1 rounded-pill py-3 font-bold text-gray">${i}</div>
                    </div>
                `
            }
        }
    }

    TableDrow() {
        this.table.querySelector(".table-body > div:nth-child(1)").innerHTML = '';
        this.table.querySelector(".table-body > div:nth-child(2)").innerHTML = '';
        this.table.querySelector(".table-body > div:nth-child(3)").innerHTML = '';
        this.times.forEach((item, index) => {
            let drowData = this.gameData.filter(data => data.time == parseInt(item) && data.date == `${this.year}-${String(this.month).padStart(2, "0")}-${String(this.checkDate).padStart(2, "0")}`);
            console.log(drowData, item);

            let data = drowData.find(item => item.game == "나이트리그");
            if(item != "19시" && item != "23시") {
                this.table.querySelector(".table-body > div:nth-child(1)").innerHTML += `
                    <div class="py-3 text-center border-bottom text-gray">${item} [ 경기 없음 ]</div>
                `;   
            } else if(data) {
                this.table.querySelector(".table-body > div:nth-child(1)").innerHTML += `
                    <div class="py-3 text-center border-bottom text-danger">${item} [ ${data.t ? `${data.t}` : "휴일" } ]</div>
                `;  
            } else {
                this.table.querySelector(".table-body > div:nth-child(1)").innerHTML += `
                    <div class="py-3 text-center border-bottom" data-time="${parseInt(item)}" data-type="나이트리그">${item}</div>
                `;
            }
            
            data = drowData.find(item => item.game == "주말리그");
            if(item != "09시" && item != "13시" && item != "15시") {
                this.table.querySelector(".table-body > div:nth-child(2)").innerHTML += `
                    <div class="py-3 text-center border-bottom text-gray">${item} [ 경기 없음 ]</div>
                `;   
            } else if(data) {
                this.table.querySelector(".table-body > div:nth-child(2)").innerHTML += `
                    <div class="py-3 text-center border-bottom text-danger">${item} [ ${data.t ? `${data.t}` : "휴일" } ]</div>
                `;  
            } else {
                this.table.querySelector(".table-body > div:nth-child(2)").innerHTML += `
                    <div class="py-3 text-center border-bottom" data-time="${parseInt(item)}" data-type="주말리그">${item}</div>
                `;
            }

            let frstM = new Date(this.year, this.month - 1, 1);
            let m = frstM.getDate() - frstM.getDay() + 1;
            data = drowData.find(item => item.game == "새벽리그");
            if(m > 0 && this.checkDate == m && index == 0 || data) {
                this.table.querySelector(".table-body > div:nth-child(3)").innerHTML += `
                    <div class="py-3 text-center border-bottom text-danger">${item} [ ${data && data.t ? `${data.t}` : "휴일" } ]</div>
                `;  
            } else if(item != "04시" && item != "07시") {
                this.table.querySelector(".table-body > div:nth-child(3)").innerHTML += `
                    <div class="py-3 text-center border-bottom text-gray">${item} [ 경기 없음 ]</div>
                `;
            } else {
                this.table.querySelector(".table-body > div:nth-child(3)").innerHTML += `
                    <div class="py-3 text-center border-bottom" data-time="${parseInt(item)}" data-type="새벽리그">${item}</div>
                `;
            }
        })
    }
    // 5^0 = 1
    event() {
        $(this.cal).on("click", ".Btnright", e => {
            if(this.month + 1 > 12) { this.year++; this.month = 0; } 
            else this.month++;
            this.CalDrow();
        });
        $(this.cal).on("click", ".Btnleft", e => {
            if(this.month - 1 < 1) { this.year--; this.month = 12; } 
            else this.month--;
            this.CalDrow();
        });
        $(this.cal).on("click", ".rounded-pill.ok", e => {
            this.cal.querySelectorAll(".rounded-pill.bg-darkblue.text-white").forEach(item => {
                item.classList.remove("bg-darkblue");
                item.classList.remove("text-white");
            })
            e.currentTarget.classList.add("bg-darkblue");
            e.currentTarget.classList.add("text-white");
            this.checkDate = e.currentTarget.innerHTML;
            this.TableDrow();
        });
        
        $(document).on("click", ".res", e => {
            $("#res-modal #date").val(`${this.year}-${String(this.month).padStart(2, "0")}-${String(this.checkDate).padStart(2,"0")}`);
            $("#res-modal #count").val(20);

            $("#res-modal .title").html(`${this.year}년 ${this.month}월 ${this.checkDate}일`);

            $("#res-modal").modal("show");
        })

        $("#res-modal #gameType").on("change", e => {
            $("#res-modal #gameTime option:nth-child(1)").prop("selected", true);
            document.querySelectorAll("#res-modal #gameTime option").forEach(item => {
                let data = this.gameData.find(data => data.game == e.target.value 
                    && item.value == data.time
                    && data.date == `${this.year}-${String(this.month).padStart(2, "0")}-${String(this.checkDate).padStart(2, "0")}`);
                console.log(data);
                if(e.target.value == "새벽리그" && this.checkDate == 1 && item.value == 4 || !item.dataset.target || item.dataset.target != e.target.value || data) {
                    item.disabled = true;
                } else {
                    item.disabled = false;
                }
            })

            let nomalPrice = 0;

            if(e.target.value == "나이트리그") {
                nomalPrice = 50000;
            } else if(e.target.value == "주말리그") {
                nomalPrice = 100000;
            } else {
                nomalPrice = 30000;
            }
            $("#res-modal #price_viwe")[0].innerHTML = (nomalPrice).toLocaleString();
            $("#res-modal #price").val(nomalPrice);
        })

        $("#res-modal #count").on("change", e => {
            e.target.value < 20 ? e.target.value = 20 : e.target.value;

            let nomalPrice = 0;

            if($("#res-modal #gameType")[0].value == "나이트리그") {
                nomalPrice = 50000;
            } else if($("#res-modal #gameType")[0].value == "주말리그") {
                nomalPrice = 100000;
            } else {
                nomalPrice = 30000;
            }
            $("#res-modal #price_viwe")[0].innerHTML = ((e.target.value - 20) * 1000 + nomalPrice).toLocaleString();
            $("#res-modal #price").val((e.target.value - 20) * 1000 + nomalPrice);
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




