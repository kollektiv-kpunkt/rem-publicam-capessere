<div class="target-wrapper" id="mitmachen">
    <div class="CallToActionWrapper my-20">
        <div class="LargeContainerWrapper">
            <div class="LargeContainerInner">
                <div class="ColumnWrapper">
                    <div class="cols-2 columns">
                        <div class="scrollAnimation my-auto cta-img" data-delay="500">
                            <div class="cta-img-wrapper">
                                <div class="cta-img-inner">
                                    <img src="<?=block_field("cta-image")?>">
                                    <div class="rpc-image-blind"></div>
                                    <div class="cta-image-gradient"></div>
                                    <div class="cta-img-content">
                                        <h2 class="text-4xl mb-0 cta-title-mobile"><?=block_field("cta-title")?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-14 scrollAnimation my-auto cta-form" data-delay="500">
                            <div class="cta-form-wrapper">
                                <?php
                                if ($_ENV["AFversion"] == "legacy") :
                                    include(get_template_directory() . "/blocks/block-call-to-action-legacy.php");
                                else:
                                    include(get_template_directory() . "/blocks/block-actionform.php");
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>