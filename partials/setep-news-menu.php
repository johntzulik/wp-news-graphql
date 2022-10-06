<?php 

/**
 * Creando el menú pop-up
 */

if( !function_exists( 'setep_news_menu' ) ){

    function setep_news_menu(){

        add_menu_page(
            'Setep Noticias',
            'Setep Noticias',
            'manage_options',
            'setep_news',
            'setep_options_news_menu',
            'dashicons-megaphone',
            12
        );
        add_submenu_page(
            'setep_news',
            'Configuración',
            'Configuración',
            'manage_options',
            'setep_news_config',
            'setep_news_config_display'
        );

    }
    add_action('admin_menu', 'setep_news_menu');

}

//Función callback
if( !function_exists('setep_options_news_menu') ){
    function setep_options_news_menu(){
        /*if( $_GET['edit'] && $_GET['id'] ){
            include plugin_dir_path( __DIR__ ) . 'admin/setep-news-display-edit.php';
        }else{
            include plugin_dir_path( __DIR__ ) . 'admin/setep-news-display.php';
        }*/
        include plugin_dir_path( __DIR__ ) . 'admin/setep-news-display.php';
    }
}
//Función callback
if( !function_exists('setep_news_config_display') ){
    function setep_news_config_display(){
        /*
        if( $_GET['edit'] && $_GET['id'] ){
            include plugin_dir_path( __DIR__ ) . 'admin/setep-news-config-edit.php';
        }else{
            include plugin_dir_path( __DIR__ ) . 'admin/setep-news-config.php';
        }
        */
        include plugin_dir_path( __DIR__ ) . 'admin/setep-news-config.php';

    }
}
