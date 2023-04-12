<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

/*
 * VITE & Tailwind JIT development
 * Inspired by https://github.com/andrefelipe/vite-php-setup
 *
 */

// enqueue hook
add_action( 'wp_enqueue_scripts', function() {

    if ($_ENV["APP_ENV"] !== "production") {

        function vite_head_module_hook() {
            echo '<script type="module" crossorigin src="' . $_ENV["APP_URL"] . ":5173/" . $_ENV["VITE_ENTRY_POINT"] . '"></script>';
        }
        add_action('wp_footer', 'vite_head_module_hook');

    } else {

        $manifest = json_decode( file_get_contents( get_template_directory() . '/' . $_ENV["DIST_DEF"] . '/manifest.json'), true );
        if (is_array($manifest)) {


            $js_dependencies = explode(",", $_ENV["JS_DEPENDENCIES"]);
            if ($js_dependencies[0] === "") {
                $js_dependencies = null;
            }
            foreach ($manifest as $key => $value) {
                if (strpos($key, '.js') !== false) {

                    wp_enqueue_script( $key, get_template_directory_uri() . '/' . $_ENV["DIST_DEF"] . "/" . $value["file"], $js_dependencies, null, true );
                } else {
                    wp_enqueue_style( $key, get_template_directory_uri() . '/' . $_ENV["DIST_DEF"] . "/" . $value["file"], array(), null );
                }
            }

        }

    }
});


add_action( 'enqueue_block_editor_assets', function () {
    if ($_ENV["APP_ENV"] !== "production") {
        echo '<script type="module" crossorigin src="' . $_ENV["APP_URL"] . ":5173/" . $_ENV["VITE_ENTRY_POINT"] . '"></script>';
    } else {
        $manifest = json_decode( file_get_contents( get_template_directory() . '/' . $_ENV["DIST_DEF"] . '/manifest.json'), true );
        if (is_array($manifest)) {
            foreach ($manifest as $key => $value) {
                if (strpos($key, '.js') !== false) {
                    wp_enqueue_script( $key, get_template_directory_uri() . '/' . $_ENV["DIST_DEF"] . "/" . $value["file"], array(), null, true );
                } else {
                    wp_enqueue_style( $key, get_template_directory_uri() . '/' . $_ENV["DIST_DEF"] . "/" . $value["file"], array(), null );
                }
            }
        }
    }
    wp_enqueue_style( "fixes", get_template_directory_uri() . '/gutenberg/fixes.css', array(), null);
});