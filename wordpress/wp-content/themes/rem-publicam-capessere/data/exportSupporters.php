<?php
require_once __DIR__ . '/../../../../wp-load.php';

$supporters = get_posts([
    'post_type' => 'supporter',
    'posts_per_page' => -1,
    'post_status' => 'publish'
]);

$file = __DIR__ . '/supporters.csv';

file_put_contents($file, "");

foreach ($supporters as $supporter) {
    file_put_contents($file, $supporter->post_title . "," . get_field("plz", $supporter->ID) . ";" . PHP_EOL, FILE_APPEND);
}