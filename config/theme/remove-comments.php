<?php 
    /** add actions + filter */
    add_action( 'admin_menu', 'remove_admin_menus' );
    add_action('init', 'remove_comment_support', 100);

    /** define functions */
    function remove_admin_menus() {
        remove_menu_page( 'edit-comments.php' );
    }    

    function remove_comment_support() {
        remove_post_type_support( 'post', 'comments' );
        remove_post_type_support( 'page', 'comments' );
    }