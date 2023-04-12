<?php
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="main-content-container">
        <?php the_content(); ?>
    </div>

    <?php endwhile; else: ?>

      <h2><?php esc_html_e( '404 Error', 'phpforwp' ); ?></h2>
      <p><?php esc_html_e( 'Sorry, content not found.', 'phpforwp' ); ?></p>

<?php endif;
get_footer()
?>
