<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'wordpress');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '123456');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'iIckMz<0m2Le dXv)4oR<>{])#9PAh038JRkbI!`z!h1zhaCRNQA.%bj#%m|ugEi');
define('SECURE_AUTH_KEY',  'YNXwS>FUq=T)&$(TT{37*84#WElGuP+`YjL^+).Pqp~5AmM|p;3%UV~l|?Qs`h,(');
define('LOGGED_IN_KEY',    '7h~*~@71:2/JO(#~!7_sIEm}8z=Wu@-5`0L6>J7uA,e8{xG/Z9W4v$ ^7$.Nk8GL');
define('NONCE_KEY',        'a?e3xH9j A%%ir SU(3$YbGr<cNmlLUnk/g-C|3M9gh/DuTYDSi@ZC4sae[d!9d ');
define('AUTH_SALT',        'gE~:1I05u0|~vR5olmq3ilg8W/RzM/wS-G|fPy#NTd24d3Gp;rwVtXCI`/Du*b#y');
define('SECURE_AUTH_SALT', 'LmpZg&~$$ZZj,Eubf~tWn;eLX]eIFPN{{oUGttHg7RPS+I/2I*yGzJh2>uRQ<G80');
define('LOGGED_IN_SALT',   '2Y7Jp})O:!z^mn/GQP7^%%;sOPmY%KC+i+rncJxeiM,5xKw,VY{n(,F9BcI%t2}>');
define('NONCE_SALT',       'Lr^{D]-A=ex39=Q6lwW+/f_S@x*y=21QWN*psa[fVTS$yYafxEmY1~:87| CaK,5');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

//адресса WordPress и блога
//define('WP_SITEURL', 'http://example.com/wordpress');
//define('WP_HOME', 'http://example.com/wordpress');

//изменение дериктории wp-content, указать дерикторию и url
//define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'].'/wordpress/blog/wp-content');
//define('WP_CONTENT_URL', 'http://domian/wordpress/blog/wp-content');

//изменение дериктории plugin, указать дерикторию и url
//define('WP_PLUGIN_DIR', $_SERVER['DOCUMENT_ROOT'].'/wordpress/blog/plugins');
//define('WP_PLUGIN_DIR', 'http://domian/wordpress/blog/plugins');

//Отключение хранение редакции
//define('WP_POST_REVISIONS', false);

//Ограничение хранение редакции до 5
//define('WP_POST_REVISIONS', 5);

//интервал автосохранения
define('AUTOSAVE_INTERVAL', 300);

//отладочный параметор числа записи в базуданных
//define('SAVEQUERIES', true);

//массив запросов, поместить в шаблон для отображения
//if( current_user_can( 'manag_options' )){
//    global $wpdb;
//    print_r( $wpdb->queries );
//}

//запись ошибок в журнал
@ini_set( 'log_errors', 'On' );
@ini_set( 'display_errors', 'Off' );
@ini_set( 'errors_log', __DIR__.'/php_error.log' );

define( 'WP_MEMORY_LIMIT', '32M' );

//ЗАГРУЖАЕТ НУЖНЫЕ ЯЗЫКОВЫЕ ФАЙЛЫ
//define( 'WPLANG', 'en-GB' );

//дириктория с языковыми файлами
//define( 'LANGDIR', '/wp-content/lang' );

//установка cookie для подаменов мултисайтов
//define( 'COOKIE_DOMAIN', '.domain.com' );
//define( 'COOKIEPATH', '/' );
//define( 'SETCOOKIEPATH', '/' );

//установка ftp
//define( 'FTP_USER', 'Andrey' );
//define( 'FTP_PASS', 'FelixCat1988' );
//define( 'FTP_HOST', 'localhost' );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');

if(is_admin()) {
    add_filter('filesystem_method', create_function('$a', 'return "direct";' ));
    define( 'FS_CHMOD_DIR', 0751 );
}