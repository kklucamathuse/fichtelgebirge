<?php
    /** add actions + filter */
    add_action( 'wp_logout', 'go_home' );

    /** define functions */
    // Redirect after Logout
    function go_home(){
        wp_redirect( home_url() );
        exit();
    }
