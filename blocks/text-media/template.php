<?php
// Get name of the current element.
$element = basename(__DIR__);

// Get block ID.
$id = $block["id"];

// Path to Block-Element
$blockPath = get_stylesheet_directory_uri() . "/blocks/" . $element;
$path = "data-blockpath='$blockPath'";

// ACF fields.
$presentation = get_field("presentation");
$headline = get_field("headline_clone");
$textColsContainer = get_field("text_cols_container");
$textMediaContainer = get_field("text_media_container");
$hideBlockFrontend = get_field("hide_block_frontend");
$showDecor = get_field("show_decor");

// Classes.
$kkBlock = " block-" . $element;
$classes = $kkBlock;

// Show block-preview in Gutenberg Editor.
if (isset($block["data"]["block-preview"])) { ?>
        <img src="<?php echo $blockPath .
            str_replace("file:.", "", $block["data"]["block-preview"]); ?>" />
    <?php } else { ?>
    <?php if (!$hideBlockFrontend) { ?>
        <section class="block<?php echo $classes; ?> px-6 md:px-9 xl:px-40 relative" <?php if (
     current_user_can("administrator")
 ) {
     echo " " . $path;
 } ?>>
     <?php if ($showDecor == 1) { ?>
             <svg class="absolute -top-14 -left-24 md:-top-10 md:-left-52 xl:-top-16 xl:-left-96 w-[40vw] max-w-[733px] -z-1" viewBox="0 0 733.451 694.978">
                 <path id="blob_1_" data-name="blob (1)" d="M420.485-31.67C468.317,8.094,484.13,77.854,467.922,132.267s-64.436,94.177-100.014,131.5c-35.578,37.671-58.506,73.6-103.176,111.268-44.67,37.322-110.687,76.388-179.471,74.993-68.389-1.4-139.94-43.6-154.171-98.711C-82.746,296.2-39.262,228.188-17.124,164.009,5.408,99.48,6.99,39.137,41.382-3.068,75.774-44.925,143.767-68.643,217.69-75.27,291.613-82.246,372.257-71.782,420.485-31.67Z" transform="translate(585.064 223.064) rotate(110)" fill="#ebf3d4"/>
                 <path id="blob_1_2" data-name="blob (1)" d="M328.568-40.189c38.9,32.336,51.756,89.065,38.576,133.314s-52.4,76.585-81.331,106.935c-28.932,30.634-47.577,59.849-83.9,90.483-36.326,30.35-90.011,62.119-145.946,60.984-55.614-1.135-113.8-35.456-125.372-80.272C-80.659,226.439-45.3,171.128-27.3,118.937-8.972,66.462-7.686,17.391,20.282-16.93c27.968-34.038,83.26-53.326,143.374-58.715C223.77-81.318,289.349-72.808,328.568-40.189Z" transform="translate(634.407 189.373) rotate(110)" fill="none" stroke="#8db63c" stroke-width="3"/>
             </svg>
             <svg class="absolute -top-36 -right-12 md:-top-40 md:-right-24 xl:-top-[25rem] xl:-right-48 w-[40vw] max-w-[745px] -z-1" viewBox="0 0 745.779 759.077">
                 <path id="blob" d="M368.242,59.769c54.941,53.612,109.883,108.553,127.9,181.66,17.581,72.664-1.758,163.494-56.26,216.219-54.941,53.169-145.045,67.79-231.193,63.359-86.148-3.988-167.9-27.027-213.612-79.753S-60.3,306.117-60.3,223.263-51.07,57.554-5.359,3.942c45.711-54.055,127.9-79.31,196.47-65.132C259.239-47.455,313.74,5.714,368.242,59.769Z" transform="translate(82.308 250.759) rotate(-22)" fill="none" stroke="#1269b0" stroke-width="3" opacity="0.995"/>
             </svg>

     <?php } ?>
            <div class="wrapper">
                <div class="inner rounded-xl">
                <div class="text-media-container <?php echo $presentation; ?>">
                    <?php if ($presentation === "text-cols") { ?>
                        <?php include dirname(dirname(__FILE__)) .
                            "/_clone/headline/headline.php"; ?>

                        <div class="text-container flex flex-wrap items-baseline -mx-8 space-y-16">
                            <?php
                            $selectionColumn =
                                $textColsContainer["selection_column"];
                            $textFields = $textColsContainer["text_fields"];
                            $loopCount = 0;

                            foreach ($textFields as $key => $textField) {

                                $text = $textField["text"];
                                $button = $textField["button"];

                                if ($loopCount >= $selectionColumn) {
                                    break;
                                }
                                ?>

                                <div class="col px-8 w-full
                                    <?php switch ($selectionColumn) {
                                        case "2":
                                            echo "md:w-1/2";
                                            break;
                                        case "3":
                                            echo "md:w-1/2 lg:w-1/3";
                                            break;
                                        case "4":
                                            echo "md:w-1/2 lg:w-1/3 xl:w-1/4";
                                            break;
                                    } ?>">
                                    <?php if (!empty($text)) { ?>
                                        <div>
                                            <?php echo $text; ?>
                                        </div>
                                    <?php } ?>

                                    <?php if (!empty($button)) { ?>
                                        <div>
                                            <a class="btn btn-primary" href="<?php echo $button[
                                                "url"
                                            ]; ?>" target="<?php echo $button[
    "target"
]; ?>">
                                                <?php echo $button["title"]; ?>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>

                            <?php $loopCount++;
                            }
                            ?>
                        </div>

                    <?php } elseif (
                        $presentation === "text-media" ||
                        $presentation === "media-text"
                    ) { ?>
                        <?php
                        $text = $textMediaContainer["text"];
                        $button = $textMediaContainer["button"];

                        $selectionMedia =
                            $textMediaContainer["selection_media"];
                        $image =
                            $textMediaContainer["media_container"]["image"];
                        $video =
                            $textMediaContainer["media_container"]["video"];
                        $videoYt =
                            $textMediaContainer["media_container"]["yt_video"];
                        ?>

                        <div class="flex flex-wrap items-center<?php if (
                            $presentation === "text-media"
                        ) { ?> flex-row-reverse<?php } else { ?> row<?php } ?>">
                            <div class="media-container relative w-full xl:w-1/2">
                                <?php if ($selectionMedia === "image") {
                                    if (!empty($image)) {
                                        $imageClass = "h-full";
                                        include dirname(dirname(__FILE__)) .
                                            "/_clone/image/image.php";
                                    }
                                } elseif ($selectionMedia === "video") {
                                    if (!empty($video) || !empty($videoYt)) {
                                        $videoType =
                                            $textMediaContainer[
                                                "media_container"
                                            ]["video_type"];
                                        $videoPoster =
                                            $textMediaContainer[
                                                "media_container"
                                            ]["video_poster"];

                                        if ($videoType === "youtube") {
                                            $videoYtUri =
                                                $textMediaContainer[
                                                    "media_container"
                                                ]["yt_video"];
                                        } elseif ($videoType === "video") {
                                            $videoUri =
                                                $textMediaContainer[
                                                    "media_container"
                                                ]["video"]["url"];
                                            $videoMimeType =
                                                $textMediaContainer[
                                                    "media_container"
                                                ]["video"]["mime_type"];
                                        }

                                        $containerClass =
                                            "absolute top-0 left-0 right-0 bottom-0 w-full h-full object-cover object-center";
                                        $videoClass = $containerClass;
                                        $iframeContainerClass = $containerClass;

                                        $videoPosterContainerClass =
                                            "absolute top-0 left-0 right-0 bottom-0 w-full h-full object-cover object-center cursor-pointer z-10";
                                        $videoPosterClass = $videoPosterContainerClass;

                                        include dirname(dirname(__FILE__)) .
                                            "/_clone/video/video.php";
                                    }
                                } ?>
                            </div>

                            <div class="text w-full xl:w-1/2 xl:py-16 <?php if (
                                $presentation === "text-media"
                            ) { ?> xl:pr-16<?php } else { ?> xl:pl-16<?php } ?>">
                                <?php include dirname(dirname(__FILE__)) .
                                    "/_clone/headline/headline.php"; ?>

                                <?php if (!empty($text)) { ?>
                                    <div class="text-container">
                                        <?php echo $text; ?>
                                    </div>
                                <?php } ?>

                                <?php if (!empty($button)) { ?>
                                    <div class="btn-container">
                                        <a class="btn btn-primary" href="<?php echo $button[
                                            "url"
                                        ]; ?>" target="<?php echo $button[
    "target"
]; ?>"><?php echo $button["title"]; ?></a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            </div>
        </section>
    <?php } ?>
<?php } ?>
