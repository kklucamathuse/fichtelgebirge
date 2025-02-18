<?php
    /** add actions + filter */
    add_action( 'wp_print_styles', 'deregister_styles' ) ;

    /** define functions */
    function deregister_styles() {
        wp_dequeue_style( 'wp-block-library' );
    }