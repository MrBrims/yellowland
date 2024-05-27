<?php $post_id = get_the_ID(); ?>
<form class="form litle-form js-calc">
	<div class="litle-form__items">
		<div class="litle-form__item">
			<div class="input-box form__box">
				<span class="input-box__text">
					Art der Arbeit <span class="input-box__required">*</span>
				</span>
				<input class="input" name="type" type="text" value="<?= carbon_get_post_meta(get_the_ID(), 'form_arbeit'); ?>" required readonly>
			</div>
			<div class="input-box form__box">
				<span class="input-box__text">
					Fach <span class="input-box__required">*</span>
					<div class="tolltip" data-tippy-content="Wählen Sie bitte die Fachrichtung Ihrer Arbeit aus. Wenn keine Fachrichtung passend ist, wählen Sie „Andere Fachrichtung” Je mehrere Informationen Sie eingeben, desto besser">?</div>
				</span>
				<?php get_template_part('template-parts/blocks/fach-select'); ?>
			</div>
			<div class="input-box form__box">
				<span class="input-box__text">
					Thema der Arbeit
					<div class="tolltip" data-tippy-content="Das ist Thema Ihrer Arbeit. Das ist sehr wichtig, Ihr Thema jetzt richtig zu schreiben">?</div>
				</span>
				<textarea class="input input-textarea" name="theme" type="text" placeholder="Wenn Sie noch kein Thema haben, geben Sie -"></textarea>
			</div>
			<div class="litle-form__inner">
				<div class="input-box form__box form__date-box">
					<span class="input-box__text">
						Abgabetermin <span class="input-box__required">*</span>
						<div class="tolltip" data-tippy-content="Wählen Sie bitte den Abgabetermin für Ihre Arbeit aus. Es wäre besser, wenn Sie dem Autor mindestens ein paar zusätzliche Tage vor dem Abgabetermin geben, damit Sie auch Zeit für Lesen und Revisionsanfrage falls nötig haben">?</div>
					</span>
					<input class="input date-input" name="deadline" id="date-input" placeholder="<?php echo date('F, j'); ?>" type="text" autocomplete="off" onfocus="(this.value='<?php echo date('d.m.Y'); ?>')" readonly required>
					<label class="date-img" for="date-input"></label>
				</div>
				<div class="input-box form__box litle-form__count">
					<span class="input-box__text">
						Seitenanzahl
					</span>
					<div class="form-counter">
						<div data-id="decrement" class="counter-btn">-</div>
						<input class="count-input" name="number" type="number" value="5" max="1000" min="0" step="1" />
						<div data-id="increment" class="counter-btn">+</div>
						<span class="count-text">Seiten</span>
					</div>
				</div>
			</div>
		</div>
		<div class="litle-form__item">
			<div class="input-box form__box">
				<span class="input-box__text">
					Vorname/Nickname <span class="input-box__required">*</span>
				</span>
				<input class="input" name="name" type="text" placeholder="Vorname/Nickname" required>
			</div>
			<div class="input-box form__box">
				<span class="input-box__text">
					WhatsApp
					<span class="input-box__required">*</span>
					<div class="tolltip" data-tippy-content="Erfahrungsgemäß lassen sich viele Fragen am besten telefonisch klären. Falls Sie einen Rückruf wünschen, geben Sie bitte hier Ihre Telefonummer an">?</div>
				</span>
				<label class="label-phone">
					<input class="input phone-input" placeholder="WhatsApp" type="tel" name="phone" required>
				</label>
			</div>
			<label class="litle-form__check-inner">
				<input class="custom-checkbox" type="checkbox" name="on-wapp">
				<span class="style-checkbox"></span>
				<span class="litle-form__check-text">Kontakt nur über WhatsApp</span>
			</label>
			<div class="input-box form__box">
				<span class="input-box__text">
					E-Mail <span class="input-box__required">*</span>
					<div class="tolltip" data-tippy-content="Stellen Sie sicher, dass Sie richtige E-Mail-Adresse eingegeben haben">?</div>
				</span>
				<input class="input" name="email" type="email" placeholder="E-Mail" required>
			</div>
			<!-- <div class="input-box form__box">
				<div class="form__price js-price">ab <span>49,00 €</span></div>
				<p class="litle-form__price-text">
					* Der Preis hängt von der Fachrichtung und der Anzahl der Seiten ab. Rabatte werden separat berechnet. Erhalten Sie ein Angebot.
					<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M3 10L5.88675 5L0.113249 5L3 10ZM2.5 2.18557e-08L2.5 5.5L3.5 5.5L3.5 -2.18557e-08L2.5 2.18557e-08Z" fill="#FF522F" style="fill:#FF522F;fill:color(display-p3 1.0000 0.3216 0.1843);fill-opacity:1;" />
					</svg>
				</p>
			</div> -->
		</div>
	</div>
	<div class="litle-form__footer">
		<p class="litle-form__text">
		<strong>Ihre Anfrage ist unverbindlich und Ihre persönlichen Daten werden streng vertraulich behandelt.</strong> Vor dem Abschicken des Formulars überprüfen Sie bitte Ihre E-Mail Adresse und Telefonnummer.
		</p>
		<div class="input-box form__box litle-form__btn-box">
			<input class="litle-form__btn btn" type="submit" value="ANFRAGE">
			<input type="hidden" name="form-id" value="form-first">
			<input type="hidden" name="recaptcha_response" class="recaptchaResponse">
			<input type="hidden" name="constect-index" value="<?= carbon_get_post_meta(get_the_ID(), 'index_const'); ?>">
			<input type="hidden" name="landing-address" value="<?= carbon_get_post_meta(get_the_ID(), 'adress_site'); ?>">
			<?php echo Helpers::get_utm(); ?>
		</div>
	</div>
</form>