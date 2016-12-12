<?php
/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own twentysixteen_setup() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
	 * If you're building a theme based on Twenty Sixteen, use a find and replace
	 * to change 'twentysixteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentysixteen' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since Twenty Sixteen 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'twentysixteen' ),
		'social'  => __( 'Social Links Menu', 'twentysixteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'twentysixteen_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );
}
add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'twentysixteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'twentysixteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'twentysixteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Sixteen.
 *
 * Create your own twentysixteen_fonts_url() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentysixteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( 'twentysixteen-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'twentysixteen' ),
		'collapse' => __( 'collapse child menu', 'twentysixteen' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function twentysixteen_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );


//function prowp_register_my_post_types()
//{
//	$args = array(
//		//установлевает публичный доступ
//		'public' => true,
//
////		Позволяет типу записи иметь архивную страницу. Архивная страница типа записи
////		подобна странице записей WordPress, отображающей последние записи в блоге.
////		Это позволяет отображать список записей данного типа в порядке, определенном
////		в файле шаблона темы.
//		'has_archive' => true,
//
////		Дает название массиву зарегистрированных таксономий для прикрепления к инди­
////		видуальному типу записей. Например, вы можете передать в этом массиве category
////		и post_tag, чтобы прикрепить предустановленные таксономии рубрик и меток
////		к вашему типу записи. По умолчанию к пользовательскому типу записи никакие
////		таксономии не прикреплены. (РУБРИКИ)
//		'taxonomies' => array( 'category' ),
//
//		//АВТОМАТИЧЕСКИ ПЕРЕЗАПИСЫВАЕТ РОУТ, ЗАПРЕЩАЕТ ПЕРЕЗАПИСЫВАТЬ РОУТ
////		Аргумент r e w r it e создает уникальные постоянные ссылки для этого типа записей.
////		Это позволит вам сделать индивидуальным слаг типа записи в URL. Аргументу
////		могут быть присвоены значения tru e , f a l s e или массив значений.
//		'rewrite' => array(
//
////			slug — определяет индивидуальный слаг постоянной ссылки. Значение по
////			умолчанию для $post_type.
//			'slug*' => 'product',
//
////			with_f ront — определяет, будет ли тип записи использовать основу постоянных
////			ссылок. Например, если префиксом ваших постоянных ссылок является /blog,
////			а значение with_f ront определено как true, постоянные ссылки записей этого
////			типа будут начинаться с /blog.
//			'with_front',
//
////			pages — определяет, будет ли постоянная ссылка обеспечивать разбиение на
////			страницы. Значение по умолчанию true.
//			'pages' => true,
//
////			feeds — определяет, будет ли постоянная ссылка на фид встроена в записи этого
////			типа. Значение по умолчанию совпадает со значением has_archive.
//			'feeds',
//		),
//
////		Определяет, может ли контент записи этого типа быть публично запрошен через
////		пользовательский интерфейс сайта. Если выставлено значение fa lse , все запросы
//// 		от пользователей будут возвращать ошибку 404, поскольку запрос запрещен.
////		По умолчанию значение определяется аргументом public
//		'publicly' => 'public',
//
////		Позволяет исключить записи пользовательского типа из результатов поиска
////		WordPress. По умолчанию значение определяется аргументом public.
//		'exdude_from_search' => true,
//
////		Определяет, будет ли тип записи доступен для выбора при управлении меню
////		WordPress. По умолчанию значение определяется аргументом public
//		'show_in_nav_menus' => true,
//
////		Аргумент h ie ra rc h ic a l позволяет задать, является ли тип записи иерархическим,
////		подобно страницам WordPress. h ie ra rch ica l позволяет иметь древовидную струк­
////		туру контента записей данного типа. По умолчанию аргументу присвоено значение
////		false.
//		'hierarchical' => false,
//
////		Определяет, будет ли контент записей данного типа доступен для экспорта с исполь­
////		зованием встроенной возможности экспорта WordPress (Инструменты ► Экспорт).
////		По умолчанию аргументу присвоено значение true.
//		'can_export' => true,
//
////		Позволяет выбрать позицию, в которой пользовательский тип записи будет отобра­
////		жаться в меню администратора. По умолчанию новые типы записей отображаются
////		после вкладки Комментарии.
//		'menu_position',
//
////		Устанавливает индивидуальную иконку в меню для вашего типа записи. По умол­
////		чанию используется иконка для записей.
//		'menu_icon',
//
////		Определяет, будет ли отображаться меню администратора для вашего типа записи.
////		Аргумент принимает три значения: true , false или строку. Строка может быть либо
////		страницей верхнего уровня, как tools.php, либо edit.php?post_type=page. Вы также
////		можете задать строке параметр menu_slug, чтобы добавить пользовательский тип
////		записи как объект подменю в существующем пользовательском меню. По умолча­
////		нию определяется значением аргумента show_ui
//		'show_in_menu'=> true,
//
////		Определяет, будет ли отображаться пользовательский тип записи в панели ад­
////		министратора WordPress. По умолчанию определяется значением аргумента
////		show_in_menu
//		'show_in_admin_bar',
//
////		Дает название строке или массиву характеристик для этого типа записи. По умол­
////		чанию приписывается значение p o st
//		'capability_type',
//
////		Это массив индивидуальных характеристик, необходимых для редактирования,
////		удаления, просмотра и публикации записей данного типа
//		'capabilities',
//
////		Этот аргумент устанавливает переменную запроса записей данного типа. По умол­
////		чанию его значение true и устанавливается для $post_type .
//		'query_var' => true,
//
////		Добавляет в следующие значения:
//		'supports' => array(
//
//	// 		title - Добавить запись
//				'title',
//
//	//		editor - редактор записи контента,
//				'editor',
//
//	//		author - автора (рубрики)
//				'author',
//
//	//		thumbnail - миниатюра записи
//	//			Задать миниатюру
//				'thumbnail',
//
//	//		comments - Обсуждение
//	// 				Разрешить комментарии.
//	//				Разрешить обратные ссылки и уведомления.
//				'comments',
//
//	//		excerpt - Отрывок — необязательное краткое содержание вашего текста, которое можно использовать в шаблонах темы.
//				'excerpt',
//
//	//		trackbacks - Обратные ссылки
//	// 				— это способ уведомить другие блоги, что вы сослались на них.
//	// 				Если вы ссылаетесь на блог под управлением WordPress,
//	//				уведомление будет отправлено ему автоматически,
//	// 				дополнительных действий не требуется.
//				'trackbacks',
//
//	//		custom-fields - Добавить новое поле:
//	// 		Произвольные поля позволяют добавлять к записям метаданные,
//	// 		которые вы можете использовать в своей теме.
//				'custom-fields',
//
//	//		page-attributes - Порядок Атрибутов
//				'page-attributes',
//
//	//		revisions - пезервные копии
//				'revisions',
//
//	//		post-formats - формат записи
//				'post-formats'
//			),
//
////		добавляется новое поле в кансоле
//		'labels' => array(
////			имя поля - Products
//			'name' => 'Products',
//			'singular_name' => 'Product',
//			'add_new' => 'Добавить Product',
//			'add_new_item' => 'Добавить Product',
//			'edit_item' => 'Редактировать Product',
//			'new_item' => 'Новый Product',
//			'all_items' => 'Все Products',
//			'view_item' => 'Смотреть Product',
//			'search_items' => 'Исткать Products',
//			'not_found' => 'не нашлось Product',
//			'not_found_in_trash' => 'в карзине нет Product',
//			'parent_item_colon' => '',
//			'menu_name' => 'Products'
//		),
//	);
//	register_post_type('products',$args);
//}
//
//add_action( 'init', 'prowp_register_my_post_types' );

//1
//add_action( 'init', 'prowp_register_my_post_types' );
//function prowp_register_my_post_types()
//{
//	register_post_type('products',
//		array(
//			'labels' => array(
//				'name' => 'Products'
//			),
//			'public' => true,
//		)
//	);
//}
//2
//add_action( 'init', 'prowp_register_my_post_types' );
//function prowp_register_my_post_types() {
//	$args = array(
//		'public' => true,
//		'has_archive' => true,
//		'taxonomies' => array( 'category' ),
//		'rewrite' => array( 'slug' => 'product' ),
//		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'comments' )
//);
//register_post_type( 'products', $args );
//}
//3
add_action( 'init', 'prowp_register_my_post_types' );
function prowp_register_my_post_types()
{
	$labels = array(
		'name' => 'Products',
		'singular_name' => 'Product',
		'add_new' => 'Add New Product',
		'add_new_item' => 'Add New Product',
		'edit_item' => 'Edit Product',
		'new_item' => 'New Product',
		'all_items' => 'All Products',
		'view_item' => 'View Product',
		'search_items' => 'Search Products',
		'not_found' => 'No products found',
		'not_found_in_trash' => 'No products found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Products'
	);
	$args = array(
		'labels' => $labels,
		'public' => true

	);
	register_post_type('products', $args);
}
//4
add_action( 'init', 'prowp_define_product_type_taxonomy' );
function prowp_define_product_type_taxonomy(){

	$labels = array(
	'name' => 'Type',
	'singular_name' => 'Types',
	'seanch_items' => 'Search Types',
	'all_items' => 'All Types',
	'parent_item' => 'Parent Type',
	'parent_item_colon' => 'Parent Type:',
	'edit_item' => 'Edit Type',
	'update_item' => 'Update Type',
	'add_new_item' => 'Add New Type',
	'new_item_name' => 'New Type Name',
	'menu_name' => 'Type'
	);
		$args = array(
			'labels' => $labels,
			'hierarchical' => true,
			'query_var' => true,
			'rewrite' => true
		);
	//register_post_type('products',$args);
	register_taxonomy('type', 'products', $args);
}

