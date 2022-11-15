<?php

$images = get_field("images");
?>

<div class="rpc-static-image-gallery">
    <section class="splide" aria-labelledby="carousel-heading">
      <div class="splide__track">
            <div class="splide__list">
                <?php
                foreach ($images as $image) :
                    $image = $image["image"];
                ?>
                <div class="splide__slide rpc-static-image-gallery__slide flex justify-center items-center">
                    <img src="<?php echo $image["url"]; ?>" alt="<?php echo $image["alt"]; ?>" />
                </div>
                <?php
                endforeach;
                ?>
            </div>
        </div>
    </section>
</div>