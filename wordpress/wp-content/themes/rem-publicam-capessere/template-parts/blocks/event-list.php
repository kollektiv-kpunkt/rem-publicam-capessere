<?php
global $post;
$query = new WP_Query(array(
    'post_type' => 'termin',
    'posts_per_page' => -1,
    'meta_key' => 'start_date',
    'orderby' => 'start_date',
    'order' => 'ASC',
    'meta_query' => array(
        array(
            'key' => 'start_date',
            'value' => date('Y-m-d H:i:s'),
            'compare' => '>=',
            'type' => 'DATETIME'
        )
    )
));


?>
<div class="rpc-events-list flex flex-col gap-y-4">
    <?php while ($query->have_posts()) {
        $query->the_post();
        get_template_part('template-parts/elements/event-list-item');
    }
    ?>
</div>
<?php
wp_reset_postdata();
?>