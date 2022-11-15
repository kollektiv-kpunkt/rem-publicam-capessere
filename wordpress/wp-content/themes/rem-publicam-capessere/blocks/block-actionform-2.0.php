<?php
$afconfig = json_decode(file_get_contents(get_template_directory(  ) . $_ENV["AFconfig"]), true);
$formid = uniqid();
?>
<div class="rpc-actionform-container" data-formtag="<?= $afconfig["misc"]["formTag"]?>" data-formid="<?= $formid?>">
    <?php
    $i = 0;
    foreach ($afconfig["steps"] as $id => $step) :
    unset($title);
    unset($text);
    if (isset($step["title"])) {
        $title = "echo(" . $step["title"] . ");";
    }
    if (isset($step["text"])) {
        $text = "echo(" . $step["text"] . ");";
    }
    ?>
        <div class="rpc-actionform-step" data-step-id="<?= $id ?>"<?= ($i > 0) ? " hidden" : ""?> data-step-type="<?= $step["type"] ?>"<?= (isset($step["end"])) ? " data-form-end='1'" : "" ?>>
        <?php
        if (isset($title)) :
        ?>
        <h2 class="text-3xl text-white mb-1 cta-title-desk"><?php eval($title) ?></h2>
        <?php
        endif;
        if (isset($text)) :
        ?>
        <p class="text-end text-xl text-white mb-4"><?php eval($text) ?></p>
        <?php
        endif;
        if ($step["type"] == "form") :
        ?>
            <form class="rpc-actionform-form flex flex-wrap gap-x-6 gap-y-5">
            <?php
            foreach ($step["fields"] as $name => $field) :
                ?>
                <div class="input-wrapper <?= $field["type"] ?><?= (isset($field["fullwidth"])) ? " fullwidth" : "" ?>">
                    <?php
                    if ($field["type"] == "checkbox") :
                    ?>
                    <input type="checkbox" name="<?= $name ?>" id="<?= $name ?>-<?=$formid?>" class="<?= $name ?>" hidden<?= (isset($field["checked"])) ? " checked" : "" ?><?= (isset($field["mmerge"])) ? " data-mmerge='{$field["mmerge"]}'" : "" ?><?= (isset($field["mtag"])) ? " data-mtag='{$field["mtag"]}'" : "" ?><?= (isset($field["is-optin"])) ? " data-is-optin='true'" : "" ?><?= (isset($field["base_config"])) ? " data-base-config='" . json_encode($field["base_config"]) . "'" : "" ?>>
                    <label for="<?= $name ?>-<?=$formid?>" class="block leading-tight"><?= $field["label"] ?></label>
                    <?php
                    elseif ($field["type"] == "textarea") :
                    ?>
                    <label for="<?= $name ?>-<?=$formid?>" class="text-xl"><?= $field["label"] ?></label>
                    <textarea name="<?= $name ?>" class="rpc-textarea-autosize" id="<?= $name ?>-<?=$formid?>"<?= (isset($field["class"])) ? " class='{$field["class"]}'" : "" ?><?= (isset($field["required"])) ? " required" : "" ?><?= (isset($field["max-length"])) ? " maxlength='{$field["max-length"]}'" : "" ?><?= (isset($field["mmerge"])) ? " data-mmerge='{$field["mmerge"]}'" : "" ?><?= (isset($field["mtag"])) ? " data-mtag='{$field["mtag"]}'" : "" ?><?= (isset($field["is-address"])) ? " data-is-address='true'": "" ?><?= (isset($field["is-address"])) ? " data-address-field='{$field["address-field"]}'": "" ?><?= (isset($field["prefill"])) ? " data-prefill='{$field["prefill"]["type"]}::{$field["prefill"]["value"]}'": "" ?><?= (isset($field["base_config"])) ? " data-base-config='" . json_encode($field["base_config"]) . "'" : "" ?>><?= isset($field["placeholder"]) ? $field["placeholder"] : "" ?></textarea>
                    <?php
                    else:
                    ?>
                    <label for="<?= $name ?>-<?=$formid?>" class="text-xl"><?= $field["label"] ?></label>
                    <input type="<?= $field["type"]?>" name="<?= $name ?>" id="<?= $name ?>-<?=$formid?>"<?= (isset($field["class"])) ? " class='{$field["class"]}'" : "" ?><?= (isset($field["required"])) ? " required" : "" ?><?= (isset($field["mmerge"])) ? " data-mmerge='{$field["mmerge"]}'" : "" ?><?= (isset($field["mtag"])) ? " data-mtag='{$field["mtag"]}'" : "" ?><?= (isset($field["is-address"])) ? " data-is-address='true'": "" ?><?= (isset($field["is-address"])) ? " data-address-field='{$field["address-field"]}'": "" ?><?= (isset($field["prefill"])) ? " data-prefill='{$field["prefill"]["type"]}::{$field["prefill"]["value"]}'": "" ?><?= (isset($field["base_config"])) ? " data-base-config='" . json_encode($field["base_config"]) . "'" : "" ?><?= (isset($field["img_crop"])) ? " data-img-crop='{$field["img_crop"]}'" : "" ?><?= isset($field["placeholder"]) ? " placeholder='{$field["placeholder"]}'" : "" ?>>
                    <?php
                    endif;
                    if ($field["type"] == "file" && isset($field["img_crop"]) && $field["img_crop"] == "modal") :
                        ?>
                        <div class="rpc-img-upload-modal-outer" data-element-type="modal" hidden>
                            <div class="rpc-img-upload-modal-inner p-6 bg-white">
                                <div class="rpc-img-upload-modal-img-wrapper">
                                    <img src="" alt="" class="rpc-img-upload-modal-img">
                                </div>
                                <div class="flex flex-wrap gap-x-4 mt-4 justify-end">
                                    <button type="button" class="rpc-button rpc-button-line rpc-img-upload-modal-cancel">Abbrechen</button>
                                    <button type="button" class="rpc-button rpc-button-next rpc-img-upload-modal-crop">Zuschneiden</button>
                                </div>
                            </div>
                        </div>
                        <?php
                    endif;
                    ?>
                </div>
                <?php
            endforeach;
            ?>
            <div class="input-wrapper fullwidth">
                <button type="submit" class="rpc-button rpc-button-arrow rpc-button-neg rpc-button-line ml-auto" data-next='<?= json_encode($step["next"]) ?>'><?= $step["submit"] ?></button>
            </div>
            </form>
        <?php
        elseif ($step["type"] == "select") :
        ?>
        <div class="rpc-actionform-select-wrapper">
            <div class="rpc-actionform-selection flex gap-6 mt-4" data-selection-id="<?= $step["selection"]["id"]?>">
            <?php
            foreach ($step["selection"]["choices"] as $key => $choice) :
            ?>
                <a href="#" class="input-wrapper rpc-button rpc-actionform-choice rpc-button-neg rpc-button-line" data-next="<?= $choice["next"] ?>"<?= (isset($choice["mtag"])) ? " data-mtag='{$choice["mtag"]}'" : "" ?> data-value="<?= $key ?>"><?= $choice["label"] ?></a>
                <?php
            endforeach;
            ?>
            </div>
        </div>
        <?php
        elseif ($step["type"] == "redirect") :
            if (isset($step["params"])) {
                $params = json_encode($step["params"]);
            }
        ?>
        <div class="rpc-actionform-redirect" data-url="<?= $step["url"] ?>" data-target="<?= $step["target"] ?>" data-next="<?= $step["next"] ?>"<?= (isset($params)) ? " data-url-params='{$params}'" : "" ?>><em>Redirecting...</em></div>
        <?php
        elseif ($step["type"] == "thanksInterface") :
        ?>
        <div class="flex flex-wrap gap-2 mt-2 share-buttons" data-sharetext="<?= $step["sharetext"] ?>">
            <div class="ButtonWrapper">
                <a data-type="whatsapp" href="#" class="rpc-button">Auf WhatsApp teilen</a>
            </div>
            <div class="ButtonWrapper">
                <a data-type="telegram" href="#" class="rpc-button">Auf Telegram teilen</a>
            </div>
            <div class="ButtonWrapper">
                <a data-type="facebook" href="#" class="rpc-button" >Auf Facebook teilen</a>
            </div>
            <div class="ButtonWrapper">
                <a data-type="email" href="#" class="rpc-button rpc-button-neg rpc-button-line">Per Mail teilen</a>
            </div>
        </div>
        <?php
        endif;
        ?>
        </div>
    <?php
    $i++;
    endforeach;
    ?>
</div>
<div id="currentFormdata" class="p-4 bg-black text-white mt-16" hidden>
    Sent Formdata:
    <span id="currentFormdata-content" class="block">{}</span>
</div>