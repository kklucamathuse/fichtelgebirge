<?php
    /** add actions + filter */
    remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
    remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
    add_action( 'wp_enqueue_scripts', 'deregister_classic_styles', 20 );

    /** define function */
    function deregister_classic_styles() {
        wp_dequeue_style( 'classic-theme-styles' );
    }
