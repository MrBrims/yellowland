<section class="offer section" id="offer_u">
  <div class="container">
    <h2 class="offer__title">
      <?= carbon_get_post_meta(get_the_ID(), 'offer_title'); ?>
    </h2>
    <div class="offer__items">
      <?php foreach (carbon_get_post_meta(get_the_ID(), 'offer_card') as $item) { ?>
        <a class="offer__item go-to" data-goto=".message" href="#message_u">
          <div class="offer__item-head">
            <img class="offer__item-img" src="<?= $item['offer_card-img']; ?>" alt="offer images">
            <div class="offer__item-text">
              <?= $item['offer_card-text']; ?>
            </div>
          </div>
          <div class="offer__item-title">
            <?= $item['offer_card-title']; ?>
          </div>
        </a>
      <?php } ?>
    </div>
  </div>
</section>