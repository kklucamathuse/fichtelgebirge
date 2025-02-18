<?php 
    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page(array(
            'page_title' 	=> 'Globale Einstellungen',
            'menu_title'	=> 'Globale Einstellungen',
            'menu_slug' 	=> 'options-page',
            'capability'	=> 'edit_posts',
            'redirect'		=> false,
            'update_button' => __('Aktualisieren', 'acf'),
            'updated_message' => __("Daten aktualisiert", 'acf')
        ));
    }
