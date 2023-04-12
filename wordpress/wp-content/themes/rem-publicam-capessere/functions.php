<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Theme installation

if (!file_exists(get_stylesheet_directory(  ) . '/vendor/autoload.php')) {
    include_once( __DIR__ . "/inc/installation/composer.php");
}
require_once(__DIR__ . "/vendor/autoload.php");
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
if (!isset($_ENV["RPC_API_KEY"]) || $_ENV["RPC_API_KEY"] == "") {
    include_once( __DIR__ . "/inc/installation/api.php");
    $key = registerAPI();
    if (!file_exists(__DIR__ . "/.env")) {
        copy(__DIR__ . "/.env.example", __DIR__ . "/.env");
    }
    $env = file_get_contents(__DIR__ . "/.env");
    if (strpos($env, "RPC_API_KEY=" ) !== false) {
        $env = str_replace("RPC_API_KEY=", "RPC_API_KEY=" . $key, $env);
        file_put_contents(__DIR__ . "/.env", $env);
    } else {
        file_put_contents(__DIR__ . "/.env", $env . "\nRPC_API_KEY=" . $key, FILE_APPEND);
    }
}


// Theme includes
include_once( __DIR__ . "/inc/theme/vite.php");
include_once( __DIR__ . "/inc/theme/theme-supports.php");
include_once( __DIR__ . "/inc/theme/acf.php");

// Theme functions
include_once( __DIR__ . "/inc/functions/menu-items.php");
include_once( __DIR__ . "/inc/theme/shortcodes.php");

// add_action('acf/init', 'rpc_blocktypes');
// function rpc_blocktypes() {

//     // Check function exists.
//     if( function_exists('acf_register_block_type') ) {
//         acf_register_block_type(array(
//             'name'              => 'toggle',
//             'title'             => __('Detail Toggle'),
//             'description'       => __('Toggle that opens/closes based on user interaction'),
//             'render_template'   => 'template-parts/blocks/toggle.php',
//             'category'          => 'rpc',
//             'icon'              => '',
//             'keywords'          => array("toggle", "detail"),
//         ));

//         acf_register_block_type(array(
//             'name'              => 'intro',
//             'title'             => __('Intro'),
//             'description'       => __('Intro on the frontpage'),
//             'render_template'   => 'template-parts/blocks/intro.php',
//             'category'          => 'rpc',
//             'icon'              => '',
//             'keywords'          => array("intro", "frontpage"),
//         ));

//         acf_register_block_type(array(
//             'name'              => 'gallery',
//             'title'             => __('Image Gallery'),
//             'description'       => __('Image gallery with Description of images.'),
//             'render_template'   => 'template-parts/blocks/gallery.php',
//             'category'          => 'rpc',
//             'icon'              => '',
//             'keywords'          => array("image", "gallery", "images"),
//         ));

//         acf_register_block_type(array(
//             'name'              => 'supporters',
//             'title'             => __('Supporters grid and form'),
//             'description'       => __('List supporters and a form to let people join the campaign.'),
//             'render_template'   => 'template-parts/blocks/supporters.php',
//             'category'          => 'rpc',
//             'icon'              => '',
//             'keywords'          => array("supporters", "campaign", "join"),
//         ));

//         acf_register_block_type(array(
//             'name'              => 'topics',
//             'title'             => __('Topics'),
//             'description'       => __('Topics for homepage'),
//             'render_template'   => 'template-parts/blocks/topics.php',
//             'category'          => 'rpc',
//             'icon'              => '',
//             'keywords'          => array("topics", "homepage"),
//         ));

//         acf_register_block_type(array(
//             'name'              => 'static_gallery',
//             'title'             => __('Static Gallery'),
//             'description'       => __('Static Gallery'),
//             'render_template'   => 'template-parts/blocks/static_gallery.php',
//             'category'          => 'rpc',
//             'icon'              => '',
//             'keywords'          => array("gallery", "images"),
//             'supports'          => array('anchor' => true),
//         ));

//         acf_register_block_type(array(
//             'name'              => 'fp-heroine',
//             'title'             => __('Frontpage Heroine'),
//             'description'       => __('Heroine for frontpage'),
//             'render_template'   => 'template-parts/blocks/fp-heroine.php',
//             'category'          => 'rpc',
//             'icon'              => '',
//             'keywords'          => array("heroine", "frontpage"),
//             'supports'          => array('anchor' => true),
//         ));
//     }
// }
