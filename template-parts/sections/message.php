<section class="message section" id="message_u">
	<div class="message__wrapper container">
		<div class="hero__from-box">
			<h3 class="hero__form-title">
				<?php echo carbon_get_post_meta(get_the_ID(), 'hero-form_title'); ?>
			</h3>
			<?php get_template_part('template-parts/blocks/litle-form'); ?>
		</div>
		<img class="message__img" src="<?= carbon_get_post_meta(get_the_ID(), 'message_img'); ?>" alt="message image">
	</div>
	<div class="container">
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