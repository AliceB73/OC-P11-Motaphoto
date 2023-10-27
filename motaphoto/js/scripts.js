
// Ouverture et fermeture de la modale de contact + remplissage automatique du champ refPhoto

jQuery(document).ready(function ($) {
    let modal = $("#contact-modal");
    let contactLink = $(".contact-link");
    let contactButton = $("#cta-single-photo");

    contactLink.click(function (event) {
        event.preventDefault();
        modal.addClass('show');
        $('#ref').val(refPhoto);
        console.log(refPhoto);
    });

    contactButton.click(function (event) {
        event.preventDefault();
        modal.addClass('show');
        $('#ref').val(refPhoto);
        console.log(refPhoto);
    });

    $(window).click(function (event) {
        if (event.target == modal[0]) {
            modal.removeClass('show');
        }
    });
});

// Menu mobile

let menuMobile = document.querySelector(".nav_header_mobile")
let burgerIcon = document.querySelector(".menu_mobile_icon");
let openBtn = document.getElementById("openBtn");

openBtn.addEventListener('click', function (event) {
    event.preventDefault();
    burgerIcon.classList.toggle('active');
    menuMobile.classList.toggle('active');
});


// Gestion de l'affiche de la miniature au survol de la pagination sur la page single.php

jQuery(document).ready(function ($) {
    $('.nav-previous a, .nav-next a').hover(
        function () {
            let thumbnailUrl = $(this).find('.meta-nav').data('thumbnail');
            if (thumbnailUrl) {
                $('#preview').html('<img src="' + thumbnailUrl + ' ">');
            }
        },
        function () {
            $('#preview').empty();
        }
    );
});