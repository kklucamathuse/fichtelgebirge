<?php
    /** add actions + filter */
    add_filter( 'get_search_form', 'custom_search_form' );

    /** define functions */
    function custom_search_form( $form ) {
        $form = '
                <form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
                    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
                    <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" />
                </form>';
        return $form;
    }
