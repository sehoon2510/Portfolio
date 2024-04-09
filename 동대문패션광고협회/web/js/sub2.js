class video
{
    constructor() {
        this.video = document.querySelector("#video");

        this.controller = document.querySelector("#controll");

        this.play = document.querySelector("#play");
        this.pause = document.querySelector("#pause");
        this.stop = document.querySelector("#stop");

        this.rewindButton = document.querySelector("#rewind");
        this.fastForwardButton = document.querySelector("#fast-forward");

        this.speedUp = document.querySelector("#speedUp");
        this.speedDown = document.querySelector("#speedDown");
        this.resetSpeed = document.querySelector("#resetSpeed");

        this.toggleControlsButton = document.querySelector("#hide");

        this.toggleLoopButton = document.querySelector("#toggleLoopButton");
        this.toggleAutoplayButton = document.querySelector("#toggleAutoplayButton");

        this.video.control = true;

        this.Event();
    }

    Event() {
        this.play.addEventListener('click', e => {
            if (this.video.paused || this.video.ended) {
                this.video.play();
            }
        });

        this.pause.addEventListener('click', e => {
            console.log(this.video.played);
            if(this.video.played) {
                this.video.pause();
            }
        });
        
        this.stop.addEventListener('click', e => {
            this.video.pause();
            this.video.currentTime = 0;
        });

        this.rewindButton.addEventListener("click", () => {
            this.video.currentTime -= 10;
        });
    
        this.fastForwardButton.addEventListener("click", () => {
            this.video.currentTime += 10;
        });

        this.speedDown.addEventListener("click", () => {
            this.video.playbackRate -= 0.1;
          });
            
          this.speedUp.addEventListener("click", () => {
            this.video.playbackRate += 0.1;
          });

          
        this.resetSpeed.addEventListener("click", () => {
            this.video.playbackRate = 1;
        });

        this.toggleControlsButton.addEventListener("click", () => {
            if (this.video.control) {
              this.video.control = false;
              this.controller.classList.add("hide");
              this.toggleControlsButton.innerHTML = '<i class="fa-solid fa-eye"></i>';
            } else {
              this.video.control = true;
              this.controller.classList.remove("hide");
              this.toggleControlsButton.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
            }
          });

        this.toggleLoopButton.addEventListener("click", () => {
            if (this.video.loop) {
                this.video.loop = false;
                this.toggleLoopButton.innerHTML = '<i class="fa-sharp fa-solid fa-infinity"></i>';
            } else {
              this.video.loop = true;
              this.toggleLoopButton.innerHTML = '<i class="fa-sharp fa-solid fa-infinity" style="color: #bababa;"></i>';
            }
        });
          
        this.toggleAutoplayButton.addEventListener("click", () => {
            if (this.video.autoplay) {
              this.video.autoplay = false;
              this.toggleAutoplayButton.innerHTML = '<i class="fa-solid fa-bolt"></i>';
            } else {
              this.video.autoplay = true;
              this.toggleAutoplayButton.innerHTML = '<i class="fa-solid fa-bolt" style="color: #a3a3a3;"></i>';
            }
        });
        
    }
}

window.onload = () => {
    var app = new video();
}