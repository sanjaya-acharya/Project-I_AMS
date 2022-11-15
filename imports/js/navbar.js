document.querySelector('.notification-icon').addEventListener('click', ()=>{
	document.querySelector('.notification-container').style.visibility='visible';
});

let navMenu = document.querySelector('.line-container');
navMenu.addEventListener('click', manageNavMenu);
let navMenuOpen = false;
let navMenuBox = document.querySelector('.nav-menu-container');

function manageNavMenu () {
	if (navMenuOpen) {
		navMenu.classList.remove('show-box-shadow');
		navMenuBox.style.visibility = "hidden";
		navMenuBox.style.left = "-200px";
		navMenuOpen = false;
	} else {
		navMenu.classList.add('show-box-shadow');
		navMenuBox.style.visibility = "visible";
		navMenuBox.style.left = "0";
		navMenuOpen = true;
	}
}

let profileMenu = document.querySelector('.profile-container');
let profileIcon = document.querySelector('.profile-icon');
profileMenu.addEventListener('click', manageProfileMenu);
let profileMenuOpen = false;
let profileMenuBox = document.querySelector('.profile-menu-container');

function manageProfileMenu () {
	if (profileMenuOpen) {
		profileIcon.classList.remove('show-box-shadow');
		profileMenuBox.style.visibility = "hidden";
		profileMenuOpen = false;
	} else {
		profileIcon.classList.add('show-box-shadow');
		profileMenuBox.style.visibility = "visible";
		profileMenuOpen = true;
	}
}


document.querySelectorAll('.work-count-message').forEach(colorMessage);

function colorMessage (e) {
	if (e.textContent == 0) {
		e.style.display = "none";
	} else if (e.textContent > 99) {
		e.textContent = "99+";
	}
}
