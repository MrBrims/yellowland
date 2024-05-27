<section class="services" id="services_u">
  <div class="container">
    <h2 class="services__title">
      <?= carbon_get_post_meta(get_the_ID(), 'services_title'); ?>
    </h2>
    <h3 class="services__subtitle">
      <?= carbon_get_post_meta(get_the_ID(), 'services_subtitle'); ?>
    </h3>
    <div class="services__items">
      <?php foreach (carbon_get_post_meta(get_the_ID(), 'services_card') as $item) { ?>
        <a class="services__item go-to" data-goto=".message" href="#message_u">
          <img class="services__item-icon" src="<?= $item['services_card-icon']; ?>" alt="service icon">
          <h4 class="services__item-title">
            <?= $item['services_card-title']; ?>
          </h4>
          <div class="services__item-btn">
            <?= $item['services_btn-text']; ?>
          </div>
        </a>
      <?php } ?>
    </div>
  </div>
</section>