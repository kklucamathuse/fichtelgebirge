
let galleryId;
const galleries = document.querySelectorAll('.gallery-grid');

const gallerySliderInit = function() {
    galleries.forEach((galleryEl) => {
        galleryId = galleryEl.getAttribute('data-gallery-id');

        let gallerySwiper = new Swiper(`#gallery-slider-${galleryId}`, {
            modules: [Navigation, Pagination, Autoplay],
    
            loop: false,
            slidesPerView: 1,
            spaceBetween: 40,
    
            navigation: {
                nextEl: '.swiper-btn-next',
                prevEl: '.swiper-btn-prev',
                disabledClass: "bg-primary/[.8]"
            },
    
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                bulletClass: "bg-primary rounded-full w-4 h-4",
                bulletActiveClass: "bg-secondary",
                renderBullet: function (index, className) {
                    return `<button class="${className}"><span class="hidden">${index + 1}</span></button>`;
                }
            },
        
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
                1280: {
                    slidesPerView: 3,
                    pagination: false
                }
            },
        });
    });
}

const galleryFancyboxInit = function() {
    galleries.forEach((galleryEl) => {
        galleryId = galleryEl.getAttribute('data-gallery-id');

        // Default gallery
        Fancybox.bind(`.gallery-default [data-fancybox="gallery-${galleryId}"]`, {
            buttons: [
                "close"
            ],
            loop: true,
            protect: false,
            controls : false,
            caption : (fancybox, item) => {
                const caption = item.caption || '';
                return (caption)
            }
        });

        // Slider gallery
        Fancybox.bind(`.gallery-slider [data-fancybox="gallery-${galleryId}"]`, {
            infobar: false,
            toolbar: false,
            arrows: false,
            caption : (fancybox, item) => {
                const caption = item.caption || '';
                return (caption)
            }
        });
    });
}

export { gallerySliderInit, galleryFancyboxInit };