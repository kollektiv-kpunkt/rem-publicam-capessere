<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Theme supports
 *
 * @package RemPublicamCapessere
 * @version 2.0.0
 * @since 2.0.0
 */

function rpc_theme_support() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    $file = glob( get_stylesheet_directory() . '/dist/assets/main-*.css' );
    $file = basename( $file[0] );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'dist/assets/' . $file );
    add_editor_style('gutenberg/fixes.css' );
    add_theme_support( 'align-wide' );
    add_theme_support( "editor-color-palette", array(
        [
            "slug" => "rpc-primary",
            "color" => "#e53136",
            "name" => __("Primary Color", "rpc")
        ],
        [
            "slug" => "rpc-black",
            "color" => "#000000",
            "name" => __("Black", "rpc")
        ],
        [
            "slug" => "rpc-white",
            "color" => "#ffffff",
            "name" => __("White", "rpc")
        ]
    ));
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => __('Small', 'pnm'),
            'size' => 16,
            'slug' => 'small'
        ),
        array(
            'name' => __('Medium', 'pnm'),
            'size' => "1.3rem",
            'slug' => 'medium'
        ),
        array(
            'name' => __('Large', 'pnm'),
            'size' => "2.25rem",
            'slug' => 'large'
        ),
        array(
            'name' => __('x-Large', 'pnm'),
            'size' => "3rem",
            'slug' => 'x-large'
        )
    ));

    register_nav_menu('rpc-main-nav',__( 'Main Navigation' ));
    register_nav_menu('rpc-footer-nav',__( 'Footer Navigation' ));
    register_nav_menu('rpc-main-cta',__( 'Calls to action' ));
    register_nav_menu('rpc-footer-some',__( 'Social Media Icons' ));
}
add_action( 'after_setup_theme', 'rpc_theme_support' );


add_action( 'admin_menu', 'rpc_register_supporters_menu_link' );
function rpc_register_supporters_menu_link(){
    add_menu_page(
      'rpc-supporters-link',
      'Supporters',
      'manage_options',
      $_ENV["RPC_ADMIN_URL"] . 'admin/sites/' . explode("https://", get_bloginfo('url'))[1] . '/supporters',
      '',
      'dashicons-external', 5
    );
}
