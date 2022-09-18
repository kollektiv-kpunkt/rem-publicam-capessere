<div class="rpc-supp-form mt-8">
    <form action="#" class="rpc-api-form rpc-form-neg StepWrapper" data-endpoint="/api/v1/komitee/step1" data-step-id="supporters-1">
        <div class="input-wrapper">
            <label for="fname" class="text-xl">Vorname</label>
            <input type="text" name="fname" id="fname" required>
        </div>
        <div class="input-wrapper">
            <label for="lname" class="text-xl">Nachname</label>
            <input type="text" name="lname" id="lname" required>
        </div>
        <div class="input-wrapper">
            <label for="email" class="text-xl">E-Mail Adresse</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="input-wrapper">
            <label for="position" class="text-xl">Beruf, Amt, etc.</label>
            <input type="text" name="position" id="position" placeholder="optional">
        </div>
        <div class="input-wrapper">
            <label for="city" class="text-xl">Ort</label>
            <input type="text" name="city" id="city" required>
        </div>
        <div class="input-wrapper">
            <label for="zip" class="text-xl">PLZ</label>
            <input type="text" name="zip" id="zip" required>
        </div>
        <div class="input-wrapper fullwidth">
            <label for="quote" class="text-xl">Ihr Zitat</label>
            <textarea name="quote" id="quote" class="rpc-textarea-autosize" placeholder="optional"></textarea>
        </div>
        <div class="input-wrapper fullwidth checkbox">
            <input type="checkbox" name="optin" id="optin" class="optin" hidden checked>
            <label for="optin" class="text-xs block">Ich möchte auf dem Laufenden gehalten werden.</label>
        </div>
        <input type="hidden" name="config" value="<?= $args ?>">
        <div class="input-wrapper fullwidth">
            <button type="submit" class="rpc-button rpc-button-arrow mr-0 ml-auto">Weiter</button>
        </div>
    </form>

    <form action="#" class="rpc-api-form rpc-form-neg StepWrapper" data-endpoint="/api/v1/komitee/step2" data-step-id="supporters-2" hidden>
        <div class="input-wrapper fullwidth">
            <label for="rpc-komitee-portrait" class="block">Bitte lade noch ein Bild von dir hoch.</label>
            <input type="file" name="portrait" id="rpc-komitee-portrait">
        </div>
        <div class="rpc-testimonial-cropper-wrapper" hidden>
            <p class="my-4"><b>Bitte schneide dein Bild noch ins gewünschte Format:</b></p>
            <img src="#" alt="" id="rpc-testimonial-cropper">
            <a href="#" class="rpc-button rpc-button-next mt-4" id="rpc-testimonial-crop"><span class="text-white">Testimonial erstellen</span></a>
        </div>
    </form>


    <div class="Step3Wrapper CtAStep" data-step-id="supporters-3" hidden>
        <div class="ShareWrapper p-8 bg-primary">
            <div class="share-inner">
                <h2 class="text-2xl text-white">Teile deine Unterstzützung!</h2>
                <p class="text-xl text-white mb-4">Danke vielmals für deine Unterstützung! Hilf uns noch mehr Menschen zu erreichen, indem du ihnen eine Nachricht über meine Kandidatur schickst!</p>
                <div class="flex flex-wrap gap-2 mt-2 share-buttons" data-sharetext="<?= $_ENV["SHARETEXT"] ?>">
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
            </div>
        </div>
    </div>
</div>