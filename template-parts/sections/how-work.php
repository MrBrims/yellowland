<section class="section how-work" id="how-work_u">
	<div class="container">
		<h2 class="how-work__title">
			<?= carbon_get_post_meta(get_the_ID(), 'how-work_title'); ?>
		</h2>
		<div class="how-work__items">
			<?php foreach (carbon_get_post_meta(get_the_ID(), 'how-work_card') as $item) { ?>
				<div class="how-work__item">
					<div class="how-work__icon-box">
						<img class="how-work__item-icon" src="<?= $item['how-work_card-icon']; ?>" alt="how work icon">
					</div>
					<div class="how-work__text-box">
						<h4 class="how-work__item-title">
							<?= $item['how-work_card-title']; ?>
						</h4>
						<p class="how-work__item-text">
							<?= $item['how-work_card-text']; ?>
						</p>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>