<div class="rpc-input-wrapper type-email <?= $args["width"] ?>">
    <label for="<?= $args["name"] ?? strtolower($args["label"]) ?>-<?= $args["form_id"] ?>" class="text-xl"><?= $args["label"] ?></label>
    <input type="email" name="<?= $args["name"] ?? strtolower($args["label"]) ?>" id="<?= $args["name"] ?? strtolower($args["label"]) ?>-<?= $args["form_id"] ?>"<?= $args["required"] == "required" ? " required" : "" ?> placeholder="<?= $args["placeholder"] ?? "" ?>" class="rpc-input">
</div>
