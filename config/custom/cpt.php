<?php
    /** add actions + filter */
    add_action( 'init', 'create_post_type' );

    /** define functions */
    if ( ! function_exists( 'create_post_type' ) ) {
        function create_post_type() {
            register_post_type( 'name-of-cpt',
                array(
                    'labels' => array(
                        'name' => __( 'Mein CPT' ),
                        'singular_name' => __( 'Mein CPT' ),
                        'add_new' => __('Neue Seite erstellen'),
                    ),
                    'public' => true,
                    'supports' => array ( 'title', 'custom-fields' ),
                    //'taxonomies' => array( 'category', 'post_tag' ),
                    'hierarchical' => true,
                    'has_archive' => true,
                    'show_in_rest' => true,
                    'rewrite' => array ( 'slug' => __( 'name-of-cpt' ) )
                )
            );
            /*
            register_taxonomy( 'name-of-cpt_category', 'name-of-cpt', array(
                'hierarchical' => true,
                'label' => __('Kategorie'),
                'query_var' => 'name-of-cpt_category',
                'rewrite' => array('slug', 'name-of-cpt_category'),
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_rest'               => true,
            ));
            */
        }
    }

    /**
     * noindex Posttype Projekte Kategorien
     */
    // function noindex_for_nameofcpt() {
    //     if ( is_singular( 'name-of-cpt' ) ) {
    //         echo '<meta name="robots" content="noindex, nofollow">';
    //     }
    // } add_action('wp_head', 'noindex_for_nameofcpt');
