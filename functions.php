<?php
    /**
     * theme config - do not change
     */

        /** get blocks from folder */
        $blocks = array();
        foreach(glob(__DIR__ . '/blocks/*', GLOB_ONLYDIR) as $block) {
            $block = str_replace(__DIR__ . '/blocks/', '', $block);
            if (substr($block, 0, 1) === '_') {
                //
            } else {
                $blocks[] = $block;
            }
        }

        /** init block */
        add_action( 'init', 'register_acf_blocks', 5 );
        function register_acf_blocks(): void
        {
            global $blocks;

            if(is_iterable($blocks)){

                foreach ($blocks as $block) {
                    register_block_type( __DIR__ . '/blocks/' . $block );
                }
            }
        }

        /** allow blocks */
        add_filter('allowed_block_types_all', 'allowed_block_types', 10, 2 );

        function allowed_block_types( $allowed_block_types, $editor_context ) {
            /** globale variable $blocks */
            global $blocks;

            $acfBlocks = [];
            foreach ($blocks as $block) {
                $acfBlocks[] = "acf/" . $block;
            }

            /** include plugin.php file to use the is_plugin_active function */
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

            /** check if WooCommerce and Germanized WooCommerce are active */
            if ( is_plugin_active( 'woocommerce/woocommerce.php' ) && is_plugin_active( 'woocommerce-germanized/woocommerce-germanized.php' ) ) {
                if ( $editor_context->post && $editor_context->post->post_type === 'document_template' ) {
                    
                    /** allow Gutenberg blocks for email templates */
                    $woocommerce_blocks = array(
                        'core/paragraph',        // Paragraph
                        'core/image',            // Image
                        'core/heading',          // Heading
                        'core/table',            // Table
                        'core/block',            // Block
                        'core/columns',          // Columns
                        'core/group',            // Group
                        'core/media-text',       // Media & Text
                        'core/button',           // Button
                        'core/buttons',          // Buttons
                        'core/column',           // Column (used within columns)
                        'core/nextpage',         // Page Break
                        'core/separator',        // Separator
                        'core/spacer',           // Spacer
                    );

                    return array_merge( $acfBlocks, $woocommerce_blocks );
                }
            }

            return $acfBlocks;
        }

        /**
         * Get theme configuration
         */
        require_once __DIR__ . '/config/theme/protect.php';
        require_once __DIR__ . '/config/theme/admin.php';
        require_once __DIR__ . '/config/theme/admin-bar.php';
        require_once __DIR__ . '/config/theme/allow-svg-upload.php';
        require_once __DIR__ . '/config/theme/enqueue.php';
        require_once __DIR__ . '/config/theme/remove-wp-tags.php';
        require_once __DIR__ . '/config/theme/theme-support.php';
        require_once __DIR__ . '/config/theme/clean-dashboard.php';
        require_once __DIR__ . '/config/theme/gutenberg.php';
        require_once __DIR__ . '/config/theme/redirect-logout.php';
        require_once __DIR__ . '/config/theme/remove-wp-block-library.php';
        require_once __DIR__ . '/config/theme/disable-wp-sitemap.php';
        require_once __DIR__ . '/config/theme/remove-comments.php';
        require_once __DIR__ . '/config/theme/collapse-accordeons-on-edit.php';
        require_once __DIR__ . '/config/theme/remove-language-switch-on-login.php';
        require_once __DIR__ . '/config/theme/remove-global-styles.php';
        require_once __DIR__ . '/config/theme/shortcodes.php';
        require_once __DIR__ . '/config/theme/blockhelper.php';
        require_once __DIR__ . '/config/theme/hide-update-info.php';
        require_once __DIR__ . '/config/theme/post-status-color.php';
        require_once __DIR__ . '/config/theme/remove-attachment-permalinks.php';
        require_once __DIR__ . '/config/theme/get-current-url.php';
        require_once __DIR__ . '/config/theme/acf-watcher.php';
        require_once __DIR__ . '/config/theme/disable-upload-folders.php';
        require_once __DIR__ . '/config/theme/disable-users-endpoint.php';
        require_once __DIR__ . '/config/theme/login-redirect.php';
        require_once __DIR__ . '/config/theme/webp-convert.php';
        // require_once __DIR__ . '/config/theme/webp-convert-all.php';


    /**
     * Get custom theme configuration
     */
        require_once __DIR__ . '/config/custom/clean-walker-nav.php';
        require_once __DIR__ . '/config/custom/login.php';
        require_once __DIR__ . '/config/custom/search-form.php';
        require_once __DIR__ . '/config/custom/images.php';
        require_once __DIR__ . '/config/custom/menu.php';
        require_once __DIR__ . '/config/custom/acf-option-page.php';
        require_once __DIR__ . '/config/custom/cpt.php';
        require_once __DIR__ . '/config/custom/remove-posts.php';
        require_once __DIR__ . '/config/custom/upload-handle.php';

    /**
     * Get woocommerce configuration
     */
    require_once  __DIR__ . '/config/woocommerce/bergauf-woocommerce-functions.php';

    if ( bergauf_is_woocommerce_activated() ) {
        require_once __DIR__ . '/config/woocommerce/inc/class-bergauf-woocommerce.php';
    }

    flush_rewrite_rules();
