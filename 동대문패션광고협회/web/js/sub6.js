// 광고카드 선택 및 순서 재배치 기능을 담은 클래스
class AdCardManager {
    constructor() {
      this.selectedCards = [];
      this.previousState = [];
      this.toastTimeout = null;
  
      // 광고카드 요소들에 대한 이벤트 리스너 등록
      this.event();
  
      const reorderButton = document.getElementById("reorder-button");
      reorderButton.addEventListener("click", () => this.reorderCards());
  
      const undoButton = document.getElementById("undo-button");
      undoButton.addEventListener("click", () => this.undoReorder());
  
      const redoButton = document.getElementById("redo-button");
      redoButton.addEventListener("click", () => this.redoReorder());
    }
    
    event()
    {
        const adCards = document.querySelectorAll(".ad-card");
        adCards.forEach((card, index) => {
            console.log(card, index);
            card.addEventListener("click", () => this.toggleCardSelection(card, index));
            card.draggable = true;
            card.addEventListener("dragstart", (event) => this.dragStart(event, index));
            card.addEventListener("dragover", (event) => this.dragOver(event));
            card.addEventListener("drop", (event) => this.drop(event, index));
        });
    }

    // 광고카드 선택 토글
    toggleCardSelection(card, index) {
        console.log(index);
      if (this.selectedCards.includes(index)) {
        this.selectedCards = this.selectedCards.filter((selected) => selected !== index);
        card.classList.remove("selected");
      } else {
        this.selectedCards.push(index);
        card.classList.add("selected");
      }
  
      this.updateCardNumber();
    }
  
    // 광고카드 번호 업데이트
    updateCardNumber() {
      const adCards = document.querySelectorAll(".ad-card");
      adCards.forEach((card, index) => {
        const number = this.selectedCards.indexOf(index) + 1;
        card.querySelector("p").innerHTML = `Ad Card ${number}`;
      });
    }
  
    // 드래그 시작
    dragStart(event, index) {
      event.dataTransfer.setData("text/plain", index);
    }
  
    // 드래그 오버
    dragOver(event) {
      event.preventDefault();
    }
  
    // 드롭
    drop(event, index) {
        event.preventDefault();
        const draggedIndex = event.dataTransfer.getData("text/plain");
        const adCards = document.querySelectorAll(".ad-card");
    
        // 드롭한 위치의 요소와 교환하려는 요소의 부모 요소가 같은지 검사
        if (adCards[index].parentNode === adCards[draggedIndex].parentNode) {
          this.swapCards(draggedIndex, index);
          this.updateCardNumber();
        } else {
          console.error("Failed to drop card: Invalid parent elements.");
        }
      }
  
    // 광고카드 순서 교환
    swapCards(index1, index2) {
        const adCards = document.querySelectorAll(".ad-card");
        const parent = adCards[index1].parentNode;
        const sibling = adCards[index1].nextSibling;

        // Clone the nodes to be swapped
        const clone1 = adCards[index1].cloneNode(true);
        const clone2 = adCards[index2].cloneNode(true);

        // Replace the nodes in the DOM
        parent.replaceChild(clone2, adCards[index1]);
        parent.replaceChild(clone1, adCards[index2]);

        // Update the references in the adCards array
        adCards[index1] = clone2;
        adCards[index2] = clone1;

        this.showToastMessage(`광고카드 ${index1 + 1}와 광고카드 ${index2 + 1}의 순서가 교환되었습니다.`);

        this.removeEventListeners(adCards);
        this.event();
      }
  
    // 광고카드 순서 재배치
    reorderCards() {
      if (this.selectedCards.length > 1) {
        const reorderedCards = [];
        const adCards = document.querySelectorAll(".ad-card");
  
        // 선택한 카드들을 새로운 순서로 배치
        for (let i = 0; i < adCards.length; i++) {
          const cardIndex = this.selectedCards.indexOf(i);
          if (cardIndex !== -1) {
            reorderedCards.push(adCards[i]);
          }
        }
  
        // 재배치된 카드들을 이전 순서와 교체
        this.previousState.push([...adCards]);
        adCards.forEach((card) => card.remove());
        reorderedCards.forEach((card) => document.getElementById("ad-card-container").appendChild(card));
  
        this.showToastMessage("광고카드 순서가 재배치되었습니다.");
      }
    }
  
    // 순서 재배치 실행 취소
    undoReorder() {
      if (this.previousState.length > 0) {
        const currentState = [...document.querySelectorAll(".ad-card")];
        this.previousState.push(currentState);
  
        const prevState = this.previousState.pop();
        document.querySelectorAll(".ad-card").forEach((card) => card.remove());
        prevState.forEach((card) => document.getElementById("ad-card-container").appendChild(card));
  
        this.showToastMessage("실행 취소되었습니다.");
      }
    }
  
    // 토스트 메시지 표시
    showToastMessage(message) {
      const toast = document.getElementById("toast-message");
      toast.textContent = message;
      toast.classList.add("show");
  
      if (this.toastTimeout) {
        clearTimeout(this.toastTimeout);
      }
  
      this.toastTimeout = setTimeout(() => {
        toast.classList.remove("show");
      }, 2000);
    }

    // 이벤트 리스너 제거
    removeEventListeners(adCards) {
        adCards.forEach((card, index) => {
          if (card.parentNode) {
            const clonedCard = card.cloneNode(true);
            card.parentNode.replaceChild(clonedCard, card);
          }
        });
      }
  }
  
  // AdCardManager 인스턴스 생성
  const adCardManager = new AdCardManager();