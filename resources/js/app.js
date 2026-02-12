// import $ from "jquery";
// window.$ = window.jQuery = $;

// Popper (Bootstrap 4)
import "popper.js";

// Bootstrap 4
import "bootstrap";

// Owl Carousel
import "owl.carousel";

// Slick
import "slick-carousel";

// Swiper
import Swiper from "swiper";
import "swiper/css";

window.Swiper = Swiper;

/*
|--------------------------------------------------------------------------
| Optional: Initialize plugins safely
|--------------------------------------------------------------------------
*/

document.addEventListener("DOMContentLoaded", function () {

    // Owl
    if ($(".owl-carousel").length) {
        $(".owl-carousel").owlCarousel();
    }

    // Slick
    if ($(".slick-slider").length) {
        $(".slick-slider").slick();
    }

});
