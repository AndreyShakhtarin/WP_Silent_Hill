<?php
/*
Plugin Name: Alternativ Wave
Plugin URI: http ://example.com/wordpress-plugins/halloween-plugin
Description: This is a brief description of my plugin
Version: 1.0
Author: Michael Myers
Author URI: http://example.com
License: GPLv2
*/


//// создаем произвольное меню для плагина
//add_action( 'admin_menu', 'prowp_create_menu' );
//function prowp_create_menu() {
//// создаем новое меню верхнего уровня
//    add_menu_page( 'Halloween Plugin Page', 'Halloween Plugin',
//        'manage_options', 'prowp_main_menu', 'prowp_main_plugin_page',
//        plugins_url( '/images/wordpress.png', __FILE__ ) );
//// создаем подпункты меню: настройка и поддержка
//    add_submenu_page( 'prowp_main_menu', 'Halloween Settings Page',
//    'Settings', 'manage_options', 'halloween_settings',
//    'prowp_settings_page' );
//    add_submenu_page( 'prowp_main_menu', 'Halloween Support Page',
//    'Support', 'manage_options', 'halloween_support', 'prowp_support_page' );
//}

// создаем произвольное меню для плагина
add_action( 'admin_menu', 'prowp_create_menu' );
function prowp_create_menu() {
// создаем новое меню верхнего уровня
    add_menu_page( 'Halloween Plugin Page', 'Halloween Plugin',
        'manage_options', 'prowp_main_menu', 'prowp_settings_page',
        plugins_url( '/images/wordpress.png', __FILE__) );
// вызываем функцию для регистрации настроек
    add_action( 'admin_init', 'prowp_register_settings' );
}

function prowp_register_settings() {
// регистрируем настройки
    register_setting( 'prowp-settings-group', 'prowp_options',
        'prowp_sanitize_options' );
}

function prowp_settings_page()
{
    ?>
    <div class="wrap">
        <h2>Halloween Plugin 0ptions</h2>
        <form method="post" action=”options.php">
        <?php settings_fields('prowp-settings-group'); ?>
        <?php $prowp_options = get_option('prowp_options'); ?>
        <table class="form-table">
        <tr valign="top">
            <th scope="row">Name</th>
            <td>
                <input type="text"
                       name="prowp_options[option_name]"
                       value="<?php echo esc_attr($prowp_options['option_name']); ?>">
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Email</th>
            <td><input type="text"
                       name="prowp_options[option_email]"
                       value="<?php echo esc_attr($prowp_options['option_email']); ?>"
                /></td>
        </tr>
        <tr valign="top">
            <th scope="row">URL
                <td><input type="text" name="prowp_options[option_url]"
                           value="<?php echo esc_url($prowp_options['option_url']); ?>"/>
                </td>
            </th>
        </tr>
        </table>
        <p class="submit">
            <input type="submit" class="button-primary"
                   value="Save Changes"/>
        </p>
        </form>
    </div>
    <?php
}

function prowp_sanitize_options( $input ) {
    $input['option_name'] = sanitize_text_field( $input['option_name'] );
    $input['option_email'] = sanitize_email( $input['option_email'] );
    $input['option_unl'] = esc_url( $input['option_url'] );
return $input;
}

// выполняем функцию раздела настроек
add_action( 'admin_init', 'prowp_settings_init' );
function prowp_settings_init() {
// создаем новый раздел настроек в Параметры > Чтение
    add_settings_section( 'prowp_setting_section', 'Halloween Plugin Settings',
        'prowp_setting_section', 'reading' );
// регистрируем индивидуальные настройки
    add_settings_field( 'prowp_setting_enable_id', 'Enable Halloween Feature?',
        'prowp_setting_enabled', 'reading', 'prowp_setting_section' );
    add_settings_field( 'prowp_saved_setting_name_id', 'Your Name',
        'prowp_setting_name', 'reading', 'prowp_setting_section' );
    // регистрируем настройки с помощью массива значений
    register_setting( 'reading', 'prowp_setting_values', 'prowp_sanitize_settings' );
}

