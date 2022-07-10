<?php
$args = array(
	'post_type'   => 'supporter'
);
$supporters = new WP_Query( $args );
$supporters = $supporters->get_posts();
$supporters = array_values(array_filter($supporters, function($supporter) {
    return $supporter->post_content != "";
}));
?>