<style>
    .cell {width: calc(100% / 7); padding: 0.3rem;}
    .button {border: none; outline: none;}
    .bg-blue {background-color: #1f4f7e !important;}
    .selectable.active {background-color: #1f4f7e; color: white;}
</style>
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="calendar">
                <div class="calendar-head d-flex justify-content-center py-3 gap-4">
                    <button id="prev">
                        <i class="fa-solid fa-angle-left fx-7"></i>
                    </button>
                    <h4 class="text">3월</h4>
                    <button id="next">
                        <i class="fa-solid fa-angle-right fx-7"></i>
                    </button>
                </div>
                <div class="calendar-body d-flex flex-wrap align-content-start px-4" id="content">
                    <div class="calendar-item py-4 cell week text-center">일</div>
                    <div class="calendar-item py-4 cell week text-center">월</div>
                    <div class="calendar-item py-4 cell week text-center">화</div>
                    <div class="calendar-item py-4 cell week text-center">수</div>
                    <div class="calendar-item py-4 cell week text-center">목</div>
                    <div class="calendar-item py-4 cell week text-center">금</div>
                    <div class="calendar-item py-4 cell week text-center">토</div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">리그 및 날짜 선택</label>
                <table class="table table-bordered text-center">
                    <tbody>
                        <tr class="table-light">
                            <td></td>
                            <td>나이트리그</td>
                            <td>주말리그</td>
                            <td>새벽리그</td>
                        </tr>
                        <tr>
                            <td>1경기</td>
                            <td class="selectable" data-time="19시" data-league="나이트리그">19시</td>
                            <td class="selectable" data-time="09시" data-league="주말리그">09시</td>
                            <td class="selectable" data-time="04시" data-league="새벽리그">04시</td>
                        </tr>
                        <tr>
                            <td>2경기</td>
                            <td class="selectable" data-time="23시" data-league="나이트리그">23시</td>
                            <td class="selectable" data-time="13시" data-league="주말리그">13시</td>
                            <td class="selectable" data-time="07시" data-league="새벽리그">07시</td>
                        </tr>
                        <tr>
                            <td>3경기</td>
                            <td></td>
                            <td class="selectable" data-time="15시" data-league="주말리그">15시</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">인원 수</label>
                <input type="number" class="form-control" min="20">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">사용료</label>
                <input type="text" class="form-control" readonly>
            </div>
            <div>
                <button class="bg-blue w-100 py-3 text-white">예약하기</button>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = () => {
        const nowDate = new Date();
        let year = nowDate.getFullYear();
        let month = nowDate.getMonth();

        document.querySelector("#prev").addEventListener("click", e => {
            month--;
            if(month < 0) {
                year--;
                month = 11;
            }
            document.querySelector(".text").innerHTML = `${year}년 ${String(month + 1).padStart(2, "0")}월`;
            reader();
        })
        document.querySelector("#next").addEventListener("click", e => {
            month++;
            if(month > 11) {
                year++;
                month = 0;
            }
            document.querySelector(".text").innerHTML = `${year}년 ${String(month + 1).padStart(2, "0")}월`;
            reader();
        })

        function reader() {
            document.querySelectorAll(".calendar-item:not(.week)").forEach(item => {
                item.remove();
            })

            let firstDate = new Date(year, month, 1);
            let lastDate = new Date(year, month + 1, 0);

            const proveMonthLastDate = new Date(year, month, 0);
            for(let i = 0; i < firstDate.getDay(); i++) {
                document.querySelector("#content").innerHTML += `
                    <div class="calendar-item cell text-center">
                        <div class="fx-n2 py-4 rounded-pill text-muted">${proveMonthLastDate.getDate() - i}</div>
                    </div>
                `
            }
            
            for(let i = 1; i <= lastDate.getDate(); i++) {
                document.querySelector("#content").innerHTML += `
                    <div class="calendar-item cell text-center">
                        <div class="fx-n2 py-4 rounded-pill ${nowDate.getDate() == i ? "bg-primary text-white" : ""}">${i}</div>
                    </div>
                `
                document.querySelector("#content .calendar-item:not(.week):last-child").addEventListener("click", e => {
                    let hireDate = new Date(nowDate.getFullYear(), nowDate.getMonth(), i);
                    reader();

                    if(checkFirstMonday(hireDate)) {
                        document.querySelector(".selectable[data-time='04시'").classList.add("disabled");
                    } else {
                        document.querySelector(".selectable[data-time='04시'").classList.remove("disabled");
                    }
                })
            }

            for(let i = 1; i <= 6 - lastDate.getDay(); i++) {
                document.querySelector("#content").innerHTML += `
                    <div class="calendar-item cell text-center">
                        <div class="fx-n2 py-4 rounded-pill text-muted">${i}</div>
                    </div>
                `
            }

            for(let i = 0; i <= 6; i++) {

            }
        }

        reader();

        let time = '';
        let league = '';

        document.querySelectorAll("table .selectable").forEach(item => {
            item.addEventListener("click", e => {
                document.querySelectorAll("table .selectable").forEach(item => {item.classList.remove("active")});
                item.classList.add("active");
                time = item.innerHTML;
                league = item.dataset.league;  
            })
        })

        Date.prototype.getKDay = function() {
            return [6, 0, 1, 2, 3, 4, 5][this.getDay()];
        }

        function checkFirstMonday(date) {   
            if(date.getDate() === 1 && date.getKDay() === 0) return true;
            const lastDate = new Date(date.getFullYear(), date.getMonth() + 1, 0);
            const isLastWeek = lastDate.getDate() - lastDate.getKDay() <= date.getDate();
            if(isLastWeek) {
                const isNextMonth = lastDate.getKDay() < 3;
                return isNextMonth && date.getKDay() === 0;
            }

            const firstDate = new Date(date.getFullYear(), date.getMonth(), 1);
            const isFirstWeek = firstDate.getKDay() <= 3;
            const isFirstMonday = !isFirstWeek && 1 + (7 - firstDate.getKDay()) === date.getDate();
            return isFirstMonday;
        }
    }
</script>
