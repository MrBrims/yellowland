<section class="faq" id="faq_u">
  <div class="container">
    <h2 class="faq__title">
      <?= carbon_get_post_meta(get_the_ID(), 'faq_title'); ?>
    </h2>
    <div class="accordion">
      <?php foreach (carbon_get_post_meta(get_the_ID(), 'faq_box') as $item) { ?>
        <div class="accordion__item">
          <div class="accordion__head">
            <div class="accordion__icon">
              <span></span>
              <span></span>
            </div>
            <?= $item['faq_box-head']; ?>
          </div>
          <div class="accordion__content">
            <?= apply_filters('the_content', $item['faq_box-content']); ?>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>