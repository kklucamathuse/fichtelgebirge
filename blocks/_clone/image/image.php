<?php if(!empty($image)) { ?>
    <div class="image-container relative <?php if(!empty($containerClass)) { echo $containerClass; } ?>">
        <figure <?php if(!empty($figureClass)) { ?>class="<?php echo $figureClass; ?>"<?php } ?>>
            <?php
                //Pfad wechseln zum webp-folder
                $image = make_webp($image);
            ?>
            <picture <?php if(!empty($pictureClass)) { ?>class=" <?php echo $pictureClass; ?>"<?php } ?>>
                <source data-srcset="<?php echo $image['sizes']["full"]; ?>" media="(min-width: 1921px)" />
                <source data-srcset="<?php echo $image['sizes']["max"]; ?>" media="(min-width: 1401px)" />
                <source data-srcset="<?php echo $image['sizes']["boxed"]; ?>" media="(min-width: 991px)" />
                <source data-srcset="<?php echo $image['sizes']["medium"]; ?>" media="(min-width: 767px)" />
                <source data-srcset="<?php echo $image['sizes']["small"]; ?>" media="(min-width: 575px)" />
                <img class="lazy <?php if(!empty($imageClass)) { echo $imageClass; } ?>" src="/wp-content/themes/bergauf/assets/img/layout/blank.gif" data-src="<?php echo $image['sizes']["xsmall"]; ?>" alt="<?php echo $image['title']; ?>">
            </picture>
        </figure>
    </div>
<?php } ?>