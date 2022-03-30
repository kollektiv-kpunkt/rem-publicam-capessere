<div class="target-wrapper" id="mitmachen">
    <div class="CallToActionWrapper my-20">
        <div class="LargeContainerWrapper">
            <div class="LargeContainerInner">
                <div class="ColumnWrapper">
                    <div class="cols-2 columns">
                        <div id="cta-img" class="scrollAnimation" data-delay="500">
                            <div id="cta-img-wrapper">
                                <div id="cta-img-inner">
                                    <img src="<?=block_field("cta-image")?>">
                                    <div class="rpc-image-blind"></div>
                                    <div id="cta-image-gradient"></div>
                                    <div id="cta-img-content">
                                        <h2 class="text-4xl"><?=block_field("cta-title")?></h2>
                                        <p class="text-end"><?=block_field("cta-text")?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="cta-form" class="py-20 scrollAnimation" data-delay="500">
                            <div id="cta-form-wrapper">
                                <form data-nordpass-autofill="identity">
                                    <div class="StepWrapper CtAStep" data-step-id="form-step1">
                                        <div class=" input-wrapper">
                                            <label for="firstname" class="text-xl">Vorname</label>
                                            <input type="text" name="firstname" id="firstname" required>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="plz" class="text-xl">PLZ</label>
                                            <input type="text" name="plz" id="plz" required="">
                                        </div>
                                        <div class="input-wrapper fullwidth">
                                            <label for="email" class="text-xl">E-Mail Adresse</label>
                                            <input type="email" name="email" id="email" required="" />
                                        </div>
                                        <div class="input-wrapper fullwidth checkbox">
                                            <input type="checkbox" name="optin" id="optin" hidden="" checked="">
                                            <label for="optin" class="text-xs block">Ich bin einverstanden, dass mich
                                                Jacqueline Fehr und die SP Kanton Zürich auf dem Laufenden halten. Mehr
                                                zum
                                                Datenschutz Ich bin einverstanden, dass mich Jacqueline Fehr und die SP
                                                Kanton Zürich auf dem Laufenden halten. Mehr zum Datenschutz</label>
                                        </div>
                                        <div class="ButtonWrapper">
                                            <button id="" type="submit" href="#"
                                                class="rpc-button rpc-button-neg rpc-button-line rpc-button-arrow">Unterstützen</button>
                                        </div>
                                    </div>
                                    <div class="Step2Wrapper CtAStep" data-step-id="form-step2" hidden>
                                        <p class="text-xl text-white mb-4"><b>Danke für deine Unterstzützung!</b><br>Teile
                                            uns doch bitte noch kurz mit, wie du Jacqueline unterstützen möchtest:</p>
                                        <div class="StepWrapper">
                                            <div class="input-wrapper fullwidth checkbox">
                                                <input type="checkbox" name="support" id="support" hidden="" checked="">
                                                <label for="support" type="support" class="leading-none font-bold">
                                                    Ich möchte Jacqueline im Wahlkampf unterstützen!
                                                </label>
                                            </div>
                                            <div class="input-wrapper fullwidth checkbox">
                                                <input type="checkbox" name="donate" id="donate" hidden="">
                                                <label for="donate" type="donate" class="leading-none font-bold">
                                                    Ich möchte für Jacquelines Wahlkampf spenden!
                                                </label>
                                            </div>
                                            <div class="ButtonWrapper"><button id="" type="submit" href="#"
                                                    class="rpc-button rpc-button-arrow rpc-button-black">Unterstützen</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Step3Wrapper CtAStep" data-step-id="form-step3" hidden>
                                        <div class="ShareWrapper">
                                            <div id="share-inner" class="mb-4">
                                                <h1 class="text-2xl text-white">Teile deine Unterstzützung!</h1>
                                                <p class="text-xl text-white mb-4">Danke vielmals für deine Unterstützung! Hilf uns noch mehr Menschen zu erreichen, indem du ihnen eine Nachricht über meine Kandidatur schickst!</p><textarea class="flex"
                                                    style="height: 86px !important;">Fugiat cupidatat qui in veniam reprehenderit ea sunt aliquip esse eu eu. Consequat fugiat aliqua Lorem commodo commodo fugiat exercitation ullamco reprehenderit Lorem. Laborum sint ex sit esse cillum id non officia laborum.</textarea>
                                                <div id="share-buttons" class="flex flex-wrap gap-2 mt-2">
                                                    <div class="ButtonWrapper">
                                                        <a id="whatsapp" href="#" class="rpc-button">Auf WhatsApp teilen</a>
                                                    </div>
                                                    <div class="ButtonWrapper">
                                                        <a id="telegram" href="#" class="rpc-button">Auf Telegram teilen</a>
                                                    </div>
                                                    <div class="ButtonWrapper">
                                                        <a id="signal" href="#" class="rpc-button">Auf Signal teilen</a>
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