class Game {
    constructor() {
        this.datas = [
            {
                "code":"L001",
                "shop":"창원시",
                "product":"풋고추",
                "items":[
                    {"item":"풋고추"},
                    {"item":"단감"},
                    {"item":"수박"},
                    {"item":"홍합"}
                ]
            },
            {
                "code":"L002",
                "shop":"진주시",
                "product":"고추",
                "items":[
                    {"item":"고추"},
                    {"item":"마"},
                    {"item":"실크"},
                    {"item":"배"}
                ]
            },
            {
                "code":"L003",
                "shop":"통영시",
                "product":"굴",
                "items":[
                    {"item":"굴"},
                    {"item":"진주"},
                    {"item":"나전칠기"}
                ]
            },
            {
                "code":"L004",
                "shop":"사천시",
                "product":"멸치",
                "items":[
                    {"item":"멸치"},
                    {"item":"단감"},
                    {"item":"쥐치포"},
                    {"item":"옹기"}
                ]
            },
            {
                "code":"L005",
                "shop":"김해시",
                "product":"단감",
                "items":[
                    {"item":"단감"},
                    {"item":"화훼"},
                    {"item":"참외"},
                    {"item":"도자기"}
                ]
            },
            {
                "code":"L006",
                "shop":"밀양시",
                "product":"대추",
                "items":[
                    {"item":"대추"},
                    {"item":"깻잎"},
                    {"item":"사과"},
                    {"item":"풋고추"},
                    {"item":"도자기"}
                ]
            },
            {
                "code":"L007",
                "shop":"거제시",
                "product":"유자",
                "items":[
                    {"item":"유자"},
                    {"item":"죽순"},
                    {"item":"알로에"},
                    {"item":"한라봉"},
                    {"item":"천혜향"}
                ]
            },
            {
                "code":"L008",
                "shop":"양산시",
                "product":"매실",
                "items":[
                    {"item":"매실"},
                    {"item":"버섯"},
                    {"item":"딸기"},
                    {"item":"달걀"},
                    {"item":"당근"}
                ]
            },
            {
                "code":"L009",
                "shop":"의령군",
                "product":"수박",
                "items":[
                    {"item":"수박"},
                    {"item":"호박"},
                    {"item":"한지"},
                    {"item":"버섯"}
                ]
            },
            {
                "code":"L010",
                "shop":"함안군",
                "product":"곶감",
                "items":[
                    {"item":"곶감"},
                    {"item":"수박"},
                    {"item":"파프리카"},
                    {"item":"연근"}
                ]
            },
            {
                "code":"L011",
                "shop":"창녕군",
                "product":"양파",
                "items":[
                    {"item":"양파"},
                    {"item":"마늘"},
                    {"item":"고추"},
                    {"item":"단감"}
                ]
            },
            {
                "code":"L012",
                "shop":"고성군",
                "product":"방울토마토",
                "items":[
                    {"item":"방울토마토"},
                    {"item":"멸치젓"},
                    {"item":"대하"}
                ]
            },
            {
                "code":"L013",
                "shop":"남해군",
                "product":"마늘",
                "items":[
                    {"item":"마늘"},
                    {"item":"고사리"},
                    {"item":"멸치"}
                ]
            },
            {
                "code":"L014",
                "shop":"하동군",
                "product":"녹차",
                "items":[
                    {"item":"녹차"},
                    {"item":"인삼"},
                    {"item":"배"},
                    {"item":"작설차"}
                ]
            },
            {
                "code":"L015",
                "shop":"산청군",
                "product":"약초",
                "items":[
                    {"item":"약초"},
                    {"item":"곶감"},
                    {"item":"동충하초"},
                    {"item":"누에가루"},
                    {"item":"황화씨"},
                ]
            },
            {
                "code":"L016",
                "shop":"함양군",
                "product":"밤",
                "items":[
                    {"item":"밤"},
                    {"item":"흑돼지"},
                    {"item":"포도"},
                    {"item":"명주"},
                    {"item":"산채"},
                    {"item":"농악기"}
                ]
            },
            {
                "code":"L017",
                "shop":"거창군",
                "product":"사과",
                "items":[
                    {"item":"사과"},
                    {"item":"덩굴차"},
                    {"item":"딸기"},
                    {"item":"포도"}
                ]
            },
            {
                "code":"L018",
                "shop":"합천군",
                "product":"돼지고기",
                "items":[
                    {"item":"돼지고기"},
                    {"item":"돼지"},
                    {"item":"작약"},
                    {"item":"양파"},
                    {"item":"돗자리"},
                    {"item":"왕골"},
                    {"item":"도자기"},
                    {"item":"한과"}
                ]
            },
        ];

        this.content = document.querySelector("#content");
        
        this.startBtn = document.querySelector("#startBtn");
        this.hintBtn = document.querySelector("#hintBtn");
        this.timeText = document.querySelector("#timeZone");
        this.scoreText = document.querySelector("#scoreZone");
        this.form = document.querySelector("#form");

        this.cardTimer = [];
        this.cardList = [];

        this.timeout = null;
        this.inter = null;

        this.timeM = 0;
        this.timeS = 0;
        this.score = 0;

        this.init();
    }

