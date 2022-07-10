<div class="mt-4 mb-24">
    <div class="rpc-gallery-slider-wrapper">
        <div class="rpc-gallery-inner">
            <?php
            $slides = get_field("images");
            foreach ($slides as $slide):
            $img = $slide["image"];
            $img_src = wp_get_attachment_image_url( $img["ID"], 'medium_large' );
            $img_srcset = wp_get_attachment_image_srcset( $img["ID"], 'medium_large' );
            $desc = $slide["description"];
            ?>
            <div class="rpc-gallery-slide">
                <div class="rpc-gallery-image">
                    <img src="<?php echo esc_url( $img_src ); ?>"
                    srcset="<?php echo esc_attr( $img_srcset ); ?>"
                    sizes="(max-width: 50em) 87vw, 680px" alt="<?= $img["title"] ?>" loading="lazy">
                </div>
                <div class="rpc-gallery-description-wrapper p-4 bg-gray-100 mt-6">
                    <div class="rpc-gallery-description text-sm">
                        <?= $desc ?>
                    </div>
                </div>
            </div>
            <?php
            endforeach;
            ?>
        </div>
    </div>
</div>