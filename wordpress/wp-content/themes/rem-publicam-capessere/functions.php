<?php
require_once(__DIR__ . "/vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

/* RemPublicamCapessere */
function rpc_scripts() {
    wp_enqueue_style( 'fa', get_template_directory_uri() . "/lib/font-awesome/css/font-awesome.min.css", [], "1.0.0" );
    wp_enqueue_style( 'glowCookies', get_template_directory_uri() . "/lib/glowCookies/glowCookies.css", [], "1.0.0" );
    wp_enqueue_style( 'theme', get_template_directory_uri() . '/dist/theme.css', [], "1.0.0" );
    wp_enqueue_style( 'fonts', get_template_directory_uri() . '/dist/fonts/fonts.css', [], "1.0.0" );
    wp_enqueue_script( 'glowCookies', get_template_directory_uri() . "/lib/glowCookies/glowCookies.js", array(), "1.0.0", true );
    wp_enqueue_style( 'bundle', get_template_directory_uri() . '/dist/style.css', [], "1.0.0" );
    wp_enqueue_script( 'bundle', get_template_directory_uri() . '/dist/app.js', array(), "1.0.0", true );
}
add_action( 'wp_enqueue_scripts', 'rpc_scripts' );

function rpc_theme_support() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'rpc_theme_support' );

function rpc_menus() {
  register_nav_menu('rpc-main-nav',__( 'Main Navigation' ));
  register_nav_menu('rpc-footer-nav',__( 'Footer Navigation' ));
  register_nav_menu('rpc-main-cta',__( 'Calls to action' ));
  register_nav_menu('rpc-footer-some',__( 'Social Media Icons' ));
}
add_action( 'init', 'rpc_menus' );

function rpc_menu_items( $location, $args = [] ) {

    // Get all locations
    $locations = get_nav_menu_locations();

    // Get object id by location
    $object = wp_get_nav_menu_object( $locations[$location] );

    // Get menu items by menu name
    $menu_items = wp_get_nav_menu_items( $object->name, $args );

    // Return menu post objects
    return $menu_items;
}