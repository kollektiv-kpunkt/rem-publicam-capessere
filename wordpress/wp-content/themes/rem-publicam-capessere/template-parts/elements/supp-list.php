<?php
$args = array(
	'post_type'   => 'supporter'
);
$supporters = new WP_Query( $args );
$supporters = $supporters->get_posts();
?>