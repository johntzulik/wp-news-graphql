<?php 
/**
 * Aquí encolaremos todos los archivos css y js
 */

function setep_enqueue_style( $hook ){

    if( $hook != 'toplevel_page_setep_news' &&  $hook != 'setep-noticias_page_setep_news_config'){
        return;
    }

    //Encolando css
    wp_enqueue_style(
        'admin-style',
        plugin_dir_url( __DIR__ ) . 'admin/css/app.css',
        [],
        '1.0.0',
        'all'
    );

    //Encolando la libreria de bootstrap 5
    wp_enqueue_style(
        'bootstrap-css',
        plugin_dir_url( __DIR__ ) . 'helpers/bootstrap-5.2/css/bootstrap.min.css',
        [],
        '5.2.0',
        'all'
    );

    wp_enqueue_style(
        'bootstrap-rtl-css',
        plugin_dir_url( __DIR__ ) . 'helpers/bootstrap-5.2/css/bootstrap.rtl.min.css',
        [],
        '5.2.0',
        'all'
    );

    wp_enqueue_style(
        'bootstrap-grid-css',
        plugin_dir_url( __DIR__ ) . 'helpers/bootstrap-5.2/css/bootstrap-grid.min.css',
        [],
        '5.2.0',
        'all'
    );

    wp_enqueue_style(
        'bootstrap-grid-rtl-css',
        plugin_dir_url( __DIR__ ) . 'helpers/bootstrap-5.2/css/bootstrap-grid.rtl.min.css',
        [],
        '5.2.0',
        'all'
    );

    wp_enqueue_style(
        'bootstrap-reboot-css',
        plugin_dir_url( __DIR__ ) . 'helpers/bootstrap-5.2/css/bootstrap-reboot.min.css',
        [],
        '5.2.0',
        'all'
    );

    wp_enqueue_style(
        'bootstrap-reboot-rtl-css',
        plugin_dir_url( __DIR__ ) . 'helpers/bootstrap-5.2/css/bootstrap-reboot.rtl.min.css',
        [],
        '5.2.0',
        'all'
    );

    wp_enqueue_style(
        'bootstrap-utilities-css',
        plugin_dir_url( __DIR__ ) . 'helpers/bootstrap-5.2/css/bootstrap-utilities.min.css',
        [],
        '5.2.0',
        'all'
    );

    wp_enqueue_style(
        'bootstrap-utilities-rtl-css',
        plugin_dir_url( __DIR__ ) . 'helpers/bootstrap-5.2/css/bootstrap-utilities.rtl.min.css',
        [],
        '5.2.0',
        'all'
    );


}
add_action( 'admin_enqueue_scripts', 'setep_enqueue_style' );


function setep_enqueue_scripts( $hook ){

    if( $hook != 'toplevel_page_setep_news' &&  $hook != 'setep-noticias_page_setep_news_config'){
        return;
    }

    //Encolando js
    wp_enqueue_script(
        'admin-script',
        plugin_dir_url(__DIR__) . 'admin/js/app.js',
        ['jquery', 'bootstrap-min'],
        '1.0.0',
        true
    );

    //Encolando libreria de bootstrap
    wp_enqueue_script(
        'bootstrap-min',
        plugin_dir_url(__DIR__) . 'helpers/bootstrap-5.2/js/bootstrap.min.js',
        ['jquery'],
        '5.2.0',
        true
    );

    wp_enqueue_script(
        'bootstrap-bundle',
        plugin_dir_url(__DIR__) . 'helpers/bootstrap-5.2/js/bootstrap.bundle.min.js',
        ['jquery'],
        '5.2.0',
        true
    );

    
    //Función localize
    wp_localize_script(
        'admin-script',
        'setepSaveData',
        array(
            'url'       => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('setepdata_seg')
        )
    );

    //Función para guardar con los datos
    wp_localize_script(
        'admin-script',
        'dataRetraiveNews',
        array(
            'url'       => admin_url('admin-ajax.php'),
            'nonce'     => wp_create_nonce('setepdata_seg')
        )
    );

}
add_action( 'admin_enqueue_scripts', 'setep_enqueue_scripts' );


function setep_save_data_config(){
    check_ajax_referer('setepdata_seg', 'nonce');

    if( current_user_can('manage_options') ){

        extract( $_POST, EXTR_OVERWRITE );

        if( $tipo == 'save' ){
            if( get_option('setep_new_no_exp') == null ){

                $args[] = array(
                    'endpoint'          => $endpoint,
                    'numeroExpediente'  => $numeroExpediente,
                    'password'          => $password,
                    'token'             => $token
                );

                $data = add_option( 'setep_new_no_exp', $args, true );
                $object = get_option( 'setep_new_no_exp' );

                $json = json_encode([
                    'data' => $data,
                    'object' => $object
                ]);

            }else if( get_option('setep_new_no_exp') != null ){

                $args[] = array(
                    'endpoint'          => $endpoint,
                    'numeroExpediente'  => $numeroExpediente,
                    'password'          => $password,
                    'token'             => $token
                );

                $data = update_option( 'setep_new_no_exp', $args, true );
                $object = get_option( 'setep_new_no_exp');

                $json = json_encode([
                    'data' => $data,
                    'object' => $object
                ]);
            }
        }

        echo $json;
        wp_die();

    }
}

add_action( 'wp_ajax_setep_save_data_config', 'setep_save_data_config' );

function setep_save_news_post(){
    check_ajax_referer('setepdata_seg', 'nonce');

    if( current_user_can('manage_options') ){

        extract( $_POST, EXTR_OVERWRITE );

        if( $tipo == 'refresh' ){

                $args[] = array(
                    'setepnews'  => $news,
                );
                if( get_option('setep_news_refresh') == null ){
                    $data = add_option( 'setep_news_refresh', $args, true );
                }else if( get_option('setep_news_refresh') != null ){
                    $data = update_option( 'setep_news_refresh', $args, true );
                }
                $object = get_option( 'setep_news_refresh' );

                $json = json_encode([
                    'data' => $data,
                    'object' => $object
                ]);
        }

        echo $json;
        wp_die();

    }
}

add_action( 'wp_ajax_setep_save_news_post', 'setep_save_news_post' );