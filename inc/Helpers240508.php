<?php

namespace DE;

class Helpers
{
	public function __construct()
	{
		add_filter('determine_current_user', [$this, 'jsonBasicAuthHandler'], 20);
		add_filter('rest_authentication_errors', [$this, 'jsonBasicAuthError']);
	}

	public function jsonBasicAuthHandler($user)
	{
		global $wp_json_basic_auth_error;
		$wp_json_basic_auth_error = null;
		if (!empty($user)) {
			return $user;
		}

		if (!isset($_SERVER['PHP_AUTH_USER'])) {
			return $user;
		}

		$username = $_SERVER['PHP_AUTH_USER'];
		$password = $_SERVER['PHP_AUTH_PW'];

		remove_filter('determine_current_user', 'json_basic_auth_handler', 20);

		$user = wp_authenticate($username, $password);

		add_filter('determine_current_user', 'json_basic_auth_handler', 20);

		if (is_wp_error($user)) {
			$wp_json_basic_auth_error = $user;
			return null;
		}

		$wp_json_basic_auth_error = true;

		return $user->ID;
	}

	public function jsonBasicAuthError($error)
	{
		if (!empty($error)) {
			return $error;
		}

		global $wp_json_basic_auth_error;
		return $wp_json_basic_auth_error;
	}

	/**
	 * Выводит домен сайта без протокола
	 * @return string
	 */
	public static function siteUri(): string
	{
		$uri = get_site_url(get_current_blog_id());
		$uri = explode('//', $uri);

		return end($uri);
	}

	/**
	 * Выводит название формы при отправлении данных, исходя из полученных данных
	 * @param string $string
	 * @return string
	 */
	public static function siteFormName($string = ''): string
	{
		if (!$string) {
			return '';
		}

		$name = '';

		if (in_array($string, ['first-form'])) {
			$name = 'Форма в шапке';
		}

		if (in_array($string, ['big-form'])) {
			$name = 'Полная форма';
		}

		return $name;
	}

	/**
	 * Выводит поле с индексом констектолога
	 */
	public static function siteContext()
	{

		$siteContext = $_POST['constect-index'];

		return $siteContext;
	}

	/**
	 * Выводит постоянную ссылку на пост
	 */
	public static function sitePermalink()
	{

		$sitePermalink = $_POST['landing-address'];

		return $sitePermalink;
	}
	

	// Функия считывания UTM
	public static function get_utm()
	{
		$out = array();
		$keys = array('utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term');
		foreach ($keys as $row) {
			if (!empty($_GET[$row])) {
				$value = strval($_GET[$row]);
				$value = stripslashes($value);
				$value = htmlspecialchars_decode($value, ENT_QUOTES);
				$value = strip_tags($value);
				$value = htmlspecialchars($value, ENT_QUOTES);
				$out[] = '<input type="hidden" name="' . $row . '" value="' . $value . '">';
			}
		}
		return implode("\r\n", $out);
	}

	public static function num_whats(): string
	{
		$day = date('N');
		$whatsArr = [
			'1' => '49(304)669-02-86',
			'2' => '49(304)669-04-49',
			'3' => '49(304)669-04-29',
			'4' => '49(304)669-04-48',
			'5' => '49(304)669-04-48',
			'6' => '49(304)669-04-49',
			'7' => '49(304)669-02-86',
		];
		return $whatsArr[$day];
	}

	public static function type_work(): string
	{
		$landId = get_the_ID();

		if ($landId == 153) {
			$typeWork = "Bachelorarbeit";
		} elseif ($landId == 149) {
			$typeWork = "Masterarbeit";
		} elseif ($landId == 133) {
			$typeWork = "Hausarbeit";
		} elseif ($landId == 8) {
			$typeWork = "Localhost";
		}

		return $typeWork;
	}
}

new Helpers();
