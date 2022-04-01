<?php
get_header()
?>

<div id="error-container" class="h-screen bg-primary flex flex-col justify-center text-center">
    <div class="MediumContainerInner text-white">
        <h1 class="mb-0">404</h1>
        <p class="text-bold text-2xl">Leider konnten wir diese Seite nicht finden.</p>
        <div id="error-buttons" class="flex gap-4 justify-center mt-6">
            <a href="<?= get_home_url() ?>" class="rpc-button rpc-button-black rpc-button-arrow">Startseite</a>
            <a href="#" onclick="history.go(-1)" class="rpc-button rpc-button-neg rpc-button-line rpc-button-arrow">Zurück</a>
        </div>
    </div>
</div>

<?php
get_footer("404")
?>