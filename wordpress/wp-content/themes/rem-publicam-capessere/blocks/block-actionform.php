<?php
$afconfig = json_decode(file_get_contents(get_template_directory(  ) . $_ENV["AFconfig"]), true);
$formid = rand(1, 99999);
?>

<form class="actionform" data-endpoint="/api/v1/actionform/">
    <?php
    $i = 0;
    foreach ($afconfig["steps"] as $id => $step) :
        unset($title);
        unset($text);
        if (isset($step["title"]) && isset($step["text"])) {
            $title = "echo(" . $step["title"] . ");";
            $text = "echo(" . $step["text"] . ");";
        }
    ?>
    <div class="CtAStep" data-step-id="form-<?= $id ?>"<?= ($i > 0) ? " hidden" : "" ?>>
        <?php
        if (isset($title) && isset($text)) :
        ?>
        <h2 class="text-3xl text-white mb-1 cta-title-desk"><?php eval($title) ?></h2>
        <p class="text-end text-xl text-white mb-4"><?php eval($text) ?></p>
        <div class="StepWrapper">
        <?php
        endif;
        ?>
        <?php
        if ($step["type"] == "form") :
            foreach ($step["fields"] as $name => $field) :
                ?>
                <div class="input-wrapper <?= $field["type"] ?><?= ($field["fullwidth"]) ? " fullwidth" : "" ?>">
                    <?php
                    if ($field["type"] == "checkbox") :
                    ?>
                    <input type="checkbox" name="<?= $name ?>" id="<?= $name ?>-<?=$formid?>" class="<?= $name ?>" hidden<?= ($field["checked"]) ? " checked" : "" ?>>
                    <label for="<?= $name ?>-<?=$formid?>" class="block leading-tight"><?= $field["label"] ?></label>
                    <?php
                    else:
                    ?>
                    <label for="<?= $name ?>" class="text-xl"><?= $field["label"] ?></label>
                    <input type="text" name="<?= $name ?>" id="<?= $name ?>"<?= ($field["required"]) ? " required" : "" ?><?= ($field["value"]) ?  " value=" . $field["value"] : "" ?>>
                    <?php
                    endif;
                    ?>
                </div>
                <?php
            endforeach;
        ?>
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
        <?php
        if ($i < count($afconfig["steps"]) - 1) :
        ?>
        <div class="ButtonWrapper"><button type="submit" href="#"
            class="rpc-button rpc-button-arrow rpc-button-neg rpc-button-line"><?= $step["submit"] ?></button>
        </div>
        <?php
        endif;
        ?>
        </div>
    </div>
    <?php
    $i++;
    endforeach;
    ?>
</form>