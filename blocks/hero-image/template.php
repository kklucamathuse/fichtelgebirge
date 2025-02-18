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
    $headline   = get_field('headline');
    $text       = get_field('text');
    $image      = get_field('image');
    $button      = get_field('button');
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
        <section class="block<?php echo $classes; ?>" <?php if (current_user_can('administrator')) { echo " " . $path; } ?>>
            <div class="wrapper relative">
                <div class="hero-container hero-<?php echo $presentation; ?>">
                    <?php if (!empty($image)) { ?>
                        <?php
                            $pictureClass = "relative block w-full pt-[56.25%]";
                            $imageClass = "absolute top-0 left-0 right-0 bottom-0 w-full h-full object-cover object-center";
                            include dirname(dirname(__FILE__)) . "/_clone/image/image.php";
                        ?>
                    <?php } ?>

                    <?php if (!empty($headline) || !empty($text)) { ?>
                        <div class="hero-content relative w-full bg-primary sm:absolute sm:top-0 sm:left-0 sm:right-0 sm:w-1/2 sm:h-full sm:flex sm:items-center sm:bg-primary/[0.6]">
                            <div class="hero-content-inner p-8 lg:p-12 xl:p-24">
                                <?php if (!empty($headline)) { ?>
                                    <h1 class="text-white"><?php echo $headline; ?></h1>
                                <?php } ?>
                                <?php if (!empty($text)) { ?>
                                    <p class="text-white"><?php echo $text; ?></p>
                                <?php } ?>
                                <?php if (!empty($button)) { ?>
                                    <a class="btn btn-secondary" href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php } ?>
<?php } ?>
