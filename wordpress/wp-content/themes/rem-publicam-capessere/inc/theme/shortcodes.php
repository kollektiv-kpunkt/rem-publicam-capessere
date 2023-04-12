<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Shortcodes for the theme
 *
 * @package RemPublicamCapessere
 * @version 2.0.0
 * @since 2.0.0
 */


/**
 * Shortcode for the cookie settings button
 *
 * @param array $atts
 * @param string $content
 * @return string
 */
function rpc_cookie_shortcode($atts, $content = null) {
    ob_start();
    echo('<a><button data-cc="c-settings" class="underline">' . $content . '</button></a>');
    return ob_get_clean();
}

add_shortcode('rpc-cookie-settings', 'rpc_cookie_shortcode');
