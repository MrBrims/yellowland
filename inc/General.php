<?php
class General
{
  public function __construct()
  {
    // Удаляем из Wordpress ненужные элементы
    // remove_action('wp_head', 'print_emoji_detection_script', 7);
    // remove_action('wp_head', 'rest_output_link_wp_head', 10);
    // remove_action('wp_head', 'wp_resource_hints', 2);
    // remove_action('wp_head', 'wp_generator');
    // remove_action('wp_head', 'wlwmanifest_link');
    // remove_action('wp_head', 'rsd_link');
    // remove_action('wp_head', 'wp_oembed_add_discovery_links');
    // remove_action('wp_head', 'wp_oembed_add_host_js');
    // remove_action('wp_print_styles', 'print_emoji_styles');
    // remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
    // remove_action('template_redirect', 'rest_output_link_header', 11);
    // remove_action('auth_cookie_malformed', 'rest_cookie_collect_status');
    // remove_action('auth_cookie_expired', 'rest_cookie_collect_status');
    // remove_action('auth_cookie_bad_username', 'rest_cookie_collect_status');
    // remove_action('auth_cookie_bad_hash', 'rest_cookie_collect_status');
    // remove_action('auth_cookie_valid', 'rest_cookie_collect_status');
    // remove_filter('rest_authentication_errors', 'rest_cookie_check_errors', 100);
    // remove_action('init', 'rest_api_init');
    // remove_action('rest_api_init', 'rest_api_default_filters', 10);
    // remove_action('parse_request', 'rest_api_loaded');

    // Удаление отступа от админ панельки WP
    add_theme_support('admin-bar', array('callback' => '__return_false'));

    // Подключение скриптов и стилей
    add_action('wp_enqueue_scripts', [$this, 'connectedStylesAndScripts']);

    // Загрузка svg
    add_filter('upload_mimes', [$this, 'svgUploadAllow']);
    add_filter('wp_check_filetype_and_ext', [$this, 'fix_svg_mime_type'], 10, 5);
    add_filter( 'xmlrpc_enabled', '__return_false' );
    // Создание robot.txt (не понятно как работает)
    // add_action('do_robotstxt', [$this, 'addedRobotsTxt']);

    // Переменные кук
    // add_action('wp_enqueue_scripts', [$this, 'addVarCooke']);

    // Меняет название пунктов меню
    add_action('init', [$this, 'wd_admin_update_objects']);
		// add_action('init', [$this, 'geo']);
    // Костыль для Carbon Field (отображение миниатюр загруженных файлов)
    add_action('admin_enqueue_scripts', function () {
      wp_enqueue_style('style-admin', get_template_directory_uri() . '/assets/css/admin.css');
      wp_enqueue_script('script-admin', get_template_directory_uri() . '/assets/js/admin.js');
    }, 99);
  }

  /**
   * Подключает скрипты и стили
   */
  public function connectedStylesAndScripts()
  {
    wp_dequeue_style('wp-block-library');

		$version = filemtime(get_template_directory() . '/assets/css/app.min.css');
    wp_enqueue_style('style', URI . '/assets/css/app.min.css', [], $version);
		
		$version = filemtime(get_template_directory() . '/assets/js/app.min.js');
    wp_enqueue_script('main_scripts', URI . '/assets/js/app.min.js', [], $version, true);
  }

  /**
   * Изменяем пункты меню (страницы на лендинги)
   */
  public function wd_admin_update_objects()
  {
    global $wp_post_types;
    $labels = &$wp_post_types['page']->labels;
    $labels->name = 'Лендинги';
    $labels->singular_name = 'Лендинги';
    $labels->add_new = 'Добавить лендинг';
    $labels->add_new_item = 'Добавить лендинг';
    $labels->edit_item = 'Изменить лендинг';
    $labels->new_item = 'Лендинг';
    $labels->view_item = 'Смотреть лендинг';
    $labels->search_items = 'Поиск лендинга';
    $labels->not_found = 'Лендинг не найден';
    $labels->not_found_in_trash = 'В корзине нет лендингов';
    $labels->all_items = 'Все лендинги';
    $labels->menu_name = 'Лендинги';
    $labels->name_admin_bar = 'Лендинги';
  }

  /**
   * Добавляет переменные в куки (для отправки с формой)
   */
  // public static function addVarCooke()
  // {

  //   global $post;
  //   global $wp;
  //   $postID = $post->ID;
  //   $postLink = home_url($wp->request);

  //   // ID лендинга
  //   if (!isset($_COOKIE['pageID'])) {
  //     setcookie('pageID', json_encode($postID), time() + 60 * 60 * 24, '/');
  //   }

  //   // Постоянная ссылка на лендинг
  //   if (!isset($_COOKIE['pageLink'])) {
  //     setcookie('pageLink', json_encode($postLink), time() + 60 * 60 * 24, '/');
  //   }

  //   // GET параметры
  //   if (!isset($_COOKIE['getParam'])) {
  //     setcookie('getParam', json_encode($_GET), time() + 60 * 60 * 24, '/');
  //   }
  // }

  /**
   * Добавляет файл роботс
   */
  // public function addedRobotsTxt()
  // {
  //   $data[] = 'User-agent: *';
  //   $data[] = 'Disallow: *';
  //   $data[] = 'Sitemap: ' . get_site_url(null, '', 'https') . '/sitemap_index.xml';

  //   echo implode("\r\n", $data);
  //   die;
  // }

  /**
   * Позволяет загружать SVG
   */
  public function svgUploadAllow($mimes)
  {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
  # Исправление MIME типа для SVG файлов.
  function fix_svg_mime_type($data, $file, $filename, $mimes, $real_mime = '')
  {

    // WP 5.1 +
    if (version_compare($GLOBALS['wp_version'], '5.1.0', '>=')) {
      $dosvg = in_array($real_mime, ['image/svg', 'image/svg+xml']);
    } else {
      $dosvg = ('.svg' === strtolower(substr($filename, -4)));
    }

    // mime тип был обнулен, поправим его
    // а также проверим право пользователя
    if ($dosvg) {

      // разрешим
      if (current_user_can('manage_options')) {

        $data['ext']  = 'svg';
        $data['type'] = 'image/svg+xml';
      }
      // запретим
      else {
        $data['ext']  = false;
        $data['type'] = false;
      }
    }
    return $data;
  }
}

new General();
