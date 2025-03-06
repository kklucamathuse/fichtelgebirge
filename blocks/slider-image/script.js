function imageSlider() {
  var swiper = new Swiper(".swiper", {
    loop: false,
    keyboard: true, // for accessibility
    slidesPerView: "auto",
    spaceBetween: 25,
    breakpoints: {
      // when window width is >= 320px
      320: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      // when window width is >= 480px
      480: {
        slidesPerView: 1,
        spaceBetween: 30,
      },
      // when window width is >= 640px
      767: {
        slidesPerView: 2,
        spaceBetween: 40,
      },
      1024: {
        slidesPerView: "auto",
        spaceBetween: 25,
      },
    },
    navigation: {
      nextEl: ".section .wrapper .headline .navigation .button-next",
      prevEl: ".section .wrapper .headline .navigation .button-prev",
    },
    speed: 500,
    preventClicks: false, // Allow button clicks
    preventClicksPropagation: false, // Ensure clicks propagate correctly
  });
}

document.addEventListener("DOMContentLoaded", imageSlider);
