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
    $headline      = get_field('headline_clone');
    $text          = get_field('text');
    $elements      = get_field('elements');
    $showSize      = get_field('data_size');
    $dataDownload  = get_field('data_download');
    $hideBlockFrontend = get_field('hide_block_frontend');

    // Classes.
    $kkBlock = " block-" . $element;
    $classes = $kkBlock;

    if (isset($block['data']['block-preview'])) { ?>
        <img src="<?php echo $blockPath . str_replace("file:.","",$block['data']['block-preview']); ?>" />
    <?php } else {
?>
    <?php if (!$hideBlockFrontend) { ?>
        <section class="block<?php echo $classes; ?> px-6 md:px-9 lg:px-12" <?php if (current_user_can('administrator')) { echo " " . $path; } ?>>
            <div class="wrapper">
                <div class="text-wrapper mb-8">
                    <?php include dirname(dirname(__FILE__)) . "/_clone/headline/headline.php";  ?>
                    <?php if (!empty($text)) { echo $text; } ?>
                </div>

                <div class="download-container download-<?php echo $presentation; ?>">
                    <?php if (!empty($elements)) { ?>
                        <ul class="download-list flex flex-wrap -mx-4">
                            <?php foreach ($elements as $element) {
                                $fileSize   = size_format($element['data']['filesize']);
                            ?>

                                <li class="item p-4 w-full xl:w-1/2">
                                    <a href="<?php echo $element['data']['url']; ?>" <?php if ($dataDownload === 'yes') { echo "download"; } else { echo "target='_blank'"; } ?> class="group bg-white flex items-center justify-between py-6 px-4 no-underline shadow-[0_0_10px_rgba(0,0,0,0.2)] transition hover:bg-primary hover:text-white">
                                        <span class="name flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 511 511" style="enable-background:new 0 0 511 511;" xml:space="preserve" class="w-6 h-6 mr-4 fill-primary transition group-hover:fill-white">
                                                <path d="M329.3,3c-2.3-2.5-5.6-3.9-8.9-3.9H121C84.3-1,53.9,29.2,53.9,66v377c0,36.8,30.4,67,67.1,67  h270.6c36.8,0,67.1-30.2,67.1-67V143.7c0-3.2-1.5-6.3-3.6-8.6L329.3,3z M332.8,42.6l84.3,88.5h-54.8c-16.3,0-29.5-13.1-29.5-29.4  V42.6z M391.6,485.3H121c-23.1,0-42.5-19.1-42.5-42.3V66c0-23.1,19.3-42.3,42.5-42.3h187.1v78c0,30,24.2,54.1,54.2,54.1h71.7V443  C434.1,466.2,414.8,485.3,391.6,485.3z M357.9,400.2H154.7c-6.8,0-12.3,5.6-12.3,12.3c0,6.8,5.6,12.3,12.3,12.3H358  c6.8,0,12.3-5.6,12.3-12.3C370.4,405.7,364.8,400.2,357.9,400.2z M247.3,355.8c2.3,2.5,5.6,3.9,9,3.9c3.5,0,6.7-1.5,9-3.9l72.3-77.6  c4.7-4.9,4.3-12.8-0.6-17.4c-4.9-4.7-12.8-4.3-17.4,0.6l-51,54.7V181.3c0-6.8-5.6-12.3-12.3-12.3c-6.8,0-12.3,5.6-12.3,12.3v134.8  l-50.9-54.7c-4.7-4.9-12.5-5.3-17.4-0.6c-4.9,4.7-5.3,12.5-0.6,17.4L247.3,355.8z"/>
                                            </svg>
                                            <?php echo $element['name']; ?>
                                        </span>
                                        <?php if ($showSize === 'yes') { ?> <span class="filesize whitespace-nowrap pl-5"><?php echo  $fileSize; ?></span> <?php } ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php }  ?>
                </div>
            </div>
        </section>
    <?php } ?>

<?php } ?>
