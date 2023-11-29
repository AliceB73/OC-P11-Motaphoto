
// Ouverture et fermeture de la modale de contact + remplissage automatique du champ refPhoto

jQuery(document).ready(function ($) {
    let modal = $("#contact-modal");
    let contactLink = $(".contact-link");
    let contactButton = $("#cta-single-photo");

    contactLink.click(function (event) {
        event.preventDefault();
        modal.addClass('show');
        $('#ref').val(refPhoto);
    });

    contactButton.click(function (event) {
        event.preventDefault();
        modal.addClass('show');
        $('#ref').val(refPhoto);
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

jQuery('.dropdown-content').each(function () {
    let dropdown = jQuery(this);
    dropdown.find('button').on('click', function () {
        // Supprime la classe 'selected' de toutes les options dans ce menu déroulant
        dropdown.find('button').removeClass('selected');
        // Ajoute la classe 'selected' à l'option cliquée dans ce menu déroulant
        jQuery(this).addClass('selected');
    });
});

// Responsive des filtres

// let swiper;

// function initSwiper() {
//     let screenWidth = window.innerWidth;
//     if (screenWidth < 855 && swiper === undefined) {
//         swiper = new Swiper('.swiper-container', {
//             direction: 'horizontal',
//             slidesPerView: 'auto',
//             freeMode: true,
//             scrollbar: {
//                 el: '.swiper-scrollbar',
//             },
//             mousewheel: true,
//             // resistance: true,
//             // resistanceRatio: 0.8,
//         });
//     } else if (screenWidth >= 855 && swiper !== undefined) {
//         swiper.destroy(true, true);
//         swiper = undefined;
//     }
// }

// // Initialiser Swiper au chargement de la page
// initSwiper();

// // Réinitialiser Swiper lorsque la taille de la fenêtre change
// window.addEventListener('resize', initSwiper);




//Gestion de la lightbox


jQuery(document).ready(function ($) {

    $('body').on('click', '.photo-fullscreen', function (e) {
        e.preventDefault();
        // On récupère l'URL de l'élément sur lequel on a cliqué
        const url = $(this).attr('href');
        // Tableau d'URLs de toutes les photos
        const images = $('.photo-fullscreen').map(function () {
            return $(this).attr('href');
        }).get();
        // Création de la lightbox et de ses éléments
        const lightbox = $('<div>', { class: 'lightbox' });
        const container = $('<div>', { class: 'lightbox-container' });
        const loader = $('<div>', { class: 'lightbox-loader' });
        container.append(loader);

        const img = $('<img>').on('load', function () {
            lightbox.addClass('open');
            // L'image chargée, on supprime le loader et on ajoute l'image au conteneur
            loader.remove();
            container.append(img);
            // Suppression de la référence et de la catégorie
            $('.lightbox-container .lightbox-info').remove();
            // On récupère la référence et la catégorie
            const reference = $('.photo-fullscreen[href="' + img.attr('src') + '"]').data('reference');
            const category = $('.photo-fullscreen[href="' + img.attr('src') + '"]').data('category');
            // On crée une nouvelle div contenant la référence et la catégorie
            if (reference && category) {
                const info = $('<div class="lightbox-info">').html('<span class="lightbox-reference">' + reference + '</span><span class="lightbox-category">' + category + '</span>');
                container.append(info);
            }
        }).attr('src', url);

        // Bouton de fermeture
        const closeButton = $('<button>', { class: 'lightbox-close' }).html('<i class="fa-solid fa-xmark"></i>');

        lightbox.append(closeButton, container);

        $('body').append(lightbox);
        closeButton.click(function (e) {
            e.preventDefault();
            lightbox.removeClass('open');
            setTimeout(function () {
                $('.lightbox').remove();
            }, 500);
        });

        // Fonction pour créer les boutons de pagination
        function createButtons() {
            let nextButton;
            let prevButton;

            if ($(window).width() < 768) {
                nextButton = $('<button>', { class: 'lightbox-next' }).html('<i class="fa-solid fa-chevron-right"></i>');
                prevButton = $('<button>', { class: 'lightbox-prev' }).html('<i class="fa-solid fa-chevron-left"></i>');
            } else {
                nextButton = $('<button>', { class: 'lightbox-next' }).text('Suivante →');
                prevButton = $('<button>', { class: 'lightbox-prev' }).text('← Précédente');
            }

            $('.lightbox').append(nextButton, prevButton);
            nextButton.click(function (e) {
                e.preventDefault();
                let index = images.indexOf($('.lightbox-container img').attr('src'));
                index = (index + 1) % images.length;
                // Ajoutez une classe à l'image pour déclencher l'animation de disparition
                $('.lightbox-container img').addClass('disappear');
                setTimeout(function () {
                    // Changez l'URL de l'image pour la prochaine image
                    $('.lightbox-container img').attr('src', images[index]);
                    // Supprimez la classe de l'image pour déclencher l'animation d'apparition
                    $('.lightbox-container img').removeClass('disappear');
                }, 1000); // Assurez-vous que ce délai correspond à la durée de votre animation CSS
            });

            prevButton.click(function (e) {
                e.preventDefault();
                let index = images.indexOf($('.lightbox-container img').attr('src'));
                index = (index - 1 + images.length) % images.length;
                // Ajoutez une classe à l'image pour déclencher l'animation de disparition
                $('.lightbox-container img').addClass('disappear');
                setTimeout(function () {
                    // Changez l'URL de l'image pour l'image précédente
                    $('.lightbox-container img').attr('src', images[index]);
                    // Supprimez la classe de l'image pour déclencher l'animation d'apparition
                    $('.lightbox-container img').removeClass('disappear');
                }, 1000); // Assurez-vous que ce délai correspond à la durée de votre animation CSS
            });
        }

        // Appeler la fonction pour créer les boutons
        createButtons();

        // Ajouter un écouteur d'événement resize à la fenêtre
        $(window).resize(function () {
            // Supprimer les anciens boutons
            $('.lightbox-next, .lightbox-prev').remove();
            // Recréer les boutons avec le nouveau contenu
            createButtons();
        });
    });


    // Possibilité de naviguer au clavier
    $(document).keyup(function (e) {
        if (e.key == 'Escape') {
            $('.lightbox').remove();
        }
        else if (e.key == 'ArrowLeft') {
            const images = $('.photo-fullscreen').map(function () {
                return $(this).attr('href');
            }).get();
            let index = images.indexOf($('.lightbox-container img').attr('src'));
            index = (index - 1 + images.length) % images.length;
            $('.lightbox-container img').attr('src', images[index]);
            $('.lightbox-container div:not(.lightbox-loader)').remove();
            const reference = $('.photo-fullscreen[href="' + images[index] + '"]').data('reference');
            const category = $('.photo-fullscreen[href="' + images[index] + '"]').data('category');
            if (reference && category) {
                const info = $('<div>').html('<span class="lightbox-reference">' + reference + '</span><span class="lightbox-category">' + category + '</span>');
                $('.lightbox-container').append(info);
            }
        }
        else if (e.key == 'ArrowRight') {
            const images = $('.photo-fullscreen').map(function () {
                return $(this).attr('href');
            }).get();
            let index = images.indexOf($('.lightbox-container img').attr('src'));
            index = (index + 1) % images.length;
            $('.lightbox-container img').attr('src', images[index]);
            $('.lightbox-container div:not(.lightbox-loader)').remove();
            const reference = $('.photo-fullscreen[href="' + images[index] + '"]').data('reference');
            const category = $('.photo-fullscreen[href="' + images[index] + '"]').data('category');
            if (reference && category) {
                const info = $('<div>').html('<span class="lightbox-reference">' + reference + '</span><span class="lightbox-category">' + category + '</span>');
                $('.lightbox-container').append(info);
            }
        }
    });
});


//Requête ajax des filtres


let current_filters = {};
let offset = 12; // Initialisation de l'offset à 12 pour charger les posts suivants

jQuery('.dropdown-content button').click(function (event) {

    event.preventDefault();

    let filterType = jQuery(this).closest('.dropdown').find('.dropbtn').text().trim(); // récupère le texte du bouton qui correspond au type de filtre
    let filterValue = jQuery(this).text();
    current_filters[filterType] = filterValue;

    // Réinitialisation l'offset chaque fois qu'un filtre est modifié
    offset = 12;

    jQuery.ajax({
        url: load_more_params.ajaxurl,
        type: 'post',
        data: {
            action: 'filter_posts_function',
            filters: current_filters,
        },
        success: function (response) {
            jQuery('.catalogue').html(response); //On remplace les photos présentes par les photos filtrées
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
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
            filters: current_filters, // Envoyer current_filters à la place de current_filter
        },
        success: function (response) {
            jQuery('.catalogue').append(response);
            offset += 12; // Augmente l'offset pour charger les prochains posts
        }
    });
});