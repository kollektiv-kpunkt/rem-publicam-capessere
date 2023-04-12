<?php
/**
 * Install composer dependencies
 *
 * @package RemPublicamCapessere
 * @version 2.0.0
 * @since 2.0.0
 */

chdir(get_stylesheet_directory(  ));
$output = shell_exec("composer install -vvv");
if (file_exists(get_stylesheet_directory(  ) . '/vendor/autoload.php')) {
    echo "Composer install successful";
    header("Location: " . get_site_url(  ));
} else {
    echo "Composer install failed";
    exit;
}

