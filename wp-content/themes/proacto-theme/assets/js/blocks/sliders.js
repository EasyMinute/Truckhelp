// import Swiper
import Swiper, { Navigation, Pagination } from 'swiper';

// import Swiper styles bundle
import "swiper/css/bundle";

// import Swiper styles by modules
import "swiper/css";
// import "swiper/css/navigation";
// import "swiper/css/pagination";



const links_swiper = new Swiper('.links_slider.swiper', {
    // Optional parameters
    // modules: [Navigation, Pagination],
    direction: 'horizontal',
    loop: false,
    slidesPerView: 1,
    spaceBetween: 10,
    breakpoints: {

        // when window width is >= 640px
        980: {
            slidesPerView: 4,
            spaceBetween: 0
        }
    }


    // If we need pagination
    // pagination: {
    //     el: '.swiper-pagination',
    // },

    // Navigation arrows
    // navigation: {
    //     nextEl: '.swiper-button-next',
    //     prevEl: '.swiper-button-prev',
    // },

});

const gallery_swiper = new Swiper('.gallery_slider.swiper', {
    // Optional parameters
    modules: [Navigation, Pagination],
    direction: 'horizontal',
    loop: true,
    slidesPerView: 1,
    spaceBetween: 10,
    breakpoints: {

        // when window width is >= 640px
        980: {
            slidesPerView: 3,
            spaceBetween: 16
        },
    },


    // If we need pagination
    // pagination: {
    //     el: '.swiper-pagination',
    // },

    // Navigation arrows
    navigation: {
        nextEl: '.gallery_slider .swiper-button-next',
        prevEl: '.gallery_slider .swiper-button-prev',
    },

});