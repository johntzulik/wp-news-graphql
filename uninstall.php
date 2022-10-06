<?php 
/**
 * se activa cuando el plugin va a ser desinstalado
 */

if( !defined( 'WP_UNINSTALL_PLUGIN' ) ){

    exit();

}

/**
 * Agrega todo el código necesario para eliminar
 * Bases de datos, limpiar cache, limpiar enlaces permanentes, etc...
 * en la desinstalación del plugin
 */
