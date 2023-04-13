<details class="rpc-toggle-details mt-4 text-start"<?= (get_field("default_setting")) ? " open" : "" ?>>
    <summary class="rpc-toggle-summary rpc-graph text-xl flex justify-between leading-none">
        <span class="rpc-toggle-title"><?= get_field("title") ?></span>
        <div class="rpc-toggle-icon text-center">›</div>
    </summary>
    <div class="rpc-toggle-content mt-4">
        <?= get_field("content") ?>
    </div>
</details>