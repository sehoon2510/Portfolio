console.log("start");
[1,2,3,4,5].map((v) => {
    let ran = Math.random();
    console.log("v", typeof v);
    console.log("ran", ran);
    console.log("ran * v * 36", ran * v * 36);
    console.log("ran * v * 36 / 5", ran * v * 36 / 5);
    console.log("v * 1", v * 1);
    console.log("ran * v * 36 / 5 + v * 1", ran * v * 36 / 5 + v * 1);
    console.log("ran * v * 36 / 5 + v * 1", (ran * v * 36 / 5 + v * 1).toString(36));
})
let r = Math.random();
console.log(
    [1,2,3,4,5].map((v) => (r * v * 36 / 5 + v * 1).toString(36)),
    [1,2,3,4,5].map((v) => (r * v * 36 / 5 + v * 1).toString(36)[0])
)
console.log("end");