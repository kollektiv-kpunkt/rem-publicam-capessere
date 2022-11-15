<?php
require_once __DIR__ . '/../../../../wp-load.php';

$allposts= get_posts( array('post_type'=>'supporter','numberposts'=>-1) );
foreach ($allposts as $eachpost) {
wp_delete_post( $eachpost->ID, true );
}