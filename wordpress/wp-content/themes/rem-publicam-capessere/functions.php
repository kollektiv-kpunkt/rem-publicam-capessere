<?php
/* RemPublicamCapessere */

function rpc_scripts() {
    // wp_enqueue_style( 'tailwind-bundle', "https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" );
    wp_enqueue_style( 'theme', get_template_directory_uri() . '/dist/theme.css' );
    wp_enqueue_style( 'bundle', get_template_directory_uri() . '/dist/style.css' );
    wp_enqueue_script( 'bundle', get_template_directory_uri() . '/dist/app.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'rpc_scripts' );