<section class="hero">
	<div class="container">
		<h1 class="hero__title">
			<?= carbon_get_post_meta(get_the_ID(), 'hero__title'); ?>
		</h1>
		<div class="hero__bage">
			<?php foreach (carbon_get_post_meta(get_the_ID(), 'hero-bage') as $item) { ?>
				<div class="hero__bage-item">
					<img class="hero__bage-icon" src="<?= $item['hero-bage_icon']; ?>" alt="bage icon">
					<div class="hero__bage-text" data-tippy-content="<?= $item['hero-bage_tip']; ?>">
						<?= $item['hero-bage_text']; ?>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="hero__inner">
			<div class="hero__from-box">
				<h3 class="hero__form-title">
					<?php echo carbon_get_post_meta(get_the_ID(), 'hero-form_title'); ?>
				</h3>
				<?php get_template_part('template-parts/blocks/litle-form'); ?>
			</div>
			<div class="hero__trust">
				<img class="hero__trust-icon" src="<?php echo carbon_get_post_meta(get_the_ID(), 'hero__bg'); ?>" alt="hero background">
				<div class="hero__trust-bages">
					<?php foreach ((carbon_get_post_meta(get_the_ID(), 'hero-trust_bage')) as $key) : ?>
						<div class="hero__trust-bage">
							<span>
								<?php echo $key['hero-trust_bage_text']; ?>
							</span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="hero__payments-box">
			<div class="hero__payments-items">
				<?php foreach (carbon_get_theme_option('payments_box') as $item) { ?>
					<div class="hero__payments-item">
						<img class="hero__payments-img" src="<?= $item['payments_icons']; ?>" alt="payments images">
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>