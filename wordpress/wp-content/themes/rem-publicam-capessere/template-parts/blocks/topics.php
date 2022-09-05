<div class="PositionsWrapper my-14" id="positionen">
    <div class="LargeContainerWrapper">
        <div class="LargeContainerInner">
            <div class="ColumnWrapper">
                <div class="cols-2 columns">
                    <div class="mt-10 mb-72">
                        <h1 class="text-4xl text-primary"><?= get_field("title") ?></h1>
                        <div class="text-xl"><?= get_field("text") ?></div>
                        <div id="positions-readmore" class="mt-3"></div>
                    </div>
                    <div class="scrollAnimation" id="positions-animation-wrapper" data-delay="500">
                        <div class="positions-grid flex flex-wrap">
                            <?php
                            if (count(get_field("positions")) % 2 == 0) {
                                $even = true;
                            } else {
                                $even = false;
                            }
                            $i = 1;
                            foreach(get_field("positions") as $position) :
                                if ($even == false && $i == 1) {
                                    $fullwidth = true;
                                } else if (count(get_field("positions")) == 2) {
                                    $fullwidth = true;
                                } else {
                                    $fullwidth = false;
                                }
                                ?>
                                <div class="position<?= ($fullwidth) ? " fullwidth" : "";?>">
                                    <div class="PositionWrapper">
                                        <div class="position-outer text-white bg-primary p-6 box-border">
                                            <div class="position-inner">
                                                <h2 class="text-xl"><?= $position["title"] ?></h2>
                                                <?= $position["text"] ?>
                                            </div>
                                        </div>
                                        <div class="ButtonWrapper"><a
                                                href="<?= $position["link"] ?>"
                                                class="rpc-button rpc-button-neg rpc-button-line rpc-button-arrow">Weiterlesen</a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            $i++;
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="positions-image-container">
                <img src="<?= wp_get_attachment_image_src(get_field("bg_img")["ID"], "full")[0] ?>" alt="Positions">
                <!-- <img src="<?= block_field("positions-image") ?>" alt="Positions"> -->
                <div class="rpc-image-blind"></div>
            </div>
        </div>
    </div>
</div>