
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
        dropdown.style.backgroundColor = "#FE5858";
    });
    dropdown.addEventListener('click', function (event) {
        event.preventDefault();
        dropdown.style.backgroundColor = "#E00000";
        dropdown.style.color = "#fff";
    })
});

//Requête ajax des filtres


let current_filters = {};
let offset = 12; // Initialisez l'offset à 12 pour charger les posts suivants

jQuery('.dropdown-content a').click(function (event) {

    event.preventDefault();

    let filterType = jQuery(this).closest('.dropdown').find('.dropbtn').text().trim(); // récupère le texte du bouton qui correspond au type de filtre
    let filterValue = jQuery(this).text();
    current_filters[filterType] = filterValue;

    // Réinitialisez l'offset chaque fois qu'un filtre est modifié
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
            filters: current_filters, // Envoyez current_filters à la place de current_filter
        },
        success: function (response) {
            jQuery('.catalogue').append(response);
            offset += 12; // Augmente l'offset pour charger les prochains posts
        }
    });
});

// Gestion de la lightbox

class Lightbox {

    static init() {
        const links = document.querySelectorAll('a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"]')
            .forEach(link => link.addEventListener('click', e => {
                e.preventDefault()
                new Lightbox(e.currentTarget.getAttribute('href'))
            }))
    }

    constructor(url) {
        this.element = this.buildDOM(url)
        this.loadImage(url)
        this.onKeyUp = this.onKeyUp.bind(this)
        document.body.appendChild(this.element)
        document.addEventListener('keyup', this.onKeyUp)
    }

    loadImage(url) {
        const image = new Image();
        const container = this.element.querySelector('.lightbox-container');
        const loader = document.createElement('div');
        loader.classList.add('lightbox-loader');
        container.appendChild(loader);
        image.onload = function () {
            container.removeChild(loader);
            container.appendChild(image);
        }
        image.src = url;
    }

    /**
     * 
     * @param {KeyboardEvent} e 
     */
    onKeyUp(e) {
        if (e.key == 'Escape') {
            this.close(e)
        }
    }

    /**
     * Ferme la lightbox
     * @param {MouseEvent} e 
     */
    close(e) {
        e.preventDefault();
        this.element.classList.add('fadeOut');
        window.setTimeout(() => {
            this.element.parentElement.removeChild(this.element)
        }, 500)
        document.removeEventListener('keyup', this.onKeyUp)
    }

    buildDOM(url) {
        const dom = document.createElement('div')
        dom.classList.add('lightbox')
        dom.innerHTML = `<button class="lightbox-close"><i class="fa-solid fa-xmark"></i></button>
        <button class="lightbox-next">Suivante →</button>
        <button class="lightbox-prev">← Précédente</button>
        <div class="lightbox-container"></div>`
        dom.querySelector('.lightbox-close').addEventListener('click', this.close.bind(this))
        return dom
    }
}

Lightbox.init()