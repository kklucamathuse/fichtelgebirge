<?php
    // Get name of the current element.
    $element = basename(__DIR__);

    // Get block ID.
    $id = $block['id'];

    // Path to Block-Element
    $blockPath = get_stylesheet_directory_uri() . "/blocks/" . $element;
    $path = "data-blockpath='$blockPath'";

    // ACF fields.
    $presentation       = get_field('presentation');
    $headline           = get_field('headline_clone');
    $textColsContainer = get_field('text_cols_container');
    $textMediaContainer = get_field('text_media_container');
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
        <section class="block<?php echo $classes; ?> px-6 md:px-9 xl:px-12" <?php if (current_user_can('administrator')) { echo " " . $path; } ?>>
            <div class="wrapper">
                <div class="text-media-container <?php echo $presentation; ?>">
                    <?php if ($presentation === 'text-cols') { ?>
                        <?php include dirname(dirname(__FILE__)) . "/_clone/headline/headline.php"; ?>

                        <div class="text-container flex flex-wrap items-baseline -mx-8 space-y-16">
                            <?php
                                $selectionColumn = $textColsContainer['selection_column'];
                                $textFields = $textColsContainer['text_fields'];
                                $loopCount = 0;


                                foreach ($textFields as $key => $textField) {
                                    $text = $textField['text'];
                                    $button = $textField['button'];

                                    if ($loopCount >= $selectionColumn) {
                                        break;
                                    }
                            ?>

                                <div class="col px-8 w-full
                                    <?php
                                        switch ($selectionColumn) {
                                            case '2':
                                                echo "md:w-1/2";
                                                break;
                                            case "3":
                                                echo "md:w-1/2 lg:w-1/3";
                                                break;
                                            case "4":
                                                echo "md:w-1/2 lg:w-1/3 xl:w-1/4";
                                                break;
                                        }
                                    ?>">
                                    <?php if (!empty($text)) { ?>
                                        <div>
                                            <?php echo $text; ?>
                                        </div>
                                    <?php } ?>

                                    <?php if (!empty($button)) { ?>
                                        <div>
                                            <a class="btn btn-primary" href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>">
                                                <?php echo $button['title']; ?>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>

                            <?php $loopCount++; } ?>
                        </div>

                    <?php } elseif ($presentation === 'text-media' || $presentation === 'media-text') { ?>
                        <?php
                            $text = $textMediaContainer['text'];
                            $button = $textMediaContainer['button'];

                            $selectionMedia = $textMediaContainer['selection_media'];
                            $image = $textMediaContainer['media_container']['image'];
                            $video = $textMediaContainer['media_container']['video'];
                            $videoYt = $textMediaContainer['media_container']['yt_video'];
                        ?>

                        <div class="flex flex-wrap items-center<?php if ($presentation === 'text-media') { ?> flex-row-reverse<?php } else { ?> row<?php } ?> space-y-16">
                            <div class="media-container relative w-full pt-[56.25%] xl:w-1/2 xl:pt-[calc(56.25%/2)]">
                                <?php
                                    if ($selectionMedia === "image") {
                                        if (!empty($image)) {
                                            include dirname(dirname(__FILE__)) . "/_clone/image/image.php";
                                        }
                                    } elseif($selectionMedia === 'video') {
                                        if (!empty($video) || !empty($videoYt)) {
                                            $videoType = $textMediaContainer['media_container']['video_type'];
                                            $videoPoster = $textMediaContainer['media_container']['video_poster'];

                                            if ($videoType === "youtube") {
                                                $videoYtUri = $textMediaContainer['media_container']['yt_video'];
                                            } elseif ($videoType === 'video') {
                                                $videoUri = $textMediaContainer['media_container']['video']['url'];
                                                $videoMimeType = $textMediaContainer['media_container']['video']['mime_type'];
                                            }

                                            $containerClass = 'absolute top-0 left-0 right-0 bottom-0 w-full h-full object-cover object-center';
                                            $videoClass = $containerClass;
                                            $iframeContainerClass = $containerClass;

                                            $videoPosterContainerClass = 'absolute top-0 left-0 right-0 bottom-0 w-full h-full object-cover object-center cursor-pointer z-10';
                                            $videoPosterClass = $videoPosterContainerClass;

                                            include dirname(dirname(__FILE__)) . "/_clone/video/video.php";
                                        }
                                    }
                                ?>
                            </div>

                            <div class="text w-full xl:w-1/2 xl:py-16 <?php if ($presentation === 'text-media') { ?> xl:pr-16<?php } else { ?> xl:pl-16<?php } ?>">
                                <?php include dirname(dirname(__FILE__)) . "/_clone/headline/headline.php"; ?>

                                <?php if (!empty($text)) { ?>
                                    <div class="text-container">
                                        <?php echo $text; ?>
                                    </div>
                                <?php } ?>

                                <?php if (!empty($button)) { ?>
                                    <div class="btn-container">
                                        <a class="btn btn-primary" href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </section>
    <?php } ?>
<?php } ?>