    init() {
        this.setting();
        this.event();
    }

    setting() {
        clearInterval(this.inter);
        clearTimeout(this.timeout);
        this.cardTimer.forEach(timer => {
            clearTimeout(timer);
        });
        this.cardTimer = [];
        this.cardList = [];
        this.timeM = 0;
        this.timeS = 5;
        this.timeText.innerHTML = "남은 시간 : 00:05";
        this.scoreText.innerHTML = "찾은 카드 수 : 0개";
        this.startBtn.innerHTML = "게임시작";
        this.score = 0;
    }

    event() {

        document.querySelector("#form #saveBtn").addEventListener("click", e => {
            let name = document.querySelector("#form #name").value;
            let phone = document.querySelector("#form #phone").value;

            let nameText = /[^a-zA-Zㄱ-ㅎ가-힣]/;
            let phoneText = /^(\d{0,3})(\d{0,4})(\d{0,4})$/;

            if(name.trim() == "" || phone.trim() == "") alert("필수값을 전부 입력해 주세요");
            else if(name.length < 2 || name.length > 50) alert("이름은 최소 2글자 최대 50글짜만 입력할 수 있습니다.");
            else if(nameText.test(name)) alert("입력 형식이 틀렸습니다.");
            else if(phone.length > 13) alert("전화번호는 000-0000-0000형식으로 11자리 숫자만 가능합니다.");
            else if(phoneText.test(phone)) alert("입력 형식이 틀렸습니다.");
            else {
                let form = new FormData();
                form.append("name", name);
                form.append("phone", phone);
                form.append("score", this.score);

                this.applicantsPush(form, phone);
            }
        })

        document.querySelector("#form #name").addEventListener("input", e => {
            e.target.value = e.target.value.replace(/[^a-zA-Zㄱ-ㅎ가-힣]/g, "").substr(0, 50);
        });

        document.querySelector("#form #phone").addEventListener("input", e => {
            if(e.target.value.replace(/[^0-9]/g, '').length >= 11) {
                e.target.value = e.target.value.replace(/[^0-9]/g, '').substr(0, 11).replace(/^(\d{0,3})(\d{0,4})(\d{0,4})$/g, "$1-$2-$3").replace(/(\-{1,2})$/g, "");
            } else {
                e.target.value = e.target.value.replace(/[^0-9]/g, '').replace(/^(\d{0,3})(\d{0,4})(\d{0,4})$/g, "$1-$2-$3").replace(/(\-{1,2})$/g, "");
            }
        });        

        this.startBtn.addEventListener("click", e => {
            this.setting();
            this.drow();
        });

        this.hintBtn.addEventListener("click", e => {
            this.cardTimer.forEach(timer => {
                clearTimeout(timer);
            });
            this.cardTimer = [];
            this.cardList = [];
            clearTimeout(this.timer);
            this.timer = [];

            this.content.querySelectorAll(".ok").forEach(item => {
                item.classList.add("check");
            });

            this.timer = setTimeout(() => {
                window.app.content.querySelectorAll(".ok").forEach(item => {
                    item.classList.remove("check");
                });
            }, 3000);
        });

        this.content.addEventListener("click", e => {
            if(!e.target.classList.contains("clickCard") || this.cardList.length >= 2) return;
            let target = this.content.querySelector(`#${e.target.dataset.id}`);
            if(!target || !target.classList.contains("ok") || target.classList.contains("check")) return;

            if(this.cardList.length <= 1) {
                target.classList.add("check");
                this.cardList.push(target);
                if(this.cardList.length <= 1) {
                    this.cardTimer.push(
                        setTimeout(() => {
                            if(window.app.cardList.length >= 2) {
                                clearTimeout(window.app.cardTimer[0]);
                            } else {
                                if(window.app.cardList[0].classList.contains("ok")) {
                                    window.app.cardList[0].classList.remove("check");
                                    window.app.cardList = [];
                                }
                            }

                            window.app.cardTimer = [];
                        }, 3000)
                    )
                } else {
                    this.cardTimer.forEach(timer => {
                        clearTimeout(timer);
                    });
                    this.cardTimer = [];
    
                    this.timer = setTimeout(() => {
                        if(window.app.cardList[0].id.split("-")[0] == window.app.cardList[1].id.split("-")[0]) {
                            window.app.cardList[0].classList.remove("ok");
                            window.app.cardList[1].classList.remove("ok");
                            window.app.score++;
                            window.app.scoreText.innerHTML = `찾은 카드 수 : ${window.app.score}개`;
                            if(window.app.score >= 8) {
                                window.app.gameEnd();
                            }

                        } else {
                            window.app.cardList[0].classList.remove("check");
                            window.app.cardList[1].classList.remove("check");
                        }
                        window.app.timer = null;
                        window.app.cardList = [];
                    }, 1000);
                }
            }
        });

    }

