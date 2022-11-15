document.querySelectorAll('.work-count-message').forEach(colorMessage);

function colorMessage (e) {
    if (e.textContent == 0) {
        e.style.display = "none";
    } else if (e.textContent > 99) {
        e.textContent = "99+";
    }
}
