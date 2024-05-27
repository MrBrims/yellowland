<?php $post_id = get_the_ID(); ?>
<form class="big-form form js-calc">
	<h2 class="big-form__title">
		Lassen Sie sich ein <span>unverbindliches Angebot</span> erstellen!
	</h2>
	<p class="big-form__subtitle">
		Das Ausfüllen des Formulars dauert max. eine Minute
	</p>
	<div class="big-form__items">
		<div class="big-form__item">
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
					Thema der Arbeit <span class="input-box__required">*</span>
					<div class="tolltip" data-tippy-content="Das ist Thema Ihrer Arbeit. Das ist sehr wichtig, Ihr Thema jetzt richtig zu schreiben">?</div>
				</span>
				<input class="input" name="theme" type="text" placeholder="Thema der Arbeit" required>
			</div>
			<div class="form__inner big-form__inner">
				<div class="input-box form__box">
					<span class="input-box__text">
						Zusätzliche Leistungen:
					</span>
					<div class="form__chek-inner">
						<label class="checkbox-label">
							<input class="custom-checkbox" type="checkbox" name="Prasentation">
							<span class="style-checkbox"></span>
							Präsentation
						</label>
						<label class="checkbox-label">
							<input class="custom-checkbox" type="checkbox" name="Verteidigung">
							<span class="style-checkbox"></span>
							Rede zur Verteidigung
						</label>
						<label class="checkbox-label">
							<input class="custom-checkbox" type="checkbox" name="Expose">
							<span class="style-checkbox"></span>
							Exposé
						</label>
						<label class="checkbox-label">
							<input class="custom-checkbox" type="checkbox" name="Zusammenfassung">
							<span class="style-checkbox"></span>
							Zusammenfassung
						</label>
						<label class="checkbox-label">
							<input class="custom-checkbox" type="checkbox" name="Dispo">
							<span class="style-checkbox"></span>
							Dispo
						</label>
					</div>
				</div>
				<div class="input-box form__box">
					<span class="input-box__text">
						Arbeitssprache:
					</span>
					<div class="form__chek-inner">
						<label class="checkbox-label">
							<input class="custom-checkbox" type="radio" name="Language" checked>
							<span class="style-checkbox"></span>
							Deutsch
						</label>
						<label class="checkbox-label">
							<input class="custom-checkbox" type="radio" name="Language">
							<span class="style-checkbox"></span>
							Englisch
						</label>
						<label class="checkbox-label">
							<input class="custom-checkbox" type="radio" name="Language">
							<span class="style-checkbox"></span>
							Französisch
						</label>
						<label class="checkbox-label">
							<input class="custom-checkbox" type="radio" name="Language">
							<span class="style-checkbox"></span>
							Spanisch
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="big-form__item">
			<div class="input-box form__box">
				<span class="input-box__text">
					Abgabetermin <span class="input-box__required">*</span>
					<div class="tolltip" data-tippy-content="Wählen Sie bitte den Abgabetermin für Ihre Arbeit aus. Es wäre besser, wenn Sie dem Autor mindestens ein paar zusätzliche Tage vor dem Abgabetermin geben, damit Sie auch Zeit für Lesen und Revisionsanfrage falls nötig haben">?</div>
				</span>
				<input class="input date-input" name="deadline" placeholder="<?php echo date('F, j'); ?>" id="date-icon" type="text" onfocus="(this.value='<?php echo date('d.m.Y'); ?>')" readonly autocomplete="off" required>
				<label class="date-img" for="date-icon"></label>
			</div>
			<div class="input-box form__box">
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
			<div class="input-box form__box">
				<span class="input-box__text">
					Vorname/Nickname <span class="input-box__required">*</span>
				</span>
				<input class="input" name="name" type="text" placeholder="Vorname/Nickname" required>
			</div>
			<div class="input-box form__box">
				<span class="input-box__text">
					Whatsapp
					<span class="input-box__required">*</span>
					<div class="tolltip" data-tippy-content="Erfahrungsgemäß lassen sich viele Fragen am besten telefonisch klären. Falls Sie einen Rückruf wünschen, geben Sie bitte hier Ihre Telefonummer an">?</div>
				</span>
				<input class="input phone-input" type="text" name="phone" required>
			</div>
			<div class="input-box form__box">
				<span class="input-box__text">
					E-Mail <span class="input-box__required">*</span>
					<div class="tolltip" data-tippy-content="Stellen Sie sicher, dass Sie richtige E-Mail-Adresse eingegeben haben">?</div>
				</span>
				<input class="input" name="email" type="email" placeholder="E-Mail" required>
			</div>
		</div>
	</div>
	<div class="form__price js-price big-form__price">ab <span>49,00 €</span></div>
	<input class="big-form__btn btn" type="submit" value="PREIS KALKULIEREN">
	<p class="big-form__text">
		Vor dem Abschicken des Formulars prüfen Sie bitte die Korrektheit Ihrer E-Mail-Adresse
	</p>
	<input type="hidden" name="form-id" value="form-big">
	<input type="hidden" name="recaptcha_response" class="recaptchaResponse">
	<input type="hidden" name="constect-index" value="<?= carbon_get_post_meta(get_the_ID(), 'index_const'); ?>">
	<input type="hidden" name="landing-address" value="<?= carbon_get_post_meta(get_the_ID(), 'adress_site'); ?>">
	<?php echo Helpers::get_utm(); ?>
</form>