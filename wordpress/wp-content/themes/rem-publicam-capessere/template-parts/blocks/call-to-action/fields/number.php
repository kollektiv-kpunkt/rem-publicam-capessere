<div class="rpc-input-wrapper type-number <?= $args["width"] ?>">
    <label for="<?= $args["name"] ?? strtolower($args["label"]) ?>-<?= $args["form_id"] ?>" class="text-xl"><?= $args["label"] ?></label>
    <input type="number" name="<?= $args["name"] ?? strtolower($args["label"]) ?>" id="<?= $args["name"] ?? strtolower($args["label"]) ?>-<?= $args["form_id"] ?>"<?= $args["required"] == "required" ? " required" : "" ?> placeholder="<?= $args["placeholder"] ?? "" ?>" class="rpc-input">
</div>
