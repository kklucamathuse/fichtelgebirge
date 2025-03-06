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
$images = get_field("select");

// Classes.
$kkBlock = " block-" . $element;
$classes = $kkBlock;

// Show block-preview in Gutenberg Editor.
if (isset($block["data"]["block-preview"])) { ?>
<img src="<?php echo $blockPath .
    str_replace("file:.", "", $block["data"]["block-preview"]); ?>" />
<?php } else { ?>
    <section class="section relative z-10 py-20 w-full">
        <svg class="hidden absolute w-full h-full xl:h-auto inset-0 -z-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920.215 851.384" preserveAspectRatio="xMidYMid slice">
            <path id="Path_1231" data-name="Path 1231" d="M0,531.144c245.926-102.213,389,43.055,623.307,0S1042.025,393.192,1204,430.558,1479.108,584.681,1634.3,546.8s285.918-43.2,285.918-43.2V-297.121H0Z" transform="translate(0 297.121)" fill="#124b7a"/>
        </svg>
        <div class="wrapper px-6 lg:px-12 xl:px-44">
            <div class="headline flex w-full justify-between items-center">
                <span><?php echo $title; ?></span>
                <div class="navigation">
                    <button class="group relative z-[9999] pointer-events-auto h-10 w-10 rounded-full border-2 border-[#8DB63C] hover:border-white bg-white hover:bg-[#8DB63C] button-prev">
                        <svg class="h-6 w-4 mx-auto fill-[#8DB63C] group-hover:fill-white rotate-180" version="1.1" id="fi_545682" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                    <g>
	<g>
		<path d="M506.134,241.843c-0.006-0.006-0.011-0.013-0.018-0.019l-104.504-104c-7.829-7.791-20.492-7.762-28.285,0.068
			c-7.792,7.829-7.762,20.492,0.067,28.284L443.558,236H20c-11.046,0-20,8.954-20,20c0,11.046,8.954,20,20,20h423.557
			l-70.162,69.824c-7.829,7.792-7.859,20.455-0.067,28.284c7.793,7.831,20.457,7.858,28.285,0.068l104.504-104
			c0.006-0.006,0.011-0.013,0.018-0.019C513.968,262.339,513.943,249.635,506.134,241.843z"></path>
	</g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    </svg>
                    </button>
                    <button class="group relative z-[9999] pointer-events-auto h-10 w-10 rounded-full border-2 border-[#8DB63C] hover:border-white bg-white hover:bg-[#8DB63C] button-next"><svg class="w-4 h-6 fill-[#8DB63C] group-hover:fill-white mx-auto" version="1.1" id="fi_545682" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                    <g>
	<g>
		<path d="M506.134,241.843c-0.006-0.006-0.011-0.013-0.018-0.019l-104.504-104c-7.829-7.791-20.492-7.762-28.285,0.068
			c-7.792,7.829-7.762,20.492,0.067,28.284L443.558,236H20c-11.046,0-20,8.954-20,20c0,11.046,8.954,20,20,20h423.557
			l-70.162,69.824c-7.829,7.792-7.859,20.455-0.067,28.284c7.793,7.831,20.457,7.858,28.285,0.068l104.504-104
			c0.006-0.006,0.011-0.013,0.018-0.019C513.968,262.339,513.943,249.635,506.134,241.843z"></path>
	</g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    </svg></button>
                </div>
            </div>
        <div class="swiper relative pt-8">
            <div class="swiper-wrapper">
                <?php foreach ($images as $image) { ?>
                    <div class="swiper-slide">
                        <img class="image-container rounded-xl" src="<?php echo $image[
                            "image"
                        ]["url"]; ?>"</img>
                    </div>
                <?php } ?>
            </div>
        </div>
        </div>
    </section>
    <?php }
?>
