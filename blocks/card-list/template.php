<?php
// Get name of the current element.
$element = basename(__DIR__);

// Get block ID.
$id = $block["id"];

// Path to Block-Element
$blockPath = get_template_directory_uri() . "/blocks/" . $element;
$path = "data-blockpath='" . $blockPath . "'";

// ACF fields.
$title = get_field("title");
$contents = get_field("card");
$background = get_field("background");

// Classes.
$kkBlock = " block-" . $element;
$classes = $kkBlock;

// Show block-preview in Gutenberg Editor.
if (isset($block["data"]["block-preview"])) { ?>
<img src="<?php echo $blockPath .
    str_replace("file:.", "", $block["data"]["block-preview"]); ?>" />
<?php } else { ?>
<section id="card-list" class="px-6 lg:px-12 xl:px-44 mt-20 z-0">
    <div id="title">
    <?php echo $title; ?>
    </div>
    <div id="card-wrapper" class="relative flex flex-col gap-14 lg:gap-0 lg:flex-row mt-28">
        <?php if ($background == "dark") { ?>
        <div class="absolute h-1/2 w-[200%] -left-48 -z-1 bottom-0 bg-primary"></div>
        <?php } ?>
        <?php foreach ($contents as $content) { ?>
            <div id="card" class="relative w-full lg:w-1/4 mr-4 last:mb-0 shadow-card rounded-lg bg-white">
                <svg id="Ebene_2" class="absolute odd:fill-[#C0DEF7] even:fill[#D7E8AE] h-20 w-20 -top-12 left-4" data-name="Ebene 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 106.57 90.4">
                  <g id="Ebene_1-2" data-name="Ebene 1">
                    <path id="blob" d="M65.6,85.09c12.49-3.59,25.06-7.37,32.88-16.55,7.73-9.15,10.71-23.7,5.45-35.42-5.31-11.8-18.89-20.7-33.11-26.55C56.63.65,41.87-2.19,30.94,1.97,20.01,6.13,12.91,17.28,7.33,29.23S-2.31,53.81,1.47,64.99c3.75,11.24,15.34,21.07,27.37,24.2,11.93,3.15,24.32-.4,36.76-4.09Z"/>
                  </g>
                </svg>
                <div id="card-ctn" class="px-8 pb-8 pt-10">
                    <?php print_r($content["text"]); ?>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<?php } ?>
