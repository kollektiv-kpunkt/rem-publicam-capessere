<?php
require_once(__DIR__ . "/vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

/* RemPublicamCapessere */
function rpc_scripts() {
    wp_enqueue_style( 'fa', get_template_directory_uri() . "/lib/font-awesome/css/font-awesome.min.css", [], "1.0.0" );
    wp_enqueue_style( 'theme', get_template_directory_uri() . '/dist/theme.css', [], "1.0.0" );
    wp_enqueue_style( 'fonts', get_template_directory_uri() . '/dist/fonts/fonts.css', [], "1.0.0" );
    wp_enqueue_style( 'bundle', get_template_directory_uri() . '/dist/style.css', [], "1.0.0" );
    wp_enqueue_script( 'bundle', get_template_directory_uri() . '/dist/app.js', array(), "1.0.0", true );
}
add_action( 'wp_enqueue_scripts', 'rpc_scripts' );

function rpc_theme_support() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'editor-styles' );
    add_editor_style('dist/fonts/fonts.css' );
    add_editor_style('dist/theme.css' );
    add_editor_style('dist/style.css' );
    add_editor_style('gutenberg/gutFixes.css' );
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

function rpc_htaccess( $rules ) {
    $content = <<<EOD
    \n
    Options +FollowSymLinks -MultiViews
    RewriteEngine On
    RewriteBase /
    RewriteRule ^api/?$ /wp-content/themes/rem-publicam-capessere/api/index.php [L,NC]
    RewriteRule ^api/(.+)$ /wp-content/themes/rem-publicam-capessere/api/index.php [L,NC]\n\n
    EOD;
    return $content . $rules;
}
add_filter('mod_rewrite_rules', 'rpc_htaccess');

function rpc_enable_flush_rules() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
add_action( "admin_init", 'rpc_enable_flush_rules' );

/* RPC Shortcodes */

function rpc_cookie_shortcode($atts, $content = null) {
    ob_start();
    echo('<a><button data-cc="c-settings" class="underline">' . $content . '</button></a>');
    return ob_get_clean();
}

add_shortcode('rpc-cookie-settings', 'rpc_cookie_shortcode');


// ACF

function rpc_acf() {
    define( 'MY_ACF_PATH', get_stylesheet_directory() . '/lib/acf/' );
    define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/lib/acf/' );
    include_once( MY_ACF_PATH . 'acf.php' );
    add_filter('acf/settings/url', 'my_acf_settings_url');
    function my_acf_settings_url( $url ) {
        return MY_ACF_URL;
    }

    add_filter('acf/settings/save_json', 'set_acf_json_save_folder');
    function set_acf_json_save_folder( $path ) {
        $path = MY_ACF_PATH . '/acf-json';
        return $path;
    }
    add_filter('acf/settings/load_json', 'add_acf_json_load_folder');
    function add_acf_json_load_folder( $paths ) {
        unset($paths[0]);
        $paths[] = MY_ACF_PATH . '/acf-json';;
        return $paths;
    }

    // (Optional) Hide the ACF admin menu item.
    // add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
    // function my_acf_settings_show_admin( $show_admin ) {
    //     return false;
    // }
}
rpc_acf();

