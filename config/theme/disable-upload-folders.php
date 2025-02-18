<?php 
    /** add actions + filter */
    add_filter( 'option_uploads_use_yearmonth_folders', '__return_false', 100 );

    /** define functions */