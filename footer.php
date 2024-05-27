</main>
<footer class="footer">
	<div class="footer__top">
		<div class="container">
			<div class="footer__items">
				<div class="footer__item">
					<div class="footer__logo-box">
						<img class="footer__logo-img" src="<?= carbon_get_post_meta(get_the_ID(), 'footer_logo'); ?>" alt="footer logotype">
						<a class="footer__logo-link go-to" data-goto=".hero" href="#"></a>
					</div>
					<div class="footer__text">
						<p>Wir arbeiten in 5 Ländern: Deutschland, USA, Frankreich, Italien und Spanien.</p>
					</div>
					<div class="footer__lang-box">
						<img class="footer__lang-img" src="<?= URI; ?>/assets/images/lang/lang-1.jpg" alt="flag">
						<img class="footer__lang-img" src="<?= URI; ?>/assets/images/lang/lang-6.jpg" alt="flag">
						<!-- <img class="footer__lang-img" src="<?= URI; ?>/assets/images/lang/lang-2.jpg" alt="flag"> -->
						<img class="footer__lang-img" src="<?= URI; ?>/assets/images/lang/lang-3.jpg" alt="flag">
						<img class="footer__lang-img" src="<?= URI; ?>/assets/images/lang/lang-5.jpg" alt="flag">
						<img class="footer__lang-img" src="<?= URI; ?>/assets/images/lang/lang-4.jpg" alt="flag">
					</div>
					<div class="footer__text">
						<?= apply_filters('the_content', carbon_get_post_meta(get_the_ID(), 'footer_text')); ?>
					</div>
					<h4 class="footer__title">
						Social media:
					</h4>
					<div class="footer__soc-box">
						<?php foreach (carbon_get_post_meta(get_the_ID(), 'footer_soc') as $item) { ?>
							<a class="footer__soc-link" href="<?= $item['footer_link-soc']; ?>">
								<img class="footer__soc-img" src="<?= $item['footer_icon-soc']; ?>" alt="social icon">
							</a>
						<?php } ?>
					</div>
				</div>
				<div class="footer__item">
					<h4 class="footer__title">
						Mit uns verbinden:
					</h4>
					<div class="footer__contact">
						<a class="footer__phone" href="tel:<?= preg_replace('/[^,.0-9]/', '', carbon_get_post_meta(get_the_ID(), 'header_phone')); ?>">
							<?= carbon_get_post_meta(get_the_ID(), 'header_phone'); ?>
						</a>
						<a class="footer__btn go-to" data-goto=".message" href="#message_u">
							Um Rückruf bitten
						</a>
					</div>
					<a class="footer__mail" href="mailto:<?= carbon_get_post_meta(get_the_ID(), 'header_mail'); ?>">
						<?= carbon_get_post_meta(get_the_ID(), 'header_mail'); ?>
					</a>
					<p class="footer__adress">
						<?= carbon_get_post_meta(get_the_ID(), 'footer_adress'); ?>
					</p>
					<h4 class="footer__title">
						Unsere Bürozeiten:
					</h4>
					<div class="footer__time">
						<?= carbon_get_post_meta(get_the_ID(), 'header_time'); ?>
					</div>
				</div>
				<div class="footer__item">
					<h4 class="footer__title footer__title-plag">
						PLAGIATSSOFTWARE
					</h4>
					<div class="footer__plag-inner">
						<div class="footer__plag-box">
							<img class="footer__plag-img" src="<?= URI; ?>/assets/images/icons/plag.png" alt="palg">
						</div>
						<div class="footer__plag-box">
							<img class="footer__plag-img" src="<?= URI; ?>/assets/images/icons/turnitin.png" alt="palg">
						</div>
						<div class="footer__plag-box">
							<img class="footer__plag-img" src="<?= URI; ?>/assets/images/icons/unicheck.png" alt="palg">
						</div>
					</div>
					<h4 class="footer__title footer__title-rev">
						Bewertungen
					</h4>
					<div class="footer__rev-inner">
						<a class="footer__rev-box" href="https://g.page/r/CdJfZ9AsoxPEEAI/review" target="_blank">
							<img class="footer__rev-img" src="<?= URI; ?>/assets/images/icons/google.svg" alt="reviews">
							<div class="rev-rating">
								<?php
								$rating = floatval(carbon_get_theme_option('rating-google')) * 2;
								$star = intdiv($rating, 2);
								for ($i = 0; $i < $star; $i++) {
									echo '<span class="rev-rating__star rev-rating__star-fill"></span>';
								}
								if ($rating % 2 != 0) {
									echo '<span class="rev-rating__star rev-rating__star-half"></span>';
								}
								echo '<span class="rev-rating__num">' . $rating / 2 . ' / 5</span>';
								?>
							</div>
						</a>
						<a class="footer__rev-box" href="https://www.provenexpert.com/ug-gwc/" target="_blank">
							<img class="footer__rev-img" src="<?= URI; ?>/assets/images/icons/provenexpert-logo.svg" alt="reviews">
							<div class="rev-rating">
								<?php
								$rating = floatval(carbon_get_theme_option('rating-praven')) * 2;
								$star = intdiv($rating, 2);
								for ($i = 0; $i < $star; $i++) {
									echo '<span class="rev-rating__star rev-rating__star-fill"></span>';
								}
								if ($rating % 2 != 0) {
									echo '<span class="rev-rating__star rev-rating__star-half"></span>';
								}
								echo '<span class="rev-rating__num">' . $rating / 2 . ' / 5</span>';
								?>
							</div>
						</a>
						<a class="footer__rev-box" href="https://www.trustami.com/erfahrung/ug-gwc-de-bewertung" target="_blank">
							<img class="footer__rev-img" src="<?= URI; ?>/assets/images/icons/bewer-3.jpg" alt="reviews">
							<div class="rev-rating">
								<?php
								$rating = floatval(carbon_get_theme_option('rating-trustami')) * 2;
								$star = intdiv($rating, 2);
								for ($i = 0; $i < $star; $i++) {
									echo '<span class="rev-rating__star rev-rating__star-fill"></span>';
								}
								if ($rating % 2 != 0) {
									echo '<span class="rev-rating__star rev-rating__star-half"></span>';
								}
								echo '<span class="rev-rating__num">' . $rating / 2 . ' / 5</span>';
								?>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer__bottom">
		<div class="container">
			<?= carbon_get_post_meta(get_the_ID(), 'footer_copy'); ?>
		</div>
	</div>
