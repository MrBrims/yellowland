<div class="team-slider">
  <div class="team-slider__body swiper">
    <div class="team-slider__wrapper swiper-wrapper">
      <?php foreach (carbon_get_post_meta(get_the_ID(), 'team-slider_card') as $item) { ?>
        <div class="team-slider__slide swiper-slide">
          <img class="team-slider__img swiper-lazy" src="<?= $item['team-slider__photo']; ?>">
          <h4 class="team-slider__name">
            <?= $item['team-slider__name']; ?>
          </h4>
          <p class="team-slider__position">
            <?= $item['team-slider__position']; ?>
          </p>
          <p class="team-slider__time">
            <?= $item['team-slider__time']; ?>
          </p>
          <p class="team-slider__time-text">
            <?= $item['team-slider__time-after']; ?>
          </p>
          <div class="team-slider__contact">
            <a class="team-slider__contact-item" href="https://wa.me/<?= preg_replace('/[^,.0-9]/', '', $item['team-slider__whatsapp']); ?>">
              <img src="<?= URI; ?>/assets/images/icons/team-whats.svg" alt="whatssapp icon">
            </a>
            <a class="team-slider__contact-item" href="mailto:<?= $item['team-slider__mail']; ?>">
              <img src="<?= URI; ?>/assets/images/icons/team-mail.svg" alt="mail icon">
            </a>
            <a class="team-slider__contact-item" href="tel:<?= preg_replace('/[^,.0-9]/', '', $item['team-slider__phone']); ?>">
              <img src="<?= URI; ?>/assets/images/icons/team-phone.svg" alt="phone icon">
            </a>
          </div>
          <a class="team-slider__btn btn go-to" data-goto=".message" href="#message_u">
            JETZT ANFRAGEN
          </a>
        </div>
      <?php } ?>
    </div>
    <div class="team-slider__nav"></div>
  </div>
</div>