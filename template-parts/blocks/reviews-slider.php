<div class="reviews-slider">
  <div class="reviews-slider__body swiper">
    <div class="reviews-slider__wrapper swiper-wrapper">
      <?php foreach (carbon_get_post_meta(get_the_ID(), 'reviews_box') as $item) { ?>
        <div class="reviews-slider__slide swiper-slide">
          <a class="reviews-slider__link" href="<?= $item['reviews_box-img']; ?>" data-fancybox="slider gallery">
            <img class="reviews-slider__img" src="<?= $item['reviews_box-img']; ?>" alt="reviews image">
          </a>
        </div>
      <?php } ?>
    </div>
  </div>
  <div class="reviews-slider__prev">
    <svg width="16" height="10" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="m0 5 7.5 4.33V.67L0 5Zm16-.75H6.75v1.5H16v-1.5Z" fill="#6E6870" />
    </svg>
  </div>
  <div class="reviews-slider__next">
    <svg width="16" height="10" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M16 5 8.5.67v8.66L16 5ZM0 5.75h9.25v-1.5H0v1.5Z" fill="#6E6870" />
    </svg>
  </div>
</div>