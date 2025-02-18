<?php
    /** add actions + filter */
    add_action( 'after_setup_theme', 'menus' ) ;

    /** define functions */
    function menus() {
        register_nav_menu ('main-menu','Hauptmenü');
        register_nav_menu ('footer-menu','Footermenü');
    }