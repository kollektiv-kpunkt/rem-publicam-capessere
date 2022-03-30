<div class="PositionsWrapper my-14" id="positionen">
    <div class="LargeContainerWrapper">
        <div class="LargeContainerInner">
            <div class="ColumnWrapper">
                <div class="cols-2 columns">
                    <div class="mt-10 mb-72">
                        <h1 class="text-4xl text-primary"><?= block_field("positions-title") ?></h1>
                        <p><?= block_field("positions-text") ?></p>
                        <div id="positions-readmore" class="mt-3"></div>
                    </div>
                    <div class="scrollAnimation" id="positions-animation-wrapper" data-delay="500">
                        <div class="positions-grid flex flex-wrap">
                            <div class="fullwidth position">
                                <div class="PositionWrapper">
                                    <div class="position-outer text-white bg-primary p-6 box-border">
                                        <div class="position-inner">
                                            <h2 class="text-xl"><?= block_field("positions-position-1-title") ?></h2>
                                            <p class="text-sm"><?= block_field("positions-position-1-text") ?></p>
                                        </div>
                                    </div>
                                    <div class="ButtonWrapper"><a id="" type="submit"
                                            href="<?= block_field("positions-position-1-link") ?>"
                                            class="rpc-button rpc-button-neg rpc-button-line rpc-button-arrow text-sm">Weiterlesen</a>
                                    </div>
                                </div>
                            </div>
                            <div class="position">
                                <div class="PositionWrapper">
                                    <div class="position-outer text-white bg-primary p-6 box-border">
                                        <div class="position-inner">
                                            <h2 class="text-xl"><?= block_field("positions-position-2-title") ?></h2>
                                            <p class="text-sm"><?= block_field("positions-position-2-text") ?></p>
                                        </div>
                                    </div>
                                    <div class="ButtonWrapper"><a id="" type="submit"
                                            href="<?= block_field("positions-position-2-link") ?>"
                                            class="rpc-button rpc-button-neg rpc-button-line rpc-button-arrow text-sm">Weiterlesen</a>
                                    </div>
                                </div>
                            </div>
                            <div class="position">
                                <div class="PositionWrapper">
                                    <div class="position-outer text-white bg-primary p-6 box-border">
                                        <div class="position-inner">
                                            <h2 class="text-xl"><?= block_field("positions-position-3-title") ?></h2>
                                            <p class="text-sm"><?= block_field("positions-position-3-text") ?></p>
                                        </div>
                                    </div>
                                    <div class="ButtonWrapper"><a id="" type="submit"
                                            href="<?= block_field("positions-position-3-link") ?>"
                                            class="rpc-button rpc-button-neg rpc-button-line rpc-button-arrow text-sm">Weiterlesen</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="positions-image-container">
                <img src="<?= block_field("positions-image") ?>" alt="Positions">
                <div class="rpc-image-blind"></div>
            </div>
        </div>
    </div>
</div>