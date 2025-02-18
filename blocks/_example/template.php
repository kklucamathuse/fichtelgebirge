<?php
    // Get name of the current element.
    $element = basename(__DIR__);

    // Get block ID.
    $id = $block['id'];

    // Path to Block-Element
    $blockPath = get_stylesheet_directory_uri() . "/blocks/" . $element;
    $path = "data-blockpath='$blockPath'";
    
    // ACF fields.
    $myVar = get_field('my_fieldname');

    // Classes.
    $kkDivider = "--";
    $kkBlock = " block-" . $element;
    $kkBlockModifier = $kkBlock . $kkDivider;
    $classes = $kkBlock;

    // Custom Classes.
    // $classes .= $kkBlockModifier . $alignment;

    // Show block-preview in Gutenberg Editor.
    if (isset($block['data']['__is_preview'])) { ?>
        <img src="<?php echo $blockPath; ?>/preview.jpg" />
    <?php } else {
?>

    <div id="<?php echo esc_attr($id); ?>" class="block<?php echo $classes; ?>"<?php if (current_user_can('administrator')) { echo " " . $path; } ?>>
        <?php /* this is where the magic happens */ ?>
    </div>

<?php } ?>