</footer>
</div>
<div class="floating-btn floating-top lock-padding">
	<a class="floating-btn__top go-to" data-goto=".hero" href="#">
		<svg width="10" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M5 0 .67 7.5h8.66L5 0Zm.75 16V6.75h-1.5V16h1.5Z" fill="#151116" />
		</svg>
	</a>
</div>
<a class="whatsapp-btn" target="_blank" href="https://wa.me/<?php echo preg_replace('/[^,.0-9]/', '', Helpers::num_whats()); ?>">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
		<path d="M7.25361 18.4944L7.97834 18.917C9.18909 19.623 10.5651 20 12.001 20C16.4193 20 20.001 16.4183 20.001 12C20.001 7.58172 16.4193 4 12.001 4C7.5827 4 4.00098 7.58172 4.00098 12C4.00098 13.4363 4.37821 14.8128 5.08466 16.0238L5.50704 16.7478L4.85355 19.1494L7.25361 18.4944ZM2.00516 22L3.35712 17.0315C2.49494 15.5536 2.00098 13.8345 2.00098 12C2.00098 6.47715 6.47813 2 12.001 2C17.5238 2 22.001 6.47715 22.001 12C22.001 17.5228 17.5238 22 12.001 22C10.1671 22 8.44851 21.5064 6.97086 20.6447L2.00516 22ZM8.39232 7.30833C8.5262 7.29892 8.66053 7.29748 8.79459 7.30402C8.84875 7.30758 8.90265 7.31384 8.95659 7.32007C9.11585 7.33846 9.29098 7.43545 9.34986 7.56894C9.64818 8.24536 9.93764 8.92565 10.2182 9.60963C10.2801 9.76062 10.2428 9.95633 10.125 10.1457C10.0652 10.2428 9.97128 10.379 9.86248 10.5183C9.74939 10.663 9.50599 10.9291 9.50599 10.9291C9.50599 10.9291 9.40738 11.0473 9.44455 11.1944C9.45903 11.25 9.50521 11.331 9.54708 11.3991C9.57027 11.4368 9.5918 11.4705 9.60577 11.4938C9.86169 11.9211 10.2057 12.3543 10.6259 12.7616C10.7463 12.8783 10.8631 12.9974 10.9887 13.108C11.457 13.5209 11.9868 13.8583 12.559 14.1082L12.5641 14.1105C12.6486 14.1469 12.692 14.1668 12.8157 14.2193C12.8781 14.2457 12.9419 14.2685 13.0074 14.2858C13.0311 14.292 13.0554 14.2955 13.0798 14.2972C13.2415 14.3069 13.335 14.2032 13.3749 14.1555C14.0984 13.279 14.1646 13.2218 14.1696 13.2222V13.2238C14.2647 13.1236 14.4142 13.0888 14.5476 13.097C14.6085 13.1007 14.6691 13.1124 14.7245 13.1377C15.2563 13.3803 16.1258 13.7587 16.1258 13.7587L16.7073 14.0201C16.8047 14.0671 16.8936 14.1778 16.8979 14.2854C16.9005 14.3523 16.9077 14.4603 16.8838 14.6579C16.8525 14.9166 16.7738 15.2281 16.6956 15.3913C16.6406 15.5058 16.5694 15.6074 16.4866 15.6934C16.3743 15.81 16.2909 15.8808 16.1559 15.9814C16.0737 16.0426 16.0311 16.0714 16.0311 16.0714C15.8922 16.159 15.8139 16.2028 15.6484 16.2909C15.391 16.428 15.1066 16.5068 14.8153 16.5218C14.6296 16.5313 14.4444 16.5447 14.2589 16.5347C14.2507 16.5342 13.6907 16.4482 13.6907 16.4482C12.2688 16.0742 10.9538 15.3736 9.85034 14.402C9.62473 14.2034 9.4155 13.9885 9.20194 13.7759C8.31288 12.8908 7.63982 11.9364 7.23169 11.0336C7.03043 10.5884 6.90299 10.1116 6.90098 9.62098C6.89729 9.01405 7.09599 8.4232 7.46569 7.94186C7.53857 7.84697 7.60774 7.74855 7.72709 7.63586C7.85348 7.51651 7.93392 7.45244 8.02057 7.40811C8.13607 7.34902 8.26293 7.31742 8.39232 7.30833Z" fill="rgba(255,255,255,1)"></path>
	</svg>
	<span>
		Chatte mit uns über Whatsapp
	</span>
