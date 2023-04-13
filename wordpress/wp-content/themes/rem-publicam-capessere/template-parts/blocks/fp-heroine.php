<div class="HeroWrapper mb-20">
    <div class="MediumContainerWrapper">
        <div class="MediumContainerInner">
        <div id="heroine-img" class="scrollAnimation" data-delay="750">
            <div class="rpc-image-blind"></div>
            <img src="<?= get_field("image")["url"] ?>">
        </div>
        <div id="heroine-testimonial-wrapper">
            <div id="heroine-testimonial"><?= get_field("testimonial") ?></div>
            <div id="heroine-buttons" class="flex flex-col" style="row-gap: 0.5rem">
                <?php
                $buttons = get_field("buttons");
                foreach ($buttons as $button) {
                    ?>
                    <div class="ButtonWrapper"><a href="<?= $button["button_link"] ?>" class="rpc-button <?= $button["button_classes"] ?> rpc-button-arrow"><?= $button["button_text"] ?></a></div>
                    <?php
                }
                ?>
            </div>
        </div>
        </div>
    </div>
</div>