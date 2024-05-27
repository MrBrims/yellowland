<section class="section price" id="price_u">
  <div class="container">
    <h2 class="price__title">
      <?= carbon_get_post_meta(get_the_ID(), 'price_title'); ?>
    </h2>
    <div class="price__items">
      <?php foreach (carbon_get_post_meta(get_the_ID(), 'price_card') as $item) { ?>
        <a class="price__item go-to" data-goto=".message" href="#message_u">
          <h4 class="price__item-title">
            <?= $item['price_card-title']; ?>
          </h4>
          <p class="price__item-text">
            <?= $item['price_card-text']; ?>
          </p>
          <div class="price__item-box">
            <span class="price__item-pref">
              <?= $item['price_card-pref']; ?>
            </span>
            <span class="price__item-num">
              <?= $item['price_card-num']; ?>
            </span>
            <span class="price__item-suf">
              <?= $item['price_card-suf']; ?>
            </span>
          </div>
          <div class="price__item-btn">
            <?= $item['price_card-btn']; ?>
          </div>
        </a>
      <?php } ?>
    </div>
    <h3 class="price__list-title">
      <?= carbon_get_post_meta(get_the_ID(), 'price_list-title'); ?>
    </h3>
    <div class="price__text">
      <?= apply_filters('the_content', carbon_get_post_meta(get_the_ID(), 'price_list-text')); ?>
    </div>
  </div>
</section>