</a>
<?php wp_footer(); ?>


<!-- Default Statcounter code for
https://u.ug-gwc.de/bachelorarbe
https://u.ug-gwc.de/bachelorarbeit/ -->
<script type="text/javascript">
	var sc_project = 12909133;
	var sc_invisible = 1;
	var sc_security = "87c4d3cf";
</script>
<script type="text/javascript" src="https://www.statcounter.com/counter/counter.js" async></script>
<noscript>
	<div class="statcounter"><a title="free hit
counter" href="https://statcounter.com/" target="_blank"><img class="statcounter" src="https://c.statcounter.com/12909133/0/87c4d3cf/1/" alt="free hit counter" referrerPolicy="no-referrer-when-downgrade"></a></div>
</noscript>
<!-- End of Statcounter Code -->

<?php if (!empty(carbon_get_post_meta(get_the_ID(), 'yel_land_gift_img'))) : ?>
	<div class="gift">
		<div class="gift__popup" style="background-image:url('<?php echo carbon_get_post_meta(get_the_ID(), 'yel_land_gift_img'); ?>')">
			<button class="gift__popup-close">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<g clip-path="url(#clip0_786_363)">
						<rect x="2.40021" y="-4.57764e-05" width="30.547" height="3.39411" transform="rotate(45 2.40021 -4.57764e-05)" fill="#5ABEBE" />
						<rect x="6.10352e-05" y="21.6001" width="30.547" height="3.39411" transform="rotate(-45 6.10352e-05 21.6001)" fill="#5ABEBE" />
					</g>
					<defs>
						<clipPath id="clip0_786_363">
							<rect width="24" height="24" fill="white" />
						</clipPath>
					</defs>
				</svg>
			</button>
			<a class="gift__popup-btn go-to" data-goto=".message" href="#message_u"></a>
		</div>
		<div class="gift__box">
			<div class="gift__box-icons gift__animation">
				<div class="gift__box-popup" style="background-image:url('<?php echo carbon_get_post_meta(get_the_ID(), 'yel_land_gift_img'); ?>')">
					<a class="gift__mobile-btn go-to" data-goto=".message" href="#message_u"></a>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
</body>

</html>