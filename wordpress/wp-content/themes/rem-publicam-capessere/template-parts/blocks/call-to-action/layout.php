<?php
use Ramsey\Uuid\Uuid;
$form_id = explode("_", $block["id"])[1];
$anchor = (isset($block["anchor"]) && $block["anchor"] != "") ? $block["anchor"] : "rpc-form-" . $form_id;
?>

<div class="rpc-cta-anchor alignfull" id="<?= $anchor ?>">
    <div class="rpc-cta-wrapper alignfull text-white">
        <div class="rpc-cta-outer alignwide">
            <div class="rpc-cta-content-wrapper">
                <div class="rpc-cta-content scrollAnimation" data-delay="750">
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
            <div class="rpc-cta-form-wrapper scrollAnimation" data-delay="750">
                <?php if (get_field("form_title") != "") : ?>
                    <h2 class="rpc-form-title text-2xl mb-2"><?= get_field("form_title") ?></h2>
                <?php endif; ?>
                <?php
                $i = 1;
                foreach (get_field("form_steps") as $step) : ?>
                    <form action="<?= get_field("webhook") ?>" method="POST" class="rpc-form rpc-cta-form rpc-cta-step<?= ($i > 1) ? " hidden" : "" ?>" data-step-id="<?= $step["id"] != "" ? $step["id"] : $i ?>" data-form-id="<?= $form_id ?>">
                        <div class="rpc-step-wrapper">
                            <div class="rpc-step-title">
                                <?= $step["text"] ?>
                            </div>
                            <?php foreach($step["fields"] as $field) :
                                $field["form_id"] = $form_id;
                                ?>
                                <?= get_template_part( "template-parts/blocks/call-to-action/fields/{$field["type"]}", "", $field ) ?>
                            <?php endforeach; ?>
                            <input type="hidden" name="step-id" value="<?= $step["id"] != "" ? $step["id"] : $i ?>">
                            <div class="rpc-input-wrapper fullwidth">
                                <button type="submit" class="rpc-button arrow negative line ml-auto"><?= $step["button_text"] != "" ? $step["button_text"] : "Weiter" ?></button>
                            </div>
                        </div>
                    </form>
                <?php
                $i++;
                endforeach; ?>
                <div class="rpc-cta-step rpc-thanks-step hidden" data-step-id="thanksinterface">
                    <?= the_field("share_content") ?>
                    <div class="flex flex-wrap gap-2 mt-2 share-buttons" data-sharetext="<?= get_field("share_text") ?>">
                        <a data-type="whatsapp" href="#" class="rpc-button">Auf WhatsApp teilen</a>
                        <a data-type="telegram" href="#" class="rpc-button">Auf Telegram teilen</a>
                        <a data-type="facebook" href="#" class="rpc-button">Auf Facebook teilen</a>
                        <a data-type="email" href="#" class="rpc-button rpc-button-neg rpc-button-line">Per Mail teilen</a>
                    </div>
                </div>
                <script type="text/json" id="content-<?= $form_id ?>">
{
    "uuid" : "<?= Uuid::uuid4()->toString() ?>",
    "form_id" : "<?= $form_id ?>"
}
                </script>
            </div>
        </div>
    </div>
</div>
