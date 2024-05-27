<section class="reviews" id="reviews_u">
  <div class="container">
    <h2 class="reviews__title">
      <?= carbon_get_post_meta(get_the_ID(), 'reviews_title'); ?>
    </h2>
    <div class="reviews__rev-inner">
      <a class="reviews__rev-box" href="https://g.page/r/CdJfZ9AsoxPEEAI/review" target="_blank">
        <img class="reviews__rev-img" src="<?= URI; ?>/assets/images/icons/google.svg" alt="reviews">
        <div class="rev-rating">
          <?php
          $rating = floatval(carbon_get_theme_option('rating-google')) * 2;
          $star = intdiv($rating, 2);
          for ($i = 0; $i < $star; $i++) {
            echo '<span class="rev-rating__star rev-rating__star-fill"></span>';
          }
          if ($rating % 2 != 0) {
            echo '<span class="rev-rating__star rev-rating__star-half"></span>';
          }
          echo '<span class="rev-rating__num">' . $rating / 2 . ' / 5</span>';
          ?>
        </div>
      </a>
      <a class="reviews__rev-box" href="https://www.provenexpert.com/ug-gwc/" target="_blank">
        <img class="reviews__rev-img" src="<?= URI; ?>/assets/images/icons/provenexpert-logo.svg" alt="reviews">
        <div class="rev-rating">
          <?php
          $rating = floatval(carbon_get_theme_option('rating-praven')) * 2;
          $star = intdiv($rating, 2);
          for ($i = 0; $i < $star; $i++) {
            echo '<span class="rev-rating__star rev-rating__star-fill"></span>';
          }
          if ($rating % 2 != 0) {
            echo '<span class="rev-rating__star rev-rating__star-half"></span>';
          }
          echo '<span class="rev-rating__num">' . $rating / 2 . ' / 5</span>';
          ?>
        </div>
      </a>
      <a class="reviews__rev-box" href="https://www.trustami.com/erfahrung/ug-gwc-de-bewertung" target="_blank">
        <img class="reviews__rev-img" src="<?= URI; ?>/assets/images/icons/bewer-3.jpg" alt="reviews">
        <div class="rev-rating">
          <?php
          $rating = floatval(carbon_get_theme_option('rating-trustami')) * 2;
          $star = intdiv($rating, 2);
          for ($i = 0; $i < $star; $i++) {
            echo '<span class="rev-rating__star rev-rating__star-fill"></span>';
          }
          if ($rating % 2 != 0) {
            echo '<span class="rev-rating__star rev-rating__star-half"></span>';
          }
          echo '<span class="rev-rating__num">' . $rating / 2 . ' / 5</span>';
          ?>
        </div>
      </a>
    </div>
    <?php get_template_part('template-parts/blocks/reviews-slider') ?>
  </div>
</section>