<?php
    /** add actions + filter */
    add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );

    /** define functions */
    function remove_dashboard_widgets() {
        global $wp_meta_boxes;
    
        // Main column (left):
        // unset($wp_meta_boxes['dashboard']['normal']['high']['dashboard_browser_nag']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    
        // Side Column (right):
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
        remove_action( 'welcome_panel', 'wp_welcome_panel' );
    }