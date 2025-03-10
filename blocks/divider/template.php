<?php
// Get name of the current element.
$element = basename(__DIR__);

// Get block ID.
$id = $block["id"];

// Path to Block-Element
$blockPath = get_stylesheet_directory_uri() . "/blocks/" . $element;
$path = "data-blockpath='$blockPath'";

// Classes.
$kkBlock = " block-" . $element;
$classes = $kkBlock;

//ACF Fields
$layout = get_field("group");
$optic = $layout["optic"];
$width = $layout["width"];
$hideBlockFrontend = get_field("hide_block_frontend");

// Show block-preview in Gutenberg Editor.
if (isset($block["data"]["block-preview"])) { ?>
        <img src="<?php echo $blockPath .
            str_replace("file:.", "", $block["data"]["block-preview"]); ?>" />
    <?php } else { ?>

<?php if (!$hideBlockFrontend) { ?>
    <div class="mb-48 block<?php echo $classes; ?>" <?php if (
    current_user_can("administrator")
); ?>>
        <div class="min-h-8 mt-20"></div>
<?php } ?>

<?php } ?>
