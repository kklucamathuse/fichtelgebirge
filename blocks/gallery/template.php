<?php
    // Get name of the current element.
    $element = basename(__DIR__);

    // Get block ID.
    $id = $block['id'];

    // Path to Block-Element
    $blockPath = get_stylesheet_directory_uri() . "/blocks/" . $element;
    $path = "data-blockpath='$blockPath'";

    // ACF fields.
    $presentation = get_field('presentation');
    $images       = get_field('images');
    $showCaption = get_field('show_caption');
    $hideBlockFrontend = get_field('hide_block_frontend');

    // Classes.
    $kkBlock = " block-" . $element;
    $classes = $kkBlock;

    $iconsPath = get_template_directory_uri() . '/blocks/gallery';

    // Show block-preview in Gutenberg Editor.
    if (isset($block['data']['block-preview'])) { ?>
        <img src="<?php echo $blockPath . str_replace("file:.","",$block['data']['block-preview']); ?>" />
    <?php } else {
?>
    <?php if (!$hideBlockFrontend) { ?>
        <section class="block<?php echo $classes; ?> py-12 px-6 md:px-9 lg:px-12" <?php if (current_user_can('administrator')) { echo " " . $path; } ?>>
            <div class="wrapper">
                <div id="gallery-<?php echo $presentation . '-' . esc_attr($id); ?>" class="gallery-<?php echo $presentation; ?> gallery-grid relative overflow-hidden" data-gallery-id="<?php echo esc_attr($id); ?>">
                    <?php if (!empty($images)) { ?>
                        <ul class="gallery-list flex<?php if ($presentation === 'default') { ?> flex-wrap<?php } elseif ($presentation==='slider') { ?> swiper-wrapper relative w-full h-full transition-transform<?php } ?>">
                            <?php foreach ($images as $key=>$image) {
                                //Pfad wechseln zum webp-folder
                                $image=make_webp($image);
                                ?>
                                <li class="gallery-list-item<?php if ($presentation === 'default') { ?> relative p-2 w-full hidden first:block md:block md:w-1/2 lg:w-1/3 lg:p-3<?php } elseif ($presentation === 'slider') { ?> swiper-slide shrink-0 block relative !h-[auto] group !transition-bg-color !ease-out !duration-300<?php } ?> ">
                                    <a class="lightbox block relative group" href="<?php echo $image['sizes']["boxed"]?>" data-thumb="<?php echo $image['sizes']["xsmall"]; ?>" data-fancybox="gallery-<?php echo esc_attr($id); ?>" <?php if ($showCaption) { ?> data-caption="<?php echo $image['description']; ?> <?php } ?>">
                                        <?php
                                            $pictureClass = "relative block h-44 md:h-56 lg:h-72 xl:h-96";
                                            $imageClass = "absolute top-0 left-0 right-0 bottom-0 w-full h-full object-cover object-center";
                                            include dirname(dirname(__FILE__)) . "/_clone/image/image.php";
                                        ?>

                                        <?php if ($presentation === 'default') { ?>
                                            <button class="more-btn btn btn-primary block absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 z-10 whitespace-nowrap sm:hidden">
                                                <span>
                                                    Galerie ansehen
                                                </span>
                                            </button>
                                        <?php } ?>

                                        <div class="lightbox-bg absolute top-0 left-0 right-0 bottom-0 opacity-0 bg-primary/[.78] transition ease-in-out group-hover:opacity-100 md:flex md:items-center md:justify-center">
                                            <div class="lightbox-icon w-24 h-24 hidden md:block">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" class="w-full h-full">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php }?>

                    <?php if ($presentation === 'slider') { ?>
                        <div class="swiper-btn-container flex justify-between absolute top-1/2 left-0 px-3 w-full -translate-y-1/2 -mt-4 xl:mt-0">
                            <button class="swiper-btn-prev text-white bg-primary w-10 h-10 flex items-center justify-center rounded-full p-2" aria-label="Zurück" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                </svg>
                            </button>

                            <button class="swiper-btn-next text-white bg-primary w-10 h-10 flex items-center justify-center rounded-full p-2 " aria-label="Weiter" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </button>
                        </div>

                        <div class="swiper-pagination space-x-2 mt-6 flex justify-center"></div>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php } ?>
<?php } ?>
