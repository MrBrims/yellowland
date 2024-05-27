<section class="additional">
  <div class="container">
    <div class="additional__items">
      <?php foreach (carbon_get_post_meta(get_the_ID(), 'additional_card') as $item) { ?>
        <div class="additional__item">
          <div class="additional__item-head">
            <img class="additional__item-icon" src="<?= $item['additional_card-icon']; ?>" alt="additional icon">
            <h4 class="additional__item-title">
              <?= $item['additional_card-title']; ?>
            </h4>
          </div>
          <div class="additional__item-list">
            <?= apply_filters('the_content', $item['additional_card-list']); ?>
          </div>
        </div>
      <?php } ?>
    </div>
    <h4 class="additional__title">
      <?= carbon_get_post_meta(get_the_ID(), 'additional_title'); ?>
    </h4>
    <p class="additional__text">
      <?= carbon_get_post_meta(get_the_ID(), 'additional_subtitle'); ?>
    </p>
    <a class="additional__btn btn go-to" data-goto=".message" href="#message_u">
      <?= carbon_get_post_meta(get_the_ID(), 'additional_btn-text'); ?>
    </a>
  </div>
</section>