<div class="rpc-event-item p-4 bg-gray-100">
    <p class="text-xl font-bold text-primary"><?= the_title() ?></p>
    <p class="opacity-50 italic mt-2"><?= the_field("start_date", $post->ID) ?> | <?= the_field("ort", $post->ID) ?></p>
    <?php
    if (get_field("excerpt", $post->ID) != "" || has_post_thumbnail( $post->ID )) :
        $classes = "rpc-event-content mt-4";
        (get_field("excerpt", $post->ID) != "") ? $classes .= " has_excerpt" : "";
        (has_post_thumbnail( $post->ID )) ? $classes .= " has_image" : "";
        ?>
        <div class="<?= $classes ?>">
            <?php if (has_post_thumbnail( $post->ID ) ): ?>
                <img src="<?= get_the_post_thumbnail_url($post->ID, 'large') ?>" alt="<?= the_title() ?>">
            <?php endif; ?>
            <?php if (get_field("excerpt", $post->ID) != "") : ?>
                <p><?= the_field("excerpt", $post->ID) ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if (get_field("event_link", $post->ID) != "") : ?>
        <a href="<?= the_field("event_link", $post->ID) ?>" target="_blank" rel="noopener noreferrer"  class="mt-4 rpc-button rpc-button-arrow ml-auto">Mehr erfahren</a>
    <?php endif; ?>
</div>
