<div id="mobile-nav-wrapper" hidden>
    <div id="mobile-nav-container">
        <div id="mobile-nav-inner">
            <ul class="flex flex-col gap-3 font-semibold">
                <?php
                $navitems = rpc_menu_items( 'rpc-main-nav', [] );
                foreach( $navitems as $item ) : ?>
                    <li><a href="<?= $item->url ?>"<?php ($item->target == "_blank") ? print(" target='_blank'") : "" ?>><?= $item->title ?></a></li>
                <?php
                endforeach;
                ?>
                <?php
                $ctas = rpc_menu_items( 'rpc-main-cta', [] );
                $i=0;
                foreach( $ctas as $cta ) : ?>
                    <li>
                        <div class="ButtonWrapper"><a href="<?= $cta->url ?>"<?php ($cta->target == "_blank") ? print(" target='_blank'") : "" ?> class="rpc-button negative"><?= $cta->title ?></a></div>
                    </li>
                <?php
                $i++;
                endforeach;
                ?>
            </ul>
        </div>
    </div>
</div>
