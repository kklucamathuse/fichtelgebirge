<?php 

    /** add actions + filter */
    if( ! current_user_can('administrator') ) {
        add_filter('pre_site_transient_update_core','remove_core_updates'); // hide updates for WordPress
        add_filter('pre_site_transient_update_plugins','remove_core_updates'); // hide updates for plugins
        add_filter('pre_site_transient_update_themes','remove_core_updates'); // hide updates for theme
    }

    /** define functions */
    function remove_core_updates(){
        global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
    }
