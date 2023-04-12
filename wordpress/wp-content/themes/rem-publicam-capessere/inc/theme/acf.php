<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * ACF functions and installation
 *
 * @package RemPublicamCapessere
 * @version 2.0.0
 * @since 2.0.0
 */

function rpc_acf() {

    add_filter('acf/settings/save_json', 'set_acf_json_save_folder');
    function set_acf_json_save_folder( $path ) {
        $path = get_stylesheet_directory() . '/lib/acf-json';
        return $path;
    }
    add_filter('acf/settings/load_json', 'add_acf_json_load_folder');
    function add_acf_json_load_folder( $paths ) {
        unset($paths[0]);
        $paths[] = get_stylesheet_directory() . '/lib/acf-json';
        return $paths;
    }

    $blocks = glob(get_template_directory() . '/template-parts/blocks/*', GLOB_ONLYDIR);

    foreach($blocks as $block) {
        add_action( 'init', function() use ($block) {
            register_block_type( $block );
        });
    }

    if ($_ENV["APP_ENV"] === "production") {
        add_filter('acf/settings/show_admin', '__return_false');
    }

    if (!function_exists('is_plugin_active')) {
        include_once(ABSPATH . 'wp-admin/includes/plugin.php');
    }
    if (!is_plugin_active('advanced-custom-fields-pro/acf.php')) {
        if (!file_exists(ABSPATH . "/wp-content/plugins/advanced-custom-fields-pro/acf.php")) {
            chdir(ABSPATH);
            $output = shell_exec("composer install -vvv");
        }
        activate_plugin('advanced-custom-fields-pro/acf.php');
    }
}

rpc_acf();
