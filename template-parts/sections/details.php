<section class="section details" id="details_u">
  <div class="container">
    <h2 class="details__title">
      <?= carbon_get_post_meta(get_the_ID(), 'details_title'); ?>
    </h2>
    <div class="details__wrapper">
      <div class="details__inner">
        <div class="details__text">
          <?= apply_filters('the_content', carbon_get_post_meta(get_the_ID(), 'details_text')); ?>
        </div>
      </div>
      <div class="details__team">
        <?php get_template_part('template-parts/blocks/team-slider'); ?>
      </div>
    </div>

  </div>
</section>