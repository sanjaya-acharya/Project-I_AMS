let notificationBox = document.querySelector('.notification-container');
let notificationCloseBtn = document.querySelector('.notification-close-btn');

notificationCloseBtn.addEventListener('click', () => {
    notificationBox.style.visibility='hidden';
});