<div class="rpc-toggle-details-wrapper">
    <details class="rpc-toggle-details mt-4 text-start"<?= (get_field("default_setting")) ? " open" : "" ?>>
        <summary class="rpc-toggle-summary text-xl flex justify-between leading-none">
            <span class="rpc-toggle-title"><?= get_field("title") ?></span>
            <i class="fa fa-chevron-down rpc-toggle-icon"></i>
        </summary>
        <div class="rpc-toggle-content mt-4">
            <?= get_field("content") ?>
        </div>
    </details>
</div>

