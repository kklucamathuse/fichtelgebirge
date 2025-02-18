<?php
    /** add actions + filter */
    add_filter( 'rewrite_rules_array', 'kk_remove_attachment_permalink' );
    add_filter( 'attachment_link', 'kk_remove_attachment_link' );

    /** define functions */
    if ( !function_exists( 'kk_remove_attachment_permalink' ) ) {
        function kk_remove_attachment_permalink( $rules ) {
            foreach ( $rules as $regex => $query ) {
                if ( strpos( $regex, 'attachment' ) || strpos( $query, 'attachment' ) ) {
                    unset( $rules[ $regex ] );
                }
            }
            return $rules;
        }
    }
    
    if ( !function_exists( 'kk_remove_attachment_link' ) ) {
        function kk_remove_attachment_link( $link ) {
            return;
        }
    }
