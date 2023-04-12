<div class="rpc-input-wrapper type-text <?= $args["width"] ?>">
    <label for="<?= $args["name"] ?? strtolower($args["label"]) ?>-<?= $args["form_id"] ?>" class="text-xl"><?= $args["label"] ?></label>
    <input type="text" name="<?= $args["name"] ?? strtolower($args["label"]) ?>" id="<?= $args["name"] ?? strtolower($args["label"]) ?>-<?= $args["form_id"] ?>"<?= $args["required"] == "required" ? " required" : "" ?> placeholder="<?= $args["placeholder"] ?? "" ?>" class="rpc-input">
</div>
