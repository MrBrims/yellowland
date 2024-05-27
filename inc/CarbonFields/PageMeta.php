<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

class PageMeta
{
	public function __construct()
	{
		add_action('carbon_fields_register_fields', [$this, 'customFields']);
	}

	public function customFields()
	{
		Container::make('post_meta', 'carbon_fields_container_global', 'Настройки лендинга')
			->set_context('carbon_fields_after_title')
			->where('post_template', '=', 'landings/generic.php')
			->add_tab('Сео и контекст', [
				Field::make('text', 'title', 'Заголовок')
					->set_width(50),
				Field::make('text', 'description', 'Описание')
					->set_width(50),
				Field::make('text', 'index_const', 'Индекс констектолога для формы')
					->set_width(50),
				Field::make('text', 'adress_site', 'Адрес сайта для формы')
					->set_width(50),
			])
			->add_tab('Шапка', [
				Field::make('text', 'header_time', 'Время работы')
					->set_width(25),
				Field::make('text', 'header_mail', 'Почта')
					->set_width(25),
				Field::make('text', 'header_phone', 'Телефон')
					->set_width(25),
				Field::make('text', 'header_btn', 'Текст кнопки')
					->set_width(25),
				Field::make('file', 'header_logo', 'Логотип')
					->set_type(['image'])
					->set_value_type('url'),
			])
			->add_tab('Главный экран', [
				Field::make('text', 'hero__title', 'Заголовок')
					->set_width(70),
				Field::make('file', 'hero__bg', 'Фон')
					->set_type(['image'])
					->set_value_type('url')
					->set_width(30),
				Field::make('complex', 'hero-bage', 'Карточки')
					->set_layout('tabbed-horizontal')
					->setup_labels(['singular_name' => 'карточку'])
					->add_fields([
						Field::make('file', 'hero-bage_icon', 'Иконка')
							->set_type(['image'])
							->set_value_type('url')
							->set_width(20),
						Field::make('text', 'hero-bage_text', 'Текст на карточке')
							->set_width(40),
						Field::make('text', 'hero-bage_tip', 'Подсказка')
							->set_width(40),
					]),
				Field::make('text', 'hero-form_title', __('Заголовок в форме')),
				Field::make('complex', 'hero-trust_bage', 'Траст бейджи')
					->set_layout('tabbed-horizontal')
					->setup_labels(['singular_name' => 'бейдж'])
					->add_fields([
						Field::make('text', 'hero-trust_bage_text', 'Текст на бейдже'),
					]),
				Field::make('text', 'form_arbeit', 'Вид работы в форме'),
			])
			->add_tab('Команда', [
				Field::make('complex', 'team-slider_card', 'Слайдер команды')
					->setup_labels(['singular_name' => 'члена команды'])
					->add_fields([
						Field::make('file', 'team-slider__photo', 'Фото')
							->set_type(['image'])
							->set_value_type('url')
							->set_width(20),
						Field::make('text', 'team-slider__name', 'Имя')
							->set_width(20),
						Field::make('text', 'team-slider__position', 'Должность')
							->set_width(20),
						Field::make('text', 'team-slider__time', 'Время работы')
							->set_width(20),
						Field::make('text', 'team-slider__time-after', 'Текст в скобках')
							->set_width(20),
						Field::make('text', 'team-slider__whatsapp', 'Номер WhatsApp')
							->set_width(30),
						Field::make('text', 'team-slider__mail', 'Почта')
							->set_width(30),
						Field::make('text', 'team-slider__phone', 'Телефон')
							->set_width(30),
					]),
			])
			->add_tab('Детали', [
				Field::make('checkbox', 'details_show', 'Показывать раздел?'),
				Field::make('text', 'details_title', 'Заголовок'),
				Field::make('rich_text', 'details_text', 'Текст'),
			])
			->add_tab('Гарантии', [
				Field::make('checkbox', 'guarant_show', 'Показывать раздел'),
				Field::make('text', 'guarant_title', 'Заголовок'),
				Field::make('complex', 'guarant-card', 'Карточки')
					->setup_labels(['singular_name' => 'карточку'])
					->add_fields([
						Field::make('text', 'guarant-card__title', 'Заголовок карточки')
							->set_width(80),
						Field::make('file', 'guarant-card__icon', 'Иконка карточки')
							->set_type(['image'])
							->set_value_type('url')
							->set_width(20),
						Field::make('textarea', 'guarant-card__text', 'Текст карточки')
							->set_rows(3),
					]),
			])
			->add_tab('Как мы работаем', [
				Field::make('checkbox', 'how-work_show', 'Показывать раздел'),
				Field::make('text', 'how-work_title', 'Заголовок'),
				Field::make('complex', 'how-work_card', 'Пункты')
					->setup_labels(['singular_name' => 'пункт'])
					->add_fields([
						Field::make('text', 'how-work_card-title', 'Заголовок пункта')
							->set_width(80),
						Field::make('file', 'how-work_card-icon', 'Иконка пункта')
							->set_type(['image'])
							->set_value_type('url')
							->set_width(20),
						Field::make('textarea', 'how-work_card-text', 'Текст пункта')
							->set_rows(3),
					]),
			])
			->add_tab('Услуги', [
				Field::make('checkbox', 'services_show', 'Показывать раздел'),
				Field::make('text', 'services_title', 'Заголовок'),
				Field::make('text', 'services_subtitle', 'Заголовок'),
				Field::make('complex', 'services_card', 'Карточки')
					->setup_labels(['singular_name' => 'карточку'])
					->add_fields([
						Field::make('text', 'services_card-title', 'Заголовок карточки')
							->set_width(60),
						Field::make('file', 'services_card-icon', 'Иконка карточки')
							->set_type(['image'])
							->set_value_type('url')
							->set_width(20),
						Field::make('text', 'services_btn-text', 'Текст на кнопке')
							->set_width(20),
					]),
			])
			->add_tab('Дополнительные услгуи', [
				Field::make('checkbox', 'additional_show', 'Показывать раздел'),
				Field::make('complex', 'additional_card', 'Карточки')
					->setup_labels(['singular_name' => 'карточку'])
					->add_fields([
						Field::make('text', 'additional_card-title', 'Заголовок карточки')
							->set_width(70),
						Field::make('file', 'additional_card-icon', 'Иконка карточки')
							->set_type(['image'])
							->set_value_type('url')
							->set_width(30),
						Field::make('rich_text', 'additional_card-list', 'Список в карточке'),
					]),
				Field::make('text', 'additional_title', 'Заголовок'),
				Field::make('text', 'additional_subtitle', 'Подзаголовок'),
				Field::make('text', 'additional_btn-text', 'Текст на кнопке'),
			])
			->add_tab('Авторы', [
				Field::make('checkbox', 'authors_show', 'Показывать раздел'),
				Field::make('text', 'authors_title', 'Заголовок'),
				Field::make('file', 'authors_img', 'Изображение слева')
					->set_type(['image'])
					->set_value_type('url'),
				Field::make('textarea', 'authors_content-title', 'Заголовок описания')
					->set_width(30)
					->set_rows(3),
				Field::make('rich_text', 'authors_content-text', 'Описание')
					->set_width(70),
				Field::make('complex', 'authors_bage', 'Карточки')
					->setup_labels(['singular_name' => 'карточку'])
					->add_fields([
						Field::make('text', 'authors_bage-num', 'Цифры на карточке')
							->set_width(60),
						Field::make('file', 'authors_bage-icon', 'Иконка карточки')
							->set_type(['image'])
							->set_value_type('url')
							->set_width(20),
						Field::make('text', 'authors_bage-title', 'Заголовок карточки')
							->set_width(20),
					]),
			])
			->add_tab('Связь', [
				Field::make('checkbox', 'message_show', 'Показывать раздел'),
				Field::make('file', 'message_img', 'Картинка справа')
					->set_type(['image'])
					->set_value_type('url'),
			])
			->add_tab('Офферы', [
				Field::make('checkbox', 'offer_show', 'Показывать раздел'),
				Field::make('text', 'offer_title', 'Заголовок'),
				Field::make('complex', 'offer_card', 'Карточки')
					->setup_labels(['singular_name' => 'карточку'])
					->add_fields([
						Field::make('textarea', 'offer_card-text', 'Текст при наведении')
							->set_rows(3)
							->set_width(60),
						Field::make('file', 'offer_card-img', 'Картинка карточки')
							->set_type(['image'])
							->set_value_type('url')
							->set_width(20),
						Field::make('text', 'offer_card-title', 'Заголовок карточки')
							->set_width(20),
					]),
			])
			->add_tab('Прайс', [
				Field::make('checkbox', 'price_show', 'Показывать раздел'),
				Field::make('text', 'price_title', 'Заголовок'),
				Field::make('complex', 'price_card', 'Карточки')
					->setup_labels(['singular_name' => 'карточку'])
					->add_fields([
						Field::make('text', 'price_card-title', 'Заголовок карточки')
							->set_width(30),
						Field::make('textarea', 'price_card-text', 'Текст карточки')
							->set_rows(3)
							->set_width(70),
						Field::make('text', 'price_card-pref', 'Текст перед ценой')
							->set_width(25),
						Field::make('text', 'price_card-num', 'Цена')
							->set_width(25),
						Field::make('text', 'price_card-suf', 'Текст после цены')
							->set_width(25),
						Field::make('text', 'price_card-btn', 'Текст на кнопке')
							->set_width(25),
					]),
				Field::make('text', 'price_list-title', 'Заголовок перед списком'),
				Field::make('rich_text', 'price_list-text', 'Список'),
			])
			->add_tab('FAQ', [
				Field::make('checkbox', 'faq_show', 'Показывать раздел'),
				Field::make('text', 'faq_title', 'Заголовок'),
				Field::make('complex', 'faq_box', 'Вопросы')
					->setup_labels(['singular_name' => 'добавить FAQ'])
					->add_fields([
						Field::make('textarea', 'faq_box-head', 'Вопрос')
							->set_width(30)
							->set_rows(5),
						Field::make('rich_text', 'faq_box-content', 'Ответ')
							->set_width(70),
					]),
			])
			->add_tab('Отзывы', [
				Field::make('checkbox', 'reviews_show', 'Показывать раздел'),
				Field::make('text', 'reviews_title', 'Заголовок'),
				Field::make('complex', 'reviews_box', 'Слайдер отзывов')
					->setup_labels(['singular_name' => 'добавить отзыв'])
					->add_fields([
						Field::make('file', 'reviews_box-img', 'Картинка отзыва')
							->set_type(['image'])
							->set_value_type('url'),
					]),
			])
			->add_tab('Оплата', [
				Field::make('checkbox', 'payments_show', 'Показывать раздел'),
				Field::make('text', 'payments_title', 'Заголовок'),
				Field::make('rich_text', 'payments_text', 'Текст'),
			])
			->add_tab('Подвал', [
				Field::make('file', 'footer_logo', 'Логотип в подвале')
					->set_type(['image'])
					->set_value_type('url')
					->set_width(30),
				Field::make('rich_text', 'footer_text', 'Текст под логотипом')
					->set_width(70),
				Field::make('complex', 'footer_soc', 'Социальные сети')
					->setup_labels(['singular_name' => 'добавить соц. сеть'])
					->add_fields([
						Field::make('file', 'footer_icon-soc', 'Иконка')
							->set_type(['image'])
							->set_value_type('url')
							->set_width(30),
						Field::make('text', 'footer_link-soc', 'Ссылка')
							->set_width(70),
					]),
				Field::make('text', 'footer_adress', 'Адресс'),
				Field::make('text', 'footer_copy', 'Текст в нижней части'),
			])
			->add_tab('Акции', [
				Field::make('image', 'yel_land_gift_img', __('Картинка акции'))
					->set_type('image')
					->set_value_type('url'),
			]);
	}
}

new PageMeta();
