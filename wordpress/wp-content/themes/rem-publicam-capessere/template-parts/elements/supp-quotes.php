<?php
$args = array(
	'post_type'   => 'supporter',
    'post_status' => 'publish',
    'posts_per_page' => 10,
    'orderby' => 'rand',
    "tax_query" => array(
        array(
            "taxonomy" => "category",
            "field" => "slug",
            "terms" => array("testimonial")
        )
    )
);
$supporters = new WP_Query( $args );
$supporters = $supporters->get_posts();
?>

<div class="rpc-supp-quotes">
    <section class="splide" aria-labelledby="carousel-heading">
      <div class="splide__track">
            <div class="splide__list">
                <?php
                foreach ($supporters as $supporter) :
                ?>
                <div class="splide__slide rpc-supp-testimonial">
                    <div class="rpc-supp-testimonial-img">
                        <?php echo get_the_post_thumbnail($supporter->ID, 'medium_large'); ?>
                    </div>
                    <div class="rpc-supp-testimonial__text">
                        <div class="leading-tight rpc-supp-testimonial__content<?= (strpos($supporter->post_content, "<!--") !== FALSE) ? " rpc-supp-testimonial__content-block" : ""; ?>">
                            <?php echo $supporter->post_content; ?>
                        </div>
                        <div class="rpc-supp-testimonial__author leading-none mt-4">
                            <b><?php echo $supporter->post_title; ?><br></b>
                            <?= get_field("position", $supporter->ID); ?>
                        </div>
                    </div>
                </div>
                <?php
                endforeach;
                ?>
            </div>
      </div>
    </section>
</div>