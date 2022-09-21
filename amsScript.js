const menuBtn = document.querySelector('.menu-btn');
const menuBox = document.querySelector('.menu-container');
let menuOpen = false;
let menuOption = document.querySelector('.menu');
menuOption.style.display = "none";

menuBox.addEventListener('mouseover', menuHS);
menuBox.addEventListener('mouseout', menuHS);

function menuHS() {
    if (!menuOpen) {
        menuBtn.classList.add('open');
        menuOption.style.display = "block";
        menuOpen = true;
    } else {
        menuBtn.classList.remove('open');
        menuOption.style.display = "none";
        menuOpen = false;
    }
}
