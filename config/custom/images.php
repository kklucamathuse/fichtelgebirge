<?php
    /** add actions + filter */
    add_action( 'init', 'custom_image_sizes') ;
    add_filter( 'intermediate_image_sizes_advanced', 'remove_default_images' );
    add_filter( 'make_webp', 'make_webp' );
    add_filter( 'big_image_size_threshold', '__return_false' ); // remove -scaled

    /** define functions */
    function custom_image_sizes() {

        // add new sizes and names
        // add_image_size( 'round', 800, 800, array( 'left', 'top' ) );
        add_image_size( 'full', 2560, 9999 );
        add_image_size( 'max', 1920, 9999 );
        add_image_size( 'boxed', 1400, 9999 );
        add_image_size( 'og', 1200, 630, TRUE );
        add_image_size( 'medium', 992, 9999 );
        add_image_size( 'small', 768, 9999 );
        add_image_size( 'xsmall', 480, 9999 );
    }

    function remove_default_images( $sizes ) {
        unset( $sizes['large']); // 1024px
        unset( $sizes['medium_large']); // 768px
        unset( $sizes['1536x1536']);
        unset( $sizes['2048x2048']);
        return $sizes;
    }

    function make_webp($image){
        //Für jpg-bilder
        if (isset($image['sizes'])) {
            foreach ($image['sizes'] as $key => $value) {
                $image['sizes'][$key]=str_replace(".jpg", ".webp", str_replace(".png", ".webp", str_replace(".jpeg", ".webp", $value)));
            }
        }
        elseif (gettype($image)=="string") {
            $image=str_replace(".jpg", ".webp", str_replace(".png", ".webp", str_replace(".jpeg", ".webp",$image)));
        }
        return $image;
    }
