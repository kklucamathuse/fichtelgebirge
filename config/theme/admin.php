<?php
    /** add actions + filter */
    if (is_user_logged_in()){
        add_action( 'admin_head', 'enqueue_admin_scripts' );
    }
    remove_action( 'admin_notices', 'update_nag', 3 );

    /** define functions */
    // get editor role access to menu
    $role_object = get_role( 'editor' );
    $role_object->add_cap( 'edit_theme_options' );

    function enqueue_admin_scripts() {
        wp_enqueue_style( 'admin', get_template_directory_uri() . '/assets/css/admin.css', false, NULL, false );
    }

