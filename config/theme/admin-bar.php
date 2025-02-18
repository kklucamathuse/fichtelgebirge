<?php
    /** add actions + filter */
    add_action('wp_loaded', 'setup_custom_admin_bar');

    function setup_custom_admin_bar() {
        if (is_user_logged_in() && !current_user_can('customer')) {
            add_action('wp_footer', 'additional_admin_bar_to_backend', 40);
            add_action('admin_bar_menu', 'additional_admin_bar_menu', 50);
            add_action('admin_bar_menu', 'additional_admin_bar_to_frontend', 10);
            add_action('wp_before_admin_bar_render', 'mytheme_admin_bar_render');
            add_action('wp_head', 'move_admin_bar');
        }
    }

    /** define functions */
    function additional_admin_bar_menu() {
        global $wp_admin_bar;
        $wp_admin_bar->add_menu( array(
            'id' => 'navigation',
            'title' => '<span class="ab-icon"></span>'.__( 'Menü bearbeiten' ),
            'href' => '/wp-admin/nav-menus.php' ) );
        ?>
        <style type="text/css">
            #wpadminbar #wp-admin-bar-navigation .ab-icon:before {
                content: '\f203';
                top: 3px;
            }
            #wpadminbar .quicklinks > ul > li > a {
                padding: 0 15px;
            }
        </style>
    <?php }

    function additional_admin_bar_to_backend() {
        global $wp_admin_bar;
        $wp_admin_bar->add_menu( array(
            'id' => 'backend',
            'title' => '<span class="ab-icon"></span>'.__( 'WordPress Backend' ),
            'href' => '/wp-admin/' ) );
        ?>
        <style type="text/css">
            #wpadminbar #wp-admin-bar-backend .ab-icon:before {
                content: '\f226';
                top: 3px;
            }
            #wpadminbar .quicklinks > ul > li > a {
                padding: 0 15px;
            }
        </style>
    <?php }

    function additional_admin_bar_to_frontend() {
        global $wp_admin_bar;

        $wp_admin_bar->add_menu( array(
            'id' => 'frontend',
            'title' => '<span class="ab-icon"></span>'.__( 'Zur Website' ),
            'href' => '/' ) );
        ?>
        <style type="text/css">
            #wpadminbar #wp-admin-bar-frontend .ab-icon:before {
                content: '\f102';
                top: 3px;
            }
            #wpadminbar .quicklinks > ul > li > a {
                padding: 0 15px;
            }
        </style>
    <?php }

    function mytheme_admin_bar_render() {
        global $wp_admin_bar;

        $wp_admin_bar->remove_menu('comments');
        $wp_admin_bar->remove_menu('new-content');
        $wp_admin_bar->remove_menu('customize');
        $wp_admin_bar->remove_menu('appearance');
        $wp_admin_bar->remove_menu('search');
        $wp_admin_bar->remove_menu('dashboard');
        $wp_admin_bar->remove_menu('delete-cache');
        $wp_admin_bar->remove_menu('wp-logo');
        $wp_admin_bar->remove_menu('site-name');
    }

    function move_admin_bar() {
        if ( is_user_logged_in() ) {
        echo '<style type="text/css">
                body {padding-bottom: 32px;}
                body.admin-bar #wphead {padding-top: 0;}
                body.admin-bar #footer {padding-bottom: 32px;}
                #wpadminbar {top: auto !important; bottom: 0; position: fixed;}
                #wpadminbar .quicklinks .menupop ul {bottom: 0;}
                #wpadminbar .ab-top-secondary .menupop .ab-sub-wrapper {bottom: 32px;}
                </style>';
        }
    }
