<section class="section guarant" id="guarant_u">
	<div class="container">
		<h2 class="guarant__title">
			<?= carbon_get_post_meta(get_the_ID(), 'guarant_title'); ?>
		</h2>
		<div class="guarant__items">
			<?php foreach (carbon_get_post_meta(get_the_ID(), 'guarant-card') as $item) { ?>
				<div class="guarant__item">
					<div class="guarant__item-head">
						<h4 class="guarant__item-title">
							<?= $item['guarant-card__title']; ?>
						</h4>
						<div class="guarant__item-box">
							<img class="guarant__item-icon" src="<?= $item['guarant-card__icon']; ?>" alt="guarant icon">
						</div>
					</div>
					<?= $item['guarant-card__text']; ?>
				</div>
			<?php } ?>
			<?php if (get_the_id() == 8 || get_the_id() == 123 || get_the_id() == 133 || get_the_id() == 127 || get_the_id() == 115) : ?>
				<div class="guarant__item guarant__form-box">
					<?php get_template_part('template-parts/blocks/callback-wrap');
					?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>