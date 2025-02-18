
let teaserId;
const teaserSliders = document.querySelectorAll('.teaser-slider');

const teaserSliderInit = function() {
    teaserSliders.forEach((teaserEl) => {
        teaserId = teaserEl.getAttribute('data-teaser-id');

        let teaserSwiper = new Swiper(`#teaser-slider-${teaserId}`, {
            modules: [Navigation, Pagination, Autoplay],
    
            loop: true,
            slidesPerView: 1,
            spaceBetween: 40,
    
            navigation: {
                nextEl: '.swiper-btn-next',
                prevEl: '.swiper-btn-prev',
                disabledClass: "bg-primary/[.8]",
                lockClass: "hidden"
            },

            speed: 600,
            autoplay: {
                delay: 8000,
                disableOnInteraction: false,
            },
        
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
                1280: {
                    slidesPerView: 2,
                    pagination: false,
                    autoplay: false
                }
            },
        });
    });
}

export { teaserSliderInit }