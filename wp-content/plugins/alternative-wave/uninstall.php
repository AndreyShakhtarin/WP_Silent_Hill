<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 12.12.16
 * Time: 15:55
 */
// если функция uninstall/delete вызвана не из WordPress, выходим
if( !defined( 'ABSPATH' ) && !defined( 'WP_UNINSTALL_PLUGIN' ) )
exit();
// удаляем параметр из таблицы параметров
delete_option( 'prowp_options_arr' );
// удаляем все другие параметры, произвольные таблицы и файлы

register_uninstall_hook(__FILE__ , 'prowp_uninstall_hook' );
function prowp_uninstall_hook() {
    delete_option( 'prowp_options_arr' );
// удаляем все дополнительные параметры и произвольные таблицы
}