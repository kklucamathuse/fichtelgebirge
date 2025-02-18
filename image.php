<?php
    function wp_imagelink_setup() {
        $image_set = get_option( 'image_default_link_type' );

        if ($image_set !== 'none') {
            update_option('image_default_link_type', 'none');
        }
    }
    add_action('admin_init', 'wp_imagelink_setup', 10);

    global $post;
    if ( $post && $post->post_parent ) {
        wp_redirect(esc_url(get_permalink($post->post_parent)), 301);
        exit;
    } else {
        wp_redirect(esc_url(home_url( '/' )), 301);
        exit;
    }   