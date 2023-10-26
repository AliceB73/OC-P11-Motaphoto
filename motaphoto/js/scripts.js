

// jQuery(document).ready(function ($) {...});

/*(function ($) {
    $('#saySomething').click(...);
}(jQuery));*/

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

//

/*let arrows = document.querySelectorAll(".meta-nav");
arrows.forEach(function (arrow, index) {
    console.log('Element .meta-nav numéro ' + index + ' :', arrow);
});

let preview = document.getElementById('preview');
console.log(preview);

arrows.addEventListener("mouseover", function (event) {
    event.target.style.backgroundColor = "red";
}) */



/*jQuery(document).ready(function () {
    let arrow = jQuery(".meta-nav");
    let preview = jQuery("#preview");

    console.log(arrow);
    console.log(preview);
    console.log(next_photo_field['photo']);
    console.log(prev_photo_field);

    arrow.click(function (event) {
        event.preventDefault();
        preview.style.backgroundImage = 'url(' + prev_photo_field + ')';
        console.log("allo");
    });
});

/*jQuery(document).ready(function () {
    let arrow = document.querySelectorAll('.meta-nav');
    let preview = document.getElementById('preview');
    jQuery('.meta-nav').hover(
        function () {
            console.log(arrow);
            console.log(preview);
            let thumbnailUrl = $(this).data('thumbnail');
            console.log('Mouse over .meta-nav, setting preview background to:', thumbnailUrl);
            $('#preview').css('backgroundImage', 'url(' + thumbnailUrl + ')');
        }
    )
}) */

/*let element = document.getElementById('preview');
console.log(element);
let metanav = document.querySelectorAll('.meta-nav');
console.log(metanav);

jQuery(document).ready(function (jQuery) {
    jQuery('.meta-nav').hover(
        function () {
            let thumbnailUrl = jQuery(this).data('thumbnail');
            console.log('Mouse over .meta-nav, setting preview background to:', thumbnailUrl);
            jQuery('#preview').css('backgroundImage', 'url(' + thumbnailUrl + ')');
        },
        function () {
            console.log('Mouse out .meta-nav, clearing preview background');
            jQuery('#preview').css('backgroundImage', '');
        }
    );
}); */


//

let menuMobile = document.querySelector(".nav_header_mobile")
let burgerIcon = document.querySelector(".menu_mobile_icon");
let openBtn = document.getElementById("openBtn");

openBtn.addEventListener('click', function (event) {
    event.preventDefault();
    burgerIcon.classList.toggle('active');
    menuMobile.classList.toggle('active');
});

/*jQuery(document).ready(function ($) {
    $('.nav-previous a, .nav-next a').hover(
        function () { // Fonction exécutée lorsque la souris survole l'élément
            var thumbnailUrl = $(this).find('.meta-nav').data('thumbnail');
            $('#preview img').attr('src', thumbnailUrl);
        },
        function () { // Fonction exécutée lorsque la souris quitte l'élément
            $('#preview img').attr('src', '');
        }
    );
});*/


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