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
    $headline  = get_field('headline_klon');
    $elements  = get_field('elements');
    $hideBlockFrontend = get_field('hide_block_frontend');

    // Classes.
    $kkBlock = " block-" . $element;
    $classes = $kkBlock;

    // Show block-preview in Gutenberg Editor.
    if (isset($block['data']['block-preview'])) { ?>
        <img src="<?php echo $blockPath . str_replace("file:.","",$block['data']['block-preview']); ?>" />
    <?php } else {
?>

    <?php if (!$hideBlockFrontend) { ?>
        <section class="block<?php echo $classes; ?> px-6 md:px-9 lg:px-12"<?php if (current_user_can('administrator')) { echo " " . $path; } ?>>
            <div class="wrapper">

                <?php include dirname(dirname(__FILE__)) . "/_clone/headline/headline.php"; ?>

                <div id="teaser-<?php echo $presentation . '-' . esc_attr($id); ?>" class="teaser-<?php echo $presentation; ?> teaser-<?php echo $presentation; ?>-container relative overflow-hidden" data-teaser-id="<?php echo esc_attr($id); ?>">
                    <ul class="teaser-list flex<?php if ($presentation === 'list') { ?> flex-wrap items-baseline space-y-12 -mx-4 <?php } elseif ($presentation === 'slider') { ?> swiper-wrapper relative w-full h-full transition-transform<?php } ?>">
                        <?php foreach ($elements as $element) { ?>
                            <li class="teaser-item <?php if ($presentation === 'list') { ?> w-full px-4 md:w-1/2 xl:w-1/3 <?php } elseif ($presentation === 'slider'){ ?> swiper-slide shrink-0 block relative !h-[auto] group !transition-bg-color !ease-out !duration-300<?php } ?>">
                                <div class="teaser-inner relative h-full bg-white shadow-[0_0_10px_rgba(0,0,0,0.15)]">
                                    <?php if(!empty($element['image'])) {
                                        $image = $element['image'];
                                        $pictureClass = "relative block pt-[56.25%] w-full";
                                        $imageClass = "absolute top-0 left-0 right-0 bottom-0 w-full h-full object-cover object-center";
                                        include dirname(dirname(__FILE__)) . "/_clone/image/image.php";
                                    ?>
                                    <?php } ?>
                                    <div class="content p-8 space-y-8">
                                        <?php if(!empty($element['headline'])) { ?>
                                            <div class="h3 mb-4"><?php echo $element['headline']; ?></div>
                                        <?php } ?>
                                        <?php if(!empty($element['text'])) { ?>
                                            <div class="text-container">
                                                <p><?php echo $element['text']; ?></p>
                                            </div>
                                        <?php } ?>
                                        <?php if(!empty($element['button'])) { ?>
                                            <div class="btn-container">
                                                <a class="btn btn-primary" href="<?php echo $element['button']['url']; ?>" target="<?php echo $element['button']['target']; ?>"><?php echo $element['button']['title']; ?></a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>

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
