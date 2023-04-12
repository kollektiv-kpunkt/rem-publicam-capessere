<?php
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="page-container">
        <div class="page-content-container main-content-container">
            <div class="alignfull page-heroine-container<?php if (has_post_thumbnail()): echo(" has-thumbnail"); else: echo(" no-thumbnail"); endif; ?>">
                <div class="page-heroine alignwide">
                    <?php if (has_post_thumbnail()): ?>
                    <div class="page-heroine-thumbnail-container">
                        <?php the_post_thumbnail(); ?>
                        <div class="rpc-image-blind"></div>
                        <div class="page-heroine-thumbnail-gradient"></div>
                        <h1 class="text-5xl" id="page-heroine-title"><?php the_title(); ?></h1>
                    </div>
                    <?php else: ?>
                    <h1 class="text-5xl" id="page-heroine-title"><?php the_title(); ?></h1>
                    <?php endif; ?>
                </div>
            </div>
            <?php the_content(); ?>
        </div>
    </div>

    <?php endwhile; else: ?>

      <h2><?php esc_html_e( '404 Error', 'phpforwp' ); ?></h2>
      <p><?php esc_html_e( 'Sorry, content not found.', 'phpforwp' ); ?></p>

<?php endif;
get_footer()
?>