    drow() {
        let drowData = this.datas.sort(() => Math.random() - 0.3).slice(0, 8);
        drowData.forEach(data => {
            drowData.push(data);
        });

        this.content.innerHTML = "";
        drowData.sort(() => Math.random() - 0.3).forEach((item, index) => {
            this.content.innerHTML += `
                <div class="game__card__item ok check" id="${item.code}-${index}">
                    <div class="game__card">
                        <div class="back d-flex align-items-center justify-content-center clickCard" data-id="${item.code}-${index}">
                            <p class="mb-0 text-light clickCard" data-id="${item.code}-${index}">힘내라 경남!</p>
                        </div>
                        <div class="on">
                            <div class="image__area d-flex align-items-center justify-content-center">
                                <img src="./image/${item.shop}_${item.product}.jpg" alt="gameImage1">
                            </div>
                            <div class="text__area d-flex justify-content-center align-items-center">
                                <p class="mb-0 text-light">${item.shop}</p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });

        this.inter = setInterval(() => {
            window.app.timeS--;
            if(window.app.timeS < 0) {
                if(window.app.timem > 0) {
                    window.app.timeM--;
                    window.app.timeS = 59;
                } else {
                    clearInterval(window.app.inter);
                    window.app.inter = null;
                    window.app.timeM = 0;
                    window.app.timeS = 10;
                    this.startBtn.innerHTML = "다시하기";

                    window.app.inter = setInterval(() => {
                        window.app.timeS--;
                        if(window.app.timeS < 0) {
                            if(window.app.timem > 0) {
                                window.app.timeM--;
                                window.app.timeS = 59;
                            } else {
                                clearInterval(window.app.inter);
                                window.app.inter = null;
                                window.app.timeM = 0;
                                window.app.timeS = 0;
                                
                                window.app.gameEnd();
                            }
                        }
            
                        window.app.timeText.innerHTML = `남은 시간 : ${String(window.app.timeM).padStart(2, "0")}:${String(window.app.timeS).padStart(2, "0")}`;
                    }, 1000);
                }
            }

            window.app.timeText.innerHTML = `남은 시간 : ${String(window.app.timeM).padStart(2, "0")}:${String(window.app.timeS).padStart(2, "0")}`;
        }, 1000);

        this.timeout = setTimeout(() => {
            window.app.content.querySelectorAll(".ok").forEach(item => {
                item.classList.remove("check");
            });
            window.app.timer = null; 
        }, 5000);
    }

    gameEnd() {

        this.cardTimer.forEach(timer => {
            clearTimeout(timer);
        })
        this.cardTimer = [];
        this.cardList = [];
        clearTimeout(this.timer);
        clearInterval(this.inter);
        this.timer = null;
        this.inter = null;

        this.content.querySelectorAll(".ok").forEach(item => {
            item.classList.add("check");
            item.classList.add("lose");
        });

        this.form.classList.add("check");
    }

    async applicantsPush(data, phone) {
        try {
            let json = await post("POST", "/api/event/applicants", data);

            alert(json.message);

            this.setting();
            this.content.innerHTML = "";
            this.datas.slice(0, 16).forEach((item, index) => {
                this.content.innerHTML += `
                    <div class="game__card__item">
                        <div class="game__card">
                            <div class="back d-flex align-items-center justify-content-center">
                                <p class="mb-0 text-light">힘내라 경남!</p>
                            </div>
                            <div class="on">
                                <div class="image__area d-flex align-items-center justify-content-center">
                                    
                                </div>
                                <div class="text__area d-flex justify-content-center align-items-center">
                                    <p class="mb-0 text-light"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });

            this.stampeList(phone);

            this.form.classList.remove("check");
        } catch(e) {
            alert(e.message);
        }
    }

    async stampeList(phone) {
        try {
            let json = await post("GET", `/api/event/${phone}/stamps`);

            this.stampe(json.stamps);
            console.log(json);
        } catch(e) {
            alert(e.message);
        }
    }

    stampe(datas) {
        let stapmes = document.querySelectorAll(".stampe__area");

        for(let i = datas.length; i >= 0; i++) {
            let text = stapmes[i].querySelector(".stampe p");
            text.innerHTML = `${data}`;
            stapmes[i].classList.add("check");
        }
        
    }
}

