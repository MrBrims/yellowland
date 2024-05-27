<!DOCTYPE html>
<html lang="<?php bloginfo('language'); ?>">

<head>

  <meta charset="<?php bloginfo('charset'); ?>">

  <title>
    <?= carbon_get_post_meta(get_the_ID(), 'title'); ?>
  </title>
  <meta name="description" content="<?= carbon_get_post_meta(get_the_ID(), 'description'); ?>">

  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <link rel="icon" href="<?= URI ?>/assets/images/favicon.ico">
  <style>
    .popup,
		.gift__popup,
		.gift__box-popup {
      opacity: 0;
      visibility: hidden;
    }
  </style> 
  <?php wp_head(); ?>
</head>

<body>
  <div class="wrapper">
    <header class="header lock-padding">
      <div class="header__top">
        <div class="container">
          <div class="header__top-items">
            <div class="header__time">
              <?= carbon_get_post_meta(get_the_ID(), 'header_time'); ?>
            </div>
						<div class="header__whats">
              <a class="header__whats-link" href="https://wa.me/<?= preg_replace('/[^,.0-9]/', '', carbon_get_theme_option('general_whats')); ?>">
								<?php echo carbon_get_theme_option('general_whats'); ?>
              </a>
            </div>
            <div class="header__mail">
              <a class="header__mail-link" href="mailto:<?= carbon_get_post_meta(get_the_ID(), 'header_mail'); ?>">
                <?= carbon_get_post_meta(get_the_ID(), 'header_mail'); ?>
              </a>
            </div>
            <div class="header__phone">
              <a class="header__phone-link" href="tel:<?= preg_replace('/[^,.0-9]/', '', carbon_get_post_meta(get_the_ID(), 'header_phone')); ?>">
							Anrufen
              </a>
            </div>
            <div class="header__btn">
              <a class="header__btn-link go-to" data-goto=".message" href="#message_u">
                <?= carbon_get_post_meta(get_the_ID(), 'header_btn'); ?>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="header__bottom">
        <div class="container">
          <div class="header__bottom-items">
            <div class="header__logo-box">
              <a class="header__logo-link go-to" data-goto=".hero" href="#"></a>
              <img class="header__logo-img" src="<?= carbon_get_post_meta(get_the_ID(), 'header_logo'); ?>" alt="logo">
            </div>
            <?php get_template_part('template-parts/blocks/top-menu'); ?>
          </div>
        </div>
				<div class="christmas-decor">
					
				</div>
      </div>


    </header>

    <main class="page">