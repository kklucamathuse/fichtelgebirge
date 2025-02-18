<?php
    /** add actions + filter */
    add_action('admin_menu', 'remove_posts');

    /** define functions */
    function remove_posts () { 
        remove_menu_page('edit.php');
    }