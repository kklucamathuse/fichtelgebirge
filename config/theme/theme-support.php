<?php
    /** add actions + filter */
    add_action( 'init', 'bergauf_starter' );

    /** define functions */
    function bergauf_starter() {
        // add_theme_support( 'post-formats', array( 'image' ));
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'menus' );
    }