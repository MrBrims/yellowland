import { Swiper, Navigation, Pagination, Lazy } from 'swiper';
Swiper.use([Navigation, Pagination, Lazy])

export function swiperMudules() {
  const slider = new Swiper('.reviews-slider__body', {
    navigation: {
      nextEl: ".reviews-slider__next",
      prevEl: ".reviews-slider__prev",
    },
    loop: true,
    slidesPerView: 1,
    spaceBetween: 10,
    lazy: true,
    breakpoints: {
      520: {
        slidesPerView: 2,
        spaceBetween: 10,
      },
      920: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
      1200: {
        slidesPerView: 4,
        spaceBetween: 30,
      },
    },
  });

  const sliderTeam = new Swiper('.team-slider__body', {
    loop: true,
    slidesPerView: 1,
    lazy: true,
    pagination: {
      el: ".team-slider__nav",
      clickable: true,
    },
  });
}