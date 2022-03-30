<div class="IntroWrapper my-14" id="ueber-mich">
    <div class="MediumContainerWrapper">
        <div class="MediumContainerInner">
        <h1 class="text-4xl mb-8 text-primary"><?= block_field("intro-title") ?></h1>
        <div class="ColumnWrapper">
            <div class="cols-3 columns layout-1_2">
            <div id="image-wrapper">
                <div id="image-container">
                <img src="<?= block_field("intro-image") ?>" alt="Candidate Jacqueline Fehr">
                <div class="rpc-image-blind"></div>
                </div>
            </div>
            <div id="intro-container">
                <p class="mb-4 text-xl"><?= block_field("intro-text")?></p>
                <div class="ButtonWrapper"><a type="submit" href="<?= block_field("intro-button-link") ?>" class="rpc-button rpc-button-black rpc-button-arrow"><?= block_field("intro-button-text") ?></a></div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>