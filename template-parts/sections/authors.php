<section class="authors" id="authors_u">
  <div class="container">
    <h2 class="authors__title">
      <?= carbon_get_post_meta(get_the_ID(), 'authors_title'); ?>
    </h2>
    <div class="authors__inner">
      <img class="authors__img" src="<?= carbon_get_post_meta(get_the_ID(), 'authors_img'); ?>" alt="author img">
      <div class="authors__content">
        <h4 class="authors__content-title">
          <?= carbon_get_post_meta(get_the_ID(), 'authors_content-title'); ?>
        </h4>
        <div class="authors__content-text">
          <?= apply_filters('the_content', carbon_get_post_meta(get_the_ID(), 'authors_content-text')); ?>
        </div>
        <div class="authors__bage-box">
          <?php foreach (carbon_get_post_meta(get_the_ID(), 'authors_bage') as $item) { ?>
            <div class="authors__bage">
              <div class="authors__bage-head">
                <img class="authors__bage-icon" src="<?= $item['authors_bage-icon']; ?>" alt="bage icon">
                <span class="authors__bage-num">
                  <?= $item['authors_bage-num']; ?>
                </span>
              </div>
              <span class="authors__bage-title">
                <?= $item['authors_bage-title']; ?>
              </span>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>