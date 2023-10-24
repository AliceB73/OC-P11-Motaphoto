
jQuery(document).ready(function () {
    let modal = jQuery("#contact-modal");
    let contactLink = jQuery(".contact-link");
    let contactButton = jQuery("#cta-single-photo");

    contactLink.click(function (event) {
        event.preventDefault();
        modal.addClass('show');
        jQuery('#ref').val(refPhoto);
        console.log(refPhoto);
    });

    contactButton.click(function (event) {
        event.preventDefault();
        modal.addClass('show');
        jQuery('#ref').val(refPhoto);
        console.log(refPhoto);
    });

    jQuery(window).click(function (event) {
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

let menuMobile = document.querySelector(".menu_mobile")
let burgerIcon = document.querySelector(".menu_mobile_icon");
let openBtn = document.getElementById("openBtn");

openBtn.addEventListener('click', function (event) {
    event.preventDefault();
    burgerIcon.classList.toggle('active');
    menuMobile.classList.toggle('active');
});