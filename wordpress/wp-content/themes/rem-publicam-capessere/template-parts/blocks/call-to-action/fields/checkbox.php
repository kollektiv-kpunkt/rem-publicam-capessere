<div class="rpc-input-wrapper type-checkbox fullwidth">
    <input type="checkbox" name="<?= $args["name"] ?? strtolower($args["label"]) ?>" id="<?= $args["name"] ?? strtolower($args["label"]) ?>-<?= $args["form_id"] ?>" hidden <?= $args["default_state"] ?>>
    <label for="<?= $args["name"] ?? strtolower($args["label"]) ?>-<?= $args["form_id"] ?>" class="block leading-tight"><small><?= $args["label"] ?></small></label>
</div>