class Review {
    constructor() {
        this.score = 0;

        this.saveBtn = document.querySelector("#saveBtn");
        this.closeBtn = document.querySelector("#closeBtn");
        this.imageAdd = document.querySelector("#imageAdd");

        this.init();
    }

    init() {
        this.event();
    }

    event() {
        document.querySelector(".modal #name").addEventListener("input", e => {
            e.target.value = e.target.value.replace(/[^a-zA-Zㄱ-ㅎ가-힣]/g, "").substr(0, 50);
        });

        document.querySelector(".modal .starScoreGiveList").addEventListener("mousemove", e => {
            if(!e.target.classList.contains("left") && !e.target.classList.contains("right") && !e.target.classList.contains("zore")) return;
            this.score = e.target.dataset.score;

            if(this.score == 0) {
                document.querySelectorAll(".starItem img")[0].src = "./image/star1.svg";
                document.querySelectorAll(".starItem img")[1].src = "./image/star1.svg";
                document.querySelectorAll(".starItem img")[2].src = "./image/star1.svg";
                document.querySelectorAll(".starItem img")[3].src = "./image/star1.svg";
                document.querySelectorAll(".starItem img")[4].src = "./image/star1.svg";
            } else if(this.score == 1) {
                document.querySelectorAll(".starItem img")[0].src = "./image/star2.svg";
                document.querySelectorAll(".starItem img")[1].src = "./image/star1.svg";
                document.querySelectorAll(".starItem img")[2].src = "./image/star1.svg";
                document.querySelectorAll(".starItem img")[3].src = "./image/star1.svg";
                document.querySelectorAll(".starItem img")[4].src = "./image/star1.svg";
            } else if(this.score == 2) {
                document.querySelectorAll(".starItem img")[0].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[1].src = "./image/star1.svg";
                document.querySelectorAll(".starItem img")[2].src = "./image/star1.svg";
                document.querySelectorAll(".starItem img")[3].src = "./image/star1.svg";
                document.querySelectorAll(".starItem img")[4].src = "./image/star1.svg";
            } else if(this.score == 3) {
                document.querySelectorAll(".starItem img")[0].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[1].src = "./image/star2.svg";
                document.querySelectorAll(".starItem img")[2].src = "./image/star1.svg";
                document.querySelectorAll(".starItem img")[3].src = "./image/star1.svg";
                document.querySelectorAll(".starItem img")[4].src = "./image/star1.svg";
            } else if(this.score == 4) {
                document.querySelectorAll(".starItem img")[0].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[1].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[2].src = "./image/star1.svg";
                document.querySelectorAll(".starItem img")[3].src = "./image/star1.svg";
                document.querySelectorAll(".starItem img")[4].src = "./image/star1.svg";
            } else if(this.score == 5) {
                document.querySelectorAll(".starItem img")[0].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[1].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[2].src = "./image/star2.svg";
                document.querySelectorAll(".starItem img")[3].src = "./image/star1.svg";
                document.querySelectorAll(".starItem img")[4].src = "./image/star1.svg";
            } else if(this.score == 6) {
                document.querySelectorAll(".starItem img")[0].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[1].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[2].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[3].src = "./image/star1.svg";
                document.querySelectorAll(".starItem img")[4].src = "./image/star1.svg";
            } else if(this.score == 7) {
                document.querySelectorAll(".starItem img")[0].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[1].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[2].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[3].src = "./image/star2.svg";
                document.querySelectorAll(".starItem img")[4].src = "./image/star1.svg";
            } else if(this.score == 8) {
                document.querySelectorAll(".starItem img")[0].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[1].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[2].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[3].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[4].src = "./image/star1.svg";
            } else if(this.score == 9) {
                document.querySelectorAll(".starItem img")[0].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[1].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[2].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[3].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[4].src = "./image/star2.svg";
            } else if(this.score == 10) {
                document.querySelectorAll(".starItem img")[0].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[1].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[2].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[3].src = "./image/star3.svg";
                document.querySelectorAll(".starItem img")[4].src = "./image/star3.svg";
            }
        });

        this.imageAdd.addEventListener("click", e => {
            let inputList = document.querySelector(".modal .input__list");
            let input = document.createElement("input");
            input.setAttribute("type", "file");
            input.setAttribute("accept", ".jpg");
            input.classList.add("form-control");
            inputList.appendChild(input);
        });

        this.saveBtn.addEventListener("click", e => {
            let name = document.querySelector(".modal #name").value;
            let product = document.querySelector(".modal #product").value;
            let shop = document.querySelector(".modal #shop").value;
            let date = document.querySelector(".modal #date").value;
            let content = document.querySelector(".modal #contentText").value;
            let images = document.querySelectorAll(".modal .input__list input");

            let nameText = /[^a-zA-Zㄱ-ㅎ가-힣]/;

            let into = true;

            if(name.trim() == "" || product.trim() == "" || shop.trim() == "" || date.trim() == "" || content.trim() == "" || images[0].value.trim() == "") {
                into = false;
                alert("필수값이 비었습니다.");
                return;
            } else if(nameText.test(name)){
                into = false;
                alert("이름 형식이 틀렸습니다.");
                return;
            } else if(name.length < 2 || name.length > 50)  {
                into = false;
                alert("이름은 최소 2자 최대 50자 입력할 수 있습니다.");
                return;
            } else if(content.length < 100)  {
                into = false;
                alert("내용의 최저 입력수는 100자 입니다.");
                return;
            }

            images.forEach(data => {
                console.log(data.files);
                if(data.files[0].name.split(".")[data.files[0].name.split(".").length - 1] != "jpg") {
                    into = false;
                    alert("이미지는 jpg파일만 업로드 할 수 있습니다.");
                } else if(data.files.length > 1) {
                    into = false;
                    alert("이미지는 하나의 등록칸에 하나 등록할 수 있습니다.");
                }
            });

            if(into) {
                alert("구매 후기가 등록되었습니다.");
            }
        });

        this.closeBtn.addEventListener("click", e => {
            this.score = 0;
            document.querySelectorAll(".starItem img").forEach(data => {data.src = "./image/star1.svg";})
            
            document.querySelector(".modal #name").value = "";
            document.querySelector(".modal #product").value = "";
            document.querySelector(".modal #shop").value = "";
            document.querySelector(".modal #date").value = "";
            document.querySelector(".modal #contentText").value = "";
            document.querySelectorAll(".modal .input__list").innerHTML = `<input type="file" class="form-control" accept=".jpg">`;

        });
    }
}