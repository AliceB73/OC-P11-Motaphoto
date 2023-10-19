
let modal = document.getElementById("contact-modal");
let contactLink = document.querySelector(".contact-link");

contactLink.onclick = function (event) {
    event.preventDefault();
    modal.classList.add('show');
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.classList.remove('show');
    }
}