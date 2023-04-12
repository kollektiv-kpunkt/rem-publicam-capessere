<?php
$form_id = explode("_", $block["id"])[1];
$anchor = (isset($block["anchor"]) && $block["anchor"] != "") ? $block["anchor"] : "rpc-form-" . $form_id;
?>

<div class="rpc-cta-anchor alignfull" id="<?= $anchor ?>">
    <div class="rpc-cta-wrapper alignfull text-white">
        <div class="rpc-cta-outer alignwide">
            <div class="rpc-cta-content-wrapper">
                <div class="rpc-cta-content">
                    <?php
                    $imageID = get_field("image")["ID"];
                    ?>
                    <img src="<?= wp_get_attachment_image_src($imageID, "medium_large")[0] ?>" srcset="<?= wp_get_attachment_image_srcset($imageID, "full") ?>" alt="Get active!">
                    <div class="rpc-cta-content-container text-end p-6">
                        <?= get_field("content") ?>
                    </div>
                    <div class="rpc-image-blind"></div>
                    <div class="rpc-cta-content-blind"></div>
                </div>
            </div>
            <div class="rpc-cta-form-wrapper">
                <?php if (get_field("form_title") != "") : ?>
                    <h2 class="rpc-form-title text-2xl mb-6"><?= get_field("form_title") ?></h2>
                <?php endif; ?>
                <?php
                $i = 1;
                foreach (get_field("form_steps") as $step) : ?>
                    <form action="<?= get_field("webhook") ?>" method="POST" class="rpc-form rpc-api-form<?= ($i > 1) ? " hidden" : "" ?>" data-step-id="<?= $i ?>">
                        <div class="rpc-step-wrapper">
                            <?php foreach($step["fields"] as $field) :
                                $field["form_id"] = $form_id;
                                ?>
                                <?= get_template_part( "template-parts/blocks/call-to-action/fields/{$field["type"]}", "", $field ) ?>
                            <?php endforeach; ?>
                            <input type="hidden" name="step-id" value="<?= $i ?>">
                            <div class="rpc-input-wrapper fullwidth">
                                <button type="submit" class="rpc-button arrow negative line ml-auto">Ich bin dabei</button>
                            </div>
                        </div>
                    </form>
                <?php
                $i++;
                endforeach; ?>
            </div>
        </div>
    </div>
</div>
