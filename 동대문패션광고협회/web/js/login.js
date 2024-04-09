const JoinOpen = document.querySelector("#JoinOpen");
const JoinClose = document.querySelector("#JoinClose");

const popup = document.querySelector(".popup");

JoinOpen.addEventListener('click', e => {
    popup.classList.add("active");
});

JoinClose.addEventListener('click', e => {
    popup.classList.remove("active");
});

document.querySelector("html").addEventListener('cilck', e => {
    console.log(e.target);
    if(!e.target.classList.contains("p")) {
        popup.classList.remove("active");
    }
});