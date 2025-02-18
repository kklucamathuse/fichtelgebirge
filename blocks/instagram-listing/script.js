const instagramSliderInit = function() {
	const swiper = new Swiper('.instagram-slider.swiper-container', {
		modules: [Navigation, Pagination, Autoplay],

        loop: false,
        slidesPerView: 1,
        spaceBetween: 40,

		navigation: {
			nextEl: '.swiper-btn-next',
			prevEl: '.swiper-btn-prev',
		},

		speed: 1200,
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
        },
    });
}

export { instagramSliderInit };