function prowp_sanitize_settings( $input )
{
    $input['enabled'] = ($input['enabled'] == 'on') ? 'on' :
        $input['name'] = sanitize_text_field($input['name']);
    return $input;
}

function prowp_setting_section() {
  echo '<p>Configure the Halloween plugin options below</p>';
}

function prowp_setting_enabled() {
// получаем настройки плагина
    $prowp_options = get_option( 'prowp_setting_values' );
// отображаем форму с чекбоксами
    echo '<input '.checked( $prowp_options['enabled'], 'on', false ).'
            name="pnowp_setting_values[enabled]" type="checkbox" /> Enabled';
}


function prowp_setting_name() {
// получаем значение настройки
    $prowp_options = get_option( 'prowp_setting_values' );
// отображаем текстовое поле
    echo '<input type="text" name="prowp_setting_values[name]" value="'.esc_attr( $prowp_options['name'] ).'"/>';
}

add_action( 'add_meta_boxes', 'prowp_meta_box_init' );
// функции для добавления метаполя и сохранения данных
function prowp_meta_box_init()
{
// создаем произвольное метаполе
    add_meta_box('prowp-meta', 'Информация о продукте',
        'prowp_meta_box', 'post', 'side', 'default');
}

function prowp_meta_box( $post, $box )
{
// извлекаем значения произвольного метаполя
    $prowp_featured = get_post_meta($post->ID, '_prowp_type', true);
    $prowp_price = get_post_meta($post->ID, '_prowp_price', true);
// временные значения из соображений безопасности
    wp_nonce_field(plugin_basename(__FILE__), 'prowp_save_foeta_box');
// форма метаполя
    echo '<p>Price: <input type="text" name="prowp_price"
        value="' . esc_attr($prowp_price) . '" size="5" /></p>';
    echo '<p>Type:
        <select name="prowp_product_type" id="prowp_product_type">
            <option value="0" ' . selected($prowp_featured, 'normal', false) . '>
                Normal
            </option>
            <option value="special" ' . selected($prowp_featured, 'special', false) . '>
                Special
            </option>
            <option value="featured" ' . selected($prowp_featured, 'featured', false) . '>
                Featured
            </option>
            <option value="clearance" '. selected($prowp_featured, 'clearance', false) . '>Clearance
            </option>
        </select>
    </p>';
}

// сохраняем данные метаполя во время сохранения записи
add_action( 'save_post', 'prowp_save_meta_box' );
function prowp_save_meta_box( $post_id ) {
// обрабатываем данные формы, если установлена переменная $_POST
    if( isset( $_POST['prowp_product_type'] ) ) {
// если включено автосохранение, пропускаем этап сохранения данных метаполя
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;
// проверяем временное значение из соображений безопасности
        check_admin_referer( plugin_basename(__FILE__), 'prowp_save_meta_box' );
// сохраняем данные метаполя в произвольных полях записи, используя префикс ID
        update_post_meta( $post_id, '_prowp_type', sanitize_text_field( $_POST['prowp_product_type'] ) );
        update_post_meta( $post_id, '_prowp_price',sanitize_text_field ( $_POST['prowp_price'] ) );
    }
}

add_shortcode( 'mytwitter', 'prowp_twitter' );
function prowp_twitter() {
return '<a href = "http://twitter.com/williamsba">@willianisba</a>';
}


