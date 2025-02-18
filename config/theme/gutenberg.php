<?php
    /** add actions + filter */
    // Disable colors
    add_theme_support( 'editor-color-palette', array() );
    add_theme_support( 'disable-custom-colors' );

    // Disable font sizes
    add_theme_support( 'editor-font-sizes', [] );
    add_theme_support( 'disable-custom-font-sizes' );

    add_action('after_setup_theme', 'editor_setup', 100);
    add_action('admin_enqueue_scripts', 'admin_style');
    add_action('wp_print_styles', 'deregister_styles_and_scripts', 100 );
    add_action('init', 'removeCorePatterns', 100 );
    // add_filter('use_block_editor_for_post_type', 'disable_gutenberg_cpt', 10, 2);

    /**
     * Register Theme Main CSS File
     */
    function editor_setup() {
        // Add support for editor styles.
        add_theme_support( 'editor-styles' );

        // Enqueue editor styles.
        add_editor_style( 'assets/css/editor.css' );

        // $json = json_decode( file_get_contents( get_template_directory() . '/assets/build/entrypoints.json' ), true );
        // $cssFile = $json['entrypoints']['main']['css'][0];
        // $relativePathToFile = str_replace('/wp-content/themes/bergauf/', '', $cssFile);
        // add_editor_style( $relativePathToFile );
    }

    function admin_style() {
        wp_enqueue_style('admin-styles', get_template_directory_uri().'/assets/css/admin.css');
    }

    /**
     * Unregister Gutenberg Styles in Frontend
     */
    function deregister_styles_and_scripts() {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wc-block-style');
    }

    /**
     * Disable Gutenberg for Custom Post types
     */
    function disable_gutenberg_cpt($current_status, $post_type) {
        // post types
        // if ($post_type === 'my-post-type') return false;
        return $current_status;
    }

    /**
     * Remove Gutenberg Pattern
     */
    function removeCorePatterns() {
        remove_theme_support('core-block-patterns');

        unregister_block_pattern_category('buttons');
        unregister_block_pattern_category('columns');
        unregister_block_pattern_category('gallery');
        unregister_block_pattern_category('header');
        unregister_block_pattern_category('text');
    }
