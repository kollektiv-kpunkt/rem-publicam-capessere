<?php
require_once __DIR__ . '/../../../../wp-load.php';

$supporters = get_posts([
    'post_type' => 'supporter',
    'posts_per_page' => -1,
    'post_status' => 'publish'
]);
ob_start();
foreach($supporters as $supporter) {
    if (get_field("plz", $supporter->ID) == "") {
        echo($supporter->post_title . PHP_EOL);
    }
}

file_put_contents(__DIR__ . '/supportersWithoutPLZ.txt', ob_get_clean());