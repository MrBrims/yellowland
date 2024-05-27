<?php

// Переменные

$dir = __DIR__ . '/';

define('PATH', $dir);
define('URI', get_template_directory_uri());
define('HOMEPAGE', get_option('page_on_front'));

require_once PATH . 'inc/PrivateConstants.php';

// Основные настройки
require_once PATH . 'inc/General.php';
// Утилити методы
require_once PATH . 'inc/Helpers.php';
// Работа формы
require_once PATH . 'inc/Ajax.php';

// Carbon Field
require_once PATH . 'inc/CarbonFields/PageMeta.php';
require_once PATH . 'inc/CarbonFields/BasicMeta.php';

// REST API калькулятора
require_once PATH . 'inc/apiprice.php';

Helpers::geo();