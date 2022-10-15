<?php
$args = array(
	'post_type'   => 'supporter',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'order' => 'ASC',
    'orderby' => 'title',
);
$supporters = new WP_Query( $args );
$supporters = $supporters->get_posts();
?>

<p class="rpc-supp-list text-xs mt-8">
    <?php
    $i = 1;
    foreach($supporters as $supporter) :
    ?>
    <b><?php echo $supporter->post_title ?>,</b><?= ($supporter->position !== "" && $supporter->position !== " ") ? " " . $supporter->position . ", ": "" ?> <?= $supporter->plz ?> <?= $supporter->city ?><?= ($i < count($supporters)) ? ";" : "" ?>
    <?php
    $i++;
    endforeach;
    ?>
</p>