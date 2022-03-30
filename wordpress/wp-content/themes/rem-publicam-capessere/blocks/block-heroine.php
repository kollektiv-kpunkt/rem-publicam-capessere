<div class="HeroWrapper mb-20">
    <div class="LargeContainerWrapper">
        <div class="LargeContainerInner">
        <div id="heroine-img" class="scrollAnimation" data-delay="750">
            <div class="rpc-image-blind"></div>
            <img src="<?= block_field("heroine-img") ?>">
        </div>
        <div id="heroine-testimonial-wrapper">
            <p id="heroine-testimonial"><?= block_field("heroine-testimonial") ?></p>
            <div id="heroine-buttons" class="flex">
            <div class="ButtonWrapper"><a id="" type="submit" href="<?= block_field("heroine-button-1-link") ?>" class="rpc-button rpc-button-line rpc-button-arrow"><?= block_field("heroine-button-1-text") ?></a></div>
            <div class="ButtonWrapper"><a id="" type="submit" href="<?= block_field("heroine-button-2-link") ?>" class="rpc-button rpc-button-black rpc-button-arrow ml-6"><?= block_field("heroine-button-2-text")  ?></a></div>
            </div>
        </div>
        </div>
    </div>
</div>