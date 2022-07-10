<?php
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="page-container">
        <div class="page-heroine-container<?php if (has_post_thumbnail()): echo(" has-thumbnail"); else: echo(" no-thumbnail"); endif; ?>">
            <div class="page-heroine MediumContainerInner">
                <?php if (has_post_thumbnail()): ?>
                <div class="page-heroine-thumbnail-container">
                    <?php the_post_thumbnail(); ?>
                    <div class="rpc-image-blind"></div>
                    <div class="page-heroine-thumbnail-gradient"></div>
                </div>
                <?php endif;
                if (strlen(get_the_title()) > 20):
                    $longtitle = true;
                endif;
                ?>
                <h1 class="text-5xl" id="page-heroine-title<?= (isset($longtitle)) ? print(" page-heroine-longtitle") : ""?>"><?php the_title(); ?></h1>
            </div>
        </div>
        <div class="page-content-container">
            <div class="page-content SmallContainerInner">
                <?php the_content(); ?>
            </div>
        </div>
    </div>

    <?php endwhile; else: ?>

      <h2><?php esc_html_e( '404 Error', 'phpforwp' ); ?></h2>
      <p><?php esc_html_e( 'Sorry, content not found.', 'phpforwp' ); ?></p>

<?php endif;
get_footer()
?>