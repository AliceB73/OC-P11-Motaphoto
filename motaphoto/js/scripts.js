
let modal = document.getElementById("contact-modal");
let contactLink = document.querySelector(".contact-link");

contactLink.onclick = function (event) {
    event.preventDefault();
    modal.style.display = "block";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}