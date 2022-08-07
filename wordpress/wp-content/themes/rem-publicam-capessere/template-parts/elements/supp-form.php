<form action="#" class="rpc-api-form rpc-form-neg StepWrapper" data-endpoint="/api/v1/komitee/step1">
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