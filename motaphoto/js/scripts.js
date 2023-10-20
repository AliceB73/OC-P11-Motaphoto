
jQuery(document).ready(function () {
    let modal = jQuery("#contact-modal");
    let contactLink = jQuery(".contact-link");

    contactLink.click(function (event) {
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