add_action('acf/init', 'rpc_blocktypes');
function rpc_blocktypes() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'toggle',
            'title'             => __('Detail Toggle'),
            'description'       => __('Toggle that opens/closes based on user interaction'),
            'render_template'   => 'template-parts/blocks/toggle.php',
            'category'          => 'rpc',
            'icon'              => '',
            'keywords'          => array("toggle", "detail"),
        ));

        acf_register_block_type(array(
            'name'              => 'intro',
            'title'             => __('Intro'),
            'description'       => __('Intro on the frontpage'),
            'render_template'   => 'template-parts/blocks/intro.php',
            'category'          => 'rpc',
            'icon'              => '',
            'keywords'          => array("intro", "frontpage"),
        ));

        acf_register_block_type(array(
            'name'              => 'gallery',
            'title'             => __('Image Gallery'),
            'description'       => __('Image gallery with Description of images.'),
            'render_template'   => 'template-parts/blocks/gallery.php',
            'category'          => 'rpc',
            'icon'              => '',
            'keywords'          => array("image", "gallery", "images"),
        ));

        acf_register_block_type(array(
            'name'              => 'supporters',
            'title'             => __('Supporters grid and form'),
            'description'       => __('List supporters and a form to let people join the campaign.'),
            'render_template'   => 'template-parts/blocks/supporters.php',
            'category'          => 'rpc',
            'icon'              => '',
            'keywords'          => array("supporters", "campaign", "join"),
        ));
    }
}


// CPT
function rpc_register_cpt() {

	/**
	 * Post Type: Supporters.
	 */

	$labels = [
		"name" => __( "Supporters", "rem-publicam-capessere" ),
		"singular_name" => __( "Supporter", "rem-publicam-capessere" ),
		"menu_name" => __( "Supporters", "rem-publicam-capessere" ),
		"all_items" => __( "All Supporters", "rem-publicam-capessere" ),
		"add_new" => __( "Add new", "rem-publicam-capessere" ),
		"add_new_item" => __( "Add new Supporter", "rem-publicam-capessere" ),
		"edit_item" => __( "Edit Supporter", "rem-publicam-capessere" ),
		"new_item" => __( "New Supporter", "rem-publicam-capessere" ),
		"view_item" => __( "View Supporter", "rem-publicam-capessere" ),
		"view_items" => __( "View Supporters", "rem-publicam-capessere" ),
		"search_items" => __( "Search Supporters", "rem-publicam-capessere" ),
		"not_found" => __( "No Supporters found", "rem-publicam-capessere" ),
		"not_found_in_trash" => __( "No Supporters found in trash", "rem-publicam-capessere" ),
		"parent" => __( "Parent Supporter:", "rem-publicam-capessere" ),
		"featured_image" => __( "Featured image for this Supporter", "rem-publicam-capessere" ),
		"set_featured_image" => __( "Set featured image for this Supporter", "rem-publicam-capessere" ),
		"remove_featured_image" => __( "Remove featured image for this Supporter", "rem-publicam-capessere" ),
		"use_featured_image" => __( "Use as featured image for this Supporter", "rem-publicam-capessere" ),
		"archives" => __( "Supporter archives", "rem-publicam-capessere" ),
		"insert_into_item" => __( "Insert into Supporter", "rem-publicam-capessere" ),
		"uploaded_to_this_item" => __( "Upload to this Supporter", "rem-publicam-capessere" ),
		"filter_items_list" => __( "Filter Supporters list", "rem-publicam-capessere" ),
		"items_list_navigation" => __( "Supporters list navigation", "rem-publicam-capessere" ),
		"items_list" => __( "Supporters list", "rem-publicam-capessere" ),
		"attributes" => __( "Supporters attributes", "rem-publicam-capessere" ),
		"name_admin_bar" => __( "Supporter", "rem-publicam-capessere" ),
		"item_published" => __( "Supporter published", "rem-publicam-capessere" ),
		"item_published_privately" => __( "Supporter published privately.", "rem-publicam-capessere" ),
		"item_reverted_to_draft" => __( "Supporter reverted to draft.", "rem-publicam-capessere" ),
		"item_scheduled" => __( "Supporter scheduled", "rem-publicam-capessere" ),
		"item_updated" => __( "Supporter updated.", "rem-publicam-capessere" ),
		"parent_item_colon" => __( "Parent Supporter:", "rem-publicam-capessere" ),
	];

	$args = [
		"label" => __( "Supporters", "rem-publicam-capessere" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "supporter", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-thumbs-up",
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "supporter", $args );
}

add_action( 'init', 'rpc_register_cpt' );
