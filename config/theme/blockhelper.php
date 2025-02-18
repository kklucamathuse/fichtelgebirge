<?php 
    class BlockHelper {

        /** Gets ACF fields for a specific block on a given post */
        public function getBlockFromPage(string $block_name, int $post_id) {
            $post = get_post($post_id);

            if (!$post) return false;
            $blocks = parse_blocks($post->post_content);

            //var_dump($blocks);

            $blockArray = [];
            foreach($blocks as $block){

                //var_dump($block);

                if($block['blockName'] == $block_name) {
                    $blockArray[]= $block['attrs']['data'];
                }
            }
            return $blockArray;
        }

        /** Return post id by checking for post instance, second POST param post_id (eg. if ACF ajax preview from Gutenberg), third GET page_id (WP preview) */
        public function getPostId() {
            if (get_the_ID()) return get_the_ID();
            if (isset($_POST['post_id'])) return $_POST['post_id'];
            if (isset($_GET['page_id'])) return $_GET['page_id'];

            return false;
        }
    }

    /** Example usage (eg in page.php) */
    /*
        $blockhelper = new BlockHelper(); // call helper class
        $specificBlocks = $blockhelper->getBlockFromPage('acf/text-bild-video', $post->ID); // get the specific block or blocks

        if (!empty($specificBlocks)) {
            foreach ($specificBlocks as $specificBlock) {
                $specificField = $specificBlock['preline']; // get specific field
                echo $specificField;
            }
        } 
    */
