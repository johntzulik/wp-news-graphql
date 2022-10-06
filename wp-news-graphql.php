<?php 
/**
 * Plugin Name: Setep Noticias
 * Plugin URI: https://200response.mx
 * Description: Setep Noticias from GraphQl
 * Version: 1.1.25
 * Author: johntzulik
 * Author URI: https://200response.mx
 * License: GPL2
 * License URI: https: //www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: setep-news
*/

function setep_news_install(){
    //acción al activar el plugin
    require_once 'activator.php';
}
register_activation_hook(__FILE__, 'setep_news_install');

function setep_news_desactivador(){
    //acción al desactivar el plugin
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'setep_news_desactivador');

//Menú de opciones
require_once 'partials/setep-news-menu.php';

//Encolamiento de archivos
require_once 'partials/setep-news-enqueue-files.php';

//parte publica
require_once 'public/setep-news-public.php';