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
}


// Theme includes
include_once( __DIR__ . "/inc/theme/vite.php");
include_once( __DIR__ . "/inc/theme/theme-supports.php");
include_once( __DIR__ . "/inc/theme/acf.php");
include_once( __DIR__ . "/inc/theme/users.php");

// Theme functions
include_once( __DIR__ . "/inc/functions/menu-items.php");
include_once( __DIR__ . "/inc/theme/shortcodes.php");
