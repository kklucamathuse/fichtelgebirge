<?php if (!empty($headline['preline']) || !empty($headline['headline']) || !empty($headline['subline'])) { ?>
    <div class="headline-wrapper <?php if(!empty($headline['heading_alignment'])) {echo $headline['heading_alignment'];} ?>">
        <?php if (!empty($headline['preline'])) { ?>
            <div class="preline"><?php echo $headline['preline']; ?></div>
        <?php } ?>
        <?php if ($headline['heading_seo']) { ?>
            <<?php echo $headline['group_type']['heading_type']; ?> <?php if(!empty($headline['group_type']['heading_style']) && ($headline['group_type']['heading_type'] !== $headline['group_type']['heading_style'])) { ?> class="<?php echo $headline['group_type']['heading_style']; ?>" <?php } ?>><?php echo $headline['headline']; ?></<?php echo $headline['group_type']['heading_type']; ?>>
        <?php } else { ?>
            <div class="<?php echo $headline['group_type']['heading_style']; ?>"><?php echo $headline['headline']; ?></div>
        <?php } ?>
        <?php if (!empty($headline['subline'])) { ?>
            <div class="subline"><?php echo $headline['subline']; ?></div>
        <?php } ?>
    </div>
<?php } 
?>

