<div class="menu">
	<nav class="menu__body">
		<ul class="menu__list">
			<?php if (!empty(carbon_get_post_meta(get_the_ID(), 'how-work_show'))) { ?>
				<li class="menu__item">
					<a class="menu__link go-to" data-goto=".how-work" href="#how-work_u">
						So arbeiten wir
					</a>
				</li>
			<?php } ?>
			<?php if (!empty(carbon_get_post_meta(get_the_ID(), 'guarant_show'))) { ?>
				<li class="menu__item">
					<a class="menu__link go-to" data-goto=".guarant" href="#guarant_u">
						Garantien
					</a>
				</li>
			<?php } ?>
			<?php if (!empty(carbon_get_post_meta(get_the_ID(), 'reviews_show'))) { ?>
				<li class="menu__item">
					<a class="menu__link go-to" data-goto=".reviews" href="#reviews_u">
						Bewertungen
					</a>
				</li>
			<?php } ?>
			<?php if (!empty(carbon_get_post_meta(get_the_ID(), 'price_show'))) { ?>
				<li class="menu__item">
					<a class="menu__link go-to" data-goto=".price" href="#price_u">
						Preise
					</a>
				</li>
			<?php } ?>
			<?php if (!empty(carbon_get_post_meta(get_the_ID(), 'authors_show'))) { ?>
				<li class="menu__item">
					<a class="menu__link go-to" data-goto=".authors" href="#authors_u">
						Unsere Autoren
					</a>
				</li>
			<?php } ?>
			<?php if (!empty(carbon_get_post_meta(get_the_ID(), 'services_show'))) { ?>
				<li class="menu__item">
					<a class="menu__link go-to" data-goto=".services" href="#services_u">
						Leistungen
					</a>
				</li>
			<?php } ?>
			<?php if (!empty(carbon_get_post_meta(get_the_ID(), 'details_show'))) { ?>
				<li class="menu__item">
					<a class="menu__link go-to" data-goto=".details" href="#details_u">
						Details
					</a>
				</li>
			<?php } ?>
			<?php if (!empty(carbon_get_post_meta(get_the_ID(), 'offer_show'))) { ?>
				<li class="menu__item">
					<a class="menu__link go-to" data-goto=".offer" href="#offer_u">
						Optionale Dienste
					</a>
				</li>
			<?php } ?>
			<?php if (!empty(carbon_get_post_meta(get_the_ID(), 'faq_show'))) { ?>
				<li class="menu__item">
					<a class="menu__link go-to" data-goto=".faq" href="#faq_u">
						FAQ
					</a>
				</li>
			<?php } ?>

			<li class="menu__item header__time">
				<?= carbon_get_post_meta(get_the_ID(), 'header_time'); ?>
			</li>
			<li class="menu__item header__mail">
				<a class="header__mail-link" href="mailto:<?= carbon_get_post_meta(get_the_ID(), 'header_mail'); ?>">
					<?= carbon_get_post_meta(get_the_ID(), 'header_mail'); ?>
				</a>
			</li>
			<li class="menu__item header__whats">
				<a class="header__whats-link" href="https://wa.me/<?= preg_replace('/[^,.0-9]/', '', carbon_get_theme_option('general_whats')); ?>">
					<?php echo carbon_get_theme_option('general_whats'); ?>
				</a>
			</li>
			<li class="menu__item header__phone">
				<a class="header__phone-link" href="tel:<?= preg_replace('/[^,.0-9]/', '', carbon_get_post_meta(get_the_ID(), 'header_phone')); ?>">
					Anrufen
				</a>
			</li>
		</ul>
	</nav>
	<div class="menu__btn">
		<span></span>
		<span></span>
		<span></span>
	</div>
</div>
<?php if (!empty(carbon_get_theme_option(''))) : ?>
	<?php echo carbon_get_theme_option(''); ?>
<?php endif ?>