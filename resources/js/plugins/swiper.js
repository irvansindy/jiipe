import Swiper from 'swiper'
import 'swiper/css'

document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.swiper', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
        },
    })
})
