<div class="IntroWrapper my-14" id="ueber-mich">
    <div class="MediumContainerWrapper">
        <div class="MediumContainerInner">
        <h1 class="text-4xl text-primary"><?= block_field("intro-title") ?></h1>
        <div class="ColumnWrapper">
            <div id="intro-container">
                <p class="mb-4 text-xl"><?= block_field("intro-text")?></p>
                <div id="intro-button-wrapper" class="flex gap-4">
                    <div class="ButtonWrapper"><a type="submit" href="<?= block_field("intro-button-link") ?>" class="rpc-button rpc-button-black rpc-button-arrow"><?= block_field("intro-button-text") ?></a></div>
                    <div class="ButtonWrapper"><a type="submit" href="<?= block_field("intro-button-2-link") ?>" class="rpc-button rpc-button-arrow"><?= block_field("intro-button-2-text") ?></a></div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>