<?php 
    // Variables
    $folder = basename(__DIR__);
    $title = "Mein Block-Title";
    $description = "Meine Block-Beschreibung";
    $category = "text";  // Categories: [ text | media | design ]
    $icon = "heading"; // https://developer.wordpress.org/resource/dashicons/
    if ($category == "text") {
        $bgcolor = "#00796B";
    } elseif ($category == "media") {
        $bgcolor = "#303F9F";
    } elseif ($category == "design") {
        $bgcolor = "#E64A19";
    } else {
        $bgcolor = "#000000";
    }

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // Register a testimonial block.
        acf_register_block_type(array(
            'name'              =>      $folder,
            'title'             =>      __( $title ),
            'description'       =>      __( $description ),
            'render_template'   =>      'blocks/' . $folder . '/template.php',
            'category'          =>      $category,
            'supports'	        =>      array(
                'align'             =>      false,
                'mode'              =>      false,
            ),
            'icon'               =>     array(
                'background'        =>      $bgcolor,
                'foreground'        =>      '#fff',
                'src'               =>      $icon,
            ),
            'keywords'          =>      array(''),
            'mode'              =>      'edit',

            // block preview in editor
            'example'           =>      array(
                'attributes'        =>      array(
                        'mode'          =>      'preview',
                        'data'          =>      array(
                            '__is_preview'  =>      true,
                    )
                )
            )
        ));
    }