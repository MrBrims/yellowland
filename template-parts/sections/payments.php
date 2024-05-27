<section class="payments">
  <div class="container">
    <h2 class="payments__title">
      <?= carbon_get_post_meta(get_the_ID(), 'payments_title'); ?>
    </h2>
    <div class="payments__text">
      <?= apply_filters('the_content', carbon_get_post_meta(get_the_ID(), 'payments_text')); ?>
    </div>
    <div class="payments__items">
      <?php foreach (carbon_get_theme_option('payments_box') as $item) { ?>
        <div class="payments__item">
          <img class="payments__img" src="<?= $item['payments_icons']; ?>" alt="payments images">
        </div>
      <?php } ?>
    </div>
  </div>
</section>