////Создание виджета
// используем зацепку widgets_init, чтобы запустить произвольную функцию
//add_action( 'widgets_init', 'prowp_register_widgets' );
//    // регистрируем виджет
//    function prowp_register_widgets() {
//    register_widget( 'prowp_widget' );
//}
//
////prowpwidget class
//class prowp_widget extends WP_Widget {
//// код виджета
//    function prowp_widget() {
//        $widget_ops = array(
//            'classname' => 'prowp_widget_class',
//            'description' => 'Example widget that
//            displays a user\'s bio.'
//        );
//        $this->WP_Widget( 'prowp_widget', 'Bio Widget', $widget_ops );
//    }
//// создаем форму настроек виджета
//    function form( $instance ) {
//        $defaults = array(
//            'title' => 'My Bio',
//            'name' => 'Michael Myers',
//            'bio' => ''
//        );
//        $instance = wp_parse_args( (array) $instance, $defaults );
//        $title = $instance['title'];
//        $name = $instance['name'];
//        $bio = $instance['bio'];
//        ?>
<!--        <p>Title:-->
<!--            <input class="widefat"-->
<!--                   name="--><?php //echo $this->get_field_name( 'title' ); ?><!--"-->
<!--                   type="text"-->
<!--                   value="--><?php //echo esc_attr( $title ); ?><!--" /></p>-->
<!--        <p>Name:-->
<!--            <input class="widefat"-->
<!--                   name="--><?php //echo $this->get_field_name( 'name' ); ?><!--"-->
<!--                   type="text"-->
<!--                   value="--><?php //echo esc_attr( $name ); ?><!--" />-->
<!--        </p>-->
<!--        <p>Bio:-->
<!--            <textarea class="widefat"-->
<!--                      name="--><?php //echo $this->get_field_name( 'bio' ); ?><!--">-->
<!--                --><?php //echo esc_textarea( $bio ); ?>
<!--            </textarea>-->
<!--        </p>-->
<?php
//        }
//// сохраняем настройки виджет
//    function update( $new_instance, $old_instance )
//    {
//        $instance = $old_instance;
//        $instance['title'] =
//            sanitize_text_field($new_instance['title']);
//        $instance['name'] =
//            sanitize_text_field($new_instance['name']);
//        $instance['bio'] =
//            sanitize_text_field($new_instance['bio']);
//        return $instance;
//    }
//// отображаем виджет
//    function widget( $args, $instance ) {
//        extract( $args );
//        echo $before_widget;
//                    $title = apply_fliters( 'widget_title', $instance['title'] );
//        $name = ( empty($instance['name'] ) ) ? '&nbsp;' : $instance['name'];
//        $bio = ( empty( $instance['bio'] ) ) ? '&nbsp;' : $instance['bio'];
//        if ( !empty( $title ) ) { echo $before_title . esc_html( $title ) . $after_title; };
//        echo '<p>Name: ' . esc_html( $name ) . '</p>';
//        echo '<p>Bio: ' . esc_html( $bio ) . '</p>';
//        echo $after_widget;
//        }
//}


//add_action( 'admin_menu', 'prowp_create_settings_submenu' );
//function prowp_create_settings_submenu() {
//    add_options_page( 'Halloween Settings Page', 'Halloween Settings',
//        'manage_options', 'halloween_settings_menu', 'prowp_settings_page' );
//}


//Создание консольного виджета
add_action( 'wp_dashboard_setup', 'prowp_add_dashboard_widget' );
// вызываем функцию для создания консольного виджета
function prowp_add_dashboard_widget()
{
    wp_add_dashboard_widget('prowp_dashboard_widget', 'Pro WP Консоль Виджет', 'prowp_create_dashboard_widget');
}

// функция для отображения содержания консольного виджета
function prowp_create_dashboard_widget()
{
    echo '<p>Привет мир! Это мой виджет в консоль!</p>';
    echo 'My fields <input type="text" value="hello">';
}


//Создание произвольных таблиц
$prowp_db_version = '1.0';
add_option( 'prowp_db_version', $prowp_db_version );

register_activation_hook( __FILE__, 'prowp_install' );
function prowp_install()
{
    global $wpdb;
// задаем имя произвольной таблицы
    $table_name = $wpdb->prefix .'prowp_data';

    $sql = "CREATE TABLE " .$table_name ." (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            time bigint(ll) DEFAULT '0' NOT NULL,
            name tinytext NOT NULL,
            text text NOT NULL,
            url VARCHAR(55) NOT NULL,
            UNIQUE KEY id (id));";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    // выполняем запрос для создания таблицы
    dbDelta( $sql );
    // устанавливаем версию структуры таблицы
    $prowp_db_version = '1.0';
    // сохраняем номер версии структуры таблицы
    add_option( 'prowp_db_version', $prowp_db_version );
}

