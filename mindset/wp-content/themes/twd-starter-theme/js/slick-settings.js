jQuery(document).ready(function ($) {

    // Enable Slick Slider on elements with the class 'slider'
    $('.slider').slick({
        dots: true,
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 2,
        autoplay: true,
        autoplaySpeed: 6000, // speed is in milliseconds
        speed: 300
    });

});