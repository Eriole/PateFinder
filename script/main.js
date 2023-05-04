let stats = document.querySelectorAll("[data-type]");
let count = document.querySelector("#count");

window.addEventListener("load", addition);
stats.forEach((stat) => {
  //Event Listener onchange and on key up
  stat.addEventListener("change", addition);
  stat.addEventListener("keyup", addition);
});

// Add values to a variable sum
function addition() {
  let stats = document.querySelectorAll("[data-type]");
  let sum = 0;
  stats.forEach((stat) => {
    sum += parseInt(stat.value || 0);
  });
  displaySum(sum);
}

//Display sentence with substraction
function displaySum(sum) {
  count.innerHTML = `Reste entre ${60 - sum} et ${80 - sum} pts à distribuer.`;
}
