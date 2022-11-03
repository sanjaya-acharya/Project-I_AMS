document.querySelector('iframe').onload = ()=>{
    document.querySelector('iframe').contentDocument.body.querySelector('img').style.width='100%';
}

let filters = document.querySelectorAll(".review-filters");
filters.forEach(el => el.addEventListener("click", manageFilters));

function manageFilters (e) {
    filters.forEach((elements) => {
        elements.classList.remove('active-filter');
    });

    let el = e.target;
    let text = el.textContent;

    el.classList.add('active-filter');

    // if (text == "All") {
    //     showNoWorkBox('.no-work-at-all');
    //     document.querySelector('.to-review-container').style.visibility = "visible";
    //     document.querySelector('.reviewed-container').style.visibility = "visible";
    // } else if (text == "To Review") {
    //     showNoWorkBox('.no-work-to-review');
    //     document.querySelector('.to-review-container').style.visibility = "visible";
    //     document.querySelector('.reviewed-container').style.visibility = "hidden";
    // } else if (text == "Reviewed") {
    //     showNoWorkBox('.no-work-reviewed');
    //     document.querySelector('.to-review-container').style.visibility = "hidden";
    //     document.querySelector('.reviewed-container').style.visibility = "visible";
    // }



    if (text == "All") {
        showNoWorkBox('.no-work-at-all');
        if (document.querySelector('.to-review-container').innerHTML != "") {
            document.querySelector('.to-review-container').style.display = "block";
        }
        if (document.querySelector('.reviewed-container').innerHTML != "") {
            document.querySelector('.reviewed-container').style.display = "block";
        }
    } else if (text == "To Review") {
        showNoWorkBox('.no-work-to-review');
        if (document.querySelector('.to-review-container').innerHTML != "") {
            document.querySelector('.to-review-container').style.display = "block";
        }
        document.querySelector('.reviewed-container').style.display = "none";
    } else if (text == "Reviewed") {
        showNoWorkBox('.no-work-reviewed');
        document.querySelector('.to-review-container').style.display = "none";
        if (document.querySelector('.reviewed-container').innerHTML != "") {
            document.querySelector('.reviewed-container').style.display = "block";
        }
    }
}

function showNoWorkBox (str) {
    document.querySelector('.no-work-at-all').style.display = "none";
    document.querySelector('.no-work-to-review').style.display = "none";
    document.querySelector('.no-work-reviewed').style.display = "none";

    if (document.querySelector(str).innerHTML != "") {
        document.querySelector(str).style.display = "block";
    }
}