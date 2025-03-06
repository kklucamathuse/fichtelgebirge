<?php
// Get name of the current element.
$element = basename(__DIR__);

// Get block ID.
$id = $block["id"];

// Path to Block-Element
$blockPath = get_template_directory_uri() . "/blocks/" . $element;
$path = "data-blockpath='" . $blockPath . "'";

// ACF fields.
$image = get_field("img");
$text = get_field("text");
$background = get_field("background");

// Classes.
$kkBlock = " block-" . $element;
$classes = $kkBlock;

// Show block-preview in Gutenberg Editor.
if (isset($block["data"]["block-preview"])) { ?>
<img src="<?php echo $blockPath .
    str_replace("file:.", "", $block["data"]["block-preview"]); ?>" />
<?php } else { ?>
    <section class="px-6 lg:px-12 xl:px-44 mt-8 xl:mt-32">
        <div class="relative wrapper flex flex-col lg:flex-row">
            <svg class="hidden lg:block absolute -top-48 left-4 h-full -z-1 w-52" xmlns="http://www.w3.org/2000/svg" width="290.418" height="212.547" viewBox="0 0 290.418 212.547">
              <path id="blob" d="M125.894,121.077c16.14-14.051,32.281-28.45,37.575-47.61,5.165-19.044-.517-42.849-16.528-56.667C130.8,2.866,104.331-.966,79.023.2,53.715,1.24,29.7,7.278,16.269,21.1S0,56.514,0,78.228s2.712,43.429,16.14,57.48c13.429,14.167,37.575,20.786,57.718,17.07C93.872,149.178,109.883,135.244,125.894,121.077Z" transform="translate(64.997 1.678) rotate(25)" fill="#d7e8ae"/>
              <path id="blob-2" data-name="blob" d="M116.679,119.147c14.959-13.827,29.918-28,34.824-46.851,4.787-18.74-.479-42.166-15.318-55.764C121.227,2.82,96.694-.951,73.239.192,49.783,1.22,27.524,7.162,15.079,20.761S0,55.613,0,76.981s2.513,42.737,14.959,56.564C27.4,147.486,49.783,154,68.452,150.342,87,146.8,101.84,133.088,116.679,119.147Z" transform="translate(157.26 210.488) rotate(-120)" fill="none" stroke="#8db63c" stroke-width="3"/>
            </svg>
            <div id="wrapper_image" class="w-full md:w-1/2">
                <img class="rounded-t-xl lg:rounded-t-none lg:rounded-bl-xl lg:rounded-tl-xl" src="<?php echo $image[
                    "url"
                ]; ?>">
            </div>
            <div id="wrapper_text"class="w-full md:w-1/2 bg-primary py-4 px-6 lg:py-14 lg:px-16 rounded-b-xl lg:rounded-bl-none lg:rounded-br-xl lg:rounded-tr-xl">
                <?php echo $text; ?>
            </div>
        </div>
    </section>
<?php }
?>
