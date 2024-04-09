class menu
{
    constructor()
    {
        this.menuaddter = document.querySelector(".menuaddter");

        this.mainmenu = document.querySelector("#mainmenu");
        this.submenu = document.querySelector("#submenu");

        this.list = document.querySelector("#list");

        this.menuAdd = document.querySelector("#add");

        this.GetData();

        this.Event();
    }

    GetData()
    {
        $.ajax({
            url: 'http://localhost/menu_process.php',
            method: "GET",
            success: (suc) => {
                console.log(suc);
                this.Drow(suc);
            }
        });
    }

    Drow(data)
    {
        this.mainmenu.innerHTML = '';
        for(let i = 0; i < data.length; i++) {
            this.mainmenu.innerHTML += `<div class="dis-center">${data[i].main.name}</div>`;
        }

        this.submenu.innerHTML = "";
        let DOM = "";
        for(let i = 0; i < data.length; i++) {
            DOM += `<div class="dis-center"><ul class="dis-col align-center">`;
            data[i].sub.forEach(element => {
                DOM += `<li>${element.name}</li>`;
            });
            DOM += `</ul></div>`;
        }

        console.log(DOM);
        this.submenu.innerHTML = DOM;
    }

    Event()
    {
        this.menuAdd.addEventListener('click', e => {
            this.menuAdd.remove();
            var newItem = document.createElement("div");
            // var textNode = document.createTextNode("Menuadd");
            // newItem.appendChild(textNode);
            newItem.innerHTML += 
            `
                <div class="main">
                    <input id="mainname" type="text" placeholder="메인메뉴">
                </div>
                <div class="sub">
                    <p>서브메뉴</p>
                    <button id="subAdd"><i class="fa-solid fa-plus"></i></button>
                </div>
                <button id="menuAdd">추가</button>
                <button id="back">취소</button>
            `;

            this.menuaddter.insertBefore(newItem, this.menuaddter.firstChild);

            document.querySelector("#subAdd").addEventListener('click', e => {
                const sub = document.querySelector(".sub");

                var newItem = document.createElement("div");
                var InputName = document.createElement("input");
                InputName.setAttribute("class", "subname");
                InputName.setAttribute("type", "text");
                InputName.setAttribute("placeholder", "서브메뉴");
                var InputLink = document.createElement("input");
                InputLink.setAttribute("class", "sublink");
                InputLink.setAttribute("type", "text");
                InputLink.setAttribute("placeholder", "링크");

                newItem.appendChild(InputName);
                newItem.appendChild(InputLink);

                var lastChild = sub.lastElementChild;

                // 마지막 자식 엘리먼트의 이전 형제로 새로운 엘리먼트 추가
                sub.insertBefore(newItem, lastChild);
            });

            document.querySelector("#menuAdd").addEventListener('click', e => {
                const main = document.querySelector("#mainname").value;
                const Esub = document.querySelector(".subname");
                const EsubLink = document.querySelector(".sublink");

                let sub = [];

                for(let i = 0; i < Esub.length; i++) {
                    sub.push({'name':Esub[i].value, 'link': EsubLink[i].value});
                };

                console.log({'main':main, 'sub':sub});

                $.ajax({
                    url: 'http://localhost/menu_insert.php',
                    method: "post",
                    data: {'main':main, 'sub':sub},
                    success: (suc) => {
                        console.log(suc);
                        this.Drow(suc);
                    }
                });
            })
        });
    }
}

window.onload = () => {
    var app = new menu();
}