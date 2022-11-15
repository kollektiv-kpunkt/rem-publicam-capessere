<?php
ob_start();
$supporter = "";
if (isset($_GET["supporter_email"])) {
    $supporter = get_posts(
        array(
            'post_type' => 'supporter',
            'post_status' => 'any',
            'meta_key' => 'email',
            'meta_value' => $_GET["supporter_email"],
            'posts_per_page' => 1
        )
    )[0];
}

if (!$supporter) {
    header("Location: /#mitmachen");
    exit;
}
ob_get_clean();

get_header("", array(
    "noNavbar" => true,
    "title-overwrite" => "Komitee: {$supporter->post_title}"
));
?>

<div class="rpc-komitee-completion-wrapper bg-red-50 min-h-screen flex flex-col justify-center">
    <div class="rpc-komitee-completion-outer SmallContainerInner py-20">
        <div class="rpc-komitee-completion-form-wrapper">
            <h1 class="text-7xl text-primary">Danke!</h1>
            <p class="text-xl"><b class="text-primary">Es freut mich, dass du mich mit einem Testimonial unterstützen möchtest.</b> Bitte verfollständige deine Angaben hier:</p>
            <form class="rpc-komitee-completion-form rpc-api-form mt-6 flex flex-wrap gap-x-6 gap-y-5" data-endpoint="/api/v1/komitee/step3" method="POST" style="--form-color: var(--prim)">
                <div class="input-wrapper text fullwidth">
                    <label for="name" class="text-xl">Name</label>
                    <input type="text" name="name" id="name" required value="<?= get_the_title($supporter->ID) ?>">
                </div>
                <div class="input-wrapper text">
                    <label for="ort" class="text-xl">Ort</label>
                    <input type="text" name="city" id="ort" required value="<?= get_field("city", $supporter->ID) ?>">
                </div>
                <div class="input-wrapper text">
                    <label for="plz" class="text-xl">PLZ</label>
                    <input type="text" name="zip" id="plz" required value="<?= get_field("plz", $supporter->ID) ?>">
                </div>
                <div class="input-wrapper text fullwidth">
                    <label for="position" class="text-xl">Position / Beruf etc.</label>
                    <input type="text" name="position" id="position" required value="<?= get_field("position", $supporter->ID) ?>">
                </div>
                <div class="input-wrapper textarea fullwidth">
                    <label for="quote" class="text-xl">Zitat</label>
                    <div class="rpc-editable-textarea border-b-primary border-b-2 text-primary" name="quote" data-max-length="300" style="border-bottom-width: 3px;" contenteditable="true"><?= get_the_content( "", "", $supporter->ID ) ?></div>
                </div>
                <?php
                if (!has_post_thumbnail($supporter->ID)) :
                ?>
                <div class="input-wrapper file fullwidth">
                    <label for="image" class="text-xl">Bild</label>
                    <input type="file" name="image-placeholder" id="rpc-komitee-portrait" required>
                </div>
                <div class="rpc-testimonial-cropper-wrapper" hidden>
                    <p class="my-4"><b>Bitte schneide dein Bild noch ins gewünschte Format:</b></p>
                    <img src="#" alt="" id="rpc-testimonial-cropper">
                    <a href="#" class="rpc-button rpc-button-next mt-4" id="rpc-testimonial-crop"><span class="text-white">Zuschneiden</span></a>
                </div>
                <div class="input-wrapper text fullwidth" id="rpc-testimonial-cropped" hidden>
                    <label for="cropped" class="text-xl"><span class="text-green-700">✓ Bild zugeschnitten</span></label>
                    <input type="hidden" name="image" required value="">
                </div>
                <?php
                endif;
                ?>
                <input type="hidden" name="supporter_ID" value="<?= $supporter->ID ?>">
                <button type="submit" class="rpc-button rpc-button-arrow rpc-button-line ml-auto">Abschicken</button>
            </form>
        </div>
        <div class="rpc-komitee-completion-success" hidden="hidden">
            <h2 class="text-3xl text-primary">Vielen Dank für deine Unterstützung, <?= get_the_title($supporter->ID) ?>!</h2>
            <p class="text-xl">Wir werden dein Testimonial kurz anschauen und so schnell wie möglich auf unserer Webseite veröffentlichen!</p>
        </div>
    </div>
</div>

<div class="rpc-info-outer absolute bottom-0 left-0" hidden>
    <div class="rpc-info-container">
        <pre class="mt-16 w-fit p-8 bg-red-900 text-red-50" style="font-size: 0.5rem"><?php print_r($supporter);?></pre>
    </div>
</div>

<?php
get_footer("", array(
    "noFooterNav" => true
));
?>