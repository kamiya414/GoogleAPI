var stars = document.getElementsByClassName("star");
var clicked = false;
document.addEventListener("DOMContentLoaded", () => {
  for (let i = 0; i < stars.length; i++) {
    stars[i].addEventListener(
      "mouseover",
      () => {
        if (!clicked) {
          for (let j = 0; j <= i; j++) {
            stars[j].style.color = "#f0da61";
          }
        }
      },
      false
    );

    stars[i].addEventListener(
      "mouseout",
      () => {
        if (!clicked) {
          for (let j = 0; j < stars.length; j++) {
            stars[j].style.color = "#a09a9a";
          }
        }
      },
      false
    );

    stars[i].addEventListener(
      "click",
      () => {
        clicked = true;
        for (let j = 0; j <= i; j++) {
          stars[j].style.color = "#f0da61";
        }
        for (let j = i + 1; j < stars.length; j++) {
          stars[j].style.color = "#a09a9a";
        }
      },
      false
    );
  }
});