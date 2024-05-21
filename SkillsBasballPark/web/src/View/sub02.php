<div class="w-100 bg-blue sub-wrap">    
        <img src="./images/25.jpg" alt="" class="fit-cover filter">
        <div class="w-100">
            <div class="container padding py-3">
                <a href="/" class="text-white">홈</a>
                <i class="fa-solid fa-angle-right mx-3 text-white"></i>
                <a href="/statistics" class="text-white">statistics</a>
            </div>
        </div>
    </div>
    <div class="container padding pt-5">
        <div class="mb-4">
            <div class="d-flex align-items-end justify-content-between">
                <div class="pb-3">
                    <span class="text-muted">방문자 차트</span>
                    <div class="title">STATISTICS</div>
                </div>
                <div class="btn-group">
                    <button class="bg-darkblue text-white px-4 py-2" data-target="#row-chart">세로로 보기</button>
                    <button class="bg-blue text-white px-4 py-2" data-target="#col-chart">가로로 보기</button>
                </div>
            </div>
            <div class="d-flex table-head">
                <select name="name" id="name" class="px-3 py-1">
                    
                </select>
                <select name="day" id="day" class="px-2 py-1">

                </select>
            </div>
        </div>
    </div>
    <div class="container padding pb-5 mb-5">
        <div class="row">
            <div class="col-9 chart-item" id="row-chart">
                <div class="chart d-flex w-100">
                    <div class="chart-aside text-end">
                        <div class="pr-3 py-1">500</div>
                        <div class="pr-3 py-1">450</div>
                        <div class="pr-3 py-1">400</div>
                        <div class="pr-3 py-1">350</div>
                        <div class="pr-3 py-1">300</div>
                        <div class="pr-3 py-1">250</div>
                        <div class="pr-3 py-1">200</div>
                        <div class="pr-3 py-1">150</div>
                        <div class="pr-3 py-1">100</div>
                        <div class="pr-3 py-1">50</div>
                        <div class="pr-3 py-1">0</div>
                    </div>
                    <div class="w-100">
                        <div class="h-100 pb-3 mt-1"> 
                            <!-- 여기다가 차트 -->
                            <div class="chart-area border h-100 w-100 d-flex justify-content-around align-items-end overflow-hidden">
                                
                            </div>
                        </div>
                        <div class="chart-side d-flex justify-content-around">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9 chart-item d-none" id="col-chart">
                <div class="chart d-flex w-100">
                    <div class="chart-aside text-end d-flex flex-column justify-content-around">
                        <div class="pr-3 py-3 nowrap"></div>
                        <div class="pr-3 py-3 nowrap"></div>
                        <div class="pr-3 py-3 nowrap"></div>
                        <div class="pr-3 py-3 nowrap"></div>
                        <div class="pr-3 py-3 nowrap"></div>
                        <div class="pr-3 py-3 nowrap"></div>
                        <div class="pr-3 py-3 nowrap"></div>
                        <div class="pr-3 py-3 nowrap"></div>
                    </div>
                    <div class="w-100">
                        <div class="h-100 pb-3 mt-1"> 
                            <!-- 여기다가 차트 -->
                            <div class="chart-area border h-100 w-100 d-flex flex-column justify-content-around overflow-hidden">
                                
                            </div>
                        </div>
                        <div class="chart-side d-flex justify-content-between">
                            <div>0</div>
                            <div>50</div>
                            <div>100</div>
                            <div>150</div>
                            <div>200</div>
                            <div>250</div>
                            <div>300</div>
                            <div>350</div>
                            <div>400</div>
                            <div>450</div>
                            <div>500</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="d-flex align-items-center table-head">
                    <div class="cell-50 text-center">시간</div>
                    <div class="cell-50 text-center">방문자 수</div>
                </div>
                <div class="table-list" id="table-content">

                </div>
            </div>
        </div>
    </div>
    <script>
        class App {
            constructor() {
                this.datas = [];
                this.name = null;
                this.day = null;

                this.RowcountZone = document.querySelector("#row-chart .chart-aside");
                this.RowtiemZone = document.querySelector("#row-chart .chart-side");
                this.ColtiemZone = document.querySelector("#col-chart .chart-aside");
                this.ColcountZone = document.querySelector("#col-chart .chart-side");

                this.init();
                this.event();
            }

            async init() {
                let json = await dataPost("GET", '/common/js/visitors.json');
                this.datas = JSON.parse(json).data;

                const names = Array.from(new Set(this.datas.map(item => item.name)));
                const days = Array.from(this.datas.reduce((a, item) => {
                    return new Set([...a, ...item.visitors.map(item => item.day)]);
                }, []));
                
                $("#name").html(names.map(item => `<option value="${item}">${item}</option>`));
                $("#day").html(days.map(item => `<option value="${item}">${item}</option>`));

            }

            reader() {
                if(!this.name || !this.day) return;

                const times = Object.entries(this.datas.find(item => item.name == this.name).visitors.find(item => item.day == this.day).visitor);

                $("#table-content").html(times.map(item => `
                    <div class="item py-3 d-flex align-items-center border-bottom" id="table-content">
                        <div class="cell-50 text-center">${item[0]}</div>
                        <div class="cell-50 text-center">${item[1]}명</div>
                    </div>
                `));

                this.RowcountZone.innerHTML = "";
                for(let i = 500; i >= 0; i = i-50) {
                    this.RowcountZone.innerHTML += `<div class="pr-3 py-1">${i}</div>`;
                }
                this.ColcountZone.innerHTML = "";
                for(let i = 0; i <= 500; i = i+50) {
                    this.ColcountZone.innerHTML += `<div>${i}</div>`;
                }

                $(this.RowtiemZone).html(times.map(item => `<div>${item[0]}</div>`));
                $(this.ColtiemZone).html(times.map(item => `<div class="pr-3 py-3 nowrap">${item[0]}</div>`));
                $("#row-chart .chart-area").html(times.map(item => `<div class="bg-blue col-1" style="height: 0%;" data-length="${(item[1] / 500) * 100}"></div>`));
                document.querySelectorAll("#row-chart .chart-area > div").forEach(item => {
                    console.log(item);
                    $(item).animate({
                        height: item.dataset.length + "%"
                    }, 350);
                })
                $("#col-chart .chart-area").html(times.map(item => `<div class="bg-blue my-4" style="height: 50px; width: 0%;" data-length="${(item[1] / 500) * 100}"></div>`));
                document.querySelectorAll("#col-chart .chart-area > div").forEach(item => {
                    $(item).animate({
                        width: item.dataset.length + "%"
                    }, 350);
                })
            }

            event() {
                $(".btn-group").on("click", "button", e => {
                    document.querySelectorAll(".chart-item").forEach(item => {
                        item.classList.add("d-none");
                    });
                    
                    document.querySelectorAll(".btn-group button").forEach(item => {
                        item.classList.remove("bg-darkblue");
                        item.classList.add("bg-blue");
                    });

                    e.target.classList.remove("bg-blue");
                    e.target.classList.add("bg-darkblue");
                    document.querySelector(`${e.target.dataset.target}`).classList.remove("d-none");
                })

                $("#name").on("change", e => {
                    this.name = e.target.value;
                    this.reader();
                });
                
                $("#day").on("change", e => {
                    this.day = e.target.value;
                    this.reader();
                });
            }
        }

        window.onload = () => {
            window.app = new App();
        }
    </script>