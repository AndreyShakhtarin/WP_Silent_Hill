<?php
// выходим, если uninstall/delete вызвана не из WordPress
if( ! defined( 'ABSPATH' ) && ! defined( 'WP_UNINSTALL_PLUGIN' ) )
    exit ();
// удаляем данные из таблицы параметров
delete_option( 'halloween_options' );