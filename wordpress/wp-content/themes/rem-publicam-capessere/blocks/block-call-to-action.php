<div class="target-wrapper" id="mitmachen">
    <div class="CallToActionWrapper my-20">
        <div class="LargeContainerWrapper">
            <div class="LargeContainerInner">
                <div class="ColumnWrapper">
                    <div class="cols-2 columns">
                        <div id="cta-img" class="scrollAnimation my-auto" data-delay="500">
                            <div id="cta-img-wrapper">
                                <div id="cta-img-inner">
                                    <img src="<?=block_field("cta-image")?>">
                                    <div class="rpc-image-blind"></div>
                                    <div id="cta-image-gradient"></div>
                                    <div id="cta-img-content">
                                        <h2 class="text-4xl mb-0" id="cta-title-mobile"><?=block_field("cta-title")?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="cta-form" class="py-14 scrollAnimation my-auto" data-delay="500">
                            <div id="cta-form-wrapper">
                                <form>
                                    <div class="CtAStep" data-step-id="form-step1">
                                        <h2 class="text-4xl text-white mb-0" id="cta-title-desk"><?=block_field("cta-title")?></h2>
                                        <p class="text-end text-xl text-white mb-4"><?=block_field("cta-text")?></p>
                                        <div class="StepWrapper">
                                            <div class=" input-wrapper">
                                                <label for="firstname" class="text-xl">Vorname</label>
                                                <input type="text" name="firstname" id="firstname" required>
                                            </div>
                                            <div class="input-wrapper">
                                                <label for="plz" class="text-xl">Postleitzahl</label>
                                                <input type="text" name="plz" id="plz" required="">
                                            </div>
                                            <div class="input-wrapper fullwidth">
                                                <label for="email" class="text-xl">E-Mail-Adresse</label>
                                                <input type="email" name="email" id="email" required="" />
                                            </div>
                                            <div class="input-wrapper fullwidth checkbox">
                                                <input type="checkbox" name="optin" id="optin" hidden="" checked="">
                                                <label for="optin" class="text-xs block">Ich bin einverstanden, dass mich <?= $_ENV["KANDIFULLNAME"] ?> und die SP Kanton Zürich auf dem Laufenden halten. <a href="/datenschutz" class="underline">Mehr zum Datenschutz</a></label>
                                            </div>
                                            <div class="ButtonWrapper">
                                                <button id="" type="submit" href="#"
                                                    class="rpc-button rpc-button-neg rpc-button-line rpc-button-arrow">Ich bin dabei</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Step2Wrapper CtAStep" data-step-id="form-step2" hidden>
                                        <h2 class="text-2xl text-white">Danke für deine Unterstzützung!</h2>
                                        <p class="text-xl text-white mb-4">Bevor du gehst: Kannst du dir vorstellen, mich weiter im Wahlkampf zu unterstützen?</p>
                                        <div class="StepWrapper">
                                            <div class="input-wrapper fullwidth checkbox">
                                                <input type="checkbox" name="support" id="support" hidden="" checked="">
                                                <label for="support" type="support" class="leading-none text-xl">
                                                    Ja, ich kann mir vorstellen, dir im Wahlkampf zu helfen!
                                                </label>
                                            </div>
                                            <div class="input-wrapper fullwidth checkbox">
                                                <input type="checkbox" name="donate" id="donate" hidden="">
                                                <label for="donate" type="donate" class="leading-none text-xl">
                                                    Ja, ich möchte etwas für deinen Wahlkampf spenden!
                                                </label>
                                            </div>
                                            <div class="ButtonWrapper"><button id="" type="submit" href="#"
                                                    class="rpc-button rpc-button-arrow rpc-button-black">Abschicken</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Step3Wrapper CtAStep" data-step-id="form-step3" hidden>
                                        <div class="ShareWrapper">
                                            <div id="share-inner" class="mb-4">
                                                <h2 class="text-2xl text-white">Teile deine Unterstzützung!</h2>
                                                <p class="text-xl text-white mb-4">Danke vielmals für deine Unterstützung! Hilf uns noch mehr Menschen zu erreichen, indem du ihnen eine Nachricht über meine Kandidatur schickst!</p>
                                                <div id="share-buttons" class="flex flex-wrap gap-2 mt-2" data-sharetext="<?= $_ENV["SHARETEXT"] ?>">
                                                    <div class="ButtonWrapper">
                                                        <a id="whatsapp" href="#" class="rpc-button">Auf WhatsApp teilen</a>
                                                    </div>
                                                    <div class="ButtonWrapper">
                                                        <a id="telegram" href="#" class="rpc-button">Auf Telegram teilen</a>
                                                    </div>
                                                    <div class="ButtonWrapper">
                                                        <a id="facebook" href="#" class="rpc-button" >Auf Facebook teilen</a>
                                                    </div>
                                                    <div class="ButtonWrapper">
                                                        <a id="email" href="#" class="rpc-button rpc-button-neg rpc-button-line"">Per Mail teilen</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>