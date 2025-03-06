<?php
// Get name of the current element.
$element = basename(__DIR__);

// Get block ID.
$id = $block["id"];

// Path to Block-Element
$blockPath = get_template_directory_uri() . "/blocks/" . $element;
$path = "data-blockpath='" . $blockPath . "'";

// ACF fields.
$posts = get_field("post");
$headline = get_field("headline");
$standalone = get_field("standalone");

// Classes.
$kkBlock = " block-" . $element;
$classes = $kkBlock;

// Show block-preview in Gutenberg Editor.
if (isset($block["data"]["block-preview"])) { ?>
<img src="<?php echo $blockPath .
    str_replace("file:.", "", $block["data"]["block-preview"]); ?>" />
<?php } else { ?>
    <section class="px-6 lg:px-12 xl:px-44 <?php echo $standalone === 1
        ? "mt-12"
        : "mt-24"; ?> mb-36">
    <div class="flex justify-between items-center">
        <?php echo $headline; ?>
        <div class="group flex flex-row gap-1 border-b border-blackhover:border-[#1269B0]">
        <a class="hover:text-[#1269B0]" href="https://www.diabetespraxis-fichtelgebirge.de/beitraege/"><p>weitere Beiträge</p></a><svg class="h-4 w-4 !fill-black hover:fill-[#1269B0]" version="1.1" id="fi_545682" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
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
        </svg></div>
    </div>
    <div class="flex flex-col lg:flex-row gap-4">
    <?php foreach ($posts as $post) { ?>
        <?php
        $id = $post->ID;
        $image = get_field("image", $id);
        $title = get_field("title", $id);
        $text = get_field("text", $id);
        $category = get_field("category", $id);
        $guid = get_field("guid", $id);
        $timestamp = (new DateTime($post->post_date))->format("d.m.Y");
        ?>
        <div class="w-full lg:w-1/3 card flex flex-col border border-gray-300 rounded-lg overflow-hidden h-fit shadow-md">
          <img class="h-44 object-cover" src="<?php echo $image[
              "url"
          ]; ?>" alt="Card Image" class="w-full h-1/2 object-cover block">
          <div class="card-content p-6">
              <h3 class="text-dark"><?php echo $title; ?></h3>
            <?php echo strlen($text) > 60
                ? substr($text, 0, 60) . "..."
                : $text; ?>
            <div class="flex justify-between mt-4">
                <p class="opacity-45"><?php echo $timestamp .
                    " | " .
                    $category; ?></p>
                <div class="group inline-flex items-center gap-1 border-b border-black hover:border-[#1269B0]">
                    <a class="hover:text-[#1269B0] no-underline" href="<?php echo $post->guid; ?>"><p class="mb-0">Mehr dazu</p></a><svg class="h-4 w-4 !fill-black hover:fill-[#1269B0]" version="1.1" id="fi_545682" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
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
                </svg></div>
            </div>
          </div>
        </div>
    <?php } ?>
    </div>
</section>
<?php } ?>
