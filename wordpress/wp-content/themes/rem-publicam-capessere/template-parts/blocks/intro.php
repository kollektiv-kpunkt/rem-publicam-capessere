<div class="IntroWrapper my-14" id="ueber-mich">
    <div class="MediumContainerWrapper">
        <div class="MediumContainerInner">
        <?php
        if (get_field("title") != "") :
        ?>
        <h1 class="text-4xl text-primary"><?= get_field("title") ?></h1>
        <?php
        endif;
        ?>
        <div class="ColumnWrapper">
            <div id="intro-container">
                <div class="mb-4 text-xl"><?= get_field("content")?></div>
                <div id="intro-button-wrapper" class="flex gap-4">
                    <?php
                    $buttons = get_field("buttons");
                    foreach($buttons as $button) :
                    ?>
                    <div class="ButtonWrapper"><a href="<?= $button["button_link"] ?>" class="rpc-button rpc-button-arrow <?= $button["button_classes"] ?>"><?= $button["button_text"] ?></a></div>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>