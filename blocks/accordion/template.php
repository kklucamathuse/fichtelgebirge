<?php
    // Get name of the current element.
    $element = basename(__DIR__);

    // Get block ID.
    $id = $block['id'];

    // Path to Block-Element
    $blockPath = get_stylesheet_directory_uri() . "/blocks/" . $element;
    $path = "data-blockpath='$blockPath'";

    // Classes.
    $kkBlock = "block-" . $element;
    $classes = $kkBlock;

    //ACF Fields
    $presentation = get_field('presentation');
    $headline   = get_field('headline_clone');
    $text       = get_field('text');
    $accordions = get_field('accordion');
    $firstOpen  = get_field('first_open');
    $hideBlockFrontend = get_field('hide_block_frontend');
    $i = 0;

    // Show block-preview in Gutenberg Editor.
    if (isset($block['data']['block-preview'])) { ?>
        <img src="<?php echo $blockPath . str_replace("file:.","",$block['data']['block-preview']); ?>" />
    <?php } else {
?>

    <?php if (!$hideBlockFrontend) { ?>
        <section class="block<?php echo $classes; ?> px-6 md:px-9 lg:px-12" <?php if (current_user_can('administrator')); ?>>
            <div class="wrapper">
                <?php include dirname(dirname(__FILE__)) . "/_clone/headline/headline.php"; ?>

                <?php if(!empty($text)) { ?>
                    <div class="text mb-8 md:mb-12 2xl:mb-16"><?php echo $text; ?></div>
                <?php } ?>

                <div class="accordions-container accordion-<?php echo $presentation; ?>">

                    <ul class="accordions-list space-y-4" x-data="{ activeAccordion: <?php echo $firstOpen ? 0 : '-1'; ?> }">
                        <?php foreach ($accordions as $accordion) { ?>
                            <li class="accordion-item w-full" x-data="{ accordion: <?php echo $i ?>}">
                                <div class="accordion-item-inner">
                                    <button class="accordion-header bg-primary flex justify-between items-center w-full text-left py-3 px-6 transition duration-300 md:py-5" id="accordion-section-<?php echo $i ?>"
                                    @click="activeAccordion = activeAccordion === accordion ? -1 : accordion"
                                    :class="{'!bg-primary' : activeAccordion}"
                                    aria-controls="accordion-body-<?php echo $i ?>"
                                    >
                                        <span class="accordion-header-headline text-white mr-6">
                                            <?php echo $accordion['heading']; ?>
                                        </span>

                                        <span class="accordion-arrow w-4 shrink-0 text-white transition duration-300"
                                            :class="{'rotate-180' : activeAccordion === accordion}">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="arrow-<?php echo $i ?>" viewBox="0 0 12.6 8.8">
                                                    <path fill="currentColor" d="M6.5,8.3C6.2,8.3,6,8.2,5.8,8L0.9,2.5c-0.4-0.4-0.3-1,0.1-1.4c0.4-0.4,1-0.3,1.4,0.1l4.9,5.5c0.4,0.4,0.3,1-0.1,1.4  C7,8.2,6.7,8.3,6.5,8.3z M6.5,8.3C6.3,8.3,6.1,8.2,5.9,8C5.5,7.7,5.4,7,5.8,6.6l4.9-5.5c0.4-0.4,1-0.4,1.4-0.1  c0.4,0.4,0.4,1,0.1,1.4L7.3,8C7.1,8.2,6.8,8.3,6.5,8.3z"/>
                                                </svg>
                                            </span>
                                    </button>

                                    <?php if(!empty($accordion['inner-content'])) { ?>
                                        <div class="accordion-body grid transition-[grid-template-rows] duration-300"
                                             :class="activeAccordion === accordion ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'"
                                        id="accordion-body-<?php echo $i; ?>"
                                        aria-labelledby="accordion-header-<?php echo $i; ?>">
                                            <div class="accordion-wrapper overflow-hidden">
                                                <div class="accordion-body-inner py-6 px-6 lg:py-8">
                                                    <div class="accordion-text text"><?php echo $accordion['inner-content']; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </li>
                        <?php $i++; } ?>
                    </ul>
                </div>
            </div>
        </section>
    <?php } ?>
<?php } ?>
