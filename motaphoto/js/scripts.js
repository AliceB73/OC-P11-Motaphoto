
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


// Gestion de l'affichage de la miniature au survol de la pagination sur la page single.php

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

// Gestion du background-color des options de filtre

let dropdowns = document.querySelectorAll(".dropdown-content a");

dropdowns.forEach(function (dropdown) {
    dropdown.addEventListener('mouseenter', function (event) {
        event.preventDefault();
        dropdown.style.backgroundColor = "#FFD6D6";
    });
    dropdown.addEventListener('mouseleave', function (event) {
        event.preventDefault();
        dropdown.style.backgroundColor = "";
    });
    dropdown.addEventListener('mousedown', function (event) {
        event.preventDefault();
        console.log("clic");
        dropdown.style.backgroundColor = "#FE5858";
    });
    dropdown.addEventListener('click', function (event) {
        event.preventDefault();
        dropdown.style.backgroundColor = "#E00000";
        dropdown.style.color = "#fff";
    })
});

//Requête ajax des filtres

let current_filter = '';

jQuery('.dropdown-content a').click(function (event) {
    event.preventDefault();
    current_filter = jQuery(this).text();
    let filter = jQuery(this).text();
    jQuery.ajax({
        url: load_more_params.ajaxurl,
        type: 'post',
        data: {
            action: 'filter_posts_function',
            filter: filter,
        },
        success: function (response) {
            jQuery('.catalogue').html(response); //On remplace les photos présentes par les photos filtrées
        }
    });
});

//Bouton "load more"

jQuery('#load-more').click(function (event) {
    event.preventDefault();

    if (jQuery('.catalogue:contains("Aucun post n\'a été trouvé")').length > 0) {
        return;
    }

    let num_posts = jQuery('.photo-catalogue').length;
    jQuery.ajax({
        url: load_more_params.ajaxurl,
        type: 'post',
        data: {
            action: 'load_more_function',
            offset: num_posts,
            filter: current_filter,
        },
        success: function (response) {
            jQuery('.catalogue').append(response);
        }
    });
});